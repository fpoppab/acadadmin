<?php
class PersonnelModel extends CI_Model
{

    public function personel_pattern()
    {
        $this->db->select('CONCAT(a.titlename, a.firstname, " ", a.lastname) AS fullname');
        $this->db->select('a.*,a.id as personnel_id,a.titlename as personnel_titlename ,a.firstname as personnel_firstname ,a.lastname as personnel_lastname ,CONCAT(a.titlename,a.firstname," ",a.lastname)as personnel_fullname');
        $this->db->select('a.profile_image as personnel_profile_image');
        $this->db->select('b.id as personel_regis_id');
        $this->db->select('c.id as type_id,c.name as type_name,d.id as school_id,d.name as school_name');
        $this->db->from('tb_personnel a');
        $this->db->join('tb_personnel_register b', 'b.personnel_id = a.id');
        $this->db->join('tb_personnel_type c', 'c.id = b.personnel_type_id');
        $this->db->join('tb_school d', 'd.id = b.school_id');
        $this->db->where('b.status', TRUE);
    }
    #ดึงข้อมูลบุคลากรทั้งหมดในโรงเรียน
    public function get_personnel_by_school_id($school_id)
    {
        if (!empty($school_id)) {
            $this->personel_pattern();
            $this->db->where(array('d.id' => $school_id));
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    #ดึงข้อมูลบุคลากรคนเดียวโดยใช้ ID ของ Personnel
    public function get_personnel_by_id($personnel_id)
    {
        if (!empty($personnel_id)) {
            $this->personel_pattern();
            $this->db->where(array('a.id' => $personnel_id));
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    #ดึงข้อมูลบุคลากรคนเดียวโดยใช้ ID ของ User
    public function get_personnel_by_user_id($user_id)
    {
        if (!empty($user_id)) {
            $this->personel_pattern();
            $this->db->join('tb_user_personnel u', 'u.personnel_id = a.id', 'LEFT OUTER');
            $this->db->where(array('u.user_id' => $user_id));
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    #ดึงข้อมูลบุคลากรที่เป็นครูประจำชั้น(ห้อง)จาก room_id
    public function get_personnel_by_room_id($room_id)
    {
        if (!empty($room_id)) {
            $this->personel_pattern();
            $this->db->join('tb_room_teacher rt', 'rt.personnel_register_id = b.id');
            $this->db->join('tb_room r', 'r.id = rt.room_id');
            $this->db->where('r.id', $room_id);
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    #ดึงข้อมูลบุคลากรที่ยังไม่ได้เป็นครูประจำชั้น(ห้อง)จาก room_id
    public function get_personnel_by_room_id_available($school_id)
    {
        if (!empty($school_id)) {
            $this->personel_pattern();
            $this->db->join('tb_room_teacher rt', 'rt.personnel_register_id = b.id', 'LEFT OUTER');
            $this->db->join('tb_room r', 'r.id = rt.room_id', 'LEFT OUTER');
            $this->db->where('rt.id', null);
            $this->db->where(array('d.id' => $school_id));
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function update_personnel($data, $personnel_id = null)
    {
        if (!empty($data["school_id"]) && !empty($data["personneltypeid"])) {
            $this->db->trans_begin();
            $personnel = array(
                "titlename" => $data["titlename"],
                "firstname" => $data["firstname"],
                "lastname" => $data["lastname"],
                "idcard" => $data["idcard"],
                "profile_image" => $data["profile_image"],
                "nickname" => $data["nickname"],
                "email" => $data["email"],
                "gender" => $data["gender"],
                "birthdate" => strtotime($data["birthdate"]),
                "bloodtype" => $data["bloodtype"],
                "phonenumber" => $data["phonenumber"],
                "religion" => $data["religion"],
                "ethnicity" => $data["ethnicity"],
                "nationality" => $data["nationality"],
                "updated_at" => strtotime(date("Y-m-d h:i:s"))
            );

            if (!empty($personnel_id)) {
                $this->db->where('id', $personnel_id);
                $this->db->update('tb_personnel', $personnel);

                $personnel_register = array(
                    "personnel_type_id" => $data["personneltypeid"]
                );
                $this->db->where('personnel_id', $personnel_id);
                $this->db->update('tb_personnel_register', $personnel_register);
            } else {
                $this->db->insert('tb_personnel', $personnel);
                $personnel_id = $this->db->insert_id();

                $personnel_register = array(
                    "personnel_id" => $personnel_id,
                    "personnel_type_id" => $data["personneltypeid"],
                    "school_id" => $data["school_id"],
                    "status" => 1,
                    "date" => strtotime(date("Y-m-d")),
                    "comment" => "insert by personnel web"
                );
                $this->db->insert('tb_personnel_register', $personnel_register);
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

    #ใช้สำหรับลบบุคลากรในระบบ
    public function delete_personnel($personnel_id, $school_id)
    {
        if (!empty($personnel_id) && !empty($school_id)) {
            $this->db->trans_begin();

            $this->db->where('personnel_id', $personnel_id);
            $this->db->where('school_id', $school_id);
            $this->db->delete('tb_personnel_register');

            $this->db->where('id', $personnel_id);
            $this->db->delete('tb_personnel');

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

    #ประเภทบุคลากร
    public function get_personnel_type()
    {
        $this->db->select('*');
        $this->db->from('tb_personnel_type a');
        $query = $this->db->get();
        return $query->result_array();
    }

    // public function update_personnel($id, $data)
    // {
    //     $this->db->where('id', $id);
    //     $this->db->update('tb_personnel', $data);
    //     // return $this->input->post("inSchoolName");
    // }

}