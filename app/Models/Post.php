<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'title','content','featured','category_id','slug','user_id'

    ];
    public function getFeaturedAttribute($featured){
        return asset($featured);
    }
    protected $dates=['deleted_at'];
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
