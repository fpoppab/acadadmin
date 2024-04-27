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
    }
    public function usersIndex()
    {
        // $data["schoolTypeArr"] = $this->SchoolModel->get_school_type();
        // $data["row"] = $this->SchoolModel->get_school();
        $data["users"] = $this->UserModel->get_user();
        $this->load->view("layout/header");
        $this->load->view("users/usersIndex",$data);
        $this->load->view("layout/footer");
    }

    public function userInsertForm()
    {
        // $data["users"] = $this->UserModel->get_user();
        $this->load->view("layout/header");
        $this->load->view("users/userInsertForm");
        $this->load->view("layout/footer");
    }
}