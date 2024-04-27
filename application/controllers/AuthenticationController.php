<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthenticationController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("UserModel");
	}

	public function login()
	{
		$row = $this->UserModel->get_user_row();
		if (!empty($row["id"])) {
			if (password_verify($_POST['inPassword'], $row['password'])) {
				#ดึงข้อมูลบุคลากรมาใส่ Session
				$this->load->model("PersonnelModel");
				$Personnel = $this->PersonnelModel->get_personnel_by_user_id($row['id']);

				$this->session->set_userdata('userName', $Personnel["personnel_fullname"]);
				$this->session->set_userdata('userType', $row['type']);
				$this->session->set_userdata('userImage', $Personnel['personnel_profile_image']);
				$this->session->set_userdata('userSchool', $Personnel["school_name"]);
				$this->session->set_userdata('userSchoolId', $Personnel["school_id"]);
				$this->session->set_userdata("userEdyear", date("Y") + 543);
				$this->session->set_userdata("userSemester", 1);
				$this->session->set_userdata('userTheme', 'light');
				$this->session->set_userdata('userLanguage', 'en');
				$this->session->set_userdata('userId', $row['id']);
				$this->session->set_userdata('userStatus', 1);
                              
				#ผูกข้อมูลกับ session
				$this->UserModel->insert_user_session(array('session_id' => $this->session->session_id));
				#ลงข้อมูลว่าเข้าระบบสำเร็จ
				$this->UserModel->insert_user_log(array("type" => "login", "status" => "success"));
				$this->UserModel->insert_user_log(array("type" => "login", "status" => "success"));
				echo true;
			} else {
				#ลงข้อมูลว่าเข้าระบบไม่สำเร็จ
				$this->UserModel->insert_user_log(array("user_id" => $row["id"], "type" => "login", "status" => "fail", "detail" => "wrong password"));
				echo false;
			}
		}

	}

	public function logout()
	{
		$this->UserModel->delete_user_session(array());
		$this->UserModel->insert_user_log(array("type" => "logout", "status" => "success"));
		redirect(site_url('/'), 'refresh');
	}
}