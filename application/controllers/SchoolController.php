<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SchoolController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata("userStatus"))) {
            redirect(site_url(), 'refresh');
        }
        $this->load->model("SchoolModel");
    }

    #School Information Setting
    public function schoolIndex()
    {
        $data["schoolTypeArr"] = $this->SchoolModel->get_school_type();
        $data["row"] = $this->SchoolModel->get_school();
        $edyear = (!empty($this->input->get("edyear"))) ? $this->input->get("edyear") : date("Y") + 543;
        $data["edyear"] = $edyear;
        $school_id = $this->session->userdata("userSchoolId");
        // $data["edyear"] = date("Y") + 543;
        $data["edyearRow"] = $this->SchoolModel->get_edyear_by_edyear($school_id, $edyear);
        $data["semester"] = $this->SchoolModel->get_all_semester_by_edyear($school_id, $edyear);
        $data["clss"] = $this->SchoolModel->get_school_clss();

        $this->load->view("layout/header");
        $this->load->view("school/schoolIndex", $data);
        $this->load->view("layout/footer");
    }

    public function update_school()
    {
        $data = array(
            'school_type_id' => $_POST["inSchoolTypeId"],
            'name' => $_POST["inSchoolName"],
            'logo' => $_POST["inSchoolLogo64"],
            'tambol' => $_POST["inSchoolTambol"],
            'amphur' => $_POST["inSchoolAmphur"],
            'province' => $_POST["inSchoolProvince"],
            'zipcode' => $_POST["inSchoolZipcode"],
            'phone' => $_POST["inSchoolPhone"]
        );
        $this->SchoolModel->update_school($_POST["inSchoolId"], $data);
    }

    public function update_edyear()
    {
         $schId = 1;
        if(!empty($this->session->userdata("userSchoolId"))){
             $schId = $this->session->userdata("userSchoolId");
        }
        if (!empty($this->input->post("inEdYearStartdate")) && !empty($this->input->post("inEdYearEnddate"))) {
            $data = array(
                'school_id' => $schId,
                'year' => $this->input->post("inSchoolEdyear"),
                'startdate' => strtotime($this->input->post("inEdYearStartdate")),
                'enddate' => strtotime($this->input->post("inEdYearEnddate"))
            );
            echo $this->SchoolModel->update_edyear($data);

            $maximum = $this->input->post("inMaximumSemester");
            for ($x = 1; $x <= $maximum; $x++) {
                $data2 = array(
                    'school_id' => $this->session->userdata("userSchoolId"),
                    'edyear' => $this->input->post("inSchoolEdyear"),
                    'semester_number' => $x,
                    'startdate' => strtotime($this->input->post("inSemester" . $x . "Startdate")),
                    'enddate' => strtotime($this->input->post("inSemester" . $x . "Enddate"))
                );
                $this->SchoolModel->update_semester($data2);
            }
        } else {
            echo "missing parameter";
        }
    }

    public function update_clss()
    {
        $clss = $this->SchoolModel->get_school_clss();
        $result = "";
        $schId = 1;
        if(!empty($this->session->userdata("userSchoolId"))){
             $schId = $this->session->userdata("userSchoolId");
        }
        foreach ($clss as $c) {
            if (!empty($this->input->post("inClssCheckBox" . $c["school_clss_id"]))) {
                $data = array(
                    'school_id' => $schId,
                    'school_class_id' => $c['school_clss_id'],
                    'register_sequence' => $c['sequence'],
                    'register_graduation' => 0,
                );

                $this->SchoolModel->update_clss($data);
                $result = "Update Success";
            } else {
                $chk = $this->SchoolModel->get_school_clss_by_school_id_and_school_class_id($this->session->userdata("userSchoolId"), $c['school_clss_id']);
                if (!empty($chk['clss_id'])) {
                    $this->SchoolModel->delete_clss($chk['clss_id']);
                    $result .= "\n Delete Success";
                }
            }
        }
        echo $result;
    }

    public function roomIndex()
    {
        $data["room"] = $this->SchoolModel->get_room();
        $this->load->view("layout/header");
        $this->load->view("rooms/roomsIndex", $data);
        $this->load->view("layout/footer");
    }

    public function roomInsertForm()
    {
        $this->load->model("PersonnelModel");
        #ระดับชั้น แผนการเรียน
        $data["clss"] = $this->SchoolModel->get_school_clss(TRUE);
        $data["plan"] = $this->SchoolModel->get_education_plan();
        #ข้อมูลครูที่ใช้ตั้งเป็นครูประจำชั้น
        $data["personnel"] = $this->PersonnelModel->get_personnel_by_school_id($this->session->userdata("userSchoolId"));
        $this->load->view("layout/header");
        $this->load->view("rooms/roomsInsertForm", $data);
        $this->load->view("layout/footer");
    }

    public function roomEditForm($id)
    {
        $this->load->model("PersonnelModel");
        #ระดับชั้น แผนการเรียน
        $data["clss"] = $this->SchoolModel->get_school_clss(TRUE);
        $data["plan"] = $this->SchoolModel->get_education_plan();
        #ข้อมูลห้องที่ต้องการแก้ไข
        $data["row"] = $this->SchoolModel->get_room_by_id($id);
        #ข้อมูลครูที่ใช้ตั้งเป็นครูประจำชั้น
        $data["personel"] = $this->PersonnelModel->get_personnel_by_school_id($this->session->userdata("userSchoolId"));
        $data["teacher"] = $this->PersonnelModel->get_personnel_by_room_id($this->session->userdata("userSchoolId"));
        $this->load->view("layout/header");
        $this->load->view("rooms/roomsInsertForm", $data);
        $this->load->view("layout/footer");
    }
    
    public function roomEditList($id) {
        $this->load->model("StudentModel");
        $mem = $this->SchoolModel->get_room_member($id);
        $list = array();
        if(!empty($mem)){
            $i = 0;
            foreach($mem as $m){
                $student = $this->StudentModel->get_student_by_stdid($m['student_id']);
                $list[$i] = $student;
                $i++;
            }
        }
        $data["room"] = $this->SchoolModel->get_room_detail_by_id($id);
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
        $this->SchoolModel->update_room($data, $room_id,$personnel);
    }


    public function subjectTeacherIndex()
    {
        $this->load->view("layout/header");
        $this->load->view("subject-teacher/subjectteacherIndex");
        $this->load->view("layout/footer");
    }
}