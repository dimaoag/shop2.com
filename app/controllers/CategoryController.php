<?php
namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Category;

class CategoryController extends AppController {

    public function viewAction(){
        $alias = $this->route['alias'];
        $category = \R::findOne('category', 'alias = ?', [$alias]);
        if (!$category){
            throw new \Exception('Page not found', 404);
        }

        // breadcrumbs
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id);


        $categoryModel = new Category();
        $catogoryChildren = $categoryModel->getCategoryChildren($category->id);
        $catogoryChildren = !$catogoryChildren ? $category->id : $catogoryChildren . $category->id;

        $products = \R::find('product', "category_id IN ($catogoryChildren)");

        $this->setMeta($category->title, $category->description, $category->keywords);
        $this->setData(compact('products', 'breadcrumbs'));
    }
}