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

    public function viewAction(){

        $order_id = $this->getRequestId();
        $order = \R::getRow("SELECT `order`.`*`, `user`.`name`, ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order` JOIN `user` ON `order`. `user_id` = `user`.`id` JOIN `order_product` ON `order`.`id` = `order_product`.`order_id` WHERE `order`.`id` = ? GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT 1", [$order_id]);

        if (!$order){
            throw new \Exception('Page not found', 404);
        }


        $order_products = \R::findAll('order_product', 'order_id = ?', [$order_id]);

        $quantity = null;

        foreach ($order_products as $item => $product){
            $quantity += $product['qty'];
        }

        $this->setMeta("Order № {$order_id}");
        $this->setData(compact('order', 'order_products', 'quantity'));
    }

    public function changeAction(){
        $order_id = $this->getRequestId();
        $status = !empty($_GET['status']) ? '1' : '0';
        $order = \R::load('order', $order_id);

        if (!$order){
            throw new \Exception('Page not found', 404);
        }

        $order->status = $status;
        $order->update_at = date('Y-m-d H:i:s');
        $id = \R::store($order);
        $_SESSION['success'] = 'The change is saved';
        redirect();
    }


    public function deleteAction(){
        $order_id = $this->getRequestId();
        $order = \R::load('order', $order_id);
        \R::trash($order);
        $_SESSION['success'] = "Order № $order_id deleted";
        redirect(ADMIN . '/order');
    }



}