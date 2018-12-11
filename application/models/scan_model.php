<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Scan_model extends CI_Model {

    public $table='t_scan';

    //constructor untuk class Report
    public function __construct() {
        //load constructor CI_Model
        parent::__construct();

        //load database
        $this->load->database();
        $this->load->helper('date');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    // get data * from table
    public function getAll() {
        $this->db->select('*');
        $this->db->from('t_scan');
        $this->db->order_by('date', 'DESC');
        $query=$this->db->get();
        return $query->result();
    }


    public function show_all_data() {
        $this->db->select('*');
        $this->db->from('t_scan');
        $this->db->order_by('date', 'DESC');
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else {
            return false;
        }
    }


    public function show_data_by_date_range($data) {
        // $condition = "date BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "'";
        $this->db->select('*');
        $this->db->from('t_scan');
        $this->db->where('date >=', $data['date1']);
        $this->db->where('date <=', $data['date2']);
        $this->db->order_by('date', 'DESC');
        $query=$this->db->get();
        return $query->result();

    }


    public function read() {
        $this->db->select('*');
        $this->db->from('t_scan');
        $this->db->order_by('date', 'DESC');
        $query=$this->db->get();
        return $query->result();
    }


    public function sumData() {
        return $this->db->count_all('t_scan');
    }


    public function edit($id) {
        return $this->db->get_where('t_scan', array('id'=> $id))->row();
        // $data = array(
        //   "product_name" => $this->input->post('product_name'),
        //   "long_desc" => $this->input->post('long_desc'),
        //   "range_desc" => $this->input->post('range_desc'),
        //   "s_number" => $this->input->post('s_number'),
        //   "date" => $this->input->post('date'),
        //   "status" => $this->input->post('status'),
        // );

        //   $this->db->where('id', $id);
        //   $this->db->update('t_scan', $data); // Untuk mengeksekusi perintah update data
    }


    // #######   INSERT   #########
    public function insert($productCode, $desc, $range, $sn, $date) {

        $check=$this->db->query("SELECT * FROM t_scan WHERE product_name='$productCode' and s_number='$sn' ");

        if($check->num_rows() > 0) {
            echo "<script>window.alert('Data already exists!')</script>";
        }
        else {
            $result=$this->db->query("INSERT INTO t_scan(product_name,long_desc,range_desc,s_number,date) VALUES ('$productCode','$desc','$range','$sn','$date')");
            echo "<script>window.alert('Product Name :  $productCode\\n\\Long Desc       : $desc\\n\\Range Desc     : $range\\n\\SN                   : $sn')</script>";
            // echo $productCode;   
            // echo $desc;   
            // echo $range;
            // echo $sn;
            // Product Name : $productCode $desc $range $sn
        }
        // Return hasil query
        // return $query;
    }

    // #######   UPDATE   #########
    public function update($data) {

        $this->db->where('id', $this->input->post('id'))->update('t_scan', $data);
        // var_dump($this->db->last_query());
        // exit;

    }

    public function updateStatus($id, $status) {
        $this->db->where('id', $id);
        $update=array("status"=> $status);
        $this->db->update('t_scan', $update);
        // $this->db->where('id',$this->input->post('id'))->update('t_scan',$id ,$status);

    }

    // #######   DELETE   #########
    public function delete($id) {
        // Jalankan query
        $query=$this->db ->where('id', $id) ->delete($this->table);

        // Return hasil query
        return $query;
    }
}