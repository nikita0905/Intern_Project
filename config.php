<?php
define('PAGESIZE',2);
session_start();//mandatory for each page
$link=mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("p1",$link) or die(mysql_error());

$base_path ='/p1/';
define('BASEPATH', $base_path);