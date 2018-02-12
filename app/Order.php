<?php
namespace Followback;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable = [];

    public function bid()
    {
        return $this->belongsTo(ServiceBid::class, 'bid_id');
    }

    public function findByTransactionId($id)
    {
        return $this->where('transaction_id', $id)->first();
    }

    public function scopeAuthorized($query)
    {
        return $query->where('status', 'authorized');
    }

    public function deleteWithBid()
    {
        $bid = ServiceBid::find($this->bid_id);
        if ($bid) {
            $bid->delete();
        }
        $this->delete();
    }

    public function getDates()
    {
        return ['authorized_at', 'created_at', 'updated_at'];
    }

    public function fillFromBid(ServiceBid $bid)
    {
        $this->bid_id = $bid->id;
        $this->user_id = $bid->bidder_id;
        $this->customer_email = $bid->user->email;
        $this->total = $bid->offer_price;
        $this->payment_method = 'paypal';
        $this->currency = 'USD';
        $this->status = 'created';
        return $this;
    }
}