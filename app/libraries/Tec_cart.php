<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tec_cart{

    public $product_id_rules = '\.a-z0-9_-';
    public $product_name_rules = '\s\S'; // '\w \-\.\:';
    public $product_name_safe = TRUE;
    public $cart_id = FALSE;
    protected $_cart_contents = array();

    public function __construct($params = array()) {
        $this->load->helper('cookie');
        if ($cart_id = get_cookie('cart_id', TRUE)) {
            $this->cart_id = $cart_id;
            $result = $this->db->get_where('cart_web', array('id' => $this->cart_id))->row();
            $this->_cart_contents = $result ? json_decode($result->data, true) : NULL;
        } else {
            $this->_setup();
        }
        if (empty($this->_cart_contents)) {
            $this->_empty();
        }
    }

    public function __get($var) {
        return get_instance()->$var;
    }

    private function _setup() {
        $this->load->helper('string');
        $val = md5(random_string('alnum', 16).microtime());
        set_cookie('cart_id', $val, 2592000);
        return $this->cart_id = $val;
    }

    private function _empty() {
        $this->_cart_contents = array('cart_total' => 0, 'total_items' => 0, 'total_unique_items' => 0);
    }

    public function cart_id() {
        return $this->cart_id;
    }

    public function insert($items = array()) {

        if (!is_array($items) OR count($items) === 0) {
            return FALSE;
        }

        $save_cart = FALSE;
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

        if (!preg_match('/^[' . $this->product_id_rules . ']+$/i', $items['id'])) {
            return FALSE;
        }

        if ($this->product_name_safe && !preg_match('/^[' . $this->product_name_rules . ']+$/i' . (UTF8_ENABLED ? 'u' : ''), $items['name'])) {
            return FALSE;
        }

        $items['price'] = (float) $items['price'];

        if (isset($items['options']) && count($items['options']) > 0) {
            $rowid = md5($items['id'] . serialize((array) $items['options']));
        } else {
            $rowid = md5($items['id']);
        }

        $old_quantity = isset($this->_cart_contents[$rowid]['qty']) ? (int) $this->_cart_contents[$rowid]['qty'] : 0;

        $items['rowid'] = $rowid;
        $items['qty'] += $old_quantity;
        $this->_cart_contents[$rowid] = $items;

        return $rowid;
    }

    public function update($items = array()) {
        if (!is_array($items) OR count($items) === 0) {
            return FALSE;
        }

        $save_cart = FALSE;
        if (isset($items['rowid'])) {
            if ($this->_update($items) === TRUE) {
                $save_cart = TRUE;
            }
        } else {
            foreach ($items as $val) {
                if (is_array($val) && isset($val['rowid'])) {
                    if ($this->_update($val) === TRUE) {
                        $save_cart = TRUE;
                    }
                }
            }
        }

        if ($save_cart === TRUE) {
            $this->_save_cart();
            return TRUE;
        }

        return FALSE;
    }

    protected function _update($items = array()) {
        if (!isset($items['rowid'], $this->_cart_contents[$items['rowid']])) {
            return FALSE;
        }

        if (isset($items['qty'])) {
            $items['qty'] = (float) $items['qty'];
            if ($items['qty'] == 0) {
                unset($this->_cart_contents[$items['rowid']]);
                return TRUE;
            }
        }

        $keys = array_intersect(array_keys($this->_cart_contents[$items['rowid']]), array_keys($items));
        if (isset($items['price'])) {
            $items['price'] = (float) $items['price'];
        }

        foreach (array_diff($keys, array('id', 'name')) as $key) {
            $this->_cart_contents[$items['rowid']][$key] = $items[$key];
        }

        return TRUE;
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

        if ($this->db->get_where('cart_web', array('id' => $this->cart_id))->num_rows() > 0) {
            return $this->db->update('cart_web', array('time' => time(), 'user_id' => $this->session->userdata('user_id'), 'data' => json_encode($this->_cart_contents)), array('id' => $this->cart_id));
        } else {
            return $this->db->insert('cart_web', array('id' => $this->cart_id, 'time' => time(), 'user_id' => $this->session->userdata('user_id'), 'data' => json_encode($this->_cart_contents)));
        }

    }

    public function total() {
        return $this->sma->formatDecimal($this->_cart_contents['cart_total'], 4);
    }

    public function shipping() {
        return $this->sma->formatDecimal($this->shop_settings->shipping, 4);
    }

    public function remove($rowid) {
        unset($this->_cart_contents[$rowid]);
        $this->_save_cart();
        return TRUE;
    }

    public function total_items($unique = FALSE) {
        return $unique ? $this->_cart_contents['total_unique_items'] : $this->_cart_contents['total_items'];
    }

    public function contents($newest_first = FALSE) {
        $cart = ($newest_first) ? array_reverse($this->_cart_contents) : $this->_cart_contents;
        unset($cart['total_items']);
        unset($cart['total_unique_items']);
        unset($cart['cart_total']);
        return $cart;
    }

    public function get_item($row_id) {
        return (in_array($row_id, array('total_items', 'cart_total'), TRUE) OR !isset($this->_cart_contents[$row_id]))
        ? FALSE
        : $this->_cart_contents[$row_id];
    }

    public function destroy() {
        $this->_empty();
        return $this->db->delete('cart_web', array('id' => $this->cart_id));
    }

    // Get cart with currency conversion
    function cart_data($re = false) {
        $citems = $this->contents();
        foreach($citems as &$value) {
            $value['price'] = $this->sma->convertMoney($value['price']);
            $value['subtotal'] = $this->sma->convertMoney($value['subtotal']);
        }
        $total = $this->sma->convertMoney($this->total(), FALSE, FALSE);
        $shipping = $this->sma->convertMoney($this->shipping(), FALSE, FALSE);
        $cart = array(
            'total_items' => $this->total_items(),
            'total_unique_items' => $this->total_items(TRUE),
            'contents' => $citems,
            'subtotal' => $this->sma->convertMoney($this->total()),
            'total' => $this->sma->formatMoney($total, $this->selected_currency->symbol),
            'shipping' => $this->sma->formatMoney($shipping, $this->selected_currency->symbol),
            'grand_total' => $this->sma->formatMoney(($this->sma->formatDecimal($total)+$this->sma->formatDecimal($shipping)), $this->selected_currency->symbol),
        );

        if ($re) {
            return $cart;
        }

        $this->sma->send_json($cart);
    }

}
