<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($id = null)
    {
        //SELECT parts.p_id,COALESCE((qty - qtyout), 0 ) as balance from parts left outer join stocks on stocks.p_id = parts.p_id GROUP BY parts.p_id
        // $this->db->select('job_no,customers.c_id,c_name,item_desc,partno,date_in,status,images,drawing');
        // $this->db->from('in_and_out');
        // $this->db->join('customers', 'customers.c_id = in_and_out.c_id');
        // // $this->db->group_by("parts.p_id");
        // $query = $this->db->get();

        // return $query->result();

        if($id != null){
            $this->db->where('r_id', $id);
        }
        $query = $this->db->get('requests');

        return $query->result();
    }

    public function get_request($id = null)
    {
        return $row = $this->db->get_where('requests', array('r_id' => $id))->row();
    }

    public function create($data)
    {
        $query = $this->db->insert('requests',$data);
         $last_id = $this->db->insert_id();
        return ($this->db->affected_rows() != 1) ? false : $last_id;
    }

    public function item_create($data)
    {
        $query = $this->db->insert('request_items',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function item_delete($data)
    {
        $query = $this->db->delete('request_items',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update($id,$data)
    {
        $this->db->where('job_no', $id);
        $this->db->update('in_and_out',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function get_history($id=null)
    {
        if($id != null){
            $this->db->where('job_no', $id);
        }
        $query = $this->db->get('job_history');

        return $query->result();
    }

    public function get_traveller($id=null)
    {
        if($id != null){
            $this->db->where('job_no', $id);
        }
        $query = $this->db->get('job_traveler');

        return $query->result();
    }


    public function getjobs($keyword) {        
        $this->db->select('job_no,status');
        $this->db->where('job_no !=', $keyword);
        $this->db->from('in_and_out');
        return $this->db->get()->result_array();
    }


    public function check_jobno($keyword){
        $this->db->where('job_no', $keyword);
        $query = $this->db->get('in_and_out');
        
        return ($query->num_rows() > 0) ? true : false;
    }

    public function check_jobno_exist($keyword,$old){
        $this->db->where('job_no', $keyword);
        $this->db->where('old_job_no', $old);
        $query = $this->db->get('job_history');
        
        return ($query->num_rows() > 0) ? true : false;
    }

    public function check_testno_exist($keyword,$old){
        $this->db->where('job_no', $keyword);
        $this->db->where('test_no', $old);
        $query = $this->db->get('job_traveler');
        
        return ($query->num_rows() > 0) ? true : false;
    }


    public function history($data)
    {
        $query = $this->db->insert('job_history',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function insertTraveller($data)
    {
        $query = $this->db->insert('job_traveler',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function get_request_items($id=null)
    {
        if($id != null){
            $this->db->where('r_id', $id);
        }
        $query = $this->db->get('request_items');

        return $query->result();
    }

    public function approve_admin($id=null){
        $this->db->set('admin_approval', '1', FALSE);
        $this->db->where('r_id', $id);
        $this->db->update('requests');

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function reject_admin($id=null){
        $this->db->set('admin_approval', '0', FALSE);
        $this->db->where('r_id', $id);
        $this->db->update('requests');

        return ($this->db->affected_rows() != 1) ? false : true;
    }

     
    

    

    



}
