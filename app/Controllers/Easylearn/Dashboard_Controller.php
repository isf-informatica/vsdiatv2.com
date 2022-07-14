<?php

namespace App\Controllers\Easylearn;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Libraries\Mfa_Library as Mfa_Library;
use App\Libraries\Aws_Library as Aws_Library;
use App\Models\Easylearn\Dashboard_Model as Dashboard_Model;

class Dashboard_Controller extends ResourceController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        $this->Mfa_Library = new Mfa_Library();
        $this->Aws_Library = new Aws_Library();
        $this->Dashboard_Model = new Dashboard_Model();
    }

    //Log Out
    public function logout_user()
    {
        $this->session->destroy();

        $array = array(
            'Response' => 'OK',
            'data'     => 'TRUE',
            'status'   => 200
        );
        echo json_encode($array);
    }

    //Generate QR
    public function generate_qr()
    {
        $qrcode = $this->Mfa_Library->generate_qr();
        $array = json_decode($qrcode, true);

        $data = $this->Dashboard_Model->store_qr($this->session->get('user')['id'], $array['secret']);

        if(!$data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'No Data',
                'status'   => 500,
            );
        }

        echo json_encode($array);
    }

    //verify Qr
    public function verify_qr()
    {
        $code = $_POST['code'];

        $secret = $this->Dashboard_Model->retrive_qr($this->session->get('user')['id']);

        if($secret)
        {
            $status = $this->Mfa_Library->validate_qr($code, $secret['secret']);
            
            if($status)
            {
                $status = $this->Dashboard_Model->update_account_status($this->session->get('user')['id']);
                $this->session->push('user', ['mfa_status'=> 1]);

                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500,
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'OTP does not match',
                    'status'   => 500,
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'No Data',
                'status'   => 500,
            );

        }
        echo json_encode($array);
    }

    //Get Profile Id
    public function profile_by_id()
    {
        $id = $_POST['id'];
        $data = $this->Dashboard_Model->profile_by_id($id);

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $data,
                'status'   => 200,
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => '0',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Update Profile
    public function update_profile()
    {
        $data = $this->request->getPost();

        if(isset($_FILES['image']))
        {
            $profile_image = $this->Aws_Library->aws_store($_FILES['image']);

            $profile = array(
                'profile_image'  => $profile_image,
                'contact_number' => $data['phone'],
                'description'    => $data['profile_description'],
                'layout_pref'    => $data['profile_layout'],
                'language_pref'  => $data['profile_language'],
            );

            $this->session->push('user', ['profile_image' => $profile_image]);
            $this->session->push('user', ['language_pref' => $data['profile_language']]);
            $this->session->push('user', ['layout_pref' => $data['profile_layout']]);
        }
        else
        {
            $profile = array(
                'description'    => $data['profile_description'],
                'contact_number' => $data['phone'],
                'layout_pref'    => $data['profile_layout'],
                'language_pref'  => $data['profile_language'],
            );

            $this->session->push('user', ['language_pref' => $data['profile_language']]);
            $this->session->push('user', ['layout_pref' => $data['profile_layout']]);
        }

        $result = $this->Dashboard_Model->update_profile($profile, $this->session->get('user')['id']);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200,
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 200,
            );
        }

        echo json_encode($array);
    }

    //Miro Whiteboard
    public function Check_Whiteboard()
    {
		$result = $this->Dashboard_Model->Check_Whiteboard($this->session->get('user')['id'], $this->session->get('user')['username']);

		echo json_encode($result);
	}

    public function upload()
    {
        $permissions = $this->session->get('user')['permissions'];
        $email       = $this->session->get('user')['email'];
        $uac_doc     = $this->Aws_Library->aws_store($_FILES['unifile']);
        $pl_doc      = $this->Aws_Library->aws_store($_FILES['principlefile']);

        if($permissions == 'School')
        {
            $result = $this->Dashboard_Model->updatedocument($email, $uac_doc, $pl_doc);
        }
        elseif ($permissions == 'Jr College') 
        {
            $result = $this->Dashboard_Model->update_jrclg_document($email, $uac_doc, $pl_doc);
        }

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else{
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    // Get Lecturer
    public function get_lecturer_name()
    {
        if(isset($_POST['permissions']))
        {
            $permissions = $_POST['permissions'];
            $reg_id      = $_POST['reg_id'];
        }
        else
        {
            $permissions = $this->session->get('user')['permissions'];
            $reg_id      = $this->session->get('user')['reg_id'];
        }
        if($permissions == 'Admin')
        {
            $data = $this->Dashboard_Model->get_alllecturer_name();
        }
        else
        {
            $data = $this->Dashboard_Model->get_lecturer_name_reg($reg_id);
        }
        
        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $data,
                'status'   => 200,
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => '0',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
}