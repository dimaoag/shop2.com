<?php
namespace app\controllers\admin;


use app\models\admin\Currency;

class CurrencyController extends AdminController {

    public function indexAction(){
        $currencies = \R::findAll('currency');
        $this->setMeta('Currencies');
        $this->setData(compact('currencies'));
    }


    public function addAction(){
        if (!empty($_POST)){
            $currency = new Currency();
            $data = $_POST;
            $currency->load($data);
            $currency->attributes['base'] = $currency->attributes['base'] ? '1' : '0';
            if (!$currency->validate($data)){
                $currency->getErrors();
                redirect();
            }
            if ($currency->save('currency')){
                $_SESSION['success'] = 'Currency added!';
                redirect();
            }
        }
        $this->setMeta('Add currency');
    }


    public function editAction(){
        if (!empty($_POST)){
            $id = $this->getRequestId(false);
            $currency = new Currency();
            $data = $_POST;
            $currency->load($data);
            $currency->attributes['base'] = $currency->attributes['base'] ? '1' : '0';
            if (!$currency->validate($data)){
                $currency->getErrors();
                redirect();
            }
            if ($currency->update('currency', $id)){
                $_SESSION['success'] = 'Success. Currency updated!';
            }
            redirect();
        }
        $id = $this->getRequestId();
        $currency = \R::load('currency', $id);
        $this->setMeta("Edit $currency->title");
        $this->setData(compact('currency'));
    }



    public function deleteAction(){
        $id = $this->getRequestId();
        \R::exec("DELETE FROM currency WHERE id = ?", [$id]);
        $_SESSION['success'] = 'Success. Currency is deleted.';
        redirect();
    }
}