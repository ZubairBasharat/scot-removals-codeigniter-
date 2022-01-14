<?php defined('BASEPATH') OR exit('No direct script access allowed');

class system_settings extends MY_Controller{

    function __construct(){
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            $this->sma->md('login');
        }

        if (!$this->Owner) {
            $this->session->set_flashdata('warning', lang('access_denied'));
            redirect('admin');
        }
        $this->lang->admin_load('settings', $this->Settings->user_language);
        $this->load->library('form_validation');
        $this->load->admin_model('settings_model');
        $this->upload_path = 'assets/uploads/';
        $this->thumbs_path = 'assets/uploads/thumbs/';
        $this->image_types = 'gif|jpg|jpeg|png|tif';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif';
        $this->allowed_file_size = '1024';

        $this->data['languages'] = pt_get_languages();
    }

    function index(){
        $this->form_validation->set_rules('site_name', lang('site_name'), 'trim|required');
        //$this->form_validation->set_rules('logo', lang('logo'), 'trim');
        
        $this->form_validation->set_rules('currency', lang('default_currency'), 'trim|required');
        $this->form_validation->set_rules('email', lang('default_email'), 'trim|required');
        $this->form_validation->set_rules('language', lang('language'), 'trim|required');
        $this->form_validation->set_rules('rows_per_page', lang('rows_per_page'), 'trim|required');
        $this->form_validation->set_rules('protocol', lang('email_protocol'), 'trim|required');
        if ($this->input->post('protocol') == 'smtp') {
            $this->form_validation->set_rules('smtp_host', lang('smtp_host'), 'required');
            $this->form_validation->set_rules('smtp_user', lang('smtp_user'), 'required');
            $this->form_validation->set_rules('smtp_pass', lang('smtp_pass'), 'required');
            $this->form_validation->set_rules('smtp_port', lang('smtp_port'), 'required');
        }
        if ($this->input->post('protocol') == 'sendmail') {
            $this->form_validation->set_rules('mailpath', lang('mailpath'), 'required');
        }

        if ($this->form_validation->run() == true) {

            $language = $this->input->post('language');

            if ((file_exists(APPPATH.'language'.DIRECTORY_SEPARATOR.$language.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'sma_lang.php') && is_dir(APPPATH.DIRECTORY_SEPARATOR.'language'.DIRECTORY_SEPARATOR.$language)) || $language == 'english') {
                $lang = $language;
            } else {
                $this->session->set_flashdata('error', lang('language_x_found'));
                admin_redirect("system_settings");
                $lang = 'english';
            }

            $data = array('site_name' => DEMO ? 'Order App' : $this->input->post('site_name'),
                'rows_per_page' => $this->input->post('rows_per_page'),
                'default_email' => DEMO ? 'noreply@adroitlight.com' : $this->input->post('email'),
                'language' => $lang,
                'reference_format' => $this->input->post('reference_format'),
                'protocol' => DEMO ? 'mail' : $this->input->post('protocol'),
                'mailpath' => $this->input->post('mailpath'),
                'smtp_host' => $this->input->post('smtp_host'),
                'smtp_user' => $this->input->post('smtp_user'),
                'smtp_port' => $this->input->post('smtp_port'),
                'smtp_crypto' => $this->input->post('smtp_crypto') ? $this->input->post('smtp_crypto') : NULL,
                'display_all_products' => $this->input->post('display_all_products'),
            );
            if ($this->input->post('smtp_pass')) {
                $data['smtp_pass'] = $this->input->post('smtp_pass');
            }
        }

        if ($this->form_validation->run() == true && $this->settings_model->updateSetting($data)) {
            $this->session->set_flashdata('message', lang('setting_updated'));
            admin_redirect("system_settings");
        } else {
            $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['settings'] = $this->settings_model->getSettings();
            $this->data['currencies'] = $this->settings_model->getAllCurrencies();
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => '#', 'page' => lang('system_settings')));
            $meta = array('page_title' => lang('system_settings'), 'bc' => $bc);
            $this->page_construct('settings/index', $meta, $this->data);
        }
    }

    function change_logo(){
        if (DEMO) {
            $this->session->set_flashdata('warning', lang('disabled_in_demo'));
            $this->sma->md();
        }
        $this->load->helper('security');
        $this->form_validation->set_rules('site_logo', lang("site_logo"), 'xss_clean');
        $this->form_validation->set_rules('login_logo', lang("login_logo"), 'xss_clean');
        $this->form_validation->set_rules('biller_logo', lang("biller_logo"), 'xss_clean');
        if ($this->form_validation->run() == true) {

            // if ($_FILES['site_logo']['size'] > 0) {
            //     $this->load->library('upload');
            //     $config['upload_path'] = $this->upload_path . 'logos/';
            //     $config['allowed_types'] = $this->image_types;
            //     $config['max_size'] = $this->allowed_file_size;
            //     $config['max_width'] = 300;
            //     $config['max_height'] = 80;
            //     $config['overwrite'] = FALSE;
            //     $config['max_filename'] = 25;
            //     //$config['encrypt_name'] = TRUE;
            //     $this->upload->initialize($config);
            //     if (!$this->upload->do_upload('site_logo')) {
            //         $error = $this->upload->display_errors();
            //         $this->session->set_flashdata('error', $error);
            //         redirect($_SERVER["HTTP_REFERER"]);
            //     }
            //     $site_logo = $this->upload->file_name;
            //     $this->db->update('settings', array('logo' => $site_logo), array('setting_id' => 1));
            // }

            if ($_FILES['login_logo']['size'] > 0) {
                $this->load->library('upload');
                $config['upload_path'] = $this->upload_path . 'logos/';
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = 300;
                $config['max_height'] = 80;
                $config['overwrite'] = FALSE;
                $config['max_filename'] = 25;
                //$config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('login_logo')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect($_SERVER["HTTP_REFERER"]);
                }
                $login_logo = $this->upload->file_name;
                $this->db->update('settings', array('logo2' => $login_logo), array('setting_id' => 1));
            }

            $this->session->set_flashdata('message', lang('logo_uploaded'));
            redirect($_SERVER["HTTP_REFERER"]);

        } elseif ($this->input->post('upload_logo')) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER["HTTP_REFERER"]);
        } else {
            $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'settings/change_logo', $this->data);
        }
    }

    public function write_index($timezone){
        $template_path = './assets/config_dumps/index.php';
        $output_path = SELF;
        $index_file = file_get_contents($template_path);
        $new = str_replace("%TIMEZONE%", $timezone, $index_file);
        $handle = fopen($output_path, 'w+');
        @chmod($output_path, 0777);

        if (is_writable($output_path)) {
            if (fwrite($handle, $new)) {
                @chmod($output_path, 0644);
                return true;
            } else {
                @chmod($output_path, 0644);
                return false;
            }
        } else {
            @chmod($output_path, 0644);
            return false;
        }
    }

    function backups(){
        if (DEMO) {
            $this->session->set_flashdata('warning', lang('disabled_in_demo'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        if (!$this->Owner) {
            $this->session->set_flashdata('error', lang('access_denied'));
            admin_redirect("welcome");
        }
        $this->data['files'] = glob('./files/backups/*.zip', GLOB_BRACE);
        $this->data['dbs'] = glob('./files/backups/*.txt', GLOB_BRACE);
        krsort($this->data['files']); krsort($this->data['dbs']);
        $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => '#', 'page' => lang('backups')));
        $meta = array('page_title' => lang('backups'), 'bc' => $bc);
        $this->page_construct('settings/backups', $meta, $this->data);
    }

    function backup_database(){
        if (DEMO) {
            $this->session->set_flashdata('warning', lang('disabled_in_demo'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        if (!$this->Owner) {
            $this->session->set_flashdata('error', lang('access_denied'));
            admin_redirect("welcome");
        }
        $this->load->dbutil();
        $prefs = array(
            'format' => 'txt',
            'filename' => 'sma_db_backup.sql'
        );
        $back = $this->dbutil->backup($prefs);
        $backup =& $back;
        $db_name = 'db-backup-on-' . date("Y-m-d-H-i-s") . '.txt';
        $save = './files/backups/' . $db_name;
        $this->load->helper('file');
        write_file($save, $backup);
        $this->session->set_flashdata('messgae', lang('db_saved'));
        admin_redirect("system_settings/backups");
    }

    function backup_files(){
        if (DEMO) {
            $this->session->set_flashdata('warning', lang('disabled_in_demo'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        if (!$this->Owner) {
            $this->session->set_flashdata('error', lang('access_denied'));
            admin_redirect("welcome");
        }
        $name = 'file-backup-' . date("Y-m-d-H-i-s");
        $this->sma->zip("./", './files/backups/', $name);
        $this->session->set_flashdata('messgae', lang('backup_saved'));
        admin_redirect("system_settings/backups");
        exit();
    }

    function restore_database($dbfile){
        if (DEMO) {
            $this->session->set_flashdata('warning', lang('disabled_in_demo'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        if (!$this->Owner) {
            $this->session->set_flashdata('error', lang('access_denied'));
            admin_redirect("welcome");
        }
        $file = file_get_contents('./files/backups/' . $dbfile . '.txt');
        // $this->db->conn_id->multi_query($file);
        mysqli_multi_query($this->db->conn_id, $file);
        $this->db->conn_id->close();
        admin_redirect('logout/db');
    }

    function download_database($dbfile){
        if (DEMO) {
            $this->session->set_flashdata('warning', lang('disabled_in_demo'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        if (!$this->Owner) {
            $this->session->set_flashdata('error', lang('access_denied'));
            admin_redirect("welcome");
        }
        $this->load->library('zip');
        $this->zip->read_file('./files/backups/' . $dbfile . '.txt');
        $name = $dbfile . '.zip';
        $this->zip->download($name);
        exit();
    }

    function download_backup($zipfile){
        if (DEMO) {
            $this->session->set_flashdata('warning', lang('disabled_in_demo'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        if (!$this->Owner) {
            $this->session->set_flashdata('error', lang('access_denied'));
            admin_redirect("welcome");
        }
        $this->load->helper('download');
        force_download('./files/backups/' . $zipfile . '.zip', NULL);
        exit();
    }

    function restore_backup($zipfile){
        if (DEMO) {
            $this->session->set_flashdata('warning', lang('disabled_in_demo'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        if (!$this->Owner) {
            $this->session->set_flashdata('error', lang('access_denied'));
            admin_redirect("welcome");
        }
        $file = './files/backups/' . $zipfile . '.zip';
        $this->sma->unzip($file, './');
        $this->session->set_flashdata('success', lang('files_restored'));
        admin_redirect("system_settings/backups");
        exit();
    }

    function delete_database($dbfile){
        if (DEMO) {
            $this->session->set_flashdata('warning', lang('disabled_in_demo'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        if (!$this->Owner) {
            $this->session->set_flashdata('error', lang('access_denied'));
            admin_redirect("welcome");
        }
        unlink('./files/backups/' . $dbfile . '.txt');
        $this->session->set_flashdata('messgae', lang('db_deleted'));
        admin_redirect("system_settings/backups");
    }

    function delete_backup($zipfile){
        if (DEMO) {
            $this->session->set_flashdata('warning', lang('disabled_in_demo'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        if (!$this->Owner) {
            $this->session->set_flashdata('error', lang('access_denied'));
            admin_redirect("welcome");
        }
        unlink('./files/backups/' . $zipfile . '.zip');
        $this->session->set_flashdata('messgae', lang('backup_deleted'));
        admin_redirect("system_settings/backups");
    }

    function email_templates($template = "credentials"){

        $this->form_validation->set_rules('mail_body', lang('mail_message'), 'trim|required');
        $this->load->helper('file');
        $temp_path = is_dir('./themes/' . $this->theme . 'email_templates/');
        $theme = $temp_path ? $this->theme : 'default';
        if ($this->form_validation->run() == true) {
            $data = $_POST["mail_body"];
            if (write_file('./themes/' . $this->theme . 'email_templates/' . $template . '.html', $data)) {
                $this->session->set_flashdata('message', lang('message_successfully_saved'));
                admin_redirect('system_settings/email_templates#' . $template);
            } else {
                $this->session->set_flashdata('error', lang('failed_to_save_message'));
                admin_redirect('system_settings/email_templates#' . $template);
            }
        } else {

            $this->data['credentials'] = file_get_contents('./themes/' . $this->theme . 'email_templates/credentials.html');
            $this->data['sale'] = file_get_contents('./themes/' . $this->theme . 'email_templates/sale.html');
            $this->data['quote'] = file_get_contents('./themes/' . $this->theme . 'email_templates/quote.html');
            $this->data['purchase'] = file_get_contents('./themes/' . $this->theme . 'email_templates/purchase.html');
            $this->data['transfer'] = file_get_contents('./themes/' . $this->theme . 'email_templates/transfer.html');
            $this->data['payment'] = file_get_contents('./themes/' . $this->theme . 'email_templates/payment.html');
            $this->data['forgot_password'] = file_get_contents('./themes/' . $this->theme . 'email_templates/forgot_password.html');
            $this->data['activate_email'] = file_get_contents('./themes/' . $this->theme . 'email_templates/activate_email.html');
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('system_settings'), 'page' => lang('system_settings')), array('link' => '#', 'page' => lang('email_templates')));
            $meta = array('page_title' => lang('email_templates'), 'bc' => $bc);
            $this->page_construct('settings/email_templates', $meta, $this->data);
        }
    }

    function create_group(){

        $this->form_validation->set_rules('group_name', lang('group_name'), 'required|alpha_dash|is_unique[groups.name]');

        if ($this->form_validation->run() == TRUE) {
            $data = array('name' => strtolower($this->input->post('group_name')), 'description' => $this->input->post('description'));
        } elseif ($this->input->post('create_group')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect("system_settings/user_groups");
        }

        if ($this->form_validation->run() == TRUE && ($new_group_id = $this->settings_model->addGroup($data))) {
            $this->session->set_flashdata('message', lang('group_added'));
            admin_redirect("system_settings/permissions/" . $new_group_id);

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

            $this->data['group_name'] = array(
                'name' => 'group_name',
                'id' => 'group_name',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('group_name'),
            );
            $this->data['description'] = array(
                'name' => 'description',
                'id' => 'description',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('description'),
            );
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'settings/create_group', $this->data);
        }
    }

    function edit_group($id){

        if (!$id || empty($id)) {
            admin_redirect('system_settings/user_groups');
        }

        $group = $this->settings_model->getGroupByID($id);

        $this->form_validation->set_rules('group_name', lang('group_name'), 'required|alpha_dash');

        if ($this->form_validation->run() === TRUE) {
            $data = array('name' => strtolower($this->input->post('group_name')), 'description' => $this->input->post('description'));
            $group_update = $this->settings_model->updateGroup($id, $data);

            if ($group_update) {
                $this->session->set_flashdata('message', lang('group_udpated'));
            } else {
                $this->session->set_flashdata('error', lang('attempt_failed'));
            }
            admin_redirect("system_settings/user_groups");
        } else {


            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

            $this->data['group'] = $group;

            $this->data['group_name'] = array(
                'name' => 'group_name',
                'id' => 'group_name',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('group_name', $group->name),
            );
            $this->data['group_description'] = array(
                'name' => 'group_description',
                'id' => 'group_description',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('group_description', $group->description),
            );
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'settings/edit_group', $this->data);
        }
    }

    function permissions($id = NULL){
        $this->form_validation->set_rules('group', lang("group"), 'is_natural_no_zero');
        if ($this->form_validation->run() == true) {

            $data = array(
                'products-index' => $this->input->post('products-index'),
                'products-edit' => $this->input->post('products-edit'),
                'products-add' => $this->input->post('products-add'),
                'products-delete' => $this->input->post('products-delete'),
                'products-cost' => $this->input->post('products-cost'),
                'products-price' => $this->input->post('products-price'),
                'customers-index' => $this->input->post('customers-index'),
                'customers-edit' => $this->input->post('customers-edit'),
                'customers-add' => $this->input->post('customers-add'),
                'customers-delete' => $this->input->post('customers-delete'),
                'suppliers-index' => $this->input->post('suppliers-index'),
                'suppliers-edit' => $this->input->post('suppliers-edit'),
                'suppliers-add' => $this->input->post('suppliers-add'),
                'suppliers-delete' => $this->input->post('suppliers-delete'),
                'sales-index' => $this->input->post('sales-index'),
                'sales-edit' => $this->input->post('sales-edit'),
                'sales-add' => $this->input->post('sales-add'),
                'sales-delete' => $this->input->post('sales-delete'),
                'sales-email' => $this->input->post('sales-email'),
                'sales-pdf' => $this->input->post('sales-pdf'),
                'sales-deliveries' => $this->input->post('sales-deliveries'),
                'sales-edit_delivery' => $this->input->post('sales-edit_delivery'),
                'sales-add_delivery' => $this->input->post('sales-add_delivery'),
                'sales-delete_delivery' => $this->input->post('sales-delete_delivery'),
                'sales-email_delivery' => $this->input->post('sales-email_delivery'),
                'sales-pdf_delivery' => $this->input->post('sales-pdf_delivery'),
                'sales-gift_cards' => $this->input->post('sales-gift_cards'),
                'sales-edit_gift_card' => $this->input->post('sales-edit_gift_card'),
                'sales-add_gift_card' => $this->input->post('sales-add_gift_card'),
                'sales-delete_gift_card' => $this->input->post('sales-delete_gift_card'),
                'quotes-index' => $this->input->post('quotes-index'),
                'quotes-edit' => $this->input->post('quotes-edit'),
                'quotes-add' => $this->input->post('quotes-add'),
                'quotes-delete' => $this->input->post('quotes-delete'),
                'quotes-email' => $this->input->post('quotes-email'),
                'quotes-pdf' => $this->input->post('quotes-pdf'),
                'purchases-index' => $this->input->post('purchases-index'),
                'purchases-edit' => $this->input->post('purchases-edit'),
                'purchases-add' => $this->input->post('purchases-add'),
                'purchases-delete' => $this->input->post('purchases-delete'),
                'purchases-email' => $this->input->post('purchases-email'),
                'purchases-pdf' => $this->input->post('purchases-pdf'),
                'transfers-index' => $this->input->post('transfers-index'),
                'transfers-edit' => $this->input->post('transfers-edit'),
                'transfers-add' => $this->input->post('transfers-add'),
                'transfers-delete' => $this->input->post('transfers-delete'),
                'transfers-email' => $this->input->post('transfers-email'),
                'transfers-pdf' => $this->input->post('transfers-pdf'),
                'sales-return_sales' => $this->input->post('sales-return_sales'),
                'reports-quantity_alerts' => $this->input->post('reports-quantity_alerts'),
                'reports-expiry_alerts' => $this->input->post('reports-expiry_alerts'),
                'reports-products' => $this->input->post('reports-products'),
                'reports-daily_sales' => $this->input->post('reports-daily_sales'),
                'reports-monthly_sales' => $this->input->post('reports-monthly_sales'),
                'reports-payments' => $this->input->post('reports-payments'),
                'reports-sales' => $this->input->post('reports-sales'),
                'reports-purchases' => $this->input->post('reports-purchases'),
                'reports-customers' => $this->input->post('reports-customers'),
                'reports-suppliers' => $this->input->post('reports-suppliers'),
                'sales-payments' => $this->input->post('sales-payments'),
                'purchases-payments' => $this->input->post('purchases-payments'),
                'purchases-expenses' => $this->input->post('purchases-expenses'),
                'products-adjustments' => $this->input->post('products-adjustments'),
                'bulk_actions' => $this->input->post('bulk_actions'),
                'customers-deposits' => $this->input->post('customers-deposits'),
                'customers-delete_deposit' => $this->input->post('customers-delete_deposit'),
                'products-barcode' => $this->input->post('products-barcode'),
                'purchases-return_purchases' => $this->input->post('purchases-return_purchases'),
                'reports-expenses' => $this->input->post('reports-expenses'),
                'reports-daily_purchases' => $this->input->post('reports-daily_purchases'),
                'reports-monthly_purchases' => $this->input->post('reports-monthly_purchases'),
                'products-stock_count' => $this->input->post('products-stock_count'),
                'edit_price' => $this->input->post('edit_price'),
                'returns-index' => $this->input->post('returns-index'),
                'returns-edit' => $this->input->post('returns-edit'),
                'returns-add' => $this->input->post('returns-add'),
                'returns-delete' => $this->input->post('returns-delete'),
                'returns-email' => $this->input->post('returns-email'),
                'returns-pdf' => $this->input->post('returns-pdf'),
                'reports-tax' => $this->input->post('reports-tax'),
            );

            if (POS) {
                $data['pos-index'] = $this->input->post('pos-index');
            }

            //$this->sma->print_arrays($data);
        }


        if ($this->form_validation->run() == true && $this->settings_model->updatePermissions($id, $data)) {
            $this->session->set_flashdata('message', lang("group_permissions_updated"));
            redirect($_SERVER["HTTP_REFERER"]);
        } else {

            $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

            $this->data['id'] = $id;
            $this->data['p'] = $this->settings_model->getGroupPermissions($id);
            $this->data['group'] = $this->settings_model->getGroupByID($id);

            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('system_settings'), 'page' => lang('system_settings')), array('link' => '#', 'page' => lang('group_permissions')));
            $meta = array('page_title' => lang('group_permissions'), 'bc' => $bc);
            $this->page_construct('settings/permissions', $meta, $this->data);
        }
    }

    function user_groups(){

        if (!$this->Owner) {
            $this->session->set_flashdata('error', lang("access_denied"));
            admin_redirect('auth');
        }

        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

        $this->data['groups'] = $this->settings_model->getGroups();
        $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('system_settings'), 'page' => lang('system_settings')), array('link' => '#', 'page' => lang('groups')));
        $meta = array('page_title' => lang('groups'), 'bc' => $bc);
        $this->page_construct('settings/user_groups', $meta, $this->data);
    }

    function delete_group($id = NULL){

        if ($this->settings_model->checkGroupUsers($id)) {
            $this->session->set_flashdata('error', lang("group_x_b_deleted"));
            admin_redirect("system_settings/user_groups");
        }

        if ($this->settings_model->deleteGroup($id)) {
            $this->session->set_flashdata('message', lang("group_deleted"));
            admin_redirect("system_settings/user_groups");
        }
    }

    function currencies(){
        $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');

        $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('system_settings'), 'page' => lang('system_settings')), array('link' => '#', 'page' => lang('currencies')));
        $meta = array('page_title' => lang('currencies'), 'bc' => $bc);
        $this->page_construct('settings/currencies', $meta, $this->data);
    }

    function getCurrencies(){
        $this->load->library('datatables');
        $this->datatables
            ->select("id, code, name, rate, symbol")
            ->from("currencies")
            ->add_column("Actions", "<div class=\"text-center\"><a href='" . admin_url('system_settings/edit_currency/$1') . "' class='tip' title='" . lang("edit_currency") . "' data-toggle='modal' data-target='#myModal'><i class=\"fa fa-edit\"></i></a> <a href='#' class='tip po' title='<b>" . lang("delete_currency") . "</b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . admin_url('system_settings/delete_currency/$1') . "'>" . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a></div>", "id");
        //->unset_column('id');

        echo $this->datatables->generate();
    }

    function add_currency(){
        $this->form_validation->set_rules('code', lang("currency_code"), 'trim|is_unique[currencies.code]|required');
        $this->form_validation->set_rules('name', lang("name"), 'required');
        $this->form_validation->set_rules('rate', lang("exchange_rate"), 'required|numeric');

        if ($this->form_validation->run() == true) {
            $data = array('code' => $this->input->post('code'),
                'name' => $this->input->post('name'),
                'rate' => $this->input->post('rate'),
                'symbol' => $this->input->post('symbol'),
                'auto_update' => $this->input->post('auto_update') ? $this->input->post('auto_update') : 0,
            );
        } elseif ($this->input->post('add_currency')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect("system_settings/currencies");
        }

        if ($this->form_validation->run() == true && $this->settings_model->addCurrency($data)) { //check to see if we are creating the customer
            $this->session->set_flashdata('message', lang("currency_added"));
            admin_redirect("system_settings/currencies");
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['page_title'] = lang("new_currency");
            $this->load->view($this->theme . 'settings/add_currency', $this->data);
        }
    }

    function edit_currency($id = NULL){

        $this->form_validation->set_rules('code', lang("currency_code"), 'trim|required');
        $cur_details = $this->settings_model->getCurrencyByID($id);
        if ($this->input->post('code') != $cur_details->code) {
            $this->form_validation->set_rules('code', lang("currency_code"), 'required|is_unique[currencies.code]');
        }
        $this->form_validation->set_rules('name', lang("currency_name"), 'required');
        $this->form_validation->set_rules('rate', lang("exchange_rate"), 'required|numeric');

        if ($this->form_validation->run() == true) {

            $data = array('code' => $this->input->post('code'),
                'name' => $this->input->post('name'),
                'rate' => $this->input->post('rate'),
                'symbol' => $this->input->post('symbol'),
                'auto_update' => $this->input->post('auto_update') ? $this->input->post('auto_update') : 0,
            );
        } elseif ($this->input->post('edit_currency')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect("system_settings/currencies");
        }

        if ($this->form_validation->run() == true && $this->settings_model->updateCurrency($id, $data)) { //check to see if we are updateing the customer
            $this->session->set_flashdata('message', lang("currency_updated"));
            admin_redirect("system_settings/currencies");
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['currency'] = $this->settings_model->getCurrencyByID($id);
            $this->data['id'] = $id;
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'settings/edit_currency', $this->data);
        }
    }

    function delete_currency($id = NULL){
        if ($this->settings_model->deleteCurrency($id)) {
            $this->sma->send_json(array('error' => 0, 'msg' => lang("currency_deleted")));
        }
    }

    function currency_actions(){

        $this->form_validation->set_rules('form_action', lang("form_action"), 'required');

        if ($this->form_validation->run() == true) {

            if (!empty($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $id) {
                        $this->settings_model->deleteCurrency($id);
                    }
                    $this->session->set_flashdata('message', lang("currencies_deleted"));
                    redirect($_SERVER["HTTP_REFERER"]);
                }

                if ($this->input->post('form_action') == 'export_excel') {

                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle(lang('currencies'));
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('code'));
                    $this->excel->getActiveSheet()->SetCellValue('B1', lang('name'));
                    $this->excel->getActiveSheet()->SetCellValue('C1', lang('rate'));

                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $sc = $this->settings_model->getCurrencyByID($id);
                        $this->excel->getActiveSheet()->SetCellValue('A' . $row, $sc->code);
                        $this->excel->getActiveSheet()->SetCellValue('B' . $row, $sc->name);
                        $this->excel->getActiveSheet()->SetCellValue('B' . $row, $sc->rate);
                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $filename = 'currencies_' . date('Y_m_d_H_i_s');
                    $this->load->helper('excel');
                    create_excel($this->excel, $filename);
                }
            } else {
                $this->session->set_flashdata('error', lang("no_record_selected"));
                redirect($_SERVER["HTTP_REFERER"]);
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

    function categories(){
        $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
        $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('system_settings'), 'page' => lang('system_settings')), array('link' => '#', 'page' => lang('categories')));
        $meta = array('page_title' => lang('categories'), 'bc' => $bc);
        $this->page_construct('settings/categories', $meta, $this->data);
    }

    function getCategories(){
        $this->load->library('datatables');
        $this->datatables
            ->select("{$this->db->dbprefix('categories')}.id as id, {$this->db->dbprefix('categories')}.image, {$this->db->dbprefix('categories')}.code, {$this->db->dbprefix('categories')}.name, {$this->db->dbprefix('categories')}.slug ", FALSE)
            ->from("categories")
            ->group_by('categories.id')
            ->add_column("Actions", "<div class=\"text-center\"> <a href='" . admin_url('system_settings/edit_category/$1') . "' data-toggle='modal' data-target='#myModal' class='tip' title='" . lang("edit_category") . "'><i class=\"fa fa-edit\"></i></a> <a href='#' class='tip po' title='<b>" . lang("delete_category") . "</b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . admin_url('system_settings/delete_category/$1') . "'>" . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a></div>", "id");

        echo $this->datatables->generate();
    }

    function add_category(){
        $this->load->helper('security');
        $this->form_validation->set_rules('code', lang("category_code"), 'trim|is_unique[categories.code]|required');
        $this->form_validation->set_rules('name', lang("name"), 'required|min_length[3]');
        $this->form_validation->set_rules('slug', lang("slug"), 'required|is_unique[categories.slug]|alpha_dash');
        $this->form_validation->set_rules('description', lang("description"), 'trim|required');

        if ($this->form_validation->run() == true) {
            $data = array(
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'slug' => $this->input->post('slug'),
                'description' => $this->input->post('description'),
            );

        } elseif ($this->input->post('add_category')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect("system_settings/categories");
        }

        if ($this->form_validation->run() == true && $id = $this->settings_model->addCategory($data)) {
            $this->settings_model->updateCategoryTranslation($this->input->post('translated'), $id);

            $this->session->set_flashdata('message', lang("category_added"));
            admin_redirect("system_settings/categories");
        } else {

            $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['categories'] = $this->settings_model->getParentCategories();
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'settings/add_category', $this->data);

        }
    }

    function edit_category($id = NULL){
        $this->load->helper('security');
        $this->form_validation->set_rules('code', lang("category_code"), 'trim|required');
        $pr_details = $this->settings_model->getCategoryByID($id);
        if ($this->input->post('code') != $pr_details->code) {
            $this->form_validation->set_rules('code', lang("category_code"), 'required|is_unique[categories.code]');
        }
        $this->form_validation->set_rules('slug', lang("slug"), 'required|alpha_dash');
        if ($this->input->post('slug') != $pr_details->slug) {
            $this->form_validation->set_rules('slug', lang("slug"), 'required|alpha_dash|is_unique[categories.slug]');
        }
        $this->form_validation->set_rules('name', lang("category_name"), 'required|min_length[3]');
        $this->form_validation->set_rules('userfile', lang("category_image"), 'xss_clean');
        $this->form_validation->set_rules('description', lang("description"), 'trim|required');

        if ($this->form_validation->run() == true) {

            $data = array(
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'slug' => $this->input->post('slug'),
                'description' => $this->input->post('description')
                );

        } elseif ($this->input->post('edit_category')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect("system_settings/categories");
        }

        if ($this->form_validation->run() == true && $this->settings_model->updateCategory($id, $data)) {
            $this->settings_model->updateCategoryTranslation($this->input->post('translated'), $id);
            
            $this->session->set_flashdata('message', lang("category_updated"));
            admin_redirect("system_settings/categories");
        } else {

            $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['category'] = $this->settings_model->getCategoryByID($id);
            $this->data['categories'] = $this->settings_model->getParentCategories();
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'settings/edit_category', $this->data);

        }
    }

    function delete_category($id = NULL){
        if ($this->site->getSubCategories($id)) {
            $this->sma->send_json(array('error' => 1, 'msg' => lang("category_has_subcategory")));
        }

        if ($this->settings_model->deleteCategory($id)) {
            $this->sma->send_json(array('error' => 0, 'msg' => lang("category_deleted")));
        }
    }

    function category_actions(){
        $this->form_validation->set_rules('form_action', lang("form_action"), 'required');

        if ($this->form_validation->run() == true) {

            if (!empty($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $id) {
                        $this->settings_model->deleteCategory($id);
                    }
                    $this->session->set_flashdata('message', lang("categories_deleted"));
                    redirect($_SERVER["HTTP_REFERER"]);
                }

                if ($this->input->post('form_action') == 'export_excel') {

                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle(lang('categories'));
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('code'));
                    $this->excel->getActiveSheet()->SetCellValue('B1', lang('name'));
                    $this->excel->getActiveSheet()->SetCellValue('C1', lang('image'));
                    $this->excel->getActiveSheet()->SetCellValue('D1', lang('parent_actegory'));

                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $sc = $this->settings_model->getCategoryByID($id);
                        $parent_actegory = '';
                        if ($sc->parent_id) {
                            $pc = $this->settings_model->getCategoryByID($sc->parent_id);
                            $parent_actegory = $pc->code;
                        }
                        $this->excel->getActiveSheet()->SetCellValue('A' . $row, $sc->code);
                        $this->excel->getActiveSheet()->SetCellValue('B' . $row, $sc->name);
                        $this->excel->getActiveSheet()->SetCellValue('C' . $row, $sc->image);
                        $this->excel->getActiveSheet()->SetCellValue('D' . $row, $parent_actegory);
                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $filename = 'categories_' . date('Y_m_d_H_i_s');
                    $this->load->helper('excel');
                    create_excel($this->excel, $filename);
                }
            } else {
                $this->session->set_flashdata('error', lang("no_record_selected"));
                redirect($_SERVER["HTTP_REFERER"]);
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

    function import_categories(){

        $this->load->helper('security');
        $this->form_validation->set_rules('userfile', lang("upload_file"), 'xss_clean');

        if ($this->form_validation->run() == true) {

            if (isset($_FILES["userfile"])) {
                $this->load->library('upload');
                $config['upload_path'] = 'files/';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = $this->allowed_file_size;
                $config['overwrite'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("system_settings/categories");
                }
                $csv = $this->upload->file_name;
                $arrResult = array();
                $handle = fopen('files/' . $csv, "r");
                if ($handle) {
                    while (($row = fgetcsv($handle, 5000, ",")) !== FALSE) {
                        $arrResult[] = $row;
                    }
                    fclose($handle);
                }
                $titles = array_shift($arrResult);
                $updated = '';
                $categories = $subcategories = [];
                foreach ($arrResult as $key => $value) {
                    $code = trim($value[0]);
                    $name = trim($value[1]);
                    $pcode = isset($value[4]) ? trim($value[4]) : null;
                    if ($code && $name && trim($value[2])) {
                        $category = [
                            'code' => $code,
                            'name' => $name,
                            'slug' => isset($value[2]) ? trim($value[2]) : $code,
                            'image' => isset($value[3]) ? trim($value[3]) : 'no_image.png',
                            'parent_id' => $pcode,
                            'description' => isset($value[5]) ? trim($value[5]) : null,
                        ];
                        if (!empty($pcode) && ($pcategory = $this->settings_model->getCategoryByCode($pcode))) {
                            $category['parent_id'] = $pcategory->id;
                        }
                        if ($c = $this->settings_model->getCategoryByCode($code)) {
                            $updated .= '<p>'.lang('category_updated').' ('.$code.')</p>';
                            $this->settings_model->updateCategory($c->id, $category);
                        } else {
                            if ($category['parent_id']) {
                                $subcategories[] = $category;
                            } else {
                                $categories[] = $category;
                            }
                        }
                    }
                }
            }

            // $this->sma->print_arrays($categories, $subcategories);
        }

        if ($this->form_validation->run() == true && $this->settings_model->addCategories($categories, $subcategories)) {
            $this->session->set_flashdata('message', lang("categories_added").$updated);
            admin_redirect('system_settings/categories');
        } else {
            if ((isset($categories) && empty($categories)) || (isset($subcategories) && empty($subcategories))) {
                if ($updated) {
                    $this->session->set_flashdata('message', $updated);
                } else {
                    $this->session->set_flashdata('warning', lang('data_x_categories'));
                }
                admin_redirect('system_settings/categories');
            }

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['userfile'] = array('name' => 'userfile',
                'id' => 'userfile',
                'type' => 'text',
                'value' => $this->form_validation->set_value('userfile')
            );
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme.'settings/import_categories', $this->data);

        }
    }

    function group_product_prices($group_id = NULL)
    {

        if (!$group_id) {
            $this->session->set_flashdata('error', lang('no_price_group_selected'));
            admin_redirect('system_settings/price_groups');
        }

        $this->data['price_group'] = $this->settings_model->getPriceGroupByID($group_id);
        $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
        $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('system_settings'), 'page' => lang('system_settings')),  array('link' => admin_url('system_settings/price_groups'), 'page' => lang('price_groups')), array('link' => '#', 'page' => lang('group_product_prices')));
        $meta = array('page_title' => lang('group_product_prices'), 'bc' => $bc);
        $this->page_construct('settings/group_product_prices', $meta, $this->data);
    }

    function getProductPrices($group_id = NULL)
    {
        if (!$group_id) {
            $this->session->set_flashdata('error', lang('no_price_group_selected'));
            admin_redirect('system_settings/price_groups');
        }

        $pp = "( SELECT {$this->db->dbprefix('product_prices')}.product_id as product_id, {$this->db->dbprefix('product_prices')}.price as price FROM {$this->db->dbprefix('product_prices')} WHERE price_group_id = {$group_id} ) PP";

        $this->load->library('datatables');
        $this->datatables
            ->select("{$this->db->dbprefix('products')}.id as id, {$this->db->dbprefix('products')}.code as product_code, {$this->db->dbprefix('products')}.name as product_name, PP.price as price ")
            ->from("products")
            ->join($pp, 'PP.product_id=products.id', 'left')
            ->edit_column("price", "$1__$2", 'id, price')
            ->add_column("Actions", "<div class=\"text-center\"><button class=\"btn btn-primary btn-xs form-submit\" type=\"button\"><i class=\"fa fa-check\"></i></button></div>", "id");

        echo $this->datatables->generate();
    }

    function update_product_group_price($group_id = NULL)
    {
        if (!$group_id) {
            $this->sma->send_json(array('status' => 0));
        }

        $product_id = $this->input->post('product_id', TRUE);
        $price = $this->input->post('price', TRUE);
        if (!empty($product_id) && !empty($price)) {
            if ($this->settings_model->setProductPriceForPriceGroup($product_id, $group_id, $price)) {
                $this->sma->send_json(array('status' => 1));
            }
        }

        $this->sma->send_json(array('status' => 0));
    }

    function update_prices_csv($group_id = NULL)
    {

        $this->load->helper('security');
        $this->form_validation->set_rules('userfile', lang("upload_file"), 'xss_clean');

        if ($this->form_validation->run() == true) {

            if (DEMO) {
                $this->session->set_flashdata('message', lang("disabled_in_demo"));
                admin_redirect('welcome');
            }

            if (isset($_FILES["userfile"])) {

                $this->load->library('upload');
                $config['upload_path'] = 'files/';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = $this->allowed_file_size;
                $config['overwrite'] = TRUE;
                $config['encrypt_name'] = TRUE;
                $config['max_filename'] = 25;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("system_settings/group_product_prices/".$group_id);
                }

                $csv = $this->upload->file_name;

                $arrResult = array();
                $handle = fopen('files/' . $csv, "r");
                if ($handle) {
                    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $arrResult[] = $row;
                    }
                    fclose($handle);
                }
                $titles = array_shift($arrResult);

                $keys = array('code', 'price');

                $final = array();

                foreach ($arrResult as $key => $value) {
                    $final[] = array_combine($keys, $value);
                }
                $rw = 2;
                foreach ($final as $csv_pr) {
                    if ($product = $this->site->getProductByCode(trim($csv_pr['code']))) {
                    $data[] = array(
                        'product_id' => $product->id,
                        'price' => $csv_pr['price'],
                        'price_group_id' => $group_id
                        );
                    } else {
                        $this->session->set_flashdata('message', lang("check_product_code") . " (" . $csv_pr['code'] . "). " . lang("code_x_exist") . " " . lang("line_no") . " " . $rw);
                        admin_redirect("system_settings/group_product_prices/".$group_id);
                    }
                    $rw++;
                }
            }

        } elseif ($this->input->post('update_price')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect("system_settings/group_product_prices/".$group_id);
        }

        if ($this->form_validation->run() == true && !empty($data)) {
            $this->settings_model->updateGroupPrices($data);
            $this->session->set_flashdata('message', lang("price_updated"));
            admin_redirect("system_settings/group_product_prices/".$group_id);
        } else {

            $this->data['userfile'] = array('name' => 'userfile',
                'id' => 'userfile',
                'type' => 'text',
                'value' => $this->form_validation->set_value('userfile')
            );
            $this->data['group'] = $this->site->getPriceGroupByID($group_id);
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme.'settings/update_price', $this->data);

        }
    }

}
