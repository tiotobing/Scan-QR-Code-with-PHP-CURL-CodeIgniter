<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // Load model Scan
        $this->load->model('scan_model');
        $this->load->helper('url');
    }

    public function index() {

        $scan=$this->input->get('scan');
        $scan=trim($scan); // to remove whitespace in input form

        if($scan) {
            $url=$this->getRedirectedUrl($scan);
            $result=$this->getResource($url);
            $this->generateResult($result);
        }

        $this->load->view('welcome_message');
        $this->load->helper('date');

        // DATA yg akan diambil
        // <h3 class="title">  </h3>									Desc Name
        // <div id="longDescription">   </div>							Long Desc
        // <td class="colRightCommonPartTable">  </td>					Range
        // <td class="colRightCommonPartTable"> </td>					S/N

    }

    // Fungsi CURL untuk mengambil data dari situs X
    function getResource($url) {
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result=curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function getRedirectedUrl($url) {
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_exec($ch);
        $target=curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);
        return $target ."?redirect=false";
    }


    public function generateResult($result) {
        //  Code untuk memotong content yang perlu diambil
        // Product Name

        $productCode="";
        $desc="";
        $range="";
        $sn="";

        $productName=explode('<h3 class="title">', $result);
        // mengambil bagian yang tidak di comment
        $cut=explode(" ", $productName[1]);
        // echo "Product : " . $cut[10] ;

        $productCode=$cut[10];

        // $endPN = explode('</h3>', $productName[1]);
        // $productCode = $endPN[0];
        // $productCode = strtoupper(str_replace('product: ', '', strtolower($endPN[0])));

        // Long Desc
        $longDesc=explode('<div id="longDescription">', $result);
        if(array_key_exists(1, $longDesc)) {
            $endLD=explode('</div>', $longDesc[1]);
            $desc=$endLD[0];

            // Range
            $range=explode('<td class="colRightCommonPartTable">', $result);
            $endRG=explode('</td>', $range[1]);
            $range=$endRG[0];

            // Serial Number
            $sn=explode('<td class="colRightCommonPartTable">', $result);
            $endSN=explode('</td>', $sn[2]);
            $sn=$endSN[0];

            // insert
            $data['product_name']=$productCode;
            $data['long_desc']=$desc;
            $data['range_desc']=$range;
            $data['s_number']=$sn;
            $date=date('Y-m-d H:i:s', time());
            $data['status']=null;

            $this->load->model('scan_model');
            $this->scan_model->insert($productCode, $desc, $range, $sn, $date);
        }
        else {

            echo "<script>window.alert('Data Not Found !')</script>";
        }

    }

}