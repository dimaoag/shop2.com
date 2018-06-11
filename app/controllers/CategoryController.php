<?php
namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Category;
use shop2\App;
use shop2\libs\Pagination;

class CategoryController extends AppController {

    public function viewAction(){
        $alias = $this->route['alias'];
        $category = \R::findOne('category', 'alias = ?', [$alias]);
        if (!$category){
            throw new \Exception('Page not found', 404);
        }

        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id);


        $categoryModel = new Category();
        $catogoryChildren = $categoryModel->getCategoryChildren($category->id);
        $catogoryChildren = !$catogoryChildren ? $category->id : $catogoryChildren . $category->id;


        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = App::$app->getProperty('pagination');
        $total = \R::count('product', "category_id IN ($catogoryChildren)");
        $paginationObj = new Pagination($page, $perpage, $total);
        $pagination  = $paginationObj->getHtml();
        $start = $paginationObj->getStart();
        $isPagination = ($perpage <= $total) ? true : false;

        $products = \R::find('product', "category_id IN ($catogoryChildren) LIMIT $start, $perpage");


        $this->setMeta($category->title, $category->description, $category->keywords);
        $this->setData(compact('products', 'breadcrumbs', 'pagination', 'isPagination'));
    }
}