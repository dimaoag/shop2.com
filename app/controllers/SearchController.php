<?php
namespace app\controllers;


use shop2\App;
use shop2\libs\Pagination;

class SearchController extends AppController {

    public function typeaheadAction(){
        if ($this->isAjax()){
            $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
            if ($query){
                $products = \R::getAll('SELECT id, title FROM product WHERE title LIKE ? LIMIT 10', ["%{$query}%"]);
            }
            echo json_encode($products);
        }
        die();
    }

    public function indexAction(){
        $query = !empty(trim($_GET['s'])) ? trim($_GET['s']) : null;


        if ($query){
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = App::$app->getProperty('pagination');
            $total = \R::count('product', 'title LIKE ?', ["%{$query}%"]);
            $paginationObj = new Pagination($page, $perpage, $total);
            $pagination  = $paginationObj->getHtml();
            $start = $paginationObj->getStart();
            $isPagination = ($perpage <= $total) ? true : false;


            $products = \R::find('product', 'title LIKE ? LIMIT ?, ?', ["%{$query}%", $start, $perpage]);
        }




        $this->setMeta('Search by: ' . htmlSpecialCharsWrapper($query));
        $this->setData(compact('products', 'query', 'pagination', 'isPagination'));
    }




}