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
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['auth/login'] = 'AuthenticationController/login';
$route['auth/logout'] = 'AuthenticationController/logout';

$route['setupData'] = 'SetupController/setupdata';
$route['mockupData'] = 'SetupController/mockupdata';

$route['linkUser'] = 'SetupController/create_link_user_personnel';
$route['set_theme/(:any)'] = 'Welcome/set_theme/$1';

$route['activity'] = 'ProfileController/activityIndex';
$route['profile'] = 'ProfileController/profileIndex';

$route['building']='BuildingController/buildingIndex';
$route['building-insert-form']='BuildingController/buildingInsertForm';
$route['building-edit-form/(:num)']='BuildingController/buildingEditForm/$1';

$route['users'] = 'UserController/usersIndex';
$route['user-insert-form']='UserController/userInsertForm';

$route['personnel']='PersonnelController/personnelIndex';
$route['personnel-insert-form']='PersonnelController/personnelInsertForm';
$route['personnel-edit-form/(:num)']='PersonnelController/personnelEditForm/$1';

$route['student']='StudentController/studentIndex';
$route['student-insert-form']='StudentController/studentInsertForm';
$route['student-edit-form/(:num)']='StudentController/studentEditForm/$1';

$route['school'] = 'SchoolController/schoolIndex';
$route['room']='SchoolController/roomIndex';
$route['room-insert-form']='SchoolController/roomInsertForm';
$route['room-edit-form/(:num)']='SchoolController/roomEditForm/$1';
$route['room-edit-list/(:num)']='SchoolController/roomEditList/$1';

$route['student-promote']='StudentController/studentPromoteIndex';
$route['student-report']='StudentController/studentReportIndex';
$route['student-report-pp2/(:num)']='StudentController/studentPP2Report/$1';
$route['student-import']='StudentController/inportStudent';



$route['subject-teacher']='SchoolController/subjectTeacherIndex';

$route['syllabus']='CourseConroller/syllaBusIndex';
$route['course']='CourseConroller/courseIndex';
$route['course-insert-form']='CourseConroller/courseInsertForm';
$route['course-edit-list/(:num)']='CourseController/courseEditList/$1';
$route['course-register']='CourseConroller/courseRegisterIndex';