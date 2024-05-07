<?php
class Account extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->model('Account_model');
                $data['accounts'] = $this->Account_model->get_accounts();
        
        $this->load->view('account_view', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[account.username]');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('role', 'Role', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('create_account_view');
            } else {
                $data = array(
                    'username' => $this->input->post('username'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'name' => $this->input->post('name'),
                    'role' => $this->input->post('role')
                );
                $this->Account_model->create_account($data);
                
                redirect('account');
            }
        } else {
            $this->load->view('create_account_view');
        }
    }

    public function edit($username) {
        $this->load->model('Account_model');

        $account = $this->Account_model->get_account_by_username($username);
        if (!$account) {
            redirect('account');
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('role', 'Role', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                $data['account'] = $account;
                $this->load->view('edit_account_view', $data);
            } else {
                $data = array(
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'name' => $this->input->post('name'),
                    'role' => $this->input->post('role')
                );
                $this->Account_model->update_account($username, $data);
                
                redirect('account');
            }
        } else {
            $data['account'] = $account;
            $this->load->view('edit_account_view', $data);
        }
    }

    public function delete($username) {
        $this->load->model('Account_model');

        $account = $this->Account_model->get_account_by_username($username);
        if (!$account) {
            redirect('account');
        }

        $this->Account_model->delete_account($username);
        
        redirect('account');
    }
}
