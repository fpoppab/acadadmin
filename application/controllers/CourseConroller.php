<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CourseConroller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata("userStatus"))) {
            redirect(site_url(), 'refresh');
        }

    }
    public function syllaBusIndex()
    {
        $this->load->view("layout/header");
        $this->load->view("course/syllabusIndex");
        $this->load->view("layout/footer");
    }
    public function courseIndex()
    {
        $this->load->view("layout/header");
        $this->load->view("course/courseIndex");
        $this->load->view("layout/footer");
    }
    public function courseInsertForm()
    {
        $this->load->view("layout/header");
        $this->load->view("course/courseInsertForm");
        $this->load->view("layout/footer");
    }
    public function courseEditForm($personnel_id)
    {
        
    }
    public function insert_course()
    {
        $arr = array(
            "personneltypeid" => $this->input->post("inType"),
            "profile_image" => $this->input->post("inPersonnelLogo64"),
            "titlename" => $this->input->post("inTitleName"),
            "firstname" => $this->input->post("inFirstName"),
            "lastname" => $this->input->post("inLastName"),
            "nickname" => $this->input->post("inNickName"),
            "idcard" => $this->input->post("inIdCard"),
            "birthdate" => $this->input->post("inBirthDate"),
            "gender" => $this->input->post("inGenDer"),
            "bloodtype" => $this->input->post("inBloodType"),
            "phonenumber" => $this->input->post("inPhoneNumber"),
            "religion" => $this->input->post("inReligion"),
            "ethnicity" => $this->input->post("inEthnicity"),
            "nationality" => $this->input->post("inNationality")
            
        );
        echo $this->PersonnelModel->insert_course($arr);
    }

    public function delete_course()
    {
        $per_id = $this->input->post("inPer");
        $school_id = $this->session->userdata("userSchoolId");

        $status = $this->PersonnelModel->delete_coursel($per_id, $school_id);
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