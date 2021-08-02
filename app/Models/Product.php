<?php
namespace App\Models;
use Illuminate\Support\Str;
use App\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $table = 'products';
    protected $fillable =
    [
        'section_id', 'brand_id', 'category_id', 'title', 'slug', 'code', 'color', 'price', 'weight', 'discount_amt', 'image', 'description', 'wash_care', 'fabric', 'pattern', 'sleeve', 'fit', 'occasion', 'meta_title', 'meta_description', 'meta_keyword', 'is_featured', 'status'
    ];
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }
    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }
    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    /**
     * Get all of the comments for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes()
    {
        return $this->hasMany('App\Models\ProductAttribute', 'product_id');
        //return $this->hasMany(ProductAttribute::class);
    }
    /**
     * Get all of the comments for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductsImage::class);
    }
    public static function product_filters()
    {
        //Product filters
        $product_filters['fabrics'] =  array('Cotton', 'Polyester', 'Wool', 'Pure-Cotton');
        $product_filters['sleeves'] = array('Long-Sleeve', 'Half-Sleeve', 'Short-Sleeve', 'Sleeve-Less');
        $product_filters['patterns'] = array('Check', 'Plain', 'Printed', 'Self', 'Solid');
        $product_filters['occasions'] = array('Casual', 'Formal');
        $product_filters['fits'] = array('Regular', 'Slim');
        return $product_filters;
    }
    public static function getDiscountedPrice($product_id)
    {
        $proDetails = Product::select('price', 'discount_amt', 'category_id')->where('id', $product_id)->first()->toArray();
        //echo "<pre>"; print_r($proDetails); die;
        $catDetails = Category::select('discount_amt')->where('id', $proDetails['category_id'])->first()->toArray();
        if ($proDetails['discount_amt'] > 0) {
            //Calculations below
            // Sale price = Cost Price - Discount Price
            // 500 = 500 - (500*10/100) or
            // 500 = 500 - (500*10%)
            $discounted_price = $proDetails['price'] - ($proDetails['price'] * $proDetails['discount_amt'] / 100);
        } else if ($catDetails['discount_amt'] > 0) {
            # code...
            $discounted_price = $proDetails['price'] - ($proDetails['price'] * $catDetails['discount_amt'] / 100);
        } else {
            $discounted_price = 0;
        }
        return $discounted_price;
    }
    public static function getDiscountedAttrPrice($product_id, $size)
    {
        $proAttrPrice = ProductAttribute::where(['product_id'=>$product_id, 'size'=> $size])->first()->toArray();
        $proDetails = Product::select('discount_amt', 'category_id')->where('id', $product_id)->first()->toArray();
        $catDetails = Category::select('discount_amt')->where('id', $proDetails['category_id'])->first()->toArray();
        if ($proDetails['discount_amt'] > 0) {
            $discounted_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $proDetails['discount_amt'] / 100);
        } else if ($catDetails['discount_amt'] > 0) {
            # code...
            $discounted_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $catDetails['discount_amt'] / 100);
        } else {
            $discounted_price = 0;
        }
        return array('price'=> $proAttrPrice['price'], 'discounted_price'=> $discounted_price);
    }
}
