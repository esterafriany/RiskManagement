<?php

namespace Config;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthenticationController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//--Auth
$routes->get('/', 'AuthenticationController::index');
$routes->post('/process-login', 'AuthenticationController::login');
$routes->get('/process-logout', 'AuthenticationController::logout', ['filter'=>'auth']);

$routes->group('admin', ['filter'=>'auth'] , function($routes){
	$routes->add('dashboard', 'DashboardController::index', ['as' => 'get-dashboards']);
	
	//Group
	$routes->add('group', 'UserController::group_list', ['as' => 'get-groups']);
	$routes->add('UserController/onAddGroup', 'UserController::onAddGroup', ['as' => 'add-groups']);

	// User
	$routes->add('user', 'UserController::user_list', ['as' => 'get-users']);
	$routes->add('UserController/onAddUser', 'UserController::onAddUser', ['as' => 'add-users']);

	
	//Risk Categories
	$routes->add('risk_category', 'RiskMasterController::index', ['as' => 'get-risk-category']);
	$routes->add('RiskMasterController/onAddRiskCategory', 'RiskMasterController::onAddRiskCategory', ['as' => 'add-risk-category']);

	//KPI
	$routes->add('kpi', 'KPIController::index', ['as' => 'get-kpi']);
	//$routes->add('RiskMasterController/onAddRiskCategory', 'RiskMasterController::onAddRiskCategory', ['as' => 'add-risk-category']);
	
});





 
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}