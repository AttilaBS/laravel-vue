<?php

namespace App\Observers;

use App\Helpers\CleaUserCache;
use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        app(CleaUserCache::class)($product->owner_id);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        app(CleaUserCache::class)($product->owner_id);
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        app(CleaUserCache::class)($product->owner_id);
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        app(CleaUserCache::class)($product->owner_id);
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        app(CleaUserCache::class)($product->owner_id);
    }
}
