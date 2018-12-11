<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Scan extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load model Scan
        $this->load->model('scan_model');
        $this->load->helper('url');
    }


    public function index() {
        // Data untuk page index
        $data['scan']=$this->scan_model->read();

        // $data['scan'] = $this->scan_model->get()->result();

        $data['sumData']=$this->scan_model->sumData();

        $data['show_table']=$this->view_table();

        $this->load->view('scan/scanList', $data);


    }

    public function view_table() {
        $result=$this->scan_model->show_all_data();
        if ($result !=false) {
            return $result;
        }
        else {
            return 'Database is empty !';
        }
    }

    public function save() {

        // Mengatur validasi 
        $this->form_validation->set_rules('product_name', 'Product_Name', 'required');

        $this->form_validation->set_rules('long_desc', 'LongDesc', 'required');

        $this->form_validation->set_rules('range_desc', 'RangeDesc', 'required');

        $this->form_validation->set_rules('s_number', 'SN', 'required');

        $this->form_validation->set_rules('date', 'Date', 'required');

        $this->form_validation->set_rules('status', 'Status', 'required|in_list[OK,NG]');


        if ($this->form_validation->run()==FALSE) {
            $page_data['errors']=validation_errors();
            $this->load->view('scan/scanList');
        }
        else {
            $this->scan_model->save();
            redirect('scan', 'refresh');
        }
    }


    public function edit($id) {

        $data['s']=$this->scan_model->edit($id);

        $this->load->view('scan/scanEdit', $data);

    }


    public function update() {

        $input=new stdClass();
        $input->product_name=$this->input->post('product_name');
        $input->long_desc=$this->input->post('long_desc');
        $input->range_desc=$this->input->post('range_desc');
        $input->s_number=$this->input->post('s_number');
        $input->date=$this->input->post('date');
        $input->status=$this->input->post('status');
        $input->id=$this->input->post('id');
        $data['s']=$input;
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[OK,NG]');


        if ($this->form_validation->run()==FALSE) {
            $page_data['errors']=validation_errors();

            $this->load->view('scan/scanEdit', $data);
        }
        else {
            $arr['status']=$input->status;

            $this->scan_model->update($arr);

            redirect('scan', 'refresh');
        }
    }

    public function updateStatus($id, $status) {

        $this->scan_model->updateStatus($id, $status);

        redirect('scan', 'refresh');
    }


    public function delete($id) {
        $this->scan_model->delete($id);

        redirect('scan', 'refresh');
    }

    //export to excel format  
    public function export_excel() {

        $export=array('title'=> 'Report All Data',
        'scan'=> $this->scan_model->getAll(isset($export)));

        $this->load->view('v_report_excel', $export);
    }


    public function select_by_date_range() {
        $date1=$this->input->post('date_from');
        $date2=$this->input->post('date_to');
        $data=array('date1'=> $date1,
        'date2'=> $date2);
        if ($date1=="" || $date2=="" OR $date1 > $date2) {
            echo "<script>window.alert('Date format is incorrect !')</script>";
            redirect('scan', 'refresh');

            // $data['date_range_error_message'] = "Date fields are Error";
        }
        else {

            // $result = $this->scan_model->show_data_by_date_range($data);
            $title = "Report from $date1 to $date2";
            $rExcel=array('title'=> "Report from $date1 to $date2",
            'scan'=> $this->scan_model->show_data_by_date_range($data));

            $this->load->view('v_report_excel', $rExcel);

        }
        // $data['show_table'] = $this->view_table();
    }

}