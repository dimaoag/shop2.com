<?php
namespace app\models;


use shop2\App;

class Category extends AppModel {


    public function getCategoryChildren($id){
        $categories = App::$app->getProperty('categories');
        $ids = null;
        foreach ($categories as $categoryId => $category){
            if ($category['parent_id'] == $id){
                $ids .= $categoryId . ',';
                $ids .= $this->getCategoryChildren($categoryId);
            }
        }
        return $ids;
    }

}