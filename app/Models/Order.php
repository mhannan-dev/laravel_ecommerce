<?php
namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable =
    [
        'user_id','name','address','city','state','country','zip_code','mobile',
        'email','shipping_charges','coupon_code','coupon_amount','order_status','payment_method','payment_gateway','grand_total'
    ];
    /**
     * Get all of the comments for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

   
}
