<?php

namespace SocialBid\Presenters;

use Followback\User;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;
use Config, File, HTML;
use ServicesHelper;

class ServiceBid extends Presenter {
    protected $entity;

    public function priceDecimal()
    {
        return '$' . $this->entity->offer_price;
    }

    public function serviceType()
    {
        $description = ServicesHelper::getDescription(
            $this->entity->service,
            $this->entity->service_type
        );
        return $description ? $description :
            ucwords(str_replace('_', ' ', $this->entity->service_type));
    }

    public function service()
    {
        return ucfirst($this->entity->service);
    }

    public function findReceiverName()
    {
        $user = User::find((int) $this->entity->identifier);

        if (!$user) {
            return null;
        }

        return $user->name ?: $this->entity->username;
    }
    
   public function findReceiverAvatar()
    {
        $user = User::find((int) $this->entity->identifier);

        if (!$user) {
            return null;
        }

        return $user->name ?: $this->entity->username;
    }

   public function findSenderName()
    {
        $user = User::find((int) $this->entity->bidder_id);

        if (!$user) {
            return null;
        }

        return $user->name ?: $this->entity->username;
    }


   public function findSenderAvatar()
    {
        $user = User::find((int) $this->entity->bidder_id);

        if (!$user) {
            return null;
        }

        return $user->avatar ?: $this->entity->avatar;
    }



    /**
     * get markup for bid file if it exists for bids list page
     * @return string markup
     */
    public function mediaForBidsList()
    {
        $path = Config::get('paths.bid_file') . $this->entity->file;
        if (File::isFile($path)) {
            $file = new SymfonyFile($path);
            $mimeType = $file->getMimeType();
            //if is an image then return a lightbox friendly markup
            if (preg_match('/image\/*/', $mimeType)) {
                $path = asset(
                    Config::get('paths.bid_url') . $this->entity->file
                );
                return "<a href=\"$path\" target='_blank'><img src=\"$path\" alt=\"image\"></a>";
            }
            //if not an image we assume it is a video so we return a link
            $path = Config::get('paths.bid_url') . $this->entity->file;
            //return HTML::link($path, 'Download video', array('target'=>'_blank', 'class'=> "video-media-prev", 'download' => 'download'));
            return "<a href=\"$path\" target='_blank' class= 'video-media-prev' download>Download video</a>";
        }
        return null;
    }

    public function creatorSocialUsername()
    {
        return $this->entity->findCreatorSocialUsername();
    }

    public function creatorAvatar()
    {
        return $this->entity->findCreatorAvatar();
    }

    public function creatorName()
    {
        return $this->entity->findCreatorFollowbackName();
    }

    public function status()
    {
        switch ((int) $this->entity->status) {
            case 0:
                $value = 'Pending';
                break;
            case 1:
                $value = 'Denied';
                break;
            case 2:
                $value = 'Accepted';
                break;
            case 3:
                $value = 'Completed';
                break;
            default:
                $value = 'Unknown';
                break;
        }
        return $value;
    }

    public function bidType()
    {
        if ($this->entity->bid_type == 'bid') {
            return 'Bid';
        }
        return 'Fixed Price';
    }
}