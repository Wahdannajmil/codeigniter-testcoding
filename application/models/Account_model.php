<?php
class Account_model extends CI_Model {
    public function create_account($data) {
        $this->db->insert('account', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function get_accounts() {
        return $this->db->get('account')->result_array();
    }

    public function get_account_by_username($username) {
        return $this->db->get_where('account', array('username' => $username))->row_array();
    }

    public function update_account($username, $data) {
        $this->db->where('username', $username);
        $this->db->update('account', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function delete_account($username) {
        $this->db->where('username', $username);
        $this->db->delete('account');
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
