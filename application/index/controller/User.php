<?php
namespace app\index\controller;

class User extends Base {

    protected function initialize(){
        parent::initialize();
    }

    public function login(){

        return $this->fetch('index',[
        ]);
    }

    public function logout(){
        session(null);
        cookie(null);
        $this->redirect('index/index');
    }
}