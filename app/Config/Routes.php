<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->get('/signup', 'AuthController::signUpPage');
$routes->get('/dashboard', 'AuthController::dashboard');

$routes->post('/signup/addUser', 'AuthController::signUp');

//login route for email
$routes->post('/login/userAuth/(:any)', 'AuthController::verifyLogin/$1');

//login-routes for google
$routes->get('/login/(:any)', 'AuthController::socialLogin/$1');
$routes->get('/google-login/callback', 'AuthController::googleCallback');
$routes->get('/auth/twitter/callback', 'AuthController::twitterCallback');
$routes->get('auth/github/callback', 'AuthController::githubCallback');

$routes->get('/add/(:any)', 'AuthController::handlesocialLogin/$1');


$routes->get('logout', 'AuthController::logout');

$routes->post('/api/checkDetails', 'AuthController::checkDetails');
$routes->post('/api/updateDetails', 'AuthController::updateDetails');

//otp verification

$routes->post('/api/sendOtp', 'OtpController::generateOtp');
$routes->post('/api/verifyOtp', 'OtpController::verifyenterOtp');