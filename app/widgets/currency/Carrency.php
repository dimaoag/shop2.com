<?php
namespace app\widgets\currency;


use shop2\App;

class Currency
{
    protected $tpl;  //шаблон вывода валюты
    protected $currencies;
    protected $currency;

    public function __construct()
    {
        $this->tpl = __DIR__ . '/currency_tpl/currency.php';
        $this->run();
    }

    //ss
    protected function run(){
        $this->currencies = App::$app->getProperty('currencies');
        $this->currency = App::$app->getProperty('currency');

        echo $this->getHtml();
    }

    /**
     * @return array
     */
    public static function getCurrencies(){
        return \R::getAssoc("SELECT code, title, symbol_left, symbol_right, value, base FROM currency ORDER BY base DESC");
    }


    /**
     * @param $currencies
     * @return mixed
     */
    public static function getCurrency($currencies){
        if (isset($_COOKIE['currency']) && array_key_exists($_COOKIE['currency'], $currencies)){
            $key = $_COOKIE['currency'];
        } else {
            $key = key($currencies); //current element of array; will be first element (USD);
        }
        $currency = $currencies[$key];
        $currency['code'] = $key;
        return $currency;
    }


    /**
     * @return string
     */
    protected function getHtml(){
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }

}