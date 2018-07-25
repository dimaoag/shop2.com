<?php
namespace app\controllers\admin;


use app\models\admin\Product;
use shop2\App;
use shop2\libs\Pagination;
use app\models\AppModel;

class ProductController extends AdminController {

    public function indexAction(){
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perpage = 20;
        $count = \R::count('product');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        // with join 2 in 1
        $products = \R::getAll("SELECT product.*, category.title as title_category FROM product JOIN category ON product.category_id = category.id ORDER BY product.title LIMIT $start, $perpage");

        $this->setMeta('All products');
        $this->setData(compact('products', 'count', 'pagination'));
    }


    public function addAction(){
        if (!empty($_POST)){
            $product = new Product();
            $data = $_POST;
            $product->load($data);
            $product->attributes['status'] = $product->attributes['status'] ? '1' : '0';
            $product->attributes['hit'] = $product->attributes['hit'] ? '1' : '0';
            $product->getImg();
            if (!$product->attributes['old_price']) $product->attributes['old_price'] = '0';

            if (!$product->validate($data)){
                $product->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            }
            if ($id = $product->save('product')){
                $product->saveGallery($id);
                $alias = AppModel::createAlias('product', 'alias', $data['title'], $id);
                $prod = \R::load('product', $id);
                $prod->alias = $alias;
                \R::store($prod);
                $product->editFilter($id, $data);
                $product->editRelatedProducts($id, $data);
                if (!empty($data['mod'])){
                    /*
                      [mod] => Array
                        (
                            [0] => red_25
                            [1] => green_30
                            [2] => black_15
                        )
                    */
                    $product->editModificationProduct($id, $data['mod']);
                }




                $_SESSION['success'] =  'Product is created';



            }
            redirect();
        }

        $brands = \R::getAssoc( 'SELECT id, title FROM brand' );

        $this->setMeta('Add new product');
        $this->setData(compact('brands'));

    }


    public function relatedProductAction(){
        /*$data = [
            'items' => [
                [
                    'id' => 1,
                    'text' => 'Товар 1',
                ],
                [
                    'id' => 2,
                    'text' => 'Товар 2',
                ],
            ]
        ];*/

        $q = isset($_GET['q']) ? $_GET['q'] : '';

        $data['items'] = [];
        $products = \R::getAssoc('SELECT id, title FROM product WHERE title LIKE ? LIMIT 10', ["%{$q}%"]);
        if($products){
            $i = 0;
            foreach($products as $id => $title){
                $data['items'][$i]['id'] = $id;
                $data['items'][$i]['text'] = $title;
                $i++;
            }
        }
        echo json_encode($data);
        die;
    }

    public function addImageAction(){
        if (isset($_GET['upload'])){
            if ($_POST['name'] == 'single'){
                //single
                $wmax = App::$app->getProperty('img_width');
                $hmax = App::$app->getProperty('img_height');
                $name = $_POST['name'];

                $product = new Product();
                $product->uploadImg($name, $wmax, $hmax);


            } else {
                //multi
                $wmax = App::$app->getProperty('gallery_with');
                $hmax = App::$app->getProperty('gallery_height');
                $name = $_POST['name'];

                $product = new Product();
                $product->uploadImg($name, $wmax, $hmax);

            }
        }
    }



}