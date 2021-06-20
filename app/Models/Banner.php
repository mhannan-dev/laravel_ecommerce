<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';
    protected $fillable =
    [
        'title','banner_image','status','alt','created_at','updated_at'
    ];
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['alt'] = Str::slug($value);
    }
}
