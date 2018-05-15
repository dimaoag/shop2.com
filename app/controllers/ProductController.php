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

        // запись в куки запрошеного товара

        // viewed products

        // gallery images for product

        // modifications of product

        $this->setMeta($product->title, $product->description, $product->keywords);
        $this->setData(compact('product'));
    }
}