<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $primaryKey = 'item_id';
    public $table = 'item';
    public $timestamps = false;

    protected $fillable = ['description', 'sell_price','img_path'];

    public function stock() {
        return $this->belongsTo('App\Models\Stock');
    }
}
