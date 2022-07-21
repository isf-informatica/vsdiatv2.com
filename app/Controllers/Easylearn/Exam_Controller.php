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
           

            if(isset($_SESSION['classroom_id']))
            {
                $classroom_id   = $this->session->get('classroom_id');
            }
            else
            {
                $classroom_id = 0;
            }
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

    //get MCQ Exam question
    public function mcq_exam_question()
    {
        $id = $_POST['id'];
        $data = $this->Exam_Model->mcq_exam_question($id);

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

    //Get MCQ Question by ID
    public function get_question_by_id()
    {
        $id = $_POST['id'];
        $data = $this->Exam_Model->get_question_by_id($id);

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

    //Add Mcq Question
    public function add_mcq_question()
    {
        $data = $this->request->getPost();

        if(($data['add_question_token'] == $this->session->get('add_question_token')) && $data['add_question_token'] != NULL)
        {
            if(isset($_FILES['question_image']))
            {
                $question_image = $this->Aws_Library->aws_store($_FILES['question_image']);
            }
            else
            {
                $question_image = '';
            }

            $array = array(
                'exam_id'           => 0,
                'question_title'    => $data['question_title'],
                'question_image'    => $question_image,
                'option_1'          => $data['add_option_1'],
                'option_2'          => $data['add_option_2'],
                'option_3'          => $data['add_option_3'],
                'option_4'          => $data['add_option_4'],
                'option_5'          => $data['add_option_5'],
                'option_6'          => $data['add_option_6'],
                'option_7'          => $data['add_option_7'],
                'option_8'          => $data['add_option_8'],
                'option_9'          => $data['add_option_9'],
                'option_10'         => $data['add_option_10'],
                'answer_option'     => $data['add_answer_option'],
                'added_on'          => date('Y-m-d H:i:s'),
                'added_by'          => $this->session->get('user')['id'],
                'updated_by'        => $this->session->get('user')['id'],
                'is_del'            => 0
            );

            $result = $this->Exam_Model->add_mcq_question($array, $data['unique_id']);

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
                'data'     => 'Cross Site Request Blocked',
                'status'   => 500
            );

            echo json_encode($array);
        }
    }

    //Edit MCQ Question
    public function edit_mcq_question()
    {
        $data = $this->request->getPost();

        if(($data['edit_question_token'] == $this->session->get('edit_question_token')) && $data['edit_question_token'] != NULL)
        {
            if(isset($_FILES['edit_question_image']))
            {
                $question_image = $this->Aws_Library->aws_store($_FILES['edit_question_image']);

                $array = array(
                    'question_title'    => $data['edit_question_title'],
                    'question_image'    => $question_image,
                    'option_1'          => $data['edit_option_1'],
                    'option_2'          => $data['edit_option_2'],
                    'option_3'          => $data['edit_option_3'],
                    'option_4'          => $data['edit_option_4'],
                    'option_5'          => $data['edit_option_5'],
                    'option_6'          => $data['edit_option_6'],
                    'option_7'          => $data['edit_option_7'],
                    'option_8'          => $data['edit_option_8'],
                    'option_9'          => $data['edit_option_9'],
                    'option_10'         => $data['edit_option_10'],
                    'answer_option'     => $data['edit_answer_option'],
                    'updated_by'        => $this->session->get('user')['id']
                );
            }
            else
            {
                $array = array(
                    'question_title'    => $data['edit_question_title'],
                    'option_1'          => $data['edit_option_1'],
                    'option_2'          => $data['edit_option_2'],
                    'option_3'          => $data['edit_option_3'],
                    'option_4'          => $data['edit_option_4'],
                    'option_5'          => $data['edit_option_5'],
                    'option_6'          => $data['edit_option_6'],
                    'option_7'          => $data['edit_option_7'],
                    'option_8'          => $data['edit_option_8'],
                    'option_9'          => $data['edit_option_9'],
                    'option_10'         => $data['edit_option_10'],
                    'answer_option'     => $data['edit_answer_option'],
                    'updated_by'        => $this->session->get('user')['id']                 
                );
            }

            $result = $this->Exam_Model->edit_mcq_question($array, $data['id']);

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
                'data'     => 'Cross Site Request Blocked',
                'status'   => 500
            );

            echo json_encode($array);
        }
    }

    //Delete MCQ Questions
    public function delete_mcq_question()
    {
        $id = $_POST['id'];
        $array = array(
            'is_del' => 1,
            'updated_by' => $this->session->get('user')['id']
        );
        $data = $this->Exam_Model->delete_mcq_question($id,$array);

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

    //Get All sentence exam
    public function sent_exam_question(){

        $id = $_POST['id'];
        $data = $this->Exam_Model->sent_exam_question($id);

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

    // Add Sentence Exam
    public function add_sentence_question(){
        $data = $this->request->getPost();

        if(($data['add_sentence_token'] == $this->session->get('add_sentence_token')) && $data['add_sentence_token'] != NULL)
        {
            if(isset($_FILES['question_image']))
            {
                $question_image = $this->Aws_Library->aws_store($_FILES['question_image']);
            }
            else
            {
                $question_image = '';
            }

            $question = array(
                'exam_id' => $data['exam_id'],
                'question_title' => $data['sent_question'],
                'question_image' => $question_image,
                'option_1' => $data['opt1'],
                'option_2' => $data['opt2'],
                'option_3' => $data['opt3'],
                'option_4' => $data['opt4'],
                'option_5' => $data['opt5'],
                'added_by' => $this->session->get('user')['id'],
                'updated_by' => $this->session->get('user')['id'],
                'is_del' => 0 
            );
            $result = $this->Exam_Model->add_sentence_question($question);
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
        else{
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked',
                'status'   => 500
            );

            echo json_encode($array);
        }
    }

    // get sent question by id 
    public function exam_sent_quest_id(){
        $id = $_POST['id'];
        $data = $this->Exam_Model->exam_sent_quest_id($id);

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

    // Update Sentence Exam
    public function edit_sentence_question(){
        $data = $this->request->getPost();

        if(($data['edit_sentence_token'] == $this->session->get('edit_sentence_token')) && $data['edit_sentence_token'] != NULL)
        {
            if(isset($_FILES['edit_question_image']))
            {
                $question_image = $this->Aws_Library->aws_store($_FILES['edit_question_image']);

                $question = array(
                    'question_title' => $data['sent_question'],
                    'question_image' => $question_image,
                    'option_1'       => $data['opt1'],
                    'option_2'       => $data['opt2'],
                    'option_3'       => $data['opt3'],
                    'option_4'       => $data['opt4'],
                    'option_5'       => $data['opt5'],
                    'updated_by'     => $this->session->get('user')['id'],
                    'is_del'        => 0 
                );
            }
            else
            {
                $question = array(
                    'question_title' => $data['sent_question'],
                    'option_1'       => $data['opt1'],
                    'option_2'       => $data['opt2'],
                    'option_3'       => $data['opt3'],
                    'option_4'       => $data['opt4'],
                    'option_5'       => $data['opt5'],
                    'updated_by'     => $this->session->get('user')['id'],
                    'is_del'        => 0 
                );
            }

            $result = $this->Exam_Model->edit_sentence_question($question,$data['question_id']);
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
        else{
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked',
                'status'   => 500
            );

            echo json_encode($array);
        }
    }

    //delete sent quetsion 
    public function delete_sent_question(){
        $id = $_POST['id'];
        $array = array(
            'is_del' => 1,
            'updated_by' => $this->session->get('user')['id']
        );
        $data = $this->Exam_Model->delete_sent_question($id,$array);

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

    //Get All Exam Result
    public function get_all_exam_result()
    {
        $unique_id   = $_POST['unique_id'];
        $data = $this->Exam_Model->get_all_exam_result($unique_id);

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
                'data'     => 'False',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Exam Details ID
    public function exam_detail_id_student()
    {
        $id          = $_POST['id'];
        $permissions = $_POST['permissions'];

        if($permissions == 'Student')
        {
            $data = $this->Exam_Model->exam_detail_id_student($id);
        }
        else
        {
            $data = $this->Exam_Model->exam_detail_id_mentor($id);
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
                'data'     => 'No Data',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Sentence Exam Overview Student
    public function sentence_exam_overview_student()
    {
        $id = $_POST['id'];
        $exam_id = $_POST['exam_id'];

        $data = $this->Exam_Model->sentence_exam_overview_student($id, $exam_id);

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

    //Sentence Exam Student Question Answer
    public function sentence_exam_question_answer()
    {
        $id = $_POST['id'];
        $exam_id = $_POST['exam_id'];

        $data = $this->Exam_Model->sentence_exam_question_answer($id, $exam_id);

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

    //Exam Overview Student
    public function exam_overview_student()
    {
        $id = $_POST['id'];
        $exam_id = $_POST['exam_id'];

        $data = $this->Exam_Model->exam_overview_student($id, $exam_id);

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

    //Exam Student Question Answer
    public function mcq_exam_question_answer()
    {
        $id = $_POST['id'];
        $exam_id = $_POST['exam_id'];

        $data = $this->Exam_Model->mcq_exam_question_answer($id, $exam_id);

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

    //Get All MCQ Exam
    public function mcq_exam()
    {
        if(isset($_POST['id']))
        {
            $id           = $_POST['id'];
            $classroom_id = $_POST['classroom_id'];
            $permissions  = $_POST['permissions'];
        }
        else
        {
            $id           = $this->session->get('user')['id'];
            $permissions  = $this->session->get('user')['permissions'];

            if(isset($_SESSION['classroom_id']))
            {
                $classroom_id = $this->session->get('classroom_id');
            }
            else
            {
                $classroom_id = 0;
            }
        }

        if($permissions == 'Student')
        {
            $data = $this->Exam_Model->mcq_exam($id, $classroom_id);
        }
        else
        {
            $data = $this->Exam_Model->mcq_exam_mentor($id);
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
                'data'     => '0',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Check Eaxm Status Student
    public function check_exam_status()
    {
        $id      = $_POST['id'];
        $exam_id = $_POST['exam_id'];

        $data = $this->Exam_Model->check_exam_status($id, $exam_id);

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

    //Exam Question Student
    public function exam_question_student()
    {
        $id           = $_POST['id'];
        $exam_id      = $_POST['exam_id'];
        $classroom_id = $_POST['classroom_id'];

        $data = $this->Exam_Model->exam_question_student($id, $exam_id,$classroom_id);

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

    //Add Student Answer
    public function add_mcq_question_answer()
    {
        $exam_id    = $_POST['id'];
        $account_id = $this->session->get('user')['id'];
        $option     = $_POST['option'];
        $question   = $_POST['question'];

        $data = $this->Exam_Model->add_mcq_question_answer($exam_id, $account_id, $option, $question);

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

    //Add Student Answer Final
    public function add_mcq_question_answer_final()
    {
        $exam_id           = $_POST['id'];
        $account_id        = $this->session->get('user')['id'];
        $option            = $_POST['option'];
        $question          = $_POST['question'];
        $multiple_response = $_POST['multiple_response'];

        $data = $this->Exam_Model->add_mcq_question_answer_final($exam_id, $account_id, $option, $question, $multiple_response);

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

    //Get All Sentence Exam
    public function sentence_exam()
    {
        if(isset($_POST['id'])){

            $id = $_POST['id'];
            $classroom_id = $_POST['classroom_id'];
            $permissions  = $_POST['permissions'];
        }
        else
        {
            $id = $this->session->get('user')['id'];
            $permissions  = $this->session->get('user')['permissions'];

            if(isset($_SESSION['classroom_id']))
            {
                $classroom_id = $this->session->get('classroom_id');
            }
            else
            {
                $classroom_id = 0;
            }
        }

        if($permissions == 'Student')
        {
            $data = $this->Exam_Model->sentence_exam($id, $classroom_id);
        }
        else
        {
            $data = $this->Exam_Model->sentence_exam_mentor($id);
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
                'data'     => '0',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Sentence Exam Question Student
    public function exam_sentence_question_student()
    {
        $id = $_POST['id'];
        $exam_id = $_POST['exam_id'];
        $classroom_id = $_POST['classroom_id'];
        $data = $this->Exam_Model->exam_sentence_question_student($id, $exam_id,$classroom_id);
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

    //Add Student Sentence Answer
    public function add_sentence_question_answer()
    {
        $data = $this->request->getPost();
        $data['account_id'] = $this->session->get('user')['id'];

        $result = $this->Exam_Model->add_sentence_question_answer($data);

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
                'data'     => 'No Data',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Add Student Sentence Answer Final
    public function add_sentence_question_answer_final()
    {
        $data = $this->request->getPost();
        $data['account_id'] = $this->session->get('user')['id'];

        $result = $this->Exam_Model->add_sentence_question_answer_final($data);
        
        if($result)
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


}
?>