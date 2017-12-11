<?php
namespace houdunwang\model;

use Exception;
use PDO;

class Base{
	private static $pdo = null;
	protected $table;//数据表
	protected $where;//where条件
	protected $field = '';//指定查询字段
	protected $order;//排序
	protected $limit;//截取
	protected $group;//分组
	public function __construct ($class)
	{
		//获取数据表方式
		//$this->table = strtolower (ltrim (strrchr ($class,'\\'),'\\')) ;
		$info = explode ('\\',$class);
		$this->table = strtolower ($info[2]);
		//p ($this->table);
		//1.连接数据库
		if(is_null (self::$pdo)){
			$this->connect();
		}
	}
	private function connect(){
		try {
			$dsn        = c('database.driver').":host=".c('database.host').";dbname=".c('database.dbname');
			$user       = c('database.user');
			$password   = c('database.password');
			self ::$pdo = new PDO( $dsn , $user , $password );
			//设置错误属性
			self::$pdo->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			}catch(Exception $e){
			exit($e->getMessage ());
		}
	}

	/**
	 * @return mixed   查询所有数据
	 */
	public function getAll(){
		$this->field = $this->field ? : '*';
		//$sql = "select * from student";
		$sql = "select {$this->field} from {$this->table} {$this->where} {$this->order} {$this->group} {$this->limit}";
		//p ($sql);
		return $this->q($sql);
	}

	/**
	 * @param $order   排序
	 *
	 * @return $this
	 */
	public function order ($order){
		//p ($order);
		$this->order = 'order by ' . $order;//order by 后加空格
		//p ($this->order);
		return $this;
	}

	/**
	 * @param $group  group by 分组
	 *
	 * @return $this
	 */
	public function group ($group){
		//p ($group);
		$this->group = 'group by ' . $group; //group by 后加空格
		p ($this->group);
		return $this;
	}

	/**
	 * @param $limit   截取  limit
	 *
	 * @return $this
	 */
	public function limit ($limit){
		//p ($limit);
		//$this->limit = 'limit ' . $limit1 . ',' . "$limit2";
		$this->limit = 'limit ' . $limit;
		p ($this->limit);
		return $this;
	}

	/**
	 * @param $pk     根据主键查询
	 *
	 * @return mixed
	 */
	public function find($pk){
		//p ($this->table);
		//获取主键
		$priKey = $this->getPriKey();
		//p ($priKey);
		$this->field = $this->field ? :'*';//三元表达式写法
		//p ($this->field );
		//$sql = "select * from student where id=1";
		$sql = "select {$this->field} from {$this->table} where {$priKey}={$pk}";
		$res = $this->q($sql);
		return $res;
	}

	/**
	 * @return mixed   条件查询一条数据
	 */
	public function first (){
		//$sql = "select * from student where sex='男'";
		$this->field = $this->field ? :'*';
		$sql = "select {$this->field} from {$this->table} {$this->where }";
		$data = $this->q($sql);
		//p ($sql);
		return $data;
	}

	/**
	 * @param $where   where 条件
	 *
	 * @return $this
	 */
	public function where ($where){
		//p ($where);
		$this->where = 'where '.$where;//where 后加空格
		//p ($this->where );
		return $this;
	}

	/**
	 * @param $field   查找字段
	 *
	 * @return $this
	 */
	public function field ($field){
		//p ($field);
		$this->field = $field;
		return $this;
	}

	/**
	 * 获取主键名
	 * @return mixed
	 */
	public function getPriKey(){
		$sql = "desc {$this->table}";//desc后要有空格，妈的
		$res = $this->q($sql);
		//p ($res);
		foreach ($res as $k=>$v){
			if($v['Key']=='PRI'){
				$priKey = $v['Field'];
				break;
			}
		}
		return $priKey;
	}

	/**
	 * @param $data   添加数据
	 *
	 * @return mixed
	 */
	public function insert($data){
		//p ($data);
		$field = '';
		$value = '';
		foreach ($data as $k=>$v){
			$field .= $k . ',';//$field = $field . $k . ',';
			//p ($field);
			if(is_int ($v)){
				$value .= $v . ',';
				//p ($value);
			}else{
				$value .= "'$v'" . ',';
			}
			//p ($value);
		}
		$field = rtrim ($field,',');
		//p ($field);
		$value = rtrim ($value,',');
		//p ($value);
		$sql = "insert into {$this->table} ({$field}) values ({$value})";
		//p ($sql);
		return $this->e ($sql);
		//为什么没有返出成功的条数？？？？？？？？？？？？？？？？？？？？？？？？？？？
	}

	/**
	 * @param $data   更新数据
	 *
	 * @return bool
	 */
	public function update($data){
		//如果没有where条件不允许更新
		if(!$this->where){
			return false;
		};
		$set = '';
		foreach($data as $k=>$v){
			if(is_int ($v)){
				$set .= $k . '=' . $v . ',';
			}else{
				$set .= $k . '=' . "'$v'" . ',';
			}
		}
		$set = rtrim($set,',');
				//p($set);die;
		//sql = "update student set sname='',age=19,sex='男' where id=1";
		$sql = "update {$this->table} set {$set} {$this->where}";
		return $this->e ($sql);
	}

	/**
	 * @return bool   删除  delete
	 */
	public function delete (){
		//如果没有where条件不允许更新
		if(!$this->where){
			return false;
		};
		//$sql = "delete from student where id=2";
		$sql = "delete from {$this->table} {$this->where}";
		return $this->e($sql);
	}

	//有结果查询
	public function q ( $sql )
	{
		try {
			//执行sql语句
			$res = self ::$pdo -> query ( $sql );

			//将结果集取出来
			return $res -> fetchAll ( PDO::FETCH_ASSOC );
		} catch ( Exception $e ) {
			die( $e -> getMessage () );
		}
	}

	//执行无结果集的sql
	//insert、update、delete
	public function e ( $sql )
	{
		try {
			return self ::$pdo -> exec ( $sql );
		} catch ( Exception $e ) {
			//输出错误消息
			die( $e -> getMessage () );
		}
	}

}