<?php
class UserModel extends CI_Model
{
    public function get_user_row()
    {
        $this->db->select('*')->from('tb_users');
        $this->db->where(array('username' => $_POST['inUsername']));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_user()
    {
        $this->db->select('*')->from('tb_users');
        // $this->db->where(array('username' => $_POST['inUsername']));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_user_logs($user_id, $limit = null)
    {
        $this->db->select('*')->from('tb_user_log');
        $this->db->where(array('user_id' => $user_id));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_user_log($data)
    {
        if (empty($data["user_id"])) {
            $data["user_id"] = $this->session->userdata("userId");
        }
        $data["created_at"] = strtotime(date("Y-m-d h:i:s"));
        $this->db->insert('tb_user_log', $data);
    }

    public function insert_user_session($data)
    {
        if (empty($data["user_id"])) {
            $data["user_id"] = $this->session->userdata("userId");
        }
        $data["created_at"] = strtotime(date("Y-m-d h:i:s"));
        $data["updated_at"] = strtotime(date("Y-m-d h:i:s"));
        $this->db->insert('tb_user_session', $data);
    }

    public function delete_user_session($data)
    {
        if (empty($data["session_id"])) {
            $data["session_id"] = $this->session->session_id;
        }
        $this->db->delete('tb_user_session', array('session_id' => $data["session_id"]));
        $this->db->delete('tb_sessions', array('id' => $data["session_id"]));        
    }

}