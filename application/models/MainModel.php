<?php

class MainModel extends CI_Model {

    function get_where_row($tab, $con) {
        $this->db->select('*')->from($tab)->where($con);
        $query = $this->db->get();
        return $query->row_array();
    }

    function insert_data($tab, $data) {
        $this->db->insert($tab, $data);
        $id = $this->db->insert_id();
        return $id;
    }

}
