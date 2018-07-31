<?php
namespace app\models;


use shop2\App;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Order extends AppModel {


    /**
     * @param $data
     * @return int|string
     */
    public static function saveOrder($data){
        $order = \R::dispense('order');
        $order->user_id = $data['user_id'];
        $order->note = $data['note'];
        $order->sum = $_SESSION['cart_sum'];
        $order->currency = $_SESSION['cart_currency']['code'];
        $id = \R::store($order);
        self::saveOrderProduct($id);
        return $id;

    }



    public static function saveOrderProduct($order_id){
        $sql_paste = '';
        foreach ($_SESSION['cart'] as $product_id => $product){
            $product_id = (int)$product_id;
            $sql_paste .= "($order_id, $product_id, {$product['qty']}, '{$product['title']}', {$product['price']}),";

        }
        $sql_paste = rtrim($sql_paste, ',');
        \R::exec("INSERT INTO order_product (order_id, product_id, qty, title, price) VALUES $sql_paste");
    }

    public static function mailOrder($order_id, $user_email){

        try {
            // Create the Transport
            $transport = (new Swift_SmtpTransport(App::$app->getProperty('smtp_host'), App::$app->getProperty('smtp_port'), App::$app->getProperty('smtp_protocol')))
                ->setUsername(App::$app->getProperty('smtp_login'))
                ->setPassword(App::$app->getProperty('smtp_password'))
            ;
            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);
            // Create a message
            ob_start();
            require APP . '/widgets/mail/mail_layout.php';
            $body = ob_get_clean();
            $subject = "Order № $order_id on " . App::$app->getProperty('shop_name');
            $messageToUser = (new Swift_Message($subject))
                ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
                ->setTo($user_email)
                ->setBody($body, 'text/html')
            ;
            $messageToAdmin = (new Swift_Message("Order № $order_id from {$_SESSION['user']['name']}"))
                ->setFrom([App::$app->getProperty('smtp_login') => $_SESSION['user']['name']])
                ->setTo(App::$app->getProperty('admin_email'))
                ->setBody($body, 'text/html')
            ;
            // Send the message
            $result = $mailer->send($messageToUser);
            $result = $mailer->send($messageToAdmin);

        } catch (\Exception $e){

        }


        unset($_SESSION['cart']);
        unset($_SESSION['cart_qty']);
        unset($_SESSION['cart_sum']);
        unset($_SESSION['cart_currency']);
        $_SESSION['success'] = 'Success! Thanks for your order. You will be contacted by the manager in the near future.';
    }

}