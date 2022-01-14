<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Floors_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function getAllFloors(){
        $q = $this->db->get('floors');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getFloorCount(){
        $this->db->select($this->db->dbprefix('floors') . '.id as id');
        $q = $this->db->get($this->db->dbprefix('floors'));
        
        if (count($q->result()) > 0) {
            return count($q->result());
        }
        return 0;
    }

    public function getFloorByID($id){
        $q = $this->db->get_where('floors', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function addFloor($data){
        if ($this->db->insert('floors', $data)) {
            $product_id = $this->db->insert_id();

            return $result = $this->db->insert_id();
        }
        return false;

    }

    public function updateFloor($id, $data){
        if ($this->db->update('floors', $data, array('id' => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteFloor($id){
        if ($this->db->delete('floors', array('id' => $id))) {
            return true;
        }
        return FALSE;
    }

}
