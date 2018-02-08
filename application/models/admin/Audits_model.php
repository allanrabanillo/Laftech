<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audits_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($id=null)
    {
        if($id != null){
            $this->db->where('id', $id);
        }
       
        $this->db->from('logs');
        $this->db->join('users', 'users.id = logs.user_id');
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }
    public function get_all_by_user($id=null)
    {
        
        $this->db->from('logs');
        $this->db->join('users', 'users.id = logs.user_id');
        $this->db->where('users.id', $id);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }


    



}
