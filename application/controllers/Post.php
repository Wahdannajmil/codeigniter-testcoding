<?php
class Post extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation'); // Memuat library Form Validation
        $this->load->library('session'); // Memuat library Session
    }

    public function index() {
        // Load model
        $this->load->model('Post_model');
        
        // Get all posts
        $data['posts'] = $this->Post_model->get_posts();
        
        // Load view with data
        $this->load->view('post_view', $data);
    }

    // CRUD functions for posts
    public function create() {
        // Check if form is submitted
        if ($this->input->post()) {
            // Form validation
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('content', 'Content', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                // If validation fails, reload create form with errors
                $this->load->view('create_post_view');
            } else {
                // Validation successful, create new post
                $data = array(
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'date' => date('Y-m-d H:i:s'),
                    'username' => $this->session->userdata('username') // Assuming username is stored in session
                );
                $this->Post_model->create_post($data);
                
                // Redirect to post index page
                redirect('post');
            }
        } else {
            // Load create form
            $this->load->view('create_post_view');
        }
    }

    public function edit($id) {
        // Load model
        $this->load->model('Post_model');

        // Check if post exists
        $post = $this->Post_model->get_post_by_id($id);
        if (!$post) {
            // If post not found, redirect to post index page or show error message
            redirect('post');
        }

        // Check if form is submitted
        if ($this->input->post()) {
            // Form validation
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('content', 'Content', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                // If validation fails, reload edit form with errors
                $data['post'] = $post;
                $this->load->view('edit_post_view', $data);
            } else {
                // Validation successful, update post
                $data = array(
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                );
                $this->Post_model->update_post($id, $data);
                
                // Redirect to post index page
                redirect('post');
            }
        } else {
            // Load edit form with post data
            $data['post'] = $post;
            $this->load->view('edit_post_view', $data);
        }
    }

    public function delete($id) {
        // Load model
        $this->load->model('Post_model');

        // Check if post exists
        $post = $this->Post_model->get_post_by_id($id);
        if (!$post) {
            // If post not found, redirect to post index page or show error message
            redirect('post');
        }

        // Delete post
        $this->Post_model->delete_post($id);
        
        // Redirect to post index page
        redirect('post');
    }
}
