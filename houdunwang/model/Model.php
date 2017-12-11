<?php

namespace houdunwang\model;

class Model
{
	public function __call ( $name , $arguments )
	{
		return self ::runParse ( $name , $arguments );
	}

	public static function __callStatic ( $name , $arguments )
	{
		return self ::runParse ( $name , $arguments );
	}

	public static function runParse ( $name , $arguments )
	{
		//p (5566);
		//p (get_called_class ());
		$class = get_called_class ();
		//p ($class);
		return call_user_func_array ( [ new Base($class) , $name ] , $arguments );
	}
}

