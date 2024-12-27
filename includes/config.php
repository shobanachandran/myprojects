<?php
session_start();
error_reporting(0);
$zconn = mysqli_connect("localhost","root","","hv_inter");


// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

define(BASEPATH,'https://vamanexports.in/');
define(SITE_TITLE,'IorangeSoftware');
define(CSS_PATH,'dist/css/');
define(JS_PATH,'dist/js/');
define(IMG_PATH,'dist/images/');
define(SCONFIG,'IO');
define(PCONFIG,'PRO');
define(CON_CODE,'CON');
define(JOB_CONFIG,'JOB');
?>
