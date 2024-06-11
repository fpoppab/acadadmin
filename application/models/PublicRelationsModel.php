<?php
class PublicRelationsModel extends CI_Model
{

    public function publicRelations_pattern()
    {
        $this->db->select('a.id as pr_id ,a.school_id');
        $this->db->select('a.topic as pr_topic ,a.descriptions as pr_descriptions,a.type as pr_type');
        $this->db->select('a.startdate as pr_startdate ,a.enddate as pr_enddate');
        $this->db->select('b.name as school_name');
        $this->db->from('tb_public_relations a');
        $this->db->join('tb_school b', 'b.id = a.school_id');
    }

    #ดึงข้อมูลการประชาสัมพันธ์ทั้งหมดในโรงเรียน
    public function get_publicRelations($school_id, $pr_type = null)
    {
        if (!empty($school_id)) {
            $this->publicRelations_pattern();
            $this->db->where(array('a.school_id' => $school_id));

            #ดึงข้อมูลการประชาสัมพันธ์กรองข้อมูลด้วยประเภท Type
            if (!empty($pr_type)) {
                $this->db->where(array('a.type' => $pr_type));
            }

            $query = $this->db->get();
            return $query->result_array();
        }
    }

    #ดึงข้อมูลการประชาสัมพันธ์เดียวโดยใช้ ID ของ Public Relations
    public function get_publicRelations_by_id($pr_id)
    {
        if (!empty($pr_id)) {
            $this->publicRelations_pattern();
            $this->db->where(array('a.id' => $pr_id));
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    #เพิ่มข้อมูลการประชาสัมพันธ์ (insert or update)
    public function update_publicRelations($data)
    {
        if (!empty($data["school_id"]) && !empty($data["pr_topic"]) && !empty($data["pr_type"])) {
            $arr = array(
                "school_id" => $data["school_id"],
                "topic" => $data["pr_topic"],
                "descriptions" => $data["pr_descriptions"],
                "type" => $data["pr_type"],
                "startdate" => strtotime($data["pr_startdate"]),
                "enddate" => strtotime($data["pr_enddate"]),
                "updated_at" => strtotime(date("Y-m-d h:i:s"))
            );

            $this->db->trans_begin();
            if (!empty($data['pr_id'])) {
                #update
                $this->db->where('id', $data['pr_id']);
                $this->db->update('tb_public_relations', $arr);
            } else {
                #insert   
                $arr['created_at'] = strtotime(date("Y-m-d h:i:s"));
                $this->db->insert('tb_public_relations', $arr);
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

    #ใช้สำหรับลบข้อมูลการประชาสัมพันธ์ในระบบโดยใช้ ID
    public function delete_publicRelations($pr_id)
    {
        if (!empty($pr_id)) {
            $this->db->trans_begin();
            $this->db->where('a.id', $pr_id);
            $this->db->delete('tb_public_relations a');

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