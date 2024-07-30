<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ErrorController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function error_404()
    {
        $this->load->view("errors/error_404");
    }
}