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
        $this->load->model('BuildingModel');
    }

    public function buildingIndex()
    {
        $data["building_type"] = $this->BuildingModel->get_building_type();
        $data["building"] = $this->BuildingModel->get_building($this->session->userdata("userSchoolId"),$this->input->get("Type"),$this->input->get("Status"));
        $this->load->view("layout/header");
        $this->load->view("building/buildingIndex", $data);
        $this->load->view("layout/footer");
    }

    public function buildingInsertForm()
    {
        $data["building_type"] = $this->BuildingModel->get_building_type();
        $this->load->view("layout/header");
        $this->load->view("building/buildingInsertForm", $data);
        $this->load->view("layout/footer");
    }

    public function buildingEditForm($building_id)
    {
        $data["row"] = $this->BuildingModel->get_building_by_id($building_id);
        $data["building_type"] = $this->BuildingModel->get_building_type();
        $this->load->view("layout/header");
        $this->load->view("building/buildingInsertForm", $data);
        $this->load->view("layout/footer");
    }

    public function insert_building()
    {
        $arr = array(
            "school_id" => $this->session->userdata("userSchoolId"),
            "building_type_id" => $this->input->post("inType"),
            "name" => $this->input->post("inName"),
            "descriptions" => $this->input->post("inDetail"),
            "purchase_year" => $this->input->post("inReceive"),
            "status" => $this->input->post("inStatus")

        );
        echo $this->BuildingModel->update_building($arr);
    }

    public function update_building()
    {
        $arr = array(
            "id" => $this->input->post("inBld"),
            "school_id" => $this->session->userdata("userSchoolId"),
            "building_type_id" => $this->input->post("inType"),
            "name" => $this->input->post("inName"),
            "descriptions" => $this->input->post("inDetail"),
            "purchase_year" => $this->input->post("inReceive"),
            "status" => $this->input->post("inStatus")

        );
        echo $this->BuildingModel->update_building($arr, $this->input->post("inBld"));
    }

    public function delete_building()
    {
        $bld_id = $this->input->post("inBld");

        $status = $this->BuildingModel->delete_building($bld_id);
        if ($status == "success") {
            echo "ลบข้อมูลสำเร็จ !";
        }
    }
}