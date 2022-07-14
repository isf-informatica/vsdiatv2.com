<?php

namespace App\Models\Easylearn;

use CodeIgniter\Model;

class Dashboard_Model extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    //Store Secret Key
    public function store_qr($id = null, $secret = null)
    {
        $builder = $this->db->table('el_store_secret');
        $builder->select('id');
        $builder->where('account_id', $id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $builder = $this->db->table('el_store_secret');
            $builder->where('account_id', $id);
            $query = $builder->update(array('secret' => $secret));

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
            $builder = $this->db->table('el_store_secret');
            $query = $builder->insert(array('account_id' => $id, 'secret' => $secret));

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

    //Retrive Secret Key
    public function retrive_qr($id = Null)
    {
        $builder = $this->db->table('el_store_secret');
        $builder->select('secret');
        $builder->where('account_id', $id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return (array)$query->getRow();
        }
        else
        {
            return FALSE;
        }
    }

    //Update Account Status
    public function update_account_status($id = Null)
    {
        $builder = $this->db->table('el_accounts');
        $builder->where('id', $id);
        $query = $builder->update(array('mfa_status' => 1));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get Profile Id
    public function profile_by_id($id = NULL)
    {
        $builder = $this->db->table('el_account_details');
        $builder->select('el_accounts.username, el_accounts.email, el_accounts.permissions, el_account_details.*');
        $builder->join('el_accounts', 'el_accounts.id = el_account_details.account_id');
        $builder->where('el_accounts.id', $id);
        $builder->where('el_accounts.is_del', 0);

        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return (array)$query->getRow();
        }
        else
        {
            return FALSE;
        }
    }

    //Update Profile
    public function update_profile($data = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_account_details');
        $builder->where('account_id', $id);
        $query = $builder->update($data);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //For Whiteboard
	public function Check_Whiteboard($id = Null, $username = NULL)
    {
		$builder = $this->db->table('el_miro_whiteboard');
        $builder->select('whiteboard_link');
        $builder->where('account_id', $id);
        $query = $builder->get();
		
		if($query->getNumRows()>0)
        {
			$data = (array)$query->getRow();
            return $data["whiteboard_link"];
        }
        else
        {
			$url = "https://api.miro.com/v2/boards";

			$postdata = '{
							"name":"Welcome '.$username.'",
							"policy":{
								"permissionsPolicy":{
									"collaborationToolsStartAccess":"all_editors",
									"copyAccess":"anyone",
									"sharingAccess":"team_members_with_editing_rights"
								},
								"sharingPolicy":{
									"access":"edit",
									"inviteToAccountAndBoardLinkAccess":"editor",
									"organizationAccess":"private",
									"teamAccess":"edit"
								}
							}
						}';
							
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true); 

			$headers = array(
				"Accept : application/json",
				"Authorization : Bearer eyJtaXJvLm9yaWdpbiI6ImV1MDEifQ_Ulea0ZE79rO28oOei_GeT8xhZF0",
				"Content-Type : application/json"
			);

			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);

			//for debug only!
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT, 10); 
			curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);

			$resp = curl_exec($curl);
			curl_close($curl);
			
			if(!$resp)
            {
				return "Some Error Occured while creating Whiteboard";
			}
			
			$resp = json_decode($resp,true);
			$resp_link = $resp["viewLink"];
			
            $builder1 = $this->db->table('el_miro_whiteboard');
            $query1 = $builder1->insert(array('account_id' => $id, 'whiteboard_link' => $resp_link));
			
			if($query1)
            {
                return $resp_link;
            }
            else
            {
                return "Not Inserted";
            }
        }
	}

    //Update Documents
    public function updatedocument($email = NULL, $uac_doc = NULL, $pl_doc = NULL)
    {    
        $builder = $this->db->table('el_school');
        $builder->where('administrator_email', $email);
        $query = $builder->update(array('status' => 'Document Unverified', 'pl_doc' => $pl_doc, 'uac_doc' => $uac_doc));

        $builder1 = $this->db->table('el_accounts');
        $builder1->where('email', $email);
        $query1 = $builder1->update(array('status' => 'Document Unverified'));

        if($query && $query1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Update Jr College Documents
    public function update_jrclg_document($email = NULL, $uac_doc = NULL, $pl_doc = NULL)
    {    
        $builder = $this->db->table('el_jr_clg');
        $builder->where('admin_email', $email);
        $query = $builder->update(array('status' => 'Document Unverified', 'pl_doc' => $pl_doc, 'uac_doc' => $uac_doc));

        $builder1 = $this->db->table('el_accounts');
        $builder1->where('email', $email);
        $query1 = $builder1->update(array('status' => 'Document Unverified'));

        if($query && $query1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    // Get All Lecturer
    public function get_alllecturer_name($reg_id = NULL)
    {
        $builder = $this->db->table('el_accounts');
        $builder->select('id, username');
        $builder->where('permissions', 'Mentor');
        $builder->where('is_del', 0);
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
    
    // Get Lecturer
    public function get_lecturer_name_reg($reg_id = NULL)
    {
        $builder = $this->db->table('el_accounts');
        $builder->select('id, username');
        $builder->where('reg_id', $reg_id);
        $builder->where('permissions', 'Mentor');
        $builder->where('is_del', 0);
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
}