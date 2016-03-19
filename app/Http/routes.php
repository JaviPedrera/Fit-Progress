<?php

/**
 * Home Route
 */
Route::get('/', [
	'uses'			=>	'Dashboard\DashboardController@home',
	'as'			=>	'home',
	'middleware'	=>	'guest',
]);

/**
 * Routes filtered by auth middleware
 */
Route::group(['middleware' => 'auth'], function ()
{
	// Registration
	Route::get('registration', [
		'uses'			=>	'User\UserController@getRegistration',
		'as'			=>	'registration.index',
	]);
	Route::post('registration', [
		'uses'			=>	'User\UserController@postRegistration',
		'as'			=>	'registration.index',
	]);

	// Dashboard
	Route::get('/dashboard', [
		'uses'	=>	'Dashboard\DashboardController@index',
		'as'	=>	'dashboard.index'
	]);

	// Resources
	Route::resource('workout', 'Dashboard\WorkoutController');
	Route::resource('inbody', 'Dashboard\InbodyController');
	Route::resource('measure', 'Dashboard\MeasureController');

	// Comparator
	Route::get('comparator', [
		'uses'	=>	'Dashboard\WorkoutController@getComparator',
		'as'	=>	'comparator.index',
	]);

	// Calendar
	Route::get('calendar', [
		'uses'	=>	'Dashboard\DashboardController@getCalendar',
		'as'	=>	'calendar.index'
	]);

	// Gallery
	Route::get('gallery', [
		'uses'	=>	'Dashboard\DashboardController@getGallery',
		'as'	=>	'gallery.index',
	]);
	Route::post('gallery', [
		'uses'	=>	'Dashboard\DashboardController@storeGallery',
		'as'	=>	'gallery.store',
	]);

	// Delete Picture From Gallery
	Route::post('deletePic/{id}','Dashboard\DashboardController@deletePic');

	// Profile Routes
	Route::get('profile', [
		'uses'			=>	'User\UserController@getProfile',
		'as'			=>	'profile.index',
	]);
	Route::post('profile', [
		'uses'			=>	'User\UserController@postProfile',
		'as'			=>	'profile.index',
	]);

	// Timeline
	Route::get('/timeline', [
		'uses'			=>	'Dashboard\DashboardController@getTimeLine',
		'as'			=>	'timeline.index',
	]);
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



