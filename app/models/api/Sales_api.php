<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_api extends CI_Model{

    protected $_cart_contents = array();
    protected $_customer_id = false;
    public $cart_id = FALSE;

    public function __construct() {
        parent::__construct();
    }

    public function countSales($filters = [], $ref = NULL) {
        if ($filters['customer']) {
            $this->db->where('customer', $filters['customer']);
        }
        if ($filters['customer_id']) {
            $this->db->where('customer_id', $filters['customer_id']);
        }
        if ($filters['start_date']) {
            $this->db->where('date >=', $filters['start_date']);
        }
        if ($filters['end_date']) {
            $this->db->where('date <=', $filters['end_date']);
        }
        $this->db->from('sales');
        return $this->db->count_all_results();
    }

    public function getSales($filters = []) {
        if ($filters['customer']) {
            $this->db->where('customer', $filters['customer']);
        }
        if ($filters['customer_id']) {
            $this->db->where('customer_id', $filters['customer_id']);
        }
        if ($filters['start_date']) {
            $this->db->where('date >=', $filters['start_date']);
        }
        if ($filters['end_date']) {
            $this->db->where('date <=', $filters['end_date']);
        }
        if ($filters['id']) {
            $this->db->where('id', $filters['id']);
        } else {
            //$this->db->order_by($filters['order_by'][0], $filters['order_by'][1] ? $filters['order_by'][1] : 'desc');
            $this->db->order_by('id', 'desc');
            $this->db->limit($filters['limit'], ($filters['start']-1));
        }

        return $this->db->get("sales")->result();
    }

    public function getSale($filters) {
        if (!empty($sales = $this->getSales($filters))) {
            return array_values($sales)[0];
        }
        return FALSE;
    }

    public function getSaleItems($sale_id, $lang) {
        $uploads_url = base_url('assets/uploads/');
        if (isset($lang) && $lang != 'english') {
            $this->db->select("{$this->db->dbprefix('sale_items')}.*, CONCAT('{$uploads_url}', {$this->db->dbprefix('products')}.image) as image_url, {$this->db->dbprefix('products')}.product_details, {$this->db->dbprefix('products')}.details, {$this->db->dbprefix('products_translation')}.trans_name, {$this->db->dbprefix('products_translation')}.trans_product_details, {$this->db->dbprefix('products_translation')}.trans_details");
            $this->db->join('products_translation', 'sale_items.product_id = products_translation.product_id AND products_translation.trans_lang = "'.$lang.'"', 'left outer');
            $this->db->join('products', 'sale_items.product_id = products.id', 'left outer');
        }else{
            $this->db->select("{$this->db->dbprefix('sale_items')}.*, CONCAT('{$uploads_url}', {$this->db->dbprefix('products')}.image) as image_url, {$this->db->dbprefix('products')}.product_details, {$this->db->dbprefix('products')}.details");
            $this->db->join('products', 'sale_items.product_id = products.id', 'left outer');
        }
        $this->db->where('sale_id', $sale_id);
        return $this->db->get('sale_items')->result();
    }

    public function getUser($id) {
        $uploads_url = base_url('assets/uploads/');
        $this->db->select("CONCAT('{$uploads_url}', avatar) as avatar_url, email, name, gender, id, username");
        return $this->db->get_where('users', ['id' => $id], 1)->row();
    }

    /////////////////////////////////////////////////////

    public function cancel($id){
        return $this->db->update('sales', array('sale_status' => 'cancel'), array('id' => $id));
    }

    public function checkCustomerByFcmToken($fcm_token) {
        $this->db->select("{$this->db->dbprefix('companies')}.id")
        ->where('companies.fcm_token', $fcm_token);
        $q = $this->db->get('companies', 1);
        if ($q->num_rows() > 0) {
            return $q->row()->id;
        }else{
            $this->db->insert('companies', array('fcm_token' => $fcm_token, 'group_name' => 'customer', 'created_at' => date('Y-m-d H:i:s') ));
            return $this->db->insert_id();
        }
    }

}