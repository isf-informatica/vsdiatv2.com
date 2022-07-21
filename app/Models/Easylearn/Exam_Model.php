<?php

namespace App\Models\Easylearn;

use CodeIgniter\Model;

class Exam_Model extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    //Add MCQ Exam
    public function add_mcq_exam($data = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $query = $builder->insert($data);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get All Exam
    public function get_all_exam()
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('el_mcq_exam.unique_id, el_mcq_exam.exam_title, el_mcq_exam.exam_category, DATE_FORMAT(el_mcq_exam.exam_date, "%d-%m-%Y") as exam_date, DATE_FORMAT(el_mcq_exam.exam_start_time, "%h:%i %p") as exam_start_time, DATE_FORMAT(el_mcq_exam.exam_end_time, "%h:%i %p") as exam_end_time, el_mcq_exam.visibility, el_courses.course_name');
        $builder->join('el_courses', 'el_courses.id = el_mcq_exam.course_id');
        $builder->where('el_mcq_exam.is_del', 0);
        $builder->where('el_courses.is_del', 0);
        $builder->orderBy('el_mcq_exam.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = $query->getResult();

            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    //Get All Exam Reg
    public function get_all_exam_reg($reg_id = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('el_mcq_exam.unique_id, el_mcq_exam.exam_title, el_mcq_exam.exam_category, DATE_FORMAT(el_mcq_exam.exam_date, "%d-%m-%Y") as exam_date, DATE_FORMAT(el_mcq_exam.exam_start_time, "%h:%i %p") as exam_start_time, DATE_FORMAT(el_mcq_exam.exam_end_time, "%h:%i %p") as exam_end_time, el_mcq_exam.visibility, el_courses.course_name');
        $builder->join('el_courses', 'el_courses.id = el_mcq_exam.course_id');
        $builder->where('el_mcq_exam.is_del', 0);
        $builder->where('el_courses.is_del', 0);
        $builder->where('el_mcq_exam.reg_id', $reg_id);
        $builder->orderBy('el_mcq_exam.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = $query->getResult();
            
            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    //Get All Exam Classroom
    public function get_all_exam_classroom($classroom_id = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('el_mcq_exam.unique_id, el_mcq_exam.exam_title, el_mcq_exam.exam_category, DATE_FORMAT(el_mcq_exam.exam_date, "%d-%m-%Y") as exam_date, DATE_FORMAT(el_mcq_exam.exam_start_time, "%h:%i %p") as exam_start_time, DATE_FORMAT(el_mcq_exam.exam_end_time, "%h:%i %p") as exam_end_time, el_mcq_exam.visibility, el_courses.course_name');
        $builder->join('el_courses', 'el_courses.id = el_mcq_exam.course_id');
        $builder->where('el_mcq_exam.is_del', 0);
        $builder->where('el_courses.is_del', 0);
        $builder->where('el_mcq_exam.classroom_id', $classroom_id);
        $builder->orderBy('el_mcq_exam.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = $query->getResult();
            
            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    //Show hide Exam
    public function show_hide_exam($array = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->where('unique_id', $id);
        $query = $builder->update($array);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Exam detail Id
    public function exam_detail_id($id = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('el_mcq_exam.id, el_mcq_exam.course_id, el_mcq_exam.exam_title, el_mcq_exam.exam_category, DATE_FORMAT(el_mcq_exam.exam_date, "%d-%m-%Y")  AS exam_date, DATE_FORMAT(el_mcq_exam.exam_start_time, "%h:%i %p") AS exam_start_time, DATE_FORMAT(el_mcq_exam.exam_end_time, "%h:%i %p") AS exam_end_time, el_mcq_exam.exam_right_mark, el_mcq_exam.exam_wrong_mark, el_mcq_exam.exam_duration, el_mcq_exam.show_result, el_mcq_exam.multiple_response, el_courses.course_name,classroom_id,el_mcq_exam.unique_id');
        $builder->join('el_courses', 'el_courses.id = el_mcq_exam.course_id');
        $builder->where('el_mcq_exam.is_del', 0);
        $builder->where('el_courses.is_del', 0);
        $builder->where('el_mcq_exam.unique_id', $id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            
            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    //Edit MCQ Exam
    public function edit_mcq_exam($array = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->where('unique_id', $id);
        $query = $builder->update($array);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete MCQ Exam
    public function delete_mcq_exam($id = NULL,$array=NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->where('unique_id', $id);
        $query = $builder->update($array);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //get MCQ Exam question
    public function mcq_exam_question($id = NULL)
    {
        $builder = $this->db->table('el_mcq_question');
        $builder->select('el_mcq_question.id, el_mcq_question.question_title, el_mcq_question.question_image, el_mcq_question.option_1, el_mcq_question.option_2, el_mcq_question.option_3, el_mcq_question.option_4, el_mcq_question.option_5, el_mcq_question.option_6, el_mcq_question.option_7, el_mcq_question.option_8, el_mcq_question.option_9, el_mcq_question.option_10, el_mcq_question.answer_option');
        $builder->join('el_mcq_exam', 'el_mcq_exam.id = el_mcq_question.exam_id');
        $builder->where('el_mcq_exam.unique_id', $id);
        $builder->where('el_mcq_exam.is_del', 0);
        $builder->where('el_mcq_question.is_del', 0);
        $query = $builder->get();

        if($query->getNumrows()>0)
        {
            $data = $query->getResult();

            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    //Get Question by ID
    public function get_question_by_id($id = NULL)
    {
        $builder = $this->db->table('el_mcq_question');
        $builder->select('question_title, question_image, option_1, option_2, option_3, option_4, option_5, option_6, option_7, option_8, option_9, option_10, answer_option');
        $builder->where('id', $id);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getRow();

            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    //Add Mcq Question
    public function add_mcq_question($array, $id)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('id');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();

            $array['exam_id'] = $data['id'];

            $builder = $this->db->table('el_mcq_question');
            $query = $builder->insert($array);

            if($query)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Update MCQ Question
    public function edit_mcq_question($array = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_mcq_question');
        $builder->where('id', $id);
        $query = $builder->update($array);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete MCQ Question
    public function delete_mcq_question($id = NULL,$array=NULL)
    {
        $builder = $this->db->table('el_mcq_question');
        $builder->where('id', $id);
        $query = $builder->update($array);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    // Get All sentence exam
    public function sent_exam_question($id){

        $builder = $this->db->table('el_sentence_question');
        $builder->select('el_sentence_question.id, el_sentence_question.question_title, el_sentence_question.question_image, el_sentence_question.option_1, el_sentence_question.option_2, el_sentence_question.option_3, el_sentence_question.option_4, el_sentence_question.option_5');
        $builder->join('el_mcq_exam', 'el_mcq_exam.id = el_sentence_question.exam_id');
        $builder->where('el_mcq_exam.unique_id', $id);
        $builder->where('el_mcq_exam.is_del', 0);
        $builder->where('el_sentence_question.is_del', 0);
        $query = $builder->get();

        if($query->getNumrows()>0)
        {
            $data = $query->getResult();

            return $data;
        }
        else
        {
            return FALSE;
        }

    }

    //Add Sentence Question
    public function add_sentence_question($question){

        $builder = $this->db->table('el_sentence_question');
        $query = $builder->insert($question);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get Sentence Question By ID
    public function exam_sent_quest_id($id){

        $builder = $this->db->table('el_sentence_question');
        $builder->select('id,question_title, question_image, option_1, option_2, option_3, option_4, option_5');
        $builder->where('id', $id);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getRow();

            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    //Edit Sentence Question
    public function edit_sentence_question($question,$id){

        $builder = $this->db->table('el_sentence_question');
        $builder->where('id', $id);
        $query = $builder->update($question);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //delete sent question 
    public function delete_sent_question($id=NULL,$array=NULL){

        $builder = $this->db->table('el_sentence_question');
        $builder->where('id', $id);
        $query = $builder->update($array);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get All Exam Result
    public function get_all_exam_result($unique_id = NULL)
    {
        $builder = $this->db->table('el_exam_result');
        $builder->select('el_exam_result.account_id, el_mcq_exam.unique_id, el_mcq_exam.exam_category, el_exam_result.total_mark, el_exam_result.mark_obtained, DATE_FORMAT( el_exam_result.added_on, "%d-%m-%Y %h:%i %p") as added_on, el_accounts.username');
        $builder->join('el_mcq_exam', 'el_mcq_exam.id = el_exam_result.exam_id');
        $builder->join('el_accounts', 'el_accounts.id = el_exam_result.account_id');
        $builder->where('el_mcq_exam.is_del', 0);
        $builder->where('el_accounts.is_del', 0);
        $builder->where('el_mcq_exam.unique_id', $unique_id);
        $builder->orderBy('el_exam_result.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = $query->getResult();
            
            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    //Exam Detail Student
    public function exam_detail_id_student($id = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('el_mcq_exam.exam_title, el_mcq_exam.exam_duration, el_mcq_exam.show_result, el_mcq_exam.multiple_response, el_courses.course_name');
        $builder->join('el_courses', 'el_courses.id = el_mcq_exam.course_id');
        $builder->where('el_mcq_exam.is_del', 0);
        $builder->where('el_mcq_exam.visibility', 1);
        $builder->where('el_mcq_exam.unique_id', $id);
        $builder->where('el_courses.is_del', 0);

        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    public function exam_detail_id_mentor($id = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('el_mcq_exam.exam_title, el_mcq_exam.classroom_id, el_mcq_exam.exam_duration, el_mcq_exam.show_result, el_mcq_exam.multiple_response, el_courses.course_name');
        $builder->join('el_courses', 'el_courses.id = el_mcq_exam.course_id');
        $builder->where('el_mcq_exam.is_del', 0);
        $builder->where('el_mcq_exam.unique_id', $id);
        $builder->where('el_courses.is_del', 0);

        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    //Sentence Exam Overview Student
    public function sentence_exam_overview_student($id = NULL, $exam_id = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('id');
        $builder->where('unique_id', $exam_id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_sentence_question');
            $builder1->select('el_sentence_question.option_1, el_sentence_question.option_2, el_sentence_question.option_3, el_sentence_question.option_4, el_sentence_question.option_5, el_sentence_exam_response.answer_1, el_sentence_exam_response.answer_2, el_sentence_exam_response.answer_3, el_sentence_exam_response.answer_4, el_sentence_exam_response.answer_5,');
            $builder1->join('el_sentence_exam_response', 'el_sentence_exam_response.question_id = el_sentence_question.id');
            $builder1->where('el_sentence_exam_response.exam_id', $data['id']);
            $builder1->where('el_sentence_exam_response.account_id', $id);
            $query1 = $builder1->get();

            if($query1->getNumRows()>0)
            {
                $data1 = $query1->getResult();

                $total_questions = count($data1);
                $right_questions = 0;
                $wrong_questions = 0;

                foreach($data1 as $dat1)
                {
                    $dat1 = (array)$dat1;

                    if((strtolower(trim($dat1['option_1'])) == strtolower(trim($dat1['answer_1']))) && (strtolower(trim($dat1['option_2'])) == strtolower(trim($dat1['answer_2']))) && (strtolower(trim($dat1['option_3'])) == strtolower(trim($dat1['answer_3']))) && (strtolower(trim($dat1['option_4'])) == strtolower(trim($dat1['answer_4']))) && (strtolower(trim($dat1['option_5'])) == strtolower(trim($dat1['answer_5']))))
                    {
                        $right_questions++;
                    }
                    else
                    {
                        $wrong_questions++;
                    }
                }

                $array = array(
                    "total_questions" => $total_questions,
                    "right_questions" => $right_questions,
                    "wrong_questions" => $wrong_questions
                );

                return $array;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Sentence Exam Student Question Answer
    public function sentence_exam_question_answer($id = NULL, $exam_id = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('id');
        $builder->where('unique_id', $exam_id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_sentence_question');
            $builder1->select('el_sentence_question.id, el_sentence_question.question_title, el_sentence_question.question_image, el_sentence_question.option_1, el_sentence_question.option_2, el_sentence_question.option_3, el_sentence_question.option_4, el_sentence_question.option_5, el_sentence_exam_response.answer_1, el_sentence_exam_response.answer_2, el_sentence_exam_response.answer_3, el_sentence_exam_response.answer_4, el_sentence_exam_response.answer_5');
            $builder1->join('el_sentence_exam_response', 'el_sentence_exam_response.question_id = el_sentence_question.id');
            $builder1->where('el_sentence_exam_response.exam_id', $data['id']);
            $builder1->where('el_sentence_exam_response.account_id', $id);
            $builder1->where('el_sentence_question.is_del', 0);
            $query1 = $builder1->get();

            if($query1->getNumRows()>0)
            {
                $data1 = $query1->getResult();

                return $data1;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Exam Overview Student
    public function exam_overview_student($id = NULL, $exam_id = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('id');
        $builder->where('unique_id', $exam_id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_mcq_question');
            $builder1->select('el_mcq_question.answer_option, el_mcq_exam_response.answer');
            $builder1->join('el_mcq_exam_response', 'el_mcq_exam_response.question_id = el_mcq_question.id');
            $builder1->where('el_mcq_exam_response.exam_id', $data['id']);
            $builder1->where('el_mcq_exam_response.account_id', $id);
            $query1 = $builder1->get();

            if($query1->getNumRows()>0)
            {
                $data1 = $query1->getResult();

                $total_questions = count($data1);
                $right_questions = 0;
                $wrong_questions = 0;

                foreach($data1 as $dat1)
                {
                    $dat1 = (array)$dat1;

                    if($dat1['answer'] == $dat1['answer_option'])
                    {
                        $right_questions++;
                    }
                    else
                    {
                        $wrong_questions++;
                    }
                }

                $array = array(
                    "total_questions" => $total_questions,
                    "right_questions" => $right_questions,
                    "wrong_questions" => $wrong_questions
                );

                return $array;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Exam Student Question Answer
    public function mcq_exam_question_answer($id = NULL, $exam_id = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('id');
        $builder->where('unique_id', $exam_id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_mcq_question');
            $builder1->select('el_mcq_question.id, el_mcq_question.question_title, el_mcq_question.question_image, el_mcq_question.option_1, el_mcq_question.option_2, el_mcq_question.option_3, el_mcq_question.option_4, el_mcq_question.option_5, el_mcq_question.option_6, el_mcq_question.option_7, el_mcq_question.option_8, el_mcq_question.option_9, el_mcq_question.option_10, el_mcq_question.answer_option, el_mcq_exam_response.answer');
            $builder1->join('el_mcq_exam_response', 'el_mcq_exam_response.question_id = el_mcq_question.id');
            $builder1->where('el_mcq_exam_response.exam_id', $data['id']);
            $builder1->where('el_mcq_exam_response.account_id', $id);
            $builder1->where('el_mcq_question.is_del', 0);
            $query1 = $builder1->get();

            if($query1->getNumRows()>0)
            {
                $data1 = $query1->getResult();

                return $data1;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Get All MCQ Exam
    public function mcq_exam($id = NULL,$classroom_id = NULL)
    {
        $builder = $this->db->table('el_batches');
        $builder->select('el_batches.id');
        $builder->join('el_batch_assignment', 'el_batch_assignment.batch_id = el_batches.id');
        $builder->where('el_batches.visibility', 1);
        $builder->where('el_batches.is_del', 0);
        $builder->where('el_batches.classroom_id', $classroom_id);
        $builder->where('el_batch_assignment.account_id', $id);
        $builder->where('el_batch_assignment.is_del', 0);

        $builder1 = $this->db->table('el_courses');
        $builder1->select('el_courses.id');
        $builder1->join('el_batch_course', 'el_batch_course.course_id = el_courses.id');
        $builder1->whereIn('el_batch_course.batch_id', $builder); 
        $builder1->where('el_batch_course.is_del', 0);
        $builder1->where('el_courses.is_del', 0);
        $builder1->where('el_courses.course_visibility', 1);
    
        $builder2 = $this->db->table('el_mcq_exam');
        $builder2->select('id,unique_id,exam_title, exam_duration, exam_category');
        $builder2->whereIn('course_id', $builder1);
        $builder2->where('classroom_id',$classroom_id);
        $builder2->where('exam_category', 'MCQ Exam');
        $builder2->where('is_del', 0);
        $builder2->where('visibility', 1);
        $builder2->orderBy('id', 'DESC');
        $query2 = $builder2->get();

        if($query2->getNumRows() > 0)
        {
            $data2 = $query2->getResult();

            foreach($data2 as $key => $value)
            {
                $data2[$key] = (array)$data2[$key];

                $builder1 = $this->db->table('el_mcq_question');
                $builder1->where('exam_id', $data2[$key]['id']);
                $builder1->where('is_del', 0);
                $query1 = $builder1->get();

                $data2[$key]['questions'] = $query1->getNumRows();

            }

            return $data2;
        }
        else
        {
            return FALSE;
        }
    }

    //Check Eaxm Status Student
    public function check_exam_status($id = NULL, $exam_id = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('id');
        $builder->where('unique_id', $exam_id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_complete_exam');
            $builder1->where('account_id', $id);
            $builder1->where('exam_id', $data['id']);
            $query1 = $builder1->get();

            if($query1->getNumRows()>0)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Exam Question Student
    public function exam_question_student($id = NULL, $exam_id = NULL,$classroom_id = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('id, exam_duration');
        $builder->where('classroom_id',$classroom_id);
        $builder->where('unique_id', $exam_id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();

            $date = date("Y-m-d H:i:s", strtotime( "- ".($data['exam_duration']+$data['exam_duration'])." minutes", strtotime(date('Y-m-d H:i:s'))));

            $builder = $this->db->table('el_mcq_question');
            $builder->select('id, question_title, question_image, option_1, option_2, option_3, option_4, option_5, option_6, option_7, option_8, option_9, option_10');
            $builder->where('exam_id', $data['id']);
            $builder->where('is_del', 0);
            $query = $builder->get();

            if($query->getNumRows()>0)
            {
                $data = $query->getResult();
                $questions = [];

                foreach($data as $dat)
                {
                    $dat = (array)$dat;

                    $builder = $this->db->table('el_mcq_exam_response');
                    $builder->select('answer');
                    $builder->where('account_id', $id);
                    $builder->where('question_id', $dat['id']);
                    $builder->where('added_on >=', $date);
                    $query = $builder->get();

                    if($query->getNumRows() > 0)
                    {
                        $data2 = (array)$query->getRow();

                        $answer = $data2['answer'];
                    }
                    else
                    {
                        $answer = 0;
                    }

                    $array = array(
                        'id'             => $dat['id'],
                        'question_title' => $dat['question_title'],
                        'question_image' => $dat['question_image'],
                        'option_1'       => $dat['option_1'],
                        'option_2'       => $dat['option_2'],
                        'option_3'       => $dat['option_3'],
                        'option_4'       => $dat['option_4'],
                        'option_5'       => $dat['option_5'],
                        'option_6'       => $dat['option_6'],
                        'option_7'       => $dat['option_7'],
                        'option_8'       => $dat['option_8'],
                        'option_9'       => $dat['option_9'],
                        'option_10'      => $dat['option_10'],
                        'answer'        => $answer
                    );

                    array_push($questions, $array);
                }

                return $questions;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Add Student Answer
    public function add_mcq_question_answer($exam_id = NULL, $account_id = NULL, $option = NULL, $question = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('id, exam_duration');
        $builder->where('unique_id', $exam_id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();

            $array = array(
                'exam_id'     => $data['id'],
                'question_id' => $question,
                'account_id'  => $account_id,
                'answer'      => $option,
                'added_on'    => date("Y-m-d H:i:s")
            );

            $builder1 = $this->db->table('el_mcq_exam_response');
            $builder1->where('question_id', $question);
            $builder1->where('account_id', $account_id);
            $query1 = $builder1->get();

            if($query1->getNumRows()>0)
            {
                $builder2 = $this->db->table('el_mcq_exam_response');
                $builder2->where('question_id', $question);
                $builder2->where('account_id', $account_id);
                $query2 = $builder2->update($array);

                if($query2)
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                $builder2 = $this->db->table('el_mcq_exam_response');
                $query2 = $builder2->insert($array);

                if($query2)
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Add Student Answer Final
    public function add_mcq_question_answer_final($exam_id = NULL, $account_id = NULL, $option = NULL, $question = NULL, $multiple_response = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('id, exam_duration, exam_right_mark, exam_wrong_mark');
        $builder->where('unique_id', $exam_id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();

            $array = array(
                'exam_id'     => $data['id'],
                'question_id' => $question,
                'account_id'  => $account_id,
                'answer'      => $option,
                'added_on'    => date("Y-m-d H:i:s")
            );

            $builder1 = $this->db->table('el_mcq_exam_response');
            $builder1->select('id');
            $builder1->where('question_id', $question);
            $builder1->where('account_id', $account_id);
            $query1 = $builder1->get();

            if($query1->getNumRows()>0)
            {
                $builder2 = $this->db->table('el_mcq_exam_response');
                $builder2->where('question_id', $question);
                $builder2->where('account_id', $account_id);
                $query2 = $builder2->update($array);

                if($query2)
                {
                    $builder3 = $this->db->table('el_mcq_question');
                    $builder3->select('el_mcq_question.answer_option, el_mcq_exam_response.answer');
                    $builder3->join('el_mcq_exam_response', 'el_mcq_exam_response.question_id = el_mcq_question.id');
                    $builder3->where('el_mcq_exam_response.exam_id', $data['id']);
                    $builder3->where('el_mcq_exam_response.account_id', $account_id);
                    $query3 = $builder3->get();

                    if($query3->getNumRows()>0)
                    {
                        $data3 = $query3->getResult();

                        $total_mark = $data['exam_right_mark']*count($data3);
                        $mark_obtained = 0;

                        foreach($data3 as $dat3)
                        {
                            $dat3 = (array)$dat3;

                            if($dat3['answer'] == $dat3['answer_option'])
                            {
                                $mark_obtained = $mark_obtained + $data['exam_right_mark'];
                            }
                            else
                            {
                                $mark_obtained = $mark_obtained + $data['exam_wrong_mark'];
                            }
                        }

                        $array2 = array(
                            'exam_id'       => $data['id'],
                            'account_id'    => $account_id,
                            'total_mark'    => $total_mark,
                            'mark_obtained' => $mark_obtained
                        );

                        $builder4 = $this->db->table('el_exam_result');
                        $builder4->where('exam_id', $data['id']);
                        $builder4->where('account_id', $account_id);
                        $query4 = $builder4->get();

                        if($query4->getNumRows() > 0)
                        {
                            $builder5 = $this->db->table('el_exam_result');
                            $builder5->where('exam_id', $data['id']);
                            $builder5->where('account_id', $account_id);
                            $query5 = $builder5->update($array2);
                        }
                        else
                        {
                            $builder5 = $this->db->table('el_exam_result');
                            $query5 = $builder5->insert($array2);
                        }

                        if($query5)
                        {
                            if($multiple_response == 0)
                            {
                                $array3 = array(
                                    'exam_id'    => $data['id'],
                                    'account_id' => $account_id,
                                );

                                $builder5 = $this->db->table('el_complete_exam');
                                $query5 = $builder5->insert($array3);

                                if($query5)
                                {
                                    return TRUE;
                                }
                                else
                                {
                                    return FALSE;
                                }
                            }
                            else
                            {
                                return TRUE;
                            }
                        }
                        else
                        {
                            return FALSE;
                        }
                    }
                    else
                    {
                        return FALSE;
                    }
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                $builder2 = $this->db->table('el_mcq_exam_response');
                $query2 = $builder2->insert($array);

                if($query2)
                {
                    $builder3 = $this->db->table('el_mcq_question');
                    $builder3->select('el_mcq_question.answer_option, el_mcq_exam_response.answer');
                    $builder3->join('el_mcq_exam_response', 'el_mcq_exam_response.question_id = el_mcq_question.id');
                    $builder3->where('el_mcq_exam_response.exam_id', $data['id']);
                    $builder3->where('el_mcq_exam_response.account_id', $account_id);
                    $query3 = $builder3->get();

                    if($query3->getNumRows()>0)
                    {
                        $data3 = $query3->getResult();

                        $total_mark = $data['exam_right_mark']*count($data3);
                        $mark_obtained = 0;

                        foreach($data3 as $dat3)
                        {
                            $dat3 = (array)$dat3;

                            if($dat3['answer'] == $dat3['answer_option'])
                            {
                                $mark_obtained = $mark_obtained + $data['exam_right_mark'];
                            }
                            else
                            {
                                $mark_obtained = $mark_obtained + $data['exam_wrong_mark'];
                            }
                        }

                        $array2 = array(
                            'exam_id'       => $data['id'],
                            'account_id'    => $account_id,
                            'total_mark'    => $total_mark,
                            'mark_obtained' => $mark_obtained
                        );

                        $builder4 = $this->db->table('el_exam_result');
                        $builder4->where('exam_id', $data['id']);
                        $builder4->where('account_id', $account_id);
                        $query4 = $builder4->get();

                        if($query4->getNumRows() > 0)
                        {
                            $builder5 = $this->db->table('el_exam_result');
                            $builder5->where('exam_id', $data['id']);
                            $builder5->where('account_id', $account_id);
                            $query5 = $builder5->update($array2);
                        }
                        else
                        {
                            $builder5 = $this->db->table('el_exam_result');
                            $query5 = $builder5->insert($array2);
                        }

                        if($query5)
                        {
                            if($multiple_response == 0)
                            {
                                $array3 = array(
                                    'exam_id'    => $data['id'],
                                    'account_id' => $account_id,
                                );

                                $builder5 = $this->db->table('el_complete_exam');
                                $query5 = $builder5->insert($array3);

                                if($query5)
                                {
                                    return TRUE;
                                }
                                else
                                {
                                    return FALSE;
                                }
                            }
                            else
                            {
                                return TRUE;
                            }
                        }
                        else
                        {
                            return FALSE;
                        }
                    }
                    else
                    {
                        return FALSE;
                    }
                }
                else
                {
                    return FALSE;
                }
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Get All Sentence Exam
    public function sentence_exam($id = NULL, $classroom_id=NULL)
    {
        $builder = $this->db->table('el_batches');
        $builder->select('el_batches.id');
        $builder->join('el_batch_assignment', 'el_batch_assignment.batch_id = el_batches.id');
        $builder->where('el_batches.visibility', 1);
        $builder->where('el_batches.is_del', 0);
        $builder->where('el_batches.classroom_id', $classroom_id);
        $builder->where('el_batch_assignment.account_id', $id);
        $builder->where('el_batch_assignment.is_del', 0);

        $builder1 = $this->db->table('el_courses');
        $builder1->select('el_courses.id');
        $builder1->join('el_batch_course', 'el_batch_course.course_id = el_courses.id');
        $builder1->whereIn('el_batch_course.batch_id', $builder); 
        $builder1->where('el_batch_course.is_del', 0);
        $builder1->where('el_courses.is_del', 0);
        $builder1->where('el_courses.course_visibility', 1);
    
        $builder2 = $this->db->table('el_mcq_exam');
        $builder2->select('id,unique_id,exam_title, exam_duration, exam_category');
        $builder2->whereIn('course_id', $builder1);
        $builder2->where('classroom_id',$classroom_id);
        $builder2->where('exam_category', 'Sentence Completion');
        $builder2->where('is_del', 0);
        $builder2->where('visibility', 1);
        $query2 = $builder2->get();

        if($query2->getNumRows() > 0)
        {
            $data2 = $query2->getResult();

            foreach($data2 as $key => $value)
            {
                $data2[$key] = (array)$data2[$key];

                $builder1 = $this->db->table('el_sentence_question');
                $builder1->where('exam_id', $data2[$key]['id']);
                $builder1->where('is_del', 0);
                $query1 = $builder1->get();

                $data2[$key]['questions'] = $query1->getNumRows();
            }

            return $data2;
        }
        else
        {
            return FALSE;
        }
    }

    //get All Sentance Exam Mentor
    public function sentence_exam_mentor($id = NULL)
    {
        $builder1 = $this->db->table('el_mentor_course')->select('course_id')->where('mentor_id', $id)->where('is_del', 0);

        $builder2 = $this->db->table('el_mcq_exam');
        $builder2->select('id,unique_id,exam_title, exam_duration, exam_category');
        $builder2->whereIn('course_id', $builder1);
        $builder2->where('exam_category', 'Sentence Completion');
        $builder2->where('is_del', 0);
        $query2 = $builder2->get();

        if($query2->getNumRows() > 0)
        {
            $data2 = $query2->getResult();

            foreach($data2 as $key => $value)
            {
                $data2[$key] = (array)$data2[$key];

                $builder1 = $this->db->table('el_sentence_question');
                $builder1->where('exam_id', $data2[$key]['id']);
                $builder1->where('is_del', 0);
                $query1 = $builder1->get();

                $data2[$key]['questions'] = $query1->getNumRows();
            }

            return $data2;
        }
        else
        {
            return FALSE;
        }
    }

    //Exam Sentence Question Student
    public function exam_sentence_question_student($id = NULL, $exam_id = NULL,$classroom_id = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('id, exam_duration');
        $builder->where('classroom_id', $classroom_id);
        $builder->where('unique_id', $exam_id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();

            $date = date("Y-m-d H:i:s", strtotime( "- ".($data['exam_duration']+$data['exam_duration'])." minutes", strtotime(date('Y-m-d H:i:s'))));

            $builder = $this->db->table('el_sentence_question');
            $builder->select('id, question_title, question_image');
            $builder->where('exam_id', $data['id']);
            $builder->where('is_del', 0);
            $query = $builder->get();

            if($query->getNumRows()>0)
            {
                $data = $query->getResult();
                $questions = [];

                foreach($data as $dat)
                {
                    $dat = (array)$dat;

                    $builder = $this->db->table('el_sentence_exam_response');
                    $builder->select('answer_1, answer_2, answer_3, answer_4, answer_5');
                    $builder->where('account_id', $id);
                    $builder->where('question_id', $dat['id']);
                    $builder->where('added_on >=', $date);
                    $query = $builder->get();

                    if($query->getNumRows()>0)
                    {
                        $answers = (array)$query->getRow();

                        $answer_1 = $answers['answer_1']; 
                        $answer_2 = $answers['answer_2']; 
                        $answer_3 = $answers['answer_3']; 
                        $answer_4 = $answers['answer_4']; 
                        $answer_5 = $answers['answer_5']; 
                    }
                    else
                    {
                        $answer_1 = '';
                        $answer_2 = '';
                        $answer_3 = '';
                        $answer_4 = '';
                        $answer_5 = '';
                    }

                    $array = array(
                        'id'             => $dat['id'],
                        'question_title' => $dat['question_title'],
                        'question_image' => $dat['question_image'],
                        'answer_1'       => $answer_1,
                        'answer_2'       => $answer_2,
                        'answer_3'       => $answer_3,
                        'answer_4'       => $answer_4,
                        'answer_5'       => $answer_5,
                    );

                    array_push($questions, $array);
                }
                return $questions;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    } 

    //Add Sentence Student Answer
    public function add_sentence_question_answer($data = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('id, exam_duration');
        $builder->where('unique_id', $data['id']);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $dat = (array)$query->getRow();

            $array = array(
                'exam_id'     => $dat['id'],
                'question_id' => $data['question'],
                'account_id'  => $data['account_id'],
                'answer_1'    => $data['answer_1'],
                'answer_2'    => $data['answer_2'],
                'answer_3'    => $data['answer_3'],
                'answer_4'    => $data['answer_4'],
                'answer_5'    => $data['answer_5'],
                'added_on'    => date('Y-m-d H:i:s')
            );

            $builder1 = $this->db->table('el_sentence_exam_response');
            $builder1->where('question_id', $data['question']);
            $builder1->where('account_id', $data['account_id']);

            $query1 = $builder1->get();

            if($query1->getNumRows()>0)
            {
                $builder2 = $this->db->table('el_sentence_exam_response');
                $builder2->where('question_id', $data['question']);
                $builder2->where('account_id', $data['account_id']);
                $query2 = $builder2->update($array);

                if($query2)
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                $builder2 = $this->db->table('el_sentence_exam_response');
                $query2 = $builder2->insert($array);

                if($query2)
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
        }
        else
        {
            return FALSE;
        }
    }


    //Add Sentence Student Answer Final
    public function add_sentence_question_answer_final($data = NULL)
    {
        $builder = $this->db->table('el_mcq_exam');
        $builder->select('id, exam_duration, exam_right_mark, exam_wrong_mark');
        $builder->where('unique_id', $data['id']);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $dat = (array)$query->getRow();

            $array = array(
                'exam_id'     => $dat['id'],
                'question_id' => $data['question'],
                'account_id'  => $data['account_id'],
                'answer_1'    => $data['answer_1'],
                'answer_2'    => $data['answer_2'],
                'answer_3'    => $data['answer_3'],
                'answer_4'    => $data['answer_4'],
                'answer_5'    => $data['answer_5'],
                'added_on'    => date("Y-m-d H:i:s")
            );

            $builder1 = $this->db->table('el_sentence_exam_response');
            $builder1->select('id');
            $builder1->where('question_id', $data['question']);
            $builder1->where('account_id', $data['account_id']);
            $query1 = $builder1->get();

            if($query1->getNumRows()>0)
            {
                $builder2 = $this->db->table('el_sentence_exam_response');
                $builder2->where('question_id', $data['question']);
                $builder2->where('account_id', $data['account_id']);
                $query2 = $builder2->update($array);

                if($query2)
                {
                    $builder3 = $this->db->table('el_sentence_question');
                    $builder3->select('el_sentence_question.option_1, el_sentence_question.option_2, el_sentence_question.option_3, el_sentence_question.option_4, el_sentence_question.option_5, el_sentence_exam_response.answer_1, el_sentence_exam_response.answer_2, el_sentence_exam_response.answer_3, el_sentence_exam_response.answer_4, el_sentence_exam_response.answer_5');
                    $builder3->join('el_sentence_exam_response', 'el_sentence_exam_response.question_id = el_sentence_question.id');
                    $builder3->where('el_sentence_exam_response.exam_id', $dat['id']);
                    $builder3->where('el_sentence_exam_response.account_id', $data['account_id']);
                    $query3 = $builder3->get();

                    if($query3->getNumRows()>0)
                    {
                        $data3 = $query3->getResult();

                        $total_mark = $dat['exam_right_mark']*count($data3);
                        $mark_obtained = 0;

                        foreach($data3 as $dat3)
                        {
                            $dat3 = (array)$dat3;

                            if((strtolower(trim($dat3['option_1'])) == strtolower(trim($dat3['answer_1']))) && (strtolower(trim($dat3['option_2'])) == strtolower(trim($dat3['answer_2']))) && (strtolower(trim($dat3['option_3'])) == strtolower(trim($dat3['answer_3']))) && (strtolower(trim($dat3['option_4'])) == strtolower(trim($dat3['answer_4']))) && (strtolower(trim($dat3['option_5'])) == strtolower(trim($dat3['answer_5']))))
                            {
                                $mark_obtained = $mark_obtained + $dat['exam_right_mark'];
                            }
                            else
                            {
                                $mark_obtained = $mark_obtained + $dat['exam_wrong_mark'];
                            }
                        }

                        $array2 = array(
                            'exam_id'       => $dat['id'],
                            'account_id'    => $data['account_id'],
                            'total_mark'    => $total_mark,
                            'mark_obtained' => $mark_obtained
                        );

                        $builder4 = $this->db->table('el_exam_result');
                        $builder4->where('exam_id', $dat['id']);
                        $builder4->where('account_id', $data['account_id']);
                        $query4 = $builder4->get();

                        if($query4->getNumRows() > 0)
                        {
                            $builder5 = $this->db->table('el_exam_result');
                            $builder5->where('exam_id', $dat['id']);
                            $builder5->where('account_id', $data['account_id']);
                            $query5 = $builder5->update($array2);
                        }
                        else
                        {
                            $builder5 = $this->db->table('el_exam_result');
                            $query5 = $builder5->insert($array2);
                        }

                        if($query5)
                        {
                            if($data['multiple_response'] == 0)
                            {
                                $array3 = array(
                                    'exam_id'    => $dat['id'],
                                    'account_id' => $data['account_id'],
                                );

                                $builder5 = $this->db->table('el_complete_exam');
                                $query5 = $builder5->insert($array3);

                                if($query5)
                                {
                                    return TRUE;
                                }
                                else
                                {
                                    return FALSE;
                                }
                            }
                            else
                            {
                                return TRUE;
                            }
                        }
                        else
                        {
                            return FALSE;
                        }
                    }
                    else
                    {
                        return FALSE;
                    }
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                $builder2 = $this->db->table('el_sentence_exam_response');
                $query2 = $builder2->insert($array);

                if($query2)
                {
                    $builder3 = $this->db->table('el_sentence_question');
                    $builder3->select('el_sentence_question.option_1, el_sentence_question.option_2, el_sentence_question.option_3, el_sentence_question.option_4, el_sentence_question.option_5, el_sentence_exam_response.answer_1, el_sentence_exam_response.answer_2, el_sentence_exam_response.answer_3, el_sentence_exam_response.answer_4, el_sentence_exam_response.answer_5');
                    $builder3->join('el_sentence_exam_response', 'el_sentence_exam_response.question_id = el_sentence_question.id');
                    $builder3->where('el_sentence_exam_response.exam_id', $dat['id']);
                    $builder3->where('el_sentence_exam_response.account_id', $data['account_id']);
                    $query3 = $builder3->get();

                    if($query3->getNumRows()>0)
                    {
                        $data3 = $query3->getResult();

                        $total_mark = $dat['exam_right_mark']*count($data3);
                        $mark_obtained = 0;

                        foreach($data3 as $dat3)
                        {
                            $dat3 = (array)$dat3;

                            if(strtolower($dat3['option_1']) == strtolower($dat3['answer_1']) && strtolower($dat3['option_2']) == strtolower($dat3['answer_2']) && strtolower($dat3['option_3']) == strtolower($dat3['answer_3']) && strtolower($dat3['option_4']) == strtolower($dat3['answer_4']) && strtolower($dat3['option_5']) == strtolower($dat3['answer_5']))
                            {
                                $mark_obtained = $mark_obtained + $dat['exam_right_mark'];
                            }
                            else
                            {
                                $mark_obtained = $mark_obtained + $dat['exam_wrong_mark'];
                            }
                        }

                        $array2 = array(
                            'exam_id'       => $dat['id'],
                            'account_id'    => $data['account_id'],
                            'total_mark'    => $total_mark,
                            'mark_obtained' => $mark_obtained
                        );

                        $builder4 = $this->db->table('el_exam_result');
                        $builder4->where('exam_id', $dat['id']);
                        $builder4->where('account_id', $data['account_id']);
                        $query4 = $builder4->get();

                        if($query4->getNumRows() > 0)
                        {
                            $builder5 = $this->db->table('el_exam_result');
                            $builder5->where('exam_id', $dat['id']);
                            $builder5->where('account_id', $data['account_id']);
                            $query5 = $builder5->update($array2);
                        }
                        else
                        {
                            $builder5 = $this->db->table('el_exam_result');
                            $query5 = $builder5->insert($array2);
                        }

                        if($query5)
                        {
                            if($data['multiple_response'] == 0)
                            {
                                $array3 = array(
                                    'exam_id'    => $dat['id'],
                                    'account_id' => $account_id,
                                );

                                $builder5 = $this->db->table('el_complete_exam');
                                $query5 = $builder5->insert($array3);

                                if($query5)
                                {
                                    return TRUE;
                                }
                                else
                                {
                                    return FALSE;
                                }
                            }
                            else
                            {
                                return TRUE;
                            }
                        }
                        else
                        {
                            return FALSE;
                        }
                    }
                    else
                    {
                        return FALSE;
                    }
                }
                else
                {
                    return FALSE;
                }
            }
        }
        else
        {
            return FALSE;
        }
    }



}
?>