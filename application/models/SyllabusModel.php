<?php
class SyllabusModel extends CI_Model
{

    #ดึงข้อมูลกลุ่มสาระ
    public function get_group_learning()
    {
        $this->db->select('g.id as group_learning_id,g.name as group_learning_name,g.year as group_learning_year');
        $this->db->from('tb_group_learning g');
        $this->db->where(array('g.displaystatus' => 1));
        $query = $this->db->get();
        return $query->result_array();
    }

}