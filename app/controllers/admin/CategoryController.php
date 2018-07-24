<?php
namespace app\controllers\admin;


use app\models\AppModel;
use app\models\Category;
use shop2\App;

class CategoryController extends AdminController {

    public function indexAction(){


        $this->setMeta('Categories');
    }


    public function deleteAction(){
        $id = $this->getRequestId();

        $children = \R::count('category', 'parent_id = ?', [$id]);
        $errors = '';
        if ($children){
            $errors .= '<li>Delete is impossible. This category has nested categories.</li>';
        }

        $products = \R::count('product', 'category_id = ?', [$id]);
        if ($products){
            $errors .= '<li>Delete is impossible. This category has products.</li>';
        }
        if ($errors){
            $_SESSION['errors'] = "<ul>$errors</ul>";
            redirect();
        }

        $category = \R::load('category', $id);
        \R::trash($category);
        $_SESSION['success'] = 'Category is deleted';
        redirect();
    }

    public function addAction(){
        if (!empty($_POST)){
            $category = new Category();
            $data = $_POST;
            $category->load($data);
            if (!$category->validate($data)){
                $category->getErrors();
                redirect();
            }
            if ($id = $category->save('category')){
                $alias = AppModel::createAlias('category', 'alias', $data['title'], $id);
                $cat = \R::load('category', $id);
                $cat->alias = $alias;
                \R::store($cat);
                $_SESSION['success'] = 'Category added';
            }
            redirect();
        }

        $this->setMeta('New category');
    }

    public function editAction(){
        if (!empty($_POST)){
            $id = $this->getRequestId(false);
            $category = new Category();
            $data = $_POST;
            $category->load($data);
            if (!$category->validate($data)){
                $category->getErrors();
                redirect();
            }
            if ($category->update('category', $id)){
                $alias = AppModel::createAlias('category', 'alias', $data['title'], $id);
                $category = \R::load('category', $id);
                $category->alias = $alias;
                \R::store($category);
                $_SESSION['success'] = 'Changes saved';
            }
            redirect();
        }

        $id = $this->getRequestId();
        $category = \R::load('category', $id);
        App::$app->setProperty('parent_id', $category->parent_id);


        $this->setData(compact('category'));
        $this->setMeta("Edit category {$category->title}");
    }


}