<?php
defined('BASEPATH') or exit('No direct script access allowed');

defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

defined('FILE_READ_MODE')  or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  or define('DIR_WRITE_MODE', 0755);

defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

defined('EXIT_SUCCESS')        or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
/////////////////////////////////////////////////////////////////
define('WEB_PORTAL_SARATHI', 'saathi');
/////////////////////////////////////////////////////////////////
define('API_KEY', '4c174057-0a6b-4fe8-98df-5699fac7c51a');
define('PLARTFORM', 'web');
/////////////////////////////////////////////////////////////////
define('apiBaseUrl','https://jaduridedev.v-xplore.com/');
define('nodeUrl','http://54.251.202.52:3000/');
// define('apiBaseUrl','https://api.jaduride.com/');
// define('nodeUrl','https://node.jaduride.com/');
//////////////////////////////////////////////////////////////////////
define('STATIC_GST_RECHARGE_PERCENTAGE', 18);
////////////////////////// Hotel Section Start //////////////////////////

define('WEB_PORTAL_HOTEL', 'hotel');
define('hotel_page_header_link', 'hotel/inc/header_link');
define('hotel_page_header', 'hotel/inc/header');
define('hotel_page_sidebar', 'hotel/inc/sidebar');
define('hotel_page_footer', 'hotel/inc/footer');
define('hotel_page_footer_link', 'hotel/inc/footer_link');
define('session_hotel_name', 'hotel_name');
define('session_hotel_image', 'hotel_image');
define('session_hotel_id', 'hotel_id');
define('session_hotel_mobile', 'hotel_mobile');
define('saathi', '/saathi');
/////////////////////////////////////////////////////////////////////////////////
define('USER_SARATHI', 'user_sarathi');
//////////////// Franchise / Subfranchise Panel Start  ///////////////////////////
define('WEB_PORTAL_FRANCHISE', 'franchise');
define('view_franchise_dashboard', 'franchise/fr_dashboard');
define('view_franchise_login', 'franchise/fr_login');
define('view_franchise_subfranchises', 'franchise/fr_subfranchise');
define('view_franchise_subfranchise_sarathi', 'franchise/fr_subfranchise_details');
define('view_franchise_sarathi', 'franchise/fr_sarathi');
define('view_franchise_sarathi_driver', 'franchise/fr_sarathi_details');
define('view_franchise_driver', 'franchise/fr_driver');
define('view_franchise_driver_details', 'franchise/fr_driver_details');
define('session_franchise_name', 'franchise_name');
define('session_franchise_type_id', 'franchise_type_id');
define('session_franchise_user_id', 'franchise_user_id');
define('session_franchise_profile_image', 'franchise_profile_image');
define('session_franchise_status', 'franchise_status');
define('session_franchise_user_type', 'franchise_user_type');
define('session_franchise_table', 'franchise_table');
define('value_franchise', 'franchise');
define('value_subfranchise', 'sub franchise');
////////////////// Franchise / Subfranchise Panel End ///////////////////////////
//////////////////////////////////////////////////////////////////
define('WEB_PORTAL_ADMIN', 'administrator');
define('page_header_link', 'inc/header_link');
define('page_header', 'inc/header');
define('page_sidebar', 'inc/sidebar');
define('page_footer', 'inc/footer');
define('page_footer_link', 'inc/footer_link');
define('sarathi_page_header_link', 'sarathi/inc/header_link');
define('sarathi_page_header', 'sarathi/inc/header');
define('sarathi_page_sidebar', 'sarathi/inc/sidebar');
define('sarathi_page_footer', 'sarathi/inc/footer');
define('sarathi_page_footer_link', 'sarathi/inc/footer_link');
define('franchise_page_header_link', 'franchise/inc/header_link');
define('franchise_page_header', 'franchise/inc/header');
define('franchise_page_sidebar', 'franchise/inc/sidebar');
define('franchise_page_footer', 'franchise/inc/footer');
define('franchise_page_footer_link', 'franchise/inc/footer_link');
////////////////////////////////////////////////////////////
define('view_admin', 'admin');
define('view_sarathi', 'sarathi');
define('view_driver', 'driver');
define('view_franchise', 'franchise');
define('view_sub_franchise', 'sub_franchise');
define('view_customers', 'customers');
define('view_login', 'login');
define('view_sarathi_details', 'sarathi_details');
define('view_dashboard', 'dashboard');
define('view_settings', 'settings');
define('view_fare_management', 'fare_management');
define('view_unresolve_reports', 'unresolve_reports');
define('view_reports', 'reports');
define('view_feedback', 'feedback');
define('view_profile', 'profile');
define('view_pending_driver', 'pending_driver');
define('view_subfranchise_details', 'subfranchise_details');
define('view_franchise_details', 'franchise_details');
define('view_incentives', 'incentives');
define('view_ride_history', 'ride_history');
define('view_services', 'services');
define('view_packages', 'packages');
////////////////////////////////////////////////////////////////////
define('view_sarathi_profile', 'sarathi/sarathi_profile');
define('view_sarathi_driver_details', 'sarathi/driver');
define('view_sarathi_recharge_history', 'sarathi/recharge');
define('view_sarathi_dashboard', 'sarathi/dashboard');
define('view_sarathi_login', 'sarathi/sarathi_login');
////////////////////////////////////////////////////
define('session_table', 'table');
define('session_sarathi_id', 'sarathi_id');
define('session_sarathi_login_status', 'sarathi_login_status');
define('session_sarathi_name', 'sarathi_name');
define('session_sarathi_type_id', 'sarathi_type_id');
define('session_sarathi_user_id', 'sarathi_user_id');
define('session_sarathi_profile_image', 'sarathi_profile_image');
define('session_sarathi_status', 'sarathi_status');
//////////////////////////////////////////////////////////
define('model_login', 'Login_model');
define('model_uid_server', 'Uid_server_model');
define('model_common', 'Common_model');
define('model_admin', 'Admin_model');
define('model_sarathi', 'Sarathi_model');
define('model_driver', 'Driver_model');
define('model_sarathi_details', 'Sarathi_details_model');
define('model_customers_model', 'Customers_model');
define('model_franchise_model', 'Franchise_model');
define('model_sub_franchise_model', 'Subfranchise_model');
define('model_hotel', 'Hotel_model');
define('model_notification_model', 'NotificationManager');
///////////////////////////////////////////////////////////
define('field_id', 'id');
define('field_uid', 'uid');
define('field_user_id', 'user_id');
define('field_name', 'name');
define('field_gender', 'gender');
define('field_email', 'email');
define('field_mobile', 'mobile');
define('field_password', 'password');
define('field_status', 'status');
define('field_professional_details', 'professional_details');
define('field_address_details', 'address_details');
define('field_banking_details', 'banking_details');
define('field_kyc_details', 'kyc_details');
define('field_type_id', 'type_id');
define('field_location', 'asia/kolkata');
define('field_user_type', 'user_type');
define('field_profile_image', 'profile_image');
define('field_modified_at', 'modified_at');
define('field_created_at', 'created_at');
define('field_date', 'Y-m-d H:i:s');
define('field_dob', 'dob');
define('field_order_id', 'order_id');
define('field_package_id', 'package_id');
define('field_verified', 'verified');
define('field_group_id', 'gid');
define('field_sarathi_id', 'sarathi_id');
define('field_franchise_id', 'franchise_id');
define('field_subfranchise_id', 'sub_franchise_id');
define('field_total_km_purchased', 'total_km_purchased');
define('field_comments', 'comments');
define('field_modified_by', 'modified_by');
define('field_created_by', 'created_by');
define('field_driver_id', 'driver_id');
define('field_message', 'message');
define('field_rating', 'rating');
define('field_specific_level_user_id', 'specific_level_user_id');
define('field_heading', 'heading');
define('field_body', 'body');
define('field_specific_for_app', 'specific_for_app');
define('field_assets', 'assets');
define('field_service_id', 'service_id');
define('field_ride_service_type_id', 'ride_service_type_id');
define('field_value', 'value');
define('field_specific_id', 'specific_id');
define('field_rental_slabs_id', 'rental_slabs_id');
define('field_amount', 'amount');
define('field_extra_km_fare', 'extraKmFare');
define('field_extra_time_fare', 'extraRideTimeFare');
define('field_working_status', 'working_status');
define('field_customer_id', 'customer_id');
define('field_permission', 'permission');
define('field_ride_status', 'ride_status');
define('field_note', 'note');
define('field_payment_id', 'payment_id');
define('field_user_type_id', 'user_type_id');
define('field_title', 'title');
define('field_image', 'image');
define('field_large_icon', 'largeIcon');
define('field_action', 'action');
define('field_token', 'token');
define('field_address_line_1', 'address_line_1');
define('field_city_id', 'city_id');
define('field_state_id', 'state_id');
define('field_district_id', 'district_id');
define('field_country_id', 'country_id');
define('field_pincode', 'pincode');
define('field_version_for', 'version_for');
define('field_play_store_link', 'play_store_link');
define('field_code', 'code');
define('field_skipable', 'is_skipable');
define('field_refferal_code', 'refferal_code');
////////////////////////////////////////////////////////////////
define('value_administrator', 'administrator');
define('value_admin', 'admin');
////////////////////////////////////////////////////////////////
define('table_place', 'place');
define('table_sarathi', 'sarathi');
define('table_users', 'users');
define('table_driver', 'driver');
define('table_franchise', 'franchise');
define('table_subfranchise', 'subfranchise');
define('table_customer', 'customer_new');
define('table_admin', 'admin');
define('table_user_type', 'user_type');
define('table_documents', 'documents');
define('table_vehicle_type', 'vehicle_type');
define('table_app_splash_data', 'app_splash_data');
define('table_feedback', 'feedback');
define('table_administrator', 'administrator');
define('table_address', 'user_address');
define('table_fare_list', 'fare_list');
define('table_terms_and_condition', 'terms_and_condition');
define('table_privacy_policy', 'privacy_policy');
define('table_user_bank_details', 'user_bank_details');
define('table_services', 'services');
define('table_ride_service_type', 'ride_service_type');
define('table_cabs_under_service_type', 'cabs_under_service_type');
define('table_system_preferance', 'system_preferance');
define('table_help', 'help');
define('table_incentives_scheme', 'incentives_scheme');
define('table_rental_featuers', 'rental_featuers');
define('table_rental_slabs', 'rental_slabs');
define('table_ride_rental_master', 'ride_rental_master');
define('table_compliments', 'compliments');
define('table_achivements', 'achivements');
define('table_permission', 'permission');
define('table_coupons', 'coupons');
define('table_customer_coupons', 'customer_coupons');
define('table_history_ride_transactions', 'history_ride_transactions');
define('table_panel_access_permissions_list', 'panel_access_permissions_list');
define('table_panel_access_permissions', 'panel_access_permissions');
define('table_hotel', 'hotel');
define('table_ride_normal', 'ride_normal');
define('table_packages', 'packages');
define('table_notification', 'notifications');
define('table_device_notification_data_firebase', 'device_notification_data_firebase');
define('table_app_version', 'lists_app_verson');
define('table_otp_list', 'otp_list');
define('table_user_address', 'user_address');
/////////////////////////////////////////////////////
define('const_deleted', 'DELETED');
define('const_active', 'ACTIVE');
define('const_deactive', 'DEACTIVE');
define('const_resolved', 'RESOLVED');
define('const_unresolved', 'UNRESOLVED');
define('const_reject', 'REJECTED');

define('const_pending', 'pending');
define('const_submit', 'submit');
define('const_rejected', 'rejected');
define('const_delivery_guidelines', 'delivery_guidelines');
define('const_success', 'success');
define('const_completed', 'completed');
define('constant_captured', 'captured');
define('CONST_JOINING_KM', '100');
define('sarathi_title', 'New driver added');
define('sarathi_body', '100 Km deducted');
define('driver_title', 'Your account is activated');
define('driver_body', 'Congratulation ! 100 km added as joining bonus');
//////////////////////////////////////////////////////
define('key_redirect_to', 'redirect_to');
define('key_message', 'message');
define('key_success', 'success');
//////////////////////////////////////////////////
define('url_admin_page', 'admin');
////////////////////////////////////////////////////
define('KEY_USER', 'USER');
define('KEY_SARATHI', 'SARATHI');
define('KEY_DRIVER', 'DRIVER');
define('KEY_CUSTOMER', 'CUSTOMER');
define('KEY_GID', 'GROUP');
define('KEY_BANK_DETAILS', 'BANK_DETAILS');
define('KEY_HOTEL', 'HOTEL');
define('KEY_PACKAGES', 'PACKAGES');
define('KEY_NOTIFICATION', 'NOTIFICATION');
define('KEY_RECHARGE', 'RECHARGE');
define('KEY_ORDER', 'ORDER');
define('KEY_ADDRESS', 'ADDRESS');
/////////////////////////////////////////
define('UID_USER_PREFIX', 'USER_');
define('UID_SARATHI_PREFIX', 'SARATHI_');
define('UID_DRIVER_PREFIX', 'DRIVER_');
define('UID_CUSTOMER_PREFIX', 'CUSTOMER_');
define('UID_GID_PREFIX', 'GROUP_');
define('UID_BANK_DETAILS_PREFIX', 'BANK_DETAILS_');
define('UID_HOTEL_PREFIX', 'HOTEL_');
define('UID_PACKAGES_PREFIX', 'PACKAGES_');
define('UID_NOTIFICATION_PREFIX', 'NOTIFICATION_');
define('UID_ORDER_PREFIX', 'ORDER_');
define('UID_RECHARGE_PREFIX', 'RECHARGE_');
define('UID_ADDRESS_PREFIX', 'ADDRESS_');
define('UID_VERSION_PREFIX', 'VERSION_');
/////////////////////////////////////////////
define('user_type_admin', 'admin');
define('user_type_franchise', 'franchise');
define('user_type_sub_franchise', 'sub franchise');
define('user_type_sarathi', 'sarathi');
define('user_type_driver', 'driver');
define('user_type_customer', 'customer');
//////////////////////////////////////////////////////////////
define('VALUE_ADMINSTRATOR', 'administrator');
define('value_user_admin', 'user_admin');
define('value_user_franchise', 'user_franchise');
define('value_user_sub_franchise', 'user_sub_franchise');
define('value_user_sarathi', 'user_sarathi');
define('value_user_driver', 'user_driver');
define('value_user_customer', 'user_customer');
define('value_state', 'state');
///////////////////////////////////////////////////////////
define('param_id', 'id');
define('param_name', 'name');
define('param_email', 'email');
define('param_mobile', 'mobile');
define('param_dob', 'dob');
define('param_password', 'password');
define('param_user_type', 'user_type');
define('param_gender', 'gender');
define('param_subfranchise_id', 'subfranchise_id');
define('param_subfranchise', 'subfranchise');
define('param_for', 'for');
define('param_franchise_id', 'franchise_id');
define('param_heading', 'heading');
define('param_for_app', 'for_app');
define('param_body', 'body');
define('param_comment', 'comment');
define('param_status', 'status');
define('param_value', 'value');
define('param_permission', 'permission');
define('param_specific_id', 'specific_id');
define('param_user_id', 'user_id');
define('param_key', 'key');
define('param_panel_list', 'panel_list');
define('param_table', 'table');
define('param_address', 'address');
define('param_pincode', 'pincode');
define('param_country', 'country');
define('param_state', 'state');
define('param_district', 'district');
define('param_city', 'city');
define('param_play_store_link', 'play_store_link');
define('param_code', 'code');
define('param_skipable', 'skipable');
/////////////////////////////////////////////////////
define('session_franchise_id', 'franchise_id');
define('session_subfranchise_id', 'subfranchise_id');
///////////////////////////////////////////////////////////////////
define('STATIC_TEXT_SELF_RECHARGED_BY_DRIVER', 'online self recharge by driver');
define('STATIC_TEXT_RECHARGED_BY_SARATHI', 'recharged by sarathi');
/////////////////////////////moloy start//////////////////////////////////////////
define('UID_ADMIN_PREFIX', 'ADMIN_');
define('UID_ADMINISTRATOR_PREFIX', 'ADMINISTRATOR_');
define('UID_FRANCHISE_PREFIX', 'FRANCHISE_');
define('UID_SUBFRANCHISE_PREFIX', 'SUBFRANCHISE_');
define('UID_IMAGES_PREFIX', 'IMAGES_');
define('UID_SERVICE_PREFIX', 'SERVICE_');
define('UID_SPLASH_PREFIX', 'SPLASH_');
define('UID_VEHICLE_PREFIX', 'VEHICLE_');
define('UID_SCHEME_PREFIX', 'SCHEME_');
define('UID_RENTAL_SLAB_PREFIX', 'RENTAL_SLAB_');
define('KEY_IMAGE', 'IMAGE');
define('KEY_ADMIN', 'ADMIN');
define('KEY_FRANCHISE', 'FRANCHISE');
define('KEY_ADMINISTRATOR', 'ADMINISTRATOR');
define('KEY_SUBFRANCHISE', 'SUBFRANCHISE');
define('KEY_SPLASH', 'SPLASH');
define('KEY_VEHICLE', 'VEHICLE');
define('KEY_SCHEME', 'SCHEME');
define('KEY_RENTAL_SLAB', 'RENTAL_SLAB');
/////////////////////////////////////////////////////////////////////////
define('base_url', 'https://v-xplore.com/dev/ci_jadu/');
define('const_x_api_key', '4c174057-0a6b-4fe8-98df-5699fac7c51a');
define('const_google_api_key', 'AIzaSyDCx7UqFSWYeSjVzcXbgBKB5nnarnHZWoM');
//////////////////////////////////////////////////////////////////////////
define('text_account_not_active', 'Your account is not active');
//////////////// constant value to check access permission ///////////////
define('access_franchise_data', 'permission_franchise');
define('access_subfranchise_data', 'permission_sub_franchise');
define('access_sarathi_data', 'permission_sarathi');
define('access_driver_data', 'permission_driver');
define('access_customers_data', 'permission_customers');
define('access_incentives_scheme', 'permission_incentives_scheme');
define('access_call_booking', 'permission_call_booking');
define('access_ride_rental', 'permission_ride_rental');
define('access_fare_management', 'permission_fare_management');
define('access_service_ride', 'permission_service_ride');
define('access_compliments', 'permission_compliments');
define('access_achivements', 'permission_achivements');
define('access_help', 'permission_help');
define('access_feedback', 'permission_feedback');
define('access_reports', 'permission_reports');
define('access_places', 'permission_places');
define('access_coupon', 'permission_coupon');
define('access_packages', 'packages');
///////////////// Session data for access permission /////////////////////
define('session_admin_specific_id', 'admin_specific_id');
define('session_franchise_data', 'franchise_data');
define('session_subfranchise_data', 'subfranchise_data');
define('session_sarathi_data', 'sarathi_data');
define('session_driver_data', 'driver_data');
define('session_customers_data', 'customers_data');
define('session_incentive', 'incentive');
define('session_call_booking', 'call_booking');
define('session_ride_rental', 'ride_rental');
define('session_fare_list', 'fare_list');
define('session_service_ride', 'service_ride');
define('session_compliments', 'compliments');
define('session_achivements', 'achivements');
define('session_help', 'help');
define('session_feedback', 'feedback');
define('session_reports', 'reports');
define('session_places', 'places');
define('session_coupon', 'coupon');
define('session_packages', 'packages');
//////////////////////////////////////////////////////////////
define('sarathi_session_driver_data', 'sarathi_driver_data');
define('sarathi_session_incentive', 'sarathi_incentive');
define('sarathi_session_call_booking', 'sarathi_call_booking');
define('sarathi_session_ride_rental', 'sarathi_ride_rental');
define('sarathi_session_fare_list', 'sarathi_fare_list');
define('sarathi_session_service_ride', 'sarathi_service_ride');
define('sarathi_session_compliments', 'sarathi_compliments');
define('sarathi_session_achivements', 'sarathi_achivements');
define('sarathi_session_help', 'sarathi_help');
define('sarathi_session_feedback', 'sarathi_feedback');
define('sarathi_session_reports', 'sarathi_reports');
define('sarathi_session_places', 'sarathi_places');
define('sarathi_session_coupon', 'sarathi_coupon');
//////////////////////////////////////////////////////////////////////
define('fr_session_subfranchise_data', 'fr_subfranchise_data');
define('fr_session_sarathi_data', 'fr_sarathi_data');
define('fr_session_customers_data', 'fr_customers_data');
define('fr_session_driver_data', 'fr_driver_data');
define('fr_session_incentive', 'fr_incentive');
define('fr_session_call_booking', 'fr_call_booking');
define('fr_session_ride_rental', 'fr_ride_rental');
define('fr_session_fare_list', 'fr_fare_list');
define('fr_session_service_ride', 'fr_service_ride');
define('fr_session_compliments', 'fr_compliments');
define('fr_session_achivements', 'fr_achivements');
define('fr_session_help', 'fr_help');
define('fr_session_feedback', 'fr_feedback');
define('fr_session_reports', 'fr_reports');
define('fr_session_places', 'fr_places');
define('fr_session_coupon', 'fr_coupon');
////////////////////////////////////////////////////
define('const_user_admin', 'user_admin');
define('value_razorpay_key', 'razorpay_key');
define('value_google_api_key', 'google_api_key');
define('value_sos_number', 'sos_number');
/////////////////////////////////////////////////
define('field_recharge_type', 'recharge_type');
define('field_recharge_amount', 'recharge_amount');
define('field_original_km', 'original_km');
define('field_extra_km', 'extra_km');
define('field_otp', 'otp');
define('field_paid_to_user_id', 'paid_to_user_id');
define('field_payment_status', 'payment_status');
define('field_payment_mode', 'payment_mode');
define('table_recharge_history', 'recharge_history');
define('STATIC_RECHARGE_TYPE_RECEIVED', 'received');
define('STATIC_RECHARGE_TYPE_PAID', 'paid');
define('STATIC_RECHARGE_MODE_CASH', 'cash');
define('STATIC_RECHARGE_MODE_ONLINE', 'online');
define('STATIC_RECHARGE_FOR_SELF', 'Self Recharge');
define('STATIC_RECHARGE_TO_DRIVER', 'Recharged Driver');
define('STATIC_RUPEE_SIGN', '₹');
define('key_dashboard_data', 'dashboardData');
define('key_short_detail', 'shortDetail');
define('key_transaction_for', 'transactionFor');
define('key_purchesed_km', 'purchesedKm');
define('key_recharge_type', 'rechargeType');
define('key_reports', 'reports');
define('key_details', 'details');
define('key_activities', 'activities');
define('key_price', 'price');
define('key_description', 'description');
define('key_date','date');
define('key_color_code', 'color_code');
define('key_recharge_note', 'rechargeNote');
define('color_recharge_paid', '#FF061F');
define('color_recharge_self', '#1FAE15');
///////////////////////////////////////////
define('value_sort_dir_asc', 'asc');
define('value_sort_dir_desc', 'desc');
define('field_rate_per_km', 'rate_per_km');
define('table_rate_per_km', 'rate_per_km');
define('field_percentage', 'percentage');
define('table_excess_percentage', 'excess_percentage');
define('key_id', 'id');
define('key_name','name');
define('unit_km', 'KM');
///////////////////////////////////////////
define('marker_path', 'assets/images/');
define('marker_waiting_car', 'green_car.png');
define('marker_inactive_car', 'red_car.png');
define('marker_running_car', 'yellow_car.png');

define('STATUS_DRIVER_WAITING', 'DRIVER_WAITING');
define('STATUS_DRIVER_INACTIVE', 'DRIVER_INACTIVE');
define('STATUS_DRIVER_GO_TO', 'DRIVER_GO_TO');
////////////////////////////////////////////////////////////////
define('query_param_id', 'id');
