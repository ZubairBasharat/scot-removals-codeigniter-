<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Companies_api extends CI_Model{

    public function __construct() {
        parent::__construct();
    }

    public function countCompanies($filters = []) {
        if ($filters['group']) {
            $this->db->where('group_name', $filters['group']);
        }
        $this->db->from('companies');
        return $this->db->count_all_results();
    }

    public function getCompanies($filters = []) {
        if ($filters['group']) {
            $this->db->where('group_name', $filters['group']);
        }

        if ($filters['phone']) {
            $this->db->where('phone', $filters['phone']);
        }

        if ($filters['id']) {
            $this->db->where('id', $filters['id']);
        } else {
            $this->db->order_by($filters['order_by'][0], $filters['order_by'][1] ? $filters['order_by'][1] : 'asc');
            $this->db->limit($filters['limit'], ($filters['start']-1));
        }

        return $this->db->get("companies")->result();
    }

    public function getCompany($filters) {
        if (!empty($companies = $this->getCompanies($filters))) {
            return array_values($companies)[0];
        }
        return FALSE;
    }

    public function getCompanyUsers($company_id) {
        return $this->db->get_where('users', ['company_id' => $company_id])->result();
    }

    ///////////////////////////////////////////////////////////////////////

    public function update($data, $customer_id){
        if(!empty($data)){
            return $this->db->update('companies', $data,  array('id' => $customer_id));
        }
        return false;
    }

    public function checkCustomerByFcmToken($fcm_token) {
        $this->db->select("{$this->db->dbprefix('companies')}.id")
        ->where('companies.fcm_token', $fcm_token);
        $q = $this->db->get('companies', 1);
        if ($q->num_rows() > 0) {
            return $q->row()->id;
        }else{
            $this->db->insert('companies', array('fcm_token' => $fcm_token, 'group_name' => 'customer', 'created_at' => date('Y-m-d H:i:s') ));
            return $this->db->insert_id();
        }
    }

}
