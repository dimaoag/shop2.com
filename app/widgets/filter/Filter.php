<?php
namespace app\widgets\filter;


use shop2\Cache;

class Filter {

    public $groups;
    public $attributes;
    public $tpl; // template
    public $filter;



    public function __construct($filter = null, $tpl = null) {
        $this->filter = $filter;
        $this->tpl = $tpl ? $tpl : __DIR__ . '/filter_tpl/filter_view.php';
        $this->run();
    }


    protected function run(){
        $cache = Cache::instance();

        $this->groups = $cache->get('filter_groups');
        if (!$this->groups){
            $this->groups = $this->getGroups();
            $cache->set('filter_groups', $this->groups);
        }

        $this->attributes = $cache->get('filter_attributes');
        if (!$this->attributes){
            $this->attributes = self::getAttributes();
            $cache->set('filter_attributes', $this->attributes);
        }
        $filters = $this->getHtml();
        echo $filters;
    }


    /**
     * @return string
     */
    protected function getHtml(){
        ob_start();
        $filter = self::getFilter();
        if (!empty($filter)){
            $filter = explode(',', $filter);
        }
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
    public static function getAttributes(){
        $data = \R::getAssoc('SELECT * FROM attribute_value');
        $attributes = [];
        foreach ($data as $key => $value){
            $attributes[$value['attr_group_id']][$key] = $value['value'];
        }
        return $attributes;
    }


    /**
     * @return null|string|string[]
     */
    public static function getFilter(){
        $filter = null;
        if (!empty($_GET['filter'])){
            $filter = preg_replace("#[^\d,]+#", '', $_GET['filter']); //replace all without numbers and coma.
            $filter = trim($filter, ',');
        }
        return $filter;
    }


    /**
     * @param $filter
     * @return int
     */
    public static function getCountGroups($filter){
        $filters = explode(',', $filter);
        $cache = Cache::instance();
        $attributes = $cache->get('filter_attributes');
        if (!$attributes){
            $attributes = self::getAttributes();
        }
        $data = [];
        foreach ($attributes as $key => $item){
            foreach ($item as $k => $v){
                if (in_array($k, $filters)){
                    $data[] = $key;
                    break;
                }
            }
        }
        return count($data);
    }



}