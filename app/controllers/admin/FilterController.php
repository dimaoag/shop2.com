<?php
namespace app\controllers\admin;


use app\models\admin\FilterAttr;
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



    public function groupEditAction(){
        if (!empty($_POST)){
            $id = $this->getRequestId(false);
            $group = new FilterGroup();
            $data = $_POST;
            $group->load($data);
            if (!$group->validate($data)){
                $group->getErrors();
                redirect();
            }
            if ($group->update('attribute_group', $id)){
                $_SESSION['success'] = 'Success. Attribute updated!';
            }
            redirect();
        }
        $id = $this->getRequestId();
        $group = \R::load('attribute_group', $id);
        $this->setMeta("Edit $group->title");
        $this->setData(compact('group'));
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
        $attrs= \R::getAssoc("SELECT attribute_value.*, attribute_group.title FROM attribute_value JOIN attribute_group ON attribute_value.attr_group_id = attribute_group.id");
        $this->setMeta('Attributes');
        $this->setData(compact('attrs'));
    }




    public function attributeAddAction(){
        if (!empty($_POST)){
            $attribute = new FilterAttr();
            $data = $_POST;
            $attribute->load($data);
            if (!$attribute->validate($data)){
                $attribute->getErrors();
                redirect();
            }
            if ($attribute->save('attribute_value', false)){
                $_SESSION['success'] = 'Success. Attribute created!';
            }
            redirect();
        }
        $groups = \R::findAll('attribute_group');
        $this->setMeta('Add new attribute');
        $this->setData(compact('groups'));
    }


    public function attributeEditAction(){
        if (!empty($_POST)){
            $id = $this->getRequestId(false);
            $attribute = new FilterAttr();
            $data = $_POST;
            $attribute->load($data);
            if (!$attribute->validate($data)){
                $attribute->getErrors();
                redirect();
            }
            if ($attribute->update('attribute_value', $id)){
                $_SESSION['success'] = 'Success. Attribute updated!';
            }
            redirect();
        }
        $id = $this->getRequestId();
        $attribute = \R::load('attribute_value', $id);
        $groups = \R::findAll('attribute_group');
        $this->setMeta("Edit $attribute->value");
        $this->setData(compact('groups', 'attribute'));
    }



    public function attributeDeleteAction(){
        $id = $this->getRequestId();
        \R::exec("DELETE FROM attribute_value WHERE id = ?", [$id]);
        \R::exec("DELETE FROM attribute_product WHERE attr_id = ?", [$id]);
        $_SESSION['success'] = 'Success. Attribute is deleted.';
        redirect();
    }




}