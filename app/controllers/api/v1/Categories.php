<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Categories extends REST_Controller {

    function __construct() {
        parent::__construct();

        $this->methods['index_get']['limit'] = 500;
        $this->load->api_model('Categories_api');
    }

    public function index_get() {
        $code = $this->get('code');

        $filters = [
        'code' => $code,
        'lang' => $this->get('lang') ? $this->get('lang') : NULL,
        'include' => $this->get('include') ? explode(',', $this->get('include')) : NULL,
        'start' => $this->get('start') && is_numeric($this->get('start')) ? $this->get('start') : 1,
        'limit' => $this->get('limit') && is_numeric($this->get('limit')) ? $this->get('limit') : 10,
        'order_by' => $this->get('order_by') ? explode(',', $this->get('order_by')) : ['code', 'acs'],
        ];

        if ($code === NULL) {
            if ($Categories = $this->Categories_api->getCategories($filters)) {
                $pr_data = [];
                foreach ($Categories as $category) {
                    if (!empty($filters['include'])) {
                        foreach ($filters['include'] as $include) {
                        }
                    }
                    $pr_data[] = $this->setCategory($category);
                }

                $data =  [
                'data' => $pr_data,
                'limit' => $filters['limit'],
                'start' => $filters['start'],
                'total' => $this->Categories_api->countCategories($filters),
                ];
                $this->response($data, REST_Controller::HTTP_OK);

            } else {
                $this->response([
                    'message' => 'No category were found.',
                    'status' => FALSE,
                    ], REST_Controller::HTTP_NOT_FOUND);
            }

        } else {
            if ($category = $this->Categories_api->getCategory($filters)) {
                if (!empty($filters['include'])) {
                    foreach ($filters['include'] as $include) {

                    }
                }
                $category = $this->setCategory($category);
                $this->set_response($category, REST_Controller::HTTP_OK);
            } else {
                $this->set_response([
                    'message' => 'Categories could not be found',
                    'status' => FALSE,
                    ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    protected function setCategory($category) {
        $category = (array) $category;
        ksort($category);
        return $category;
    }

}
