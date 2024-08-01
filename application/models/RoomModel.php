<?php
class RoomModel extends CI_Model
{
    public function room_pattern()
    {
        $this->db->select('a.id as school_clss_id,b.id as clss_id,c.id as room_id');
        $this->db->select('c.number as room_number');
        $this->db->select('CONCAT(a.name, "ปีที่ ", a.level) AS clss_name');
        $this->db->select('CONCAT(a.name, "ปีที่ ", a.level,"/",c.number) AS clss_room');
        $this->db->select('CONCAT(a.abbreviation, ".", a.level,"/",c.number) AS clss_room_ab');
        $this->db->select('d.name as plan_name');
        $this->db->from('tb_school_class a');
        $this->db->join('tb_school_class_register b', 'b.school_class_id = a.id');
        $this->db->join('tb_room c', 'c.school_class_register_id = b.id');
        $this->db->join('tb_education_plan d', 'd.id = c.education_plan_id', 'LEFT OUTER');
        $this->db->order_by('a.sequence ASC');
        $this->db->order_by('c.number ASC');
    }

    #ดึงข้อมูลห้องเรียน
    public function get_room_by_school_id($school_id)
    {
        if (!empty($school_id)) {
            $this->room_pattern();
            $this->db->where(array('b.school_id' => $school_id));
            $query = $this->db->get();
            return $query->result_array();
        } else {
            return "missing parameter";
        }
    }

    public function get_room_by_clss_id($clss_id)
    {
        if (!empty($clss_id)) {
            $this->room_pattern();
            $this->db->where("b.id", $clss_id);
            $query = $this->db->get();
            return $query->result_array();
        } else {
            return "missing parameter";
        }
    }
    public function get_room_detail_by_school_id($school_id)
    {
        if (!empty($school_id)) {
            $this->room_pattern();
            $this->db->select('GROUP_CONCAT(CONCAT(g.titlename, g.firstname, " ", g.lastname) ORDER BY g.id SEPARATOR ",") as room_teachers');
            // $this->db->select('g.firstname as g_name');
            $this->db->join('tb_room_teacher e', 'e.room_id = c.id', 'LEFT OUTER');
            $this->db->join('tb_personnel_register f', 'f.id = e.personnel_register_id', 'LEFT OUTER');
            $this->db->join('tb_personnel g', 'g.id = f.personnel_id', 'LEFT OUTER');
            $this->db->group_by('c.id');
            $this->db->where(array('b.school_id' => $school_id));
            $query = $this->db->get();
            return $query->result_array();
        } else {
            return "missing parameter";
        }
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

    public function get_room_detail_by_id($id)
    {
        $this->room_pattern();
        $this->db->where("c.id", $id);
        $this->db->order_by('a.sequence ASC');
        $this->db->order_by('c.number ASC');
        $query = $this->db->get();
        return $query->row_array();
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
                #clear teacher data before update
                $this->db->where('room_id', $room_id);
                $this->db->delete('tb_room_teacher');
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

                    $insert_query = $this->db->insert_string('tb_room_teacher', $data2);
                    $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
                    $this->db->query($insert_query);

                    // $this->db->insert('tb_room_teacher', $data2);
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

    #ลบข้อมูลห้องเรียนด้วย id
    public function delete_room_by_id($room_id)
    {
        if (!empty($room_id)) {
            $this->db->trans_begin();

            $this->db->where('id', $room_id);
            $this->db->delete('tb_room');

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return "rollback";
            } else {
                $this->db->trans_commit();
                return "success";
            }
        } else {
            echo "missing parameter";
        }
    }

    #ดึงข้อมูลแผนการเรียนสำหรับห้อง
    public function get_education_plan()
    {
        $this->db->select('name as ed_plan_name,id as ed_plan_id')->from('tb_education_plan');
        $query = $this->db->get();
        return $query->result_array();
    }

    #ดึงข้อมูลนักเรียนภายในห้อง
    public function get_room_member($room_id = null)
    {
        $this->db->select('*');
        $this->db->from('tb_room_members a');
        if (!empty($room_id)) {
            $this->db->where(array('room_id' => $room_id));
        }
        $this->db->order_by('number ASC');

        $query = $this->db->get();
        return $query->result_array();
    }


}