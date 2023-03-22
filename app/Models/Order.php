<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orderinfo';
    protected $primaryKey = 'orderinfo_id';
    public $timestamps = false;
    protected $fillable = ['customer_id','date_placed','date_shipped','shipping','shipvia','status'];

    //public function user(){
    //    return $this->belongsTo('App\User');
    //}
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function items(){
        return $this->belongsToMany(Item::class,'orderline','orderinfo_id','item_id')->withPivot('quantity');
    }
}