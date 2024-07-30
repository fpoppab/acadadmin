<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RoomController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata("userStatus"))) {
            redirect(site_url(), 'refresh');
        }
        $this->load->model("SchoolModel");
        $this->load->model("RoomModel");
    }

    public function roomIndex()
    {
        $data["room"] = $this->RoomModel->get_room_detail_by_school_id($this->session->userdata("userSchoolId"));
        $this->load->view("layout/header");
        $this->load->view("rooms/roomsIndex", $data);
        $this->load->view("layout/footer");
    }

    public function roomInsertForm()
    {
        $this->load->model("PersonnelModel");
        #ระดับชั้น แผนการเรียน
        $data["clss"] = $this->SchoolModel->get_school_clss(TRUE);
        $data["plan"] = $this->RoomModel->get_education_plan();
        #ข้อมูลครูที่ใช้ตั้งเป็นครูประจำชั้น
        $data["personnel"] = $this->PersonnelModel->get_personnel_by_room_id_available($this->session->userdata("userSchoolId"));
        $this->load->view("layout/header");
        $this->load->view("rooms/roomsInsertForm", $data);
        $this->load->view("layout/footer");
    }

    public function roomEditForm($id)
    {
        $this->load->model("PersonnelModel");
        #ระดับชั้น แผนการเรียน
        $data["clss"] = $this->SchoolModel->get_school_clss(TRUE);
        $data["plan"] = $this->RoomModel->get_education_plan();
        #ข้อมูลห้องที่ต้องการแก้ไข
        $data["row"] = $this->RoomModel->get_room_by_id($id);
        #ข้อมูลครูที่ใช้ตั้งเป็นครูประจำชั้น        
        $data["teachers"] = $this->PersonnelModel->get_personnel_by_room_id($id);
        $data["personnel"] = $this->PersonnelModel->get_personnel_by_room_id_available($this->session->userdata("userSchoolId"));
        $this->load->view("layout/header");
        $this->load->view("rooms/roomsInsertForm", $data);
        $this->load->view("layout/footer");
    }

    public function roomEditList($id)
    {
        $this->load->model("StudentModel");
        $mem = $this->RoomModel->get_room_member($id);
        $list = array();
        if (!empty($mem)) {
            $i = 0;
            foreach ($mem as $m) {
                $student = $this->StudentModel->get_student_by_stdid($m['student_id']);
                $list[$i] = $student;
                $i++;
            }
        }
        $data["room"] = $this->RoomModel->get_room_detail_by_id($id);
        $data["studentList"] = $list;
        $this->load->view("layout/header");
        $this->load->view("rooms/roomsIndexMember", $data);
        $this->load->view("layout/footer");
    }

    public function update_room()
    {
        $room_id = $this->input->post("inRoomId");
        $personnel = $this->input->post("inPersonnel");
        $data = array(
            "school_class_register_id" => $this->input->post("inClssId"),
            "education_plan_id" => $this->input->post("inPlanId"),
            "edyear" => $this->session->userdata("userEdyear"),
            "number" => $this->input->post("inRoomNumber")
        );
        $this->RoomModel->update_room($data, $room_id, $personnel);
    }

    public function delete_room()
    {
        $room_id = $this->input->post("RmId");
        echo $this->RoomModel->delete_room_by_id($room_id);
    }

}