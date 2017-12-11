<?php
namespace app\home\controller;
use houdunwang\core\Controller;
use houdunwang\model\Model;
use houdunwang\view\View;
use system\model\Student;
class Index extends Controller
{
	//public function index ()
	//{
	//
	//	(new View())->make(1,2);
	//	//第二步
	//	$a = 10;
	//	$data = ['name'=>'河北','age'=>500];
	//	//(new View())->make();
	//	//(new View())->with(compact ('data','a'));
	//	//p();die;
	//	//View::make()->with(compact ('data'));
	//	//return 11111;
	//	//return View::with(compact ('data','a'))->make();
	//	 //View::make()->with(compact ('data','a'));
	//	//return 11585;
	//	//return 1;
	//	//第三步*************************
	//	//测试获取数据库数据
	//	$res = Model::q('select * from student where id=1');
	//	//$res = Model::e("delete from student where id=3");
	//	//p ($res);
	//
	//	/*********第四步：测试读取配置项数据************/
	//	//读取配置项数据
	//	//c    config
	//	$res = c('database');
	//	p($res);
	//	$res = c('database.driver');
	//	p($res);
	//
	//
	//}

	public function index(){
		//********测试模型中的方法*****
		//$res = Model::q('select * from student');
		//p ($res);
		//根据主键查找单一数据
		//获取学生表中id（主键）=1数据
		//p (123);
		//$data = Student::find(1);
		//p ($data);
		//$data = Student::field('age,sname')->find(5);
		//p($data);

		//添加where 条件查询
		//$data = Student::where("age=123")->first();
		//p ($data);

		//获取表所有数据
		//$data = Student::getAll();
		//p ($data);

		//查询年龄大于30的同学
		//$data = Student::where("age>100 and id<7")->getAll();
		//p ($data);

		//查询指定字段
		//$data = Student::where('age>50')->field("id")->getAll();
		//$data = Student::field("id")->where('age>10')->getAll();
		//$data = Student::getAll()->field("id")->where('age>10');
		//上句报错，getAll()应该放在最后，getAll()需要用到前面函数的返回值，链式操作，前面几个调用不分先后可以的
		//p ($data);

		//排序 order
		$data = Student::where('age>30')->order('age desc')->getAll();
		p ($data);

		//$data = Student::where('age>0')->order('age desc')->limit('5')->getAll();
		//两个参数怎么弄???limit(5)加引号limit('5')作为一个整体就行了
		//p ($data);

		//分组  group by
		//$data = Student::group('sid')->getAll();
		//p ($data);

		//insert  写入数据
		//$data = [
		//	'age'=>6,
		//	'sname'=>'dada',
		//	'sex'=>'nan'
		//];
		//Student::insert($data);

		//update  修改数据
		//$data = [
		//	'age'=>2,
		//	'sname'=>'xiao',
		//	'sex'=>'nv'
		//];
		//$res = Student::where('id=8')->update($data);
		//p ($res);

		//delete  删除
		//Student::where('id=4')->delete();








	}



	//public function add ()
	//{
	//	View::make();
	//}
}

