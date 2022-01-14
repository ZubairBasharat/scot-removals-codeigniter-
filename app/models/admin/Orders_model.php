<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_model extends CI_Model{

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

    public function getOrderDetailsByID($id){
        $this->db->select("{$this->db->dbprefix('order_details')}.*, o.trackingID")
        ->join('order o', 'order_details.order_id=o.id', 'left')
        ->where('order_details.order_id', $id);

        $q = $this->db->get("order_details");

        if ($q->num_rows() > 0) {
            return $q->result();
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

    public function deleteOrder($id){
        if ($this->db->delete('orders', array('id' => $id))) {
            $this->db->delete('order_details', array('order_id' => $id));
            return true;
        }
        return FALSE;
    }

}
