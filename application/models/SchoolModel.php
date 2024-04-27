<?php
class SchoolModel extends CI_Model
{
    public function get_school()
    {
        $this->db->select('a.id as school_id,a.name as school_name,logo as school_logo');
        $this->db->select('a.tambol as school_tambol,a.amphur as school_amphur,a.province as school_province,a.zipcode as school_zipcode,a.phone as school_phone');
        $this->db->select('a.maximum_semester');
        $this->db->select('b.id as school_type_id,b.name as school_type_name');
        $this->db->from('tb_school a');
        $this->db->join('tb_school_type b', 'b.id = a.school_type_id');
        $this->db->where(array('a.id' => 1));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_school($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_school', $data);
        // return $this->input->post("inSchoolName");
    }

    public function get_school_type()
    {
        $this->db->select('id as school_type_id,name as type_name')->from('tb_school_type');
        $query = $this->db->get();
        return $query->result_array();
    }


    #ดึงข้อมูลปีการศึกษา
    public function get_edyear_by_edyear($school_id, $edyear)
    {
        $this->db->select('*')->from('tb_school_education_year')->where(array("school_id" => $school_id, "year" => $edyear));
        $query = $this->db->get();
        return $query->row_array();
    }


    #ดึงข้อมูลภาคเรียน
    public function get_all_semester_by_edyear($school_id, $edyear)
    {
        $this->db->select('*')->from('tb_school_semester')->where(array("school_id" => $school_id, "edyear" => $edyear));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_semester_by_edyear($school_id, $edyear, $semester)
    {
        $this->db->select('*')->from('tb_school_semester')->where(array("school_id" => $school_id, "edyear" => $edyear, "semester_number" => $semester));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_edyear($data)
    {
        if (!empty($data["school_id"]) && !empty($data["year"])) {
            #update edyear
            $chk = $this->get_edyear_by_edyear($data["school_id"], $data["year"]);

            $this->db->trans_begin();
            if (!empty($chk["id"])) {
                $this->db->where(array("school_id" => $data["school_id"], "year" => $data["year"]));
                $this->db->update('tb_school_education_year', $data);
            } else {
                $this->db->insert('tb_school_education_year', $data);
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

    public function update_semester($data)
    {
        if (!empty($data["school_id"]) && !empty($data["edyear"])) {
            $chk = $this->get_semester_by_edyear($data["school_id"], $data["edyear"], $data["semester_number"]);

            $this->db->trans_begin();

            #update semester           
            if (!empty($chk["id"])) {
                $this->db->where(array("school_id" => $data["school_id"], "edyear" => $data["edyear"], "semester_number" => $data["semester_number"]));
                $this->db->update('tb_school_semester', $data);
            } else {
                $this->db->insert('tb_school_semester', $data);
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

    #ดึงข้อมูลระดับชั้นทั้งหมด
    public function get_school_clss($register = FALSE)
    {
        $this->db->select('*,a.id as school_clss_id,b.id as clss_id');
        $this->db->select('CONCAT(a.name, "ปีที่ ", a.level) AS clss_name');
        $this->db->from('tb_school_class a');
        if ($register) {
            $this->db->join('tb_school_class_register b', 'b.school_class_id = a.id');
        } else {
            $this->db->join('tb_school_class_register b', 'b.school_class_id = a.id', 'LEFT OUTER');
        }
        $this->db->order_by('a.sequence ASC');
        $this->db->where(array("a.education_type" => "ordinary"));

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_school_clss_by_school_id_and_school_class_id($school_id, $school_clss_id)
    {
        $this->db->select('*,id as clss_id')->from('tb_school_class_register')->where(array("school_id" => $school_id, "school_class_id" => $school_clss_id));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_clss($data)
    {
        if (!empty($data["school_id"]) && !empty($data["school_class_id"])) {
            $chk = $this->get_school_clss_by_school_id_and_school_class_id($data["school_id"], $data["school_class_id"]);

            $this->db->trans_begin();
            $data["updated_at"] = strtotime(date("Y-m-d h:i:s"));

            #update clss         
            if (!empty($chk["clss_id"])) {
                $this->db->where(array("school_id" => $data["school_id"], "school_class_id" => $data["school_class_id"]));
                $this->db->update('tb_school_class_register', $data);
            } else {
                $data["created_at"] = strtotime(date("Y-m-d h:i:s"));
                $this->db->insert('tb_school_class_register', $data);
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

    public function delete_clss($id)
    {
        if (!empty($id)) {
            $this->db->trans_begin();

            $this->db->delete('tb_school_class_register', array('id' => $id));

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

    #ดึงข้อมูลห้องเรียน
    public function get_room()
    {
        $this->db->select('*,a.id as school_clss_id,b.id as clss_id,c.id as room_id');
        $this->db->select('c.number as room_number');
        $this->db->select('CONCAT(a.name, "ปีที่ ", a.level) AS clss_name');
        $this->db->select('CONCAT(a.name, "ปีที่ ", a.level,"/",c.number) AS clss_room');
        $this->db->select('CONCAT(a.abbreviation, ".", a.level,"/",c.number) AS clss_room_ab');
        $this->db->from('tb_school_class a');
        $this->db->join('tb_school_class_register b', 'b.school_class_id = a.id');
        $this->db->join('tb_room c', 'c.school_class_register_id = b.id');
        $this->db->order_by('a.sequence ASC');
        $this->db->order_by('c.number ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_room_by_id($id)
    {
        if (!empty($id)) {
            $this->db->select('*,id as room_id,school_class_register_id as clss_id,education_plan_id as ed_plan_id')->from("tb_room")->where("id", $id);
            $query = $this->db->get();
            return $query->row_array();
        } else {
            return "missing parameter";
        }
    }

    public function update_room($data, $room_id = null, $personnel)
    {
        if (!empty($data["school_class_register_id"]) && !empty($data["education_plan_id"]) && !empty($data["edyear"]) && !empty($data["number"])) {
            $this->db->trans_begin();
            $data["updated_at"] = strtotime(date("Y-m-d h:i:s"));
            $this->get_room_by_id($room_id);

            if (!empty($room_id)) {
                #update room   
                $this->db->where("id", $room_id);
                $this->db->update('tb_room', $data);
            } else {
                #insert room 
                $data["created_at"] = strtotime(date("Y-m-d h:i:s"));
                $this->db->insert('tb_room', $data);
                $room_id = $this->db->insert_id();
            }

            if (!empty($personnel)) {
                foreach ($personnel as $p) {
                    $data2 = array(
                        "room_id" => $room_id,
                        "personnel_register_id" => $p
                    );
                    $this->db->insert('tb_room_teacher', $data2);
                }
            }

            // $this->db->trans_complete();
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

    #ดึงข้อมูลแผนการเรียนสำหรับห้อง
    public function get_education_plan()
    {
        $this->db->select('name as ed_plan_name,id as ed_plan_id')->from('tb_education_plan');
        $query = $this->db->get();
        return $query->result_array();
    }


}