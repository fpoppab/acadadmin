<?php
class StudentModel extends CI_Model
{

    public function select_pattern()
    {
        $this->db->select('a.*');
        $this->db->select('c.no as c_address_no,c.moo as c_address_moo,c.tambol as c_address_tambol,c.amphur as c_address_amphur,c.province as c_address_province,c.zipcode as c_address_zipcode');
        $this->db->select('r.no as r_address_no,r.moo as r_address_moo,r.tambol as r_address_tambol,r.amphur as r_address_amphur,r.province as r_address_province,r.zipcode as r_address_zipcode');
        $this->db->select('a.id as std_id,CONCAT(a.titlename, a.firstname, " ", a.lastname) AS fullname');
        $this->db->from('tb_student a');
        $this->db->join('tb_student_register b', 'b.student_id = a.id');
        $this->db->join('tb_student_current_address c', 'c.student_id = a.id', 'LEFT OUTER');
        $this->db->join('tb_student_registered_address r', 'r.student_id = a.id', 'LEFT OUTER');
    }

    public function get_student()
    {
        $this->select_pattern();
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_student_by_stdid($std_id)
    {
        if (!empty($std_id)) {
            $this->select_pattern();
            $this->db->where('a.id', $std_id);
            $query = $this->db->get();
            $row = $query->row_array();
            $row['father'] = $this->get_parent_by_stdid($std_id, 'พ่อ');
            $row['mother'] = $this->get_parent_by_stdid($std_id, 'แม่');
            return $row;
        } else {
            return "missing parameter";
        }
    }

    #ดึงข้อมูลผู้ปกครอง
    function get_parent_by_stdid($std_id, $relation)
    {
        if (!empty($std_id)) {
            $this->db->select('a.*,a.id as parent_id,b.relation');
            $this->db->from('tb_parent a');
            $this->db->join('tb_student_parent b', 'b.parent_id = a.id');
            $this->db->where('b.student_id', $std_id);
            $this->db->where('b.relation', $relation);
            $query = $this->db->get();
            return $query->row_array();
        } else {
            return "missing parameter";
        }
    }

    public function update_student($data, $std_id = null)
    {
        $this->db->trans_begin();

        #ข้อมูลนักเรียน
        $student = array(
            "titlename" => $data["titlename"],
            "firstname" => $data["firstname"],
            "lastname" => $data["lastname"],
            "idcard" => $data["idcard"],
            "profileimage" => $data["profileimage"],
            "nickname" => $data["nickname"],
            "gender" => $data["gender"],
            "birthdate" => strtotime($data["birthdate"]),
            "bloodtype" => $data["bloodtype"],
            "phonenumber" => $data["phonenumber"],
            "religion" => $data["religion"],
            "ethnicity" => $data["ethnicity"],
            "nationality" => $data["nationality"],
            "updated_at" => strtotime(date("Y-m-d h:i:s"))
        );

        if (!empty($std_id)) {
            $this->db->where('id', $std_id);
            $this->db->update('tb_student', $student);
        } else {
            $student["created_at"] = strtotime(date("Y-m-d"));
            $this->db->insert('tb_student', $student);
            $std_id = $this->db->insert_id();

            $student = array(
                "student_id" => $std_id,
                "school_id" => $data["school_id"],
                "status" => "Studying",
                "date" => strtotime(date("Y-m-d")),
                "note" => "insert by student web"
            );
            $this->db->insert('tb_student_register', $student);
        }
        $this->db->reset_query();

        #ข้อมูลที่อยู่ตามทะเบียนบ้าน
        $r_address = array(
            "student_id" => $std_id,
            "no" => $data["r_no"],
            "moo" => $data["r_moo"],
            "tambol" => $data["r_tambol"],
            "amphur" => $data["r_amphur"],
            "province" => $data["r_province"],
            "zipcode" => $data["r_zipcode"],
            "updated_at" => strtotime(date("Y-m-d"))
        );
        $chk = $this->db->select('id')->from('tb_student_registered_address')->where('student_id', $std_id)->get()->row_array();
        if (!empty($chk['id'])) {
            $this->db->where('student_id', $std_id);
            $this->db->update('tb_student_registered_address', $r_address);
        } else {
            $r_address["created_at"] = strtotime(date("Y-m-d"));
            $this->db->insert('tb_student_registered_address', $r_address);
        }
        $this->db->reset_query();

        #ข้อมูลที่อยู่ปัจจุบัน
        $c_address = array(
            "student_id" => $std_id,
            "no" => $data["c_no"],
            "moo" => $data["c_moo"],
            "tambol" => $data["c_tambol"],
            "amphur" => $data["c_amphur"],
            "province" => $data["c_province"],
            "zipcode" => $data["c_zipcode"],
            "updated_at" => strtotime(date("Y-m-d"))
        );
        $chk = $this->db->select('id')->from('tb_student_current_address')->where('student_id', $std_id)->get()->row_array();
        if (!empty($chk['id'])) {
            $this->db->where('student_id', $std_id);
            $this->db->update('tb_student_current_address', $c_address);
        } else {
            $c_address["created_at"] = strtotime(date("Y-m-d"));
            $this->db->insert('tb_student_current_address', $c_address);
        }
        $this->db->reset_query();

        #ข้อมูลพื้นฐานพ่อ
        $father = array(
            "titlename" => $data["f_titlename"],
            "firstname" => $data["f_firstname"],
            "lastname" => $data["f_lastname"],
            "profile_image" => $data["f_profile_image"],
            "phonenumber" => $data["f_phonenumber"],
            "updated_at" => strtotime(date("Y-m-d"))
        );
        $chk_father = $this->get_parent_by_stdid($std_id, 'พ่อ');
        $father_id = $chk_father["parent_id"];
        if (!empty($father_id)) {
            $this->db->where('id', $father_id);
            $this->db->update('tb_parent', $father);
        } else {
            $father["created_at"] = strtotime(date("Y-m-d"));
            $this->db->insert('tb_parent', $father);
            $father_id = $this->db->insert_id();

            #พ่อผูกข้อมูลเด็ก
            $father_relation = array(
                "student_id" => $std_id,
                "parent_id" => $father_id,
                "relation" => "พ่อ",
                "updated_at" => strtotime(date("Y-m-d"))
            );
            $this->db->insert('tb_student_parent', $father_relation);
        }
        $this->db->reset_query();

        #ข้อมูลพื้นฐานแม่
        $mother = array(
            "titlename" => $data["m_titlename"],
            "firstname" => $data["m_firstname"],
            "lastname" => $data["m_lastname"],
            "profile_image" => $data["m_profile_image"],
            "phonenumber" => $data["m_phonenumber"],
            "updated_at" => strtotime(date("Y-m-d"))
        );
        $chk_mother = $this->get_parent_by_stdid($std_id, 'แม่');
        $mother_id = $chk_mother["parent_id"];
        if (!empty($mother_id)) {
            $this->db->where('id', $mother_id);
            $this->db->update('tb_parent', $mother);
        } else {
            $mother["created_at"] = strtotime(date("Y-m-d"));
            $this->db->insert('tb_parent', $mother);
            $mother_id = $this->db->insert_id();

            #แม่ผูกข้อมูลเด็ก
            $mother_relation = array(
                "student_id" => $std_id,
                "parent_id" => $mother_id,
                "relation" => "แม่",
                "updated_at" => strtotime(date("Y-m-d"))
            );
            $this->db->insert('tb_student_parent', $mother_relation);
        }
        $this->db->reset_query();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return "rollback";
        } else {
            $this->db->trans_commit();
            return "success";
        }
    }

    public function delete_student($std_id, $school_id)
    {
        $this->db->trans_begin();

        $this->db->where('student_id', $std_id);
        $this->db->where('school_id', $school_id);
        $this->db->delete('tb_student_register');

        $this->db->where('student_id', $std_id);
        $this->db->delete('tb_student_current_address');

        $this->db->where('student_id', $std_id);
        $this->db->delete('tb_student_registered_address');

        $this->db->where('id', $std_id);
        $this->db->delete('tb_student');


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return "rollback";
        } else {
            $this->db->trans_commit();
            return "success";
        }
    }

}