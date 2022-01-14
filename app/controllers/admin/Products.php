<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller{

    function __construct(){
        parent::__construct();
        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            $this->sma->md('login');
        }
        $this->lang->admin_load('products', $this->Settings->user_language);
        $this->load->library('form_validation');
        $this->load->admin_model('products_model');
        $this->digital_upload_path = 'files/';
        $this->upload_path = 'assets/uploads/';
        $this->thumbs_path = 'assets/uploads/thumbs/';
        $this->image_types = 'gif|jpg|jpeg|png|tif|svg';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif|txt|svg';
        $this->allowed_file_size = '1024';
        $this->popup_attributes = array('width' => '900', 'height' => '600', 'window_name' => 'sma_popup', 'menubar' => 'yes', 'scrollbars' => 'yes', 'status' => 'no', 'resizable' => 'yes', 'screenx' => '0', 'screeny' => '0');

        $this->data['languages'] = pt_get_languages();
        $this->session->unset_userdata('pickup_location');
        $this->session->unset_userdata('drop_location');
        $this->session->unset_userdata('p_price');
        $this->session->unset_userdata('p_type');
    }

    /* -------------------Start Furniture Delivery------------------------------------ */

    function furniture_delivery($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');
        if($this->input->post('check') == "sub_product"){
            $this->form_validation->set_rules('sub_product_name', lang("name"), 'required');
            $this->form_validation->set_rules('product', lang("product"), 'required');
            $this->form_validation->set_rules('sub_product_price', lang("price"), 'required');
        }else{
            $this->form_validation->set_rules('product_image', lang("product_image"), 'xss_clean');
            $this->form_validation->set_rules('price', lang("price"), 'required');
            $this->form_validation->set_rules('name', lang("name"), 'required');
        }
        if ($this->form_validation->run() == true) {
            if($this->input->post('check') == "product"){
                $data = array(
                    'name' => $this->input->post('name'),
                    'price' => $this->sma->formatDecimal($this->input->post('price')),
                    'details' => "",
                    'type' => $this->input->post('check'),
                    'product_type' => "furniture_delivery"
                );
            }else{
                $data = array(
                    'name' => $this->input->post('sub_product_name'),
                    'price' => $this->sma->formatDecimal($this->input->post('sub_product_price')),
                    'parent' => $this->input->post('product'),
                    'type' => $this->input->post('check'),
                    'product_type' => "furniture_delivery"
                );
            }
            
            $this->load->library('upload');

            if ($_FILES['product_image']['size'] > 0) {

                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $this->Settings->iwidth;
                $config['max_height'] = $this->Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['max_filename'] = 25;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('product_image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("products/furniture_delivery");
                }
                $photo = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $this->Settings->twidth;
                $config['height'] = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                if ($this->Settings->watermark) {
                    $this->image_lib->clear();
                    $wm['source_image'] = $this->upload_path . $photo;
                    $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $this->Settings->site_name;
                    $wm['wm_type'] = 'text';
                    $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                    $wm['quality'] = '100';
                    $wm['wm_font_size'] = '16';
                    $wm['wm_font_color'] = '999999';
                    $wm['wm_shadow_color'] = 'CCCCCC';
                    $wm['wm_vrt_alignment'] = 'top';
                    $wm['wm_hor_alignment'] = 'left';
                    $wm['wm_padding'] = '10';
                    $this->image_lib->initialize($wm);
                    $this->image_lib->watermark();
                }
                $this->image_lib->clear();
                $config = NULL;
            }
        }

        if ($this->form_validation->run() == true && $id = $this->products_model->addProduct($data)) {
            if($this->input->post('check') == "product"){
                $this->session->set_flashdata('message', lang("product_added"));
            }else{
                $this->session->set_flashdata('message', "Sub Product successfully added");
            }
            admin_redirect('products/furniture_delivery');
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['products'] = $this->products_model->getAllProducts("furniture_delivery", "product");
            $this->data['sub_products'] = $this->products_model->getAllProducts("furniture_delivery", "sub_product");
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => "#", 'page' => lang('products')), array('link' => '#', 'page' => lang('furniture_delivery')));
            $meta = array('page_title' => lang('furniture_delivery'), 'bc' => $bc);
            // $count = $this->products_model->getProductCount("furniture_delivery");
            // if($count <= 500){
                $this->page_construct('products/furniture_delivery', $meta, $this->data);
            // }else{
            //     $this->session->set_flashdata('error', "You cannot add more than 500 products please contact to administrator!");
            //     return redirect('admin/products/furniture_delivery');
            // }
        }
    }

    /* -------------------End Furniture Delivery------------------------------------ */

    /* -------------------Start Furniture Delivery Edit------------------------------- */

    function furniture_delivery_edit($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
        }
        $product = $this->products_model->getProductByID($id);
        if (!$id || !$product) {
            $this->session->set_flashdata('error', lang('prduct_not_found'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        if($this->input->post('check') == "sub_product"){
            $this->form_validation->set_rules('sub_product_name', lang("name"), 'required');
            $this->form_validation->set_rules('product', lang("product"), 'required');
            $this->form_validation->set_rules('sub_product_price', lang("price"), 'required');
        }else{
            $this->form_validation->set_rules('product_image', lang("product_image"), 'xss_clean');
            $this->form_validation->set_rules('price', lang("price"), 'required');
            $this->form_validation->set_rules('name', lang("name"), 'required');
        }
        if ($this->form_validation->run() == true) {

            if($this->input->post('check') == "product"){
                $data = array(
                    'name' => $this->input->post('name'),
                    'price' => $this->sma->formatDecimal($this->input->post('price')),
                    'details' => "",
                    'type' => $this->input->post('check'),
                    'product_type' => "furniture_delivery"
                );
            }else{
                $data = array(
                    'name' => $this->input->post('sub_product_name'),
                    'price' => $this->sma->formatDecimal($this->input->post('sub_product_price')),
                    'parent' => $this->input->post('product'),
                    'type' => $this->input->post('check'),
                    'product_type' => "furniture_delivery"
                );
            }
        
            $this->load->library('upload');
            if ($_FILES['product_image']['size'] > 0) {

                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $this->Settings->iwidth;
                $config['max_height'] = $this->Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['max_filename'] = 25;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('product_image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("products/furniture_delivery");
                }
                $photo = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $this->Settings->twidth;
                $config['height'] = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                if ($this->Settings->watermark) {
                    $this->image_lib->clear();
                    $wm['source_image'] = $this->upload_path . $photo;
                    $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $this->Settings->site_name;
                    $wm['wm_type'] = 'text';
                    $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                    $wm['quality'] = '100';
                    $wm['wm_font_size'] = '16';
                    $wm['wm_font_color'] = '999999';
                    $wm['wm_shadow_color'] = 'CCCCCC';
                    $wm['wm_vrt_alignment'] = 'top';
                    $wm['wm_hor_alignment'] = 'left';
                    $wm['wm_padding'] = '10';
                    $this->image_lib->initialize($wm);
                    $this->image_lib->watermark();
                }
                $this->image_lib->clear();
                $config = NULL;
            }
        }

        if ($this->form_validation->run() == true && $this->products_model->updateProduct($id, $data)) {
            //$this->products_model->updateProductTranslation($this->input->post('translated'), $id);
            if($this->input->post('check') == "product"){
                $this->session->set_flashdata('message', "Product successfully edited");
            }else{
                $this->session->set_flashdata('message', "Sub Product successfully edited");
            }
            admin_redirect('products/furniture_delivery');
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['products'] = $this->products_model->getAllProducts("furniture_delivery", "product");
            $this->data['sub_products'] = $this->products_model->getAllProducts("furniture_delivery", "sub_product");
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => "#", 'page' => lang('products')), array('link' => '#', 'page' => lang('furniture_delivery')));
            $meta = array('page_title' => lang('furniture_delivery'), 'bc' => $bc);
            $this->page_construct('products/furniture_delivery', $meta, $this->data);
        }
    }

    /* -------------------End Furniture Delivery Edit------------------------------- */



    /* -------------------Start Man & Van------------------------------------ */

    function man_and_van($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');
        if($this->input->post('check') == "sub_product"){
            $this->form_validation->set_rules('sub_product_name', lang("name"), 'required');
            $this->form_validation->set_rules('product', lang("product"), 'required');
            $this->form_validation->set_rules('sub_product_price', lang("price"), 'required');
        }else{
            $this->form_validation->set_rules('product_image', lang("product_image"), 'xss_clean');
            $this->form_validation->set_rules('price', lang("price"), 'required');
            $this->form_validation->set_rules('name', lang("name"), 'required');
        }
        if ($this->form_validation->run() == true) {
            if($this->input->post('check') == "product"){
                $data = array(
                    'name' => $this->input->post('name'),
                    'price' => $this->sma->formatDecimal($this->input->post('price')),
                    'details' => "",
                    'type' => $this->input->post('check'),
                    'product_type' => "man_and_van"
                );
            }else{
                $data = array(
                    'name' => $this->input->post('sub_product_name'),
                    'price' => $this->sma->formatDecimal($this->input->post('sub_product_price')),
                    'parent' => $this->input->post('product'),
                    'type' => $this->input->post('check'),
                    'product_type' => "man_and_van"
                );
            }
            
            $this->load->library('upload');

            if ($_FILES['product_image']['size'] > 0) {

                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $this->Settings->iwidth;
                $config['max_height'] = $this->Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['max_filename'] = 25;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('product_image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("products/man_and_van");
                }
                $photo = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $this->Settings->twidth;
                $config['height'] = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                if ($this->Settings->watermark) {
                    $this->image_lib->clear();
                    $wm['source_image'] = $this->upload_path . $photo;
                    $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $this->Settings->site_name;
                    $wm['wm_type'] = 'text';
                    $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                    $wm['quality'] = '100';
                    $wm['wm_font_size'] = '16';
                    $wm['wm_font_color'] = '999999';
                    $wm['wm_shadow_color'] = 'CCCCCC';
                    $wm['wm_vrt_alignment'] = 'top';
                    $wm['wm_hor_alignment'] = 'left';
                    $wm['wm_padding'] = '10';
                    $this->image_lib->initialize($wm);
                    $this->image_lib->watermark();
                }
                $this->image_lib->clear();
                $config = NULL;
            }
        }

        if ($this->form_validation->run() == true && $id = $this->products_model->addProduct($data)) {
            if($this->input->post('check') == "product"){
                $this->session->set_flashdata('message', lang("product_added"));
            }else{
                $this->session->set_flashdata('message', "Sub Product successfully added");
            }
            admin_redirect('products/man_and_van');
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['products'] = $this->products_model->getAllProducts("man_and_van", "product");
            $this->data['sub_products'] = $this->products_model->getAllProducts("man_and_van", "sub_product");
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => "#", 'page' => lang('products')), array('link' => '#', 'page' => lang('man_and_van')));
            $meta = array('page_title' => lang('man_and_van'), 'bc' => $bc);
            // $count = $this->products_model->getProductCount("man_and_van");
            // if($count <= 500){
                $this->page_construct('products/man_and_van', $meta, $this->data);
            // }else{
            //     $this->session->set_flashdata('error', "You cannot add more than 500 products please contact to administrator!");
            //     return redirect('admin/products/man_and_van');
            // }
        }
    }

    /* -------------------End Man And Van------------------------------------ */

    /* -------------------Start Furniture Delivery Edit------------------------------- */

    function man_and_van_edit($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
        }
        $product = $this->products_model->getProductByID($id);
        if (!$id || !$product) {
            $this->session->set_flashdata('error', lang('prduct_not_found'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        if($this->input->post('check') == "sub_product"){
            $this->form_validation->set_rules('sub_product_name', lang("name"), 'required');
            $this->form_validation->set_rules('product', lang("product"), 'required');
            $this->form_validation->set_rules('sub_product_price', lang("price"), 'required');
        }else{
            $this->form_validation->set_rules('product_image', lang("product_image"), 'xss_clean');
            $this->form_validation->set_rules('price', lang("price"), 'required');
            $this->form_validation->set_rules('name', lang("name"), 'required');
        }
        if ($this->form_validation->run() == true) {

            if($this->input->post('check') == "product"){
                $data = array(
                    'name' => $this->input->post('name'),
                    'price' => $this->sma->formatDecimal($this->input->post('price')),
                    'details' => "",
                    'type' => $this->input->post('check'),
                    'product_type' => "man_and_van"
                );
            }else{
                $data = array(
                    'name' => $this->input->post('sub_product_name'),
                    'price' => $this->sma->formatDecimal($this->input->post('sub_product_price')),
                    'parent' => $this->input->post('product'),
                    'type' => $this->input->post('check'),
                    'product_type' => "man_and_van"
                );
            }
        
            $this->load->library('upload');
            if ($_FILES['product_image']['size'] > 0) {

                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $this->Settings->iwidth;
                $config['max_height'] = $this->Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['max_filename'] = 25;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('product_image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("products/man_and_van");
                }
                $photo = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $this->Settings->twidth;
                $config['height'] = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                if ($this->Settings->watermark) {
                    $this->image_lib->clear();
                    $wm['source_image'] = $this->upload_path . $photo;
                    $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $this->Settings->site_name;
                    $wm['wm_type'] = 'text';
                    $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                    $wm['quality'] = '100';
                    $wm['wm_font_size'] = '16';
                    $wm['wm_font_color'] = '999999';
                    $wm['wm_shadow_color'] = 'CCCCCC';
                    $wm['wm_vrt_alignment'] = 'top';
                    $wm['wm_hor_alignment'] = 'left';
                    $wm['wm_padding'] = '10';
                    $this->image_lib->initialize($wm);
                    $this->image_lib->watermark();
                }
                $this->image_lib->clear();
                $config = NULL;
            }
        }

        if ($this->form_validation->run() == true && $this->products_model->updateProduct($id, $data)) {
            //$this->products_model->updateProductTranslation($this->input->post('translated'), $id);
            if($this->input->post('check') == "product"){
                $this->session->set_flashdata('message', "Product successfully edited");
            }else{
                $this->session->set_flashdata('message', "Sub Product successfully edited");
            }
            admin_redirect('products/man_and_van');
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['products'] = $this->products_model->getAllProducts("man_and_van", "product");
            $this->data['sub_products'] = $this->products_model->getAllProducts("man_and_van", "sub_product");
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => "#", 'page' => lang('products')), array('link' => '#', 'page' => lang('man_and_van')));
            $meta = array('page_title' => lang('man_and_van'), 'bc' => $bc);
            $this->page_construct('products/man_and_van', $meta, $this->data);
        }
    }

    /* -------------------End Man And Van Edit------------------------------- */
    

    /* -------------------Start House Removal------------------------------------ */

    function house_removals($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');
        if($this->input->post('check') == "sub_product"){
            $this->form_validation->set_rules('sub_product_name', lang("name"), 'required');
            $this->form_validation->set_rules('product', lang("product"), 'required');
            $this->form_validation->set_rules('sub_product_price', lang("price"), 'required');
        }else if($this->input->post('check') == "property"){
            $this->form_validation->set_rules('category', "Category", 'required');
            $this->form_validation->set_rules('property_name', lang("property_name"), 'required');
            $this->form_validation->set_rules('slug', lang("slug"), 'required');
            $this->form_validation->set_rules('lift_option', lang("lift_option"), 'required');
        }else{
            $this->form_validation->set_rules('price', lang("price"), 'required');
            $this->form_validation->set_rules('name', lang("name"), 'required');
            // $this->form_validation->set_rules('product_font', lang("product_font"), 'required');
            $this->form_validation->set_rules('product_image', lang("product_image"), 'xss_clean');
        }
        if ($this->form_validation->run() == true) {
            if($this->input->post('check') == "product"){
                $data = array(
                    'name' => $this->input->post('name'),
                    'price' => $this->sma->formatDecimal($this->input->post('price')),
                    'order_by' => $this->input->post('order_by'),
                    'details' => "",
                    'type' => $this->input->post('check'),
                    'product_type' => "house_removals",
                    // "font" => $this->input->post('product_font')
                );
            }else if($this->input->post('check') == "property"){
                $data = array(
                    'name' => $this->input->post('property_name'),
                    // 'price' => $this->sma->formatDecimal($this->input->post('price')),
                    'details' => "",
                    'type' => $this->input->post('check'),
                    'product_type' => "house_removals",
                    'parent' => $this->input->post('category'),
                    'slug' => $this->input->post('slug'),
                    'lift_option' => $this->input->post('lift_option')
                );
            }else{
                $data = array(
                    'name' => $this->input->post('sub_product_name'),
                    'price' => $this->sma->formatDecimal($this->input->post('sub_product_price')),
                    'parent' => $this->input->post('product'),
                    'type' => $this->input->post('check'),
                    'order_by' => $this->input->post('sub_product_order'),
                    'product_type' => "house_removals"
                );
            }
            
            $this->load->library('upload');

            if ($_FILES['product_image']['size'] > 0) {

                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $this->Settings->iwidth;
                $config['max_height'] = $this->Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['max_filename'] = 25;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('product_image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("products/house_removals");
                }
                $photo = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $this->Settings->twidth;
                $config['height'] = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                if ($this->Settings->watermark) {
                    $this->image_lib->clear();
                    $wm['source_image'] = $this->upload_path . $photo;
                    $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $this->Settings->site_name;
                    $wm['wm_type'] = 'text';
                    $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                    $wm['quality'] = '100';
                    $wm['wm_font_size'] = '16';
                    $wm['wm_font_color'] = '999999';
                    $wm['wm_shadow_color'] = 'CCCCCC';
                    $wm['wm_vrt_alignment'] = 'top';
                    $wm['wm_hor_alignment'] = 'left';
                    $wm['wm_padding'] = '10';
                    $this->image_lib->initialize($wm);
                    $this->image_lib->watermark();
                }
                $this->image_lib->clear();
                $config = NULL;
            }
        }

        if ($this->form_validation->run() == true && $id = $this->products_model->addProduct($data)) {
            if($this->input->post('check') == "product"){
                $this->session->set_flashdata('message', lang("product_added"));
            }else if($this->input->post('check') == "property"){
                $this->session->set_flashdata('message', "Property successfully added");
            }else{
                $this->session->set_flashdata('message', "Sub Product successfully added");
            }
            admin_redirect('products/house_removals');
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['categories'] = $this->products_model->getAllCategories();
            $this->data['properties'] = $this->products_model->getAllProducts("house_removals", "property");
            $this->data['products'] = $this->products_model->getAllProducts("house_removals", "product");
            $this->data['sub_products'] = $this->products_model->getAllProducts("house_removals", "sub_product");
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => "#", 'page' => lang('products')), array('link' => '#', 'page' => lang('house_removals')));
            $meta = array('page_title' => lang('house_removals'), 'bc' => $bc);
            // $count = $this->products_model->getProductCount("house_removals");
            // if($count <= 500){
            $this->page_construct('products/house_removals', $meta, $this->data);
            // }else{
            //     $this->session->set_flashdata('error', "You cannot add more than 500 products please contact to administrator!");
            //     return redirect('admin/products/house_removals');
            // }
        }
    }

    function house_removals_category($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');
        $this->form_validation->set_rules('category_name', lang("category_name"), 'required');
        // $this->form_validation->set_rules('category_font', lang("category_font"), 'required');
        if ($this->form_validation->run() == true) {
            $data = array(
                'category_name' => $this->input->post('category_name'),
                'category_font' => ""
            );
            
            $this->load->library('upload');

            if ($_FILES['category_image']['size'] > 0) {

                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $this->Settings->iwidth;
                $config['max_height'] = $this->Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['max_filename'] = 25;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('category_image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("products/house_removals");
                }
                $photo = $this->upload->file_name;
                $data['category_image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $this->Settings->twidth;
                $config['height'] = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                if ($this->Settings->watermark) {
                    $this->image_lib->clear();
                    $wm['source_image'] = $this->upload_path . $photo;
                    $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $this->Settings->site_name;
                    $wm['wm_type'] = 'text';
                    $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                    $wm['quality'] = '100';
                    $wm['wm_font_size'] = '16';
                    $wm['wm_font_color'] = '999999';
                    $wm['wm_shadow_color'] = 'CCCCCC';
                    $wm['wm_vrt_alignment'] = 'top';
                    $wm['wm_hor_alignment'] = 'left';
                    $wm['wm_padding'] = '10';
                    $this->image_lib->initialize($wm);
                    $this->image_lib->watermark();
                }
                $this->image_lib->clear();
                $config = NULL;
            }
        }

        if ($this->form_validation->run() == true && $id = $this->products_model->addProductCategory($data)) {
            $this->session->set_flashdata('message', "Category successfully added");
            admin_redirect('products/house_removals');
        } else {
            $this->session->set_flashdata('error', "Category not added");
            admin_redirect('products/house_removals');
        }
    }

    /* -------------------End House Removal------------------------------------ */

    /* -------------------Start House Removal Edit------------------------------- */

    function house_removals_edit($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
        }
        $product = $this->products_model->getProductByID($id);
        if (!$id || !$product) {
            $this->session->set_flashdata('error', lang('prduct_not_found'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        if($this->input->post('check') == "sub_product"){
            $this->form_validation->set_rules('sub_product_name', lang("name"), 'required');
            $this->form_validation->set_rules('product', lang("product"), 'required');
            $this->form_validation->set_rules('sub_product_price', lang("price"), 'required');
        }else if($this->input->post('check') == "property"){
            $this->form_validation->set_rules('category', "Category", 'required');
            $this->form_validation->set_rules('property_name', lang("property_name"), 'required');
            $this->form_validation->set_rules('slug', lang("slug"), 'required');
            $this->form_validation->set_rules('lift_option', lang("lift_option"), 'required');
        }else{
            $this->form_validation->set_rules('price', lang("price"), 'required');
            $this->form_validation->set_rules('name', lang("name"), 'required');
            // $this->form_validation->set_rules('product_font', lang("product_font"), 'required');
            $this->form_validation->set_rules('product_image', lang("product_image"), 'xss_clean');
        }
        if ($this->form_validation->run() == true) {

            if($this->input->post('check') == "product"){
                $data = array(
                    'name' => $this->input->post('name'),
                    'price' => $this->sma->formatDecimal($this->input->post('price')),
                    'order_by' => $this->input->post('order_by'),
                    'details' => "",
                    'type' => $this->input->post('check'),
                    'product_type' => "house_removals",
                    // "font" => $this->input->post('product_font')
                );
            }else if($this->input->post('check') == "property"){
                $data = array(
                    'name' => $this->input->post('property_name'),
                    // 'price' => $this->sma->formatDecimal($this->input->post('price')),
                    'details' => "",
                    'type' => $this->input->post('check'),
                    'product_type' => "house_removals",
                    'parent' => $this->input->post('category'),
                    'slug' => $this->input->post('slug'),
                    'lift_option' => $this->input->post('lift_option')
                );
            }else{
                $data = array(
                    'name' => $this->input->post('sub_product_name'),
                    'price' => $this->sma->formatDecimal($this->input->post('sub_product_price')),
                    'parent' => $this->input->post('product'),
                    'type' => $this->input->post('check'),
                    'order_by' => $this->input->post('sub_product_order'),
                    'product_type' => "house_removals"
                );
            }
        
            $this->load->library('upload');
            if ($_FILES['product_image']['size'] > 0) {

                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $this->Settings->iwidth;
                $config['max_height'] = $this->Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['max_filename'] = 25;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('product_image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("products/house_removals");
                }
                $photo = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $this->Settings->twidth;
                $config['height'] = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                if ($this->Settings->watermark) {
                    $this->image_lib->clear();
                    $wm['source_image'] = $this->upload_path . $photo;
                    $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $this->Settings->site_name;
                    $wm['wm_type'] = 'text';
                    $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                    $wm['quality'] = '100';
                    $wm['wm_font_size'] = '16';
                    $wm['wm_font_color'] = '999999';
                    $wm['wm_shadow_color'] = 'CCCCCC';
                    $wm['wm_vrt_alignment'] = 'top';
                    $wm['wm_hor_alignment'] = 'left';
                    $wm['wm_padding'] = '10';
                    $this->image_lib->initialize($wm);
                    $this->image_lib->watermark();
                }
                $this->image_lib->clear();
                $config = NULL;
            }
        }

        if ($this->form_validation->run() == true && $this->products_model->updateProduct($id, $data)) {
            //$this->products_model->updateProductTranslation($this->input->post('translated'), $id);
            if($this->input->post('check') == "product"){
                $this->session->set_flashdata('message', "Product successfully edited");
            }else if($this->input->post('check') == "property"){
                $this->session->set_flashdata('message', "Property successfully edited");
            }else{
                $this->session->set_flashdata('message', "Sub Product successfully edited");
            }
            admin_redirect('products/house_removals');
        } else {
            // $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            // $this->data['products'] = $this->products_model->getAllProducts("furniture_delivery", "product");
            // $this->data['sub_products'] = $this->products_model->getAllProducts("furniture_delivery", "sub_product");
            // $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => "#", 'page' => lang('products')), array('link' => '#', 'page' => lang('furniture_delivery')));
            // $meta = array('page_title' => lang('furniture_delivery'), 'bc' => $bc);
            // $this->page_construct('products/furniture_delivery', $meta, $this->data);

            if($this->input->post('check') == "product"){
                $this->session->set_flashdata('error', "Product not edited");
            }else if($this->input->post('check') == "property"){
                $this->session->set_flashdata('error', "Property not edited");
            }else{
                $this->session->set_flashdata('error', "Sub Product not edited");
            }
            return redirect('admin/products/house_removals');
        }
    }

    function house_removals_category_edit($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
        }
        $category = $this->products_model->getProductCategoryByID($id);
        if (!$id || !$category) {
            $this->session->set_flashdata('error', "Category not found");
            redirect($_SERVER["HTTP_REFERER"]);
        }
        $this->form_validation->set_rules('category_name', lang("category_name"), 'required');
        // $this->form_validation->set_rules('category_font', lang("category_font"), 'required');
        
        if ($this->form_validation->run() == true) {
            $data = array(
                'category_name' => $this->input->post('category_name'),
                'category_font' => ""
            );

            $this->load->library('upload');
            if ($_FILES['category_image']['size'] > 0) {

                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $this->Settings->iwidth;
                $config['max_height'] = $this->Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['max_filename'] = 25;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('category_image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("products/house_removals");
                }
                $photo = $this->upload->file_name;
                $data['category_image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $this->Settings->twidth;
                $config['height'] = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                if ($this->Settings->watermark) {
                    $this->image_lib->clear();
                    $wm['source_image'] = $this->upload_path . $photo;
                    $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $this->Settings->site_name;
                    $wm['wm_type'] = 'text';
                    $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                    $wm['quality'] = '100';
                    $wm['wm_font_size'] = '16';
                    $wm['wm_font_color'] = '999999';
                    $wm['wm_shadow_color'] = 'CCCCCC';
                    $wm['wm_vrt_alignment'] = 'top';
                    $wm['wm_hor_alignment'] = 'left';
                    $wm['wm_padding'] = '10';
                    $this->image_lib->initialize($wm);
                    $this->image_lib->watermark();
                }
                $this->image_lib->clear();
                $config = NULL;
            }
        }

        if ($this->form_validation->run() == true && $this->products_model->updateProductCategory($id, $data)) {
            //$this->products_model->updateProductTranslation($this->input->post('translated'), $id);
            $this->session->set_flashdata('message', "Category successfully edited");
            admin_redirect('products/house_removals');
        } else {
            $this->session->set_flashdata('error', "Category not edited");
            admin_redirect('products/house_removals');
        }
    }

    /* -------------------End House Removal Edit------------------------------- */


     /* -------------------Start Piano Removals------------------------------------ */

    function piano_transport($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');

        $this->form_validation->set_rules('product_image', lang("product_image"), 'xss_clean');
        $this->form_validation->set_rules('price', lang("price"), 'required');
        $this->form_validation->set_rules('name', lang("name"), 'required');

        if ($this->form_validation->run() == true) {

            $data = array(
                'name' => $this->input->post('name'),
                'price' => $this->sma->formatDecimal($this->input->post('price')),
                'details' => "",
                'type' => $this->input->post('check'),
                'product_type' => "piano_transport"
            );
            
            $this->load->library('upload');

            if ($_FILES['product_image']['size'] > 0) {

                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $this->Settings->iwidth;
                $config['max_height'] = $this->Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['max_filename'] = 25;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('product_image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("products/piano_transport");
                }
                $photo = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $this->Settings->twidth;
                $config['height'] = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                if ($this->Settings->watermark) {
                    $this->image_lib->clear();
                    $wm['source_image'] = $this->upload_path . $photo;
                    $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $this->Settings->site_name;
                    $wm['wm_type'] = 'text';
                    $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                    $wm['quality'] = '100';
                    $wm['wm_font_size'] = '16';
                    $wm['wm_font_color'] = '999999';
                    $wm['wm_shadow_color'] = 'CCCCCC';
                    $wm['wm_vrt_alignment'] = 'top';
                    $wm['wm_hor_alignment'] = 'left';
                    $wm['wm_padding'] = '10';
                    $this->image_lib->initialize($wm);
                    $this->image_lib->watermark();
                }
                $this->image_lib->clear();
                $config = NULL;
            }
        }

        if ($this->form_validation->run() == true && $id = $this->products_model->addProduct($data)) {
            $this->session->set_flashdata('message', lang("product_added"));
            admin_redirect('products/piano_transport');
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['products'] = $this->products_model->getAllProducts("piano_transport", "product");
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => "#", 'page' => lang('products')), array('link' => '#', 'page' => lang('piano_transport')));
            $meta = array('page_title' => lang('piano_transport'), 'bc' => $bc);
            // $count = $this->products_model->getProductCount("piano_transport");
            // if($count <= 500){
                $this->page_construct('products/piano_transport', $meta, $this->data);
            // }else{
            //     $this->session->set_flashdata('error', "You cannot add more than 500 products please contact to administrator!");
            //     return redirect('admin/products/piano_transport');
            // }
        }
    }

    /* -------------------End Piano Removals------------------------------------ */


    /* -------------------Start Office Removals------------------------------------ */

    function office_removals($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');

        // $this->form_validation->set_rules('product_image', lang("product_image"), 'xss_clean');
        $this->form_validation->set_rules('price', lang("price"), 'required');
        $this->form_validation->set_rules('name', lang("name"), 'required');

        if ($this->form_validation->run() == true) {

            $data = array(
                'name' => $this->input->post('name'),
                'price' => $this->sma->formatDecimal($this->input->post('price')),
                'details' => "",
                'type' => $this->input->post('check'),
                'product_type' => "office_removals"
            );
        }

        if ($this->form_validation->run() == true && $id = $this->products_model->addProduct($data)) {
            $this->session->set_flashdata('message', lang("product_added"));
            admin_redirect('products/office_removals');
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['products'] = $this->products_model->getAllProducts("office_removals", "product");
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => "#", 'page' => lang('products')), array('link' => '#', 'page' => lang('office_removals')));
            $meta = array('page_title' => lang('office_removals'), 'bc' => $bc);
            // $count = $this->products_model->getProductCount("office_removals");
            // if($count <= 500){
                $this->page_construct('products/office_removals', $meta, $this->data);
            // }else{
            //     $this->session->set_flashdata('error', "You cannot add more than 500 products please contact to administrator!");
            //     return redirect('admin/products/office_removals');
            // }
        }
    }

    /* -------------------End Office Removal ------------------------------------ */

    /* -------------------Start Piano Removals Edit------------------------------- */

    function piano_transport_edit($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
        }
        $product = $this->products_model->getProductByID($id);
        if (!$id || !$product) {
            $this->session->set_flashdata('error', lang('prduct_not_found'));
            redirect($_SERVER["HTTP_REFERER"]);
        }

        $this->form_validation->set_rules('product_image', lang("product_image"), 'xss_clean');
        $this->form_validation->set_rules('price', lang("price"), 'required');
        $this->form_validation->set_rules('name', lang("name"), 'required');
        
        if ($this->form_validation->run() == true) {
            $data = array(
                'name' => $this->input->post('name'),
                'price' => $this->sma->formatDecimal($this->input->post('price')),
                'details' => "",
                'type' => $this->input->post('check'),
                'product_type' => "piano_transport"
            );
        
            $this->load->library('upload');
            if ($_FILES['product_image']['size'] > 0) {

                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $this->Settings->iwidth;
                $config['max_height'] = $this->Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['max_filename'] = 25;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('product_image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("products/piano_transport");
                }
                $photo = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $this->Settings->twidth;
                $config['height'] = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                if ($this->Settings->watermark) {
                    $this->image_lib->clear();
                    $wm['source_image'] = $this->upload_path . $photo;
                    $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $this->Settings->site_name;
                    $wm['wm_type'] = 'text';
                    $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                    $wm['quality'] = '100';
                    $wm['wm_font_size'] = '16';
                    $wm['wm_font_color'] = '999999';
                    $wm['wm_shadow_color'] = 'CCCCCC';
                    $wm['wm_vrt_alignment'] = 'top';
                    $wm['wm_hor_alignment'] = 'left';
                    $wm['wm_padding'] = '10';
                    $this->image_lib->initialize($wm);
                    $this->image_lib->watermark();
                }
                $this->image_lib->clear();
                $config = NULL;
            }
        }

        if ($this->form_validation->run() == true && $this->products_model->updateProduct($id, $data)) {
            //$this->products_model->updateProductTranslation($this->input->post('translated'), $id);
            $this->session->set_flashdata('message', "Product successfully edited");
            admin_redirect('products/piano_transport');
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['products'] = $this->products_model->getAllProducts("piano_transport", "product");
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => "#", 'page' => lang('products')), array('link' => '#', 'page' => lang('piano_transport')));
            $meta = array('page_title' => lang('piano_transport'), 'bc' => $bc);
            $this->page_construct('products/piano_transport', $meta, $this->data);
        }
    }

    /* -------------------End Piano Removals Edit------------------------------- */

     /* -------------------Start Office Removals Edit------------------------------- */

     function office_removals_edit($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
        }
        $product = $this->products_model->getProductByID($id);
        if (!$id || !$product) {
            $this->session->set_flashdata('error', lang('prduct_not_found'));
            redirect($_SERVER["HTTP_REFERER"]);
        }

        // $this->form_validation->set_rules('product_image', lang("product_image"), 'xss_clean');
        $this->form_validation->set_rules('price', lang("price"), 'required');
        $this->form_validation->set_rules('name', lang("name"), 'required');
        
        if ($this->form_validation->run() == true) {
            $data = array(
                'name' => $this->input->post('name'),
                'price' => $this->sma->formatDecimal($this->input->post('price')),
                'details' => "",
                'type' => $this->input->post('check'),
                'product_type' => "office_removals"
            );
        }

        if ($this->form_validation->run() == true && $this->products_model->updateProduct($id, $data)) {
            //$this->products_model->updateProductTranslation($this->input->post('translated'), $id);
            $this->session->set_flashdata('message', "Product successfully edited");
            admin_redirect('products/office_removals');
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['products'] = $this->products_model->getAllProducts("office_removals", "product");
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => "#", 'page' => lang('products')), array('link' => '#', 'page' => lang('office_removals')));
            $meta = array('page_title' => lang('office_removals'), 'bc' => $bc);
            $this->page_construct('products/office_removals', $meta, $this->data);
        }
    }

    /* -------------------End Office Removals Edit------------------------------- */

    function getProductByID(){
        $id = $this->input->get('id', TRUE);
        $type = $this->input->get('type', TRUE);
        $row = $this->products_model->getProductByIDType($id, $type);
        if ($row) {
            // foreach ($rows as $row) {
                if($type == "product"){
                    $pr[] = array('id' => $row->id, 'name' => $row->name, 'details' => $row->details, 'image' => $row->image, 'price' => $row->price, 'type' => $row->type, 'order' => $row->order_by);
                }else if($type == "property"){
                    $pr[] = array('id' => $row->id, 'name' => $row->name, 'type' => $row->type, 'parent_name' => $row->parent_name, 'lift_option' => $row->lift_option, 'slug' => $row->slug);
                }else{
                    $pr[] = array('id' => $row->id, 'name' => $row->name,  'order_by' => $row->order_by, 'details' => $row->details, 'image' => $row->image, 'price' => $row->price, 'type' => $row->type, 'parent_name' => $row->parent_name);
                }
            // }
            $this->sma->send_json($pr);
        } else {
            $this->sma->send_json(array(array('id' => 0, 'label' => lang('no_match_found'))));
        }
    }
    
    function getPricesByID(){
        $id = $this->input->get('id', TRUE);
        $row = $this->products_model->getPricesByID($id);
        if ($row) {
            $pr[] = array('id' => $row->id, 'product_id' => $row->product_id, 'g_to_g' => $row->ground_to_ground, 'g_to_1' => $row->ground_to_first, 'g_to_2' => $row->ground_to_second, 'g_to_3' => $row->ground_to_third, 'g_to_4' => $row->ground_to_fourth, 'g_to_5' => $row->ground_to_fifth, 'g_to_6' => $row->ground_to_sixth, 'one_to_g' => $row->first_to_ground, 'one_to_1' => $row->first_to_first, 'one_to_2' => $row->first_to_second, 'one_to_3' => $row->first_to_third, 'one_to_4' => $row->first_to_fourth, 'one_to_5' => $row->first_to_fifth, 'one_to_6' => $row->first_to_sixth, 'two_to_g' => $row->second_to_ground, 'two_to_1' => $row->second_to_first, 'two_to_2' => $row->second_to_second, 'two_to_3' => $row->second_to_third, 'two_to_4' => $row->second_to_fourth, 'two_to_5' => $row->second_to_fifth, 'two_to_6' => $row->second_to_sixth, 'three_to_g' => $row->third_to_ground, 'three_to_1' => $row->third_to_first, 'three_to_2' => $row->third_to_second, 'three_to_3' => $row->third_to_third, 'three_to_4' => $row->third_to_fourth, 'three_to_5' => $row->third_to_fifth, 'three_to_6' => $row->third_to_sixth, 'fourth_to_g' => $row->fourth_to_ground, 'fourth_to_1' => $row->fourth_to_first, 'fourth_to_2' => $row->fourth_to_second, 'fourth_to_3' => $row->fourth_to_third, 'fourth_to_4' => $row->fourth_to_fourth, 'fourth_to_5' => $row->fourth_to_fifth, 'fourth_to_6' => $row->fourth_to_sixth, 'fifth_to_g' => $row->fifth_to_ground, 'fifth_to_1' => $row->fifth_to_first, 'fifth_to_2' => $row->fifth_to_second, 'fifth_to_3' => $row->fifth_to_third, 'fifth_to_4' => $row->fifth_to_fourth, 'fifth_to_5' => $row->fifth_to_fifth, 'fifth_to_6' => $row->fifth_to_sixth, 'sixth_to_g' => $row->sixth_to_ground, 'sixth_to_1' => $row->sixth_to_first, 'sixth_to_2' => $row->sixth_to_second, 'sixth_to_3' => $row->sixth_to_third, 'sixth_to_4' => $row->sixth_to_fourth, 'sixth_to_5' => $row->sixth_to_fifth, 'sixth_to_6' => $row->sixth_to_sixth, 'per_floor_price' => $row->per_floor_price, 'per_mile_price' => $row->per_mile_price);
            $this->sma->send_json($pr);
        } else {
            $this->sma->send_json(array(array('id' => 0, 'label' => lang('no_match_found'))));
        }
    }

    function getProductCategoryByID(){
        $id = $this->input->get('id', TRUE);
        $row = $this->products_model->getProductCategoryByID($id);
        // print_r($row);exit;
        if ($row) {
            // foreach ($rows as $row) {
                $pr[] = array('id' => $row->id, 'name' => $row->category_name, 'font' => $row->category_font, 'image' => $row->category_image);
            // }
            $this->sma->send_json($pr);
        } else {
            $this->sma->send_json(array(array('id' => 0, 'label' => lang('no_match_found'))));
        }
    }

    /* ------------------------------------------------------------------------------- */

    function delete($id = NULL){
        $this->sma->checkPermissions(NULL, TRUE);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }
        $count = $this->products_model->getSubProducts($id);
        if($count > 0){
            $this->session->set_flashdata('error', "This Product Have Sub Products!");
            if($this->input->is_ajax_request()) {
                $this->sma->send_json(array('error' => 1, 'msg' => "This Product Have Sub Products"));
                admin_redirect('products/furniture_delivery');
            }
        }
        if ($this->products_model->deleteProduct($id)) {
            if($this->input->is_ajax_request()) {
                $this->sma->send_json(array('error' => 0, 'msg' => lang("product_deleted")));
            }
            $this->session->set_flashdata('message', lang('product_deleted'));
            admin_redirect('products/furniture_delivery');
        }

    }

    function deletePiano($id = NULL){
        $this->sma->checkPermissions(NULL, TRUE);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }
        if ($this->products_model->deleteProduct($id)) {
            if($this->input->is_ajax_request()) {
                $this->sma->send_json(array('error' => 0, 'msg' => lang("product_deleted")));
            }
            $this->session->set_flashdata('message', lang('product_deleted'));
            admin_redirect('products/piano_transport');
        }

    }

    function deleteOfficeRemovals($id = NULL){
        $this->sma->checkPermissions(NULL, TRUE);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }
        if ($this->products_model->deleteProduct($id)) {
            if($this->input->is_ajax_request()) {
                $this->sma->send_json(array('error' => 0, 'msg' => lang("product_deleted")));
            }
            $this->session->set_flashdata('message', lang('product_deleted'));
            admin_redirect('products/office_removals');
        }

    }

    function deleteHouseRemovals($id = NULL){
        $this->sma->checkPermissions(NULL, TRUE);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }
        $count = $this->products_model->getSubProducts($id);
        if($count > 0){
            $this->session->set_flashdata('error', "This Product Have Sub Products!");
            if($this->input->is_ajax_request()) {
                $this->sma->send_json(array('error' => 1, 'msg' => "This Product Have Sub Products"));
                admin_redirect('products/house_removals');
            }
        }
        if ($this->products_model->deleteProduct($id)) {
            if($this->input->is_ajax_request()) {
                $this->sma->send_json(array('error' => 0, 'msg' => lang("product_deleted")));
            }
            $this->session->set_flashdata('message', lang('product_deleted'));
            admin_redirect('products/house_removals');
        }

    }

    function deleteHouseRemovals1($id = NULL){
        $this->sma->checkPermissions(NULL, TRUE);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }
        
        if ($this->products_model->deleteProduct($id)) {
            if($this->input->is_ajax_request()) {
                $this->sma->send_json(array('error' => 0, 'msg' => lang("product_deleted")));
            }
            $this->session->set_flashdata('message', lang('product_deleted'));
            admin_redirect('products/house_removals');
        }

    }


    function delete_product_category($id = NULL){
        $this->sma->checkPermissions(NULL, TRUE);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }
        $count = $this->products_model->getProperties($id);
        if($count > 0){
            $this->session->set_flashdata('error', "This Category Have Properties!");
            if($this->input->is_ajax_request()) {
                $this->sma->send_json(array('error' => 1, 'msg' => "This Category Have Properties"));
                admin_redirect('products/house_removals');
            }
        }
        if ($this->products_model->deleteProductCategory($id)) {
            if($this->input->is_ajax_request()) {
                $this->sma->send_json(array('error' => 0, 'msg' => "Category deleted successfully"));
            }
            $this->session->set_flashdata('message', "Category deleted successfully");
            admin_redirect('products/house_removals');
        }

    }

    function delete_property($id = NULL){
        $this->sma->checkPermissions(NULL, TRUE);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }
        
        if ($this->products_model->deleteProduct($id)) {
            if($this->input->is_ajax_request()) {
                $this->sma->send_json(array('error' => 0, 'msg' => "Property deleted successfully"));
            }
            $this->session->set_flashdata('message', "Property deleted successfully");
            admin_redirect('products/house_removals');
        }

    }

    function add_product_prices($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');
        // $this->form_validation->set_rules('name', lang("name"), 'required');

        // if ($this->form_validation->run() == true) {
        if (true) {
            if(isset($_POST['o_b_house_to_o_b_house'])){
                $o_b_house_to_o_b_house = $this->sma->formatDecimal($this->input->post('o_b_house_to_o_b_house'));
                $o_b_house_to_t_b_house = $this->sma->formatDecimal($this->input->post('o_b_house_to_t_b_house'));
                $o_b_house_to_th_b_house = $this->sma->formatDecimal($this->input->post('o_b_house_to_th_b_house'));
                $o_b_house_to_fp_b_house = $this->sma->formatDecimal($this->input->post('o_b_house_to_fp_b_house'));
                $o_b_house_to_storage_unit = $this->sma->formatDecimal($this->input->post('o_b_house_to_storage_unit'));

                $t_b_house_to_o_b_house = $this->sma->formatDecimal($this->input->post('t_b_house_to_o_b_house'));
                $t_b_house_to_t_b_house = $this->sma->formatDecimal($this->input->post('t_b_house_to_t_b_house'));
                $t_b_house_to_th_b_house = $this->sma->formatDecimal($this->input->post('t_b_house_to_th_b_house'));
                $t_b_house_to_fp_b_house = $this->sma->formatDecimal($this->input->post('t_b_house_to_fp_b_house'));
                $t_b_house_to_storage_unit = $this->sma->formatDecimal($this->input->post('t_b_house_to_storage_unit'));

                $th_b_house_to_o_b_house = $this->sma->formatDecimal($this->input->post('th_b_house_to_o_b_house'));
                $th_b_house_to_t_b_house = $this->sma->formatDecimal($this->input->post('th_b_house_to_t_b_house'));
                $th_b_house_to_th_b_house = $this->sma->formatDecimal($this->input->post('th_b_house_to_th_b_house'));
                $th_b_house_to_fp_b_house = $this->sma->formatDecimal($this->input->post('th_b_house_to_fp_b_house'));
                $th_b_house_to_storage_unit = $this->sma->formatDecimal($this->input->post('th_b_house_to_storage_unit'));

                $fp_b_house_to_o_b_house = $this->sma->formatDecimal($this->input->post('fp_b_house_to_o_b_house'));
                $fp_b_house_to_t_b_house = $this->sma->formatDecimal($this->input->post('fp_b_house_to_t_b_house'));
                $fp_b_house_to_th_b_house = $this->sma->formatDecimal($this->input->post('fp_b_house_to_th_b_house'));
                $fp_b_house_to_fp_b_house = $this->sma->formatDecimal($this->input->post('fp_b_house_to_fp_b_house'));
                $fp_b_house_to_storage_unit = $this->sma->formatDecimal($this->input->post('fp_b_house_to_storage_unit'));

                $storage_unit_to_o_b_house = $this->sma->formatDecimal($this->input->post('storage_unit_to_o_b_house'));
                $storage_unit_to_t_b_house = $this->sma->formatDecimal($this->input->post('storage_unit_to_t_b_house'));
                $storage_unit_to_th_b_house = $this->sma->formatDecimal($this->input->post('storage_unit_to_th_b_house'));
                $storage_unit_to_fp_b_house = $this->sma->formatDecimal($this->input->post('storage_unit_to_fp_b_house'));
                $storage_unit_to_storage_unit = $this->sma->formatDecimal($this->input->post('storage_unit_to_storage_unit'));
            }else{
                $o_b_house_to_o_b_house = 0;
                $o_b_house_to_t_b_house = 0;
                $o_b_house_to_th_b_house = 0;
                $o_b_house_to_fp_b_house = 0;
                $o_b_house_to_storage_unit = 0;

                $t_b_house_to_o_b_house = 0;
                $t_b_house_to_t_b_house = 0;
                $t_b_house_to_th_b_house = 0;
                $t_b_house_to_fp_b_house = 0;
                $t_b_house_to_storage_unit = 0;

                $th_b_house_to_o_b_house = 0;
                $th_b_house_to_t_b_house = 0;
                $th_b_house_to_th_b_house = 0;
                $th_b_house_to_fp_b_house = 0;
                $th_b_house_to_storage_unit = 0;

                $fp_b_house_to_o_b_house = 0;
                $fp_b_house_to_t_b_house = 0;
                $fp_b_house_to_th_b_house = 0;
                $fp_b_house_to_fp_b_house = 0;
                $fp_b_house_to_storage_unit = 0;

                $storage_unit_to_o_b_house = 0;
                $storage_unit_to_t_b_house = 0;
                $storage_unit_to_th_b_house = 0;
                $storage_unit_to_fp_b_house = 0;
                $storage_unit_to_storage_unit = 0;
            }
            $data = array(
                'product_id' => $this->input->post('prd_id'),
                'ground_to_ground' => $this->sma->formatDecimal($this->input->post('g_to_g')),
                'ground_to_first' => $this->sma->formatDecimal($this->input->post('g_to_1')),
                'ground_to_second' => $this->sma->formatDecimal($this->input->post('g_to_2')),
                'ground_to_third' => $this->sma->formatDecimal($this->input->post('g_to_3')),
                'ground_to_fourth' => $this->sma->formatDecimal($this->input->post('g_to_4')),
                'ground_to_fifth' => $this->sma->formatDecimal($this->input->post('g_to_5')),
                'ground_to_sixth' => $this->sma->formatDecimal($this->input->post('g_to_6')),
                'first_to_ground' => $this->sma->formatDecimal($this->input->post('1_to_g')),
                'first_to_first' => $this->sma->formatDecimal($this->input->post('1_to_1')),
                'first_to_second' => $this->sma->formatDecimal($this->input->post('1_to_2')),
                'first_to_third' => $this->sma->formatDecimal($this->input->post('1_to_3')),
                'first_to_fourth' => $this->sma->formatDecimal($this->input->post('1_to_4')),
                'first_to_fifth' => $this->sma->formatDecimal($this->input->post('1_to_5')),
                'first_to_sixth' => $this->sma->formatDecimal($this->input->post('1_to_6')),
                'second_to_ground' => $this->sma->formatDecimal($this->input->post('2_to_g')),
                'second_to_first' => $this->sma->formatDecimal($this->input->post('2_to_1')),
                'second_to_second' => $this->sma->formatDecimal($this->input->post('2_to_2')),
                'second_to_third' => $this->sma->formatDecimal($this->input->post('2_to_3')),
                'second_to_fourth' => $this->sma->formatDecimal($this->input->post('2_to_4')),
                'second_to_fifth' => $this->sma->formatDecimal($this->input->post('2_to_5')),
                'second_to_sixth' => $this->sma->formatDecimal($this->input->post('2_to_6')),
                'third_to_ground' => $this->sma->formatDecimal($this->input->post('3_to_g')),
                'third_to_first' => $this->sma->formatDecimal($this->input->post('3_to_1')),
                'third_to_second' => $this->sma->formatDecimal($this->input->post('3_to_2')),
                'third_to_third' => $this->sma->formatDecimal($this->input->post('3_to_3')),
                'third_to_fourth' => $this->sma->formatDecimal($this->input->post('3_to_4')),
                'third_to_fifth' => $this->sma->formatDecimal($this->input->post('3_to_5')),
                'third_to_sixth' => $this->sma->formatDecimal($this->input->post('3_to_6')),
                'fourth_to_ground' => $this->sma->formatDecimal($this->input->post('4_to_g')),
                'fourth_to_first' => $this->sma->formatDecimal($this->input->post('4_to_1')),
                'fourth_to_second' => $this->sma->formatDecimal($this->input->post('4_to_2')),
                'fourth_to_third' => $this->sma->formatDecimal($this->input->post('4_to_3')),
                'fourth_to_fourth' => $this->sma->formatDecimal($this->input->post('4_to_4')),
                'fourth_to_fifth' => $this->sma->formatDecimal($this->input->post('4_to_5')),
                'fourth_to_sixth' => $this->sma->formatDecimal($this->input->post('4_to_6')),
                'fifth_to_ground' => $this->sma->formatDecimal($this->input->post('5_to_g')),
                'fifth_to_first' => $this->sma->formatDecimal($this->input->post('5_to_1')),
                'fifth_to_second' => $this->sma->formatDecimal($this->input->post('5_to_2')),
                'fifth_to_third' => $this->sma->formatDecimal($this->input->post('5_to_3')),
                'fifth_to_fourth' => $this->sma->formatDecimal($this->input->post('5_to_4')),
                'fifth_to_fifth' => $this->sma->formatDecimal($this->input->post('5_to_5')),
                'fifth_to_sixth' => $this->sma->formatDecimal($this->input->post('5_to_6')),
                'sixth_to_ground' => $this->sma->formatDecimal($this->input->post('6_to_g')),
                'sixth_to_first' => $this->sma->formatDecimal($this->input->post('6_to_1')),
                'sixth_to_second' => $this->sma->formatDecimal($this->input->post('6_to_2')),
                'sixth_to_third' => $this->sma->formatDecimal($this->input->post('6_to_3')),
                'sixth_to_fourth' => $this->sma->formatDecimal($this->input->post('6_to_4')),
                'sixth_to_fifth' => $this->sma->formatDecimal($this->input->post('6_to_5')),
                'sixth_to_sixth' => $this->sma->formatDecimal($this->input->post('6_to_6')),
                'per_floor_price' => $this->sma->formatDecimal($this->input->post('per_floor_price')),
                'per_mile_price' => $this->sma->formatDecimal($this->input->post('per_mile_price')),
                'o_b_house_to_o_b_house' => $o_b_house_to_o_b_house,
                'o_b_house_to_t_b_house' => $o_b_house_to_t_b_house,
                'o_b_house_to_th_b_house' => $o_b_house_to_th_b_house,
                'o_b_house_to_fp_b_house' => $o_b_house_to_fp_b_house,
                'o_b_house_to_storage_unit' => $o_b_house_to_storage_unit,
                't_b_house_to_o_b_house' => $t_b_house_to_o_b_house,
                't_b_house_to_t_b_house' => $t_b_house_to_t_b_house,
                't_b_house_to_th_b_house' => $t_b_house_to_th_b_house,
                't_b_house_to_fp_b_house' => $t_b_house_to_fp_b_house,
                't_b_house_to_storage_unit' => $t_b_house_to_storage_unit,
                'th_b_house_to_o_b_house' => $th_b_house_to_o_b_house,
                'th_b_house_to_t_b_house' => $th_b_house_to_t_b_house,
                'th_b_house_to_th_b_house' => $th_b_house_to_th_b_house,
                'th_b_house_to_fp_b_house' => $th_b_house_to_fp_b_house,
                'th_b_house_to_storage_unit' => $th_b_house_to_storage_unit,
                'fp_b_house_to_o_b_house' => $fp_b_house_to_o_b_house,
                'fp_b_house_to_t_b_house' => $fp_b_house_to_t_b_house,
                'fp_b_house_to_th_b_house' => $fp_b_house_to_th_b_house,
                'fp_b_house_to_fp_b_house' => $fp_b_house_to_fp_b_house,
                'fp_b_house_to_storage_unit' => $fp_b_house_to_storage_unit,
                'storage_unit_to_o_b_house' => $storage_unit_to_o_b_house,
                'storage_unit_to_t_b_house' => $storage_unit_to_t_b_house,
                'storage_unit_to_th_b_house' => $storage_unit_to_th_b_house,
                'storage_unit_to_fp_b_house' => $storage_unit_to_fp_b_house,
                'storage_unit_to_storage_unit' => $storage_unit_to_storage_unit,
            );
        }

        $type = $this->input->post('type');
        // if ($this->form_validation->run() == true && $id = $this->products_model->addPrices($data, $this->input->post('prd_id'))) {
        if ($type == "add") {
            $id = $this->products_model->addPrices($data, $this->input->post('prd_id'));
            $this->session->set_flashdata('message', lang("prices_added"));
            admin_redirect('products/'.$this->input->post('action').'');
        } else if ($type == "update") {
            $success = $this->products_model->updatePrices($data, $this->input->post('update_id'));
            $this->session->set_flashdata('message', lang("prices_updated"));
            admin_redirect('products/'.$this->input->post('action').'');
        } else {
            admin_redirect('products/'.$this->input->post('action').'');
        }
    }


    /* -------------------Start Extra Services------------------------------------ */

    function extra_services($id = NULL){
        $this->sma->checkPermissions();
        $this->load->helper('security');
        if($this->input->post('check') == "sub_product"){
            $this->form_validation->set_rules('sub_product_name', lang("name"), 'required');
            $this->form_validation->set_rules('product', lang("product"), 'required');
            $this->form_validation->set_rules('sub_product_price', lang("price"), 'required');
        }else{
            $this->form_validation->set_rules('product_image', lang("product_image"), 'xss_clean');
            $this->form_validation->set_rules('price', lang("price"), 'required');
            $this->form_validation->set_rules('name', lang("name"), 'required');
        }
        if ($this->form_validation->run() == true) {
            if($this->input->post('check') == "product"){
                $data = array(
                    'name' => $this->input->post('name'),
                    'price' => $this->sma->formatDecimal($this->input->post('price')),
                    'details' => "",
                    'type' => $this->input->post('check'),
                    'product_type' => "extra_services"
                );
            }else{
                $data = array(
                    'name' => $this->input->post('sub_product_name'),
                    'price' => $this->sma->formatDecimal($this->input->post('sub_product_price')),
                    'parent' => $this->input->post('product'),
                    'type' => $this->input->post('check'),
                    'product_type' => "extra_services"
                );
            }
            
            $this->load->library('upload');

            if ($_FILES['product_image']['size'] > 0) {

                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $this->Settings->iwidth;
                $config['max_height'] = $this->Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['max_filename'] = 25;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('product_image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("products/extra_services");
                }
                $photo = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $this->Settings->twidth;
                $config['height'] = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                if ($this->Settings->watermark) {
                    $this->image_lib->clear();
                    $wm['source_image'] = $this->upload_path . $photo;
                    $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $this->Settings->site_name;
                    $wm['wm_type'] = 'text';
                    $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                    $wm['quality'] = '100';
                    $wm['wm_font_size'] = '16';
                    $wm['wm_font_color'] = '999999';
                    $wm['wm_shadow_color'] = 'CCCCCC';
                    $wm['wm_vrt_alignment'] = 'top';
                    $wm['wm_hor_alignment'] = 'left';
                    $wm['wm_padding'] = '10';
                    $this->image_lib->initialize($wm);
                    $this->image_lib->watermark();
                }
                $this->image_lib->clear();
                $config = NULL;
            }
        }

        if ($this->form_validation->run() == true && $id = $this->products_model->addProduct($data)) {
            if($this->input->post('check') == "product"){
                $this->session->set_flashdata('message', lang("product_added"));
            }else{
                $this->session->set_flashdata('message', "Sub Product successfully added");
            }
            admin_redirect('products/extra_services');
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['products'] = $this->products_model->getAllProducts("extra_services", "product");
            $this->data['sub_products'] = $this->products_model->getAllProducts("extra_services", "sub_product");
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => "#", 'page' => lang('products')), array('link' => '#', 'page' => lang('extra_services')));
            $meta = array('page_title' => lang('extra_services'), 'bc' => $bc);
            // $count = $this->products_model->getProductCount("man_and_van");
            // if($count <= 500){
                $this->page_construct('products/extra_services', $meta, $this->data);
            // }else{
            //     $this->session->set_flashdata('error', "You cannot add more than 500 products please contact to administrator!");
            //     return redirect('admin/products/man_and_van');
            // }
        }
    }
    public function extra_services_edit($id=null)
    {
        $data = array(
            'name' => $this->input->post('sub_product_name'),
            'price' => $this->sma->formatDecimal($this->input->post('sub_product_price')),
            'parent' => $this->input->post('product'),
            'type' => $this->input->post('check'),
            'product_type' => "extra_services"
        );
        $this->db->where('id',$id)->update('sma_products',$data);
        $pr = array(
            'product_id' => $id,
            'ground_to_ground' => $data['price'],
            'ground_to_first' => $data['price'],
            'ground_to_second' => $data['price'],
            'ground_to_third' => $data['price'],
            'ground_to_fourth' => $data['price'],
            'ground_to_fifth' => $data['price'],
            'ground_to_sixth' => $data['price'],
            'first_to_ground' => $data['price'],
            'first_to_first' => $data['price'],
            'first_to_second' => $data['price'],
            'first_to_third' => $data['price'],
            'first_to_fourth' => $data['price'],
            'first_to_fifth' => $data['price'],
            'first_to_sixth' => $data['price'],
            'second_to_ground' => $data['price'],
            'second_to_first' => $data['price'],
            'second_to_second' => $data['price'],
            'second_to_third' => $data['price'],
            'second_to_fourth' => $data['price'],
            'second_to_fifth' => $data['price'],
            'second_to_sixth' => $data['price'],
            'third_to_ground' => $data['price'],
            'third_to_first' => $data['price'],
            'third_to_second' => $data['price'],
            'third_to_third' => $data['price'],
            'third_to_fourth' => $data['price'],
            'third_to_fifth' => $data['price'],
            'third_to_sixth' => $data['price'],
            'fourth_to_ground' => $data['price'],
            'fourth_to_first' => $data['price'],
            'fourth_to_second' => $data['price'],
            'fourth_to_third' => $data['price'],
            'fourth_to_fourth' => $data['price'],
            'fourth_to_fifth' => $data['price'],
            'fourth_to_sixth' => $data['price'],
            'fifth_to_ground' => $data['price'],
            'fifth_to_first' => $data['price'],
            'fifth_to_second' => $data['price'],
            'fifth_to_third' => $data['price'],
            'fifth_to_fourth' => $data['price'],
            'fifth_to_fifth' => $data['price'],
            'fifth_to_sixth' => $data['price'],
            'sixth_to_first' => $data['price'],
            'sixth_to_second' => $data['price'],
            'sixth_to_third' => $data['price'],
            'sixth_to_fourth' => $data['price'],
            'sixth_to_fifth' => $data['price'],
            'sixth_to_sixth' => $data['price'],
            'per_floor_price' => 0,
            'per_mile_price' => 0,
            'o_b_house_to_o_b_house' => 0,
            'o_b_house_to_t_b_house' => 0,
            'o_b_house_to_th_b_house' => 0,
            'o_b_house_to_fp_b_house' => 0,
            'o_b_house_to_storage_unit' => 0,
            't_b_house_to_o_b_house' => 0,
            't_b_house_to_t_b_house' => 0,
            't_b_house_to_th_b_house' => 0,
            't_b_house_to_fp_b_house' => 0,
            't_b_house_to_storage_unit' => 0,
            'th_b_house_to_o_b_house' => 0,
            'th_b_house_to_t_b_house' => 0,
            'th_b_house_to_th_b_house' => 0,
            'th_b_house_to_fp_b_house' => 0,
            'th_b_house_to_storage_unit' => 0,
            'fp_b_house_to_o_b_house' => 0,
            'fp_b_house_to_t_b_house' => 0,
            'fp_b_house_to_th_b_house' => 0,
            'fp_b_house_to_fp_b_house' => 0,
            'fp_b_house_to_storage_unit' => 0,
            'storage_unit_to_o_b_house' => 0,
            'storage_unit_to_t_b_house' => 0,
            'storage_unit_to_th_b_house' => 0,
            'storage_unit_to_fp_b_house' => 0,
            'storage_unit_to_storage_unit' => 0,
        );
        $this->db->where('product_id',$id)->update('sma_products_prices',$pr);
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $this->data['products'] = $this->products_model->getAllProducts("extra_services", "product");
        $this->data['sub_products'] = $this->products_model->getAllProducts("extra_services", "sub_product");
        $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => "#", 'page' => lang('products')), array('link' => '#', 'page' => lang('extra_services')));
        $meta = array('page_title' => lang('extra_services'), 'bc' => $bc);
        $this->page_construct('products/extra_services', $meta, $this->data);
    }
    /* -------------------End Extra Services------------------------------------ */

     /* -------------------Premium Services start------------------------------------ */
     public function premium_services()
     {
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $this->data['products'] = $this->products_model->getAllProducts("extra_services", "product");
        $this->data['sub_products'] =  $this->db->query('SELECT p1.*, p2.name as parent_name FROM sma_products as p1 LEFT OUTER JOIN sma_products as p2 on p1.parent = p2.id WHERE  p1.product_type = "house_removals" AND p1.type = "sub_product" ')->result();
        // print_r( $this->data['sub_products']);die;
        $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => "#", 'page' => lang('products')), array('link' => '#', 'page' => lang('premium_services')));
        $meta = array('page_title' => lang('premium_services'), 'bc' => $bc);
        // $count = $this->products_model->getProductCount("man_and_van");
        // if($count <= 500){
        $this->page_construct('products/premium_services', $meta, $this->data);
     }
     public function add_to_premium($id)
     {
        $data = array(
            'product_id' => $id,
            'ground_to_ground' => $this->sma->formatDecimal($this->input->post('g_t_g')),
            'ground_to_first' => $this->sma->formatDecimal($this->input->post('g_t_first')),
            'ground_to_second' => $this->sma->formatDecimal($this->input->post('g_t_second')),
            'ground_to_third' => $this->sma->formatDecimal($this->input->post('g_t_third')),
            'ground_to_fourth' => $this->sma->formatDecimal($this->input->post('g_t_fourth')),
        );
        $this->db->insert('sma_premium_prices',$data);
        // $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        // $this->data['products'] = $this->products_model->getAllProducts("extra_services", "product");
        // $this->data['sub_products'] =  $this->db->query('SELECT p1.*, p2.name as parent_name FROM sma_products as p1 LEFT OUTER JOIN sma_products as p2 on p1.parent = p2.id WHERE  p1.type = "sub_product" ')->result();
        // // print_r( $this->data['sub_products']);die;
        // $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => "#", 'page' => lang('products')), array('link' => '#', 'page' => lang('extra_services')));
        // $meta = array('page_title' => lang('extra_services'), 'bc' => $bc);
        // $this->page_construct('products/premium_services', $meta, $this->data);
        redirect('admin/products/premium_services');

     }


     /* -------------------Premium Services End----------------------------------- */

}
