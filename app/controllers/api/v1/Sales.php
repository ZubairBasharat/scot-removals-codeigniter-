<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Sales extends REST_Controller {

    function __construct() {
        parent::__construct();

        $this->methods['index_get']['limit'] = 500;
        $this->load->api_model('sales_api');
    }

    public function index_get() {
        $id = $this->get('id');
        $fcm_token = $this->get('fcm_token') ? $this->get('fcm_token') : NULL;
        if($fcm_token != NULL)
            $customer_id = $this->sales_api->checkCustomerByFcmToken($fcm_token);
        else{
            $customer_id = $this->get('customer_id') ? $this->get('customer_id') : NULL;
        }
        $lang = $this->get('lang') ? $this->get('lang') : NULL;
        $cancel = $this->get('cancel');

        if($cancel != NULL && $cancel != 0){
            if($id != NULL && $id != 0){    
                $this->cancel($id);
            }else{
                echo json_encode(array('status' => false, 'message' => 'no order id given.'));
            }
            exit;
        }

        $filters = [
            'id' => $id,
            'include' => $this->get('include') ? explode(',', $this->get('include')) : NULL,
            'start' => $this->get('start') && is_numeric($this->get('start')) ? $this->get('start') : 1,
            'limit' => $this->get('limit') && is_numeric($this->get('limit')) ? $this->get('limit') : 10,
            'start_date' => $this->get('start_date') && is_numeric($this->get('start_date')) ? $this->get('start_date') : NULL,
            'end_date' => $this->get('end_date') && is_numeric($this->get('end_date')) ? $this->get('end_date') : NULL,
            'order_by' => $this->get('order_by') ? explode(',', $this->get('order_by')) : ['id', 'decs'],
            'customer_id' => $customer_id,
            'customer' => $this->get('customer') ? $this->get('customer') : NULL,
        ];

        if ($id === NULL) {

            if ($sales = $this->sales_api->getSales($filters)) {
                $sl_data = [];
                foreach ($sales as $sale) {
                    $sale->total = $this->sma->formatDecimal($sale->total);
                    $sale->shipping = $this->sma->formatDecimal($sale->shipping);
                    $sale->grand_total = $this->sma->formatDecimal($sale->grand_total);
                    $sale->total_discount = $this->sma->formatDecimal($sale->total_discount);
                    $sale->order_discount = $this->sma->formatDecimal($sale->order_discount);
                    
                    if (!empty($filters['include'])) {
                        foreach ($filters['include'] as $include) {
                            if ($include == 'items') {
                                $sale->items = $this->sales_api->getSaleItems($sale->id, $lang);
                            }
                        }
                    }
                    $sale->created_by = $this->sales_api->getUser($sale->created_by);
                    $sl_data[] = $this->setSale($sale);
                }

                $data =  [
                'data' => $sl_data,
                'limit' => (int) $filters['limit'],
                'start' => (int) $filters['start'],
                'total' => $this->sales_api->countSales($filters),
                ];
                $this->response($data, REST_Controller::HTTP_OK);

            } else {
                $this->response([
                    'message' => 'No sale record found.',
                    'status' => FALSE,
                    ], REST_Controller::HTTP_NOT_FOUND);
            }

        } else {

            if ($sale = $this->sales_api->getSale($filters)) {
                if (!empty($filters['include'])) {
                    foreach ($filters['include'] as $include) {
                        if ($include == 'items') {
                            $sale->items = $this->sales_api->getSaleItems($sale->id, $lang);
                        }
                    }
                }

                $sale->created_by = $this->sales_api->getUser($sale->created_by);
                $sale = $this->setSale($sale);
                $this->set_response($sale, REST_Controller::HTTP_OK);

            } else {
                $this->set_response([
                    'message' => 'Sale could not be found',
                    'status' => FALSE,
                    ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    protected function setSale($sale) {
        unset($sale->address_id, $sale->api, $sale->attachment, $sale->hash, $sale->product_discount,$sale->order_discount_id, $sale->order_discount_code, $sale->biller, $sale->biller_id, $sale->pos, $sale->reserve_id, $sale->sale_id, $sale->shop, $sale->updated_at, $sale->suspend_note);
        if (isset($sale->items) && !empty($sale->items)) {
            foreach($sale->items as &$item) {
                $item->product_unit_quantity = $item->unit_quantity;
                unset($item->id, $item->sale_id, $item->product_type, $item->product_unit_id, $item->product_unit_code, $item->comment, $item->real_unit_price, $item->sale_item_id, $item->unit_quantity);
                $item = (array) $item;
                ksort($item);
            }
        }
        $sale = (array) $sale;
        //ksort($sale);
        return $sale;
    }

    ////////////////////////////////////////////////////////////////////

    function cancel($id) {
        if ($id) {
            if($this->sales_api->cancel($id)){
                $this->sma->send_json(array('status' => lang('success'), 'message' => lang('order_canceled')));
            }
        }
    }

}
