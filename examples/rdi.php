<?php
//自动载入
$root_path=dirname(dirname(__DIR__));
$autoloadFile=sprintf('%s/vendor/autoload.php',$root_path);

if (!file_exists($autoloadFile))
{
    echo '{"code":9999,"msg":"please run command \"composer update\" first!"}', "\n";
    exit(1);
}

require_once($autoloadFile);

use Lubed\Router\RDIResolver;

$udi = new RDIResolver();
 echo "\n",'App\\Http\\Controllers::HelloController@hello',"\t",print_r($udi->resolve('App\\Http\\Controllers::HelloController@hello'),true);
 echo "\n",'controller',"\t",print_r($udi->resolve('controller'),true);
 echo "\n",'module/controller',"\t",print_r($udi->resolve('module/controller'),true);
 echo "\n",'/controller',"\t",print_r($udi->resolve('/controller'),true);
 echo "\n",'controller@action',"\t",print_r($udi->resolve('controller@action'),true);
 echo "\n",'module/controller@action',"\t",print_r($udi->resolve('module/controller@action'),true);
 echo "\n",'namespace::controller',"\t",print_r($udi->resolve('namespace::controller'),true);
 echo "\n",'namespace::module/controller',"\t",print_r($udi->resolve('namespace::module/controller'),true);
 echo "\n",'namespace::controller@action',"\t",print_r($udi->resolve('namespace::controller@action'),true);
 echo "\n",'namespace::module/controller@action',"\t",print_r($udi->resolve('namespace::module/controller@action'),true);
 echo "\n",'@action',"\t",print_r($udi->resolve('@action'),true);
 echo "\n",'namespace::@action',"\t",print_r($udi->resolve('namespace::@action'),true);

die("\n---ok\n");