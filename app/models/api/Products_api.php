<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products_api extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function countProducts($filters = []) {
        if ($filters['category']) {
            $category = $this->getCategoryByCode($filters['category']);
            $this->db->where('category_id', $category->id);
        }

        if ($filters['name']) {
            if ($filters['lang']) {
                $this->db->join('products_translation', 'products.id = products_translation.product_id AND products_translation.trans_lang = "'.$filters['lang'].'"', 'left outer');
                $this->db->like("{$this->db->dbprefix('products_translation')}.trans_name", $filters['name']);
            }else{
                $this->db->like("{$this->db->dbprefix('products')}.name", $filters['name']);
            }
        }

        $this->db->from('products');
        return $this->db->count_all_results();
    }

    public function getProducts($filters = []) {
        $uploads_url = base_url('assets/uploads/');

        if ($filters['lang']) {
            $this->db->select("{$this->db->dbprefix('products')}.id, {$this->db->dbprefix('products')}.code, {$this->db->dbprefix('products')}.name, {$this->db->dbprefix('products')}.type, {$this->db->dbprefix('products')}.slug, price, product_details, details, CONCAT('{$uploads_url}', {$this->db->dbprefix('products')}.image) as image_url, {$this->db->dbprefix('products_translation')}.trans_name, {$this->db->dbprefix('products_translation')}.trans_product_details, {$this->db->dbprefix('products_translation')}.trans_details");
            $this->db->join('products_translation', 'products.id = products_translation.product_id AND products_translation.trans_lang = "'.$filters['lang'].'"', 'left outer');
        }else{
            $this->db->select("{$this->db->dbprefix('products')}.id, {$this->db->dbprefix('products')}.code, {$this->db->dbprefix('products')}.name, {$this->db->dbprefix('products')}.type, {$this->db->dbprefix('products')}.slug, price, product_details, details, CONCAT('{$uploads_url}', {$this->db->dbprefix('products')}.image) as image_url ");
        }

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

        if ($filters['name']) {
            if ($filters['lang']) {
                $this->db->like("{$this->db->dbprefix('products_translation')}.trans_name", $filters['name']);
            }else{
                $this->db->like("{$this->db->dbprefix('products')}.name", $filters['name']);
            }
        }
        
        if ($filters['code']) {
            $this->db->where('code', $filters['code']);
        } else {
            $this->db->order_by($filters['order_by'][0], $filters['order_by'][1] ? $filters['order_by'][1] : 'asc');
            $this->db->limit($filters['limit'], ($filters['start']-1));
        }

        return $this->db->get("products")->result();
    }

    public function getProduct($filters) {
        if (!empty($products = $this->getProducts($filters))) {
            return array_values($products)[0];
        }
        return FALSE;
    }

    public function getCategoryByID($id) {
        return $this->db->get_where('categories', ['id' => $id], 1)->row();
    }

    public function getCategoryByCode($code) {
        return $this->db->get_where('categories', ['code' => $code], 1)->row();
    }

    public function getProductPhotos($product_id) {
        $uploads_url = base_url('assets/uploads/');
        $this->db->select("CONCAT('{$uploads_url}', photo) as photo_url");
        return $this->db->get_where('product_photos', ['product_id' => $product_id])->result();
    }

}
