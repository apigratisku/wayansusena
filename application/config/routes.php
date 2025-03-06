<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'beranda';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/* Backend Routes */

$route['login'] = 'auth/index';
$route['logout'] = 'auth/logout';
$route['manage'] = 'backend/Dashboard';
$route['manage/project'] = 'backend/project';
$route['manage/project/tambah'] = 'backend/Project/tambah';
$route['manage/project/simpan'] = 'backend/Project/simpan';
$route['manage/project/(:any)/ubah'] = 'backend/Project/ubah/$1';
$route['manage/project/(:any)/timpa'] = 'backend/Project/timpa/$1';
$route['manage/project/(:any)/hapus'] = 'backend/Project/hapus/$1';
$route['manage/project/(:any)/show'] = 'backend/Project/show/$1';

$route['manage/operator'] = 'backend/Operator';
$route['manage/operator/(:num)'] = 'backend/Operator/detil/$1';
$route['manage/operator/tambah'] = 'backend/Operator/tambah';
$route['manage/operator/simpan'] = 'backend/Operator/simpan';
$route['manage/operator/(:num)/ubah'] = 'backend/Operator/ubah/$1';
$route['manage/operator/(:num)/timpa'] = 'backend/Operator/timpa/$1';
$route['manage/operator/(:num)/hapus'] = 'backend/Operator/hapus/$1';
$route['manage/operator/gantipwd'] = 'backend/Operator/gantipwd';
$route['manage/operator/prosespwd'] = 'backend/Operator/prosespwd/';


$route['manage/itemproject'] = 'backend/itemproject';
$route['manage/itemproject/tambah'] = 'backend/Itemproject/tambah';
$route['manage/itemproject/simpan'] = 'backend/Itemproject/simpan';
$route['manage/itemproject/(:num)/ubah'] = 'backend/Itemproject/ubah/$1';
$route['manage/itemproject/(:num)/timpa'] = 'backend/Itemproject/timpa/$1';
$route['manage/itemproject/(:num)/hapus'] = 'backend/Itemproject/hapus/$1';

$route['manage/docproject'] = 'backend/Docproject';
$route['manage/docproject/tambah'] = 'backend/Docproject/tambah';
$route['manage/docproject/simpan'] = 'backend/Docproject/simpan';
$route['manage/docproject/(:num)/ubah'] = 'backend/Docproject/ubah/$1';
$route['manage/docproject/(:num)/timpa'] = 'backend/Docproject/timpa/$1';
$route['manage/docproject/(:num)/hapus'] = 'backend/Docproject/hapus/$1';


$route['manage/domain_api'] = 'backend/Domain_api';
$route['manage/domain_api/tambah'] = 'backend/Domain_api/tambah';
$route['manage/domain_api/simpan'] = 'backend/Domain_api/simpan';
$route['manage/domain_api/(:any)/ubah'] = 'backend/Domain_api/ubah/$1';
$route['manage/domain_api/(:any)/timpa'] = 'backend/Domain_api/timpa/$1';
$route['manage/domain_api/(:any)/hapus'] = 'backend/Domain_api/hapus/$1';
$route['manage/domain_api/(:any)/update'] = 'backend/Domain_api/update/$1';
$route['manage/domain_api/(:any)/tg_domain_api_auto'] = 'backend/Domain_api/tg_domain_api_auto/$1';
$route['manage/domain_api/(:any)/tg_domain_api_manual'] = 'backend/Domain_api/tg_domain_api_manual/$1';
$route['manage/domain_api/syncdb'] = 'backend/Domain_api/syncdb';