<?php
class CourseModel extends CI_Model
{

    public function course_pattern()
    {
        $this->db->select('a.*');
        $this->db->from('tb_course a');
        $this->db->join('tb_school_class_register b', 'b.id = a.school_class_register_id');
        $this->db->join('tb_school_class c', 'c.id = b.school_class_id');
        $this->db->join('tb_group_learning g', 'g.id = a.group_learning_id');

        $this->db->where(array('g.displaystatus' => 1));
    }

    #ดึงข้อมูลวิชา
    public function get_course($school_id, $group_learning_id = null, $school_class_register_id = null)
    {
        if (!empty($school_id)) {
            $this->course_pattern();
            $this->db->where(array('b.school_id' => $school_id));

            #ดึงข้อมูลวิชาโดยใช้ ID ของ Group Learning
            if (!empty($group_learning_id)) {
                $this->db->where(array('a.group_learning_id' => $group_learning_id));
            }

            #ดึงข้อมูลวิชาโดยใช้ ID ของ School Class Register
            if (!empty($school_class_register_id)) {
                $this->db->where(array('a.school_class_register_id' => $school_class_register_id));
            }

            $query = $this->db->get();
            return $query->result_array();
        }
    }

    #ดึงข้อมูลวิชาเดียวโดยใช้ ID ของ Course
    public function get_course_by_id($course_id)
    {
        if (!empty($course_id)) {
            $this->course_pattern();
            $this->db->where(array('a.id' => $course_id));
            $query = $this->db->get();
            return $query->row_array();
        }
    }



    #เพิ่มข้อมูลวิชา (insert or update)
    public function update_course($data)
    {
        if (!empty($data["group_learning_id"]) && !empty($data["school_class_register_id"]) && !empty($data["name"]) && !empty($data["code"]) && !empty($data["type"]) && !empty($data["hours_per_week"])) {
            $arr = array(
                "group_learning_id" => $data["group_learning_id"],
                "school_class_register_id" => $data["school_class_register_id"],
                "name" => $data["name"],
                "code" => $data["code"],
                "type" => $data["type"],
                "hours_per_week" => $data["hours_per_week"],
                "descriptions" => $data["descriptions"],
                "updated_at" => strtotime(date("Y-m-d h:i:s"))
            );

            $this->db->trans_begin();
            if (!empty($data['id'])) {
                #update
                $this->db->where('id', $data['id']);
                $this->db->update('tb_course', $arr);
            } else {
                #insert   
                $arr['created_at'] = strtotime(date("Y-m-d h:i:s"));
                $this->db->insert('tb_course', $arr);
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

    #ใช้สำหรับลบวิชาในระบบโดยใช้ ID ของ Course
    public function delete_course($course_id)
    {
        if (!empty($course_id)) {
            $this->db->trans_begin();
            $this->db->where('a.id', $course_id);
            $this->db->delete('tb_course');

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
}