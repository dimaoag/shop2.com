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
            if ($result || count($filter) != count($data['attributes'])){
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


    /*
     [related] => Array
        (
            [0] => 3
            [1] => 5
            [2] => 6
        )
     */

    public function editRelatedProducts($id, $data){
        $relatedProducts = \R::getCol("SELECT related_id FROM related_product WHERE product_id = ?", [$id]);

        //если менеджер убрал связаные товары -> удаляем их
        if (empty($data['related']) && !empty($relatedProducts)){
            //delete in table attributes
            \R::exec("DELETE FROM related_product WHERE product_id = ?", [$id]);
            return;
        }

        //если связаные товары добавляются
        if (empty($relatedProducts) && !empty($data['related'])){
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

    public function editModificationProduct($id, $data){

        \R::exec("DELETE FROM modification WHERE product_id = ?", [$id]);

        if (empty($data)) return;

        $mod = [];
        foreach ($data as $key => $value){
            $arr = explode('_', $value);
            $mod[$key]['color'] = $arr[0];
            $mod[$key]['price'] = $arr[1];
        }
        $sql_values = '';
        foreach ($mod as $key => $value){
            $sql_values .= "($id,'" . $value['color'] ."'," . $value['price'] ."),";
        }
        $sql_values = rtrim($sql_values, ',');
        \R::exec("INSERT INTO modification (product_id, title, price) VALUES $sql_values");
        return;
    }




    public function getImg(){
        if (!empty($_SESSION['single'])){
            $this->attributes['img'] = $_SESSION['single'];
            unset($_SESSION['single']);
        }
    }

    public function saveGallery($id){
        if (!empty($_SESSION['multi'])){
            $sql_paste = '';
            foreach ($_SESSION['multi'] as $value){
                $sql_paste .= "($id, '$value'),";
            }
            $sql_paste = rtrim($sql_paste, ',');
            \R::exec("INSERT INTO gallery (product_id, img) VALUES $sql_paste");
            unset($_SESSION['multi']);
        }
    }

    public function uploadImg($name, $wmax, $hmax){
        $uploaddir = WWW . '/images/';
        $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$name]['name'])); // расширение картинки
        $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
        if($_FILES[$name]['size'] > 1048576){
            $res = array("error" => "Error! Max size of file - 1 Мб!");
            exit(json_encode($res));
        }
        if($_FILES[$name]['error']){
            $res = array("error" => "Error!. Maybe file's size very big!");
            exit(json_encode($res));
        }
        if(!in_array($_FILES[$name]['type'], $types)){
            $res = array("error" => "Enable extensions are:  .gif, .jpg, .png");
            exit(json_encode($res));
        }
        $new_name = md5(time()).".$ext";
        $uploadfile = $uploaddir.$new_name;
        if(@move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)){
            if($name == 'single'){
                $_SESSION['single'] = $new_name;
            }else{
                $_SESSION['multi'][] = $new_name;
            }
            self::resize($uploadfile, $uploadfile, $wmax, $hmax, $ext);
            $res = array("file" => $new_name);
            exit(json_encode($res));
        }
    }


    /**
     * @param string $target путь к оригинальному файлу
     * @param string $dest путь сохранения обработанного файла
     * @param string $wmax максимальная ширина
     * @param string $hmax максимальная высота
     * @param string $ext расширение файла
     */
    public static function resize($target, $dest, $wmax, $hmax, $ext){
        list($w_orig, $h_orig) = getimagesize($target);
        $ratio = $w_orig / $h_orig; // =1 - квадрат, <1 - альбомная, >1 - книжная

        if(($wmax / $hmax) > $ratio){
            $wmax = $hmax * $ratio;
        }else{
            $hmax = $wmax / $ratio;
        }

        $img = "";
        // imagecreatefromjpeg | imagecreatefromgif | imagecreatefrompng
        switch($ext){
            case("gif"):
                $img = imagecreatefromgif($target);
                break;
            case("png"):
                $img = imagecreatefrompng($target);
                break;
            default:
                $img = imagecreatefromjpeg($target);
        }
        $newImg = imagecreatetruecolor($wmax, $hmax); // создаем оболочку для новой картинки

        if($ext == "png"){
            imagesavealpha($newImg, true); // сохранение альфа канала
            $transPng = imagecolorallocatealpha($newImg,0,0,0,127); // добавляем прозрачность
            imagefill($newImg, 0, 0, $transPng); // заливка
        }

        imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig, $h_orig); // копируем и ресайзим изображение
        switch($ext){
            case("gif"):
                imagegif($newImg, $dest);
                break;
            case("png"):
                imagepng($newImg, $dest);
                break;
            default:
                imagejpeg($newImg, $dest);
        }
        imagedestroy($newImg);
    }



}