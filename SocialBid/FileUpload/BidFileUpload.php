<?php

namespace SocialBid\FileUpload;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Config;

class BidFileUpload implements FileUploadable {

    public function __construct(Filesystem $file)
    {
        $this->file = $file;
        $this->filesPath = Config::get('paths.bid_file');
    }

    public function upload($file)
    {
        //$file = $input['_file'];
        /*if (!$this->file->isDirectory($this->filesPath)) {
            $this->file->makeDirectory($this->filesPath, 775);
        }*/

        if (is_array($file)) {
            $file = $file['file'];
        }

        $extension = $file->getClientOriginalExtension();
        do {
            $filename = Str::random(24);
        } while ($this->file->exists(
            $this->filesPath . $filename . '.' . $extension
        ));

        $movedFile = $file->move(
            $this->filesPath,
            $filename . '.' . $extension
        );

        return $movedFile->getFilename();
    }

}