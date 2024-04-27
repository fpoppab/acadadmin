<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StudentController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata("userStatus"))) {
            redirect(site_url(), 'refresh');
        }
        $this->load->model("StudentModel");
    }

    public function studentIndex()
    {
        $data["student"] = $this->StudentModel->get_student();

        $this->load->view("layout/header");
        $this->load->view("student/studentIndex", $data);
        $this->load->view("layout/footer");
    }
    public function studentPromoteIndex()
    {
        $data["student"] = $this->StudentModel->get_student();

        $this->load->view("layout/header");
        $this->load->view("student/studentpromoteIndex", $data);
        $this->load->view("layout/footer");
    }
    public function studentReportIndex()
    {
        $data["student"] = $this->StudentModel->get_student();

        $this->load->view("layout/header");
        $this->load->view("student/studentreportIndex", $data);
        $this->load->view("layout/footer");
    }
    public function studentInsertForm()
    {
        $this->load->view("layout/header");
        $this->load->view("student/studentInsertForm");
        $this->load->view("layout/footer");
    }

    public function insert_student()
    {
        $arr = array(
            "school_id" => $this->session->userdata("userSchoolId"),
            "profileimage" => $this->input->post("inStudentLogo64"),
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
            "nationality" => $this->input->post("inNationality"),

            "c_no" => $this->input->post("inC_No"),
            "c_moo" => $this->input->post("inC_Moo"),
            "c_tambol" => $this->input->post("inC_Tambol"),
            "c_amphur" => $this->input->post("inC_AmPhur"),
            "c_province" => $this->input->post("inC_Province"),
            "c_zipcode" => $this->input->post("inC_ZipCode"),

            "r_no" => $this->input->post("inR_No"),
            "r_moo" => $this->input->post("inR_Moo"),
            "r_tambol" => $this->input->post("inR_Tambol"),
            "r_amphur" => $this->input->post("inR_AmPhur"),
            "r_province" => $this->input->post("inR_Province"),
            "r_zipcode" => $this->input->post("inR_ZipCode"),

             
             "f_titlename" => $this->input->post("inF_TitleName"),
             "f_firstname" => $this->input->post("inF_FirstName"),
             "f_lastname" => $this->input->post("inF_LastName"),
             "f_profile_image" => $this->input->post("inParentLogo64"),
             "f_phonenumber" => $this->input->post("inF_PhoneNumber"),
 
            
             "m_titlename" => $this->input->post("inM_TitleName"),
             "m_firstname" => $this->input->post("inM_FirstName"),
             "m_lastname" => $this->input->post("inM_LastName"),
             "m_profile_image" => $this->input->post("inParentLogo64"),
             "m_phonenumber" => $this->input->post("inM_PhoneNumber")
        );
        $this->StudentModel->update_student($arr);
    }

    public function studentEditForm($std_id)
    {
        $data["row"] = $this->StudentModel->get_student_by_stdid($std_id);
        $this->load->view("layout/header");
        $this->load->view("student/studentInsertForm", $data);
        $this->load->view("layout/footer");
    }

    public function update_student()
    {
        #ข้อมูลนักเรียน
        $arr = array(
            "school_id" => $this->session->userdata("userSchoolId"),
            "profileimage" => $this->input->post("inStudentLogo64"),
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
            "nationality" => $this->input->post("inNationality"),

            #ข้อมูลที่อยู่ปัจจุบัน
            "c_no" => $this->input->post("inC_No"),
            "c_moo" => $this->input->post("inC_Moo"),
            "c_tambol" => $this->input->post("inC_Tambol"),
            "c_amphur" => $this->input->post("inC_AmPhur"),
            "c_province" => $this->input->post("inC_Province"),
            "c_zipcode" => $this->input->post("inC_ZipCode"),

            #ข้อมูลที่อยู่ตามทะเบียนบ้าน
            "r_no" => $this->input->post("inR_No"),
            "r_moo" => $this->input->post("inR_Moo"),
            "r_tambol" => $this->input->post("inR_Tambol"),
            "r_amphur" => $this->input->post("inR_AmPhur"),
            "r_province" => $this->input->post("inR_Province"),
            "r_zipcode" => $this->input->post("inR_ZipCode"),

            #ข้อมูลพื้นฐานพ่อ
            "f_titlename" => $this->input->post("inF_TitleName"),
            "f_firstname" => $this->input->post("inF_FirstName"),
            "f_lastname" => $this->input->post("inF_LastName"),
            "f_profile_image" => $this->input->post("inParentLogo64"),
            "f_phonenumber" => $this->input->post("inF_PhoneNumber"),

            #ข้อมูลพื้นฐานแม่
            "m_titlename" => $this->input->post("inM_TitleName"),
            "m_firstname" => $this->input->post("inM_FirstName"),
            "m_lastname" => $this->input->post("inM_LastName"),
            "m_profile_image" => $this->input->post("inParentLogo64"),
            "m_phonenumber" => $this->input->post("inM_PhoneNumber")
        );
        $this->StudentModel->update_student($arr, $this->input->post("inStdId"));
    }

    public function delete_student()
    {
        $std_id = $this->input->post("inStdId");
        $school_id = $this->session->userdata("userSchoolId");

        $status = $this->StudentModel->delete_student($std_id, $school_id);
        if ($status == "success") {
            echo "ลบข้อมูลสำเร็จ !";
        }
    }
    
    public function studentPP2Report($std_id)
    {
        $data["row"] = $this->StudentModel->get_student_by_stdid($std_id);
        
        //MPDF
        $data["title"] = "Title";
        $content1 = "Test part1 <hr>";
        $content2 = "<p>Test part2 </p>";
        $data["myContent"] = array($content1,$content2);
        $this->load->view("layout/header");
        $this->load->view("student/studentreportPP2", $data);
        $this->load->view("layout/footer");
    }
}
