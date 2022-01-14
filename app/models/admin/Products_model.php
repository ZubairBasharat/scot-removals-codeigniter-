<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function getAllProducts($product_type, $type){
        if($type == "product"){
            // $this->db->get_where('products', array('product_type' => $product_type, 'type' => $type));
            // $q = $this->db->order_by('order_by', 'ASC');
            $q = $this->db->query('SELECT * FROM sma_products WHERE product_type = "'.$product_type.'" AND type = "'.$type.'" order by order_by ASC ');
		    return $q->result();
            // if ($q->num_rows() > 0) {
            //     foreach (($q->result()) as $row) {
            //         $data[] = $row;
            //     }
            //     return $data;
            // }
        }else if($type == "property"){
            $q = $this->db->query('SELECT p1.*, c.category_name as parent_name FROM sma_products as p1 LEFT OUTER JOIN sma_products_categories as c on p1.parent = c.id WHERE p1.product_type = "'.$product_type.'" AND p1.type = "'.$type.'" ');
		    return $q->result();
        }else{
            $q = $this->db->query('SELECT p1.*, p2.name as parent_name FROM sma_products as p1 LEFT OUTER JOIN sma_products as p2 on p1.parent = p2.id WHERE p1.product_type = "'.$product_type.'" AND p1.type = "'.$type.'" ');
		    return $q->result();
            // $this->db->select('p1.*, p2.name as parent_name');
            // $this->db->join('products p2', 'p1.parent = p2.id', 'left');
            // $q = $this->db->get_where('products as p1', array('p1.product_type' => $product_type, 'p1.type' => $type), 1);
            // if ($q->num_rows() > 0) {
            //     foreach (($q->result()) as $row) {
            //         $data[] = $row;
            //     }
            //     return $data;
            // }
        }
        return FALSE;
    }

    public function getAllCategories(){
        $q = $this->db->get('products_categories');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getCategoryProducts($category_id){
        $q = $this->db->get_where('products', array('category_id' => $category_id, 'product_type' => "default"));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getProductCount(){
        $this->db->select($this->db->dbprefix('products') . '.id as id');
        $q = $this->db->get($this->db->dbprefix('products'));
        
        if (count($q->result()) > 0) {
            return count($q->result());
        }
        return 0;
    }

    public function getProductByID($id){
        $q = $this->db->get_where('products', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getProductByIDType($id, $type){
        if($type == "product"){
            $q = $this->db->get_where('products', array('id' => $id, 'type' => $type), 1);
            if ($q->num_rows() > 0) {
                return $q->row();
            }
        }else if($type == "property"){
            $q = $this->db->query('SELECT p1.*, c.category_name as parent_name FROM sma_products as p1 LEFT OUTER JOIN sma_products_categories as c on p1.parent = c.id WHERE p1.id = '.$id.' AND p1.type = "'.$type.'" ');
		    return $q->row();
        }else{
            $q = $this->db->query('SELECT p1.*, p2.name as parent_name FROM sma_products as p1 LEFT OUTER JOIN sma_products as p2 on p1.parent = p2.id WHERE p1.id = '.$id.' AND p1.type = "'.$type.'" ');
		    return $q->row();
        }
        return FALSE;
    }

    public function getPricesByID($id){
        $q = $this->db->get_where('products_prices', array('product_id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getProductCategoryByID($id){
        $q = $this->db->get_where('products_categories', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getProductWithCategory($id){
        $this->db->select($this->db->dbprefix('products') . '.*, ' . $this->db->dbprefix('categories') . '.name as category')
        ->join('categories', 'categories.id=products.category_id', 'left');
        $q = $this->db->get_where('products', array('products.id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getProductDetails($id){
        $this->db->select($this->db->dbprefix('products') . '.code, ' . $this->db->dbprefix('products') . '.name, ' . $this->db->dbprefix('categories') . '.code as category_code, price ')
            ->join('categories', 'categories.id=products.category_id', 'left');
        $q = $this->db->get_where('products', array('products.id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getProductDetail($id){
        $this->db->select($this->db->dbprefix('products') . '.*, c.code as category_code ', FALSE)
            ->join('categories c', 'c.id=products.category_id', 'left');
        $q = $this->db->get_where('products', array('products.id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getSubCategories($parent_id) {
        $this->db->select('id as id, name as text')
        ->where('parent_id', $parent_id)->order_by('name');
        $q = $this->db->get("categories");
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getProductByCategoryID($id){
        $q = $this->db->get_where('products', array('category_id' => $id, 'product_type' => "default"), 1);
        if ($q->num_rows() > 0) {
            return true;
        }
        return FALSE;
    }

    public function getProductPhotos($id){
        $q = $this->db->get_where("product_photos", array('product_id' => $id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getProductByCode($code){
        $q = $this->db->get_where('products', array('code' => $code, 'product_type' => "default"), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function addProduct($data){
        // $data['product_type'] = $type;
        if ($this->db->insert('products', $data)) {
            $product_id = $this->db->insert_id();
            $pr = array(
                'product_id' => $product_id,
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
           $this->db->insert("sma_products_prices",$pr);
            return $result = $product_id;
        }
        return false;

    }

    public function addPrices($data, $id){
        if ($this->db->insert('products_prices', $data)) {
            $product_prices_id = $this->db->insert_id();
            $this->db->update('products', array('price_added' => 1), array('id' => $id));
            return $result = $this->db->insert_id();
        }
        return false;
    }

    public function addProductCategory($data){
        if ($this->db->insert('products_categories', $data)) {
            $product_category_id = $this->db->insert_id();
            return $result = $this->db->insert_id();
        }
        return false;

    }

    public function addAjaxProduct($data){
        if ($this->db->insert('products', $data)) {
            $product_id = $this->db->insert_id();
            return $this->getProductByID($product_id);
        }
        return false;
    }

    public function add_products($products = array()){
        if (!empty($products)) {
            foreach ($products as $product) {
                if ($this->db->insert('products', $product)) {
                    $product_id = $this->db->insert_id();
                }
            }
            return true;
        }
        return false;
    }

    public function getProductNames($term, $limit = 10){
        $this->db->select('' . $this->db->dbprefix('products') . '.id, code, ' . $this->db->dbprefix('products') . '.name as name, ' . $this->db->dbprefix('products') . '.price as price' )
            ->where("product_type = 'default' AND "
                . "(" . $this->db->dbprefix('products') . ".name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR
                concat(" . $this->db->dbprefix('products') . ".name, ' (', code, ')') LIKE '%" . $term . "%')")
            ->group_by('products.id')->limit($limit);
        $q = $this->db->get('products');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function updateProduct($id, $data){
        if ($this->db->update('products', $data, array('id' => $id))) {
            // if ($photos) {
            //     foreach ($photos as $photo) {
            //         $this->db->insert('product_photos', array('product_id' => $id, 'photo' => $photo));
            //     }
            // }
            return true;
        } else {
            return false;
        }
    }

    public function updatePrices($data, $id){
        if ($this->db->update('products_prices', $data, array('id' => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProductCategory($id, $data){
        if ($this->db->update('products_categories', $data, array('id' => $id))) {
            // if ($photos) {
            //     foreach ($photos as $photo) {
            //         $this->db->insert('product_photos', array('product_id' => $id, 'photo' => $photo));
            //     }
            // }
            return true;
        } else {
            return false;
        }
    }

    function updateProductTranslation($postdata, $id) {
		foreach($postdata as $lang => $val){
		     if(array_filter($val)){
                $name = $val['name'];
                $product_details = $val['product_details'];
                $details = $val['details'];
                $transAvailable = $this->getProductsTranslation($lang, $id);
                if(empty($transAvailable)){
					$data = array(
                    'trans_name' => $name,
                    'trans_product_details' => $product_details,
                    'trans_details' => $details,
					'product_id' => $id,
					'trans_lang' => $lang
					);
					$this->db->insert('products_translation', $data);
				}else{
					$data = array(
                        'trans_name' => $name,
                        'trans_product_details' => $product_details,
                        'trans_details' => $details,
					);
					$this->db->where('product_id', $id);
					$this->db->where('trans_lang', $lang);
					$this->db->update('products_translation', $data);
				}
			}
		}
    }
    
    function getProductsTranslation($lang, $id){
		$this->db->where('trans_lang', $lang);
        $this->db->where('product_id', $id);
        $res = $this->db->get('products_translation');
        if($res)
            return $res->result();
        else
            return array();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getQASuggestions($term, $limit = 5){
        $this->db->select('' . $this->db->dbprefix('products') . '.id, code, ' . $this->db->dbprefix('products') . '.name as name')
            ->where("product_type = 'default' AND "
                . "(" . $this->db->dbprefix('products') . ".name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR
                concat(" . $this->db->dbprefix('products') . ".name, ' (', code, ')') LIKE '%" . $term . "%')")
            ->limit($limit);
        $q = $this->db->get('products');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getQASuggestions_production($term, $limit = 5){
        $this->db->select('' . $this->db->dbprefix('products') . '.id, code, ' . $this->db->dbprefix('products') . '.name as name')
            ->where("product_type = 'default' AND type = 'production' AND "
                . "(" . $this->db->dbprefix('products') . ".name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR
                concat(" . $this->db->dbprefix('products') . ".name, ' (', code, ')') LIKE '%" . $term . "%')")
            ->limit($limit);
        $q = $this->db->get('products');
        //echo $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getProductsForPrinting($term, $limit = 5){
        $this->db->select('' . $this->db->dbprefix('products') . '.id, code, ' . $this->db->dbprefix('products') . '.name as name, ' . $this->db->dbprefix('products') . '.price as price')
            ->where("product_type = 'default' AND (" . $this->db->dbprefix('products') . ".name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR
                concat(" . $this->db->dbprefix('products') . ".name, ' (', code, ')') LIKE '%" . $term . "%')")
            ->limit($limit);
        $q = $this->db->get('products');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function updatePrice($data = array()){
        if ($this->db->update_batch('products', $data, 'code')) {
            return true;
        }
        return false;
    }

    public function quickUpdatePrice($data = array(), $id){
        $this->db->where('id', $id);
        if ($this->db->update('products', $data)) {
            return true;
        }
        return false;
    }

    public function deleteProduct($id){
        if ($this->db->delete('products', array('id' => $id))) {
            // $this->db->delete('product_photos', array('product_id' => $id));
            return true;
        }
        return FALSE;
    }

    public function deleteProductCategory($id){
        if ($this->db->delete('products_categories', array('id' => $id))) {
            // $this->db->delete('product_photos', array('product_id' => $id));
            return true;
        }
        return FALSE;
    }

    public function totalCategoryProducts($category_id){
        $q = $this->db->get_where('products', array('category_id' => $category_id, "product_type" => "default"));
        return $q->num_rows();
    }

    public function getCategoryByCode($code){
        //print_r($id);exit;
        $q = $this->db->get_where('categories', array('code' => $code), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getProductionItems_data($code){
        //print_r($code);exit;
        $this->db->select('*');
        $this->db->from('sma_products');
        $this->db->where('code', $code);
        $this->db->where('product_type', 'default');
        $q = $this->db->get();
        // $q = $this->db->get_where('sma_products', array('code' => $code), 1);
        if ($q->num_rows() > 0) {
            return $q->result();
        }
        return FALSE;
    }

    public function products_count($category_id){
        if ($category_id) {
            $this->db->where('category_id', $category_id);
        }
        $this->db->where('product_type', 'default');
        $this->db->from('products');
        return $this->db->count_all_results();
    }

    public function getSubProducts($id){
        if ($id) {
            $this->db->where('parent', $id);
        }
        $this->db->from('products');
        return $this->db->count_all_results();
    }

    public function getProperties($id){
        if ($id) {
            $this->db->where('parent', $id);
        }
        $this->db->from('products');
        return $this->db->count_all_results();
    }

    public function fetch_products($category_id, $limit, $start ){
        $this->db->limit($limit, $start);
        if ($category_id) {
            $this->db->where('category_id', $category_id);
        }
        $this->db->where('product_type', 'default');
        $this->db->order_by("id", "asc");
        $query = $this->db->get("products");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getSoldQty($id){
        $this->db->select("date_format(" . $this->db->dbprefix('sales') . ".date, '%Y-%M') month, SUM( " . $this->db->dbprefix('sale_items') . ".quantity ) as sold, SUM( " . $this->db->dbprefix('sale_items') . ".subtotal ) as amount")
            ->from('sales')
            ->join('sale_items', 'sales.id=sale_items.sale_id', 'left')
            ->group_by("date_format(" . $this->db->dbprefix('sales') . ".date, '%Y-%m')")
            ->where($this->db->dbprefix('sale_items') . '.product_id', $id)
            //->where('DATE(NOW()) - INTERVAL 1 MONTH')
            ->where('DATE_ADD(curdate(), INTERVAL 1 MONTH)')
            ->order_by("date_format(" . $this->db->dbprefix('sales') . ".date, '%Y-%m') desc")->limit(3);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

}
