<?php namespace SocialBid\FileUpload;

use GuzzleHttp\Client;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Services_Zencoder;
use Services_Zencoder_Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Zencoder {
    /**
     * @var Filesystem
     */
    protected $file;

    /**
     * @var string Zendcoder API Key
     */
    protected $apiKey;

    /**
     * @var string File storage path
     */
    protected $filesPath;

    /**
     * @var Services_Zencoder
     */
    protected $zencoder;

    /**
     * @constructs
     */
    public function __construct(Filesystem $file)
    {
        $this->file = $file;

        $this->filesPath = Config::get('paths.bid_file');

        $this->apiKey = Config::get('zendcoder.apikey');

        // Initialize the Services_Zencoder class
        $this->zencoder = new Services_Zencoder(
            $this->apiKey,
            'v2',
            'https://app.zencoder.com',
            true
        );
    }

    /**
     * Handler Zencoder video conversion
     *
     * @param $input Input
     */
    public function encode(UploadedFile $file)
    {
        if (!$this->file->isDirectory($this->filesPath)) {
            $this->file->makeDirectory($this->filesPath, 775);
        }

        $extension = $file->getClientOriginalExtension();

        /*do {

            $filename = Str::random(24);

        } while ($this->file->exists(

            $this->filesPath . $filename . '.' . $extension

        ));*/

        $filename = $file->getClientOriginalName();
		  $filename = date('Ymdhis').'-'. $filename;

        try {

            if (!$file->isValid()) {
                echo new JsonResponse($file->getErrorMessage());
                die;
            }

            $target = $this->filesPath . $filename;

            if (!@move_uploaded_file(
                $file->getRealPath(),
                $this->filesPath . $filename
            	)
            ) {

                $error = error_get_last();

                echo new JsonResponse(
                    'Could not move file. ' .
                    $error['message']
                );
                die;
            }

            @chmod($target, 0666 & ~umask());

				$file_rand = date('Ymd')."-";
				$extension_video = '.mp4';
				$extension_audio = '.mp3';
				$extension_images = '.png';
				$randiomizer = $file_rand.MD5(microtime());
				$random_filename = $randiomizer.$extension_video;
				$random_audio = $randiomizer.$extension_audio;
				$random_photo = $randiomizer;

            $encodableFile = Config::get('app.url') .
                Config::get('paths.bid_file_new') .
                $filename;
					
            // New Zencoder Encoding Job
           
            if($extension == "mp3" || $extension == "aac" ){
					$encodingJob = $this->zencoder->jobs->create(
						 array(
							  "input" => $encodableFile,
							  "outputs" => array(
									array(
										 "label" => "web",
										 "filename" => $random_audio,
										 "h264_profile" => "high"
									),
									array(
										 "label" => "file",
										 "h264_profile" => "high",
										 "url" => "s3://followback/".$random_audio,
										 "credentials" => "s3iam"
									)
							  )
						 )
					);            
            } else {
           
					$encodingJob = $this->zencoder->jobs->create(
						 array(
							  "input" => $encodableFile,
							  "outputs" => array(
									array(
										 "label" => "web",
										 "filename" => $random_filename,
										 "h264_profile" => "high"
									),
									array(
										 "label" => "file",
										 "h264_profile" => "high",
										 "url" => "s3://followback/".$random_filename,
										 "credentials" => "s3iam",
										 "thumbnails" => array(
											"filename" => $random_photo,
											"number" => 1,
											"base_url" => "s3://followback/",
											"credentials" => "s3iam"
										 )
									)
							  )
						 )
					);
				}
        } catch (Services_Zencoder_Exception $e) {

            // If were here, an error occured
            echo "Fail :(\n\n";
            echo "Errors:\n";
            foreach ($e->getErrors() as $error) {
                echo $error . "\n";
            }
            echo "Full exception dump:\n\n";
            print_r($e);
            die;

        } catch (\Exception $e) {
            print_r($e);
            die;
        }
        
		  
		  //delete the old file
		  //unlink($_SERVER['DOCUMENT_ROOT'] . "/bids_images/".$filename);
		  
        return $encodingJob->outputs['web']; //object: id, label, url

    }

    public function encodeStatus($videoId)
    {
        // New Zencoder Encoding Job
        //$encodingJob = $this->zencoder->jobs->progress($videoId);
        $encodingJob = $this->zencoder->outputs->details($videoId);

        echo $encodingJob->state; die;

    }

}