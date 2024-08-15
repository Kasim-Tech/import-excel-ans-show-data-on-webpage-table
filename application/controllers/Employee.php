<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;

class Employee extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('employee_model');
        $this->load->helper('url');
    }

    public function index() {
        $data['employees'] = $this->employee_model->get_all();
        $this->load->view('employee_form', $data);
    }

    public function submit() {
        if ($this->input->is_ajax_request()) {
            $data = $this->input->post();
            $this->employee_model->insert($data);

            // Fetch updated data
            $data['employees'] = $this->employee_model->get_all();
            
            // Load the table view and return it as HTML
            $html = $this->load->view('employee_table', $data, TRUE);
            echo json_encode(['html' => $html]);
        } else {
            show_404();
        }
    }

    public function import() {
        if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $file = $_FILES['file']['tmp_name'];
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            $data = [];
            foreach ($sheet as $row) {
                if ($row === reset($sheet)) continue; // Skip header row

                $data[] = [
                    'name' => $row['A'],
                    'email' => $row['B'],
                    'age' => $row['C'],
                    'phone' => $row['D'],
                    'gender' => $row['E'],
                    'salary' => $row['F'],
                    'designation' => $row['G'],
                    'job_location' => $row['H']
                ];
            }

            if (!empty($data)) {
                $this->employee_model->insert_batch($data);
                $data['employees'] = $this->employee_model->get_all();
                $html = $this->load->view('employee_table', $data, TRUE);
                echo json_encode(['html' => $html]);
            } else {
                echo json_encode(['error' => 'Error: No data to import.']);
            }
        } else {
            echo json_encode(['error' => 'Error: Failed to upload file.']);
        }
    }
}
