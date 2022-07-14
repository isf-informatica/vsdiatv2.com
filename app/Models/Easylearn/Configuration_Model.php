<?php

namespace App\Models\Easylearn;

use CodeIgniter\Model;

class Configuration_Model extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    //Get Security By ID
    public function get_security_name($name = NULL)
    {
        $builder = $this->db->table('el_security');
        $builder->select('status');
        $builder->where('security_name', $name);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get All Settings Category
    public function get_settings_category()
    {
        $builder = $this->db->table('el_settings_category');
        $builder->select('unique_id, category_name, description');
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

    //Add Setting form
    public function manage_setting_form($setting_data = NULL)
    {
        $builder = $this->db->table('el_settings_category');
        $result = $builder->insert($setting_data);

        if($result)
        {
            return TRUE;
        
        }
        else
        {
            return FALSE;
        }
    }

    //Get Setting By ID
    public function get_setting_category_by_id($id)
    {
        $builder = $this->db->table('el_settings_category');
        $builder->select('unique_id, category_name, description');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }
    
    //Edit Setting Category
    public function edit_setting_category($setting_data = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_settings_category');
        $builder->where('unique_id', $id);
        $result = $builder->update($setting_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    //Delete Setting Category
    public function delete_setting_category($id = NULL)
    {
        $builder = $this->db->table('el_settings_category');
        $builder->where('unique_id', $id);
        $result = $builder->update(array('is_del' => 1));

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    //Add Setting Value
    public function add_setting_value($setting_data = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_settings_category');
        $builder->select('id');
        $builder->where('unique_id', $id);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();

            $setting_data['category_id'] = $data['id'];

            $builder1 = $this->db->table('el_settings');
            $query1 = $builder1->insert($setting_data);
            
            if($query1)
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
    
    //Get Settings
    public function get_settings()
    {
        $builder = $this->db->table('el_settings');
        $builder->select('el_settings.unique_id, el_settings_category.category_name, value, purpose');
        $builder->join('el_settings_category', 'el_settings_category.id = el_settings.category_id');
        $builder->where('el_settings.is_del', 0);
        $builder->where('el_settings_category.is_del', 0);
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
    
    //Get Setting By ID
    public function get_setting_by_id($id)
    {
        $builder = $this->db->table('el_settings');
        $builder->select('el_settings.unique_id, el_settings_category.unique_id as category, value, purpose');
        $builder->join('el_settings_category', 'el_settings_category.id = el_settings.category_id');
        $builder->where('el_settings.unique_id', $id);
        $builder->where('el_settings.is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }
    
    //Delete Setting
    public function delete_setting($id = NULL)
    {
        $builder = $this->db->table('el_settings');
        $builder->where('unique_id', $id);
        $result = $builder->update(array('is_del' => 1));

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Edit Settings
    public function edit_setting_value($setting_data = NULL, $id = NULL, $setting_id = NULL)
    {
        $builder = $this->db->table('el_settings_category');
        $builder->select('id');
        $builder->where('unique_id', $setting_id);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();

            $setting_data['category_id'] = $data['id'];

            $builder = $this->db->table('el_settings');
            $builder->where('unique_id', $id);
            $result = $builder->update($setting_data);

            if($result)
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
    
    //Get Setting by Name
    public function get_settings_name($name = NULL)
    {
        $builder = $this->db->table('el_settings');
        $builder->select('value');
        $builder->join('el_settings_category', 'el_settings_category.id = el_settings.category_id');
        $builder->where('el_settings.is_del', 0);
        $builder->where('el_settings_category.is_del', 0);
        $builder->where('el_settings_category.category_name', $name);
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

    //Add Security form
    public function manage_security_form($security_data = NULL)
    {
        $builder = $this->db->table('el_security');
        $result = $builder->insert($security_data);

        if($result)
        {
            return TRUE;
        
        }
        else
        {
            return FALSE;
        }
    }
    
    //Get All Security
    public function get_security()
    {
        $builder = $this->db->table('el_security');
        $builder->select('unique_id, security_name, status, security_description');
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
    
    //Security Change Status
    public function security_status($array = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_security');
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
    
    //Get Security By ID
    public function get_security_by_id($id = NULL)
    {
        $builder = $this->db->table('el_security');
        $builder->select('unique_id, security_name, security_description');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }
    
    //Edit security Form
    public function edit_security_form($security_data = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_security');
        $builder->where('unique_id', $id);
        $result = $builder->update($security_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    //Delete Security
    public function delete_security($id = NULL)
    {
        $builder = $this->db->table('el_security');
        $builder->where('unique_id', $id);
        $query = $builder->update(array('is_del'=> 1));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return False;
        }
    }

    //Add Slider
    public function manage_slider_form($slider_data = NULL)
    {
        $builder = $this->db->table('el_slider');
        $result = $builder->insert($slider_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get Slider
    public function get_slider()
    {
        $builder = $this->db->table('el_slider');
        $builder->select('unique_id,slider_type,slider_image,slider_video');
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

    //Get Slider by ID
    public function get_slider_by_id($id = NULL)
    {
        $builder = $this->db->table('el_slider');
        $builder->select('unique_id,slider_type,slider_image,slider_video');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }

    }

    //Edit Slider
    public function edit_slider_form($slider_data = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_slider');
        $builder->where('unique_id', $id);
        $result = $builder->update($slider_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Slider
    public function delete_slider($id = NULL)
    {
        $builder = $this->db->table('el_slider');
        $builder->where('unique_id', $id);
        $query = $builder->update(array('is_del'=> 1));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return False;
        }
    }

    //Manage Aboutus
    public function manage_aboutus_form($aboutus_data = NULL)
    {
        $builder = $this->db->table('el_aboutus');
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $builder = $this->db->table('el_aboutus');
            $aboutus_insert = $builder->update($aboutus_data);

            if($aboutus_insert)
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
            $builder = $this->db->table('el_aboutus');
            $aboutus_insert = $builder->insert($aboutus_data);

            if($aboutus_insert)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
    }

    //get About Us
    public function get_about_us()
    {
        $builder = $this->db->table('el_aboutus');
        $builder->select('unique_id,heading,vision_image,vision,mission_image,mission,values_image,value_s,aboutus_description1,aboutus_description2,demovideo_path');

        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            $data = (array)$query->getRow();
            return $data;
        }
    }

    //Add Features
    public function manage_features_form($features_data = NULL)
    {
        $builder = $this->db->table('el_features');
        $result = $builder->insert($features_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //get Features
    public function get_features()
    {
        $builder = $this->db->table('el_features');
        $builder->select('unique_id,feature_image,feature,feature_description');
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

    //get Features by ID
    public function get_features_by_id($id = NULL)
    {
        $builder = $this->db->table('el_features');
        $builder->select('unique_id,feature_image,feature,feature_description');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Edit Features
    public function edit_features_form($features_data = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_features');
        $builder->where('unique_id', $id);
        $result = $builder->update($features_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Features
    public function delete_features($id = NULL)
    {
        $builder = $this->db->table('el_features');
        $builder->where('unique_id', $id);
        $query = $builder->update(array('is_del'=> 1));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return False;
        }
    }

    //Manage Benefits
    public function manage_benefits_form($benefits_data = NULL)
    {
        $builder = $this->db->table('el_benefits');
        $result = $builder->insert($benefits_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get Benefits
    public function get_benefits()
    {
        
        $builder = $this->db->table('el_benefits');
        $builder->select('unique_id, benefit, benefit_description');
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

    //Get Benefits by ID
    public function get_benefits_by_id($id = NULL)
    {
        $builder = $this->db->table('el_benefits');
        $builder->select('unique_id, benefit, benefit_description');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }

    }

    //Edit Benefits
    public function edit_benefits_form($benefits_data = NULL, $id = NULL){
        $builder = $this->db->table('el_benefits');
        $builder->where('unique_id', $id);
        $result = $builder->update($benefits_data);

        if($result){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    //Delete Benefits
    public function delete_benefits($id = NULL){

        $builder = $this->db->table('el_benefits');
        $builder->where('unique_id', $id);
        $query = $builder->update(array('is_del'=> 1));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return False;
        }
    }

    //Add services
    public function manage_services_form($services_data = NULL)
    {
        $builder = $this->db->table('el_services');
        $result = $builder->insert($services_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get All Services
    public function get_services()
    {
        $builder = $this->db->table('el_services');
        $builder->select('unique_id,service_image,service,service_description');
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

    //get service by id
    public function get_services_by_id($id = NULL)
    {
        $builder = $this->db->table('el_services');
        $builder->select('unique_id,service_image,service,service_description');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Edit Service
    public function edit_services_form($services_data = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_services');
        $builder->where('unique_id', $id);
        $result = $builder->update($services_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //delete Service
    public function delete_services($id = NULL)
    {
        $builder = $this->db->table('el_services');
        $builder->where('unique_id', $id);
        $query = $builder->update(array('is_del'=> 1));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return False;
        }
    }

    //Add Team
    public function manage_team_form($team_data = NULL)
    {
        $builder = $this->db->table('el_team');
        $result = $builder->insert($team_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get All Team
    public function get_team()
    {
        $builder = $this->db->table('el_team');
        $builder->select('unique_id, name, job_role, image_path, about, email_id, type');
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

    //Get Team by ID
    public function get_team_by_id($id = NULL)
    {
        $builder = $this->db->table('el_team');
        $builder->select('unique_id, name, job_role, image_path, facebook, twitter, instagram, linkedin, image_path, email_id, telephone_1, telephone_2, type, about');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }

    }

    //Edit Team
    public function edit_team_form($team_data = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_team');
        $builder->where('unique_id', $id);
        $result = $builder->update($team_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Team
    public function delete_team($id = NULL)
    {
        $builder = $this->db->table('el_team');
        $builder->where('unique_id', $id);
        $query = $builder->update(array('is_del'=> 1));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return False;
        }
    }

    //Add NewsFeed
    public function manage_newsfeed_form($newsfeed_data = NULL)
    {
        $builder = $this->db->table('el_newsfeed');
        $result = $builder->insert($newsfeed_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get ALL NewsFeed
    public function get_newsfeed()
    {
        $builder = $this->db->table('el_newsfeed');
        $builder->select('unique_id,newsfeed_headline,newsfeed_rsslink');
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

    //Get NewsFeed by ID
    public function get_newsfeed_by_id($id = NULL)
    {
        $builder = $this->db->table('el_newsfeed');
        $builder->select('unique_id,newsfeed_headline,newsfeed_rsslink');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Edit NewsFeed
    public function edit_newsfeed_form($newsfeed_data = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_newsfeed');
        $builder->where('unique_id', $id);
        $result = $builder->update($newsfeed_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete NewsFeed
    public function delete_newsfeed($id = NULL)
    {
        $builder = $this->db->table('el_newsfeed');
        $builder->where('unique_id', $id);
        $query = $builder->update(array('is_del'=> 1));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return False;
        }
    }

    //Add Testimonial
    public function manage_testimonial_form($testimonial_data = NULL)
    {
        $builder = $this->db->table('el_testimonials');
        $result = $builder->insert($testimonial_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get All Testimonial
    public function get_testimonial()
    {
        $builder = $this->db->table('el_testimonials');
        $builder->select('unique_id,testimonial_name,testimonial_jobrole,testimonial_image,testimonial_companywebsite,testimonial_description');
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

    //Get Testimonial by ID
    public function get_testimonial_by_id($id = NULL)
    {
        $builder = $this->db->table('el_testimonials');
        $builder->select('unique_id,testimonial_name,testimonial_jobrole,testimonial_image,testimonial_companywebsite,testimonial_description');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }

    }

    //Edit Testimonial
    public function edit_testimonial_form($testimonial_data = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_testimonials');
        $builder->where('unique_id', $id);
        $result = $builder->update($testimonial_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Testimonial
    public function delete_testimonial($id = NULL)
    {

        $builder = $this->db->table('el_testimonials');
        $builder->where('unique_id', $id);
        $query = $builder->update(array('is_del'=> 1));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return False;
        }
    }

    public function manage_document_form($document_data = NULL)
    {
        $builder = $this->db->table('el_project_documents');
        $result = $builder->insert($document_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function get_document()
    {
        $builder = $this->db->table('el_project_documents');
        $builder->select('unique_id,document_name,document_image,document_link');
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

    public function get_document_by_id($id = NULL)
    {
        $builder = $this->db->table('el_project_documents');
        $builder->select('unique_id,document_name,document_image,document_link');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    public function edit_document_form($document_data = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_project_documents');
        $builder->where('unique_id', $id);
        $result = $builder->update($document_data);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function delete_document($id = NULL){

        $builder = $this->db->table('el_project_documents');
        $builder->where('unique_id', $id);
        $query = $builder->update(array('is_del'=> 1));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return False;
        }
    }
}