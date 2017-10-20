<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Front end route*/
$route['home'] = "exm_home";
$route['home/(:any)'] = "exm_home/$1";

/* API Route*/
$route['api'] = "api/vent_api";
$route['api/(:any)'] = "api/vent_api/$1";

/* API Route*/
$route['cron'] = "api/roadp_cron";
$route['cron/(:any)'] = "api/roadp_cron/$1";



