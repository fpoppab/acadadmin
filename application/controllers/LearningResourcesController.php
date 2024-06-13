<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LearningResourcesController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata("userStatus"))) {
            redirect(site_url(), 'refresh');
        }
        $this->load->model("LearningResourcesModel"); 
        $this->load->model("SchoolModel"); 
    }
    
    public function learningResourcesIndex()
    {
        $data["learningresources"] = $this->LearningResourcesModel->get_learningResources($this->session->userdata("userSchoolId"), $this->input->get("Type"));
        
        $this->load->view("layout/header");
        $this->load->view("learning-resources/learningresourcesIndex", $data);
        $this->load->view("layout/footer");
    }
    public function learningResourcesInsertForm()
    {
        // $data["school_clss"] = $this->SchoolModel->get_school_clss(true);
        // $data["group_learning"] = $this->SyllabusModel->get_group_learning();
        $this->load->view("layout/header");
        $this->load->view("learning-resources/learningresourcesInsertForm");
        $this->load->view("layout/footer");
    }
    public function learningResourcesEditForm($lr_id)
    {
        $data["row"] = $this->LearningResourcesModel->get_learningResources_by_id($lr_id);
        $data["school_clss"] = $this->SchoolModel->get_school_clss(true);
        $this->load->view("layout/header");
        $this->load->view("learning-resources/learningresourcesInsertForm", $data);
        $this->load->view("layout/footer");
    }

    public function update_learningresources()
    {
        $arr = array(
            
            "lr_id" => $this->input->post("inLearningResourcesId"),
            "school_id" => $this->session->userdata("userSchoolId"),
            "lr_name" => $this->input->post("inName"),
            "lr_descriptions" => $this->input->post("inDescriptions"),
            "lr_type" => $this->input->post("inType"),
            "lr_status" => $this->input->post("instatus"),
            "lr_purchase_year" => $this->input->post("inPurchase_Year")              
        );
        $this->LearningResourcesModel->update_learningResources($arr);
       
    }

    public function delete_learningresources()
    {
        $lr_id = $this->input->post("inLearningResourcesId");

        $status = $this->LearningResourcesModel->delete_learningresources($lr_id);
        if ($status == "success") {
            echo "ลบข้อมูลสำเร็จ !";
        }
    }
}