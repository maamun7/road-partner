<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['admin'] = "admin/adashboard";
$route['admin/dashboard'] = "admin/adashboard";
$route['admin/auth'] = "admin/aauth";
$route['admin/auth/(:any)'] = "admin/aauth/$1";
$route['admin/admin_user'] = "admin/aadmin_user";
$route['admin/admin_user/(:any)'] = "admin/aadmin_user/$1";
$route['admin/role'] = "admin/arole";
$route['admin/role/(:any)'] = "admin/arole/$1";
$route['admin/app_user'] = "admin/aapp_user";
$route['admin/app_user/(:any)'] = "admin/aapp_user/$1";
$route['admin/bid_win'] = "admin/abid_win";
$route['admin/bid_win/(:any)'] = "admin/abid_win/$1";
$route['admin/service'] = "admin/aservice";
$route['admin/service/(:any)'] = "admin/aservice/$1";
