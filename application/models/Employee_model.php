<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data) {
        $this->db->insert('employees', $data);
    }

    public function insert_batch($data) {
        $this->db->insert_batch('employees', $data);
    }

    public function get_all() {
        $query = $this->db->get('employees');
        return $query->result_array();
    }
}
