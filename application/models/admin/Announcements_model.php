<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcements_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($id=null)
    {
        if($id != null){
            $this->db->where('a_id', $id);
        }
        $query = $this->db->get('announcements');

        return $query->result();
    }

    public function create($data)
    {
        $query = $this->db->insert('announcements',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function get_ann($id = null)
    {
        return $row = $this->db->get_where('announcements', array('a_id' => $id))->row();
    }

    public function update($id,$data)
    {
        $this->db->where('a_id', $id);
        $this->db->update('announcements',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function delete($data,$id){

        $this->db->delete("announcements",$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    



}
