<?php

namespace Config;

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
$routes->setDefaultController('View');
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

$routes->get('student_error_list'                  , 'HTMLtoCSV::student_error_list');
$routes->get('Download_Student_Template'           , 'HTMLtoCSV::Download_Student_Template');
$routes->get('Download_Question_Template'          , 'HTMLtoCSV::Download_Question_Template');
$routes->get('Download_Sentence_Question_Template' , 'HTMLtoCSV::Download_Sentence_Question_Template');
$routes->get('Download_Assign_Student_Template'    , 'HTMLtoCSV::Download_Assign_Student_Template');
$routes->get('download_lab_template'               , 'HTMLtoCSV::download_lab_template');
$routes->get('download_topic_template'             , 'HTMLtoCSV::download_topic_template');

$routes->get('(:any)', 'View::page/$1');