<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_ajax extends MY_Shop_Controller{

    function __construct() {
        parent::__construct();
        if ($this->Settings->mmode) { redirect('notify/offline'); }
        if ($this->shop_settings->hide_price) { redirect('/'); }
        if ($this->shop_settings->private && !$this->loggedIn) { redirect('/login'); }
    }

    function index() {
        $this->session->set_userdata('requested_page', $this->uri->uri_string());
        if ($this->cart->total_items() < 1) {
            $this->session->set_flashdata('reminder', lang('cart_is_empty'));
            shop_redirect('products');
        }
        $this->data['page_title'] = lang('shopping_cart');
        $this->page_construct('pages/cart', $this->data);
    }

    function checkout() {
        $this->session->set_userdata('requested_page', $this->uri->uri_string());
        if ($this->cart->total_items() < 1) {
            $this->session->set_flashdata('reminder', lang('cart_is_empty'));
            shop_redirect('products');
        }
        $this->data['addresses'] = $this->loggedIn ? $this->shop_model->getAddresses() : FALSE;
        $this->data['page_title'] = lang('checkout');
        $this->page_construct('pages/checkout', $this->data);
    }

    function add($product_id) {
        if ($this->input->is_ajax_request() || $this->input->post('quantity')) {
            $product = $this->shop_model->getProductForCart($product_id);
            $price = $this->sma->formatDecimal($product->price);
            $unit_price = $price;
            $id = $this->Settings->item_addition ? md5($product->id) : md5(microtime());

            $data = array(
                'id'            => $id,
                'product_id'    => $product->id,
                'qty'           => ($this->input->get('qty') ? $this->input->get('qty') : ($this->input->post('quantity') ? $this->input->post('quantity') : 1)),
                'name'          => $product->name,
                'slug'          => $product->slug,
                'code'          => $product->code,
                'price'         => $unit_price,
                'image'         => $product->image,
            );
            if ($this->cart->insert($data)) {
                if ($this->input->post('quantity')) {
                    $this->session->set_flashdata('message', lang('item_added_to_cart'));
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->cart->cart_data();
                }
            }
            $this->session->set_flashdata('error', lang('unable_to_add_item_to_cart'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function update($data = NULL) {
        if (is_array($data)) {
            return $this->cart->update($data);
        }
        if ($this->input->is_ajax_request()) {
            if ($rowid = $this->input->post('rowid', TRUE)) {
                $item = $this->cart->get_item($rowid);
                $product = $this->shop_model->getProductForCart($item['product_id']);
                $price = $this->sma->formatDecimal($product->price);
                $unit_price = $this->sma->formatDecimal($price);

                $data = array(
                    'rowid' => $rowid,
                    'price' => $price,
                    'qty' => $this->input->post('qty', TRUE),
                );
                if ($this->cart->update($data)) {
                    $this->sma->send_json(array('cart' => $this->cart->cart_data(true), 'status' => lang('success'), 'message' => lang('cart_updated')));
                }
            }
        }
    }

    function remove($rowid = NULL) {
        if ($rowid) {
            return $this->cart->remove($rowid);
        }
        if ($this->input->is_ajax_request()) {
            if ($rowid = $this->input->post('rowid', TRUE)) {
                if ($this->cart->remove($rowid)) {
                    $this->sma->send_json(array('cart' => $this->cart->cart_data(true), 'status' => lang('success'), 'message' => lang('cart_item_deleted')));
                }
            }
        }
    }

    function destroy() {
        if ($this->input->is_ajax_request()) {
            if ($this->cart->destroy()) {
                $this->session->set_flashdata('message', lang('cart_items_deleted'));
                $this->sma->send_json(array('redirect' => base_url()));
            } else {
                $this->sma->send_json(array('status' => lang('error'), 'message' => lang('error_occured')));
            }
        }
    }

}
