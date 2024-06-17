<?php
class VehicleModel extends CI_Model
{

    public function vehicle_pattern()
    {
        $this->db->select('a.id as vehicle_id ,a.school_id');
        $this->db->select('a.license_plate as vehicle_license_plate,a.code as vehicle_code,a.image as vehicle_image');
        $this->db->select('a.driver_name as vehicle_driver_name,a.brand as vehicle_brand');
        $this->db->select('a.model as vehicle_model,a.capacity as vehicle_capacity');
        $this->db->select('b.name as school_name');
        $this->db->from('tb_vehicle a');
        $this->db->join('tb_school b', 'b.id = a.school_id');
    }

    #ดึงข้อมูลรถโรงเรียนทั้งหมดในโรงเรียน
    public function get_vehicle($school_id)
    {
        if (!empty($school_id)) {
            $this->vehicle_pattern();
            $this->db->where(array('a.school_id' => $school_id));
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    #ดึงข้อมูลรถโรงเรียนเดียวโดยใช้ ID ของ Public Relations
    public function get_vehicle_by_id($vehicle_id)
    {
        if (!empty($vehicle_id)) {
            $this->vehicle_pattern();
            $this->db->where(array('a.id' => $vehicle_id));
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    #เพิ่มข้อมูลรถโรงเรียน (insert or update)
    public function update_vehicle($data)
    {
        if (!empty($data["school_id"]) && !empty($data["vehicle_license_plate"]) && !empty($data["vehicle_brand"]) && !empty($data["vehicle_capacity"])) {
            $arr = array(
                "school_id" => $data["school_id"],
                "license_plate" => $data["vehicle_license_plate"],
                "image" => (!empty($data["vehicle_image"])) ? $data["vehicle_image"] : "",
                "code" => $data["vehicle_code"],
                "driver_name" => $data["vehicle_driver_name"],
                "brand" => $data["vehicle_brand"],
                "model" => $data["vehicle_model"],
                "capacity" => $data["vehicle_capacity"],
                "updated_at" => strtotime(date("Y-m-d h:i:s"))
            );

            $this->db->trans_begin();
            if (!empty($data['vehicle_id'])) {
                #update
                $this->db->where('id', $data['vehicle_id']);
                $this->db->update('tb_vehicle', $arr);
            } else {
                #insert   
                $arr['created_at'] = strtotime(date("Y-m-d h:i:s"));
                $this->db->insert('tb_vehicle', $arr);
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

    #ใช้สำหรับลบข้อมูลรถโรงเรียนในระบบโดยใช้ ID
    public function delete_vehicle($vehicle_id)
    {
        if (!empty($vehicle_id)) {
            $this->db->trans_begin();
            $this->db->where('a.id', $vehicle_id);
            $this->db->delete('tb_vehicle a');

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