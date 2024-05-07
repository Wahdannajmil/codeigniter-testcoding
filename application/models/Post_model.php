<?php
class Post_model extends CI_Model {
    public function create_post($data) {
        $this->db->insert('post', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function get_posts() {
        return $this->db->get('post')->result_array();
    }

    public function get_post_by_id($id) {
        return $this->db->get_where('post', array('idpost' => $id))->row_array();
    }

    public function update_post($id, $data) {
        $this->db->where('idpost', $id);
        $this->db->update('post', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function delete_post($id) {
        $this->db->where('idpost', $id);
        $this->db->delete('post');
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
