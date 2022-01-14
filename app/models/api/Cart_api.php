<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_api extends CI_Model{

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
        
        if ($filters['customer_id']) {
            $this->db->where('user_id', $filters['customer_id']);
        } else {
            $this->db->order_by($filters['order_by'][0], $filters['order_by'][1] ? $filters['order_by'][1] : 'desc');
            $this->db->limit($filters['limit'], ($filters['start']-1));
        }

        return $this->db->get("cart")->result();
    }

    public function getSale($filters) {
        if (!empty($sales = $this->getSales($filters))) {
            return array_values($sales)[0];
        }
        return FALSE;
    }

    public function getSaleItems($sale_id) {
        return $this->db->get_where('sale_items', ['sale_id' => $sale_id])->result();
    }

    public function getProductForCart($id, $lang) {
        $uploads_url = base_url('assets/uploads/');

        if (isset($lang) && $lang != 'english') {
            $this->db->select("{$this->db->dbprefix('products')}.*, CONCAT('{$uploads_url}', {$this->db->dbprefix('products')}.image) as image_url, {$this->db->dbprefix('products_translation')}.trans_name, {$this->db->dbprefix('products_translation')}.trans_product_details, {$this->db->dbprefix('products_translation')}.trans_details");
            $this->db->join('products_translation', 'products.id = products_translation.product_id AND products_translation.trans_lang = "'.$lang.'"', 'left outer');
        }else{
            $this->db->select("{$this->db->dbprefix('products')}.*, CONCAT('{$uploads_url}', {$this->db->dbprefix('products')}.image) as image_url");
        }
        $this->db->where('products.id', $id);
        $q = $this->db->get('products', 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
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

    ////////////////////////////////////////////////////////////////////////////////////////

    public function insert($items = array(), $customer_id) {
        if (!is_array($items) OR count($items) === 0) {
            return FALSE;
        }

        $save_cart = FALSE;
        $this->_customer_id = $customer_id;
        if (isset($items['id'])) {
            if (($rowid = $this->_insert($items))) {
                $save_cart = TRUE;
            }
        } else {
            foreach ($items as $val) {
                if (is_array($val) && isset($val['id'])) {
                    if ($this->_insert($val)) {
                        $save_cart = TRUE;
                    }
                }
            }
        }

        if ($save_cart === TRUE) {
            $this->_save_cart();
            return isset($rowid) ? $rowid : TRUE;
        }

        return FALSE;
    }

    protected function _insert($items = array()) {
        if (!is_array($items) OR count($items) === 0) {
            return FALSE;
        }

        $items['name'] = htmlentities($items['name']);
        if (!isset($items['id'], $items['qty'], $items['name'])) {
            return FALSE;
        }

        $items['qty'] = (float) $items['qty'];
        if ($items['qty'] == 0) {
            return FALSE;
        }

        //$items['price'] = (float) $items['price'];
        $rowid = md5($items['id']);

        //print_r($this->_cart_contents[$rowid]);exit;
        if($this->_customer_id != NULL){
            $result = $this->db->get_where('cart', array('user_id' => $this->_customer_id))->row();
            $this->_cart_contents = $result ? json_decode($result->data, true) : NULL;
        }
        
        //$old_quantity = isset($this->_cart_contents[$rowid]['qty']) ? (int) $this->_cart_contents[$rowid]['qty'] : $items['qty'];

        $items['rowid'] = $rowid;
        //$items['qty'] += $old_quantity;
        //$items['qty'] = $old_quantity;

        //echo $items['qty'] .', '. $old_quantity;exit;
        $this->_cart_contents[$rowid] = $items;

        return $rowid;
    }

    protected function _save_cart() {
        $this->_cart_contents['cart_total'] = 0;
        $this->_cart_contents['total_items'] = 0;
        $this->_cart_contents['total_unique_items'] = 0;

        foreach ($this->_cart_contents as $key => $val) {
            if (!is_array($val) OR !isset($val['price'], $val['qty'])) {
                continue;
            }

            $this->_cart_contents['total_unique_items'] += 1;
            $this->_cart_contents['total_items'] += $val['qty'];
            $this->_cart_contents['cart_total'] += $this->sma->formatDecimal(($val['price'] * $val['qty']), 4);
            $this->_cart_contents[$key]['subtotal'] = $this->sma->formatDecimal(($this->_cart_contents[$key]['price'] * $this->_cart_contents[$key]['qty']), 4);
        }

        // if (count($this->_cart_contents) <= 4) {
        //     $this->db->delete('cart', array('id' => $this->cart_id));
        //     return FALSE;
        // }

        //print_r($this->_cart_contents);exit;

        if ($this->db->get_where('cart', array('user_id' => $this->_customer_id))->num_rows() > 0) {
            return $this->db->update('cart', array('time' => time(), 'user_id' => $this->_customer_id, 'data' => json_encode($this->_cart_contents)), array('user_id' => $this->_customer_id));
        } else {
            return $this->db->insert('cart', array( 'time' => time(), 'user_id' => $this->_customer_id, 'data' => json_encode($this->_cart_contents)));
        }

    }

    public function remove($rowid, $customer_id) {
        $this->_customer_id = $customer_id;
        if($this->_customer_id != NULL){
            $result = $this->db->get_where('cart', array('user_id' => $this->_customer_id))->row();
            $this->_cart_contents = $result ? json_decode($result->data, true) : NULL;
        }
        unset($this->_cart_contents[$rowid]);
        $this->_save_cart();
        return TRUE;
    }

    public function contents($customer_id, $is_from_products = false) {
        if($customer_id != NULL){
            $result = $this->db->get_where('cart', array('user_id' => $customer_id))->row();
            $this->_cart_contents = $result ? json_decode($result->data, true) : NULL;
        }

        $cart = $this->_cart_contents;
        if(empty($this->_cart_contents)){
            if($is_from_products) return false;
            $this->sma->send_json(array('status' => false, 'message' => 'No items found in customer cart'));
        }
        unset($cart['total_items']);
        unset($cart['total_unique_items']);
        unset($cart['cart_total']);
        return $cart;
    }

    function cart_data($re = false, $customer_id) {
        $citems = $this->contents($customer_id);
        if($citems){
            foreach($citems as &$value) {
                $value['price'] = $this->sma->formatMoney($value['price']);
                $value['subtotal'] = $this->sma->formatMoney($value['subtotal']);
            }
        }else{
            $citems = array();
        }
        
        $total = $this->sma->formatMoney($this->total(), FALSE, FALSE);
        $cart = array(
            'total_items' => $this->total_items(),
            'total_unique_items' => $this->total_items(TRUE),
            'contents' => $citems,
            'subtotal' => $this->sma->formatMoney(($this->sma->formatDecimal($this->total())), 'OMR '),
            'shipping' => $this->sma->formatMoney($this->shipping(), 'OMR '),
            'total' => $this->sma->formatMoney(($this->sma->formatDecimal($this->total())), 'OMR '),
            'grand_total' => $this->sma->formatMoney(($this->sma->formatDecimal($this->total()) + $this->shipping()), 'OMR '),
            // 'subtotal' => $this->total(),
            // 'total' => $this->total() . ' OMR',
            // 'grand_total' => $this->sma->formatDecimal($this->total()) . ' OMR'
        );

        if ($re) {
            return $cart;
        }

        $this->sma->send_json($cart);
    }

    public function total() {
        return $this->sma->formatDecimal($this->_cart_contents['cart_total'], 4);
    }

    public function shipping() {
        return $this->sma->formatDecimal(1, 4);
    }

    public function total_items($unique = FALSE) {
        return $unique ? $this->_cart_contents['total_unique_items'] : $this->_cart_contents['total_items'];
    }

    /////////////////////////////////////////////////////////////////////////////////////////

    public function destroy($customer_id) {
        $this->_customer_id = $customer_id;

        $this->_empty();
        return $this->db->delete('cart', array('user_id' => $this->_customer_id));
    }

    private function _empty() {
        $this->_cart_contents = array('cart_total' => 0, 'total_item_tax' => 0, 'total_items' => 0, 'total_unique_items' => 0);
    }

    ////////////////////////////////////////////////////////////////////////////////////////

    public function addSale($data, $items, $customer, $address){
        if (is_array($address) && !empty($address)) {
            $address['company_id'] = $data['customer_id'];
            $this->db->insert('addresses', $address);
            $data['address_id'] = $this->db->insert_id();
        }

        if ($this->db->insert('sales', $data)) {
            $sale_id = $this->db->insert_id();
            $this->site->updateReference('so');

            foreach ($items as $item) {
                $item['sale_id'] = $sale_id;
                $this->db->insert('sale_items', $item);
            }
            return $sale_id;
        }

        return false;
    }

    ////////////////////////////////////////////////////////////////////////////////////////

    public function getShopSettings() {
        return $this->db->get('shop_settings')->row();
    }

}
