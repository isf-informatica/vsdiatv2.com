<?php

namespace App\Controllers\Easylearn;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Libraries\Aws_Library as Aws_Library;
use App\Models\Easylearn\Exam_Model as Exam_Model;

class Exam_Controller extends ResourceController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();

        $this->Aws_Library = new Aws_Library();
        $this->Exam_Model  = new Exam_Model();
    }

    //Add MCQ Exam
    public function add_mcq_exam()
    {
        $data = $this->request->getPost();

        if(($data['add_exam_token'] == $this->session->get('add_exam_token')) && $data['add_exam_token'] != NULL)
        {
            $array = array(
                'unique_id'         => date('YmdHis'),
                'classroom_id'      => $data['classroom_id'],
                'reg_id'			=> $this->session->get('user')['reg_id'],
                'course_id'         => $data['exam_course'],
                'exam_title'        => $data['exam_title'],
                'exam_category'     => $data['exam_category'],
                'exam_date'         => date("Y-m-d", strtotime($data['exam_date'])),
                'exam_start_time'   => date("H:i:s", strtotime($data['exam_start_time'])),
                'exam_end_time'     => date("H:i:s", strtotime($data['exam_end_time'])),
                'exam_right_mark'   => $data['exam_right_mark'],
                'exam_wrong_mark'   => $data['exam_wrong_mark'],
                'exam_duration'     => $data['exam_duration'],
                'show_result'       => $data['show_result'],
                'multiple_response' => $data['multiple_response'],
                'visibility'        => 0,
                'added_by'          => $this->session->get('user')['id'],
                'added_on'          => date('Y-m-d H:i:s'),
                'updated_by'        => $this->session->get('user')['id'],
                'is_del'            => 0
            );

            $data = $this->Exam_Model->add_mcq_exam($array);

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

    //Get All MCQ Exam
    public function get_all_exam()
    {
        if(isset($_POST['permissions']))
        {
            $permissions    = $_POST['permissions'];
            $reg_id         = $_POST['reg_id'];
            $classroom_id   = $_POST['classroom_id'];
        }
        else
        {
            $permissions    = $this->session->get('user')['permissions'];
            $reg_id         = $this->session->get('user')['reg_id'];
            $classroom_id   = $this->session->get('classroom_id');
        }

        if($permissions == 'Admin' || $permissions == 'SuperAdmin')
        {
            $data = $this->Exam_Model->get_all_exam();
        }
        elseif($permissions == 'School' || $permissions == 'Jr College')
        {
            $data = $this->Exam_Model->get_all_exam_reg($reg_id);
        }
        elseif($permissions == 'Classroom') 
        {
            $data = $this->Exam_Model->get_all_exam_classroom($classroom_id);
        }

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
                'data'     => 0,
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Show hide MCQ Exam
    public function show_hide_exam()
    {
        $id         = $_POST['id'];
        $visibility = $_POST['visibility'];

        $array = array(
            'visibility' => $visibility,
            'updated_by' => $this->session->get('user')['id']
        );

        $data = $this->Exam_Model->show_hide_exam($array, $id);

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

    //Exam detail Id
    public function exam_detail_id()
    {
        $id = $_POST['id'];
        $data = $this->Exam_Model->exam_detail_id($id);

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
                'data'     => 'No Data',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Edit MCQ Question
    public function edit_mcq_exam()
    {
        $data = $this->request->getPost();

        if(($data['edit_exam_token'] == $this->session->get('edit_exam_token')) && $data['edit_exam_token'] != NULL)
        {
            $array = array(
                'course_id'         => $data['edit_exam_course'],
                'exam_title'        => $data['edit_exam_title'],
                'classroom_id'      => $data['edit_classroom_id'],
                'exam_category'     => $data['edit_exam_category'],
                'exam_date'         => date("Y-m-d", strtotime($data['edit_exam_date'])),
                'exam_start_time'   => date("H:i:s", strtotime($data['edit_exam_start_time'])),
                'exam_end_time'     => date("H:i:s", strtotime($data['edit_exam_end_time'])),
                'exam_right_mark'   => $data['edit_exam_right_mark'],
                'exam_wrong_mark'   => $data['edit_exam_wrong_mark'],
                'exam_duration'     => $data['edit_exam_duration'],
                'show_result'       => $data['show_result'],
                'multiple_response' => $data['multiple_response'],
                'updated_by'        => $this->session->get('user')['id']
            );

            $data = $this->Exam_Model->edit_mcq_exam($array, $data['id']);

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

    //Delete MCQ Question
    public function delete_mcq_exam()
    {
        $id = $_POST['id'];
        $array = array(
            'is_del' => 1,
            'updated_by' => $this->session->get('user')['id']
        );

        $data = $this->Exam_Model->delete_mcq_exam($id,$array);

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


}
?>