<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(field_location);
    }

    private function userid_exists($userid, $field_name, $table_name)
    {
        $this->db->select($field_name);
        $this->db->from($table_name);
        $this->db->where($field_name, $userid);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_admin_details()
    {

        $this->db->select(table_users . '.' . field_uid . ',' . table_users . '.' . field_name . ',' . table_users . '.' . field_email . ',' . table_users . '.' . field_mobile . ',' . table_users . '.' . field_status);
        $this->db->from(table_users);
        $this->db->join(table_admin, table_users . '.' . field_uid . '=' . table_admin . '.' . field_user_id);
        $this->db->where_not_in(table_users . '.' . field_status, const_deleted);
        $this->db->where(table_users . '.' . field_type_id, value_user_admin);

        $query = $this->db->get();
        return $query->result();
    }

    public function delete_admin_details($userid)
    {
        $uid_exist = $this->userid_exists($userid, field_uid, table_users);
        if ($uid_exist) {
            $this->db->set([field_status => const_deleted, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $userid);
            $this->db->update(table_users);
            $this->db->affected_rows() == 1 ? true : false;
        } else
            return false;
    }


    public function deactive_admin_status($userid)
    {
        $uid_exist = $this->userid_exists($userid, field_uid, table_users);
        if ($uid_exist) {
            $this->db->set([field_status => const_deactive, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $userid);
            $this->db->update(table_users);
            $this->db->affected_rows() == 1 ? true : false;
        } else
            return false;
    }


    public function active_admin_status($userid)
    {
        $uid_exist = $this->userid_exists($userid, field_uid, table_users);
        if ($uid_exist) {

            $this->db->set([field_status => const_active, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $userid);
            $this->db->update(table_users);
            return ($this->db->affected_rows() == 1 ? true : false);
        } else
            return false;
    }


    public function update_admin_details($user_id, $array, $access, $panel)
    {

        $this->db->where(field_uid, $user_id);
        $update = $this->db->update(table_users, $array);
        if ($update) {
            $deleted = $this->db->where(field_user_id, $user_id)->delete(table_permission);
            if ($deleted) {
                $permission = $this->db->insert_batch(table_permission, $access);
                if ($permission) {
                    $permission = $this->db->where(field_user_id, $user_id)->update(table_panel_access_permissions, $panel);
                    return ($this->db->affected_rows() == 1) ? true : false;
                }
            }
        }
    }

    public function add_admin_details($user_id, $user_type_id, $input_data, $admin_data, $access, $panel_access)
    {
        $uid_exist = $this->userid_exists($user_id, field_uid, table_users);
        if ($uid_exist) {
            return false;
        } else {
            $this->db->set([field_uid => $user_id, field_type_id => $user_type_id]);
            $insert = $this->db->insert(table_users, $input_data);
            if ($insert) {
                $this->db->set(field_user_id, $user_id);
                $admin = $this->db->insert(table_admin, $admin_data);
                if ($admin) {
                    $permission = $this->db->insert_batch(table_permission, $access);
                    if ($permission) {
                        $this->db->insert(table_panel_access_permissions, $panel_access);
                        return ($this->db->affected_rows() == 1) ? true : false;
                    }
                }
            }
        }
    }


    ////////////////////////////// Splash Data /////////////////////////////////////////////

    public function splash_data($splash_for)
    {
        $this->db->select('uid as id, heading, body, cover_image_path as image, for');
        $this->db->where('specific_for_app', $splash_for);
        $query = $this->db->get('app_splash_data');
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function delete_splash_data($splash_id)
    {
        $this->db->where(field_uid, $splash_id);
        $this->db->delete(table_app_splash_data);
        return ($this->db->affected_rows() == 1 ? true : false);
    }

    public function update_splash_data($splash_id, $heading, $body, $for)
    {
        $data = [
            'heading' => $heading,
            'body' => $body,
            'for' => $for,
        ];
        $this->db->where('uid', $splash_id);
        $this->db->update('app_splash_data', $data);
        return ($this->db->affected_rows() == 1 ? true : false);
    }

    public function count_splash_limit($for_app)
    {
        $this->db->where('specific_for_app', $for_app);
        $this->db->get('app_splash_data');
        return $this->db->affected_rows();
    }

    public function add_splash_data($splash_id, $heading, $for, $for_app, $body)
    {
        $data = [
            'uid' => $splash_id,
            'heading' => $heading,
            'body' => $body,
            'for' => $for,
            'specific_for_app' => $for_app
        ];
        $this->db->insert('app_splash_data', $data);
        return ($this->db->affected_rows() == 1 ? true : false);
    }





    //////////////////////////////////////////////////////////////////

    public function display_resolved_reports($rating, $specific_id)
    {
        if (!empty($specific_id)) {
            $this->db->select('uid , specific_level_user_id, driver_id, sarathi_id, message, rating, status, modified_by, comments');
            $this->db->where('rating <', $rating);
            $this->db->where('status', 'resolved');
            $this->db->where(field_sarathi_id, $specific_id);
        } else {
            $this->db->select('uid , specific_level_user_id, driver_id, sarathi_id, message, rating, status, modified_by, comments');
            $this->db->where('rating <', $rating);
            $this->db->where('status', 'resolved');
        }

        $query = $this->db->get(table_feedback);
        $query = $query->result_array();

        foreach ($query as $key => $value) {
            $query[$key]['feedbackId'] = $value[field_uid];
            unset($query[$key][field_uid]);

            // get driver
            $driver_id = "";
            $driver_name = "";
            if (array_key_exists(field_driver_id, $value)) {
                $driver_id = $value[field_driver_id];
                $driver_name = $this->get_driver_name_by_driver_id($driver_id);
            }
            $arr = [
                field_id => $driver_id,
                field_name => ucfirst($driver_name)
            ];
            $query[$key]['driver'] = $arr;
            unset($query[$key][field_driver_id]);

            // get sarathi
            $sarathi_id = "";
            $sarathi_name = "";
            if (array_key_exists(field_sarathi_id, $value)) {
                $sarathi_id = $value[field_sarathi_id];
                $sarathi_name = $this->get_sarathi_name_by_sarathi_id($sarathi_id);
            }
            $arr = [
                field_id => $sarathi_id,
                field_name => $sarathi_name
            ];
            $query[$key]['sarathi'] = $arr;
            unset($query[$key][field_sarathi_id]);
        }

        return (!empty($query)) ? $query : null;
    }

    public function display_unresolve_reports($rating, $specific_id)
    {
        if (!empty($specific_id)) {
            $this->db->select('uid , specific_level_user_id, driver_id, sarathi_id, message, rating, status, modified_by, comments');
            $this->db->where('rating <', $rating);
            $this->db->where('status', 'unresolved');
            $this->db->where(field_sarathi_id, $specific_id);
        } else {
            $this->db->select('uid , specific_level_user_id, driver_id, sarathi_id, message, rating, status, modified_by, comments');
            $this->db->where('rating <', $rating);
            $this->db->where('status', 'unresolved');
        }

        $query = $this->db->get(table_feedback);
        $query = $query->result_array();

        foreach ($query as $key => $value) {
            $query[$key]['feedbackId'] = $value[field_uid];
            unset($query[$key][field_uid]);

            // get driver
            $driver_id = "";
            $driver_name = "";
            if (array_key_exists(field_driver_id, $value)) {
                $driver_id = $value[field_driver_id];
                $driver_name = $this->get_driver_name_by_driver_id($driver_id);
            }
            $arr = [
                field_id => $driver_id,
                field_name => ucfirst($driver_name)
            ];
            $query[$key]['driver'] = $arr;
            unset($query[$key][field_driver_id]);

            // get sarathi
            $sarathi_id = "";
            $sarathi_name = "";
            if (array_key_exists(field_sarathi_id, $value)) {
                $sarathi_id = $value[field_sarathi_id];
                $sarathi_name = $this->get_sarathi_name_by_sarathi_id($sarathi_id);
            }
            $arr = [
                field_id => $sarathi_id,
                field_name => $sarathi_name
            ];
            $query[$key]['sarathi'] = $arr;
            unset($query[$key][field_sarathi_id]);
        }
        return (!empty($query)) ? $query : [];
    }

    public function display_feedback($specific_id)
    {
        if (!empty($specific_id)) {
            $this->db->select(field_uid . ',' . field_specific_level_user_id . ',' . field_driver_id . ',' . field_sarathi_id . ',' . field_message . ',' . field_rating . ',' . field_status . ',' . field_modified_by . ',' . field_comments);
            $this->db->where(field_sarathi_id, $specific_id);
        } else {
            $this->db->select(field_uid . ',' . field_specific_level_user_id . ',' . field_driver_id . ',' . field_sarathi_id . ',' . field_message . ',' . field_rating . ',' . field_status . ',' . field_modified_by . ',' . field_comments);
        }

        $query = $this->db->get(table_feedback);
        $query = $query->result_array();

        foreach ($query as $key => $value) {
            $query[$key]['feedbackId'] = $value[field_uid];
            unset($query[$key][field_uid]);

            // get driver
            $driver_id = "";
            $driver_name = "";
            if (array_key_exists(field_driver_id, $value)) {
                $driver_id = $value[field_driver_id];
                $driver_name = $this->get_driver_name_by_driver_id($driver_id);
            }
            $arr = [
                field_id => $driver_id,
                field_name => ucfirst($driver_name)
            ];
            $query[$key]['driver'] = $arr;
            unset($query[$key][field_driver_id]);

            // get sarathi
            $sarathi_id = "";
            $sarathi_name = "";
            if (array_key_exists(field_sarathi_id, $value)) {
                $sarathi_id = $value[field_sarathi_id];
                $sarathi_name = $this->get_sarathi_name_by_sarathi_id($sarathi_id);
            }
            $arr = [
                field_id => $sarathi_id,
                field_name => $sarathi_name
            ];
            $query[$key]['sarathi'] = $arr;
            unset($query[$key][field_sarathi_id]);
        }

        return (!empty($query)) ? $query : null;
    }

    public function get_sarathi_name_by_sarathi_id($sarathi_id)
    {
        // $this->db->select('u.name');
        // $this->db->from('users as u');
        // $this->db->join('sarathi as s','u.uid = s.user_id');
        // $this->db->where('s.uid', $sarathi_id);

        $this->db->select(table_users . '.' . field_name);
        $this->db->from(table_users);
        $this->db->join(table_sarathi, table_users . '.' . field_uid . '=' . table_sarathi . '.' . field_user_id);
        $this->db->where(table_sarathi . '.' . field_uid, $sarathi_id);

        $query = $this->db->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_name] : null;
    }

    public function get_driver_name_by_driver_id($driver_id)
    {
        // $this->db->select('u.name');
        // $this->db->from('users as u');
        // $this->db->join('driver as d', 'u.uid = d.user_id');
        // $this->db->where('d.uid', $driver_id);

        $this->db->select(table_users . '.' . field_name);
        $this->db->from(table_users);
        $this->db->join(table_driver, table_users . '.' . field_uid . '=' . table_driver . '.' . field_user_id);
        $this->db->where(table_driver . '.' . field_uid, $driver_id);

        $query = $this->db->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_name] : null;
    }


    public function change_report_status($id, $status_value)
    {
        $data = [
            field_status => $status_value
        ];
        $this->db->where(field_uid, $id);
        $this->db->update(table_feedback, $data);
        return ($this->db->affected_rows() == 1 ? true : false);
    }

    public function submit_report_comment($id, $comment, $status, $specific_id)
    {
        $data = [
            field_status => $status,
            field_comments => $comment,
            field_modified_by => $specific_id,
            field_modified_at => date(field_date)
        ];
        $this->db->where(field_uid, $id);
        $this->db->update(table_feedback, $data);
        return ($this->db->affected_rows() == 1 ? true : false);
    }

    public function get_specific_id_by_uid($user_id, $table)
    {

        $this->db->select($table . '.' . field_uid);
        $this->db->from($table);
        $this->db->join(table_users, table_users . '.' . field_uid . '=' . $table . '.' . field_user_id);
        $this->db->where(table_users . '.' . field_uid, $user_id);
        $query = $this->db->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_uid] : null;
    }

    public function save_profile_image($image, $user_id)
    {
        $data = [
            "profile_image" => $image
        ];

        $this->db->where('uid', $user_id);
        $this->db->update('users', $data);
        return ($this->db->affected_rows() == 1 ? true : false);
    }

    public function match_old_password($specific_id, $old_password, $table)
    {
        $this->db->where([field_uid => $specific_id, field_password => $old_password]);
        $this->db->get($table);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function set_new_password($specific_id, $new_password, $table)
    {
        $data = [
            field_password => $new_password
        ];
        $this->db->where(field_uid, $specific_id);
        $this->db->update($table, $data);
        return ($this->db->affected_rows() == 1 ? true : false);
    }

    public function update_user_profile_details($user_id, $name, $dob, $gender)
    {
        $input_data = [
            field_name => $name,
            field_dob => $dob,
            field_gender => $gender
        ];
        $this->db->where(field_uid, $user_id);
        $this->db->update(table_users, $input_data);
        return ($this->db->affected_rows() == 1 ? true : false);
    }


    // date 1/11/22

    public function display_fare_list()
    {
        $this->db->select('f.uid, f.base_fare, f.slab_1, f.slab_2, f.slab_3, f.slab_3, f.slab_4, f.slab_5, f.per_minute, f.extra_time_fare, f.arriving_free_km, f.arriving_fare, f.airport_fare, f.night, f.cancle_fee, f.jadu_fee, rst.name as vehicle_type');
        $this->db->from('fare_list as f');
        $this->db->join('ride_service_type as rst', 'rst.uid = f.ride_service_type_id');
        $this->db->where('f.status', const_active);
        $query = $this->db->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function update_fare_price($vehicle_id, $data)
    {
        $this->db->where(field_uid, $vehicle_id);
        $this->db->update(table_fare_list, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function display_documentation_content($for_app)
    {
        $this->db->where(field_name, $for_app);
        $query = $this->db->get('system_preferance');
        $query = $query->result_array();
        return (!empty($query)) ? $query[0] : [];
    }

    public function update_documentation_content($name, $value, $specific_id)
    {
        $this->db->set([field_value => $value, field_created_by => $specific_id]);
        $this->db->where(field_name, $name);
        $this->db->update('system_preferance');
        return ($this->db->affected_rows() == 1) ? true : false;
    }


    public function get_gid_by_mobile($mobile)
    {
        $this->db->select('gid');
        $this->db->where('mobile', $mobile);
        $query = $this->db->get(table_users);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_group_id] : null;
    }

    public function display_user_address($gid)
    {
        $this->db->where('gid', $gid);
        $query = $this->db->get('user_address');
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function get_gid_by_user_id($user_id)
    {
        $this->db->select(field_group_id);
        $this->db->where(field_uid, $user_id);
        $query = $this->db->get(table_users);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_group_id] : null;
    }

    public function display_bank_details($gid)
    {
        $this->db->where(field_group_id, $gid);
        $query = $this->db->get(table_user_bank_details);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    /////////////////// Services /////////////////////////////////////

    public function display_service_name()
    {
        $this->db->where(field_status, const_active);
        $query = $this->db->get(table_services);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function display_ride_names($service_id)
    {
        $this->db->where([field_service_id => $service_id, field_status => const_active]);
        $query = $this->db->get(table_ride_service_type);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function display_cab_names($ride_id)
    {
        $this->db->where([field_ride_service_type_id => $ride_id, field_status => const_active]);
        $query = $this->db->get(table_cabs_under_service_type);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function add_service_type($service_id, $service_name, $specific_id)
    {
        $this->db->where([field_name => $service_name, field_status => const_active]);
        $this->db->get(table_services);
        $exist = $this->db->affected_rows();
        if ($exist == 0) {
            $data = [
                field_uid => $service_id,
                field_name => $service_name,
                field_created_at => date(field_date),
                field_modified_at => date(field_date),
                field_created_by => $specific_id,
                field_modified_by => $specific_id,

            ];
            $this->db->insert(table_services, $data);
            return ($this->db->affected_rows() == 1) ? true : false;
        } else {
            return false;
        }
    }

    public function add_ride_type($ride_id, $service_id, $ride_name, $image, $normal_rate, $outstation_rate, $specific_id) // depriciated
    {
        $this->db->where([field_name => $ride_name, field_status => const_active]);
        $this->db->get(table_services);
        $exist = $this->db->affected_rows();
        $data = [
            'uid' => $ride_id,
            'service_id' => $service_id,
            'name' => $ride_name,
            'image' => $image,
            'rate_per_km_normal' => $normal_rate,
            'rate_per_km_outstation' => $outstation_rate,
            'created_at' => date(field_date),
            'modified_at' => date(field_date),
            'created_by' => $specific_id,
            'modified_by' => $specific_id,
        ];

        $insert = $this->db->insert(table_ride_service_type, $data);
        if ($insert) {
            $this->db->insert(table_fare_list, [field_ride_service_type_id => $ride_id]);
            return ($this->db->affected_rows() == 1) ? true : false;
        }
    }

    public function add_cab_name($uid, $ride_id, $cab_name)
    {
        $this->db->where([field_name => $cab_name, "ride_service_type_id" => $ride_id, field_status => const_active]);
        $this->db->get(table_cabs_under_service_type);
        $exist = $this->db->affected_rows();
        if ($exist == 0) {
            $data = [
                field_uid => $uid,
                field_ride_service_type_id => $ride_id,
                field_name => $cab_name,
                field_created_at => date(field_date),
                field_modified_at => date(field_date)
            ];
            $this->db->insert(table_cabs_under_service_type, $data);
            return ($this->db->affected_rows() == 1) ? true : false;
        } else {
            return false;
        }
    }

    public function delete_cab_type($id, $table)
    {
        $this->db->set(field_status, const_deleted);
        $this->db->where(field_uid, $id);
        $this->db->update($table);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function delete_ride_type($id, $table)
    {
        $this->db->set(field_status, const_deleted);
        $this->db->where(field_uid, $id);
        $delete = $this->db->update($table);
        if ($delete) {
            $this->delete_cab_under_service_type($id);
            $this->delete_ride_from_fare_list($id);
            return ($this->db->affected_rows() == 1) ? true : false;
        } else {
            return false;
        }
    }

    public function delete_cab_under_service_type($id)
    {
        $this->db->set(field_status, const_deleted);
        $this->db->where('ride_service_type_id', $id);
        $this->db->update('cabs_under_service_type');
    }

    public function delete_ride_from_fare_list($id)
    {
        $this->db->set(field_status, const_deleted);
        $this->db->where('ride_service_type_id', $id);
        $this->db->update('fare_list');
    }

    public function get_ride_id_by_service_id($id)
    {
        $this->db->select(field_uid);
        $this->db->where(field_service_id, $id);
        $query = $this->db->get(table_ride_service_type);
        $query = $query->result();
        return (!empty($query)) ? $query : null;
    }


    public function delete_service_type($id, $table)
    {
        $this->db->set(field_status, const_deleted);
        $this->db->where(field_uid, $id);
        $delete = $this->db->update($table);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function get_sarathi_help_number()
    {

        $this->db->select(field_value . ',' . field_name);
        $this->db->where(field_name, "sarathi_helpline_number");
        $query = $this->db->get(table_system_preferance);
        $query = $query->result();

        foreach ($query as $q) {
            $len = strpos($q->name, "_");
            $q->name = substr($q->name, 0, $len);
        }
        return (!empty($query)) ? $query[0] : null;
    }
    public function get_driver_help_number()
    {

        $this->db->select(field_value . ',' . field_name);
        $this->db->where(field_name, "driver_helpline_number");
        $query = $this->db->get(table_system_preferance);
        $query = $query->result();

        foreach ($query as $q) {
            $len = strpos($q->name, "_");
            $q->name = substr($q->name, 0, $len);
        }

        return (!empty($query)) ? $query[0] : null;
    }

    public function get_customer_help_number()
    {

        $this->db->select(field_value . ',' . field_name);
        $this->db->where(field_name, "customer_helpline_number");
        $query = $this->db->get(table_system_preferance);
        $query = $query->result();

        foreach ($query as $q) {
            $len = strpos($q->name, "_");
            $q->name = substr($q->name, 0, $len);
        }

        return (!empty($query)) ? $query[0] : null;
    }

    public function edit_helpline_number($type, $number, $specific_id)
    {
        $data = [
            field_value => $number,
            field_created_by => $specific_id
        ];
        $this->db->where(field_name, $type);
        $this->db->update(table_system_preferance, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function display_help_model()
    {
        $this->db->where(field_status, const_unresolved);
        $query = $this->db->get(table_help);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function resolve_help($uid, $specific_id, $comment, $modified_by)
    {
        $data = [
            "comment" => $comment,
            "status" => const_resolved,
            "modified_by" => $modified_by
        ];
        $this->db->where([field_uid => $uid, field_specific_level_user_id => $specific_id]);
        $this->db->update(table_help, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function save_delivery_guideline($guide, $specific_id)
    {
        $this->db->set([field_value => $guide, field_created_by => $specific_id, field_created_at => date(field_date)]);
        $this->db->where(field_name, const_delivery_guidelines);
        $this->db->update(table_system_preferance);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function display_delivery_guideline()
    {
        $this->db->select(field_value);
        $this->db->where(field_name, const_delivery_guidelines);
        $query = $this->db->get(table_system_preferance);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_value] : [];
    }


    public function get_driver_ride_history($specific_id)
    {
        $sql = "SELECT rst.name, rst.image, 
            rn.uid id, rn.service_id serviceId, rn.customer_id customerId, rn.driver_id driverId, rn.fare, 
            rn.origin, rn.destination, rn.waypoints, rn.locationText, rn.rideStartDateTime tripStartTime, rn.rideEndDateTime tripEndTime,
            s.name serviceName, s.image serviceImage, DATE(rn.created_at) AS ride_date, rn.service_id AS serviceId
            FROM ride_normal rn 
            LEFT JOIN services s ON rn.service_id = s.uid
            LEFT JOIN ride_service_type rst ON rst.uid = rn.fareServiceTypeId
            WHERE rn.driver_id = '$specific_id' AND ride_status = 'completed' 
            ";


        $query = $this->db->query($sql);
        $query = $query->result_array();

        foreach ($query as $key => $value) {
            $query[$key]['image'] = base_url() . $value['image'];
            $query[$key]['customer'] = $this->get_user_name_by_specific_id($value['customerId'], $value['serviceId'], 'customer');

            $locationData = $this->decodeLocations($value['origin'], $value['destination'], $value['waypoints'], $value['locationText']);

            unset($query[$key]['origin']);
            unset($query[$key]['destination']);
            unset($query[$key]['waypoints']);
            unset($query[$key]['locationText']);
            unset($query[$key]['customerId']);
            unset($query[$key]['driverId']);

            $query[$key]['origin'] = $locationData['origin'];
            $query[$key]['destinations'] = $locationData['destinations'];

            $query[$key]['service'] = [
                'id' => $value['serviceId'],
                'name' => $value['serviceName'],
                'image' => base_url() . $value['serviceImage']
            ];

            unset($query[$key]['serviceId']);
            unset($query[$key]['serviceName']);
            unset($query[$key]['serviceImage']);

            $query[$key]['ride'] = [
                'id' => $value['id'],
                'type' => $value['name'],
                'typeImage' => base_url() . $value['image'],
                'fare' => $value['fare']
            ];

            unset($query[$key]['id']);
            unset($query[$key]['name']);
            unset($query[$key]['image']);
            unset($query[$key]['fare']);
        }

        return (!empty($query)) ? $query : [];
    }


    private function decodeLocations($origin, $destination, $waypoints, $locationText)
    {
        $originLatLng = (array)json_decode($origin);

        $destinationLatLng = (array)json_decode($destination);
        $waypoints = (array)json_decode($waypoints);

        $destinationWithWaypoints = [];

        if (!empty($waypoints)) {
            foreach ($waypoints as $k => $v) $destinationWithWaypoints[] = (array)$v;
        }

        $locationText = (array)json_decode($locationText);

        $destinationData = [];

        if (!empty($locationText)) {
            $originData = [
                'address' => $locationText[0]->startAddress,
                'place' => [
                    'lat' => $originLatLng['lat'],
                    'lng' => $originLatLng['lng'],
                ]
            ];
        }

        if (count($locationText) > 1) {
            $j = 0;
            $i = 0;
            foreach ($locationText as $locationKey => $locationValue) {
                if ($j == 0) {
                    $j++;
                    continue;
                }

                $destinationData[] = [
                    'address' => $locationValue->startAddress,
                    'place' => $destinationWithWaypoints[$i++]
                ];
            }
            $destinationData[] = [
                'address' => $locationText[array_key_last($locationText)]->endAddress,
                'place' => $destinationLatLng
            ];
        } else {
            if (!empty($locationText)) {
                $destinationData[] = [
                    'address' => $locationText[0]->endAddress,
                    'place' => $destinationLatLng
                ];
            }
        }
        return [
            'origin' => (isset($originData)) ? $originData : '',
            'destinations' => $destinationData
        ];
    }


    private function get_user_name_by_specific_id($specific_id, $service_id, $user_type)
    {
        if ($user_type == 'customer' && $service_id != 'SERVICE_HOTEL') {
            $this->db->select('u.name, u.mobile, u.uid as user_id')
                ->from('users as u')
                ->join(table_customer . ' as c', 'c.user_id = u.uid')
                ->where('c.uid', $specific_id);
            $query = $this->db->get();
            $query = $query->result_array();
        } else if (($user_type == 'customer') && $service_id == 'SERVICE_HOTEL') {
            $query = $this->db->select('name, mobile')
                ->where('uid', $specific_id)->get('hotel');
            $query = $query->result_array();
        }

        $default = [
            "name" => "____",
            "mobile" => ""
        ];

        return (!empty($query)) ? $query[0] : $default;
    }

    public function display_customer_ride_history($specific_id)
    {
        $sql = "SELECT rst.name, rst.image, 
        rn.uid id, rn.service_id serviceId, rn.customer_id customerId, rn.driver_id driverId, rn.fare, 
        rn.origin, rn.destination, rn.waypoints, rn.locationText, rn.rideStartDateTime tripStartTime, rn.rideEndDateTime tripEndTime,
        s.name serviceName, s.image serviceImage, DATE(rn.created_at) AS ride_date, rn.service_id AS serviceId
        FROM ride_normal rn 
        LEFT JOIN services s ON rn.service_id = s.uid
        LEFT JOIN ride_service_type rst ON rst.uid = rn.fareServiceTypeId
        WHERE rn.customer_id = '$specific_id' AND ride_status = 'completed' 
        ";

        $query = $this->db->query($sql);
        $query = $query->result_array();

        foreach ($query as $key => $value) {
            $query[$key]['image'] = base_url() . $value['image'];
            $query[$key]['driver'] = $this->get_user_name_by_specific_id($value['driverId'], $value['serviceId'], 'driver');

            $locationData = $this->decodeLocations($value['origin'], $value['destination'], $value['waypoints'], $value['locationText']);

            unset($query[$key]['origin']);
            unset($query[$key]['destination']);
            unset($query[$key]['waypoints']);
            unset($query[$key]['locationText']);
            unset($query[$key]['customerId']);
            unset($query[$key]['driverId']);

            $query[$key]['origin'] = $locationData['origin'];
            $query[$key]['destinations'] = $locationData['destinations'];

            $query[$key]['service'] = [
                'id' => $value['serviceId'],
                'name' => $value['serviceName'],
                'image' => base_url() . $value['serviceImage']
            ];

            unset($query[$key]['serviceId']);
            unset($query[$key]['serviceName']);
            unset($query[$key]['serviceImage']);

            $query[$key]['ride'] = [
                'id' => $value['id'],
                'type' => $value['name'],
                'typeImage' => base_url() . $value['image'],
                'fare' => $value['fare']
            ];

            unset($query[$key]['id']);
            unset($query[$key]['name']);
            unset($query[$key]['image']);
            unset($query[$key]['fare']);
        }

        return (!empty($query)) ? $query : [];
    }

    public function get_customer_ride_history($specific_id)
    {
        $this->db->select('driver_id as companion_id, payment_mode, amount, created_at');
        $this->db->where('customer_id', $specific_id);
        $query = $this->db->get(table_history_ride_transactions);
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $companion_id = $val['companion_id'];
            $query[$i]['companion_name'] = $this->get_driver_name_by_specific_id($companion_id);
        }
        return (!empty($query)) ? $query : [];
    }


    private function get_driver_name_by_specific_id($companion_id)
    {
        $this->db->select('u.name, u.mobile')
            ->from('users as u')
            ->join('driver as d', 'd.user_id = u.uid')
            ->where('d.uid', $companion_id);
        $query = $this->db->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query[0] : "_____";
    }

    public function get_name_by_user_id($user_id)
    {
        $this->db->select(field_name)->where(field_uid, $user_id);
        $query = $this->db->get(table_users);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_name] : null;
    }

    //////// Incentives Scheme ///////////////

    public function get_incentives_scheme()
    {
        $query = $this->db->where_not_in(field_status, const_deleted)->get(table_incentives_scheme);
        $query = $query->result_array();

        return (!empty($query)) ? $query : [];
    }

    public function display_incentives_time_list()
    {
        $query = $this->db->get('incentives_time_list');
        $query = $query->result_array();
        return (!empty($query)) ? $query : [];
    }

    public function update_incentive_scheme_details($scheme_id, $value, $time, $amount, $specific_id)
    {
        $data = [
            "value" => $value,
            "time" => $time,
            "amount" => $amount,
            "modified_at" => date(field_date),
            "modified_by" => $specific_id
        ];
        $this->db->where(field_uid, $scheme_id);
        $this->db->update(table_incentives_scheme, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function active_incentive_scheme($scheme_id, $specific_id)
    {
        $data = [
            field_status => const_active,
            field_modified_at => date(field_date),
            field_modified_by => $specific_id
        ];
        $this->db->where(field_uid, $scheme_id);
        $this->db->update(table_incentives_scheme, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function deactive_incentive_scheme($scheme_id, $specific_id)
    {
        $data = [
            field_status => const_deactive,
            field_modified_at => date(field_date),
            field_modified_by => $specific_id
        ];
        $this->db->where(field_uid, $scheme_id);
        $this->db->update(table_incentives_scheme, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function add_incentives_scheme($scheme_id, $name, $value, $timespan, $amount, $specific_id)
    {
        $data = [
            field_uid => $scheme_id,
            field_name => $name,
            field_value => $value,
            "time" => $timespan,
            "amount" => $amount,
            field_status => const_active,
            field_created_at => date(field_date),
            field_modified_at => date(field_date),
            field_created_by => $specific_id,
            field_modified_by => $specific_id
        ];
        $this->db->insert(table_incentives_scheme, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function delete_incentives_scheme($scheme_id, $specific_id)
    {
        $data = [field_status => const_deleted,  field_modified_at => date(field_date), field_modified_by => $specific_id];
        $this->db->where(field_uid, $scheme_id)->update(table_incentives_scheme, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    ///////////////////// Permission for admin access //////////////////////

    public function get_permission_list()
    {
        $this->db->order_by('hash_id', 'asc');
        $query = $this->db->get('permission_list');
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function get_permission_list_franchise()
    {
        $this->db->where_not_in(field_uid, access_franchise_data);
        $this->db->where_not_in(field_uid, 'permission_customers');
        $this->db->order_by('hash_id', 'asc');
        $query = $this->db->get('permission_list');
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }
    public function get_permission_list_subfranchise()
    {
        $this->db->where_not_in(field_uid, access_franchise_data);
        $this->db->where_not_in(field_uid, access_subfranchise_data);
        $this->db->where_not_in(field_uid, 'permission_customers');

        $this->db->order_by('hash_id', 'asc');
        $query = $this->db->get('permission_list');
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }
    public function get_permission_list_sarathi()
    {
        $this->db->where_not_in(field_uid, access_franchise_data);
        $this->db->where_not_in(field_uid, access_subfranchise_data);
        $this->db->where_not_in(field_uid, access_sarathi_data);
        $this->db->where_not_in(field_uid, 'permission_settings');
        $this->db->where_not_in(field_uid, 'permission_driver');
        $this->db->where_not_in(field_uid, 'permission_customers');

        $this->db->order_by('hash_id', 'asc');
        $query = $this->db->get('permission_list');
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }


    public function is_user_request_exist($admin_id, $permission_id)
    {
        $this->db->where(['specific_id' => $admin_id, "permission_id" => $permission_id])->where_not_in(field_status, const_deactive)->get('permission');
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function send_permission_request($uid, $permission_id, $user_id, $admin_id)
    {
        $data = [
            "uid" => $uid,
            "specific_id" => $admin_id,
            "user_id" => $user_id,
            "permission_id" => $permission_id,
            "status" => const_pending,
            "created_at" => date(field_date),
            "modified_at" => date(field_date)
        ];

        $this->db->insert('permission', $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function get_permission_request_of_user($admin_id)
    {
        $query = $this->db->select('permission_id, status')->where(['specific_id' => $admin_id])->where_not_in('status', const_deactive)->get('permission');
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    //////////////////////////////// Access Start ////////////////////////////////////////////////////

    public function get_access_permission($admin_id, $permission_id)
    {
        $this->db->select('status');
        $this->db->where(['specific_id' => $admin_id, 'permission_id' => $permission_id, 'status' => const_active]);
        $query = $this->db->get('permission');
        $query = $query->result_array();
        return (!empty($query)) ? const_active : const_deactive;
    }

    //////////////////////////////// Access End ////////////////////////////////////////////////////


    public function get_user_request_permission()
    {
        $query = $this->db->select('user_id')->where('status', const_pending)->get('permission');
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function display_admin_details($user_id)
    {
        $query = $this->db->select('u.name, u.email, u.mobile')
            ->from(table_users . ' as u')
            ->join(table_admin . ' as a', 'u.uid=a.user_id')
            ->where('u.uid', $user_id)->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query[0] : [];
    }


    public function display_request_permission_of_admin($user_id)
    {
        $query = $this->db->select('pl.name, p.status, p.user_id, p.permission_id, p.uid as request_id')
            ->from('permission_list as pl')
            ->join('permission as p', 'p.permission_id = pl.uid')
            ->order_by('p.created_at', 'desc')
            ->where(['p.user_id' => $user_id])
            ->where_not_in('p.status', const_deactive)
            ->where_not_in('p.status', const_deleted)->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query : [];
    }



    public function allow_permission_request($user_id, $request_id)
    {
        $data = [
            "status" => const_active,
            "modified_at" => date(field_date)
        ];
        $this->db->where(['user_id' => $user_id, 'uid' => $request_id])->update('permission', $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function deny_permission_request($user_id, $request_id)
    {
        $data = [
            "status" => const_deactive,
            "modified_at" => date(field_date)
        ];
        $this->db->where(['user_id' => $user_id, 'uid' => $request_id])->update('permission', $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }


    ////////////////////////////// Rental Service Starts /////////////////////////
    public function display_rental_slabs()
    {
        $query = $this->db->where_not_in(field_status, const_deleted)->get('rental_slabs');
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function add_rental_slabs($uid, $km, $hour)
    {
        $data = [
            field_uid => $uid,
            "km" => $km,
            "hr" => $hour,
            field_status => const_active,
            field_created_at => date(field_date),
            field_modified_at => date(field_date),
        ];
        $this->db->insert('rental_slabs', $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function active_slab_status($slab_id)
    {
        $data = [
            field_status => const_active,
            field_modified_at => date(field_date)
        ];
        $this->db->where(field_uid, $slab_id)->update('rental_slabs', $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function deactive_slab_status($slab_id)
    {
        $data = [
            field_status => const_deactive,
            field_modified_at => date(field_date)
        ];
        $this->db->where(field_uid, $slab_id)->update('rental_slabs', $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function delete_slab_status($slab_id)
    {
        $data = [
            field_status => const_deleted,
            field_modified_at => date(field_date)
        ];
        $this->db->where(field_uid, $slab_id)->update('rental_slabs', $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function update_rental_slab($slab_id, $hour, $km)
    {
        $data = [
            'hr' => $hour,
            'km' => $km,
            field_modified_at => date(field_date)
        ];
        $this->db->where(field_uid, $slab_id)->update('rental_slabs', $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    //=============================================================

    public function display_rental_features()
    {
        $query = $this->db->get('rental_featuers');
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    //==============================================================

    public function get_cab_types_for_retail_details()
    {
        $query = $this->db->get(table_ride_service_type);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function get_rental_features_for_retail_details()
    {
        $query = $this->db->get(table_rental_featuers);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function delete_rental_features($id)
    {
        $this->db->where(field_uid, $id)->delete(table_rental_featuers);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function display_rental_details($ride_service_type_id)
    {
        $query = $this->db->get('rental_slabs');
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function get_rental_details($slab_id, $ride_id)
    {
        $query = $this->db->where(['rental_slabs_id' => $slab_id, 'ride_service_type_id' => $ride_id])->get('ride_rental_master');
        $query = $query->result_array();
        return (!empty($query)) ? $query[0] : null;
    }

    public function save_rental_details($uid, $ride_type_id, $slab_id, $amount, $km_fare, $time_fare)
    {
        $data = [
            field_uid => $uid,
            field_ride_service_type_id => $ride_type_id,
            field_rental_slabs_id => $slab_id,
            field_amount => $amount,
            field_extra_km_fare => $km_fare,
            field_extra_time_fare => $time_fare,
            field_created_at => date(field_date),
            field_modified_at => date(field_date)
        ];

        $this->db->where(['ride_service_type_id' => $ride_type_id, "rental_slabs_id" => $slab_id])->get('ride_rental_master');
        $row = $this->db->affected_rows();
        if ($row > 0) {
            $this->db->where(['ride_service_type_id' => $ride_type_id, "rental_slabs_id" => $slab_id])->update(table_ride_rental_master, $data);
            return ($this->db->affected_rows() == 1) ? true : false;
        } else {
            $this->db->insert(table_ride_rental_master, $data);
            return ($this->db->affected_rows() == 1) ? true : false;
        }
    }

    public function save_ride_features($new_feature, $ride_id)
    {
        $data = [
            "features_id_data" => $new_feature,
            field_modified_at => date(field_date)
        ];
        $this->db->where(field_uid, $ride_id)->update(table_ride_service_type, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function get_old_feature_data($ride_id)
    {
        $query = $this->db->select('features_id_data')->where(field_uid, $ride_id)->get(table_ride_service_type);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0]['features_id_data'] : null;
    }

    public function get_checked_slabs($ride_id)
    {
        $query = $this->db->select('rental_slabs_id')->where('ride_service_type_id', $ride_id)->get('ride_rental_master');
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function display_compliments_list()
    {
        $query = $this->db->get(table_compliments);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }
    public function delete_compliments($id)
    {
        $this->db->where(field_uid, $id)->delete(table_compliments);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function display_achievement_list()
    {
        $query = $this->db->get(table_achivements);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function delete_achivements($id)
    {
        $this->db->where(field_uid, $id)->delete(table_achivements);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function get_user_permission_access_list_franchise($user_id)
    {

        $this->db->select('uid, name');
        $this->db->where_not_in(field_uid, 'permission_franchise');
        $this->db->order_by('hash_id', 'asc');
        $query = $this->db->get('permission_list');
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $uid = $val['uid'];
            $query[$i]['status'] = $this->get_permission_of_user($uid, $user_id);
        }
        return (!empty($query)) ? $query : null;
    }

    public function get_user_permission_access_list_subfranchise($user_id)
    {
        $this->db->select('uid, name');
        $this->db->where_not_in(field_uid, 'permission_franchise');
        $this->db->where_not_in(field_uid, 'permission_sub_franchise');
        $this->db->order_by('hash_id', 'asc');
        $query = $this->db->get('permission_list');
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $uid = $val['uid'];
            $query[$i]['status'] = $this->get_permission_of_user($uid, $user_id);
        }
        return (!empty($query)) ? $query : null;
    }

    public function get_user_permission_access_list_sarathi($user_id)
    {
        $this->db->select('uid, name');
        $this->db->where_not_in(field_uid, 'permission_franchise');
        $this->db->where_not_in(field_uid, 'permission_sub_franchise');
        $this->db->where_not_in(field_uid, 'permission_sarathi');
        $this->db->where_not_in(field_uid, 'permission_settings');
        $this->db->where_not_in(field_uid, 'permission_driver');
        $this->db->order_by('hash_id', 'asc');
        $query = $this->db->get('permission_list');
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $uid = $val['uid'];
            $query[$i]['status'] = $this->get_permission_of_user($uid, $user_id);
        }
        return (!empty($query)) ? $query : null;
    }

    public function get_user_permission_access_list($user_id)
    {
        $this->db->select('uid, name');
        $this->db->order_by('hash_id', 'asc');
        $query = $this->db->get('permission_list');
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $uid = $val['uid'];
            $query[$i]['status'] = $this->get_permission_of_user($uid, $user_id);
        }
        return (!empty($query)) ? $query : null;
    }


    public function get_permission_of_user($uid, $user_id)
    {
        $query = $this->db->where(['permission_id' => $uid, field_user_id => $user_id, field_status => const_active])->get(table_permission);
        $query = $query->result_array();
        return (!empty($query)) ? "selected" : "";
    }

    public function display_driver_location()
    {
        $this->db->select('u.uid as user_id, d.uid as driver_id, d.current_lat as lat, d.current_lng as lng, u.name as driver_name, d.working_status_current_value as driver_status, d.totalTravelled, d.vehicle_number, rst.name as vehicle_type, cst.name as vehicle_name');
        $this->db->from('driver as d');
        $this->db->join('users as u', 'u.uid = d.user_id');
        $this->db->join(table_ride_service_type.' as rst', 'd.service_type_id = rst.uid');
        $this->db->join(table_cabs_under_service_type.' as cst', 'd.cabs_under_service_type = cst.uid');
        $this->db->where('u.status', const_active);
        $this->db->where_not_in('d.current_lat', 'NULL');
        $this->db->where_not_in('d.current_lng', 'NULL');
        $this->db->where_not_in('d.working_status_current_value', 'NULL');
        $query = $this->db->get();
        $query = $query->result_array();

        foreach ($query as $i => $val) {
            $query[$i]['driver_name'] = ucwords($val['driver_name']);
            $query[$i]['vehicle_type'] = ucwords($val['vehicle_type']);
            $query[$i]['vehicle_name'] = ucwords($val['vehicle_name']);
            $query[$i]['recharge_amount'] = $this->get_total_recharge_amount($val['user_id']);

        }
        return (!empty($query)) ? $query : null;
    }

    public function add_coupon_data($coupon_id, $coupon_code, $coupon_type, $value, $usage, $user_type, $expired_at, $specific_id)
    {
        $data = [
            field_uid => $coupon_id,
            "code" => $coupon_code,
            "type" => $coupon_type,
            "value" => $value,
            "usage_per_users" => $usage,
            "for_user" => $user_type,
            "expired_at" => $expired_at,
            "validity" => const_active,
            "created_at" => date(field_date),
            "created_by" => $specific_id
        ];
        $this->db->insert(table_coupons, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function get_coupon_details()
    {
        $query = $this->db->get('coupons');
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $query[$i]['for_user'] = str_replace("_", " ", $val['for_user']);
            $query[$i]['count'] = $this->get_total_user_of_coupon($val['uid']);
        }
        return (!empty($query)) ? $query : null;
    }

    public function get_total_user_of_coupon($uid)
    {
        $this->db->where('coupon_id', $uid)->get(table_customer_coupons);
        return $this->db->affected_rows();
    }

    public function active_coupon($uid, $specific_id)
    {
        $data = [
            "validity" => const_active,
            "created_by" => $specific_id,

        ];
        $this->db->where(field_uid, $uid)->update(table_coupons, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function deactive_coupon($uid, $specific_id)
    {
        $data = [
            "validity" => const_deactive,
            "created_by" => $specific_id,
        ];
        $this->db->where(field_uid, $uid)->update(table_coupons, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function delete_coupons($uid)
    {
        $this->db->where(field_uid, $uid)->delete(table_coupons);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function update_coupon_details($id, $type, $for_user, $value, $usage, $expired_at, $specific_id)
    {
        $data = [
            "type" => $type,
            "for_user" => $for_user,
            "value" => $value,
            "usage_per_users" => $usage,
            "created_at" => date(field_date),
            "expired_at" => $expired_at,
            "created_by" => $specific_id
        ];

        $this->db->where(field_uid, $id)->update(table_coupons, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }


    public function insert_bank_details($uid, $gid, $account_holder, $account_number, $ifsc, $bank_name, $branch)
    {
        $data = [
            field_uid => $uid,
            field_group_id => $gid,
            "account_holder_name" => $account_holder,
            "account_number" => $account_number,
            "ifsc" => $ifsc,
            "bank_name" => $bank_name,
            "branch_name" => $branch,
            field_created_at => date(field_date),
            field_modified_at => date(field_date)
        ];

        $this->db->insert(table_user_bank_details, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function update_bank_details($gid, $account_number, $ifsc, $bank_name, $branch)
    {
        $data = [
            "account_number" => $account_number,
            "ifsc" => $ifsc,
            "bank_name" => $bank_name,
            "branch_name" => $branch,
            field_modified_at => date(field_date)
        ];
        $this->db->where(field_group_id, $gid)->update(table_user_bank_details, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function check_gid_exists($gid)
    {
        $this->db->where(field_group_id, $gid)->get(table_user_bank_details);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function get_key_details($key)
    {
        $query = $this->db->where([field_name => $key])->get(table_system_preferance);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function save_key_details($key, $name, $specific_id)
    {
        $data = [
            field_value => $key,
            field_created_by => $specific_id,
            field_created_at => date(field_date)
        ];
        $this->db->where(field_name, $name)->update(table_system_preferance, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }




    public function display_panel_access_list()
    {
        $query = $this->db->get(table_panel_access_permissions_list);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }




    /////////// ADD PLACES /////////
    public function display_country_name()
    {
        $query = $this->db->where(['type' => 'country', field_status => const_active])->get(table_place);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function display_state_names($country_id)
    {
        $query = $this->db->where(['type' => 'state', field_status => const_active, 'parent' => $country_id])->get(table_place);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function display_district_names($state_id)
    {
        $query = $this->db->where(['type' => 'district', field_status => const_active, 'parent' => $state_id])->get(table_place);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function display_city_names($district_id)
    {
        $query = $this->db->where(['type' => 'city', field_status => const_active, 'parent' => $district_id])->get(table_place);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function check_if_name_exist($name, $parent_id)
    {
        $this->db->where(['name' => $name, 'parent' => $parent_id]);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function add_state_name($state_id, $name, $place, $parent_id)
    {
        $data = [
            field_uid => $state_id,
            field_name => $name,
            'type' => $place,
            'parent' => $parent_id,
            field_status => const_active,
            field_created_at => date(field_date),
            field_modified_at => date(field_date),
        ];
        $this->db->insert(table_place, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function delete_place_names($place_id)
    {
        $this->db->where(field_uid, $place_id)->delete(table_place);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function get_place_name_by_id($id)
    {
        $query = $this->db->select(field_name)->where(field_uid, $id)->get(table_place);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_name] : null;
    }

    public function get_total_revenue_old($sarathi_id)
    {
        if (empty($sarathi_id)) {

            $query = $this->db->select('SUM(amount) as total_amount')
                ->where(field_status, const_success)
                ->get(table_history_ride_transactions);
            $query = $query->result_array();
            return (!empty($query)) ? $query[0]['total_amount'] : 0;
        } else {

            $query = $this->db->select('SUM(hrt.amount) as total_amount')
                ->from(table_history_ride_transactions . ' as hrt')
                ->join('driver as d', 'hrt.driver_id=d.uid')
                ->join('sarathi as s', 'd.sarathi_id=s.uid')
                ->where('d.sarathi_id', $sarathi_id)
                ->where('hrt.' . field_status, const_success)
                ->get();
            $query = $query->result_array();

            return (!empty($query)) ? $query[0]['total_amount'] : 0;
        }
    }


    public function get_revenue_status($specific_id)
    {
        $last_rev = $this->get_last_month_revenue($specific_id);
        $current_rev = $this->get_currrent_revenue($specific_id);
        if ($last_rev != 0) {
            $growth = (($current_rev - $last_rev) / $last_rev) * 100;
            return (!empty($growth)) ? round($growth) : null;
        } else {
            return 0;
        }
    }


    private function get_currrent_revenue($specific_id)
    {
        if (!empty($specific_id)) {
            $query = $this->db->select('SUM(hrt.amount) as total_amount')
                ->from(table_history_ride_transactions . ' as hrt')
                ->join('driver as d', 'hrt.driver_id=d.uid')
                ->join('sarathi as s', 'd.sarathi_id=s.uid')
                ->where('d.sarathi_id', $specific_id)
                ->where('hrt.' . field_status, const_success)
                ->get();
            $query = $query->result_array();
            return (!empty($query)) ? $query[0]['total_amount'] : 0;
        } else {
            $query = $this->db->select('SUM(amount) as total_amount')
                ->where(field_status, const_success)
                ->get(table_history_ride_transactions);
            $query = $query->result_array();
            return (!empty($query)) ? $query[0]['total_amount'] : 0;
        }
    }

    private function get_last_month_revenue($specific_id)
    {
        if (!empty($specific_id)) {

            $query = $this->db->select('SUM(hrt.amount) as total_amount')
                ->from(table_history_ride_transactions . ' as hrt')
                ->join('driver as d', 'hrt.driver_id=d.uid')
                ->join('sarathi as s', 'd.sarathi_id=s.uid')
                ->where('d.sarathi_id', $specific_id)
                ->where('hrt.' . field_status, const_success)
                ->where('hrt.created_at < (DATE_SUB(NOW(), INTERVAL 1 MONTH))', NULL, FALSE)
                ->get();
            $query = $query->result_array();
            return (!empty($query)) ? $query[0]['total_amount'] : 0;
        } else {
            $query = $this->db->select('SUM(amount) as total_amount')
                ->where('created_at < (DATE_SUB(NOW(), INTERVAL 1 MONTH))', NULL, FALSE)
                ->where(field_status, const_success)
                ->get(table_history_ride_transactions);
            $query = $query->result_array();
            return (!empty($query)) ? $query[0]['total_amount'] : 0;
        }
    }


    //////////////// Hotel  details ////////////////////

    public function get_hotel_details()
    {
        $query = $this->db->where_not_in(field_status, const_deleted)->get(table_hotel);
        $query = $query->result_array();
        return (!empty($query)) ? $query : [];
    }

    public function active_hotel($uid)
    {
        $data = [
            field_status => const_active,
            field_modified_at => date(field_date)
        ];
        $this->db->where(field_uid, $uid)->update(table_hotel, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function deactive_hotel($uid)
    {
        $data = [
            field_status => const_deactive,
            field_modified_at => date(field_date)
        ];
        $this->db->where(field_uid, $uid)->update(table_hotel, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function delete_hotel($uid)
    {
        $data = [
            field_status => const_deleted,
            field_modified_at => date(field_date)
        ];
        $this->db->where(field_uid, $uid)->update(table_hotel, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function get_ride_type_details($ride_id)
    {
        $query = $this->db->get_where(table_ride_service_type, [field_uid => $ride_id]);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0] : null;
    }

    public function update_ride_details($ride_id, $short_desc, $long_desc, $specific_id)
    {
        $data = [
            "short_description" => $short_desc,
            "long_description" => $long_desc,
            field_modified_at => date(field_date),
            field_modified_by => $specific_id,
        ];
        $this->db->where(field_uid, $ride_id)->update(table_ride_service_type, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function get_dormant_account_details()
    {
        $query = $this->db->where(field_status, const_deactive)->get(table_users);
        $query = $query->result_array();
        return (!empty($query)) ? $query : [];
    }

    public function get_package_details($user_type)
    {
        $query = $this->db->where([field_user_type_id => $user_type])
            ->where_not_in(field_status, const_deleted)->get(table_packages);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function add_packages($uid, $user_type_id, $name)
    {
        $data = [
            field_uid => $uid,
            field_user_type_id => $user_type_id,
            field_name => $name,
            field_status => const_active,
            field_created_at => date(field_date),
            field_modified_at => date(field_date)
        ];

        $this->db->where([field_name => $name])->where_not_in(field_status, const_deleted)->get(table_packages);
        $row = $this->db->affected_rows();
        if ($row > 0) {
            return false;
        } else {
            $this->db->insert(table_packages, $data);
            return ($this->db->affected_rows() === 1) ? true : false;
        }
    }

    public function update_packages($uid, $name)
    {
        $data = [
            field_name => $name,
            field_modified_at => date(field_date)
        ];

        $this->db->where(field_name, $name)->where_not_in(field_status, const_deleted)->get(table_packages);
        $row = $this->db->affected_rows();
        if ($row > 0) {
            return false;
        } else {
            $this->db->where(field_uid, $uid)->update(table_packages, $data);
            return ($this->db->affected_rows() === 1) ? true : false;
        }
    }

    public function deactive_packages($uid)
    {
        $data = [
            field_status => const_deactive,
            field_modified_at => date(field_date)
        ];
        $this->db->where(field_uid, $uid)->update(table_packages, $data);
        return ($this->db->affected_rows() === 1) ? true : false;
    }

    public function active_packages($uid)
    {
        $data = [
            field_status => const_active,
            field_modified_at => date(field_date)
        ];
        $this->db->where(field_uid, $uid)->update(table_packages, $data);
        return ($this->db->affected_rows() === 1) ? true : false;
    }

    public function delete_packages($uid)
    {
        $data = [
            field_status => const_deleted,
            field_created_at => date(field_date),
            field_modified_at => date(field_date)
        ];
        $this->db->where(field_uid, $uid)->update(table_packages, $data);
        return ($this->db->affected_rows() === 1) ? true : false;
    }

    public function total_km_purchase_today($user_id)
    {
        $query = $this->db->select('SUM(original_km) as today_recharge')
            ->where(['recharge_type' => 'received', 'payment_status' => 'captured', field_user_id => $user_id])
            ->group_start()
            ->where('rechargeIn', 'purchaseKm')
            ->or_where('rechargeIn', NULL)
            ->group_end()
            ->like(field_created_at, date('Y-m-d'))
            ->get(table_recharge_history);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0]['today_recharge'] : 0;
    }


    public function recharge_history_sf($user_id)
    {
        $query = $this->db->select(field_recharge_amount . ',' . field_original_km . ',' . field_extra_km . ',' . field_created_at . ',' . field_paid_to_user_id . ',' . field_payment_mode . ',' . field_recharge_type . ',' . field_payment_status . ',' . field_note . ',' . field_payment_id)

            ->where(field_user_id, $user_id)
            ->get(table_recharge_history);

        $query = $query->result_array();
        $final_arr = [];
        foreach ($query as $key => $value) {
            $paid_to_user_name = "";
            if (!empty($value[field_paid_to_user_id])) {
                $paid_to_user_name = $this->get_user_name_by_id($value[field_paid_to_user_id]);
            }
            if ($value[field_recharge_type] == STATIC_RECHARGE_TYPE_PAID) {

                $rechargeBy = '';
                if ($value[field_note] != NULL || !empty($value[field_note])) {
                    $rechargeBy = $value[field_note];
                } else if ($value[field_payment_id] != NULL) {
                    $rechargeBy = 'Self Recharge';
                } else {
                    $rechargeBy = 'Recharge For Other';
                }

                $final_arr[] = [
                    key_recharge_type => 'Recharge Other',
                    key_transaction_for => strtoupper(str_replace(' ', '_', STATIC_RECHARGE_TO_DRIVER)),
                    key_price => $value[field_recharge_amount],
                    key_purchesed_km => (string)($value[field_original_km] + $value[field_extra_km]),
                    key_description => 'To ' . $paid_to_user_name . ' for ' . STATIC_RUPEE_SIGN . ' ' . $value[field_recharge_amount],
                    key_date => date("d\nF", strtotime($value[field_created_at])),
                    key_color_code => color_recharge_paid,
                    key_recharge_note => ucwords($rechargeBy)
                ];
            } else {
                $final_arr[] = [
                    key_recharge_type => STATIC_RECHARGE_FOR_SELF,
                    key_transaction_for => strtoupper(str_replace(' ', '_', STATIC_RECHARGE_FOR_SELF)),
                    key_price => $value[field_recharge_amount],
                    key_purchesed_km => (string)($value[field_original_km] + $value[field_extra_km]),
                    key_description => 'Recharge for ' .  STATIC_RUPEE_SIGN . ' ' . $value[field_recharge_amount],
                    key_date => date("d\nF", strtotime($value[field_created_at])),
                    key_color_code => color_recharge_self,
                    key_recharge_note => STATIC_RECHARGE_FOR_SELF
                ];
            }
        }
        return (!empty($query)) ? $final_arr : [];
    }

    public function get_user_name_by_id($user_id)
    {
        $this->db->select(field_name);
        $this->db->limit(1);
        $this->db->where(field_uid, $user_id);
        $query = $this->db->get(table_users);
        $query = $query->result_array();
        $query = (!empty($query)) ? $query[0] : "";
        return (!empty($query)) ? $query[field_name] : "";
    }

    public function get_app_version_list($for_app)
    {

        if (!empty($for_app)) {
            $this->db->where(field_version_for, $for_app);
            $this->db->order_by(field_id, 'desc');
            $query = $this->db->get(table_app_version);
            $query = $query->result_array();
        } else {
            $sarathi = $this->get_latest_app_version('sarathi');
            $driver = $this->get_latest_app_version('driver');
            $customer = $this->get_latest_app_version('customer');

            $query = [
                '0' => $sarathi,
                '1' => $driver,
                '2' => $customer
            ];
        }
        return (!empty($query)) ? $query : [];
    }

    private function get_latest_app_version($for_app)
    {
        $query = $this->db->where(field_version_for, $for_app)
            ->order_by(field_id, 'DESC')->get(table_app_version);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0] : [];
    }


    public function save_new_app_release($uid, $for_app, $name, $play_store_link, $code, $skipable)
    {
        $data = [
            field_uid => $uid,
            field_version_for => $for_app,
            field_name => $name,
            field_play_store_link => $play_store_link,
            field_code => $code,
            field_skipable => $skipable,
            field_created_at => date(field_date)
        ];

        $this->db->insert(table_app_version, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function display_excess_percentage()
    {
        $query = $this->db->get(table_excess_percentage);
        $query = $query->result_array();
        return (!empty(($query))) ? $query : [];
    }
    public function display_rate_per_km()
    {
        $query = $this->db->get(table_rate_per_km);
        $query = $query->result_array();
        return (!empty(($query))) ? $query : [];
    }

    public function save_kilometer_details($uid, $value, $table, $field_name, $admin_id)
    {
        $data = [
            $field_name => $value,
            field_modified_at => date(field_date),
            field_modified_by => $admin_id
        ];
        $this->db->where(field_uid, $uid)->update($table, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    //////////////////// Calculate Revenue By Recharge History /////////////////////////

    public function get_total_revenue($sarathi_id)
    {
        $total = 0;
        if (empty($sarathi_id)) {
            $query = $this->db->select(field_uid)->where(field_type_id, value_user_franchise)->get(table_users);
            $query = $query->result_array();
            foreach ($query as $i => $val) {
                $total = $total + $this->get_total_recharge_amount($val[field_uid]);
            }
            return (!empty($total)) ? $total : 0;
        } else {

            $total = 0;
            $query = $this->db->select('u.uid')
                ->from(table_users . ' as u')
                ->join(table_driver . ' as d', 'u.uid=d.user_id')
                ->where(['u.' . field_type_id => value_user_sarathi, 'd.sarathi_id' => $sarathi_id])
                ->get();
            $query = $query->result_array();
            foreach ($query as $i => $val) {
                $total = $total + $this->get_total_recharge_amount($val[field_uid]);
            }
            return (!empty($total)) ? $total : 0;
        }
    }


    private function get_total_recharge_amount($user_id)
    {
        $query = $this->db->select('SUM(recharge_amount) as amount')
            ->where(field_user_id, $user_id)
            ->get(table_recharge_history);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0]['amount'] : 0;
    }
}
