<?php

namespace Config;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RiskMasterController;
use App\Http\Controllers\KPIController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\RiskCauseController;

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
	//$routes->add('dashboard-matrix', 'DashboardController::onGetDataMatrix', ['as' => 'get-dashboard-matrix']);

	//Group
	$routes->add('group', 'UserController::group_list', ['as' => 'get-groups']);
	$routes->add('UserController/onAddGroup', 'UserController::onAddGroup', ['as' => 'add-groups']);

	// User
	$routes->add('user', 'UserController::user_list', ['as' => 'get-users']);
	$routes->add('UserController/onAddUser', 'UserController::onAddUser', ['as' => 'add-users']);

	// Division
	$routes->add('division', 'UserController::division_list', ['as' => 'get-divisions']);
	$routes->add('UserController/onAddDivision', 'UserController::onAddDivision', ['as' => 'add-divisions']);

	
	//Risk Categories
	$routes->add('risk_category', 'RiskMasterController::index', ['as' => 'get-risk-category']);
	$routes->add('RiskMasterController/onAddRiskCategory', 'RiskMasterController::onAddRiskCategory', ['as' => 'add-risk-category']);

	//KPI
	$routes->add('kpi', 'KPIController::index', ['as' => 'get-kpi']);
	$routes->add('KPIController/onAddKPI', 'KPIController::onAddKPI', ['as' => 'add-kpi']);

	//Risk Event
	$routes->add('risk-event', 'RiskEventController::index', ['as' => 'get-risk-events']);
	$routes->add('RiskEventController/onAddRiskEvent', 'RiskEventController::onAddRiskEvent', ['as' => 'add-risk-event']);
	$routes->add('detail-risk-event/(:num)', 'RiskEventController::getDetailRiskEvent/$1', ['as' => 'detail-risk-event']);
	$routes->add('RiskEventController/onAddDetailRisk', 'RiskEventController::onAddDetailRisk', ['as' => 'add-risk-event-detail']);
	
	//Risk Monitoring
	$routes->add('risk-monitoring', 'RiskMonitoringController::index', ['as' => 'get-risk-monitorings']);
	$routes->add('detail-risk-monitoring/(:num)', 'RiskMonitoringController::getDetailRiskMonitoring/$1', ['as' => 'detail-risk-monitoring']);
	$routes->add('RiskMonitoringController/onAddDetailMonitoring', 'RiskMonitoringController::onAddDetailMonitoring', ['as' => 'add-risk-monitoring']);
	
	//Risk Mitigation 
	$routes->add('risk-mitigation', 'RiskMitigationController::index', ['as' => 'get-risk-mitigations']);
	$routes->add('detail-risk-mitigations/(:num)', 'RiskMitigationController::getDetailRiskMitigations/$1', ['as' => 'detail-risk-mitigations']);
	$routes->add('detail-risk-mitigation/(:num)', 'RiskMitigationController::getDetailRiskMitigation/$1', ['as' => 'detail-risk-mitigation']);
	$routes->add('RiskMitigationController/onAddDetailMitigation', 'RiskMitigationController::onAddDetailMitigation', ['as' => 'add-detail-mitigation']);
	
	//Risk Residual
	$routes->add('risk-event-residual/(:num)', 'RiskEventController::getDetailRiskResidual/$1', ['as' => 'get-detail-risk-residual']);
	$routes->add('RiskEventController/onAddRiskResidual', 'RiskEventController::onAddRiskResidual', ['as' => 'add-risk-residual']);

	//Risk Evidence
	$routes->add('RiskMonitoringController/onUploadEvidence', 'RiskMonitoringController::onUploadEvidence', ['as' => 'upload-evidence']);
	$routes->add('download/(:any)', 'RiskMonitoringController::download/$1', ['as' => 'download-evidence']);

	//Data Kamus display
	$routes->add('probability-criteria', 'DashboardController::view_probability_criteria', ['as' => 'probability-criteria']);
	$routes->add('impact-criteria', 'DashboardController::view_impact_criteria', ['as' => 'impact-criteria']);

});

$routes->group('risk_owner', ['filter'=>'auth_pic'] , function($routes){
	//dashboard
    $routes->add('dashboards', 'RiskOwner/DashboardController::index', ['as' => 'get-dashboard']);

	//Risk Event
	$routes->add('get-risk-events', 'RiskOwner\RiskEventController::index', ['as' => 'get-risk-event']);
	$routes->add('get-detail-risk-event/(:num)', 'RiskOwner\RiskEventController::getDetailRiskEvent/$1');
	
	//Risk Mitigation
	$routes->add('get-risk-mitigations', 'RiskOwner\RiskMitigationController::index', ['as' => 'risk-mitigations']);
	//$routes->add('RiskOwner\RiskMitigationController::getRiskMitigationListRiskOwner', 'RiskOwner\RiskMitigationController::getRiskMitigationListRiskOwner', ['as' => 'risk-mitigations-risk_owner']);
	$routes->add('get-detail-risk-mitigation/(:num)', 'RiskOwner\RiskMitigationController::getDetailRiskMitigations/$1', ['as' => 'get-detail-risk-mitigation']);
	$routes->add('detail-mitigation-risk/(:num)', 'RiskOwner\RiskMitigationController::getDetailRiskMitigation/$1', ['as' => 'aa']);

	//Risk Monitoring
	$routes->add('risk-monitoring', 'RiskOwner\RiskMonitoringController::index', ['as' => 'get-risk-monitoring']);
	//$routes->add('detail-risk-monitoring/(:num)', 'RiskOwner\RiskMonitoringController::getDetailRiskMonitoring/$1', ['as' => 'detail-risk-monitoring']);
	$routes->add('view-detail-risk-monitoring/(:num)', 'RiskOwner\RiskMonitoringController::getDetailRiskMonitoring/$1', ['as' => 'aa-detail-risk-monitoring']);
	
	//risk terms
	$routes->add('view-probability-criteria', 'RiskOwner\DashboardController::view_probability_criteria', ['as' => 'aaa']);
	$routes->add('view-impact-criteria', 'RiskOwner\DashboardController::view_impact_criteria', ['as' => 'bbb']);

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
