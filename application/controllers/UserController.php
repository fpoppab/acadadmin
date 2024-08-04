<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata("userStatus"))) {
            redirect(site_url(), 'refresh');
        }
        $this->load->model("UserModel");
        $this->load->model("SchoolModel");
        $this->load->model("PersonnelModel");
    }
    public function usersIndex()
    {
        $data["users"] = $this->UserModel->get_user();
        $this->load->view("layout/header");
        $this->load->view("users/usersIndex", $data);
        $this->load->view("layout/footer");
    }

    public function generate_user_by_personnel()
    {
        $personnel = $this->PersonnelModel->get_personnel_by_id($this->input->post("personnel_id"));
        $arr = array(
            "school_id" => $this->session->userdata("userSchoolId"),
            "personnel_id" => $this->input->post("personnel_id"),
            "username" => $personnel['email'],
            "type" => 'user',
            "password" => password_hash($personnel['idcard'], PASSWORD_DEFAULT)
        );
        $this->UserModel->update_user($arr, $this->input->post("inUserId"));
    }

    public function disable_user()
    {
        $this->UserModel->update_user_status($this->input->post("user_id"), 0);
        echo $this->input->post("user_id");
    }

    public function enable_user()
    {
        $this->UserModel->update_user_status($this->input->post("user_id"), 1);
    }

}