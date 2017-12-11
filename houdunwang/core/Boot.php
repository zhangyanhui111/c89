<?php

namespace houdunwang\core;

use app\home\controller\Index;
use app\home\controller\Aaa;
use app\member\controller\Bbb;

class Boot
{
	public static function run ()
	{
		//        echo 'run sdffsdf';//测试用
		//        p(123456);测试用
		//补充：函数默认调用当前空间的函数，如果当前空间没有，那么会往跟空间找该函数
		self::init ();
		//        (new Index)->Index();
		//        (new Aaa)->index();
		//        (new Aaa)->add();
		//        (new Bbb)->index();
		//通过get参数来控制访问的模块、控制器类、方法： ·
		//这里get参数样子换种写法：?s=模块/控制器/方法(?s=home/Index/index),我们按照这种方式来处理
		//先用?s=home/Index/index试试
		//        p($_GET['s']);
		if ( isset( $_GET[ 's' ] ) ) {//判断是否有get参数
			$s = $_GET[ 's' ];
			//            把字符串分成数组
			$info = explode ( '/' , $s );
			//            p($info);
			//把得到的三个单词（目录）分给变量$m,$c,$a
			$m = $info[ 0 ];
			$c = ucfirst ( $info[ 1 ] );//类首字母大写
			$a = $info[ 2 ];
		} else {
			//没有参数时给默认值
			$m = 'home';
			$c = 'Index';
			$a = 'index';
		}
		//定义常量,为了在后面是使用的时候比较方便，因为define定义的常量可以不受命名空间限制
		//现在没用到，以后会用
		define ( 'MODULE' , $m );
		define ( 'CONTROLLER' , $c );
		define ( 'ACTION' , $a );
		//拼字符串
		$controller = "\app\\{$m}\controller\\{$c}";
		//        ( new $controller ) -> $a ();
		//        (new \app\home\controller\Index)->index();
		//这句话跟上边一句一样，写法不同,这里echo对象才能触发__tostring
		echo call_user_func_array ( [ new $controller , $a ] , [] );
		//接下来在app/home/controller/Index.php文件中进行测试


	}


	//初始化框架，就是把可能用到的东西设置好
	public static function init ()
	{
		//1.头部
		header ( 'Content-type:text/html;charset=utf8' );
		//2.设置时区
		date_default_timezone_set ( 'PRC' );
		//3.开启session,短路写法
		session_id () || session_start ();
	}
}




