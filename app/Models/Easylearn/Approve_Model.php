<?php

namespace App\Models\Easylearn;

use CodeIgniter\Model;

class Approve_Model extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    //Get All School requests
    public function schoolrequests($region_type = null, $region_name = null, $status = null)
    {
        $builder = $this->db->table('el_school');
        $builder->select('unique_id, school_name, school_type, board_type, school_medium, school_code');
        $builder->where('status', $status);
        $builder->where('is_del', 0);

        if ($region_type == 'Country') {
            $builder->where('country', $region_name);
        } elseif ($region_type == 'State') {
            $builder->where('state', $region_name);
        } elseif ($region_type == 'City') {
            $builder->where('city', $region_name);
        }
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            return $query->getResult();
        } else {
            return false;
        }
    }

    //get Scholl Request by id
    public function schoolrequests_id($id)
    {
        $builder = $this->db->table('el_school');
        $builder->select('unique_id, school_name, school_type, board_type, school_medium, school_code, is_coed, gender_type, school_logo, school_image, phone_1, phone_2, school_description, administrator_name, administrator_email, address_line_1, address_line_2, country, state, city, postal_code, pl_doc, uac_doc');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $builder->where('status', 'Unverified');
        $builder->orWhere('status', 'Document Unverified');

        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            return (array) $query->getRow();
        } else {
            return false;
        }
    }

    //School Disapprove
    public function school_disapprove($id = null)
    {
        $builder = $this->db->table('el_school');
        $builder->select('id');
        $builder->where('unique_id', $id);
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            $data = (array) $query->getRow();

            $builder1 = $this->db->table('el_school');
            $builder1->where('id', $data['id']);
            $query1 = $builder1->update(array('is_del' => 1));

            if ($query1) {
                $builder2 = $this->db->table('el_registration');
                $builder2->select('id');
                $builder2->where('reg_id', $data['id']);
                $builder2->where('type', 'School');
                $query2 = $builder2->get();

                if ($query2->getNumRows() > 0) {
                    $data2 = (array) $query2->getRow();

                    $builder3 = $this->db->table('el_registration');
                    $builder3->where('id', $data2['id']);
                    $query3 = $builder3->update(array('is_del' => 1));

                    if ($query3) {
                        $builder4 = $this->db->table('el_accounts');
                        $builder4->select('id');
                        $builder4->where('reg_id', $data2['id']);
                        $builder4->where('permissions', 'School');
                        $query4 = $builder4->get();

                        if ($query4->getNumRows() > 0) {
                            $data4 = (array) $query4->getRow();

                            $builder5 = $this->db->table('el_accounts');
                            $builder5->where('id', $data4['id']);
                            $query5 = $builder5->update(array('is_del' => 1));

                            if ($query5) {
                                $builder6 = $this->db->table('el_account_details');
                                $builder6->where('account_id', $data4['id']);
                                $query6 = $builder6->update(array('is_del' => 1));

                                if ($query6) {
                                    return true;
                                } else {
                                    return false;
                                }
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //School Approve
    public function school_approve($id = null)
    {
        $builder = $this->db->table('el_school');
        $builder->select('id, status');
        $builder->where('unique_id', $id);
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            $data = (array) $query->getRow();

            if ($data['status'] == 'Unverified') {
                $builder1 = $this->db->table('el_school');
                $builder1->where('id', $data['id']);
                $query1 = $builder1->update(array('status' => 'Document Upload'));
            } else {
                $builder1 = $this->db->table('el_school');
                $builder1->where('id', $data['id']);
                $query1 = $builder1->update(array('status' => 'Verified'));
            }

            if ($query1) {
                $builder2 = $this->db->table('el_accounts');
                $builder2->select('el_accounts.id');
                $builder2->join('el_registration', 'el_registration.id = el_accounts.reg_id');
                $builder2->where('el_registration.reg_id', $data['id']);
                $builder2->where('el_registration.type', 'School');
                $builder2->where('el_accounts.permissions', 'School');
                $query2 = $builder2->get();

                if ($query2->getNumRows() > 0) {
                    $data2 = (array) $query2->getRow();

                    if ($data['status'] == 'Unverified') {
                        $builder3 = $this->db->table('el_accounts');
                        $builder3->where('id', $data2['id']);
                        $query3 = $builder3->update(array('status' => 'Document Upload'));
                    } else {
                        $builder3 = $this->db->table('el_accounts');
                        $builder3->where('id', $data2['id']);
                        $query3 = $builder3->update(array('status' => 'Verified'));
                    }

                    if ($query3) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Get All Jr College requests
    public function jrclg_requests($region_type = null, $region_name = null, $status = null)
    {
        $builder = $this->db->table('el_jr_clg');
        $builder->select('unique_id, clg_name, clg_type, clg_board_type, clg_medium, clg_code');
        $builder->where('status', $status);
        $builder->where('is_del', 0);

        if ($region_type == 'Country') {
            $builder->where('country', $region_name);
        } elseif ($region_type == 'State') {
            $builder->where('state', $region_name);
        } elseif ($region_type == 'City') {
            $builder->where('city', $region_name);
        }
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            return $query->getResult();
        } else {
            return false;
        }
    }

    //get jr clg request id
    public function jrclgrequests_id($id)
    {

        $builder = $this->db->table('el_jr_clg');
        $builder->select('unique_id, clg_name, clg_type, clg_board_type, clg_medium, clg_code, is_coed, clg_gender_type, clg_logo, clg_image, phone_1, phone_2, clg_streams, clg_descp, admin_name,
            admin_email, addr1, addr2, country, state, city, pcode, status, pl_doc, uac_doc');

        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $builder->where('status', 'Unverified');
        $builder->orWhere('status', 'Document Unverified');
        $query = $builder->get();

        if ($query->getNumRows() > 0) {

            return (array) $query->getRow();
        } else {
            return false;
        }

    }

    //Jr College Approve
    public function jrclg_approve($id = null)
    {
        $builder = $this->db->table('el_jr_clg');
        $builder->select('id, status');
        $builder->where('unique_id', $id);
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            $data = (array) $query->getRow();

            if ($data['status'] == 'Unverified') {
                $builder1 = $this->db->table('el_jr_clg');
                $builder1->where('id', $data['id']);
                $query1 = $builder1->update(array('status' => 'Document Upload'));
            } else {
                $builder1 = $this->db->table('el_jr_clg');
                $builder1->where('id', $data['id']);
                $query1 = $builder1->update(array('status' => 'Verified'));
            }

            if ($query1) {
                $builder2 = $this->db->table('el_accounts');
                $builder2->select('el_accounts.id');
                $builder2->join('el_registration', 'el_registration.id = el_accounts.reg_id');
                $builder2->where('el_registration.reg_id', $data['id']);
                $builder2->where('el_registration.type', 'Jr College');
                $builder2->where('el_accounts.permissions', 'Jr College');
                $query2 = $builder2->get();

                if ($query2->getNumRows() > 0) {
                    $data2 = (array) $query2->getRow();

                    if ($data['status'] == 'Unverified') {
                        $builder3 = $this->db->table('el_accounts');
                        $builder3->where('id', $data2['id']);
                        $query3 = $builder3->update(array('status' => 'Document Upload'));
                    } else {
                        $builder3 = $this->db->table('el_accounts');
                        $builder3->where('id', $data2['id']);
                        $query3 = $builder3->update(array('status' => 'Verified'));
                    }

                    if ($query3) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Jr College Disapprove
    public function jrclg_disapprove($id = null)
    {
        $builder = $this->db->table('el_jr_clg');
        $builder->select('id');
        $builder->where('unique_id', $id);
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            $data = (array) $query->getRow();

            $builder1 = $this->db->table('el_jr_clg');
            $builder1->where('id', $data['id']);
            $query1 = $builder1->update(array('is_del' => 1));

            if ($query1) {
                $builder2 = $this->db->table('el_registration');
                $builder2->select('id');
                $builder2->where('reg_id', $data['id']);
                $builder2->where('type', 'Jr College');
                $query2 = $builder2->get();

                if ($query2->getNumRows() > 0) {
                    $data2 = (array) $query2->getRow();

                    $builder3 = $this->db->table('el_registration');
                    $builder3->where('id', $data2['id']);
                    $query3 = $builder3->update(array('is_del' => 1));

                    if ($query3) {
                        $builder4 = $this->db->table('el_accounts');
                        $builder4->select('id');
                        $builder4->where('reg_id', $data2['id']);
                        $builder4->where('permissions', 'Jr College');
                        $query4 = $builder4->get();

                        if ($query4->getNumRows() > 0) {
                            $data4 = (array) $query4->getRow();

                            $builder5 = $this->db->table('el_accounts');
                            $builder5->where('id', $data4['id']);
                            $query5 = $builder5->update(array('is_del' => 1));

                            if ($query5) {
                                $builder6 = $this->db->table('el_account_details');
                                $builder6->where('account_id', $data4['id']);
                                $query6 = $builder6->update(array('is_del' => 1));

                                if ($query6) {

                                    return true;

                                } else {

                                    return false;

                                }
                            } else {

                                return false;

                            }
                        } else {

                            return false;

                        }
                    } else {

                        return false;

                    }
                } else {

                    return false;

                }
            } else {

                return false;

            }
        } else {

            return false;
            
        }
    }

    //Mentor Requests
    public function mentorrequests($region_type = null, $region_name = null)
    {
        $builder = $this->db->table('el_mentor_registration');
        $builder->select('unique_id, mentor_name, DATE_FORMAT(dob, "%d-%m-%Y")  AS dob, experience, field_of_expertise');
        $builder->where('status', 'Unverified');
        $builder->where('is_del', 0);

        if ($region_type == 'Country') 
        {
            $builder->where('country', $region_name);
        } 
        elseif ($region_type == 'State') 
        {
            $builder->where('state', $region_name);
        } 
        elseif ($region_type == 'City') 
        {
            $builder->where('city', $region_name);
        }

        $builder->orderBy('id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get Mentor Requests
    public function getmentorrequests($id = NULL)
    {
        $builder = $this->db->table('el_mentor_registration');
        $builder->select('mentor_name, field_of_expertise, contact_number1, contact_number2, email, experience, skills, description, address_line1, address_line2, city, state, country, pincode, photo_url, resume_url, DATE_FORMAT(dob, "%d-%m-%Y")  AS dob');
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

    //Disapprove Mentor Requests
    public function disapprovementorrequests($email = NULL)
    {
        $builder = $this->db->table('el_mentor_registration');
        $builder->where('email', $email);
        $query = $builder->update(array('is_del'=> 1));

        $builder1 = $this->db->table('el_accounts');
        $builder1->select('id');
        $builder1->where('email', $email);
        $query1 = $builder1->get();

        if($query1->getNumRows() > 0)
        {
            $data = (array)$query1->getRow();

            $builder2 = $this->db->table('el_accounts');
            $builder2->where('email', $email);
            $query2 = $builder2->update(array('is_del'=> 1));

            $builder3 = $this->db->table('el_account_details');
            $builder3->where('account_id', $data['id']);
            $query3 = $builder3->update(array('is_del'=> 1));
        
            if($query && $query2 && $query3)
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

    //Approve MentorRequests
    public function updatementorrequests($email)
    {
        $builder = $this->db->table('el_mentor_registration');
        $builder->where('email', $email);
        $query = $builder->update(array('status'=> 'Verified'));

        $builder1 = $this->db->table('el_accounts');
        $builder1->where('email', $email);
        $query1 = $builder1->update(array('status'=> 'Verified'));
    
        if($query && $query1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}
