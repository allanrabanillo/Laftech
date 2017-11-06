<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parts_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($id=null)
    {
        if($id != null){
            $this->db->where('p_id', $id);
        }
        $query = $this->db->get('parts');

        return $query->result();
    }

    public function create($data)
    {
        $query = $this->db->insert('parts',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function get_part($id = null)
    {
        
        return $row = $this->db->get_where('parts', array('p_id' => $id))->row();
    }

    public function update($id,$data)
    {
        $this->db->where('p_id', $id);
        $this->db->update('parts',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function check_part($keyword){
        $this->db->where('p_desc', $keyword);
        $query = $this->db->get('parts');
        
        return ($query->num_rows() > 0) ? true : false;
    }

    



}
