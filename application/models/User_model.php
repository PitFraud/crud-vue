<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class User_model extends CI_Model {

public function getUserTable()
    {
        $this->db->select('*');
        $this->db->from('user_table');
        $this->db->where('user_status',1);
        $query = $this->db->get();
    	return $query->result();
    }

public function addUserTable($data)
    {
        return $this->db->insert('user_table',$data);
    }

public function updateUserTable($data,$id)
    {
        $this->db->where('user_id', $id);
        $q = $this->db->update('user_table', $data);
        return $q;
    }  

public function deleteUserTable($id)
{
    $data = array('user_status' => 0);
    $this->db->where('user_id', $id);
    $q = $this->db->update('user_table',$data);
    return $q;
}

}

?>