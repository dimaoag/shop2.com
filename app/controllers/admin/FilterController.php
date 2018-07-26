<?php
namespace app\controllers\admin;


use app\models\admin\FilterGroup;

class FilterController extends AdminController {

    public function attributeGroupAction(){
        $attr_groups = \R::findAll('attribute_group');


        $this->setData('Groups of filters');
        $this->setData(compact('attr_groups'));
    }


    public function groupAddAction(){
        if (!empty($_POST)){
            $group = new FilterGroup();
            $data = $_POST;
            $group->load($data);
            if (!$group->validate($data)){
                $group->getErrors();
                redirect();
            }
            if ($group->save('attribute_group', false)){
                $_SESSION['success'] = 'Success. Group created!';
            }
            redirect();
        }
        $this->setMeta('New group filters');
    }



    public function groupDeleteAction(){

        $id = $this->getRequestId();
        $count = \R::count('attribute_value', 'attr_group_id = ?', [$id]);
        if ($count){
            $_SESSION['errors'] = 'Error!. Group have are attributes.';
            redirect();
        }
        \R::exec("DELETE FROM attribute_group WHERE id = ?", [$id]);
        $_SESSION['success'] = 'Success. Group is deleted.';
        redirect();
    }





    public function attributeAction(){

        $this->setData('Filters');
    }


}