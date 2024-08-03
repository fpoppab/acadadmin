<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = 'ErrorController/error_404';
$route['translate_uri_dashes'] = FALSE;

$route['auth/login'] = 'AuthenticationController/login';
$route['auth/logout'] = 'AuthenticationController/logout';

$route['setupData'] = 'SetupController/setupdata';
$route['mockupData'] = 'SetupController/mockupdata';

$route['linkUser'] = 'SetupController/create_link_user_personnel';
$route['set_theme/(:any)'] = 'Welcome/set_theme/$1';

$route['activity'] = 'ProfileController/activityIndex';
$route['profile'] = 'ProfileController/profileIndex';

$route['building'] = 'BuildingController/buildingIndex';
$route['building-insert-form'] = 'BuildingController/buildingInsertForm';
$route['building-edit-form/(:num)'] = 'BuildingController/buildingEditForm/$1';

$route['users'] = 'UserController/usersIndex';

$route['personnel'] = 'PersonnelController/personnelIndex';
$route['personnel-insert-form'] = 'PersonnelController/personnelInsertForm';
$route['personnel-edit-form/(:num)'] = 'PersonnelController/personnelEditForm/$1';

$route['student'] = 'StudentController/studentIndex';
$route['student-insert-form'] = 'StudentController/studentInsertForm';
$route['student-edit-form/(:num)'] = 'StudentController/studentEditForm/$1';

$route['school'] = 'SchoolController/schoolIndex';

$route['room'] = 'RoomController/roomIndex';
$route['room-insert-form'] = 'RoomController/roomInsertForm';
$route['room-edit-form/(:num)'] = 'RoomController/roomEditForm/$1';
$route['room-edit-list/(:num)'] = 'RoomController/roomEditList/$1';

$route['student-promote'] = 'StudentController/studentPromoteIndex';
$route['student-report'] = 'StudentController/studentReportIndex';
$route['student-report-pp2/(:num)'] = 'StudentController/studentPP2Report/$1';
$route['student-import'] = 'StudentController/inportStudent';

$route['subject-teacher'] = 'SchoolController/subjectTeacherIndex';

$route['syllabus'] = 'CourseController/syllaBusIndex';
$route['course'] = 'CourseController/courseIndex';
$route['course-insert-form'] = 'CourseController/courseInsertForm';
$route['course-edit-form/(:num)'] = 'CourseController/courseEditForm/$1';
$route['course-register'] = 'CourseController/courseRegisterIndex';

$route['public-relations'] = 'PublicRelationsController/publicrelationsIndex';
$route['public-relations-insert-form'] = 'PublicRelationsController/publicrelationsInsertForm';
$route['public-relations-edit-form/(:num)'] = 'PublicRelationsController/publicrelationsEditForm/$1';

$route['learning-resources'] = 'LearningResourcesController/learningResourcesIndex';
$route['learning-resources-insert-form'] = 'LearningResourcesController/learningResourcesInsertForm';
$route['learning-resources-edit-form/(:num)'] = 'LearningResourcesController/learningResourcesEditForm/$1';

$route['vehicle'] = 'VehicleController/vehicleIndex';
$route['vehicle-insert-form'] = 'VehicleController/vehicleInsertForm';
$route['vehicle-edit-form/(:num)'] = 'VehicleController/vehicleEditForm/$1';

$route['nutrition'] = 'NutritionController/nutritionIndex';
$route['nutrition-insert-form'] = 'NutritionController/nutritionInsertForm';
$route['nutrition-edit-form/(:num)'] = 'NutritionController/nutritionEditForm/$1';

$route['homeroom-time-attendance'] = 'ErrorController/error_404';
$route['homeroom-brush-teeth'] = 'ErrorController/error_404';
$route['homeroom-drinking-milk'] = 'ErrorController/error_404';
$route['homeroom-student-information'] = 'ErrorController/error_404';
$route['homeroom-weighing-heighing'] = 'ErrorController/error_404';
$route['homeroom-sdq-record'] = 'ErrorController/error_404';
$route['homeroom-visit-home'] = 'ErrorController/error_404';
$route['homeroom-student-food'] = 'ErrorController/error_404';
$route['homeroom-student-health'] = 'ErrorController/error_404';
$route['homeroom-student-development'] = 'ErrorController/error_404';


