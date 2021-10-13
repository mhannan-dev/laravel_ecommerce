<?php
namespace App\Http\Middleware;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/sadmin/check-current-pwd",
        "/sadmin/check-shipping-area",
        "/sadmin/update-shipping-charge-status",
        "/sadmin/update-section-status",
        "/sadmin/update-category-status",
        "/sadmin/append-category-level",
        "/sadmin/update-product-status",
        "/sadmin/update-attribute-status",
        "/sadmin/update-attribute-status",
        "/sadmin/update-image-status",
        "/sadmin/update-brand-status",
        "/sadmin/update-banner-status",
        "/sadmin/update-coupon-status",
        "/sadmin/update-user-status"
    ];
}
