<?php

namespace houdunwang\view;
class View
{
	public function __call ( $name , $arguments )
	{
		//p($name);//make
		//p($arguments);
		return self::runParse ( $name , $arguments );
	}

	public static function __callStatic ( $name , $arguments )
	{
		return self::runParse ( $name , $arguments );
	}

	public static function runParse ( $name , $arguments )
	{
		//p ($arguments);
		//p ($name);
		//都要return出来
		// (new Base())->$name();
		return call_user_func_array ([new Base,$name],$arguments);
	}
}