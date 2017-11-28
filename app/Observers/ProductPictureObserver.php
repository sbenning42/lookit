<?php

namespace App\Observers;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Product;
use App\ProductPicture;
use App\DataAccess\ProductPictureDataAccess;

class ProductPictureObserver
{
    public static $createdErrorMsg = '::: ProductPictureObserver@created:  ::: ';
    public static $deletingErrorMsg = '::: ProductPictureObserver@deleting:  ::: ';

    /**
     * 
     */
    private function _orderProductPicturesFor(Product $product) {
        $order = 0;
        foreach ($product->pictures as $picture) {
            if ($order !== $picture->order) {
                $picture->order = $order;
                $picture->unsetEventDispatcher();
                $picture->save();
            }
            $order += 1;
        }
    }

    /**
     * 
     */
    private function _reOrderProductPicturesFor(ProductPicture $productPicture, Product $product) {
        Log::info('Updating ppicture ' . $productPicture->id . ' setting its order to ' . $productPicture->order . ' was ' . $productPicture->getOriginal()['order']);
        if ($productPicture->order === $productPicture->getOriginal()['order']) {
            return ;
        }
        foreach ($product->pictures as $picture) {
            if ($picture->order === $productPicture->order) {
                $picture->order = $productPicture->getOriginal()['order'];
                $picture->unsetEventDispatcher();
                $picture->save();
                break ;
            }
        }
    }

    /**
     * Listen to the ProductPicture created event.
     *
     * @param  \App\ProductPicture  $productPicture
     * @return void
     */
    public function created(ProductPicture $productPicture)
    {
        $this->_orderProductPicturesFor($productPicture->product);
    }

    /**
     * Listen to the ProductPicture updating event.
     *
     * @param  \App\ProductPicture  $productPicture
     * @return void
     */
    public function updating(ProductPicture $productPicture)
    {
        $this->_reOrderProductPicturesFor($productPicture, $productPicture->product);
    }

    /**
     * Listen to the Product deleting event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function deleted(ProductPicture $productPicture)
    {
        $this->_orderProductPicturesFor($productPicture->product);
    }
}