<?php
namespace app\controllers;


class ProductController extends AppController
{
    public function viewAction(){
        $alias = $this->route['alias'];
        $product = \R::findOne('product', "alias = ? AND status = '1'", [$alias]);
        if (!$product){
            throw new \Exception('Product not found', 404);
        }

        // breadcrumbs

        // related products
        $relatedProducts = \R::getAll("SELECT * FROM related_product JOIN product ON product.id = related_product.related_id WHERE related_product.product_id = ?", [$product->id]);
        // запись в куки запрошеного товара

        // viewed products

        // gallery images for product
        $gallery = \R::findAll('gallery', 'product_id = ?', [$product->id]);
        // modifications of product

        $this->setMeta($product->title, $product->description, $product->keywords);
        $this->setData(compact('product', 'relatedProducts', 'gallery'));
    }
}