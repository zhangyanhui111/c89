<?php

namespace houdunwang\core;
class Controller{
    private $url;
    public function message($msg){
        include './view/message.php';
    }
    public function setRedirect($url = ''){
        if($url){
            //说明指定了跳转地址
            $this->url = "location.href='$url'";
        }else{
            //说明没有给跳转地址，默认back
            $this->url  = "window.history.back()";
        }
        return $this;
    }
}