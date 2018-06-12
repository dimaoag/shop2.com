<?php
namespace app\widgets\filter;


use shop2\Cache;

class Filter {

    public $groups;
    public $attributes;
    public $tpl;



    public function __construct() {
        $this->tpl = __DIR__ . '/filter_tpl/filter_view.php';
        $this->run();
    }


    protected function run(){
        $cache = Cache::instance();

        $this->groups = $cache->get('filter_groups');
        if (!$this->groups){
            $this->groups = $this->getGroups();
            $cache->set('filter_groups', $this->groups, 5);
        }

        $this->attributes = $cache->get('filter_attributes');
        if (!$this->attributes){
            $this->attributes = $this->getAttributes();
            $cache->set('filter_attributes', $this->attributes, 5);
        }
        $filters = $this->getHtml();
        echo $filters;
    }


    /**
     * @return string
     */
    protected function getHtml(){
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }

    /**
     * @return array
     */
    protected function getGroups(){
        $groups = \R::getAssoc('SELECT id, title FROM attribute_group');
        return $groups;
    }



    /**
     * @return array
     */
    protected function getAttributes(){
        $data = \R::getAssoc('SELECT * FROM attribute_value');
        $attributes = [];
        foreach ($data as $key => $value){
            $attributes[$value['attr_group_id']][$key] = $value['value'];
        }
        return $attributes;
    }

}