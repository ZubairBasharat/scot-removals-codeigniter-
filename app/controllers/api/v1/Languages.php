<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Languages extends REST_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index_get() {
        $lang = $this->get('lang') ? $this->get('lang') : 'english';
        $only_langs_list = $this->get('only_langs_list') ? $this->get('only_langs_list') : NULL;
        $this->lang->admin_load('api', $lang);

        if($only_langs_list != NULL && $only_langs_list != 0)
            $data =  pt_get_languages();
        else
            $data =  ['languages' => pt_get_languages(), 'selected_lang' => $lang, 'keywords' => $this->lang->language];
        

        $this->set_response($data, REST_Controller::HTTP_OK);
    }

}
