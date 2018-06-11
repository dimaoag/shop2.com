<?php
namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Product;

class ProductController extends AppController
{
    public function viewAction(){
        $alias = $this->route['alias'];
        $productModel = new Product();

        // get product
        $product = $productModel->getProductByAlias($alias);
        if (!$product){
            throw new \Exception('Product not found', 404);
        }

        // запись в куки запрошеного товара
        $productModel->setRecentlyViewed($product->id);

        // breadcrumbs
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($product->category_id, $product->title);

        // related products
        $relatedProducts = $productModel->getRelatedProducts($product->id);

        // recently viewed products
        $recentlyViewed = $productModel->getRecentlyViewed();
        $recentlyViewedProducts = null;
        if ($recentlyViewed){
            $recentlyViewedProducts = $recentlyViewed;
        }

        // gallery images for product
        $gallery = $productModel->getGallery($product->id);

        // modifications of product
        $modProductByColor = $productModel->getModProductByColor($product->id);


        $this->setMeta($product->title, $product->description, $product->keywords);
        $this->setData(compact('product', 'relatedProducts', 'gallery', 'recentlyViewedProducts', 'breadcrumbs', 'modProductByColor'));
    }
}