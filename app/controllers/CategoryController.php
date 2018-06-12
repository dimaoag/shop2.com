<?php
namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Category;
use app\widgets\filter\Filter;
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

        $sql_filter = '';
        if (!empty($_GET['filter'])){
            $filter = Filter::getFilter();
            $sql_filter = "AND id IN (SELECT product_id FROM attribute_product WHERE attr_id IN ($filter))";
        }

        $total = \R::count('product', "category_id IN ($catogoryChildren) $sql_filter");
        $paginationObj = new Pagination($page, $perpage, $total);
        $pagination  = $paginationObj->getHtml();
        $start = $paginationObj->getStart();
        $isPagination = ($perpage <= $total) ? true : false;

        $products = \R::find('product', "category_id IN ($catogoryChildren) $sql_filter LIMIT $start, $perpage");

        if ($this->isAjax()){
            $this->loadView('filter_view', compact('products', 'pagination', 'isPagination'));

        }

        $this->setMeta($category->title, $category->description, $category->keywords);
        $this->setData(compact('products', 'breadcrumbs', 'pagination', 'isPagination'));
    }
}