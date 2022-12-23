<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }



    public function get_total_drivers($sarathi_id)
    {
        if (!empty($sarathi_id)) {
            $this->db->where('d.sarathi_id', $sarathi_id);
        }

        $this->db->select('u.uid')->from('users as u')->join('driver as d', 'u.uid = d.user_id')
            ->where_not_in('u.status', const_deleted)
            ->where_not_in('u.status', const_pending)->get();
        return $this->db->affected_rows();
    }

    public function get_total_active_drivers($sarathi_id)
    {
        if (!empty($sarathi_id)) {
            $this->db->where('d.sarathi_id', $sarathi_id);
        }

        $this->db->select('u.uid')->from('users as u')->join('driver as d', 'u.uid = d.user_id')
            ->where('d.' . field_working_status, const_active)
            ->where_not_in('u.status', const_deleted)
            ->where_not_in('u.status', const_pending)->get();
        return $this->db->affected_rows();
    }

    public function get_total_inactive_drivers($sarathi_id)
    {
        if (!empty($sarathi_id)) {
            $this->db->where('d.sarathi_id', $sarathi_id);
        }
        $this->db->select('u.uid')->from('users as u')->join('driver as d', 'u.uid = d.user_id')
            ->where('d.' . field_working_status, const_deactive)
            ->where_not_in('u.status', const_deleted)
            ->where_not_in('u.status', const_pending)->get();
        return $this->db->affected_rows();
    }

    public function get_total_driver()
    {
        $this->db->get(table_driver);
        return $this->db->affected_rows();
    }

    public function get_total_car_running($specific_id)
    {
        if (!empty($specific_id)) {
            $this->db->where([field_working_status => const_active, field_sarathi_id => $specific_id]);
        } else {
            $this->db->where([field_working_status => const_active]);
        }
        $this->db->get(table_driver);
        return $this->db->affected_rows();
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

    public function condition_to_get_driver()
    {

        $select = table_users . '.' . field_uid . ',' . table_users . '.' . field_name . ',' . table_users . '.' . field_email . ',' . table_users . '.' . field_mobile . ',' . table_users . '.' . field_status . ',' . table_driver . '.' . field_sarathi_id . ',' . table_driver . '.' . field_total_km_purchased . ',' . table_driver . '.' . field_uid . ' as ' . field_driver_id;

        $join_user_driver = table_users . '.' . field_uid . '=' . table_driver . '.' . field_user_id;

        $this->db->select($select);
        $this->db->from(table_users);
        $this->db->join(table_driver, $join_user_driver);
        $this->db->where_not_in(table_users . '.' . field_status, const_deleted);
        $this->db->where_not_in(table_users . '.' . field_status, const_pending);
        $this->db->where(table_users . '.' . field_type_id, value_user_driver);
        $this->db->order_by(table_users . '.' . field_id, "desc");
    }


    public function get_driver_details($sarathi_id)
    {
        if (!empty($sarathi_id)) {
            $this->condition_to_get_driver();
            $this->db->where(table_driver . '.' . field_sarathi_id, $sarathi_id);
        } else {
            $this->condition_to_get_driver();
        }
        $query = $this->db->get();
        $query =  $query->result_array();
        foreach ($query as $key => $value) {
            $query[$key][field_user_id] = $value[field_uid];
            unset($query[$key][field_uid]);

            // get subfranchise

            $sarathi_id = "";
            $sarathi_name = "";
            if (array_key_exists(field_sarathi_id, $value)) {
                $sarathi_id = $value[field_sarathi_id];
                $sarathi_name = $this->get_sarathi_name_by_sarathi_id($sarathi_id);
            }
            $arr = [
                field_id => $sarathi_id,
                field_name => ucfirst($sarathi_name)
            ];
            $query[$key]['sarathi'] = $arr;
            unset($query[$key][field_sarathi_id]);
        }
        return (!empty($query)) ? $query : null;
    }

    public function get_sarathi_name_by_sarathi_id($sarathi_id)
    {
        $this->db->select('u.' . field_name);
        $this->db->from(table_users . ' as u');
        $this->db->join(table_sarathi . ' as s', 'u.uid = s.user_id');
        $this->db->where('s.uid', $sarathi_id);
        $query = $this->db->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_name] : null;
    }


    public function delete_driver_details($userid)
    {
        $uid_exist = $this->userid_exists($userid, field_uid, table_users);
        if ($uid_exist) {
            $this->db->set([field_status => const_deleted, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $userid);
            $this->db->update(table_users);
            return ($this->db->affected_rows() == 1) ? true : false;
        } else
            return false;
    }


    public function deactive_driver_status($userid)
    {
        $uid_exist = $this->userid_exists($userid, field_uid, table_users);
        if ($uid_exist) {
            $this->db->set([field_status => const_deactive, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $userid);
            $this->db->update(table_users);
            return ($this->db->affected_rows() == 1) ? true : false;
        } else
            return false;
    }

    public function active_driver_status($userid)
    {
        $uid_exist = $this->userid_exists($userid, field_uid, table_users);
        if ($uid_exist) {
            $this->db->set([field_status => const_active, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $userid);
            $this->db->update(table_users);
            return ($this->db->affected_rows() == 1) ? true : false;
        } else
            return false;
    }

    public function update_driver_details($user_id, $array)
    {
        // $data = [
        //     field_name => $name,
        //     field_email => $email,
        //     field_mobile => $mobile,
        //     field_modified_at => date(field_date)
        // ];

        $this->db->where(field_uid, $user_id);
        $this->db->update(table_users, $array);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function add_driver_details($user_id, $driver_id, $name, $email, $mobile, $user_type_id)
    {
        $uid_exist = $this->userid_exists($user_id, field_uid, table_driver);
        if (!$uid_exist) {
            $data = [
                field_uid => $user_id,
                field_name => $name,
                field_email => $email,
                field_mobile => $mobile,
                field_type_id => $user_type_id
            ];

            $this->db->insert(table_users, $data);

            if ($this->db->affected_rows() > 0) {
                $driver_data = [
                    field_uid => $driver_id,
                    field_user_id => $user_id,
                ];

                $this->db->insert(table_driver, $driver_data);
                return ($this->db->affected_rows() == 1 ? true : false);
            } else
                return false;
        } else
            return false;
    }

    public function getDriverData($sarathi_id)
    {

        $this->db->select('u.name, u.created_at as joined, d.uid as id, d.user_id as userId, v.name as vehicle_name, 
            d.vehicle_number, d.total_km_purchased, d.rating');

        $this->db->from(table_driver . ' as d');
        $this->db->join(table_users . ' as u', 'd.user_id = u.uid', 'left');
        $this->db->join(table_vehicle_type . ' as v', 'v.uid = d.vehicle_type_id');
        $this->db->where('d.sarathi_id', $sarathi_id);
        $this->db->where_not_in('u.status', const_deleted);
        $query = $this->db->get();
        $query = $query->result_array();
        foreach ($query as $key => $value) {
            $query[$key]['joined'] = date("d/m/Y", strtotime($value['joined']));
        }
        return $query;
    }


    public function display_driver_details($user_id)
    {
        $query = $this->db->select('u.name, u.email, u.mobile, (d.totalTravelled / 1000) as totalTravel, (d.totalRideTime / 60) as totalRide')
            ->from('driver as d')
            ->join('users as u', 'u.uid = d.user_id')
            ->where('d.user_id', $user_id)
            ->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query : [];
    }

    public function get_driver_ids_by_sarathi_id($sarathi_id)
    {
        $query = $this->db->select(field_user_id)->where(field_sarathi_id, $sarathi_id)->get(table_driver);
        $query = $query->result_array();
        return (!empty($query)) ? $query : [];
    }

    public function get_driver_details_by_user_id($user_id)
    {
        $query = $this->db->select('u.uid as user_id, u.name, u.email, u.mobile, u.status, d.sarathi_id')
            ->from('users as u')->join('driver as d', 'u.uid=d.user_id')
            ->where('u.uid', $user_id)
            ->where_not_in('u.status', const_deleted)
            ->where_not_in('u.status', const_pending)->get();
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $sarathi_id = $val['sarathi_id'];
            $query[$i]['sarathi'] = $this->get_sarathi_name_by_sarathi_id($sarathi_id);
        }
        return (!empty($query)) ? $query : [];
    }
}
