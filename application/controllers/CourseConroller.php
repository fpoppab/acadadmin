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
    public function courseRegisterIndex()
    {
        $this->load->view("layout/header");
        $this->load->view("course/courseregisterIndex");
        $this->load->view("layout/footer");
    }
}