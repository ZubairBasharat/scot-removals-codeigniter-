<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pay_model extends CI_Model{

    public function __construct() {
        parent::__construct();
    }

    public function getSettings() {
        return $this->db->get('settings')->row();
    }

    public function getSaleByID($id) {
        return $this->db->get_where('sales', ['id' => $id])->row();
    }

    public function getCompanyByID($id) {
        return $this->db->get_where('companies', ['id' => $id])->row();
    }

    public function getSaleItems($sale_id) {
        $this->db->select('sale_items.*, products.image, products.details as details')
            ->join('products', 'products.id=sale_items.product_id', 'left')
            ->where('sale_id', $sale_id)->group_by('sale_items.id')->order_by('id', 'asc');
        return $this->db->get('sale_items')->result();
    }

    public function updateStatus($id, $status, $note = NULL) {

        $sale = $this->getSaleByID($id);
        $items = $this->getSaleItems($id);
        if ($note) { $note = $sale->note.'<p>'.$note.'</p>'; }

        if ($this->db->update('sales', array('sale_status' => $status, 'note' => $note), array('id' => $id))) {
            return true;
        }
        return false;
    }

}
