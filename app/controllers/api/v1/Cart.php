<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Cart extends REST_Controller {

    function __construct() {
        parent::__construct();

        $this->methods['index_get']['limit'] = 500;
        $this->load->api_model('cart_api');
        $this->load->api_model('sales_api');
    }

    public function index_get() {
        // $id = $this->get('id');
        // $this->order_received($id);exit;

        $add = $this->get('add');
        $fcm_token = $this->get('fcm_token') ? $this->get('fcm_token') : NULL;
        if($fcm_token != NULL)
            $customer_id = $this->cart_api->checkCustomerByFcmToken($fcm_token);
        else 
            $customer_id = NULL;

        if($add != NULL && $add != 0){
            if($customer_id != NULL && $customer_id != 0){
                $product_id = $this->get('product_id') ? $this->get('product_id') : NULL;
                if($product_id != NULL){
                    $this->add($product_id, $customer_id);
                }else{
                    echo json_encode(array('status' => false, 'message' => 'no product id give.'));
                }
            }else{
                echo json_encode(array('status' => false, 'message' => 'no customer id given.'));
            }
            exit;
        }

        $remove = $this->get('remove');
        if($remove != NULL && $remove != 0){
            if($customer_id != NULL && $customer_id != 0){
                $row_id = $this->get('row_id') ? $this->get('row_id') : NULL;
                if($row_id != NULL){
                    $this->remove($row_id, $customer_id);
                }else{
                    echo json_encode(array('status' => false, 'message' => 'no row id given.'));
                }
            }else{
                echo json_encode(array('status' => false, 'message' => 'no customer id given.'));
            }
            exit;
        }

        $destroy = $this->get('destroy');
        if($destroy != NULL && $destroy != 0){
            if($customer_id != NULL && $customer_id != 0){
                $this->destroy($customer_id);
            }else{
                echo json_encode(array('status' => false, 'message' => 'no customer id give.'));
            }
            exit;
        }

        $checkout = $this->get('checkout');
        if($checkout != NULL && $checkout != 0){
            if($customer_id != NULL && $customer_id != 0){
                $this->order($customer_id);
            }else{
                echo json_encode(array('status' => false, 'message' => 'no customer id give.'));
            }
            exit;
        }

        $filters = [
            'include' => $this->get('include') ? explode(',', $this->get('include')) : NULL,
            'order_by' => $this->get('order_by') ? explode(',', $this->get('order_by')) : ['id', 'decs'],
            'customer_id' => $this->get('customer_id') ? $this->get('customer_id') : NULL
        ];

        if ($customer_id === NULL) {

            if ($sales = $this->cart_api->getSales($filters)) {
                $sl_data = [];
                foreach ($sales as $sale) {
                    if (!empty($filters['include'])) {
                        foreach ($filters['include'] as $include) {
                            if ($include == 'items') {
                                $sale->items = $this->cart_api->getSaleItems($sale->id);
                            }
                        }
                    }
                    $sale->created_by = $this->cart_api->getUser($sale->created_by);
                    $sl_data[] = $this->setSale($sale);
                }

                $data =  [
                'data' => $sl_data,
                'limit' => (int) $filters['limit'],
                'start' => (int) $filters['start'],
                'total' => $this->cart_api->countSales($filters),
                ];
                $this->response($data, REST_Controller::HTTP_OK);

            } else {
                $this->response([
                    'message' => 'No sale record found.',
                    'status' => FALSE,
                    ], REST_Controller::HTTP_NOT_FOUND);
            }

        } else {
            
            if ($cart = $this->cart_api->cart_data(true, $customer_id)) {
                if (!empty($filters['include'])) {
                    foreach ($filters['include'] as $include) {
                        
                    }
                }

                $cart = $this->setCart($cart);
                $this->set_response($cart, REST_Controller::HTTP_OK);

            } else {
                $this->set_response([
                    'message' => 'Cart could not be found',
                    'status' => FALSE,
                    ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    protected function setCart($cart) {
        unset($cart->id, $cart->time);
        $cart = (array) $cart;
        ksort($cart);
        return $cart;
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////

    function add($product_id, $customer_id) {
        if ($this->input->get('quantity')) {
            $product = $this->cart_api->getProductForCart($product_id, $this->get('lang'));
            $unit_price = $this->sma->formatDecimal($product->price);
            $id = md5($product->id);

            $data = array(
                'id'             => $id,
                'product_id'     => $product->id,
                'product_details'=> $product->product_details,
                'details'        => $product->details,
                'qty'            => ($this->input->get('quantity') ? $this->input->get('quantity') : 1),
                'name'           => $product->name,
                'price'          => $unit_price,
                'image'          => $product->image_url
            );
            if ($this->get('lang') && $this->get('lang') != 'english') {
                $data['trans_name'] = $product->trans_name;
                $data['trans_product_details'] = $product->trans_product_details;
                $data['trans_details'] = $product->trans_details;
            }

            if ($this->cart_api->insert($data, $customer_id)) {
                if ($this->input->get('quantity')) {
                    echo json_encode(array('status' => true, 'message' => 'item added to card'));
                } else {
                    $this->cart->cart_data();
                }
                exit;
            }
            echo json_encode(array('status' => false, 'message' => 'item could not be added to card'));
        }
    }

    function remove($rowid = NULL, $customer_id) {
        if ($rowid) {
            if($this->cart_api->remove($rowid, $customer_id)){
                $this->sma->send_json(array('cart' => $this->cart_api->cart_data(true, $customer_id), 'status' => lang('success'), 'message' => lang('cart_item_deleted')));
            }
        }
    }

    function destroy($customer_id) {
        if ($customer_id) {
            if ($this->cart_api->destroy($customer_id)) {
                $this->session->set_flashdata('message', lang('cart_items_deleted'));
                $this->sma->send_json(array('status' => lang('success'), 'message' => 'destroyed'));
            } else {
                $this->sma->send_json(array('status' => lang('error'), 'message' => lang('error_occured')));
            }
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////
    // Add new Order form Cart
    function order($customer_id) {
        $guest_checkout = $this->get('checkout');
        if (!$guest_checkout && ($customer_id == NULL || $customer_id == 0 || $customer_id == '')) { $this->sma->send_json(array('status' => false, 'message' => 'Missing parameters')); }
        
        $name = $this->get('shipping_name') ? $this->get('shipping_name') : NULL;
        $lat = $this->get('lat');
        $lon = $this->get('lon');
        $phone = $this->get('shipping_phone');
        if($lat == '' || $lon == '' || $phone == ''){
            $this->sma->send_json(array('status' => false, 'message' => 'Missing Address details'));
        }

        if ($guest_checkout) {
            $address = [
                'name' => $name,
                'phone' => $phone,
                'lat' => $lat,
                'lon' => $lon,
                'city' => $this->get('shipping_city'),
                'state' => $this->get('shipping_state'),
                'country' => $this->get('shipping_country'),
            ];
            
            $customer = $this->site->getCompanyByID($customer_id);
            $note = $this->db->escape_str($this->get('comment'));
            $source = $this->get('os_type') ? $this->get('os_type') : NULL;
            $biller = $this->site->getCompanyByID($this->cart_api->getShopSettings()->biller); 

            $total = 0;
            foreach ($this->cart_api->contents($customer_id) as $item) {
                if ($product_details = $this->cart_api->getProductForCart($item['product_id'], $this->get('lang'))) {
                    $price = $product_details->price;

                    $item_net_price = $unit_price = $price;
                    $item_quantity = $item_unit_quantity = $item['qty'];

                    $subtotal = (($item_net_price * $item_unit_quantity));

                    $product = [
                        'product_id' => $product_details->id,
                        'product_code' => $product_details->code,
                        'product_name' => $product_details->name,
                        'net_unit_price' => $item_net_price,
                        'unit_price' => $this->sma->formatDecimal($item_net_price),
                        'quantity' => $item_quantity,
                        'unit_quantity' => $item_unit_quantity,
                        'discount' => NULL,
                        'item_discount' => 0,
                        'subtotal' => $this->sma->formatDecimal($subtotal),
                        'real_unit_price' => $price,
                    ];

                    if ($this->get('lang') && $this->get('lang') != 'english') {
                        $data['trans_name'] = $product->trans_name;
                        $data['trans_product_details'] = $product->trans_product_details;
                        $data['trans_details'] = $product->trans_details;
                    }

                    $products[] = ($product);
                    $total += $this->sma->formatDecimal(($item_net_price * $item_unit_quantity), 4);

                } else {
                    $this->sma->send_json(array('status' => false, 'message' => 'One of the given Product not found'));
                }
            }
            $shipping = $this->sma->formatDecimal(1, 4);
            $grand_total = $this->sma->formatDecimal(($total), 4) + $shipping;

            $data = [
                'date' => date('Y-m-d H:i:s'),
                'reference_no' => $this->site->getReference('so'),
                'customer_id' => $customer->id,
                'biller_id' => $biller->id,
                'biller' => $biller->name,
                'customer' => ($customer->name),
                'note' => $note,
                'total' => $total,
                'product_discount' => 0,
                'order_discount_id' => NULL,
                'order_discount' => 0,
                'total_discount' => 0,
                'grand_total' => $grand_total,
                'total_items' => $this->cart_api->total_items(),
                'sale_status' => 'pending',
                'created_by' => $customer->id,
                'api' => 1,
                'source' => $source,
                //'address_id' => $address->id,
                'payment_method' => 'Cash on Delivery',
            ];

            if ($sale_id = $this->cart_api->addSale($data, $products, $customer, $address)) {
                //$this->order_received($sale_id);
                //$this->load->library('sms');
                //$this->sms->newSale($sale_id);
                $this->cart_api->destroy($customer->id);
                
                $this->sma->send_json(array('status' => true, 'message' => lang('order_added')));
            }
        } else {
            $this->sma->send_json(array('status' => false, 'message' => lang('access_denied')));
        }
        
    }

    public function order_received($id = null, $hash = null){
        if ($inv = $this->sales_api->getSale(['id' => $id, 'customer' => NULL, 'customer_id' => NULL, 'start_date' => NULL, 'end_date' => NULL])) {
            $user = $inv->created_by ? $this->sales_api->getUser($inv->created_by) : NULL;
            $customer = $this->site->getCompanyByID($inv->customer_id);
            $biller = $this->site->getCompanyByID(3);
            $Settings = $this->site->get_setting();
            $this->load->library('parser');
            $parse_data = array(
                'reference_number' => $inv->reference_no,
                'contact_person' => $customer->name,
                'site_name' => $this->Settings->site_name,
                'logo' => '<img src="' . base_url() . 'assets/uploads/logos/' . $Settings->logo2 . '" alt="' . ($biller->company != '-' ? $biller->company : $biller->name) . '"/>',
            );
            $msg = file_get_contents('./themes/' . $this->Settings->theme . '/admin/views/email_templates/sale.html');
            $message = $this->parser->parse_string($msg, $parse_data);
            
            $btn_code = '<div id="payment_buttons" class="text-center margin010">';

            $btn_code .= '<div style="width:100%;"> Cash on Delivery</div><hr class="divider or">';

            $btn_code .= '<div class="clearfix"></div></div>';
            $message = $message . $btn_code;
            $subject = lang('new_order_received');
            $sent = $error = false;
            $admin_email = $Settings->default_email;
            
            try {
                if ($this->sma->send_email($admin_email, $subject, $message, null, null, null)) {
                    //delete_files($attachment);
                    $sent = true;
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
            return ['sent' => $sent, 'error' => $error];
        }
    }

    // Customer order/orders page
    function orders($id = NULL, $hash = NULL, $pdf = NULL, $buffer_save = NULL) {
        $hash = $hash ? $hash : $this->input->get('hash', TRUE);
        if (!$this->loggedIn && !$hash) { redirect('login'); }
        if ($this->Staff) { admin_redirect('sales'); }
        if ($pdf || $this->input->get('download')) {
            $id = $pdf ? $id : $this->input->get('download', TRUE);
            $hash = $hash ? $hash : $this->input->get('hash', TRUE);
            $order = $this->shop_model->getOrder(['id' => $id, 'hash' => $hash]);
            $this->data['inv'] = $order;
            $this->data['rows'] = $this->shop_model->getOrderItems($id);
            $this->data['customer'] = $this->site->getCompanyByID($order->customer_id);
            $this->data['biller'] = $this->site->getCompanyByID($order->biller_id);
            $this->data['address'] = $this->shop_model->getAddressByID($order->address_id);
            $this->data['return_sale'] = $order->return_id ? $this->shop_model->getOrder(['id' => $id]) : NULL;
            $this->data['return_rows'] = $order->return_id ? $this->shop_model->getOrderItems($order->return_id) : NULL;
            $this->data['Settings'] = $this->Settings;
            $html = $this->load->view($this->Settings->theme.'/shop/views/pages/pdf_invoice', $this->data, TRUE);
            if ($this->input->get('view')) {
                echo $html;
                exit;
            } else {
                $name = lang("invoice") . "_" . str_replace('/', '_', $order->reference_no) . ".pdf";
                if ($buffer_save) {
                    return $this->sma->generate_pdf($html, $name, $buffer_save, $this->data['biller']->invoice_footer);
                } else {
                    $this->sma->generate_pdf($html, $name, false, $this->data['biller']->invoice_footer);
                }
            }
        }
    }

}
