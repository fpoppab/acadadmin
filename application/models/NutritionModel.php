<?php
class NutritionModel extends CI_Model
{

    public function nutrition_pattern()
    {
        $this->db->select('a.id as nutrition_id ,a.school_id');
        $this->db->select('a.name as nutrition_name ,a.calories as nutrition_calories,a.image as nutrition_image');
        $this->db->select('b.name as school_name');
        $this->db->from('tb_nutrition a');
        $this->db->join('tb_school b', 'b.id = a.school_id');
    }

    #ดึงข้อมูลโภชนาการทั้งหมดในโรงเรียน
    public function get_nutrition($school_id)
    {
        if (!empty($school_id)) {
            $this->nutrition_pattern();
            $this->db->where(array('a.school_id' => $school_id));
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    #ดึงข้อมูลโภชนาการเดียวโดยใช้ ID ของ Public Relations
    public function get_nutrition_by_id($nutrition_id)
    {
        if (!empty($nutrition_id)) {
            $this->nutrition_pattern();
            $this->db->where(array('a.id' => $nutrition_id));
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    #เพิ่มข้อมูลโภชนาการ (insert or update)
    public function update_nutrition($data)
    {
        if (!empty($data["school_id"]) && !empty($data["nutrition_name"]) && !empty($data["nutrition_calories"])) {
            $arr = array(
                "school_id" => $data["school_id"],
                "name" => $data["nutrition_name"],
                "calories" => $data["nutrition_calories"],
                "image" => (!empty($data["nutrition_image"])) ? $data["nutrition_image"] : "",
                "updated_at" => strtotime(date("Y-m-d h:i:s"))
            );

            $this->db->trans_begin();
            if (!empty($data['nutrition_id'])) {
                #update
                $this->db->where('id', $data['nutrition_id']);
                $this->db->update('tb_nutrition', $arr);
            } else {
                #insert   
                $arr['created_at'] = strtotime(date("Y-m-d h:i:s"));
                $this->db->insert('tb_nutrition', $arr);
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

    #ใช้สำหรับลบข้อมูลโภชนาการในระบบโดยใช้ ID
    public function delete_nutrition($nutrition_id)
    {
        if (!empty($nutrition_id)) {
            $this->db->trans_begin();
            $this->db->where('a.id', $nutrition_id);
            $this->db->delete('tb_nutrition a');

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