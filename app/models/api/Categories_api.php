<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_api extends CI_Model{

    public function __construct() {
        parent::__construct();
    }

    public function countCategories($filters = []) {
        $this->db->from('categories');
        return $this->db->count_all_results();
    }

    public function getCategories($filters = []) {

        if ($filters['lang']) {
            $this->db->select("{$this->db->dbprefix('categories')}.id, {$this->db->dbprefix('categories')}.code, {$this->db->dbprefix('categories')}.name, {$this->db->dbprefix('categories_translation')}.trans_name, {$this->db->dbprefix('categories_translation')}.trans_description");
            $this->db->join('categories_translation', 'categories.id = categories_translation.category_id AND categories_translation.trans_lang = "'.$filters['lang'].'"', 'left outer');
        }else{
            $this->db->select("id, code, name");
        }

        if ($filters['code']) {
            $this->db->where('code', $filters['code']);
        } else {
            $this->db->order_by($filters['order_by'][0], $filters['order_by'][1] ? $filters['order_by'][1] : 'asc');
            $this->db->limit($filters['limit'], ($filters['start']-1));
        }

        return $this->db->get("categories")->result();
    }

    public function getCategory($filters) {
        if (!empty($Categories = $this->getCategories($filters))) {
            return array_values($Categories)[0];
        }
        return FALSE;
    }

    public function getProducts($filters = []) {

        $uploads_url = base_url('assets/uploads/');
        $this->db->select("{$this->db->dbprefix('products')}.id, {$this->db->dbprefix('products')}.code, {$this->db->dbprefix('products')}.name, {$this->db->dbprefix('products')}.type, {$this->db->dbprefix('products')}.slug, price, CONCAT('{$uploads_url}', {$this->db->dbprefix('products')}.image) as image_url ");

        if (!empty($filters['include'])) {
            foreach ($filters['include'] as $include) {
                if ($include == 'category') {
                    $this->db->select('category_id as category');
                }
            }
        }
        if ($filters['category']) {
            $this->db->join('categories', 'categories.id=products.category_id', 'left');
            $this->db->where("{$this->db->dbprefix('categories')}.code", $filters['category']);
        }
        
        if ($filters['code']) {
            $this->db->where('code', $filters['code']);
        } else {
            $this->db->order_by($filters['order_by'][0], $filters['order_by'][1] ? $filters['order_by'][1] : 'asc');
            $this->db->limit($filters['limit'], ($filters['start']-1));
        }

        return $this->db->get("products")->result();
    }

}
