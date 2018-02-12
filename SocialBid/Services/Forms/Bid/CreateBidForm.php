<?php
namespace SocialBid\Services\Forms\Bid;

use Followback\SocialAccount;
use SocialBid\Helpers\Facade\ServicesHelper;
use SocialBid\Services\Forms\BaseForm;
use Illuminate\Support\MessageBag;
use Input;

class CreateBidForm extends BaseForm {
    public function isValid($input)
    {
        $this->setInput($input);
        $stringServices = $this->explodeServicesTypesToString(
            array_get($input, 'service')
        );
        $socialAccount = SocialAccount::with('user', 'user.settings')
            ->byTypeAndId($input['service'], $input['identifier'])
            ->first();
        if ($socialAccount) {
            $serviceType = array_get($input, 'service_type');
            $bidType = array_get($input, 'bid_type');
            $service = array_get($input, 'service');

            $minPrice = $socialAccount->user->settings->getMinimumPrice(
                $service,
                $serviceType,
                $bidType
            );
            $minPrice = $minPrice > 0 ? $minPrice : 0.01;
        } else {
            $minPrice = 0.01;
        }

        $rules = [
            'service_type' => ['required', 'in:' . $stringServices],
            'bid_type' => ['required', 'in:bid,fixed'],
            'offer_price' => [
                'required',
                'regex:/^\d+([\.,]\d+(\.\d+)?)?$/',
                'minNumber:' . $minPrice
            ]
        ];
        return $this->validate($rules);
    }

    public function isValidUpload()
    {
        $rules = [
            'file' => 'required|mime_types:image/*,video/*,audio/*'
        ];
        return $this->validate($rules);
    }

    protected function explodeServicesTypesToString($subtype = null)
    {
        $services = ServicesHelper::getList();
        $string = '';
        if (!$subtype) {
            foreach ($services as $key => $service) {
                $string .= $key . ',';
            }
        } else {
            foreach ($services[$subtype] as $key => $service) {
                $string .= $key . ',';
            }
        }
        return substr($string, 0, -1);
    }

}