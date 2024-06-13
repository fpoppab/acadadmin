<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CourseController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata("userStatus"))) {
            redirect(site_url(), 'refresh');
        }
        $this->load->model("CourseModel"); 
        $this->load->model("SchoolModel"); 
        $this->load->model("SyllabusModel"); 
    }
    
    public function syllaBusIndex()
    {
        $this->load->view("layout/header");
        $this->load->view("course/syllabusIndex");
        $this->load->view("layout/footer");
    }
    public function courseIndex()
    {
        $data["course"] = $this->CourseModel->get_course($this->session->userdata("userSchoolId"),$this->input->get("Group_Learning"), $this->input->get("Type"));
        $data["group_learning"] = $this->SyllabusModel->get_group_learning();
        $this->load->view("layout/header");
        $this->load->view("course/courseIndex", $data);
        $this->load->view("layout/footer");
    }
    public function courseInsertForm()
    {
        $data["school_clss"] = $this->SchoolModel->get_school_clss(true);
        $data["group_learning"] = $this->SyllabusModel->get_group_learning();
        $this->load->view("layout/header");
        $this->load->view("course/courseInsertForm", $data);
        $this->load->view("layout/footer");
    }
    public function courseEditForm($course_id)
    {
        $data["row"] = $this->CourseModel->get_course_by_id($course_id);
        $data["school_clss"] = $this->SchoolModel->get_school_clss(true);
        $data["group_learning"] = $this->SyllabusModel->get_group_learning();
        $this->load->view("layout/header");
        $this->load->view("course/courseInsertForm", $data);
        $this->load->view("layout/footer");
    }

    public function update_course()
    {
        $arr = array(
            
           "id" => $this->input->post("inCourseId"),
            "group_learning_id" => $this->input->post("inGroup_Learning_id"),
            "school_class_register_id" => $this->input->post("inSchool_Class_Register_id"),
            "name" => $this->input->post("inName"),
            "code" => $this->input->post("inCode"),
            "type" => $this->input->post("inType"),
            "hours_per_week" => $this->input->post("inHours_Per_Week"),
            "descriptions" => $this->input->post("inDescriptions")           
        );
        $this->CourseModel->update_course($arr, $this->input->post("inCourseId"));
    }

    public function delete_course()
    {
        $course_id = $this->input->post("inCourseId");

        $status = $this->CourseModel->delete_course($course_id);
        if ($status == "success") {
            echo "ลบข้อมูลสำเร็จ !";
        }
    }
    public function courseRegisterIndex()
    {
        $this->load->view("layout/header");
        $this->load->view("course/courseregisterIndex");
        $this->load->view("layout/footer");
    }
}