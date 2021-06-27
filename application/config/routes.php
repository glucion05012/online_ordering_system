<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['default_controller'] = 'ooscontroller/login';


$route['loggedin'] = 'ooscontroller/loggedin';
$route['login'] = 'ooscontroller/home';
$route['logout'] = 'ooscontroller/logout';

$route['home'] = 'ooscontroller/myhome';

$route['profile'] = 'ooscontroller/viewProfile';
$route['profile/add'] = 'ooscontroller/addProfile';
$route['profile/edit/(:num)'] = 'ooscontroller/editProfile/$1';
$route['profile/delete/(:num)'] = 'ooscontroller/deleteProfile/$1';

$route['branch'] = 'ooscontroller/viewBranch';
$route['branch/add'] = 'ooscontroller/addBranch';
$route['branch/edit/(:num)'] = 'ooscontroller/editBranch/$1';
$route['branch/delete/(:num)'] = 'ooscontroller/deleteBranch/$1';

$route['promo'] = 'ooscontroller/viewPromo';
$route['promo/add'] = 'ooscontroller/addPromo';
$route['promo/edit/(:num)'] = 'ooscontroller/editPromo/$1';
$route['promo/delete/(:num)'] = 'ooscontroller/deletePromo/$1';

$route['menu'] = 'ooscontroller/viewmenu';
$route['menu/add'] = 'ooscontroller/addmenu';
$route['menu/edit/(:num)'] = 'ooscontroller/editmenu/$1';
$route['menu/delete/(:num)/(:any)'] = 'ooscontroller/deletemenu/$1/$1';

$route['orders'] = 'ooscontroller/viewOrders';
$route['completed'] = 'ooscontroller/viewCompleted';
$route['cancelled'] = 'ooscontroller/viewCancelled';
$route['order/process/(:num)'] = 'ooscontroller/processOrder/$1';
$route['order/processView/(:num)'] = 'ooscontroller/processOrderView/$1';
$route['order/cancel/(:num)'] = 'ooscontroller/cancelOrder/$1';
$route['order/submit/(:num)'] = 'ooscontroller/submitOrder/$1';


$route['logs'] = 'ooscontroller/viewLogs';
