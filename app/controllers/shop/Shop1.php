<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends MY_Shop_Controller{

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library("session");
        $this->load->helper('url');
        // $checkurl = $this->uri->segment(2);
        // if($checkurl == "" || $checkurl == null){
        //     $this->session->unset_userdata('pickup_location');
        //     $this->session->unset_userdata('drop_location');
        //     $this->session->unset_userdata('p_price');
        //     $this->session->unset_userdata('p_type');
        // // }
        // if($this->uri->segment(3) == null)
        // {
        //     $this->shop_model->delete_storage();
        // }
    }

    // Display Page
    function page($slug) {
        $page = $this->shop_model->getPageBySlug($slug);
        $this->data['page'] = $page;
        $this->data['page_title'] = $page->title;
        $this->data['page_desc'] = $page->description;
        $this->page_construct('pages/page', $this->data);
    }

    function index() {
        $this->data['slider'] = json_decode($this->shop_settings->slider);
        $this->data['page_title'] = $this->shop_settings->shop_name;
        $this->data['page_desc'] = $this->shop_settings->description;
        $this->data['menu_active'] = "home";
        $this->session->unset_userdata('pickup_location');
        $this->session->unset_userdata('drop_location');
        $this->session->unset_userdata('p_price');
        $this->session->unset_userdata('p_type');
        $this->page_construct('index', $this->data);
    }

    // Display Page
    function house_removal($storage_id = 0, $slug = NULL) {
        $this->load->helper('text');
        $this->data['page_title'] = 'House Removal';
        $this->data['menu_active'] = "house_removal";
        if(null != $this->session->userdata('pickup_location')){
            $this->data['pickup']= $this->session->userdata('pickup_location');
            $this->data['drop'] = $this->session->userdata('drop_location');
        }else{
            $this->data['pickup']= "";
            $this->data['drop'] = "";
        }
        $this->session->unset_userdata('p_price');
        $this->session->unset_userdata('p_type');
        if (!$slug) {
            $this->session->unset_userdata('house_removal_slug');
            $this->session->unset_userdata('house_removal_type');
            $this->data['floors'] = $this->shop_model->getFloors();
            $products_categories = $this->shop_model->getCategories();
            foreach ($products_categories as $c) {
                $c->properties = $this->shop_model->getProducts($c->id, "house_removals");
            }
            // print_r($categories[0]);exit;
            $this->data['products_categories'] = $products_categories;
            $this->page_construct('houseMove/index', $this->data);
        }else{
            $products = $this->shop_model->getProducts(null, "house_removals");
            foreach ($products as $p) {
                $p->sub_products = $this->shop_model->getProducts($p->id, "house_removals");
            }
            // print_r($products);exit;
            $this->data['products'] = $products;
            $total_seg = $this->uri->total_segments();
            $last = $this->uri->segment($total_seg);
            if(is_numeric($last) && $last>0){
            $this->page_construct('houseMove/details', $this->data);
            }
            else
            {
                redirect(base_url());
            }
        }
    }
    function edit_order($refrence_id = 0, $slug = NULL){

        $total_seg = $this->uri->total_segments();
        $order_id = $this->uri->segment($total_seg);
        
        $this->db->where('order_id', $order_id)->delete('sma_storage');

        $order_details = $this->db->where('id', $order_id)->get('sma_order')->row();
        if($order_details->order_type == 'house_removal'){
            $this->data['menu_active'] = "edit_order";
            $this->data['page_title'] = 'Edit Order';
            $this->data['floors'] = $this->shop_model->getFloors();
            $products_categories = $this->shop_model->getCategories();
            foreach ($products_categories as $c) {
                $c->properties = $this->shop_model->getProducts($c->id, "house_removals");
            }
            $products = $this->shop_model->getProducts(null, "house_removals");
            foreach ($products as $p) {
                $p->sub_products = $this->shop_model->getProducts($p->id, "house_removals");
            }
            $this->data['products'] = $products;
            $this->data['products_categories'] = $products_categories;

            if($order_id>0)
            {
                $extra_services_price = 0;   
                $extra_services = $this->db->where('product_type',"extra_services")->where("parent !=", 0)->get('sma_products')->result_array();
                foreach($extra_services as $extra_service)
                {
                    $extra_services_price += $extra_service['price'];
                }
                $this->data['extra_service_prices'] = $extra_services_price;
                // $this->page_construct('priceOptions/prices', $this->data);
            }
            
            // Below is for Calendar start
            $storage = '';
            $storage = $this->shop_model->order_by_id($order_id);
            // print_r($storage);die;
            $this->data['order'] = $storage;
            // print_r($this->data['order']);die;
            // print_r($storage->price);die;
                // if(!empty($storage)){
                    $price = ceil($storage->km+$storage->price);
                    // $price = ceil(5+450);
                // }else{
                    // if(isset($_COOKIE["scot_cookie_id"])) {
                    //     $this->shop_model->delete_storage($_COOKIE["scot_cookie_id"]);
                    //     unset($_COOKIE['scot_cookie_id']);
                    //     setcookie('scot_cookie_id', null, -1, '/'); 
                    // }
                    // return redirect('shop');
                // }
                $date = date( 'Y-m-d');
                if($price < 40){
                    $price = 40;
                }
                $price = $price;
                $j = 0;
                $todayDate = date('Y-m-d');
                for ($i=0; $i < 90; $i++) {
                    if($j != 0){
                        $days = date('Y-m-d',strtotime($date . "+".$j." days"));
                    }else{
                        $days = date('Y-m-d',strtotime($date));
                    }
                    $event = new Events();
                    $weekday = date('l', strtotime($days));
                    if($weekday == "Friday" || $weekday == "Saturday"){
                        if($todayDate == $days){
                            $event->title = '£'.number_format((  $price + ( 30 + 40 ) ));
                        }else{
                            $event->title = '£'.number_format(($price + 30));
                        }
                    }
                    else{
                        if($todayDate == $days){
                            $event->title = '£'.number_format($price + 40);
                        }else{
                            $event->title = '£'.number_format($price);
                        }
                    }
                    $event->date = $days;
                    $j++;
                    $arr[] = $event;
                }
                $this->data['events'][] = $arr;
                $this->data['count'] = count($arr);
            // Calendar End

            // Extra Services
            $products = $this->shop_model->getProducts(null, "extra_services");
            foreach ($products as $p) {
                $p->sub_products = $this->shop_model->getProducts($p->id, "extra_services");
            }
            $this->data['products_extra'] = $products;
            // Extra Services End
            $this->page_construct('myorders/houseEdit', $this->data);
            // }else if($order_details->order_type == 'office_removal'){
            }else{
                $this->load->helper('text');
            $this->data['page_title'] = 'Office Removal';
            $this->data['menu_active'] = "office_removal";
            if(null != $this->session->userdata('pickup_location')){
                $this->data['pickup']= $this->session->userdata('pickup_location');
                $this->data['drop'] = $this->session->userdata('drop_location');
            }else{
                $this->data['pickup']= "";
                $this->data['drop'] = "";
            }
            $this->session->unset_userdata('p_price');
            $this->session->unset_userdata('p_type');
        // ====== For Index Section ====//
            $this->session->unset_userdata('office_removal_slug');
            $this->session->unset_userdata('office_removal_type');
            $this->data['floors'] = $this->shop_model->getFloors();
        // ====== Index Section End====//
        // ====== For Details Section ====//
            $pickup = "<script>document.write(localStorage.getItem('pickup'));</script>";
            $products = $this->shop_model->getProducts(null, "office_removals");
            $this->data['products'] = $products;
            $storage = '';
            $storage = $this->shop_model->order_by_id($order_id);
            $this->data['order'] = $storage;
        // ====== Details Section End ====//
        // ====== Extra Services =====//
            $this->data['page_title'] = 'Extra Services';
            $this->data['menu_active'] = "Extra Services";
            $products = $this->shop_model->getProducts(null, "extra_services");
            foreach ($products as $p) {
                $p->sub_products = $this->shop_model->getProducts($p->id, "extra_services");
            }
            $this->data['products'] = $products;
        // ====== Extra Services end
        
            $this->page_construct('myorders/officeEdit', $this->data);
        }
    }
    // Display Order Page
    function order($storage_id = NULL) {
        // echo "controller";
        // $OrderPrice = $this->input->post('new_price');
        $data['total']= $this->input->post('new_total');
        $storage_id = $this->input->post('storage_id');
        // echo $total;die;
        $OrderDate = $this->input->post('finaldate');
        $persons = $this->input->post('radio');
        $data['order_date'] = date("yy-m-d", strtotime($OrderDate));
        $data['strt_time'] = date("G:i", strtotime($this->input->post('strt_time')));
        $data['end_time'] = date("G:i", strtotime($this->input->post('end_time')));
        $data['total_persons'] = str_replace("_person","", $persons);
        $this->db->update('sma_storage', $data, ['id' => $storage_id]);
        // print_r($data);die;
        $this->load->helper('text');
        $this->data['page_title'] = 'Order';
        $this->data['menu_active'] = "order";
        // $this->data['OrderPrice'] = $OrderPrice;
        $this->data['OrderDate'] = $OrderDate;
        $this->data['persons'] = str_replace("_person","", $persons);
        $this->data['return_url'] = site_url().'shop/callback';
        $this->data['surl'] = site_url().'shop/success';
        $this->data['furl'] = site_url().'shop/failed';
        $this->data['paypal_env'] = "sandbox";
        $this->data['paypal_clientid'] = "AVQWVChBZwLEkiUfGycPVbn4W_PiHjas638svFVN7tfvr4nqFac83DAVHcyaWMRHx-tT_5e0mEQZYeFX";
        $this->data['currency'] = "EUR";
        $this->data['currency_code'] = "€";
        $this->page_construct('priceOptions/details', $this->data);
    }
    // Below order_for_edit is for Edit Order
    function order_for_edit($storage_id = NULL) {
        // echo "controller";
        // $OrderPrice = $this->input->post('new_price');
        $total_seg = $this->uri->total_segments();
        $order_id = $this->uri->segment($total_seg);
        $order = $this->db->where('id',$order_id)->get('sma_order')->row();
        $this->data['order_data'] = $order;
        $data['total']= $this->input->post('new_total');
        $storage_id = $this->input->post('storage_id');
        // echo $total;die;
        $OrderDate = $this->input->post('finaldate');
        $persons = $this->input->post('radio');
        $data['order_date'] = date("yy-m-d", strtotime($OrderDate));
        $data['strt_time'] = date("G:i", strtotime($this->input->post('strt_time')));
        $data['end_time'] = date("G:i", strtotime($this->input->post('end_time')));
        $data['total_persons'] = str_replace("_person","", $persons);
        $this->db->update('sma_storage', $data, ['order_id' => $order_id]);
        $this->load->helper('text');
        $this->data['page_title'] = 'Order';
        $this->data['menu_active'] = "order";
        $this->data['OrderDate'] = $OrderDate;
        $this->data['persons'] = str_replace("_person","", $persons);
        $this->data['return_url'] = site_url().'shop/callback';
        $this->data['surl'] = site_url().'shop/success';
        $this->data['furl'] = site_url().'shop/failed';
        $this->data['paypal_env'] = "sandbox";
        $this->data['paypal_clientid'] = "AVQWVChBZwLEkiUfGycPVbn4W_PiHjas638svFVN7tfvr4nqFac83DAVHcyaWMRHx-tT_5e0mEQZYeFX";
        $this->data['currency'] = "EUR";
        $this->data['currency_code'] = "€";
        $this->page_construct('myorders/order_page', $this->data);
    }

    public function callback() {
        $paymentID = $this->input->get('paymentID');
        $payerID = $this->input->get('payerID');
        $token = $this->input->get('token');
        $sid = $this->input->get('sid');
        $edit_order = $this->input->get('edit_order');
        if(!empty($paymentID) && !empty($payerID) && !empty($token) && !empty($sid) ){
            if(!empty($edit_order)){
                $storage = $this->shop_model->getStorageByID($sid,$edit_order);
            }else{
                $storage = $this->shop_model->getStorageByID($sid);
            }
            $randstring = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);
            // $this->shop_model->update_order(['order_status' => 'success','trackingID' => $randstring], $storage->order_id);
            $productlist = json_decode($storage->products_list);
            // print_r($storage);
            // echo 'prev is storage';
            $newDate = date("Y-m-d", strtotime($storage->order_date));
            $orderdata = [
                'order_status' => 'success',
                'trackingID' => $randstring,
                'order_type' => $storage->type,
                'pickup_address' => $storage->pickup_location,
                'delivery_address' => $storage->drop_location,
                'order_price' => $storage->total,
                'order_date' => $newDate,
                'persons' => $storage->total_persons,
                'booking_first_last_name' => $storage->order_first_last_name,
                'bookig_email' => $storage->order_booking_email,
                'booking_phone' => $storage->order_booking_phone,
                'pickup_postal' => $storage->order_pickup_postcode,
                'pickup_name' => $storage->order_pickup_contact_name,
                'pickup_phone' => $storage->order_pickup_phone,
                'delivery_postal' => $storage->order_drop_postcode,
                'delivery_phone' => $storage->order_drop_phone,
                'delivery_name' => $storage->order_drop_contact_name,
                'strt_time'   => $storage->strt_time,
                'end_time'   => $storage->end_time,
            ];
            $order_insert_id = $this->shop_model->save_order($orderdata);
            // print_r($orderdata);
            // print_r($order_insert_id);die;
            $payment_data['payment_id'] = $paymentID;
            $payment_data['method'] = 'paypal';
            $payment_data['amount'] = $storage->total;
            $payment_data['order_id'] = $order_insert_id;
            $insert_id = $this->shop_model->save_payment_details($payment_data);

            foreach($productlist as $details){
                $data['order_id'] = $order_insert_id;
                $data['product_id'] = $details->id;
                $data['product_name'] = $details->name;
                $data['product_quantity'] = $details->quantity;
                $insert_id = $this->shop_model->save_order_details($data);
            }

            $order = $this->shop_model->get_order($order_insert_id);
            $total_item = 0;
            $html = '<div class="row mx-0 my-5">
                <div style="max-width: 83.333333%;margin-left:auto;margin-right:auto;">
                <div class="user-order-status" style="text-align:center;">
                    <div style="display:grid;grid-auto-flow:column;width:160px;height:160px;display:flex;margin-left:auto;margin-right:auto;margin-top:30px;border-radius:50%;justify-content:center;align-items:center;background:#0065bd;">
                        <img src="'.base_url('assets/uploads/logos/Website-Logo3.png').'" style="width:120px;margin:auto;"">
                    </div>
                    <div class="order-status-text">
                        <h5 style="margin-bottom: 30px; text-align:center;font-size: 32px;color: rgb(56, 56, 56);font-weight: bold;line-height: 1;margin-top:30px;">Your Booking Completed Successfully!</h5>
                        <p style="font-size: 26px;margin-bottom: 1.5rem!important;color: rgb(100, 100, 100);line-height: 1.385;text-align: center;margin-top:0px;">Thank you for ordering. We received your order <br>and will begin processing it soon.</p>
                    </div>
                    <div class="header-status-item">
                        <h5 style="font-size: 27px;color: rgb(62, 64, 66);font-weight: bold;line-height: 1.2;margin-bottom:20px;">Your Inventory</h5>
                    </div>'; 
                        foreach($order->order_details as $order_detail){ 
                            $total_item = $order_detail->product_quantity + $total_item;
                            $html .= '
                            <div class="order-status-items items-card-bar">
                                <div class="items-bar" style=" border-width: 1px;border-color: rgb(235, 235, 235);border-style: solid;border-radius: 8px;padding:10px 20px;margin-bottom:1px;display:flex;align-items:center;background:#fff;">
                                    <p  style="font-size: 15px;margin-bottom:0px; color: rgb(50, 52, 53);line-height: 1.2;margin-top:0px;">'.$order_detail->product_name.'</p>
                                    <p style="margin-left:auto; font-size: 15px;margin-bottom:0px; color: rgb(50, 52, 53);margin-top:0px;line-height: 1.2;">'.$order_detail->product_quantity.'</p>
                                </div>
                            </div>';
                        }
                        $html .= ' <div class="order-status-items">
                            <div class="items-bar" style="display:flex;border-width: 1px;border-color: rgb(235, 235, 235);border-style: solid;border-radius: 8px;padding:10px 20px;margin-bottom:1px;background:#fff;">
                                <div style="width: 33.33%;">
                                    <div class="location-detail" style="text-align:left;">
                                        <h5 style=" margin-bottom: .5rem;margin-top:0px;font-size: 15px;color: rgb(50, 52, 53);font-weight: bold;line-height: 1.2;">Pick Up Location</h5>
                                        <span style="font-size: 15px;color: rgb(110, 110, 110);line-height: 1.2;">'.$order->pickup_address.'</span>
                                    </div>
                                </div>
                                <div style="width: 33.33%;">
                                    <img src="'.base_url('assets/images/location-sign.png').'" style="margin-top:7px;" >
                                </div>
                                <div style="width: 33.33%;">
                                    <div class="location-detail" style="text-align:left;">
                                        <h5 style="width:fit-content;margin-left:auto;margin-bottom: .5rem;margin-top:0px;font-size: 15px;color: rgb(50, 52, 53);font-weight: bold;line-height: 1.2;">Drop Off Location</h5>
                                        <span style="display:block;width:fit-content;margin-left:auto;font-size: 15px;color: rgb(110, 110, 110);line-height: 1.2;">'.$order->delivery_address.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="order-status-items total-detail">
                            <div style="border-width: 1px;border-color: rgb(235, 235, 235);border-style: solid;border-radius: 8px; padding: 10px 20px;margin-bottom: 1px;">
                                <div class="" style="display:flex;align-items:center;margin-bottom: .25rem!important;padding-top:.25rem;">
                                    <p  style="font-size: 18px;margin-bottom:0px;line-height: 1.2;margin-top:0px;">Total Items</p>
                                    <h6  style="margin-left:auto;font-size: 18px;margin-bottom:0px;margin-top:0px;color: rgb(47, 47, 47);font-weight: bold;line-height: 1.2;">'.$total_item.'</h6>
                                </div>
                                <div style="display:flex;align-items:center;padding-top:.25rem;padding-bottom:.25rem;border-top:1px solid rgb(235, 235, 235);">
                                    <p style="margin-bottom:0px;margin-top:0px;font-size: 18px;line-height: 1.2;">Total Price</p>
                                    <h6  style="margin-left:auto;font-size: 18px;margin-bottom:0px;margin-top:0px;color: rgb(47, 47, 47);font-weight: bold;line-height: 1.2;">£'.number_format($order->order_price, 2).'</h6>
                                </div>
                            </div>
                        </div>
                        <div class="order-status-items" style="margin-top: 1.5rem!important;">
                            <div  style="display:flex;align-items:center;background:#0065bd;border-radius: 8px; padding: 10px 20px; margin-bottom: 1px;">
                                <p style="margin-top:0px;font-size: 18px;color: rgb(255, 255, 255);font-weight: bold;line-height: 1.2;margin-bottom:0px;">Tracking ID</p>
                                <p style="margin-left:auto;font-size: 18px;color: rgb(255, 255, 255);font-weight: bold;line-height: 1.2;margin-top:0px;margin-bottom:0px;">'.$order->trackingID.'</p>
                            </div>
                        </div>
                        <div class="view-order" style="margin-top: 1.5rem!important;width:100%;">
                           <a href="'.base_url('shop/my_order/'.$order->trackingID).'" style="color:#fff;text-decoration:none;  background:rgb(213, 4, 17);display:block;width:150px;text-align:center;border-radius:8px;padding:10px 10px;margin-left:auto;font-size:20px;">View Order</a>
                        </div>
                        <div style="margin-top:30px;">
                            <div style="position:relative;margin-bottom: .5rem!important">
                                <div style="position:absolute;bottom: -4px; left: -9px; z-index: 99;">
                                    <img src="'.base_url('assets/images/helpline.png').'" class="img-fluid helpline-img">
                                </div>
                                <div style="position:relative;padding-top:.25rem;padding-bottom:.25rem;overflow: hidden; background-color: #fff;box-shadow: 0px 2px 9px 0px rgba(0, 0, 0, 0.09);border-radius: 3px;color: #0065bd;line-height: 1.1;">
                                    <span class="helpline-shape"></span>
                                    <div class="mt-4 mb-4 px-5">
                                    <p class="helpline-text " style="margin-bottom:0px;text-align:center;font-size: 15px;font-weight: 600;">Prefer to get a price over the phone?</p>
                                    <p style="font-size: 29px;text-align:center;font-weight: 900;margin-top:10px;margin-bottom:1rem;"><a class="num-clr" href="tel:0141-390-8967">0141-390-8967</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            // $html = 'hello order is received.';
            $this->sma->send_email($order->bookig_email, "Tracking ID: ".$order->trackingID."", $html, "admin@scotremovals.com", "Scot Removals");
            $this->sma->send_email("attaurrehmaanbhatti687@gmail.com", "New Tracking ID: ".$order->trackingID."", $html, $order->bookig_email, $order->booking_first_last_name);

            $storage_data = array(
                'order_status' => 'ordered',
            );
            $deleted_storage = $this->shop_model->update_smastorage($storage_data,$sid);
            unset($_COOKIE['scot_cookie_id']);
            setcookie('scot_cookie_id', null, -1, '/');
            $this->session->set_flashdata('success', 'Payment made successfully with tracking ID "'. $randstring .'".');
        } else {
            $this->session->set_flashdata('error', 'Error in Payment.');
        }
        redirect('shop/order_success/'.$order_insert_id);
        // redirect(base_url()); 
    }

    function failed(){
        $this->session->set_flashdata('error', "Payment is failed.");
        // $this->page_construct('/paypal/paymentFail', $this->data);
        redirect(base_url()); 
    }


    // Display Page
    function office_removal($storage_id = 0 , $slug = NULL) {
        $this->load->helper('text');
        $this->data['page_title'] = 'Office Removal';
        $this->data['menu_active'] = "office_removal";
        if(null != $this->session->userdata('pickup_location')){
            $this->data['pickup']= $this->session->userdata('pickup_location');
            $this->data['drop'] = $this->session->userdata('drop_location');
        }else{
            $this->data['pickup']= "";
            $this->data['drop'] = "";
        }
        $this->session->unset_userdata('p_price');
        $this->session->unset_userdata('p_type');
        if (!$slug) {
            $this->session->unset_userdata('office_removal_slug');
            $this->session->unset_userdata('office_removal_type');
            $this->data['floors'] = $this->shop_model->getFloors();
            $this->page_construct('officeMove/index', $this->data);
        }else{
            $pickup = "<script>document.write(localStorage.getItem('pickup'));</script>";
            if(null != $pickup){
            $products = $this->shop_model->getProducts(null, "office_removals");
            $this->data['products'] = $products;
            $this->page_construct('officeMove/details', $this->data);
            }
            else{
                redirect(base_url());
            }
        }
    }

    function furniture_delivery($storage = 0 , $slug = NULL) {
        $this->load->helper('text');
        $this->data['page_title'] = 'Furniture Delivery';
        $this->data['menu_active'] = "furniture_delivery";
        if(null != $this->session->userdata('pickup_location')){
            $this->data['pickup']= $this->session->userdata('pickup_location');
            $this->data['drop'] = $this->session->userdata('drop_location');
        }else{
            $this->data['pickup']= "";
            $this->data['drop'] = "";
        }
        $this->session->unset_userdata('p_price');
        $this->session->unset_userdata('p_type');
        if (!$slug) {
            $this->session->unset_userdata('furniture_delivery_slug');
            $this->session->unset_userdata('furniture_delivery_type');
            $this->data['floors'] = $this->shop_model->getFloors();
            $this->page_construct('furnitureDelivery/index', $this->data);
        }else{
            $products = $this->shop_model->getProducts(null, "furniture_delivery");
            foreach ($products as $p) {
                $p->sub_products = $this->shop_model->getProducts($p->id, "furniture_delivery");
            }
            // print_r($products);exit;
            $this->data['products'] = $products;
            // print_r($this->data['products']);exit;
            $pickup = "<script>document.write(localStorage.getItem('pickup'));</script>";
            if(null != $pickup){
            $this->page_construct('furnitureDelivery/details', $this->data);
            }
            else{
                redirect(base_url());
            }
        }
    }
    function why_us() {
        $this->data['page_title'] = 'Why Us';
        $this->data['menu_active'] = "why_us";
        $this->page_construct('whyUs/index', $this->data);
    }
    function man_and_van($storage=0,$slug = NULL) {
        $pickup = "<script>document.write(localStorage.getItem('pickup'));</script>";
        $this->load->helper('text');
        $this->data['page_title'] = 'Man & Van';
        $this->data['menu_active'] = "man_and_van";
        if(null != $this->session->userdata('pickup_location')){
            $this->data['pickup']= $this->session->userdata('pickup_location');
            $this->data['drop'] = $this->session->userdata('drop_location');
        }else{
            $this->data['pickup']= "";
            $this->data['drop'] = "";
        }
        $this->session->unset_userdata('p_price');
        $this->session->unset_userdata('p_type');
        if (!$slug) {
            $this->session->unset_userdata('man_and_van_slug');
            $this->session->unset_userdata('man_and_van_type');
            // $this->data['floors'] = $this->shop_model->getFloors();
            $this->page_construct('manAndVan/index', $this->data);
        }else{
            $products = $this->shop_model->getProducts(null, "man_and_van");
            foreach ($products as $p) {
                $p->sub_products = $this->shop_model->getProducts($p->id, "man_and_van");
            }
            // print_r($products);exit;
            $this->data['products'] = $products;
            // print_r($this->data['products']);exit;
            if(null != $pickup){
            $this->page_construct('manAndVan/details', $this->data);
            }
            else
            {
                redirect(base_url());
            }
        }
    }

    // Display Page
    function piano_removal($storage_id = 0 ,$slug = NULL ) {
        $this->load->helper('text');
        $this->data['page_title'] = 'Piano Removal';
        $this->data['menu_active'] = "piano_removal";
        if(null != $this->session->userdata('pickup_location')){
            $this->data['pickup']= $this->session->userdata('pickup_location');
            $this->data['drop'] = $this->session->userdata('drop_location');
        }else{
            $this->data['pickup']= "";
            $this->data['drop'] = "";
        }
        $this->session->unset_userdata('p_price');
        $this->session->unset_userdata('p_type');
        if (!$slug) {
            $this->data['floors'] = $this->shop_model->getFloors();
            $products = $this->shop_model->getProducts(null, "piano_transport");
            // print_r($products);exit;
            $this->data['products'] = $products;
            $this->page_construct('pianoMove/index', $this->data);
        }else{
            if(null != $this->session->userdata('pickup_location')){
            $this->page_construct('pianoMove/details', $this->data);
            }
            else
            {
                redirect(base_url());
            }
        }
    }

    function price_options($storage_id = 0 ,$slug = NULL) {
        $this->load->helper('text');
        $this->data['page_title'] = 'Price Options';
        $this->data['menu_active'] = "price_options";
        if(null != $this->session->userdata('pickup_location')){
            $this->data['pickup']= $this->session->userdata('pickup_location');
            $this->data['drop'] = $this->session->userdata('drop_location');
        }else{
            $this->data['pickup']= "";
            $this->data['drop'] = "";
        }
        if (!$slug) {
            $arr = [];
            //$friday = date( 'Y-m-d', strtotime( 'friday this week' ) );
            //$saturday = date( 'Y-m-d', strtotime( 'saturday this week' ) );

            // $price_storage = "<script>document.write(localStorage.getItem('price'));</script>";
            $storage = $this->shop_model->getStorageByID($storage_id);
            if(!empty($storage)){
                // $price = $storage->total;
                $price = ceil($storage->km+$storage->price);
            }else{
                if(isset($_COOKIE["scot_cookie_id"])) {
                    $this->shop_model->delete_storage($_COOKIE["scot_cookie_id"]);
                    unset($_COOKIE['scot_cookie_id']);
                    setcookie('scot_cookie_id', null, -1, '/'); 
                }
                return redirect('shop');
            }
			$date = date( 'Y-m-d');
            // $price = $price + 40;
            if($price < 40){
                $price = 40;
            }
            $price = $price;
            $j = 0;
            $todayDate = date('Y-m-d');
            for ($i=0; $i < 90; $i++) {
                if($j != 0){
                    $days = date('Y-m-d',strtotime($date . "+".$j." days"));
                }else{
                    $days = date('Y-m-d',strtotime($date));
                }
                $event = new Events();
				$weekday = date('l', strtotime($days));
				if($weekday == "Friday" || $weekday == "Saturday"){
                    if($todayDate == $days){
                        $event->title = '£'.number_format((  $price + ( 30 + 40 ) ));
                    }else{
                        $event->title = '£'.number_format(($price + 30));
                    }
                }
                else{
                    if($todayDate == $days){
                        $event->title = '£'.number_format($price + 40);
                    }else{
                        $event->title = '£'.number_format($price);
                    }
                }
				$event->date = $days;
				$j++;
                // if($i % 2 == 0){
                    // $event->date = $friday;
                    // $friday = date('Y-m-d',strtotime($friday . "+7 days"));
                // }else{
                    // $event->date = $saturday;
                    // $saturday = date('Y-m-d',strtotime($saturday . "+7 days"));
                // }
                $arr[] = $event;
            }
            $this->data['events'][] = $arr;
            $this->data['count'] = count($arr);
            if($storage_id > 0)
            {
                $this->page_construct('priceOptions/index', $this->data);
            } 
            else{
                redirect(base_url());
            }
        }else{
            $this->page_construct('priceOptions/details', $this->data);
        }
    }

    // Display Page
    function product($slug) {
        $product = $this->shop_model->getProductBySlug($slug);
        if (!$slug || !$product) {
            $this->session->set_flashdata('error', lang('product_not_found'));
            $this->sma->md('/');
        }
        //$this->data['barcode'] = "<img src='" . admin_url('products/gen_barcode/' . $product->code . '/' . $product->barcode_symbology . '/40/0') . "' alt='" . $product->code . "' class='pull-left' />";
        $this->shop_model->updateProductViews($product->id, $product->views);
        $this->data['product'] = $product;
        $this->data['other_products'] = $this->shop_model->getOtherProducts($product->id, $product->category_id);
        $this->data['images'] = $this->shop_model->getProductPhotos($product->id);
        $this->data['category'] = $this->site->getCategoryByID($product->category_id);
        $this->load->helper('text');
        $this->data['page_title'] = $product->code.' - '.$product->name;
        $this->data['page_desc'] = character_limiter(strip_tags($product->product_details), 160);
        $this->data['page_heading'] = $this->data['category']->name;
        $this->page_construct('pages/view_product', $this->data);
    }

    // Products,  categories and brands page
    function products($category_slug = NULL, $subcategory_slug = NULL, $brand_slug = NULL, $promo = NULL) {
        $this->session->set_userdata('requested_page', $this->uri->uri_string());
        if ($this->input->get('category')) { $category_slug = $this->input->get('category', TRUE); }
        if ($this->input->get('brand')) { $brand_slug = $this->input->get('brand', TRUE); }
        if ($this->input->get('promo') && $this->input->get('promo') == 'yes') { $promo = true; }
        $reset = $category_slug || $subcategory_slug || $brand_slug ? TRUE : FALSE;

        $filters = array(
            'query' => $this->input->post('query'),
            'category' => $category_slug ? $this->shop_model->getCategoryBySlug($category_slug) : NULL,
            'sorting' => $reset ? NULL : $this->input->get('sorting'),
            'min_price' => $reset ? NULL : $this->input->get('min_price'),
            'max_price' => $reset ? NULL : $this->input->get('max_price'),
            'page' => $this->input->get('page') ? $this->input->get('page', TRUE) : 1,
        );

        $this->data['filters'] = $filters;
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['page_title'] = (!empty($filters['category']) ? $filters['category']->name : (!empty($filters['brand']) ? $filters['brand']->name : lang('products'))). ' - ' .$this->shop_settings->shop_name;
        $this->data['page_desc'] = !empty($filters['category']) ? $filters['category']->description : (!empty($filters['brand']) ? $filters['brand']->description : $this->shop_settings->products_description);
        $this->data['page_heading'] = (!empty($filters['category']) ? $filters['category']->name : 'Fruits And Vegetables');
        $this->page_construct('pages/products', $this->data);
    }

    // Search products page - ajax
    function search() {
        $filters = $this->input->post('filters') ? $this->input->post('filters', TRUE) : FALSE;
        $limit = 12;
        $total_rows = $this->shop_model->getProductsCount($filters);
        $filters['limit'] = $limit;
        $filters['offset'] = isset($filters['page']) && !empty($filters['page']) && ($filters['page'] > 1) ? (($filters['page']*$limit)-$limit) : NULL;

        if ($products = $this->shop_model->getProducts($filters)) {
            $this->load->helper(array('text', 'pagination'));
            foreach($products as &$value) {
                $value['details'] = character_limiter(strip_tags($value['details']), 140);
                if ($this->shop_settings->hide_price) {
                    $value['price'] = $value['formated_price'] = 0;
                } else {
                    $value['price'] = $this->sma->setCustomerGroupPrice($value['price'], $this->customer_group);
                    $value['formated_price'] = $this->sma->convertMoney($value['price']);
                }
            }

            $pagination = pagination('shop/products', $total_rows, $limit);
            $info = array('page' => (isset($filters['page']) && !empty($filters['page']) ? $filters['page'] : 1), 'total' => ceil($total_rows/$limit));

            $this->sma->send_json(array('filters' => $filters, 'products' => $products, 'pagination' => $pagination, 'info' => $info));
        } else {
            $this->sma->send_json(array('filters' => $filters, 'products' => FALSE, 'pagination' => FALSE, 'info' => FALSE));
        }
    }

    // Customer order/orders page
    function saveOrder() {
        $storage_id = $this->input->get('storage_id');
        $edit_order = $this->input->get('edit_order');
        $order_date = $this->input->get('order_date');
        $order_persons = $this->input->get('order_persons');
        $strt_time = $this->input->get('start_time');
        $end_time = $this->input->get('end_time');
        $booking_name = $this->input->get('booking_name');
        $booking_email = $this->input->get('booking_email');
        $booking_phone = $this->input->get('booking_phone');
        // $b_s_number = $this->input->get('b_s_number');
        $pickup_postal = $this->input->get('pickup_postal');
        $pickup_name = $this->input->get('pickup_name');
        $pickup_phone = $this->input->get('pickup_phone');
        $delivery_postal = $this->input->get('delivery_postal');
        $delivery_name = $this->input->get('delivery_name');
        $delivery_phone = $this->input->get('delivery_phone');
        $newDate = date("Y-m-d", strtotime($order_date));
        $storage = $this->shop_model->getStorageByID($storage_id);
        $data = [
            'order_date' => $newDate,
            'order_first_last_name' => $booking_name,
            'order_booking_email' => $booking_email,
            'order_booking_phone' => $booking_phone,
            'order_pickup_postcode' => $pickup_postal,
            'order_pickup_contact_name' => $pickup_name,
            'order_pickup_phone' => $pickup_phone,
            'order_drop_postcode' => $delivery_postal,
            'order_drop_phone' => $delivery_phone,
            'order_drop_contact_name' => $delivery_name,
            'strt_time'   => $strt_time,
            'end_time'   => $end_time
        ];
            // print_r($data);
        // $insert_id = $this->shop_model->save_order($data);
        if($edit_order == 'yes'){
            $order_details = $this->shop_model->update_smastorage($data, $storage_id,'edit_order');
        }else{
            $order_details = $this->shop_model->update_smastorage($data, $storage_id);
        }
        $this->data['page_title'] = 'Order';
        echo json_encode($order_details);
        // $this->page_construct('priceOptions/details', $this->data);
    }
    // Customer order/orders page
    function orders($id = NULL, $hash = NULL, $pdf = NULL, $buffer_save = NULL) {
        $hash = $hash ? $hash : $this->input->get('hash', TRUE);
        if (!$this->loggedIn && !$hash) { redirect('login'); }
        if ($this->Staff) { admin_redirect('sales'); }
        if ($id && !$pdf) {
            if ($order = $this->shop_model->getOrder(['id' => $id, 'hash' => $hash])) {
                $this->data['inv'] = $order;
                $this->data['rows'] = $this->shop_model->getOrderItems($id);
                $this->data['customer'] = $this->site->getCompanyByID($order->customer_id);
                $this->data['biller'] = $this->site->getCompanyByID($order->biller_id);
                $this->data['address'] = $this->shop_model->getAddressByID($order->address_id);
                $this->data['page_title'] = lang('view_order');
                $this->data['page_desc'] = '';
                $this->page_construct('pages/view_order', $this->data);
            } else {
                $this->session->set_flashdata('error', lang('access_denied'));
                redirect('/');
            }
        } elseif ($pdf || $this->input->get('download')) {
            $id = $pdf ? $id : $this->input->get('download', TRUE);
            $hash = $hash ? $hash : $this->input->get('hash', TRUE);
            $order = $this->shop_model->getOrder(['id' => $id, 'hash' => $hash]);
            $this->data['inv'] = $order;
            $this->data['rows'] = $this->shop_model->getOrderItems($id);
            $this->data['customer'] = $this->site->getCompanyByID($order->customer_id);
            $this->data['biller'] = $this->site->getCompanyByID($order->biller_id);
            $this->data['address'] = $this->shop_model->getAddressByID($order->address_id);
            $this->data['Settings'] = $this->Settings;
            $this->data['shop_settings'] = $this->shop_settings;
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
        } elseif (!$id) {
            $page = $this->input->get('page') ? $this->input->get('page', TRUE) : 1;
            $limit = 10;
            $offset = ($page*$limit)-$limit;
            $this->load->helper('pagination');
            $total_rows = $this->shop_model->getOrdersCount();
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
            $this->data['orders'] = $this->shop_model->getOrders($limit, $offset);
            $this->data['pagination'] = pagination('shop/orders', $total_rows, $limit);
            $this->data['page_info'] = array('page' => $page, 'total' => ceil($total_rows/$limit));
            $this->data['page_title'] = lang('my_orders');
            $this->data['page_desc'] = '';
            $this->page_construct('pages/orders', $this->data);
        }
    }

    // Add new Order form shop
    function order1() {
        $guest_checkout = $this->input->post('guest_checkout');
        if (!$guest_checkout && !$this->loggedIn) { redirect('login'); }
        $this->form_validation->set_rules('note', lang("comment"), 'trim');
        $this->form_validation->set_rules('payment_method', lang("payment_method"), 'required');

        $this->form_validation->set_rules('name', lang("name"), 'trim|required');
        $this->form_validation->set_rules('phone', lang("phone"), 'trim|required|matches[confirm_phone]');
        $this->form_validation->set_rules('confirm_phone', lang("confirm_phone_number"), 'trim|required|matches[confirm_phone]');

        if ($guest_checkout) {
            $this->form_validation->set_rules('email', lang("email"), 'trim|required|valid_email');
        }

        if ($this->form_validation->run() == true) {
            if ($guest_checkout || $this->input->post('city')) {
                $new_customer = false;
                //if ($guest_checkout) {
                    $address = [
                        'name' => $this->input->post('name'),
                        'phone' => $this->input->post('phone'),
                        'city' => $this->input->post('city'),
                        'lat' => $this->input->post('lat'),
                        'lon' => $this->input->post('lon')
                    ];
                //}
                if ($this->input->post('address') != 'new') {
                    $customer = $this->site->getCompanyByID($this->session->userdata('company_id'));
                } else {
                    if (!($customer = $this->shop_model->getCompanyByEmail($this->input->post('email')))) {
                        $customer = new stdClass();
                        $customer->name = $this->input->post('name');
                        $customer->phone = $this->input->post('phone');
                        $customer->email = $this->input->post('email');
                        $customer->company = '-';
                        $new_customer = true;
                    }
                }
                $biller = $this->site->getCompanyByID($this->shop_settings->biller);
                $note = $this->db->escape_str($this->input->post('comment'));
                $total = 0;

                foreach ($this->cart->contents() as $item) {
                    if ($product_details = $this->shop_model->getProductForCart($item['product_id'])) {
                        $price = $product_details->price;

                        $item_net_price = $unit_price = $price;
                        $item_quantity = $item_unit_quantity = $item['qty'];

                        $subtotal = (($item_net_price * $item_unit_quantity));

                        $product = [
                            'product_id' => $product_details->id,
                            'product_code' => $product_details->code,
                            'product_name' => $product_details->name,
                            'product_type' => $product_details->type,
                            'net_unit_price' => $item_net_price,
                            'unit_price' => $this->sma->formatDecimal($unit_price),
                            'quantity' => $item_quantity,
                            'unit_quantity' => $item_unit_quantity,
                            'discount' => NULL,
                            'item_discount' => 0,
                            'subtotal' => $this->sma->formatDecimal($subtotal),
                            'real_unit_price' => $price,
                        ];

                        $products[] = ($product);
                        $total += $this->sma->formatDecimal(($item_net_price * $item_unit_quantity), 4);

                    } else {
                        $this->session->set_flashdata('error', lang('product_x_found').' ('.$item['name'].')');
                        redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'cart');
                    }
                }

                $shipping = $this->shop_settings->shipping;
                $grand_total = $this->sma->formatDecimal(($total + $shipping), 4);

                $data = [
                    'date' => date('Y-m-d H:i:s'),
                    'reference_no' => $this->site->getReference('so'),
                    'customer_id' => isset($customer->id) ? $customer->id : '',
                    'customer' => ($customer->company && $customer->company != '-' ? $customer->company : $customer->name),
                    'biller_id' => $biller->id,
                    'biller' => ($biller->company && $biller->company != '-' ? $biller->company : $biller->name),
                    'note' => $note,
                    'total' => $total,
                    'order_discount' => 0,
                    'total_discount' => 0,
                    'shipping' => $shipping,
                    'grand_total' => $grand_total,
                    'total_items' => $this->cart->total_items(),
                    'sale_status' => 'pending',
                    'created_by' => $this->session->userdata('user_id') ? $this->session->userdata('user_id') : NULL,
                    'shop' => 1,
                    'source' => 'Web',
                    'address_id' => ($this->input->post('address') == 'new') ? '' : $address->id,
                    'hash' => hash('sha256', microtime() . mt_rand()),
                    'payment_method' => $this->input->post('payment_method'),
                ];

                if ($new_customer) {
                    $customer = (array) $customer;
                }

                if ($sale_id = $this->shop_model->addSale($data, $products, $customer, $address)) {
                    //$this->order_received($sale_id);
                    //$this->load->library('sms');
                    //$this->sms->newSale($sale_id);
                    $this->cart->destroy();
                    $this->session->set_flashdata('message', lang('order_added_make_payment'));
                    shop_redirect('orders/'.$sale_id.'/'.($this->loggedIn ? '' : $data['hash']));
                }
            } else {
                $this->session->set_flashdata('error', lang('address_x_found'));
                redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'cart/checkout');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('cart/checkout'.($guest_checkout ? '#guest' : ''));
        }
    }

    function update_status(){

        if ($this->shop_model->updateStatus($this->input->post('id'))) {
            $this->sma->send_json(['status' => 'success', 'message' => 'canceled']);
        } else {
            $this->sma->send_json(['status' => 'error', 'message' => 'error']);
        }
    }

    // Customer address list
    function addresses() {
        if (!$this->loggedIn) { redirect('login'); }
        if ($this->Staff) { admin_redirect('customers'); }
        $this->session->set_userdata('requested_page', $this->uri->uri_string());
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['addresses'] = $this->shop_model->getAddresses();
        $this->data['page_title'] = lang('my_addresses');
        $this->data['page_desc'] = '';
        $this->page_construct('pages/addresses', $this->data);
    }

    // Add/edit customer address
    function address($id = NULL) {
        if (!$this->loggedIn) { $this->sma->send_json(array('status' => 'error', 'message' => lang('please_login'))); }
        $this->form_validation->set_rules('line1', lang("line1"), 'trim|required');
        // $this->form_validation->set_rules('line2', lang("line2"), 'trim|required');
        $this->form_validation->set_rules('city', lang("city"), 'trim|required');
        $this->form_validation->set_rules('state', lang("state"), 'trim|required');
        // $this->form_validation->set_rules('postal_code', lang("postal_code"), 'trim|required');
        $this->form_validation->set_rules('country', lang("country"), 'trim|required');
        $this->form_validation->set_rules('phone', lang("phone"), 'trim|required');

        if ($this->form_validation->run() == true) {

            $user_addresses = $this->shop_model->getAddresses();
            if (count($user_addresses) >= 6) {
                $this->sma->send_json(array('status' => 'error', 'message' => lang('already_have_max_addresses'), 'level' => 'error'));
            }

            $data = ['line1' => $this->input->post('line1'),
                'line2' => $this->input->post('line2'),
                'phone' => $this->input->post('phone'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'postal_code' => $this->input->post('postal_code'),
                'country' => $this->input->post('country'),
                'company_id' => $this->session->userdata('company_id')];

            if ($id) {
                $this->db->update('addresses', $data, ['id' => $id]);
                $this->session->set_flashdata('message', lang('address_updated'));
                $this->sma->send_json(array('redirect' => $_SERVER['HTTP_REFERER']));
            } else {
                $this->db->insert('addresses', $data);
                $this->session->set_flashdata('message', lang('address_added'));
                $this->sma->send_json(array('redirect' => $_SERVER['HTTP_REFERER']));
            }

        } elseif ($this->input->is_ajax_request()) {
            $this->sma->send_json(array('status' => 'error', 'message' => validation_errors()));
        } else {
            shop_redirect('shop/addresses');
        }
    }

    // Send us email
    function send_message() {

        $this->form_validation->set_rules('name', lang("name"), 'required');
        $this->form_validation->set_rules('email', lang("email"), 'required|valid_email');
        $this->form_validation->set_rules('subject', lang("subject"), 'required');
        $this->form_validation->set_rules('message', lang("message"), 'required');

        if ($this->form_validation->run() == true) {

            try {
                if ($this->sma->send_email($this->shop_settings->email, $this->input->post('subject'), $this->input->post('message'), $this->input->post('email'), $this->input->post('name'))) {
                    $this->sma->send_json(array('status' => 'Success', 'message' => lang('message_sent')));
                }
                $this->sma->send_json(array('status' => 'error', 'message' => lang('action_failed')));
            } catch (Exception $e) {
                $this->sma->send_json(array('status' => 'error', 'message' => $e->getMessage()));
            }

        } elseif ($this->input->is_ajax_request()) {
            $this->sma->send_json(array('status' => 'Error!', 'message' => validation_errors(), 'level' => 'error'));
        } else {
            $this->session->set_flashdata('warning', 'Please try to send message from contact page!');
            shop_redirect();
        }
    }

    // Add attachment to sale on manual payment
    function manual_payment($order_id) {
        if ($_FILES['payment_receipt']['size'] > 0) {
            $this->load->library('upload');
            $config['upload_path'] = 'files/';
            $config['allowed_types'] = 'zip|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif|txt';
            $config['max_size'] = 2048;
            $config['overwrite'] = FALSE;
            $config['max_filename'] = 25;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('payment_receipt')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect($_SERVER["HTTP_REFERER"]);
            }
            $manual_payment = $this->upload->file_name;
            $this->db->update('sales', ['attachment' => $manual_payment], ['id' => $order_id]);
            $this->session->set_flashdata('message', lang('file_submitted'));
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '/shop/orders');
        }
    }

    public function order_received($id = null, $hash = null){
        if ($inv = $this->shop_model->getOrder(['id' => $id, 'hash' => $hash])) {
            $user = $inv->created_by ? $this->site->getUser($inv->created_by) : NULL;
            $customer = $this->site->getCompanyByID($inv->customer_id);
            $biller = $this->site->getCompanyByID($inv->biller_id);
            $this->load->library('parser');
            $parse_data = array(
                'reference_number' => $inv->reference_no,
                'contact_person' => $customer->name,
                'company' => $customer->company && $customer->company != '-' ? '('.$customer->company.')' : '',
                'order_link' => shop_url('orders/'.$id.'/'.($this->loggedIn ? '' : $data['hash'])),
                'site_link' => base_url(),
                'site_name' => $this->Settings->site_name,
                'logo' => '<img src="' . base_url() . 'assets/uploads/logos/' . $biller->logo . '" alt="' . ($biller->company != '-' ? $biller->company : $biller->name) . '"/>',
            );
            $msg = file_get_contents('./themes/' . $this->Settings->theme . '/admin/views/email_templates/sale.html');
            $message = $this->parser->parse_string($msg, $parse_data);
            $this->load->model('pay_model');
            $paypal = $this->pay_model->getPaypalSettings();
            $skrill = $this->pay_model->getSkrillSettings();
            $btn_code = '<div id="payment_buttons" class="text-center margin010">';
            if (!empty($this->shop_settings->bank_details)) {
                echo '<div style="width:100%;">'.$this->shop_settings->bank_details.'</div><hr class="divider or">';
            }
            if ($paypal->active == "1" && $inv->grand_total != "0.00") {
                if (trim(strtolower($customer->country)) == $biller->country) {
                    $paypal_fee = $paypal->fixed_charges + ($inv->grand_total * $paypal->extra_charges_my / 100);
                } else {
                    $paypal_fee = $paypal->fixed_charges + ($inv->grand_total * $paypal->extra_charges_other / 100);
                }
                $btn_code .= '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=' . $paypal->account_email . '&item_name=' . $inv->reference_no . '&item_number=' . $inv->id . '&image_url=' . base_url() . 'assets/uploads/logos/' . $this->Settings->logo . '&amount=' . (($inv->grand_total - $inv->paid) + $paypal_fee) . '&no_shipping=1&no_note=1&currency_code=' . $this->default_currency->code . '&bn=BuyNow&rm=2&return=' . admin_url('sales/view/' . $inv->id) . '&cancel_return=' . admin_url('sales/view/' . $inv->id) . '&notify_url=' . admin_url('payments/paypalipn') . '&custom=' . $inv->reference_no . '__' . ($inv->grand_total - $inv->paid) . '__' . $paypal_fee . '"><img src="' . base_url('assets/images/btn-paypal.png') . '" alt="Pay by PayPal"></a> ';
            }
            if ($skrill->active == "1" && $inv->grand_total != "0.00") {
                if (trim(strtolower($customer->country)) == $biller->country) {
                    $skrill_fee = $skrill->fixed_charges + ($inv->grand_total * $skrill->extra_charges_my / 100);
                } else {
                    $skrill_fee = $skrill->fixed_charges + ($inv->grand_total * $skrill->extra_charges_other / 100);
                }
                $btn_code .= ' <a href="https://www.moneybookers.com/app/payment.pl?method=get&pay_to_email=' . $skrill->account_email . '&language=EN&merchant_fields=item_name,item_number&item_name=' . $inv->reference_no . '&item_number=' . $inv->id . '&logo_url=' . base_url() . 'assets/uploads/logos/' . $this->Settings->logo . '&amount=' . (($inv->grand_total - $inv->paid) + $skrill_fee) . '&return_url=' . admin_url('sales/view/' . $inv->id) . '&cancel_url=' . admin_url('sales/view/' . $inv->id) . '&detail1_description=' . $inv->reference_no . '&detail1_text=Payment for the sale invoice ' . $inv->reference_no . ': ' . $inv->grand_total . '(+ fee: ' . $skrill_fee . ') = ' . $this->sma->formatMoney($inv->grand_total + $skrill_fee) . '&currency=' . $this->default_currency->code . '&status_url=' . admin_url('payments/skrillipn') . '"><img src="' . base_url('assets/images/btn-skrill.png') . '" alt="Pay by Skrill"></a>';
            }

            $btn_code .= '<div class="clearfix"></div></div>';
            $message = $message . $btn_code;
            $attachment = $this->orders($id, null, true, 'S');
            $subject = lang('new_order_received');
            $sent = $error = $cc = $bcc = false;
            $cc = $customer->email;
            $bcc = $biller->email;
            $warehouse = $this->site->getWarehouseByID($inv->warehouse_id);
            if ($warehouse->email) {
                $bcc .= ','.$warehouse->email;
            }
            try {
                if ($this->sma->send_email(($user ? $user->email : $customer->email), $subject, $message, null, null, $attachment, $cc, $bcc)) {
                    delete_files($attachment);
                    $sent = true;
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
            return ['sent' => $sent, 'error' => $error];
        }
    }

    function getPrices(){
        $id = $this->input->get('id', TRUE);
        $qty = $this->input->get('qty', TRUE);
        $slug = $this->input->get('slug', TRUE);
        $type = $this->input->get('type', TRUE);
        $arr = [];
        $arr1 = [];
        $row = $this->shop_model->getPrices($id, $slug, $type);
        if (true) {
            if($type == "piano_transport"){
                $pr[] = array('id' => $row->id, 'price' => $row->price);
            }else if($type == "office_removal"){
                $price = 0;
                for ($k=0; $k < count($id); $k++) { 
                    $obj = $this->shop_model->getPrices1($id[$k], $slug, $type);
                    $price += $obj->price * (int)$qty[$k];
                }
                $row = $this->shop_model->getPrices($id, $slug, $type);
                $pr[] = array('id' => $row, 'price' => $price);
            }else if($type == "furniture_delivery"){
                $price = 0;
                for ($k=0; $k < count($id); $k++) { 
                    $obj = $this->shop_model->getPrices1($id[$k], $slug, $type);
                    $price += $obj->price * (int)$qty[$k];
                }
                $row = $this->shop_model->getPrices($id, $slug, $type);
                $pr[] = array('id' => $row, 'price' => $price);
            }else if($type == "house_removal"){
                $price = 0;
                for ($k=0; $k < count($id); $k++) { 
                    $obj = $this->shop_model->getPrices1($id[$k], $slug, $type);
                    $price += $obj->price * (int)$qty[$k];
                }
                $row = $this->shop_model->getPrices($id, $slug, $type);
                $pr[] = array('id' => $row, 'price' => $price);
            }else if($type == "man_and_van"){
                $price = 0;
                for ($k=0; $k < count($id); $k++) { 
                    $obj = $this->shop_model->getPrices1($id[$k], $slug, $type);
                    $price += $obj->price * (int)$qty[$k];
                }
                $row = $this->shop_model->getPrices($id, $slug, $type);
                $pr[] = array('id' => $row, 'price' => $price);
            }else if($type == "extra_services"){
                $price = 0;
                for ($k=0; $k < count($id); $k++) { 
                    $obj = $this->shop_model->getPrices1($id[$k], $slug, $type);
                    if(!empty($obj->price))
                    {
                        $price += $obj->price * (int)$qty[$k];
                    }
                }
                $row = $this->shop_model->getPrices($id, $slug, $type);
                $pr[] = array('id' => $row, 'price' => $price);
            }
            $this->sma->send_json($pr);
        } else {
            $this->sma->send_json(array(array('id' => 0, 'label' => "No Prices Added")));
        }
    }
    
    public function set_removal_session(){
		$this->ci =& get_instance();
		$array=array(
            'pickup_location'=>$this->input->get("pickup"),
            'drop_location'=>$this->input->get("drop"),
            'office_removal_slug'=>$this->input->get("slug"),
            'office_removal_type'=>$this->input->get("type")
		);
		$this->ci->session->set_userdata($array);
        $pr[] = array('pickup' => $this->session->userdata('pickup_location'),'drop' => $this->session->userdata('drop_location'),'slug' => $this->session->userdata('office_removal_slug'), 'type' => $this->session->userdata('office_removal_type'));
        $this->sma->send_json($pr);
    }
    
    public function set_furniture_session(){
		$this->ci =& get_instance();
		$array=array(
            'pickup_location'=>$this->input->get("pickup"),
            'drop_location'=>$this->input->get("drop"),
            'furniture_delivery_slug'=>$this->input->get("slug"),
            'furniture_delivery_type'=>$this->input->get("type")
		);
		$this->ci->session->set_userdata($array);
        $pr[] = array('pickup' => $this->session->userdata('pickup_location'),'drop' => $this->session->userdata('drop_location'),'slug' => $this->session->userdata('furniture_delivery_slug'), 'type' => $this->session->userdata('furniture_delivery_type'));
        $this->sma->send_json($pr);
    }
    
    public function set_house_session(){
		$this->ci =& get_instance();
		$array=array(
            'pickup_location'=>$this->input->get("pickup"),
            'drop_location'=>$this->input->get("drop"),
            'house_removal_slug'=>$this->input->get("slug"),
            'house_removal_type'=>$this->input->get("type")
		);
		$this->ci->session->set_userdata($array);
        $pr[] = array('pickup' => $this->session->userdata('pickup_location'),'drop' => $this->session->userdata('drop_location'),'slug' => $this->session->userdata('house_removal_slug'), 'type' => $this->session->userdata('house_removal_type'));
        $this->sma->send_json($pr);
    }
    
    public function set_locations(){
		// $this->ci =& get_instance();
		$array=array(
            'pickup_location'=>$this->input->get("pickup"),
            'drop_location'=>$this->input->get("drop"),
            'location_segment'=>$this->input->get("segment")
        );
        $this->session->set_userdata($array);
        $pr[] = array('pickup' => $this->session->userdata('pickup_location'), 'drop' => $this->session->userdata('drop_location'));
        $this->sma->send_json($pr);
    }
    public function set_prices(){
        $this->ci =& get_instance();
		$array=array(
            'p_price'=>$this->input->get("price"),
            'p_type'=>$this->input->get("type")
        );
		$this->ci->session->set_userdata($array);
        $pr[] = array('price' => $this->session->userdata('p_price'), 'type' => $this->session->userdata('p_type'));
        $this->sma->send_json($pr);
    }
    public function search_product()
    {
        $search_product = $this->input->GET('search_product');
        $product_type = $this->input->GET('product_type');
        $type = $this->input->GET('type');
        $active_tab = $this->input->GET('active_tab');
       $products = $this->shop_model->search_products($search_product , $product_type, $type);
       echo json_encode($products);
    }
    public function prices($storage_id=0)
    {
        if($storage_id>0)
        {
         $extra_services_price = 0;   
        $this->data['page_title'] = 'Prices';
        $this->data['menu_active'] = "Prices";
        $extra_services = $this->db->where('product_type',"extra_services")->where("parent !=", 0)->get('sma_products')->result_array();
        foreach($extra_services as $extra_service)
        {
            $extra_services_price += $extra_service['price'];
        }
        $this->data['extra_service_prices'] = $extra_services_price;
        $this->page_construct('priceOptions/prices', $this->data);
        }
        else
        {
            redirect(base_url());
        }
    }
    function extra_services($storage_id = 0) {
        if($storage_id>0)
        {
            $this->data['page_title'] = 'Extra Services';
            $this->data['menu_active'] = "Extra Services";
            $products = $this->shop_model->getProducts(null, "extra_services");
            foreach ($products as $p) {
                $p->sub_products = $this->shop_model->getProducts($p->id, "extra_services");
            }
            $this->data['products'] = $products;
            $this->page_construct('extraServices/index', $this->data);
        }
        else
        {
            redirect(base_url());
        }
    }
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function save_storage()
    {
      $storage_id = $this->input->get('storage_id');
      $edit_order = $this->input->get('edit_order');
    //   Below if is for Editing order process
      if(!empty($edit_order)){
        $data['order_id'] = $edit_order;
        $data['order_status'] = 'edit_order';
      }
      $data['pickup_location'] = $this->input->get("pickup");
      $data['drop_location'] = $this->input->get('drop');
    //   $data['ip_address'] =  $this->input->ip_address();
      $data['slug'] = $this->input->get('slug');
      $data['type'] = $this->input->get('type');
      $data['price'] = $this->input->get('price');
      $data['km'] = $this->input->get('km');
      $data['total'] = $this->input->get('total');
      $items = $this->input->get('items');
      if($items!=null)
      {
        $data['products_list'] = json_encode($items);
      }
      if($storage_id==0)
      {
        $cookie_name = "scot_cookie_id";
        $str = $this->generateRandomString(5);
        $cookie_value = $this->input->ip_address()."-".$str;
        setcookie($cookie_name, $cookie_value, time() + (8640000 * 30), "/");
        $data['cookie_id'] =  $cookie_value;
        $data['created_at'] =  date('Y-m-d H:i:s');
        $id = $this->shop_model->save_storage_info($data);
        echo json_encode($id);
      }
      else
      {
        if(isset($_COOKIE["scot_cookie_id"])) {
            $data['updated_at'] =  date('Y-m-d H:i:s');
            $id = $this->shop_model->update_storage_info($data, $_COOKIE["scot_cookie_id"]);
        }
        echo json_encode($storage_id);
      }
    }
    public function update_items_tdb()
    {
        $data['products_list'] = json_encode($this->input->get('items'));
        if(isset($_COOKIE["scot_cookie_id"])) {
            $this->shop_model->update_storage_info($data, $_COOKIE["scot_cookie_id"]);
        }
    }
    public function stripePost()
    {
        $storage_id = $this->input->get('storage_id');
        $storage = $this->shop_model->getStorageByID($storage_id);
        $order_amount = ($storage->total) *100;
        $randstring = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);

        require_once('app/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
        $payment = \Stripe\Charge::create ([
                "amount" => $order_amount,
                "currency" => "eur",
                "source" => $this->input->get('stripeToken'),
                "description" => 'Payment made successfully with Order Tracking number "'. $randstring.'". '
        ]);
        
        if($payment['status'] == 'succeeded'){
            // $this->shop_model->update_order(['order_status' => 'success','trackingID' => $randstring], $storage->order_id);
            $productlist = json_decode($storage->products_list);

            $newDate = date("Y-m-d", strtotime($storage->order_date));
            $orderdata = [
                'order_status' => 'success',
                'trackingID' => $randstring,
                'order_type' => $storage->type,
                'pickup_address' => $storage->pickup_location,
                'delivery_address' => $storage->drop_location,
                'order_price' => $storage->total,
                'order_date' => $newDate,
                'persons' => $storage->total_persons,
                'booking_first_last_name' => $storage->order_first_last_name,
                'bookig_email' => $storage->order_booking_email,
                'booking_phone' => $storage->order_booking_phone,
                'pickup_postal' => $storage->order_pickup_postcode,
                'pickup_name' => $storage->order_pickup_contact_name,
                'pickup_phone' => $storage->order_pickup_phone,
                'delivery_postal' => $storage->order_drop_postcode,
                'delivery_phone' => $storage->order_drop_phone,
                'delivery_name' => $storage->order_drop_contact_name,
                'strt_time'   => $storage->strt_time,
                'end_time'   => $storage->end_time,
            ];
            $order_insert_id = $this->shop_model->save_order($orderdata);

            $payment_data['payment_id'] = $payment['payment_method'];
            $payment_data['method'] = 'stripe';
            $payment_data['amount'] = $storage->total;
            $payment_data['order_id'] = $order_insert_id;
            $insert_id = $this->shop_model->save_payment_details($payment_data);

            foreach($productlist as $details){
                $data['order_id'] = $order_insert_id;
                $data['product_id'] = $details->id;
                $data['product_name'] = $details->name;
                $data['product_quantity'] = $details->quantity;
                $insert_id = $this->shop_model->save_order_details($data);
            }

            $order = $this->shop_model->get_order($order_insert_id);
            $total_item = 0;

            
            $html = '<div class="row mx-0 my-5">
                <div style="flex: 0 0 83.333333%;max-width: 83.333333%;margin-left:auto;margin-right:auto;">
                <div class="user-order-status" style="text-align:center;">
                    <div style="display:grid;grid-auto-flow:column;width:160px;height:160px;display:flex;margin-left:auto;margin-right:auto;margin-top:30px;border-radius:50%;justify-content:center;align-items:center;background:#0065bd;">
                       <img src="'.base_url('assets/uploads/logos/Website-Logo3.png').'" style="width:120px;margin:auto;"">
                    </div>
                    <div class="order-status-text">
                        <h5 style="margin-bottom: 30px; text-align:center;font-size: 32px;color: rgb(56, 56, 56);font-weight: bold;line-height: 1;margin-top:30px;">Your Booking Completed Successfully!</h5>
                        <p style="font-size: 26px;margin-bottom: 1.5rem!important;color: rgb(100, 100, 100);line-height: 1.385;text-align: center;margin-top:0px;">Thank you for ordering. We received your order <br>and will begin processing it soon.</p>
                    </div>
                    <div class="header-status-item">
                        <h5 style="font-size: 27px;color: rgb(62, 64, 66);font-weight: bold;line-height: 1.2;margin-bottom:20px;">Your Inventory</h5>
                    </div>'; 
                        foreach($order->order_details as $order_detail){ 
                            $total_item = $order_detail->product_quantity + $total_item;
                            $html .= '
                            <div class="order-status-items items-card-bar">
                                <div class="items-bar" style=" border-width: 1px;border-color: rgb(235, 235, 235);border-style: solid;border-radius: 8px;padding:10px 20px;margin-bottom:1px;display:flex;align-items:center;background:#fff;">
                                    <p  style="font-size: 15px;margin-bottom:0px; color: rgb(50, 52, 53);line-height: 1.2;margin-top:0px;">'.$order_detail->product_name.'</p>
                                    <p style="margin-left:auto; font-size: 15px;margin-bottom:0px; color: rgb(50, 52, 53);margin-top:0px;line-height: 1.2;">'.$order_detail->product_quantity.'</p>
                                </div>
                            </div>';
                        }
                        $html .= ' <div class="order-status-items">
                        <div class="items-bar" style="display:flex;border-width: 1px;border-color: rgb(235, 235, 235);border-style: solid;border-radius: 8px;padding:10px 20px;margin-bottom:1px;background:#fff;">
                            <div style="width: 33.33%;">
                                <div class="location-detail" style="text-align:left;">
                                    <h5 style=" margin-bottom: .5rem;margin-top:0px;font-size: 15px;color: rgb(50, 52, 53);font-weight: bold;line-height: 1.2;">Pick Up Location</h5>
                                    <span style="font-size: 15px;color: rgb(110, 110, 110);line-height: 1.2;">'.$order->pickup_address.'</span>
                                </div>
                            </div>
                            <div style="width: 33.33%;">
                                <img src="'.base_url('assets/images/location-sign.png').'" style="margin-top:7px;" >
                            </div>
                            <div style="width: 33.33%;">
                                <div class="location-detail" style="text-align:left;">
                                    <h5 style="width:fit-content;margin-left:auto;margin-bottom: .5rem;margin-top:0px;font-size: 15px;color: rgb(50, 52, 53);font-weight: bold;line-height: 1.2;">Drop Off Location</h5>
                                    <span style="display:block;width:fit-content;margin-left:auto;font-size: 15px;color: rgb(110, 110, 110);line-height: 1.2;">'.$order->delivery_address.'</span>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="order-status-items total-detail">
                            <div style="border-width: 1px;border-color: rgb(235, 235, 235);border-style: solid;border-radius: 8px; padding: 10px 20px;margin-bottom: 1px;">
                                <div class="" style="display:flex;align-items:center;margin-bottom: .25rem!important;padding-top:.25rem;">
                                    <p  style="font-size: 18px;margin-bottom:0px;line-height: 1.2;margin-top:0px;">Total Items</p>
                                    <h6  style="margin-left:auto;font-size: 18px;margin-bottom:0px;margin-top:0px;color: rgb(47, 47, 47);font-weight: bold;line-height: 1.2;">'.$total_item.'</h6>
                                </div>
                                <div style="display:flex;align-items:center;padding-top:.25rem;padding-bottom:.25rem;border-top:1px solid rgb(235, 235, 235);">
                                    <p style="margin-bottom:0px;margin-top:0px;font-size: 18px;line-height: 1.2;">Total Price</p>
                                    <h6  style="margin-left:auto;font-size: 18px;margin-bottom:0px;margin-top:0px;color: rgb(47, 47, 47);font-weight: bold;line-height: 1.2;">£'.number_format($order->order_price, 2).'</h6>
                                </div>
                            </div>
                        </div>
                        <div class="order-status-items" style="margin-top: 1.5rem!important;">
                            <div  style="display:flex;align-items:center;background:#0065bd;border-radius: 8px; padding: 10px 20px; margin-bottom: 1px;">
                                <p style="margin-top:0px;font-size: 18px;color: rgb(255, 255, 255);font-weight: bold;line-height: 1.2;margin-bottom:0px;">Tracking ID</p>
                                <p style="margin-left:auto;font-size: 18px;color: rgb(255, 255, 255);font-weight: bold;line-height: 1.2;margin-top:0px;margin-bottom:0px;">'.$order->trackingID.'</p>
                            </div>
                        </div>
                        <div class="view-order" style="margin-top: 1.5rem!important;width:100%;">
                            <a href="'.base_url('shop/my_order/'.$order->trackingID).'" style="color:#fff;text-decoration:none;  background:rgb(213, 4, 17);display:block;width:150px;text-align:center;border-radius:8px;padding:10px 10px;margin-left:auto;font-size:20px;">View Order</a>
                        </div>
                        <div style="margin-top:30px;">
                            <div style="position:relative;margin-bottom: .5rem!important">
                                <div style="position:absolute;bottom: -4px; left: -9px; z-index: 99;">
                                    <img src="'.base_url('assets/images/helpline.png').'" class="img-fluid helpline-img">
                                </div>
                                <div style="position:relative;padding-top:.25rem;padding-bottom:.25rem;overflow: hidden; background-color: #fff;box-shadow: 0px 2px 9px 0px rgba(0, 0, 0, 0.09);border-radius: 3px;color: #0065bd;line-height: 1.1;">
                                    <span class="helpline-shape"></span>
                                    <div class="mt-4 mb-4 px-5">
                                    <p class="helpline-text " style="margin-bottom:0px;text-align:center;font-size: 15px;font-weight: 600;">Prefer to get a price over the phone?</p>
                                    <p style="font-size: 29px;text-align:center;font-weight: 900;margin-top:10px;margin-bottom:1rem;"><a class="num-clr" href="tel:0141-390-8967">0141-390-8967</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

            $this->sma->send_email($order->bookig_email, "Tracking ID: ".$order->trackingID."", $html, "admin@scotremovals.com", "Scot Removals");
            $this->sma->send_email("attaurrehmaanbhatti687@gmail.com", "New Tracking ID: ".$order->trackingID."", $html, $order->bookig_email, $order->booking_first_last_name);
            $storage_data = array(
                'order_status' => 'ordered',
            );
            $deleted_storage = $this->shop_model->update_smastorage($storage_data,$storage_id);
            unset($_COOKIE['scot_cookie_id']);
            setcookie('scot_cookie_id', null, -1, '/');
            $this->session->set_flashdata('success', 'Payment made successfully with Order Tracking number "'. $randstring. '". ');
        }else{
            $this->session->set_flashdata('error', 'Error in Payment.');
        }
        // redirect(base_url());
        echo json_encode($order_insert_id);
        redirect('shop/order_success/'.$order_insert_id);
    }
    function order_success($order_id = null){
        $this->data['page_title'] = 'Order Success';
        $this->data['menu_active'] = "Order Success";
        $this->data['order'] = $this->shop_model->get_order($order_id);
        $this->page_construct('priceOptions/order_success', $this->data);
    }
    function my_order(){
        $total_seg = $this->uri->total_segments();
        $last = $this->uri->segment($total_seg);
        $this->data['order'] = $this->shop_model->edit_order($last);
        $this->data['page_title'] = 'My Orders';
        $this->data['menu_active'] = "my_order";
        // print_r($this->data['order']);die;
        $this->page_construct('myorders/index', $this->data);
    }
    public function privacy_policy()
    {
        $this->data['page'] = "";
        $this->data['page_title'] = "Privacy Policy";
        $this->data['page_desc'] = "Privacy Policy";
        $this->data['menu_active'] = "";
        $this->page_construct('privacy_policy', $this->data);
    }
}

class Events
{
    public $title;
    public $date;
}