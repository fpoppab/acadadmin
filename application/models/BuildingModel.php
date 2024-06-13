<?php
class BuildingModel extends CI_Model
{

    public function building_pattern()
    {
        $this->db->select('a.school_id ,a.building_type_id  ,a.id as building_id,a.name as building_name,a.status as building_status,a.descriptions as building_descriptions,a.purchase_year as building_purchase_year');
        $this->db->select('a.created_at as building_created_at,a.updated_at as building_updated_at');
        $this->db->select('b.id as building_type_id,b.name as building_type_name');
        $this->db->from('tb_building a');
        $this->db->join('tb_building_type b', 'b.id = a.building_type_id');
    }

    #ดึงข้อมูลอาคารทั้งหมดในโรงเรียน
    public function get_building($school_id, $type_id = null, $status = null)
    {
        if (!empty($school_id)) {
            $this->building_pattern();
            $this->db->where(array('a.school_id' => $school_id));

            #ดึงข้อมูลอาคารเดียวโดยใช้ ID ของ Building_type
            if (!empty($type_id)) {
                $this->db->where(array('a.building_type_id' => $type_id));
            }

            #ดึงข้อมูลอาคารเดียวโดยใช้สถานะ
            if (!empty($status)) {
                $this->db->where(array('a.status' => $status));
            }
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    #ดึงข้อมูลอาคารเดียวโดยใช้ ID ของ Building
    public function get_building_by_id($building_id)
    {
        if (!empty($building_id)) {
            $this->building_pattern();
            $this->db->where(array('a.id' => $building_id));
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    #ดึงข้อมูลประเภทอาคาร
    public function get_building_type()
    {
        $this->db->select('b.id as building_type_id,b.name as building_type_name,b.code as building_type_code');
        $this->db->from('tb_building_type b');
        $query = $this->db->get();
        return $query->result_array();
    }

    #เพิ่มข้อมูลอาคาร (insert or update)
    public function update_building($data)
    {
        if (!empty($data["school_id"]) && !empty($data["building_type_id"]) && !empty($data["name"]) && !empty($data["status"])) {
            $arr = array(
                "school_id" => $data["school_id"],
                "building_type_id" => $data["building_type_id"],
                "name" => $data["name"],
                "status" => $data["status"],
                "descriptions" => $data["descriptions"],
                "purchase_year" => $data["purchase_year"],
                "updated_at" => strtotime(date("Y-m-d h:i:s"))
            );

            $this->db->trans_begin();
            if (!empty($data['id'])) {
                #update
                $this->db->where('id', $data['id']);
                $this->db->update('tb_building', $arr);
            } else {
                #insert   
                $arr['created_at'] = strtotime(date("Y-m-d h:i:s"));
                $this->db->insert('tb_building', $arr);
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

    #ใช้สำหรับลบอาคารในระบบโดยใช้ ID ของ Building
    public function delete_building($building_id)
    {
        if (!empty($building_id)) {
            $this->db->trans_begin();
            $this->db->where('id', $building_id);
            $this->db->delete('tb_building');

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