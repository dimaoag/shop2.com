<?php
namespace app\controllers\admin;


use shop2\Cache;

class CacheController extends AdminController {

    public function indexAction(){

        $this->setMeta('Clear cache');
    }

    public function deleteAction(){
        $key = isset($_GET['key']) ? $_GET['key'] : null;
        $cache = Cache::instance();

        switch ($key){
            case 'category':
                $cache->delete('categories');  //app/controllers/AppController;
                $cache->delete('shop2_menu');  //widgets/menu/Menu.php;
                break;
            case 'filter':
                $cache->delete('filter_groups');  //widgets/filter/Filter.php;
                $cache->delete('filter_attributes');  //widgets/filter/Filter.php;
                break;
        }
        $_SESSION['success'] = 'Chosen cache is deleted';
        redirect();
    }
}