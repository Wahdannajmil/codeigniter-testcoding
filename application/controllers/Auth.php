<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function login() {
        if ($this->session->userdata('logged_in')) {
            redirect('home');
        }

        $this->load->helper('form');

        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('login_view');
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $this->load->model('Account_model');

                $account = $this->Account_model->get_account_by_username($username);

                if ($account && password_verify($password, $account['password'])) {
                    $user_data = array(
                        'username' => $account['username'],
                        'name' => $account['name'],
                        'role' => $account['role'],
                        'logged_in' => true
                    );
                    $this->session->set_userdata($user_data);

                    redirect('home');
                } else {
                    $data['error'] = 'Invalid username or password';
                    $this->load->view('login_view', $data);
                }
            }
        } else {
            $this->load->view('login_view');
        }
    }

    public function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('logged_in');

        redirect('auth/login');
    }
}
