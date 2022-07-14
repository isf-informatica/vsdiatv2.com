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


}
?>