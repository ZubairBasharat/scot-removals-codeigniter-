<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Companies extends REST_Controller {

    function __construct() {
        parent::__construct();

        $this->methods['index_get']['limit'] = 500;
        $this->load->api_model('companies_api');
    }

    public function index_get() {
        $id = $this->get('customer_id') ? $this->get('customer_id') : NULL;
        if($id == NULL){
            $fcm_token = $this->get('fcm_token') ? $this->get('fcm_token') : NULL;
            if($fcm_token != NULL)
                $id = $this->companies_api->checkCustomerByFcmToken($fcm_token);
        }
        $update = $this->get('update');
        if($update != NULL && $update != 0){
            if($id != NULL){
                $this->update($id);
            }else{
                echo json_encode(array('status' => false, 'message' => 'no customer id give.'));
            }
            exit;
        }

        $filters = [
            'id' => $id,
            'phone' => $this->get('phone') ? $this->get('phone') : NULL,
            'include' => $this->get('include') ? explode(',', $this->get('include')) : NULL,
            'group' => $this->get('group') ? $this->get('group') : 'customer',
            'start' => $this->get('start') && is_numeric($this->get('start')) ? $this->get('start') : 1,
            'limit' => $this->get('limit') && is_numeric($this->get('limit')) ? $this->get('limit') : 10,
            'order_by' => $this->get('order_by') ? explode(',', $this->get('order_by')) : ['company', 'acs'],
        ];

        if ($id === NULL) {
            if ($companies = $this->companies_api->getCompanies($filters)) {
                $pr_data = [];
                foreach ($companies as $company) {
                    if (!empty($filters['include'])) {
                        foreach ($filters['include'] as $include) {
                            
                        }
                    }
                    $pr_data[] = $this->setCompany($company);
                }

                $data =  [
                'data' => $pr_data,
                'limit' => $filters['limit'],
                'start' => $filters['start'],
                'total' => $this->companies_api->countCompanies($filters),
                ];
                $this->response($data, REST_Controller::HTTP_OK);

            } else {
                $this->response([
                    'message' => 'No customers were found.',
                    'status' => FALSE,
                    ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            if ($company = $this->companies_api->getCompany($filters)) {

                if (!empty($filters['include'])) {
                    foreach ($filters['include'] as $include) {
                        
                    }
                }

                $company = $this->setCompany($company);
                $this->set_response($company, REST_Controller::HTTP_OK);

            } else {
                $this->set_response([
                    'message' => 'Customer could not be found',
                    'status' => FALSE,
                    ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    protected function setCompany($company) {
        if ($company->group_name == 'customer') {
            unset($company->vat_no);
        }
        if ($company->group_name == 'biller') {
            $company->logo = base_url().'assets/uploads/logos/'. $company->logo;
        }
        unset($company->group_name, $company->vat_no);
        $company = (array) $company;
        ksort($company);
        return $company;
    }

    protected function update($customer_id){
        $data = [
            'name' => $this->get('name'),
            'phone' => $this->get('phone'),
            'email' => $this->get('email'),
            'city' => $this->get('city'),
            'state' => $this->get('state'),
            'country' => $this->get('country'),
        ];

        if($this->companies_api->update($data, $customer_id)){
            $this->sma->send_json(array('status' => true, 'customer_id' => $customer_id, 'message' => lang('customer_updated')));
        }
        $this->sma->send_json(array('status' => false, 'message' => lang('customer_updated_failed')));
    }

}
