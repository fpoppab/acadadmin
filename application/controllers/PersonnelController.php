<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PersonnelController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata("userStatus"))) {
            redirect(site_url(), 'refresh');
        }
        $this->load->model("PersonnelModel"); 
    }
    public function personnelIndex()
    {
        $data["personnel"] = $this->PersonnelModel->get_personnel_by_school_id($this->session->userdata("userSchoolId"));

        $this->load->view("layout/header");
        $this->load->view("personnel/personnelIndex", $data);
        $this->load->view("layout/footer");
    }
    public function personnelInsertForm()
    {
        $data["type"] = $this->PersonnelModel->get_personnel_type($this->session->userdata("userSchoolId"));
        $this->load->view("layout/header");
        $this->load->view("personnel/personnelInsertForm",$data);
        $this->load->view("layout/footer");
    }
    public function personnelEditForm($personnel_id)
    {
        $data["row"] = $this->PersonnelModel->get_personnel_by_id($personnel_id);
        $data["type"] = $this->PersonnelModel->get_personnel_type($this->session->userdata("userSchoolId"));
        $this->load->view("layout/header");
        $this->load->view("personnel/personnelInsertForm", $data);
        $this->load->view("layout/footer");
    }
    public function insert_personnel()
    {
        $arr = array(
            "school_id" => $this->session->userdata("userSchoolId"),
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
        echo $this->PersonnelModel->insert_personnel($arr);
    }
    public function update_personnel()
    {
        $arr = array(
            "school_id" => $this->session->userdata("userSchoolId"),
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
        $this->PersonnelModel->update_personnel($arr, $this->input->post("inPer"));
    }

    public function delete_personnel()
    {
        $per_id = $this->input->post("inPer");
        $school_id = $this->session->userdata("userSchoolId");

        $status = $this->PersonnelModel->delete_personnel($per_id, $school_id);
        if ($status == "success") {
            echo "ลบข้อมูลสำเร็จ !";
        }
    }
}