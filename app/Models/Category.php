<?php
namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable =
    [
        'title','parent_id','section_id','slug','image','discount_amt','description','meta_title','meta_description','status'
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
        return $this->belongsTo('App\Models\Section', 'section_id')->select('id','title');
    }
    /**
     * Get the user that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent_category()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id')->select('id','title');
    }
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    //Getting categoryDetails to show category wise products
    public static function categoryDetails($url)
    {
        $categoryDetails = Category::select('id','title','slug')
            ->with('subcategories',function ($query) {
                $query->select('id','parent_id')->where('status', 1);
            })->where('slug', $url)->first()->toArray();
        $catIds = array();
        $catIds[] = $categoryDetails['id'];
        foreach ($categoryDetails['subcategories'] as $key => $sub_cat) {
            $catIds = $sub_cat['id'];
        }
        return array('catIds' => $catIds, 'categoryDetails' => $categoryDetails );

    }
}
