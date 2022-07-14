<?php

namespace App\Controllers\Easylearn;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Libraries\Aws_Library as Aws_Library;
use App\Models\Easylearn\Settings_Model as Settings_Model;

class Settings_Controller extends ResourceController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();

        $this->Aws_Library = new Aws_Library();
        $this->Settings_Model = new Settings_Model();
    }

    //About us
    public function aboutus_getdata()
    {
        $data = $this->Settings_Model->aboutus_getdata();

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $data,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'No Data Found',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Testimonials
    public function testimonials_getdata()
    {
        $data = $this->Settings_Model->testimonials_getdata();

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $data,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'No Data Found',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Project Documents
    public function project_documents_getdata()
    {
        $data = $this->Settings_Model->project_documents_getdata();

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $data,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'No Data Found',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Product Features
    public function product_features_getdata()
    {
        $data = $this->Settings_Model->product_features_getdata();

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $data,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'No Data Found',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //ISF Services
    public function isf_services_getdata()
    {
        $data = $this->Settings_Model->isf_services_getdata();

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $data,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'No Data Found',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Team
    public function team_getdata()
    {
        $data = $this->Settings_Model->team_getdata();

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $data,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'No Data Found',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Customer Benefits
    public function customer_benefits_getdata()
    {
        $data = $this->Settings_Model->customer_benefits_getdata();

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $data,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'No Data Found',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Get Setting by Name
    public function get_settings_name(){

        $result = $this->Settings_Model->get_settings_name($_POST['name']);
    
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'False',
                'status'   => 500
            );
        }
    
        echo json_encode($array);
    }
}
