<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Products extends REST_Controller {

    function __construct() {
        parent::__construct();

        $this->methods['index_get']['limit'] = 500;
        $this->load->api_model('products_api');
        $this->load->api_model('cart_api');
    }

    public function index_get() {
        $code = $this->get('code');
        $fcm_token = $this->get('fcm_token') ? $this->get('fcm_token') : NULL;
        if($fcm_token != NULL)
            $customer_id = $this->cart_api->checkCustomerByFcmToken($fcm_token);
        else 
            $customer_id = NULL;

        $filters = [
            'code' => $code,
            'lang' => $this->get('lang') ? $this->get('lang') : NULL,
            'name' => $this->get('name') ? $this->get('name') : NULL,
            'include' => $this->get('include') ? explode(',', $this->get('include')) : NULL,
            'start' => $this->get('start') && is_numeric($this->get('start')) ? $this->get('start') : 1,
            'limit' => $this->get('limit') && is_numeric($this->get('limit')) ? $this->get('limit') : 10,
            'order_by' => $this->get('order_by') ? explode(',', $this->get('order_by')) : ( $this->get('lang') ? ['trans_name', 'acs'] : ['name', 'acs']),
            'category' => $this->get('category_code') ? $this->get('category_code') : NULL,
        ];

        if ($code === NULL) {
            if ($products = $this->products_api->getProducts($filters)) {
                $pr_data = [];
                $items = $this->cart_api->contents($customer_id, true);
                
                foreach ($products as $product) {
                    if($customer_id != NULL){
                        $product->cart = 0;
                        if(!empty($items)){
                            foreach($items as $item){
                                if($item['product_id'] == $product->id){
                                    $product->cart = 1;
                                    $product->rowid = $item['rowid'];
                                    $product->cart_item_qty = $item['qty'];
                                }
                            }
                        }
                    }
                    
                    if (!empty($filters['include'])) {
                        foreach ($filters['include'] as $include) {
                            if ($include == 'category') {
                                $product->category = $this->products_api->getCategoryByID($product->category);
                            } elseif ($include == 'photos') {
                                $product->photos = $this->products_api->getProductPhotos($product->id);
                            }
                        }
                    }
                    
                    $pr_data[] = $this->setProduct($product);
                }

                $settings = $this->site->get_setting();

                $data =  [
                'data' => $pr_data,
                'currency' => $settings->default_currency,
                'limit' => $filters['limit'],
                'start' => $filters['start'],
                'total' => $this->products_api->countProducts($filters),
                ];
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'message' => 'No product were found.',
                    'status' => FALSE,
                    ], REST_Controller::HTTP_NOT_FOUND);
            }

        } else {

            if ($product = $this->products_api->getProduct($filters)) {

                if (!empty($filters['include'])) {
                    foreach ($filters['include'] as $include) {
                        if ($include == 'category') {
                            $product->category = $this->products_api->getCategoryByID($product->category);
                        } elseif ($include == 'photos') {
                            $product->photos = $this->products_api->getProductPhotos($product->id);
                        }
                    }
                }

                $items = $this->cart_api->contents($customer_id, true);
                if($customer_id != NULL){
                    $product->cart = 0;
                    if(!empty($items)){
                        foreach($items as $item){
                            if($item['product_id'] == $product->id){
                                $product->cart = 1;
                                $product->rowid = $item['rowid'];
                                $product->cart_item_qty = $item['qty'];
                            }
                        }
                    }
                }

                $product = $this->setProduct($product);
                $this->set_response($product, REST_Controller::HTTP_OK);

            } else {
                $this->set_response([
                    'message' => 'Product could not be found for code '.$code.'.',
                    'status' => FALSE,
                    ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    protected function setProduct($product) {
        $product->price = $this->sma->formatDecimal($product->price);
        $product = (array) $product;
        ksort($product);
        return $product;
    }

}
