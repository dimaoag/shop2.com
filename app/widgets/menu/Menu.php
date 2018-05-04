<?php
namespace app\widgets\menu;


use shop2\App;
use shop2\Cache;

class Menu
{
    protected $data;
    protected $tree;
    protected $menuHtml;
    protected $tpl;  // layout menu
    protected $container = 'ul';
    protected $class = 'menu';
    protected $table = 'category';
    protected $cache = 3600;
    protected $cacheKey = 'shop2_menu';
    protected $attributes = [];
    protected $prepend = '';



    public function __construct($options = []){
        $this->tpl = __DIR__ . '/menu_tpl/menu.php';
        $this->getOptions($options);
        $this->run();
    }

    protected function getOptions($options){
        foreach ($options as $key => $value){
            if (property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }

    protected function run(){
        $cache = Cache::instance();
        $this->menuHtml = $cache->get($this->cacheKey);
        if (!$this->menuHtml){
            $this->data = App::$app->getProperty('categories');
            if (!$this->data){
                $this->data = $categories =  \R::getAssoc("SELECT * FROM {$this->table}");
            }
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
            if ($this->cache){
                $cache->set($this->cacheKey, $this->menuHtml, $this->cache);
            }
        }
        $this->output();
    }



    protected function output(){
        $attributes = '';
        if (!empty($this->attributes)){
            foreach ($this->attributes as $key => $value){
                $attributes .= " $key='$value' ";
            }
        }

        echo "<{$this->container} class='{$this->class}' $attributes>";
            echo $this->prepend;
            echo $this->menuHtml;
        echo "</{$this->container}>";
    }


    /**
     * @return array
     */
    protected function getTree(){
        $tree = [];
        $data = $this->data;
        foreach ($data as $id => &$node){
            if (!$node['parent_id']){
                $tree[$id] = &$node;
            } else {
                $data[$node['parent_id']]['child'][$id] = &$node;
            }
        }
        return $tree;
    }


    /**
     * @param $tree
     * @param string $tab
     * @return string
     */
    protected function getMenuHtml($tree, $tab = ''){
        $str = '';
        foreach ($tree as $id => $category){
            $str .= $this->categoryToTemplate($category, $tab, $id);
        }
        return $str;
    }

    /**
     * @param $category
     * @param $tab
     * @param $id
     * @return string
     */
    protected function categoryToTemplate($category, $tab, $id){
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }


}