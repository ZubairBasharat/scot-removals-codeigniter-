<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller{

    function __construct(){
        parent::__construct();
        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            $this->sma->md('login');
        }
        //$this->lang->admin_load('orders', $this->Settings->user_language);
        $this->load->library('form_validation');
        $this->load->admin_model('orders_model');
        $this->digital_upload_path = 'files/';
        $this->upload_path = 'assets/uploads/';
        $this->thumbs_path = 'assets/uploads/thumbs/';
        $this->image_types = 'gif|jpg|jpeg|png|tif';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif|txt';
        $this->allowed_file_size = '1024';
        $this->popup_attributes = array('width' => '900', 'height' => '600', 'window_name' => 'sma_popup', 'menubar' => 'yes', 'scrollbars' => 'yes', 'status' => 'no', 'resizable' => 'yes', 'screenx' => '0', 'screeny' => '0');

        $this->data['languages'] = pt_get_languages();
    }

    function index($warehouse_id = NULL){
        $this->sma->checkPermissions();

        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        
        $this->data['warehouses'] = NULL;    

        $this->data['supplier'] = $this->input->get('supplier') ? $this->site->getCompanyByID($this->input->get('supplier')) : NULL;
        $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => '#', 'page' => lang('orders')));
        $meta = array('page_title' => lang('orders'), 'bc' => $bc);
        $this->page_construct('orders/index', $meta, $this->data);
    }

    function getOrders($warehouse_id = NULL){
        $this->sma->checkPermissions('index', TRUE);

        if ((! $this->Owner || ! $this->Admin) && ! $warehouse_id) {
            $user = $this->site->getUser();
        }
        $detail_link = anchor('admin/orders/view/$1', '<i class="fa fa-file-text-o"></i> ' . lang('order_details'));
        $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line("delete_order") . "</b>' data-content=\"<p>"
            . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete1' id='a__$1' href='" . admin_url('order/delete/$1') . "'>"
            . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
            . lang('delete_order') . "</a>";

        $action = '<div class="text-center"><div class="btn-group text-left">'
            . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
            . lang('actions') . ' <span class="caret"></span></button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li>' . $detail_link . '</li>';
        $action .= '<li class="divider"></li>
            <li>' . $delete_link . '</li>
            </ul>
        </div></div>';
        $this->load->library('datatables');

        $this->datatables
        ->select($this->db->dbprefix('order') . ".id as orderid, {$this->db->dbprefix('order')}.booking_first_last_name as name, {$this->db->dbprefix('order')}.bookig_email as email, {$this->db->dbprefix('order')}.booking_phone as phone, {$this->db->dbprefix('order')}.delivery_name as delivery_name, {$this->db->dbprefix('order')}.delivery_phone as delivery_phone, {$this->db->dbprefix('order')}.persons as persons, {$this->db->dbprefix('order')}.order_price as price, {$this->db->dbprefix('order')}.order_date as order_date ", FALSE)
        ->from('order');
        
        $this->datatables->add_column("Actions", $action, "orderid, name, email, phone, delivery_name, delivery_phone, persons, price, order_date");
        echo $this->datatables->generate();
    }


    /* ------------------------------------------------------- */

    function add($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');
        $this->form_validation->set_rules('name', lang("floor_name"), 'required');
        $this->form_validation->set_rules('slug', lang("slug"), 'required');
        $this->form_validation->set_rules('lift_option', lang("floor_lift_option"), 'required');
        
        if ($this->form_validation->run() == true) {
            $data = array(
                'name' => $this->input->post('name'),
                'slug' => $this->input->post('slug'),
                'lift_option' => $this->input->post('lift_option'),
                'created_at' => date('Y-m-d H:i:s')
            );
        }

        if ($this->form_validation->run() == true && $id = $this->orders_model->addFloor($data)) {
            //$this->orders_model->updateProductTranslation($this->input->post('translated'), $id);

            $this->session->set_flashdata('message', lang("floor_added"));
            admin_redirect('floors');
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            // $this->data['categories'] = $this->site->getAllCategories();
            $this->data['floor'] = $id ? $this->orders_model->getFloorByID($id) : NULL;
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('floors'), 'page' => lang('floors')), array('link' => '#', 'page' => lang('add_floor')));
            $meta = array('page_title' => lang('add_floor'), 'bc' => $bc);
            $count = $this->orders_model->getFloorCount();
            if($count <= 500){
                $this->page_construct('floors/add', $meta, $this->data);
            }else{
                $this->session->set_flashdata('error', "You cannot add more than 500 products please contact to administrator!");
                return redirect('admin/floors');
            }
        }
    }
    
    /* -------------------------------------------------------- */

    function edit($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
        }
        $floor = $this->orders_model->getFloorByID($id);
        if (!$id || !$floor) {
            $this->session->set_flashdata('error', lang('floor_not_found'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        $this->form_validation->set_rules('name', lang("floor_name"), 'required');
        $this->form_validation->set_rules('slug', lang("slug"), 'required');
        $this->form_validation->set_rules('lift_option', lang("floor_lift_option"), 'required');
        
        if ($this->form_validation->run('floors/add') == true) {

            $data = array(
                'name' => $this->input->post('name'),
                'slug' => $this->input->post('slug'),
                'lift_option' => $this->input->post('lift_option')
            );
        }

        if ($this->form_validation->run() == true && $this->orders_model->updateFloor($id, $data)) {
            // $this->orders_model->updateProductTranslation($this->input->post('translated'), $id);

            $this->session->set_flashdata('message', lang("floor_updated"));
            admin_redirect('floors');
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['floor'] = $floor;
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('floors'), 'page' => lang('floors')), array('link' => '#', 'page' => lang('edit_floor')));
            $meta = array('page_title' => lang('edit_floor'), 'bc' => $bc);
            $this->page_construct('floors/edit', $meta, $this->data);
        }
    }

    /* ------------------------------------------------------------------------------- */

    function delete($id = NULL){
        $this->sma->checkPermissions(NULL, TRUE);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->orders_model->deleteOrder($id)) {
            if($this->input->is_ajax_request()) {
                $this->sma->send_json(array('error' => 0, 'msg' => lang("order_deleted")));
            }
            $this->session->set_flashdata('message', lang('order_deleted'));
            admin_redirect('welcome');
        }

    }

    /* --------------------------------------------------------------------------------------------- */

    function modal_view($id = NULL){
        $this->sma->checkPermissions('index', TRUE);

        $fr_details = $this->orders_model->getFloorByID($id);
        if (!$id || !$fr_details) {
            $this->session->set_flashdata('error', lang('floor_not_found'));
            $this->sma->md();
        }
        $this->data['floor'] = $fr_details;

        $this->load->view($this->theme.'floors/modal_view', $this->data);
    }

    function view($id = NULL){
        $this->sma->checkPermissions('index');
        $or_details = $this->orders_model->getOrderDetailsByID($id);
        if (!$id || !$or_details) {
            $this->session->set_flashdata('error', lang('order_not_found'));
            redirect($_SERVER["HTTP_REFERER"]);
        }

        $this->data['data'] = $or_details;

        $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('orders'), 'page' => lang('floors')), array('link' => '#', 'page' => $or_details[0]->trackingID));
        $meta = array('page_title' => "Order: ".$or_details[0]->trackingID, 'bc' => $bc);
        $this->page_construct('orders/view', $meta, $this->data);
    }
}
