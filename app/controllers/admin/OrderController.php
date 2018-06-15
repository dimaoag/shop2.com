<?php
namespace app\controllers\admin;


use shop2\libs\Pagination;

class OrderController extends AdminController {

    public function indexAction(){

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perpage = 2;
        $count = \R::count('order');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $orders = \R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`, `order`.`date`, `order`.`update_at`, `order`.`currency`, `user`.`name`, ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order` JOIN `user` ON `order`. `user_id` = `user`.`id` JOIN `order_product` ON `order`.`id` = `order_product`.`order_id` GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT $start, $perpage");

        $this->setMeta('All Orders');
        $this->setData(compact('orders', 'pagination', 'count'));
    }
}