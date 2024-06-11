<?php
class LearningResourcesModel extends CI_Model
{

    public function learningResources_pattern()
    {
        $this->db->select('a.id as lr_id ,a.school_id');
        $this->db->select('a.name as lr_name ,a.descriptions as lr_descriptions,a.type as lr_type');
        $this->db->select('a.status as lr_status ,a.purchase_year as lr_purchase_year');
        $this->db->select('b.name as school_name');
        $this->db->from('tb_learning_resources a');
        $this->db->join('tb_school b', 'b.id = a.school_id');
    }

    #ดึงข้อมูลแหล่งเรียนรู้ทั้งหมดในโรงเรียน
    public function get_learningResources($school_id, $lr_type = null)
    {
        if (!empty($school_id)) {
            $this->learningResources_pattern();
            $this->db->where(array('a.school_id' => $school_id));

            #ดึงข้อมูลแหล่งเรียนรู้กรองข้อมูลด้วยประเภท Type
            if (!empty($lr_type)) {
                $this->db->where(array('a.type' => $lr_type));
            }

            $query = $this->db->get();
            return $query->result_array();
        }
    }

    #ดึงข้อมูลการแหล่งเรียนรู้เดียวโดยใช้ ID 
    public function get_learningResources_by_id($lr_id)
    {
        if (!empty($lr_id)) {
            $this->learningResources_pattern();
            $this->db->where(array('a.id' => $lr_id));
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    #เพิ่มข้อมูลแหล่งเรียนรู้ (insert or update)
    public function update_learningResources($data)
    {
        if (!empty($data["school_id"]) && !empty($data["lr_name"]) && !empty($data["lr_type"])) {
            $arr = array(
                "school_id" => $data["school_id"],
                "name" => $data["lr_name"],
                "descriptions" => $data["lr_descriptions"],
                "type" => $data["lr_type"],
                "status" => $data["lr_status"],
                "purchase_year" => $data["lr_purchase_year"],
                "updated_at" => strtotime(date("Y-m-d h:i:s"))
            );

            $this->db->trans_begin();
            if (!empty($data['lr_id'])) {
                #update
                $this->db->where('id', $data['lr_id']);
                $this->db->update('tb_learning_resources', $arr);
            } else {
                #insert   
                $arr['created_at'] = strtotime(date("Y-m-d h:i:s"));
                $this->db->insert('tb_learning_resources', $arr);
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

    #ใช้สำหรับลบข้อมูลแหล่งเรียนรู้ในระบบโดยใช้ ID
    public function delete_learningResources($lr_id)
    {
        if (!empty($lr_id)) {
            $this->db->trans_begin();
            $this->db->where('a.id', $lr_id);
            $this->db->delete('tb_learning_resources a');

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