<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NutritionController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata("userStatus"))) {
            redirect(site_url(), 'refresh');
        }
        $this->load->model("NutritionModel"); 
    }
    
    public function nutritionIndex()
    {
        $data["nutrition"] = $this->NutritionModel->get_nutrition($this->session->userdata("userSchoolId"));
        $this->load->view("layout/header");
        $this->load->view("nutrition/nutritionIndex", $data);
        $this->load->view("layout/footer");
    }
    public function nutritionInsertForm()
    {
        $this->load->view("layout/header");
        $this->load->view("nutrition/nutritionInsertForm");
        $this->load->view("layout/footer");
    }
    public function nutritionEditForm($nutrition_id)
    {
        $data["row"] = $this->NutritionModel->get_nutrition_by_id($nutrition_id);
        $this->load->view("layout/header");
        $this->load->view("nutrition/nutritionInsertForm", $data);
        $this->load->view("layout/footer");
    }

    public function update_nutrition()
    {
        $arr = array(
            
            "nutrition_id" => $this->input->post("inNutritionId"),
            "school_id" => $this->session->userdata("userSchoolId"),
            "nutrition_name" => $this->input->post("inNutritionName"),
            "nutrition_calories" => $this->input->post("inNutritionCalories"),
            "nutrition_image" => $this->input->post("inNutritionimage64")          
        );
        $this->NutritionModel->update_nutrition($arr, $this->input->post("inNutritionId"));
    }

    public function delete_nutrition()
    {
        $nutrition_id = $this->input->post("inNutritionId");

        $status = $this->NutritionModel->delete_nutrition($nutrition_id);
        if ($status == "success") {
            echo "ลบข้อมูลสำเร็จ !";
        }
    }
}