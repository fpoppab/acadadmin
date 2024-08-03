<?php
class UserModel extends CI_Model
{
    public function user_pattern()
    {
        $this->db->select('a.*,a.id as user_id');
        $this->db->select('c.*,CONCAT(c.titlename, c.firstname, " ", c.lastname) AS fullname');
        $this->db->from('tb_users a');
        $this->db->join('tb_user_personnel b', 'b.user_id = a.id', 'RIGHT OUTER');
        $this->db->join('tb_personnel c', 'c.id = b.personnel_id', 'RIGHT OUTER');
    }
    public function get_user_row()
    {
        $this->db->select('*')->from('tb_users');
        $this->db->where(array('username' => $_POST['inUsername']));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_user()
    {
        $this->user_pattern();
        // $this->db->where('');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_user_by_id($user_id)
    {
        $this->user_pattern();
        $this->db->where('a.id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_user_by_personnel_id($personnel_id)
    {
        $this->user_pattern();
        $this->db->where('c.id', $personnel_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_user($data, $user_id = null)
    {
        if (!empty($data["username"]) && !empty($data["password"]) && !empty($data["type"])) {
            $this->db->trans_begin();

            $user = array(
                "username" => $data["username"],
                "type" => $data["type"],
                "password" => $data["password"],
                "updated_at" => strtotime(date("Y-m-d h:i:s"))
            );

            if (!empty($user_id)) {
                $this->db->where('id', $user_id);
                $this->db->update('tb_users', $user);
            } else {
                $user["created_at"] = strtotime(date("Y-m-d h:i:s"));
                $this->db->insert('tb_users', $user);
                $new_user_id = $this->db->insert_id();

                $linkdata = array(
                    "personnel_id" => $data["personnel_id"],
                    "user_id" => $new_user_id,
                    "created_at" => strtotime(date("Y-m-d h:i:s")),
                    "updated_at" => strtotime(date("Y-m-d h:i:s"))
                );
                $this->db->insert('tb_user_personnel', $linkdata);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return "rollback";
            } else {
                $this->db->trans_commit();
                return "success";
            }
        } else {
            return "missing parameter";
        }
    }

    public function update_user_status($user_id, $status)
    {
        if (!empty($user_id)) {
            $this->db->trans_begin();

            $this->db->where('id', $user_id);
            $this->db->update('tb_users', array("status" => $status));

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return "rollback";
            } else {
                $this->db->trans_commit();
                return "success";
            }
        } else {
            return "missing parameter";
        }
    }

    public function get_user_logs($user_id, $limit = null)
    {
        $this->db->select('*')->from('tb_user_log');
        $this->db->where(array('user_id' => $user_id));
        $this->db->order_by("id", "DESC");
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