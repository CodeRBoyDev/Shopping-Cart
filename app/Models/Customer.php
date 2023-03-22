<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Customer extends Model implements Searchable
{
    use HasFactory;
    public $table = 'customer';
    public $primaryKey = 'customer_id';
    public $timestamps = false;
    protected $fillable = ['fname','lname',
        'title','addressline','town','zipcode',
        'phone','email','user_id','creditlimit','level'
    ];
     public function orders(){
        return $this->hasMany('App\Models\Order','customer_id');
}
public function getSearchResult(): SearchResult
     {
        $url = route('customer.show', $this->customer_id);
     
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->lname ,
            $url
            
           
         );
     }
    
}
