<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable =
    [
        'title', 'parent_id', 'section_id', 'slug', 'image', 'discount_amt', 'description', 'meta_title', 'meta_description', 'status'
    ];
    /**
     * Get the user that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategories()
    {
        return $this->hasMany('App\Models\Category', 'parent_id')->where('status', 1);
    }
    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id')->select('id', 'title');
    }
    /**
     * Get the user that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent_category()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id')->select('id', 'title');
    }
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    //Getting categoryDetails to show category wise products
    public static function catDetails($slug)
    {
        $catDetails = Category::select('id', 'parent_id', 'title', 'description', 'slug')->with(['subcategories' =>
        function ($query) {
            $query->select('id', 'parent_id', 'title', 'slug', 'description')->where('status', 1);
        }])->where('slug', $slug)->first()->toArray();
        $catIds = array();
        if ($catDetails['parent_id'] == 0) {
            //Only show main category in breadcrumbs
            $breadcrumbs = '<a href="' . url($catDetails['slug']) . '">' . $catDetails['title'] . '</a>';
        } else {
            //Show main and sub category in bread crumbs
            $parentCategory = Category::select('title', 'slug')->where('id', $catDetails['parent_id'])->first()->toArray();
            $breadcrumbs = '<a href="' . url($parentCategory['slug']) . '">' . $parentCategory['title'] . '</a> <span class="divider">/</span> <a href="' . url($catDetails['slug']) . '">' . $catDetails['title'] . '</a>';
        }
        $catIds[] = $catDetails['id'];
        foreach ($catDetails['subcategories'] as $key => $sub_cat) {
            $catIds = $sub_cat['id'];
        }
        return array('catIds' => $catIds, 'catDetails' => $catDetails, 'breadcrumbs' => $breadcrumbs);
    }
}
