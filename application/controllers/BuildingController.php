<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BuildingController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata("userStatus"))) {
            redirect(site_url(), 'refresh');
        }
    }

    public function buildingIndex()
    {

        $this->load->view("layout/header");
        $this->load->view("building/buildingIndex");
        $this->load->view("layout/footer");
    }

    public function buildingInsertForm()
    {

        $this->load->view("layout/header");
        $this->load->view("building/buildingInsertForm");
        $this->load->view("layout/footer");
    }
}