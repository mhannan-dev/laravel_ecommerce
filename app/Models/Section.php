<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected $table = 'sections';
    protected $fillable = [ 'title','created_at', 'updated_at','status'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function categories()
    {
        return $this->hasMany('App\Models\Category', 'section_id')
        ->where(['parent_id'=>'ROOT','status'=> 1])->with('subcategories');

    }

    public static function sections()
    {
        $getSections = Section::with('categories')->where('status', 1)->get();
        $getSections = json_decode(json_encode($getSections), ture);
        return $getSections;
    }

}
