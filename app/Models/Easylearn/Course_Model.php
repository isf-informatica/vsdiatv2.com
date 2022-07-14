<?php

namespace App\Models\Easylearn;

use CodeIgniter\Model;

class Course_Model extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    //Add Course
    public function add_course($course = NULL)
    {
        $builder = $this->db->table('el_courses');
        $result = $builder->insert($course);

        if($result)
        {
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    //Add Course By Classroom
    public function add_course_by_classroom($course = NULL,$classroom_id=NULL,$id=NULL)
    {
        $builder = $this->db->table('el_courses');
        $result = $builder->insert($course);
        $CurrentcourseID = $this->db->insertID();

        $Assign_Course_Classroom = array(
            'course_id'      => $CurrentcourseID,
            'classroom_id'   => $classroom_id,
            'added_by'       => $id,
            'updated_by'     => $id,
            'is_del'         => 0
        );

        $assign_classroom_course = $this->db->table('el_classroom_course');
        $assign_classroom_course_inserted = $assign_classroom_course->insert($Assign_Course_Classroom);

        if($result && $assign_classroom_course_inserted)
        {
            return TRUE;
        }
        else{
            return FALSE;
        }
    }



    //All Course Details
    public function course_details_getdata()
    {
        $builder = $this->db->table('el_courses');
        $builder->select('unique_id, course_name, course_image, course_description, course_visibility, course_full_description, language, certificate');
        $builder->where('is_del', 0);
        $builder->orderBy('id', 'DESC');

        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return $query->getResult();
        }
        else
        {
            return FALSE;
        }
    }

    //All Course Details by reg
    public function course_details_getdata_reg($reg_id = NULL)
    {
        $builder = $this->db->table('el_courses');
        $builder->select('id,unique_id, course_name, course_image, course_description, course_visibility, course_full_description, language, certificate');
        $builder->where('reg_id', $reg_id);
        $builder->where('is_del', 0);
        $builder->orderBy('id', 'DESC');

        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return $query->getResult();
        }
        else
        {
            return FALSE;
        }
    }

    //All Course Details by reg Classroom
    public function course_details_getdata_reg_classroom($classroom_id = NULL)
    {
        $builder = $this->db->table('el_classroom_course');
        $builder->select('el_courses.id,unique_id, course_name, course_image, course_description, course_visibility, course_full_description, language, certificate');
        $builder->join('el_courses','el_courses.id=el_classroom_course.course_id');
        $builder->where('el_classroom_course.classroom_id', $classroom_id);
        $builder->where('el_classroom_course.is_del', 0);
        $builder->where('el_courses.is_del', 0);
        //$builder->orderBy('el_classroom_course.id', 'DESC');

        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return $query->getResult();
        }
        else
        {
            return FALSE;
        }
    }

    //All course Details Student
    public function course_details_getdata_student($id = NULL)
    {

        $builder = $this->db->table('el_courses');
        $builder->select('unique_id, course_name, course_image, course_description, course_visibility, course_full_description, language, certificate');
        $builder->where('el_courses.is_del', 0);
        $builder->where('course_visibility', 1);

        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = $query->getResult();
            return $array;
        }
        else
        {
            return FALSE;
        }
    }

    //Update Course Visible
    public function update_course_visible($id = NULL, $visiblity = NULL){

        $builder = $this->db->table('el_courses');
        $builder->where('unique_id', $id);
        $query = $builder->update(array("course_visibility" => $visiblity));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get Course Detail by ID
    public function get_course_details_by_id($id = NULL)
    {
        $builder = $this->db->table('el_courses');
        $builder->select('unique_id, course_name, course_image, course_description, course_visibility, course_full_description, language, certificate');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }

    }

    //Edit Course
    public function edit_course($course = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_courses');
        $builder->where('unique_id', $id);
        $query = $builder->update($course);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Course
    public function delete_course($id = NULL,$array=NULL)
    {
        $builder = $this->db->table('el_courses');
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

    //Get Course Status
    public function get_course_status($id = NULL)
    {
        $builder = $this->db->table('el_courses');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get Topic List
    public function gettopiclist($id = NULL)
    {
        $builder = $this->db->table('el_topics');
        $builder->select('el_topics.unique_id as t_unique_id, topic_name, sub_topic, chapter, topic_image, topic_docs, video_links, lab_video_links, topic_description, topic_visibility, el_courses.course_name');
        $builder->join('el_courses', 'el_courses.id = el_topics.course_id');
        $builder->where('el_courses.unique_id', $id);
        $builder->where('el_topics.is_del', 0);
        $builder->orderBy('el_topics.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return $query->getResult();
        }
        else
        {
            return FALSE;
        }
    }

    //Get Course Name
    public function get_course_name()
    {
        $builder = $this->db->table('el_courses');
        $builder->select('id, unique_id, course_name');
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Add topic
    public function add_topic($topic = NULL)
    {
        $builder = $this->db->table('el_topics');
        $result = $builder->insert($topic);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get Topic by id
    public function view_topic_by_id($id)
    {
        $builder = $this->db->table('el_topics');
        $builder->select('el_topics.unique_id as t_unique_id, course_id, topic_name, sub_topic, chapter, topic_image, topic_docs, video_links, lab_video_links, topic_description, topic_visibility');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Edit Topic
    public function edit_topic($topic = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_topics');
        $builder->where('unique_id', $id);
        $result = $builder->update($topic);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Topic
    public function delete_topic($id = NULL,$array=NULL)
    {
        $builder = $this->db->table('el_topics');
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

    //Get Topic Status
    public function get_topic_status($id = NULL)
    {
        $builder = $this->db->table('el_topics');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Enrolled Courses
    public function enrolledcourse_details_getdata($id = NULL, $classroom_id = NULL)
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
        $builder1->select('el_courses.id, unique_id, course_name, course_image');
        $builder1->join('el_batch_course', 'el_batch_course.course_id = el_courses.id');
        $builder1->whereIn('el_batch_course.batch_id', $builder); 
        $builder1->where('el_batch_course.is_del', 0);
        $builder1->where('el_courses.is_del', 0);
        $builder1->where('el_courses.course_visibility', 1);
        $builder1->orderBy('el_courses.id', 'DESC');

        $query = $builder1->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getResult();

            foreach ($data as $i => $dat)
            {
                $data[$i] = (array)$data[$i];

                $builder2 = $this->db->table('el_topics');
                $builder2->select('id');
                $builder2->where('course_id', $data[$i]['id']);
                $builder2->where('is_del', 0);
                $builder2->where('topic_visibility', 1);

                $query2 = $builder2->get();
                $total_topics = $query2->getNumRows();
                $data[$i]['total_topics'] = $total_topics;

                $builder3 = $this->db->table('el_topics_completed');
                $builder3->select('id');
                $builder3->where('course_id', $data[$i]['id']);

                $query3 = $builder3->get();
                $covered_topics = $query3->getNumRows();
                $data[$i]['covered_topics'] = $covered_topics;

                if($total_topics == 0)
                {
                    $data[$i]['percentage'] = 0;
                }
                else
                {
                    $data[$i]['percentage'] = floor(($covered_topics / $total_topics)*100);
                }
            }
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get All Topics
    public function get_topic_name($id = NULL, $account_id = NULL, $classroom_id = NULL)
    {
        $builder = $this->db->table('el_batches');
        $builder->select('el_batches.id');
        $builder->join('el_batch_assignment', 'el_batch_assignment.batch_id = el_batches.id');
        $builder->where('el_batches.visibility', 1);
        $builder->where('el_batches.is_del', 0);
        $builder->where('el_batches.classroom_id', $classroom_id);
        $builder->where('el_batch_assignment.account_id', $account_id);
        $builder->where('el_batch_assignment.is_del', 0);

        $builder1 = $this->db->table('el_courses');
        $builder1->select('el_courses.id');
        $builder1->join('el_batch_course', 'el_batch_course.course_id = el_courses.id');
        $builder1->whereIn('el_batch_course.batch_id', $builder); 
        $builder1->where('el_batch_course.is_del', 0);
        $builder1->where('el_courses.is_del', 0);
        $builder1->where('el_courses.course_visibility', 1);

        $query = $builder1->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_topics');
            $builder1->select('el_topics.unique_id, el_topics.topic_name, el_topics.sub_topic, el_topics.chapter, el_topics.topic_image, el_courses.course_name');
            $builder1->join('el_courses', 'el_courses.id = el_topics.course_id');
            $builder1->where('el_courses.id', $data['id']);
            $builder1->where('el_topics.topic_visibility', 1);
            $builder1->orderBy('el_topics.topic_name', 'ASC');
            $builder1->orderBy('el_topics.id', 'ASC');
            $builder1->where('el_topics.is_del', 0);
    
            $query1 = $builder1->get();
    
            if($query1->getNumRows() > 0)
            {
                $data1 = (array)$query1->getResult();
                return $data1;
            }
            else
            {
                return False;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Get Topic by id
    public function get_topic_by_id($id = NULL)
    {
        $builder = $this->db->table('el_topics');
        $builder->select('id, topic_name, sub_topic, chapter, topic_docs, video_links, lab_video_links, topic_description');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //get Topic by id student 
    public function get_topic_by_id_student($id = NULL)
    {
        $builder = $this->db->table('el_topics');
        $builder->select('id, topic_name, sub_topic, chapter, topic_docs, video_links, lab_video_links, topic_description');
        $builder->where('unique_id', $id);
        $builder->where('topic_visibility', 1);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get Previous Topic Student
    public function get_prev_topic_by_id_student($id = NULL)
    {
        $builder = $this->db->table('el_topics');
        $builder->select('id, topic_name, sub_topic, chapter, topic_docs, video_links, lab_video_links, topic_description');
        $builder->where('id<', $id);
        $builder->where('topic_visibility', 1);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get Previous Topic
    public function get_prev_topic_by_id($id = NULL)
    {
        $builder = $this->db->table('el_topics');
        $builder->select('id, topic_name, sub_topic, chapter, topic_docs, video_links, lab_video_links, topic_description');
        $builder->where('id<', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //get Next Topic Student
    public function get_next_topic_by_id_student($id = NULL)
    {
        $builder = $this->db->table('el_topics');
        $builder->select('id, topic_name, sub_topic, chapter, topic_docs, video_links, lab_video_links, topic_description');
        $builder->where('id>', $id);
        $builder->where('topic_visibility', 1);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get Next Topic
    public function get_next_topic_by_id($id = NULL)
    {
        $builder = $this->db->table('el_topics');
        $builder->select('id, topic_name, sub_topic, chapter, topic_docs, video_links, lab_video_links, topic_description');
        $builder->where('id>', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Record Topics Completed
    public function record_topics_completed($id = NULL, $unique_id = NULL, $topic = NULL)
    {
        $builder = $this->db->table('el_courses');
        $builder->select('id');
        $builder->where('unique_id', $unique_id);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_topics_completed');
            $builder1->select('id');
            $builder1->where('account_id', $id);
            $builder1->where('course_id', $data['id']);
            $builder1->where('topic_id', $topic);
            $query1 = $builder1->get();

            if($query1->getNumRows() == 0)
            {
                $array = array(
                    'account_id' => $id,
                    'course_id'  => $data['id'],
                    'topic_id'   => $topic
                );

                $builder2 = $this->db->table('el_topics_completed');
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

    //Record Hours Spent
    public function record_hours_spent($id = NULL, $unique_id = NULL, $topic = NULL)
    {
        $builder = $this->db->table('el_courses');
        $builder->select('id');
        $builder->where('unique_id', $unique_id);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_course_hours_spent');
            $builder1->select('time_min');
            $builder1->where('account_id', $id);
            $builder1->where('course_id', $data['id']);
            $builder1->where('topic_id', $topic);
            $builder1->where('date_on', date('Y-m-d'));
            $query1 = $builder1->get();

            if($query1->getNumRows() == 0)
            {
                $array = array(
                    'account_id' => $id,
                    'course_id'  => $data['id'],
                    'topic_id'   => $topic,
                    'time_min'   => 1,
                    'date_on'    => date('Y-m-d')
                );

                $builder2 = $this->db->table('el_course_hours_spent');
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
            else
            {
                $data1 = (array)$query1->getRow();

                $builder2 = $this->db->table('el_course_hours_spent');
                $builder2->select('id');
                $builder2->where('account_id', $id);
                $builder2->where('course_id', $data['id']);
                $builder2->where('topic_id', $topic);
                $builder1->where('date_on', date('Y-m-d'));
                $query2 = $builder2->update(array('time_min' => $data1['time_min']+1));

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
}