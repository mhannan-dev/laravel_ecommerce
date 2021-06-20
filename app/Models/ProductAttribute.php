<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $table = 'product_attributes';
    protected $fillable =
    [
        'product_id','size','price','stock','sku','status','created_at','updated_at'
    ];
    /**
     * Get the user that owns the ProductAttribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
}
