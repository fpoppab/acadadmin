<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VehicleController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata("userStatus"))) {
            redirect(site_url(), 'refresh');
        }
        $this->load->model('VehicleModel');
    }

    public function vehicleIndex()
    {
        $data["vehicle"]=$this->VehicleModel->get_vehicle($this->session->userdata("userSchoolId"));
        $this->load->view("layout/header");
        $this->load->view("vehicle/vehicleIndex",$data);
        $this->load->view("layout/footer");
    }

    public function vehicleInsertForm()
    {
        $this->load->view("layout/header");
        $this->load->view("vehicle/vehicleInsertForm");
        $this->load->view("layout/footer");
    }

    public function vehicleEditForm($vehicle_id)
    {
        $data["row"] = $this->VehicleModel->get_vehicle_by_id($vehicle_id);
        $this->load->view("layout/header");
        $this->load->view("vehicle/vehicleInsertForm", $data);
        $this->load->view("layout/footer");
    }

    public function update_vehicle()
    {
        $data = array(
            "vehicle_id" => $this->input->post("inVc"),
            "school_id" => $this->session->userdata("userSchoolId"),
            "vehicle_license_plate" => $this->input->post("inLicense"),
            "vehicle_code" => $this->input->post("inCode"),
            "vehicle_image" => $this->input->post("inVehicleLogo64"),
            "vehicle_driver_name" => $this->input->post("inDriver"),
            "vehicle_brand" => $this->input->post("inBrand"),
            "vehicle_model"=> $this->input->post("inModel"),
            "vehicle_capacity"=> $this->input->post("inCapacity")
            
        );
        echo $this->VehicleModel->update_vehicle($data, $this->input->post("inVc"));
    }

    public function delete_vehicle()
    {
        $vehicle_id = $this->input->post("inVc");

        $status = $this->VehicleModel->delete_vehicle($vehicle_id);
        if ($status == "success") {
            echo "ลบข้อมูลสำเร็จ !";
        }
    }

}