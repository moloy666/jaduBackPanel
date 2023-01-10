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
$route['default_controller'] = 'admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//////////////////////////////////////////////////////////////////////////////
$route['Admin'] = 'admin/logout';


///////////////////////// Hotel Start /////////////////////////////////////
$route['hotel'] = 'hotel/index';
$route['hotel/register'] = 'hotel/view_register';
$route['hotel/dashboard'] = 'hotel/view_dashboard';
$route['hotel/call_booking'] = 'hotel/view_customer_booking';
$route['hotel/profile'] = 'hotel/view_profile';








$route['hotel/register_details'] = 'hotel/register_details';
$route['hotel/authenticate_hotel'] = 'hotel/authenticate_hotel';


///////////////////////////////// FRANCHISE / SUBFRANCHISE PANEL START /////////////////////////////////////////////
// Views
$route['franchise'] = 'franchise/index';
$route['franchise/dashboard'] = 'franchise/view_dashboard';
$route['franchise/subfranchise'] = 'franchise/view_subfranchise';
$route['franchise/sarathi'] = 'franchise/view_sarathi';
$route['franchise/driver'] = 'franchise/view_driver';
$route['franchise/incentives'] = 'franchise/view_incentives';
$route['franchise/call_booking'] = 'franchise/view_call_booking';
$route['franchise/rental/slabs'] = 'franchise/view_rental_slabs';
$route['franchise/rental/features'] = 'franchise/view_rental_features';
$route['franchise/rental/details'] = 'franchise/view_rental_details';
$route['franchise/fare_management'] = 'franchise/view_fare_list';
$route['franchise/services'] = 'franchise/view_services';
$route['franchise/compliments'] = 'franchise/view_compliments';
$route['franchise/achivements'] = 'franchise/view_achivements';
$route['franchise/help'] = 'franchise/view_help';
$route['franchise/feedback'] = 'franchise/view_feedback';
$route['franchise/resolve_reports'] = 'franchise/view_resolve_reports';
$route['franchise/unresolve_reports'] = 'franchise/view_unresolve_reports';
$route['franchise/customers'] = 'franchise/view_customers';
$route['franchise/profile'] = 'franchise/view_profile';
$route['franchise/places'] = 'franchise/view_places';
$route['franchise/driver/location'] = 'franchise/view_driver_location';
$route['franchise/recharge_history'] = 'franchise/view_recharge_history';


$route['franchise/subfranchise/sarathi/(:any)'] = 'franchise/view_subfranchise_details/$1';
$route['franchise/sarathi/driver/(:any)'] = 'franchise/view_sarathi_details/$1';
$route['franchise/driver/details/(:any)'] = 'franchise/view_driver_details/$1';

// ============================================================

$route['subfranchise'] = 'franchise/index';
$route['subfranchise/dashboard'] = 'franchise/view_dashboard';
$route['subfranchise/subfranchise'] = 'franchise/view_subfranchise';
$route['subfranchise/sarathi'] = 'franchise/view_sarathi';
$route['subfranchise/driver'] = 'franchise/view_driver';
$route['subfranchise/incentives'] = 'franchise/view_incentives';
$route['subfranchise/call_booking'] = 'franchise/view_call_booking';
$route['subfranchise/rental/slabs'] = 'franchise/view_rental_slabs';
$route['subfranchise/rental/features'] = 'franchise/view_rental_features';
$route['subfranchise/rental/details'] = 'franchise/view_rental_details';
$route['subfranchise/fare_management'] = 'franchise/view_fare_list';
$route['subfranchise/services'] = 'franchise/view_services';
$route['subfranchise/compliments'] = 'franchise/view_compliments';
$route['subfranchise/achivements'] = 'franchise/view_achivements';
$route['subfranchise/help'] = 'franchise/view_help';
$route['subfranchise/feedback'] = 'franchise/view_feedback';
$route['subfranchise/resolve_reports'] = 'franchise/view_resolve_reports';
$route['subfranchise/unresolve_reports'] = 'franchise/view_unresolve_reports';
$route['subfranchise/customers'] = 'franchise/view_customers';
$route['subfranchise/profile'] = 'franchise/view_profile';
$route['subfranchise/places'] = 'franchise/view_places';
$route['subfranchise/driver/location'] = 'franchise/view_driver_location';
$route['subfranchise/recharge_history'] = 'franchise/view_recharge_history';



$route['subfranchise/sarathi/driver/(:any)'] = 'franchise/view_sarathi_details/$1';


// Functions

///////////////////////////////////FRANCHISE / SUBFRANCHISE PANEL END ////////////////////////////////////////////

// $route['dashboard'] = 'admin/dashboard';
// $route['sarathi'] = 'admin/sarathi';
// $route['driver'] = 'admin/driver';
// $route['franchise'] = 'admin/franchise';
// $route['sub_franchise'] = 'admin/sub_franchise';
// $route['admin'] = 'Admin/admin';
// $route['profile'] = 'Admin/profile';
// $route['logout'] = 'admin/logout';


$route['administrator/get_customer_by_booking_id'] = 'admin/get_customer_by_booking_id';

////////////////////// SARATHI PANEL ///////////////////////////////////////////
// $route['sarathi_login'] = 'Sarathi/index';

$route['sarathiData'] = 'Admin/getsarathiData';
$route['sarathi/login'] = 'Sarathi/index';
$route['sarathi/driver'] = 'Sarathi/sarathi_details';
$route['sarathi_driver'] = 'Sarathi/driver';
$route['sarathi_customers'] = 'Sarathi/customers';
$route['sarathi/profile'] = 'Sarathi/sarathi_profile';
$route['sarathi/documents'] = 'Sarathi/view_sarathi_documents';
$route['sarathi/pending_driver_document/(:any)'] = 'sarathi/show_pending_drivers/$1';
$route['sarathi/driver/details/(:any)'] = 'Sarathi/view_driver_details/$1';



// $route['sarathi/dashboard'] = 'sarathi/view_dashboard';

$route['sarathi/incentives'] = 'sarathi/view_incentives';
$route['sarathi/call_booking'] = 'sarathi/view_call_booking';
$route['sarathi/rental/slabs'] = 'sarathi/view_rental_slabs';
$route['sarathi/rental/features'] = 'sarathi/view_rental_features';
$route['sarathi/rental/details'] = 'sarathi/view_rental_details';
$route['sarathi/fare_management'] = 'sarathi/view_fare_list';
$route['sarathi/services'] = 'sarathi/view_services';
$route['sarathi/compliments'] = 'sarathi/view_compliments';
$route['sarathi/achivements'] = 'sarathi/view_achivements';
$route['sarathi/help'] = 'sarathi/view_help';
$route['sarathi/feedback'] = 'sarathi/view_feedback';
$route['sarathi/resolve_reports'] = 'sarathi/view_resolve_reports';
$route['sarathi/unresolve_reports'] = 'sarathi/view_unresolve_reports';
$route['sarathi/customers'] = 'sarathi/view_customers';
$route['sarathi/places'] = 'sarathi/view_places';

$route['sarathi/driver/location'] = 'sarathi/driver_location';

//////////////////////////////////////////////////////////////////////////////
$route['administrator/dashboardData'] = 'Admin/getDashboardData';
$route['administrator/driverData'] = 'Admin/getdriverData';
$route['administrator/display_fare_list'] = 'Admin/display_fare_list';
//////////////////////////////////////////////////////////////////////////////
$route['adminstrator/settings'] = 'Admin/settings';
//////////////////////////////////////////////////////////////////////////////
//  splash data functions
$route['administrator/delete_splash_data'] = 'Admin/delete_splash_data';
$route['administrator/update_splash_data'] = 'Admin/update_splash_data';
$route['administrator/add_splash_data'] = 'Admin/add_splash_data';

// feedback functions
$route['administrator/display_feedback'] = 'Admin/display_feedback';

// reports functions
$route['administrator/display_resolved_reports'] = 'Admin/display_resolved_reports';
$route['administrator/display_unresolved_reports'] = 'Admin/display_unresolved_reports';
$route['administrator/submit_report_comment'] = 'Admin/submit_report_comment';
$route['administrator/change_report_status'] = 'Admin/change_report_status';

// franchise functions
$route['administrator/get_franchise'] = 'Admin/get_franchise';
$route['administrator/delete_franchise'] = 'Admin/delete_franchise';
$route['administrator/add_franchise'] = 'Admin/add_franchise';
$route['administrator/update_franchise'] = 'Admin/update_franchise';
$route['administrator/deactive_franchise'] = 'Admin/deactive_franchise';
$route['administrator/active_franchise'] = 'Admin/active_franchise';

// sub-franchise functions
$route['administrator/display_all_franchise'] = 'Admin/display_all_franchise';
$route['administrator/update_sub_franchise'] = 'Admin/update_sub_franchise';
$route['administrator/deactive_sub_franchise'] = 'Admin/deactive_sub_franchise';
$route['administrator/active_sub_franchise'] = 'Admin/active_sub_franchise';
$route['administrator/delete_sub_franchise'] = 'Admin/delete_sub_franchise';
$route['administrator/add_sub_franchise'] = 'Admin/add_sub_franchise';
$route['administrator/get_sub_franchise'] = 'Admin/get_sub_franchise';

//  sarathi functions
$route['administrator/fetch_subfranchise'] = 'Admin/fetch_subfranchise';
$route['administrator/active_sarathi'] = 'Admin/active_sarathi';
$route['administrator/deactive_sarathi'] = 'Admin/deactive_sarathi';
$route['administrator/deactive_sarathi'] = 'Admin/deactive_sarathi';
$route['administrator/update_sarathi'] = 'Admin/update_sarathi';
$route['administrator/delete_sarathi'] = 'Admin/delete_sarathi';
$route['administrator/get_sarathi'] = 'Admin/get_sarathi';

$route['administrator/approved_driver_documents'] = 'Admin/approved_driver_documents';
$route['administrator/deny_driver_documents'] = 'Admin/deny_driver_documents';

//  manage user profile
$route['administrator/update_user_profile'] = 'Admin/update_user_profile';

// driver functions
$route['administrator/active_driver'] = 'Admin/active_driver';
$route['administrator/deactive_driver'] = 'Admin/deactive_driver';
$route['administrator/deactive_driver'] = 'Admin/deactive_driver';
$route['administrator/update_driver'] = 'Admin/update_driver';
$route['administrator/delete_driver'] = 'Admin/delete_driver';
$route['administrator/get_driver'] = 'Admin/get_driver';


// view load
$route['administrator/dashboard'] = 'Admin/dashboard';
$route['administrator/franchise'] = 'Admin/franchise';
$route['administrator/admin'] = 'Admin/admin';
$route['administrator/sub_franchise'] = 'Admin/sub_franchise';
$route['administrator/driver'] = 'Admin/driver';
$route['administrator/driver/location'] = 'Admin/view_driver_location';
$route['administrator/sarathi'] = 'Admin/sarathi';
$route['administrator/feedback'] = 'Admin/feedback';
$route['administrator/splash_data'] = 'Admin/splash_data';
$route['administrator/profile'] = 'Admin/profile';
$route['administrator/logout'] = 'Admin/logout';
$route['administrator/settings'] = 'Admin/settings';
$route['administrator/unresolve_reports'] = 'Admin/unresolve_reports';
$route['administrator/resolve_reports'] = 'Admin/resolve_reports';
$route['administrator/fare_management'] = 'Admin/fare_management';
$route['administrator/services'] = 'Admin/view_services';
$route['administrator/help'] = 'Admin/view_help';
$route['administrator/delivery_guideline'] = 'Admin/view_delivery_guideline';
$route['administrator/incentives'] = 'Admin/view_incentives';
$route['administrator/customers'] = 'admin/customers';
$route['administrator/call_booking'] = 'admin/view_call_booking';
$route['administrator/rental/slabs'] = 'admin/view_rental_slabs';
$route['administrator/rental/features'] = 'admin/view_rental_features';
$route['administrator/rental/details'] = 'admin/view_rental_details';
$route['administrator/compliments'] = 'admin/view_compliments';
$route['administrator/achivements'] = 'admin/view_achivements';
$route['administrator/coupons'] = 'admin/view_coupons';
$route['administrator/places'] = 'admin/view_places';
$route['administrator/hotel'] = 'admin/view_hotel';
$route['administrator/ride_details'] = 'admin/view_ride_details';
$route['administrator/dormant_account'] = 'admin/view_dormant_account';
$route['administrator/packages'] = 'admin/view_packages';



$route['administrator/franchise_details/(:any)'] = 'Admin/franchise_details/$1';
$route['administrator/subfranchise_details/(:any)'] = 'Admin/subfranchise_details/$1';
$route['administrator/sarathi_details/(:any)'] = 'Admin/sarathi_details/$1';
$route['administrator/driver_document/(:any)'] = 'Admin/show_driver_document/$1';
$route['administrator/customers/ride_history/(:any)'] = 'Admin/view_ride_history/$1';
$route['administrator/customers/ride_history_csv/(:any)'] = 'Admin/ride_history_csv/$1';

$route['administrator/admin/remarks/(:any)'] = 'Admin/view_display_remarks/$1';
$route['administrator/admin/details/(:any)'] = 'Admin/view_admin_details/$1';
$route['administrator/download_progress_report/(:any)'] = 'Admin/download_progress_report/$1';

//////////////////////////////////////////////////////////////////////////////

// sarathi details 
$route['administrator/get_pending_drivers'] = 'Admin/get_pending_drivers';
$route['administrator/total_km_purchase'] = 'Admin/total_km_purchase';

//////////////////////////////////////////////////////////////////////////////

// driver details
$route['administrator/pending_driver_document/(:any)'] = 'Admin/show_pending_drivers/$1';
$route['administrator/driver/details/(:any)'] = 'Admin/display_driver_details/$1';
$route['administrator/driver/ride_history/(:any)'] = 'Admin/view_ride_history/$1';

$route['administrator/driver/display_ride_history/(:any)'] = 'Admin/display_ride_history/$1';


$route['administrator/driver/ride_history_csv/(:any)'] = 'Admin/ride_history_csv/$1';


$route['administrator/display_driver_location'] = 'Admin/display_driver_location';



// admin settings 
$route['administrator/display_documentation_content'] = 'Admin/display_documentation_content';
$route['administrator/update_documentation_content'] = 'Admin/update_documentation_content';
$route['administrator/manage_helpline_number'] = 'Admin/manage_helpline_number';
$route['administrator/edit_helpline_number'] = 'Admin/edit_helpline_number';

$route['administrator/save_delivery_guideline'] = 'Admin/save_delivery_guideline';
$route['administrator/display_delivery_guideline'] = 'Admin/display_delivery_guideline';

///////////////////////////////////////////////////////////////////////////////

// services

$route['administrator/display_service_name'] = 'Admin/display_service_name';
$route['administrator/display_ride_names'] = 'Admin/display_ride_names';
$route['administrator/display_cab_names'] = 'Admin/display_cab_names';
$route['administrator/add_service_type'] = 'Admin/add_service_type';
$route['administrator/add_ride_type'] = 'Admin/add_ride_type';
$route['administrator/add_cab_name'] = 'Admin/add_cab_name';

////////////////////////////////// Help //////////////////////////////

$route['administrator/display_help_list'] = 'Admin/display_help_list';
$route['administrator/resolve_help'] = 'Admin/resolve_help';


/////////////////// Ride History details ////////////////////////////////////
$route['administrator/generate_ride_history_pdf'] = 'Admin/generate_ride_history_pdf';

/////////////////// Incentives scheme ////////////////////////////////////

$route['administrator/display_incentives_time_list'] = 'Admin/display_incentives_time_list';
$route['administrator/display_incentives_scheme'] = 'Admin/display_incentives_scheme';
$route['administrator/update_incentive_scheme_details'] = 'Admin/update_incentive_scheme_details';
$route['administrator/active_incentive_scheme'] = 'Admin/active_incentive_scheme';
$route['administrator/deactive_incentive_scheme'] = 'Admin/deactive_incentive_scheme';
$route['administrator/add_incentives_scheme'] = 'Admin/add_incentives_scheme';
$route['administrator/delete_incentives_scheme'] = 'Admin/delete_incentives_scheme';

//////////////////////////////// ADMIN SPECIAL ACCESS //////////////////////////////////////////////////////

$route['administrator/get_permission_list'] = 'Admin/get_permission_list';
$route['administrator/send_permission_request'] = 'Admin/send_permission_request';
$route['administrator/get_permission_request_of_user'] = 'Admin/get_permission_request_of_user';
$route['administrator/get_user_request_permission'] = 'Admin/get_user_request_permission';
$route['administrator/allow_permission_request'] = 'Admin/allow_permission_request';
$route['administrator/deny_permission_request'] = 'Admin/deny_permission_request';
$route['administrator/display_request_permission_of_admin'] = 'Admin/display_request_permission_of_admin';

//////////////////////////////// RENTAL SLAB | FEATURES| DETAILS //////////////////////////////////////////////////////

$route['administrator/display_rental_slabs'] = 'Admin/display_rental_slabs';
$route['administrator/add_rental_slabs'] = 'Admin/add_rental_slabs';
$route['administrator/active_slab_status'] = 'Admin/active_slab_status';
$route['administrator/deactive_slab_status'] = 'Admin/deactive_slab_status';
$route['administrator/update_rental_slab'] = 'Admin/update_rental_slab';
$route['administrator/delete_slab_status'] = 'Admin/delete_slab_status';
//=======================
$route['administrator/display_rental_features'] = 'Admin/display_rental_features';

//=======================
$route['administrator/get_cab_types_for_retail_details'] = 'Admin/get_cab_types_for_retail_details';
$route['administrator/get_rental_features_for_retail_details'] = 'Admin/get_rental_features_for_retail_details';
$route['administrator/display_rental_details'] = 'Admin/display_rental_details';

////////////////////////// Compliments List /////////////////////////////////////////
$route['administrator/display_compliments_list'] = 'Admin/display_compliments_list';
$route['administrator/delete_compliments'] = 'Admin/delete_compliments';

////////////////////////// Achivement List /////////////////////////////////////////
$route['administrator/display_achievement_list'] = 'Admin/display_achievement_list';
$route['administrator/delete_achivements'] = 'Admin/delete_achivements';

$route['administrator/get_user_permission_access_list'] = 'Admin/get_user_permission_access_list';

$route['administrator/get_coupon_details'] = 'Admin/get_coupon_details';
$route['administrator/add_coupon_data'] = 'Admin/add_coupon_data';
$route['administrator/active_coupon'] = 'Admin/active_coupon';
$route['administrator/deactive_coupon'] = 'Admin/deactive_coupon';
$route['administrator/update_coupon_details'] = 'Admin/update_coupon_details';
$route['administrator/delete_coupons'] = 'Admin/delete_coupons';

////////////////////////////////////////////////////////
$route['administrator/display_bank_details'] = 'Admin/display_bank_details';
$route['administrator/save_bank_details'] = 'Admin/save_bank_details';

$route['administrator/get_key_details'] = 'Admin/get_key_details';
$route['administrator/save_key_details'] = 'Admin/save_key_details';

$route['administrator/get_panel_access_list'] = 'Admin/get_panel_access_list';
$route['administrator/display_panel_access_list'] = 'Admin/display_panel_access_list';

/////////////////////////////////////////////////////////////////////////////////

$route['administrator/display_country_name'] = 'Admin/display_country_name';
$route['administrator/display_state_names'] = 'Admin/display_state_names';
$route['administrator/display_district_names'] = 'Admin/display_district_names';
$route['administrator/display_city_names'] = 'Admin/display_city_names';

$route['administrator/add_place_name'] = 'Admin/add_place_name';
$route['administrator/delete_place_names'] = 'Admin/delete_place_names';
$route['administrator/get_place_name_by_id'] = 'Admin/get_place_name_by_id';

///////////////////////////////////////////////////////////////////////////////
$route['administrator/get_user_panel_access'] = 'Admin/get_user_panel_access';

$route['administrator/get_hotel_details'] = 'Admin/get_hotel_details';
$route['administrator/active_hotel'] = 'Admin/active_hotel';
$route['administrator/deactive_hotel'] = 'Admin/deactive_hotel';

$route['administrator/get_ride_type_details'] = 'Admin/get_ride_type_details';
$route['administrator/update_ride_details'] = 'Admin/update_ride_details';

$route['administrator/get_dormant_account_details'] = 'Admin/get_dormant_account_details';


/////////////////////////////////////////////////////////////////////////////

$route['administrator/get_user_details'] = 'Admin/get_user_details';
$route['administrator/get_packages'] = 'Admin/get_packages';
$route['administrator/get_package_details'] = 'Admin/get_package_details';
$route['administrator/add_packages'] = 'Admin/add_packages';
$route['administrator/update_packages'] = 'Admin/update_packages';
$route['administrator/active_packages'] = 'Admin/active_packages';
$route['administrator/deactive_packages'] = 'Admin/deactive_packages';
$route['administrator/delete_packages'] = 'Admin/delete_packages';
/////////////////////////

$route['administrator/total_km_purchase_today'] = 'Admin/total_km_purchase_today';








