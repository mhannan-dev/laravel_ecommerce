<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable =
    [
        'session_id', 'user_id', 'product_id', 'size', 'quantity', 'created_at', 'updated_at'
    ];
    //Items that added to cart
    public static function userCartItems()
    {
        if (Auth::check()) {
            $userCartItems = Cart::with(['product' => function ($query) {
                $query->select('id', 'category_id', 'title', 'image', 'code', 'color', 'discount_amt');
            }])->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get()->toArray();
        } else {
            $userCartItems = Cart::with(['product' => function ($query) {
                $query->select('id', 'category_id', 'title', 'image', 'code', 'color', 'discount_amt');
            }])->where('session_id', Session::get('session_id'))->orderBy('id', 'DESC')->get()->toArray();
        }
        return $userCartItems;
    }
    /**
     * Get the product that under the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }


    //Get Product Size wise Price
    public static function getProductAttributePrice($product_id, $size)
    {
        $attrPrice = ProductAttribute::select('price')->where(['product_id' => $product_id, 'size' => $size])->first()->toArray();
        return $attrPrice['price'];
    }
}
