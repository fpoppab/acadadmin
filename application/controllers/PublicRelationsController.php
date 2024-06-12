<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PublicRelationsController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata("userStatus"))) {
            redirect(site_url(), 'refresh');
        }
        $this->load->model('PublicRelationsModel');
    }

    public function publicrelationsIndex()
    {
        $data["publicrelations"]=$this->PublicRelationsModel->get_publicRelations($this->session->userdata("userSchoolId"));
        $this->load->view("layout/header");
        $this->load->view("public-relations/publicrelationsIndex",$data);
        $this->load->view("layout/footer");
    }

    public function publicrelationsInsertForm()
    {
        $this->load->view("layout/header");
        $this->load->view("public-relations/publicrelationsInsertForm");
        $this->load->view("layout/footer");
    }

    public function publicrelationsEditForm($pr_id)
    {
        $data["row"] = $this->PublicRelationsModel->get_publicRelations_by_id($pr_id);
        $this->load->view("layout/header");
        $this->load->view("public-relations/publicrelationsInsertForm", $data);
        $this->load->view("layout/footer");
    }

    public function update_publicrelations()
    {
        $data = array(
            "pr_id" => $this->input->post("inPr"),
            "school_id" => $this->session->userdata("userSchoolId"),
            "pr_topic" => $this->input->post("inTopic"),
            "pr_type" => $this->input->post("inType"),
            "pr_descriptions" => $this->input->post("inDescriptions"),
            "pr_startdate" => $this->input->post("inStartDate"),
            "pr_enddate" => $this->input->post("inEndDate")
            
        );
        echo $this->PublicRelationsModel->update_publicRelations($data, $this->input->post("inPr"));
    }

    public function delete_publicRelations()
    {
        $pr_id = $this->input->post("inPr");

        $status = $this->PublicRelationsModel->delete_publicRelations($pr_id);
        if ($status == "success") {
            echo "ลบข้อมูลสำเร็จ !";
        }
    }



}
