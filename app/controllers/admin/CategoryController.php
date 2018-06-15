<?php
namespace app\controllers\admin;


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


}