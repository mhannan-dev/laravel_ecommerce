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
        "admin/settings/check-current-pwd",
        "/admin/catalogue/update-section-status",
        "/admin/catalogue/update-category-status",
        "/admin/catalogue/append-category-level",
        "/admin/catalogue/update-product-status",
        "/admin/catalogue/update-product-attr-status",
        "/admin/catalogue/update-product-image-status",
        "/admin/catalogue/update-brand-status",
        "/admin/site/update-banner-status"
    ];
}
