<?php
//加载vendor/autoload.php,实现自动加载要用下面Terminal，输入composer drop自动生成vendor
//引入自动加载文件，通过它自动加载类


require "../vendor/autoload.php";

//刷新页面报错类未找到，需要修改composer配置文件composer.json
//手动加入autoload，两个元素files:需要加载的文件；psr-4：要实例化的类命名空间：目录“houdunwang\\":"houdunwang\\",,,,\转义
//在下面Terminal执行：composer dump 相当于刷新一下




//调用启动类中run方法
\houdunwang\core\Boot::run();
//单一入口完成，去Boot.php工作，单一入口（强类聚，弱耦合），就是开一个门，大家有事都从这里进入
