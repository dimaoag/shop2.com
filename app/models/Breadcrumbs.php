<?php
namespace app\models;


use shop2\App;

class Breadcrumbs {


    /**
     * @param $category_id
     * @param string $name
     * @return array|bool
     */
    public static function getBreadcrumbs($category_id, $name = ''){
        $categories = App::$app->getProperty('categories');
        $breadcrumbs = self::getPath($categories, $category_id);
        return $breadcrumbs;
    }



    /**
     * @param $categories
     * @param $category_id
     * @return array|bool
     */
    public static function getPath($categories, $category_id){
        if (!$category_id){
            return false;
        }
        $breadcrumbs = [];
        foreach ($categories as $key => $value){
            if (isset($categories[$category_id])){
                $breadcrumbs[$categories[$category_id]['alias']] = $categories[$category_id]['title'];
                $category_id = $categories[$category_id]['parent_id'];
            } else {
                break;
            }
        }
        return array_reverse($breadcrumbs);
    }







}