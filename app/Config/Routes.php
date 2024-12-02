<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//landing page
$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->get('/signup', 'RegisterController::signUpPage');
//signup user
$routes->post('/signup/addUser', 'RegisterController::signUp');

//login route for email
$routes->post('/login/userAuth/(:any)', 'AuthController::verifyLogin/$1');

//login-routes for google
$routes->get('/login/(:any)', 'AuthController::socialLogin/$1');
$routes->get('/google-login/callback', 'AuthController::googleCallback');
$routes->get('/auth/twitter/callback', 'AuthController::twitterCallback');
$routes->get('auth/github/callback', 'AuthController::githubCallback');
$routes->get('/add/(:any)', 'AuthController::handlesocialLogin/$1');

//logout
$routes->get('logout', 'AuthController::logout');

//dashboard
$routes->get('/dashboard', 'DashboardController::dashboard');
$routes->post('/api/checkDetails', 'DashboardController::checkDetails');
$routes->post('/api/updateDetails', 'DashboardController::updateDetails');

//otp verification
$routes->post('/api/sendOtp', 'OtpController::generateOtp');
$routes->post('/api/verifyOtp', 'OtpController::verifyenterOtp');