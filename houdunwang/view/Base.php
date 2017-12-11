<?php
namespace houdunwang\view;

class Base{
	//$data,$file声明成属性，下边就可以给属性赋值
	private $data = [];//存储变量
	private $file = '';//模板文件
	public function make(){//显示模板

		//p(MODULE);
		//p(CONTROLLER);
		//p(ACTION);
		//extract ($this->data);
		//从public引入的，所以路径从public开始算
		//include '../app/home/view/index/index.html';
		//include '../app/'.MODULE.'/view/'.strtolower (CONTROLLER).'/'.ACTION.'.php';
		$this->file =  '../app/'.MODULE.'/view/'.strtolower (CONTROLLER).'/'.ACTION.'.php' ;
		//p ($this->file);die;

		return $this;
	}
	public function with($var=[]){//分配变量，为了模板能使用
		//p ($var);
		$this->data = $var;//给属性赋值
		//p ($this->data);//空数组，因为$var=[]
		//extract ($this->data) ;

		//p ($a);
		return $this;
	}
	public function __toString ()
	{
		//p ($this->data);
		//echo 121555553;
		extract ($this->data);
		include $this->file;
		return '';//写return，要不报错
	}

}