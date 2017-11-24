<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receiving_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($id=null)
    {
        if($id != null){
            $this->db->where('s_id', $id);
        }
        $query = $this->db->get('stocks');

        return $query->result();
    }

    public function create($data)
    {
        $query = $this->db->insert('stocks',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function get_received($id = null)
    {
        $this->db->select('parts.p_desc,stocks.qty,stocks.s_date');
        $this->db->from('stocks');
        $this->db->where("stocks.s_id",$id);
        $this->db->join('parts', 'parts.p_id = stocks.p_id');
        return $this->db->get()->row();
    }

    public function update($id,$data)
    {
        $this->db->where('s_id', $id);
        $this->db->update('stocks',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function GetRow($keyword) {        
        $this->db->select('p_id,p_desc,cat_name');
        $this->db->from('parts');
        $this->db->join('categories', 'categories.cat_id = parts.cat_id');
        return $this->db->get()->result_array();
    }

    public function delete($data,$id){

        $query = $this->db->query("SELECT s_id from request_items_out where s_id = $id");
        if($query->num_rows() > 0) {
            return false;
        }

        $this->db->delete("stocks",$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }


    

    



}
