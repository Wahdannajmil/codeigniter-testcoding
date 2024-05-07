<?php
class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url'); // Memuat URL Helper
        $this->load->library('session');
    }

    public function index() {
        $this->load->view('home_view');
    }
}
