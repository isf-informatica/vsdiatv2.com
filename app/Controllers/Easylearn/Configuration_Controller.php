<?php

namespace App\Controllers\Easylearn;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\Aws_Library as Aws_Library;
use App\Models\Easylearn\Configuration_Model as Configuration_Model;

class Configuration_Controller extends ResourceController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        $this->Aws_Library = new Aws_Library();
        $this->Configuration_Model = new Configuration_Model();
    }

    //Get Security By Name
    public function get_security_name(){

        $name = $_POST['name'];
        $result = $this->Configuration_Model->get_security_name($name);
    
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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Get All Settings Category
    public function get_settings_category()
    {
        $result = $this->Configuration_Model->get_settings_category();
    
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

    //Add Setting Form
    public function manage_setting_form()
    {
        $data = $this->request->getPost();
        
        if(($data['manage_settings_form_token'] == $this->session->get('manage_settings_form_token')) && $data['manage_settings_form_token'] != NULL)
        {
        
            $setting_data = array(
                'unique_id'            => date("YmdHis"),
                'category_name'        => $data['setting_name'],
                'description'          => $data['setting_descp'],
                'added_by'             => $this->session->get('user')['id'],
                'updated_by'           => $this->session->get('user')['id'],
                'is_del'               => 0
            );

            $result = $this->Configuration_Model->manage_setting_form($setting_data);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Get Setting By ID
    public function get_setting_category_by_id()
    {
        $id = $_POST['id'];
        $result = $this->Configuration_Model->get_setting_category_by_id($id);
    
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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    
    }
    
    //Edit setting Form
    public function edit_setting_category()
    {
        $data = $this->request->getPost();
    
        if(($data['edit_setting_form_token'] == $this->session->get('edit_setting_form_token')) && $data['edit_setting_form_token'] != NULL)
        {
            $setting_data = array(
                'category_name'        => $data['setting_name'],
                'description'          => $data['setting_descp'],
                'updated_by'           => $this->session->get('user')['id'],
            );
            
            $result = $this->Configuration_Model->edit_setting_category($setting_data, $data['uid']);
    
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        
            echo json_encode($array);
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
            echo json_encode($array);
        }
    
    }
    
    //Delete Setting Catgoey
    public function delete_setting_category()
    {
        $result = $this->Configuration_Model->delete_setting_category($_POST['id']);
    
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Add Setting Value
    public function add_setting_value()
    {
        $data = $this->request->getPost();
        
        if(($data['manage_settings_value_form_token'] == $this->session->get('manage_settings_value_form_token')) && $data['manage_settings_value_form_token'] != NULL)
        {
        
            $setting_data = array(
                'unique_id'            => date("YmdHis"),
                'category_id'          => 0,
                'value'                => ucfirst($data['setting_value']),
                'purpose'              => $data['setting_purpose'],
                'added_by'             => $this->session->get('user')['id'],
                'updated_by'           => $this->session->get('user')['id'],
                'is_del'               => 0
            );

            $result = $this->Configuration_Model->add_setting_value($setting_data, $data['setting_id']);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Get All Settings Category
    public function get_settings()
    {
        $result = $this->Configuration_Model->get_settings();
    
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
    
    //Get Setting By ID
    public function get_setting_by_id()
    {
        $id = $_POST['id'];
        $result = $this->Configuration_Model->get_setting_by_id($id);
    
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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Delete Setting
    public function delete_setting()
    {
        $result = $this->Configuration_Model->delete_setting($_POST['id']);
    
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }  
    
    //Edit setting Form
    public function edit_setting_value()
    {
        $data = $this->request->getPost();
    
        if(($data['edit_setting_value_form_token'] == $this->session->get('edit_setting_value_form_token')) && $data['edit_setting_value_form_token'] != NULL)
        {
            $setting_data = array(
                'category_id'        => 0,
                'value'              => $data['setting_value'],
                'purpose'            => $data['setting_purpose'],
                'updated_by'         => $this->session->get('user')['id'],
            );
            
            $result = $this->Configuration_Model->edit_setting_value($setting_data, $data['uid'], $data['setting_id']);
    
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Get Setting by Name
    public function get_settings_name()
    {
        $result = $this->Configuration_Model->get_settings_name($_POST['name']);
    
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

    //Add Security Form
    public function manage_security_form()
    {
        $data = $this->request->getPost();
        
        if($data['manage_security_form_token'] == $this->session->get('manage_security_form_token'))
        {
            $security_data = array(
                'unique_id'            => date("YmdHis"),
                'security_name'        => $data['security_name'],
                'status'               => 0,
                'security_description' => $data['security_descp'],
                'added_by'             => $this->session->get('user')['id'],
                'updated_by'           => $this->session->get('user')['id'],
                'is_del'               => 0
            );

            $result = $this->Configuration_Model->manage_security_form($security_data);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Get All Security
    public function get_security()
    {
        $result = $this->Configuration_Model->get_security();
    
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
    
    //Security Change Status
    public function security_status()
    {
        $id     = $_POST['id'];
        $status = $_POST['status'];

        $array = array(
            'status'     => $status,
            'updated_by' => $this->session->get('user')['id']
        );

        $data = $this->Configuration_Model->security_status($array, $id);

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Get Security By ID
    public function get_security_by_id()
    {
        $id = $_POST['id'];
        $result = $this->Configuration_Model->get_security_by_id($id);
    
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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }
    
    //Edit security Form
    public function edit_security_form()
    {
        $data = $this->request->getPost();
    
        if(($data['edit_security_form_token'] == $this->session->get('edit_security_form_token')) && $data['edit_security_form_token'] != NULL)
        {
            $security_data = array(
                'security_name'        => $data['security_name'],
                'security_description' => $data['security_descp'],
                'updated_by'           => $this->session->get('user')['id'],
            );
            
            $result = $this->Configuration_Model->edit_security_form($security_data, $data['uid']);
    
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Delete Security
    public function delete_security()
    {
        $result = $this->Configuration_Model->delete_security($_POST['id']);
    
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Add Slider
    public function manage_slider_form()
    {
        $data = $this->request->getPost();
        
        if($data['manage_slider_form_token'] == $this->session->get('manage_slider_form_token'))
        {
        
            $slider_data = array(
                'unique_id'=> date("YmdHis")+1,
                'slider_type' => $data['slider_type'],
                'slider_video'  => $data['slider_video'],
                'added_by'=> $this->session->get('user')['id'],
                'updated_by'=> $this->session->get('user')['id'] 
            );
        
            if(isset($_FILES['slider_image']))
            {
                $slider_data['slider_image'] =  $this->Aws_Library->aws_store($_FILES['slider_image']);
            }
        
            $result = $this->Configuration_Model->manage_slider_form($slider_data);
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Get Slider
    public function get_slider()
    {
        $result = $this->Configuration_Model->get_slider();
    
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
    
    //Get Slider by ID
    public function get_slider_by_id()
    {
        $id = $_POST['id'];
        $result = $this->Configuration_Model->get_slider_by_id($id);
    
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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }
    
    //Edit Slider
    public function edit_slider_form()
    {
        $data = $this->request->getPost();
    
        if(($data['edit_slider_form_token'] == $this->session->get('edit_slider_form_token')) && $data['edit_slider_form_token'] != NULL)
        {
            $slider_data = array(
                'slider_type' => $data['slider_type'],
                'slider_video'  => $data['slider_video'],
                'updated_by' => $this->session->get('user')['id'],
                'is_del' => 0
            );
    
            if(isset($_FILES['slider_image']))
            {
                $slider_data['slider_image'] =  $this->Aws_Library->aws_store($_FILES['slider_image']);
            }
            
            $result = $this->Configuration_Model->edit_slider_form($slider_data,$data['uid']);
    
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Delete Slider
    public function delete_slider()
    {
        $result = $this->Configuration_Model->delete_slider($_POST['id']);
    
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Add About Us
    public function manage_aboutus_form()
    {
        $data = $this->request->getPost();

        if($data['manage_aboutus_form_token'] == $this->session->get('manage_aboutus_form_token'))
        {
            $aboutus_data = array(
                'unique_id'            => date("YmdHis"),
                'heading'              => $data['heading'],
                'vision'               => $data['vision'],          
                'mission'              => $data['mission'],                   
                'value_s'              => $data['value_s'],              
                'aboutus_description1' => $data['aboutus_description1'],
                'aboutus_description2' => $data['aboutus_description2'], 
                'demovideo_path'       => $data['demovideo_path'],
                'added_by'             => $this->session->get('user')['id'],
                'updated_by'           => $this->session->get('user')['id'] 
            );

            if(isset($_FILES['vision_image']))
            {
                $aboutus_data['vision_image'] =  $this->Aws_Library->aws_store($_FILES['vision_image']);
            }

            if(isset($_FILES['mission_image']))
            {
                $aboutus_data['mission_image'] =  $this->Aws_Library->aws_store($_FILES['mission_image']);
            }

            if(isset($_FILES['values_image']))
            {
                $aboutus_data['values_image'] =  $this->Aws_Library->aws_store($_FILES['values_image']);
            }
            
            $result = $this->Configuration_Model->manage_aboutus_form($aboutus_data);
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Get About Us
    public function get_about_us()
    {
        $result = $this->Configuration_Model->get_about_us();

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
                'data'     => $result,
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Add Features
    public function manage_features_form()
    {
        $data = $this->request->getPost();
        
        if($data['manage_features_form_token'] == $this->session->get('manage_features_form_token'))
        {
            $features_data = array(
                'unique_id'           => date("YmdHis"),
                'feature'             => $data['feature'],
                'feature_description' => $data['feature_description'],
                'added_by'            => $this->session->get('user')['id'],
                'updated_by'          => $this->session->get('user')['id'] 
            );
        
            if(isset($_FILES['feature_image']))
            {
                $features_data['feature_image'] =  $this->Aws_Library->aws_store($_FILES['feature_image']);
            }
        
            $result = $this->Configuration_Model->manage_features_form($features_data);
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Get Featurs
    public function get_features()
    {
        $result = $this->Configuration_Model->get_features();
    
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
    
    //Get Features by ID
    public function get_features_by_id()
    {
        $id = $_POST['id'];
        $result = $this->Configuration_Model->get_features_by_id($id);
    
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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Edit Features
    public function edit_features_form()
    {
        $data = $this->request->getPost();
    
        if(($data['edit_features_form_token'] == $this->session->get('edit_features_form_token')) && $data['edit_features_form_token'] != NULL)
        {
            $features_data = array(
                'feature'             => $data['feature'],
                'feature_description' => $data['feature_description'],
                'updated_by'          => $this->session->get('user')['id'],
                'is_del'              => 0
            );
    
            if(isset($_FILES['feature_image']))
            {
                $features_data['feature_image'] =  $this->Aws_Library->aws_store($_FILES['feature_image']);
            }
            
            $result = $this->Configuration_Model->edit_features_form($features_data,$data['uid']);
    
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Delete Features
    public function delete_features()
    {
        // $data = $this->request->getPost();
        $result = $this->Configuration_Model->delete_features($_POST['id']);
    
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Add benefits
    public function manage_benefits_form()
    {
        $data = $this->request->getPost();
        
        if($data['manage_benefits_form_token'] == $this->session->get('manage_benefits_form_token'))
        {
            $benefits_data = array(
                  
                'unique_id'           => date("YmdHis"),
                'benefit'             => $data['benefit'],
                'benefit_description' => $data['benefit_description'],
                'added_by'            => $this->session->get('user')['id'],
                'updated_by'          => $this->session->get('user')['id'] 
            );
        
            $result = $this->Configuration_Model->manage_benefits_form($benefits_data);
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    
    }
    
    //get All benefits
    public function get_benefits()
    {
        $result = $this->Configuration_Model->get_benefits();
    
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
    
    //Get Benefits by ID
    public function get_benefits_by_id()
    {
        $id = $_POST['id'];
        $result = $this->Configuration_Model->get_benefits_by_id($id);
    
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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Edit Benefits by ID
    public function edit_benefits_form()
    {
        $data = $this->request->getPost();
    
        if(($data['edit_benefits_form_token'] == $this->session->get('edit_benefits_form_token')) && $data['edit_benefits_form_token'] != NULL)
        {
            $benefits_data = array(
                'benefit' => $data['benefit'],
                'benefit_description'  => $data['benefit_description'],
                'updated_by' => $this->session->get('user')['id'],
                'is_del' => 0
            );
            
            $result = $this->Configuration_Model->edit_benefits_form($benefits_data,$data['uid']);
    
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //delete Benefits
    public function delete_benefits()
    {
        $result = $this->Configuration_Model->delete_benefits($_POST['id']);
    
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Add Service
    public function manage_services_form()
    {

        $data = $this->request->getPost();
        
        if($data['manage_services_form_token'] == $this->session->get('manage_services_form_token'))
        {
        
            $services_data = array(
                  
                'unique_id'           => date("YmdHis")+1,
                'service'             => $data['service'],
                'service_description' => $data['service_description'],
                'added_by'            => $this->session->get('user')['id'],
                'updated_by'          => $this->session->get('user')['id'] 
            );
        
            if(isset($_FILES['service_image']))
            {
                $services_data['service_image'] =  $this->Aws_Library->aws_store($_FILES['service_image']);
            }

            $result = $this->Configuration_Model->manage_services_form($services_data);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //get All Service
    public function get_services()
    {
        $result = $this->Configuration_Model->get_services();
    
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
    
    //get Service by id
    public function get_services_by_id()
    {
        $id = $_POST['id'];
        $result = $this->Configuration_Model->get_services_by_id($id);
    
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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //edit Service
    public function edit_services_form()
    {
        $data = $this->request->getPost();
    
        if(($data['edit_services_form_token'] == $this->session->get('edit_services_form_token')) && $data['edit_services_form_token'] != NULL)
        {
            $services_data = array(
                'service' => $data['service'],
                'service_description'  => $data['service_description'],
                'updated_by' => $this->session->get('user')['id'],
                'is_del' => 0
            );
    
            if(isset($_FILES['service_image']))
            {
                $services_data['service_image'] =  $this->Aws_Library->aws_store($_FILES['service_image']);
            }
            
            $result = $this->Configuration_Model->edit_services_form($services_data,$data['uid']);
    
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Delete Service
    public function delete_services()
    {
        // $data = $this->request->getPost();
        $result = $this->Configuration_Model->delete_services($_POST['id']);
    
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Add Team
    public function manage_team_form()
    {
        $data = $this->request->getPost();
        
        if($data['manage_team_form_token'] == $this->session->get('manage_team_form_token'))
        {
            $team_data = array(
                'unique_id'    => date("YmdHis"),
                'name'         => $data['name'],
                'job_role'     => $data['job_role'],          
                'about'        => $data['about'],                   
                'facebook'     => $data['facebook'],              
                'twitter'      => $data['twitter'],
                'instagram'    => $data['instagram'], 
                'linkedin'     => $data['linkedin'],
                'email_id'     => $data['email_id'],
                'telephone_1'  => $data['telephone_1'],
                'telephone_2'  => $data['telephone_2'],
                'type'         => $data['type'],
                'added_by'     => $this->session->get('user')['id'],
                'updated_by'   => $this->session->get('user')['id'] 
            );
        
            if(isset($_FILES['image_path']))
            {
                $team_data['image_path'] =  $this->Aws_Library->aws_store($_FILES['image_path']);
            }
            $result = $this->Configuration_Model->manage_team_form($team_data);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Get All Team
    public function get_team()
    {
        $result = $this->Configuration_Model->get_team();

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

    //Get Team by ID
    public function get_team_by_id()
    {
        $id = $_POST['id'];
        $result = $this->Configuration_Model->get_team_by_id($id);

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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Edit Team
    public function edit_team_form()
    {
        $data = $this->request->getPost();

        if(($data['edit_team_form_token'] == $this->session->get('edit_team_form_token')) && $data['edit_team_form_token'] != NULL)
        {
            $team_data = array(
                'name'         => $data['name'],
                'job_role'     => $data['job_role'],          
                'about'        => $data['about'],                   
                'facebook'     => $data['facebook'],              
                'twitter'      => $data['twitter'],
                'instagram'    => $data['instagram'], 
                'linkedin'     => $data['linkedin'],
                'email_id'     => $data['email_id'],
                'telephone_1'  => $data['telephone_1'],
                'telephone_2'  => $data['telephone_2'],
                'type'         => $data['type'],
                'updated_by'   => $this->session->get('user')['id'],
                'is_del'       => 0
            );

            if(isset($_FILES['image_path']))
            {
                $team_data['image_path'] =  $this->Aws_Library->aws_store($_FILES['image_path']);
            }
            $result = $this->Configuration_Model->edit_team_form($team_data,$data['uid']);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Delete Team
    public function delete_team()
    {
        $result = $this->Configuration_Model->delete_team($_POST['id']);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //add NewsFeed
    public function manage_newsfeed_form()
    {
        $data = $this->request->getPost();
        
        if($data['manage_newsfeed_form_token'] == $this->session->get('manage_newsfeed_form_token'))
        {
            $newsfeed_data = array(
                'unique_id'=> date("YmdHis")+1,
                'newsfeed_headline' => $data['newsfeed_headline'],
                'newsfeed_rsslink'  => $data['newsfeed_link'],
                'added_by'=> $this->session->get('user')['id'],
                'updated_by'=> $this->session->get('user')['id'] 
            );
        
            $result = $this->Configuration_Model->manage_newsfeed_form($newsfeed_data);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Get All NewsFeed
    public function get_newsfeed()
    {
        $result = $this->Configuration_Model->get_newsfeed();
    
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
    
    //Get NewsFeed by ID
    public function get_newsfeed_by_id()
    {
        $id = $_POST['id'];
        $result = $this->Configuration_Model->get_newsfeed_by_id($id);
    
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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Edit NewsFeed
    public function edit_newsfeed_form()
    {
        $data = $this->request->getPost();
    
        if(($data['edit_newsfeed_form_token'] == $this->session->get('edit_newsfeed_form_token')) && $data['edit_newsfeed_form_token'] != NULL)
        {
            $newsfeed_data = array(
                'newsfeed_headline' => $data['newsfeed_headline'],
                'newsfeed_rsslink'  => $data['newsfeed_link'],
                'updated_by' => $this->session->get('user')['id'],
                'is_del' => 0
            );
            
            $result = $this->Configuration_Model->edit_newsfeed_form($newsfeed_data,$data['uid']);
    
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Delete NewsFeed
    public function delete_newsfeed()
    {
        $result = $this->Configuration_Model->delete_newsfeed($_POST['id']);
    
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Manage Testimonial
    public function manage_testimonial_form()
    {
        $data = $this->request->getPost();
        
        if($data['manage_testimonial_form_token'] == $this->session->get('manage_testimonial_form_token'))
        {
            $testimonial_data = array(
                  
                'unique_id'                  => date("YmdHis"),
                'testimonial_name'           => $data['name'],
                'testimonial_jobrole'        => $data['job_role'],          
                'testimonial_description'    => $data['description'],  
                'testimonial_companywebsite' => $data['companywebsite'],
                'added_by'                   => $this->session->get('user')['id'],
                'updated_by'                 => $this->session->get('user')['id'] 
            );
        
            if(isset($_FILES['image_path']))
            {
                $testimonial_data['testimonial_image'] =  $this->Aws_Library->aws_store($_FILES['image_path']);
            }
        
            $result = $this->Configuration_Model->manage_testimonial_form($testimonial_data);
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //get All testimonial
    public function get_testimonial()
    {
        $result = $this->Configuration_Model->get_testimonial();
    
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
    
    //Get Testimonial by ID
    public function get_testimonial_by_id()
    {
        $id = $_POST['id'];
        $result = $this->Configuration_Model->get_testimonial_by_id($id);
    
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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Edit Testimonial
    public function edit_testimonial_form()
    {
        $data = $this->request->getPost();
    
        if(($data['edit_testimonial_form_token'] == $this->session->get('edit_testimonial_form_token')) && $data['edit_testimonial_form_token'] != NULL)
        {
            $testimonial_data = array(
                'testimonial_name'           => $data['name'],
                'testimonial_jobrole'        => $data['job_role'],          
                'testimonial_description'    => $data['description'], 
                'testimonial_companywebsite' => $data['companywebsite'],
                'updated_by'                 => $this->session->get('user')['id'],
                'is_del'                     => 0
            );
    
            if(isset($_FILES['image_path']))
            {
                $testimonial_data['testimonial_image'] =  $this->Aws_Library->aws_store($_FILES['image_path']);
            }
            
            $result = $this->Configuration_Model->edit_testimonial_form($testimonial_data,$data['uid']);
    
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Delete testimonial
    public function delete_testimonial()
    {
        // $data = $this->request->getPost();
        $result = $this->Configuration_Model->delete_testimonial($_POST['id']);
    
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Add Document
    public function manage_document_form()
    {
        $data = $this->request->getPost();
        
        if($data['manage_document_form_token'] == $this->session->get('manage_document_form_token'))
        {
            $document_data = array(
                'unique_id'     => date("YmdHis"),
                'document_name' => $data['document_name'],
                'document_link' => $data['document_link'],
                'added_by'      => $this->session->get('user')['id'],
                'updated_by'    => $this->session->get('user')['id'] 
            );
        
            if(isset($_FILES['document_image']))
            {
                $document_data['document_image'] =  $this->Aws_Library->aws_store($_FILES['document_image']);
            }
            $result = $this->Configuration_Model->manage_document_form($document_data);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //get All Document
    public function get_document()
    {
        $result = $this->Configuration_Model->get_document();
    
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
                'data'     => $result,
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Get Document by ID
    public function get_document_by_id()
    {
        $id = $_POST['id'];
        $result = $this->Configuration_Model->get_document_by_id($id);
    
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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Edit Document
    public function edit_document_form()
    {
        $data = $this->request->getPost();
    
        if(($data['edit_document_form_token'] == $this->session->get('edit_document_form_token')) && $data['edit_document_form_token'] != NULL)
        {
            $document_data = array(
                'document_name' => $data['document_name'],
                'document_link' => $data['document_link'],
                'updated_by'    => $this->session->get('user')['id'],
                'is_del'        => 0
            );
    
            if(isset($_FILES['document_image']))
            {
                $document_data['document_image'] =  $this->Aws_Library->aws_store($_FILES['document_image']);
            }
            
            $result = $this->Configuration_Model->edit_document_form($document_data,$data['uid']);
    
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Delete Document
    public function delete_document()
    {
        $result = $this->Configuration_Model->delete_document($_POST['id']);
    
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
}