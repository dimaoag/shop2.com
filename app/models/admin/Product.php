<?php
namespace app\models\admin;

use app\models\AppModel;

class Product extends AppModel {

    public $attributes = [
        'title' => '',
        'category_id' => '',
        'keywords' => '',
        'description' => '',
        'price' => '',
        'old_price' => '',
        'content' => '',
        'status' => '',
        'hit' => '',
        'alias' => '',
        'brand_id' => '',

    ];


    public $rules = [
        'required' => [
            ['title'],
            ['category_id'],
            ['price'],
            ['brand_id'],
        ],
        'integer' => [
            ['category_id'],
            ['brand_id'],
        ],
        'lengthMin' => [
            ['title', 4],
        ],

    ];



    public function editFilter($id, $data){ //product id and data
        $filter = \R::getCol("SELECT attr_id FROM attribute_product WHERE product_id = ?", [$id]);

        //если менеджер убрал фильтры -> удаляем их (если релизовано checkbox)
        if (empty($data['attributes']) && !empty($filter)){
            //delete in table attributes
            \R::exec("DELETE FROM attribute_product WHERE product_id = ?", [$id]);
            return;
        }

        //если фильтры добавляются
        if (empty($filter) && !empty($data['attributes'])){
            $sql_values = '';
            foreach ($data['attributes'] as $value){
                $sql_values .= "($value, $id),";
            }
            $sql_values = rtrim($sql_values, ',');
            \R::exec("INSERT INTO attribute_product (attr_id, product_id) VALUES $sql_values");
            return;
        }

        //если фильтры изменились -> delete and insert new
        if (!empty($data['attributes'])){
            $result = array_diff($filter, $data['attributes']); //вернет разницу между масивами
            if (!$result){
                //delete
                \R::exec("DELETE FROM attribute_product WHERE product_id = ?", [$id]);

                //and insert new data
                $sql_values = '';
                foreach ($data['attributes'] as $value){
                    $sql_values .= "($value, $id),";
                }
                $sql_values = rtrim($sql_values, ',');
                \R::exec("INSERT INTO attribute_product (attr_id, product_id) VALUES $sql_values");
            }
            return;
        }
    }



    public function editRelatedProducts($id, $data){
        $relatedProducts = \R::getCol("SELECT related_id FROM related_product WHERE product_id = ?", [$id]);

        //если менеджер убрал связаные товары -> удаляем их
        if (empty($data['related']) && !empty($relatedProducts)){
            //delete in table attributes
            \R::exec("DELETE FROM related_product WHERE product_id = ?", [$id]);
            return;
        }

        //если связаные товары добавляются
        if (empty($filter) && !empty($data['related'])){
            $sql_values = '';
            foreach ($data['related'] as $value){
                $sql_values .= "($id, $value),";
            }
            $sql_values = rtrim($sql_values, ',');
            \R::exec("INSERT INTO related_product (product_id, related_id) VALUES $sql_values");
            return;
        }

        //если связаные товары изменились -> delete and insert new
        if (!empty($data['related'])){
            $result = array_diff($relatedProducts, $data['related']); //вернет разницу между масивами
            if (!empty($result) || count($relatedProducts) != count($data['related'])){
                //delete
                \R::exec("DELETE FROM related_product WHERE product_id = ?", [$id]);

                //and insert new data
                $sql_values = '';
                foreach ($data['related'] as $value){
                    $sql_values .= "($id, $value),";
                }
                $sql_values = rtrim($sql_values, ',');
                \R::exec("INSERT INTO related_product (product_id, related_id) VALUES $sql_values");
            }
            return;
        }


    }


}