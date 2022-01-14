<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function getSettings() {
        return $this->db->get('settings')->row();
    }

    public function getFloors() {
        return $this->db->get('floors')->result();
    }

    public function getShopSettings() {
        return $this->db->get('shop_settings')->row();
    }

    public function getDateFormat($id) {
        return $this->db->get_where('date_format', ['id' => $id], 1)->row();
    }

    public function getProducts($id = null, $product_type) {
        // return $this->db->get_where('products', ['product_type' => $product_type, 'type' => "product"])->result();
        if($id == null){
            $q = $this->db->query('SELECT p.*, "" as sub_products FROM sma_products as p WHERE p.product_type = "'.$product_type.'" AND p.type = "product" order by p.order_by ASC ');
        }else{
            $q = $this->db->query('SELECT p.* FROM sma_products as p WHERE p.product_type = "'.$product_type.'" AND p.parent = '.$id.'  order by p.order_by DESC' );
        }
		return $q->result();
    }

    public function getPrices($id, $slug, $type){
        if($type == "piano_transport"){
            $q = $this->db->query('SELECT pp.id, pp.'.$slug.' as price FROM sma_products_prices as pp WHERE pp.product_id = '.$id.'');
            if ($q->num_rows() > 0) {
                return $q->row();
            }
        }else if($type == "office_removal"){
            $q = $this->db->query('SELECT pp.id, pp.product_id, pp.'.$slug.' as price FROM sma_products_prices as pp WHERE pp.product_id IN ('.implode(',', $id).') ');
            if ($q->num_rows() > 0) {
                return $q->result();
            }
        }else if($type == "furniture_delivery"){
            $q = $this->db->query('SELECT pp.id, pp.product_id, pp.'.$slug.' as price FROM sma_products_prices as pp WHERE pp.product_id IN ('.implode(',', $id).') ');
            if ($q->num_rows() > 0) {
                return $q->result();
            }
        }else if($type == "house_removal"){
            $q = $this->db->query('SELECT pp.id, pp.product_id, pp.'.$slug.' as price FROM sma_products_prices as pp WHERE pp.product_id IN ('.implode(',', $id).') ');
            
            if ($q->num_rows() > 0) {
                return $q->result();
            }
        }else if($type == "man_and_van"){
            $q = $this->db->query('SELECT p.id, p.price as price FROM sma_products as p WHERE p.id IN ('.implode(',', $id).') ');
            if ($q->num_rows() > 0) {
                return $q->result();
            }
        }else if($type == "extra_services"){
            $q = $this->db->query('SELECT pp.id, pp.product_id, pp.'.$slug.' as price FROM sma_products_prices as pp WHERE pp.product_id IN ('.implode(',', $id).') ');
            
            if ($q->num_rows() > 0) {
                return $q->result();
            }
        }
        return FALSE;
    }


    public function getPrices1($id, $slug, $type){
        if($type == "piano_transport"){
            $q = $this->db->query('SELECT pp.id, pp.'.$slug.' as price FROM sma_products_prices as pp WHERE pp.product_id = '.$id.'');
            if ($q->num_rows() > 0) {
                return $q->row();
            }
        }else if($type == "office_removal"){
            $q = $this->db->query('SELECT pp.id, pp.product_id, pp.'.$slug.' as price FROM sma_products_prices as pp WHERE pp.product_id = '.$id.' ');
            if ($q->num_rows() > 0) {
                return $q->row();
            }
        }else if($type == "furniture_delivery"){
            $q = $this->db->query('SELECT pp.id, pp.product_id, pp.'.$slug.' as price FROM sma_products_prices as pp WHERE pp.product_id = '.$id.' ');
            if ($q->num_rows() > 0) {
                return $q->row();
            }
        }else if($type == "house_removal"){
            $q = $this->db->query('SELECT pp.id, pp.product_id, pp.'.$slug.' as price FROM sma_products_prices as pp WHERE pp.product_id = '.$id.' ');
            
            if ($q->num_rows() > 0) {
                return $q->row();
            }
        }else if($type == "man_and_van"){
            $q =$this->db->query('SELECT pp.id, pp.product_id, pp.'.$slug.' as price FROM sma_products_prices as pp WHERE pp.product_id = '.$id.' ');
            if ($q->num_rows() > 0) {
                return $q->row();
            }
        }else if($type == "extra_services"){
            $q = $this->db->query('SELECT pp.id, pp.product_id, pp.'.$slug.' as price FROM sma_products_prices as pp WHERE pp.product_id = '.$id.' ');
            
            if ($q->num_rows() > 0) {
                return $q->row();
            }
        }
        return FALSE;
    }

    public function getCategories() {
        $q = $this->db->query('SELECT pc.*, "" as properties FROM sma_products_categories as pc ');
		return $q->result();
    }

    public function addCustomer($data) {
        if ($this->db->insert('companies', $data)) {
            return $this->db->insert_id();
        }
        return FALSE;
    }

    public function getAllCurrencies() {
        return $this->db->get('currencies')->result();
    }

    public function getNotifications() {
        $date = date('Y-m-d H:i:s', time());
        $this->db->where("from_date <=", $date)
        ->where("till_date >=", $date)->where('scope !=', 2);
        return $this->db->get("notifications")->result();
    }

    public function getAddresses() {
        return $this->db->get_where("addresses", ['company_id' => $this->session->userdata('company_id')])->result();
    }

    public function getCurrencyByCode($code) {
        return $this->db->get_where('currencies', ['code' => $code], 1)->row();
    }

    public function getAllCategories() {
        $pc = "(SELECT count(*) FROM {$this->db->dbprefix('products')})";
        $this->db->select("{$this->db->dbprefix('categories')}.*, {$pc} AS product_count", false)
        ->group_start()->where('parent_id', NULL)->or_where('parent_id', 0)->group_end()->order_by('name');
        if ($this->shop_settings->hide0) {
            $this->db->where("{$pc} >", 0);
        }
        return $this->db->get("categories")->result();
    }

    public function getCategoryBySlug($slug) {
        return $this->db->get_where('categories', ['slug' => $slug], 1)->row();
    }

    public function getUserByEmail($email) {
        return $this->db->get_where('users', ['email' => $email], 1)->row();
    }

    public function getAllPages() {
        $this->db->select('name, slug')->order_by('order_no asc');
        return $this->db->get_where("pages", ['active' => 1])->result();
    }

    public function getPageBySlug($slug) {
        return $this->db->get_where('pages', ['slug' => $slug], 1)->row();
    }

    public function getFeaturedProducts($limit = 16, $promo = TRUE) {

        $this->db->select("{$this->db->dbprefix('products')}.id as id, {$this->db->dbprefix('products')}.name as name, {$this->db->dbprefix('products')}.code as code, {$this->db->dbprefix('products')}.image as image, {$this->db->dbprefix('products')}.slug as slug, {$this->db->dbprefix('products')}.price, quantity, type, promotion, promo_price, start_date, end_date, b.name as brand_name, b.slug as brand_slug, c.name as category_name, c.slug as category_slug")
        ->join('categories c', 'products.category_id=c.id', 'left')
        ->where('products.featured', 1)
        ->where('hide !=', 1)
        ->limit($limit);

        $this->db->order_by('RAND()');
        return $this->db->get("products")->result();
    }

    public function getProductstest($filters = []) {

        $this->db->select("{$this->db->dbprefix('products')}.id as id, {$this->db->dbprefix('products')}.name as name, {$this->db->dbprefix('products')}.code as code, {$this->db->dbprefix('products')}.image as image, {$this->db->dbprefix('products')}.slug as slug, {$this->db->dbprefix('products')}.price, type, product_details as product_details, details")
        ->from("products")
        ->group_by('products.id');

        $this->db->where('hide !=', 1)
        ->limit($filters['limit'], $filters['offset']);
        if (!empty($filters)) {
            
            if (!empty($filters['query'])) {
                $this->db->group_start()->like('name', $filters['query'], 'both')->or_like('code', $filters['query'], 'both')->group_end();
            }
            if (!empty($filters['category'])) {
                $this->db->where('category_id', $filters['category']['id']);
            }
            if (!empty($filters['min_price'])) {
                $this->db->where('price >=', $filters['min_price']);
            }
            if (!empty($filters['max_price'])) {
                $this->db->where('price <=', $filters['max_price']);
            }
            if (!empty($filters['sorting'])) {
                $sort = explode('-', $filters['sorting']);
                $this->db->order_by($sort[0], $this->db->escape_str($sort[1]));
            } else {
                $this->db->order_by('name asc');
            }
        } else {
            $this->db->order_by('name asc');
        }
        return $this->db->get()->result_array();
    }

    public function getProductsCount($filters = []) {

        $this->db->select("{$this->db->dbprefix('products')}.id as id")
        ->group_by('products.id');

        if (!empty($filters)) {
            
            if (!empty($filters['query'])) {
                $this->db->group_start()->like('name', $filters['query'], 'both')->or_like('code', $filters['query'], 'both')->group_end();
            }
            if (!empty($filters['category'])) {
                $this->db->where('category_id', $filters['category']['id']);
            }
            if (!empty($filters['min_price'])) {
                $this->db->where('price >=', $filters['min_price']);
            }
            if (!empty($filters['max_price'])) {
                $this->db->where('price <=', $filters['max_price']);
            }
        }

        $this->db->where('hide !=', 1);
        return $this->db->count_all_results("products");
    }

    public function getProductBySlug($slug) {
        $this->db->select("{$this->db->dbprefix('products')}.*");
        return $this->db->get_where('products', ['slug' => $slug, 'hide !=' => 1], 1)->row();
    }

    public function getProductByID($id) {
        $this->db->select("{$this->db->dbprefix('products')}.id as id, {$this->db->dbprefix('products')}.name as name, {$this->db->dbprefix('products')}.code as code, {$this->db->dbprefix('products')}.image as image, {$this->db->dbprefix('products')}.slug as slug, price, quantity, type, product_details as details");
        return $this->db->get_where('products', ['id' => $id], 1)->row();
    }

    public function getAddressByID($id) {
        return $this->db->get_where('addresses', ['id' => $id], 1)->row();
    }

    public function addSale($data, $items, $customer, $address){

        if (is_array($customer) && !empty($customer)) {
            $this->db->insert('companies', $customer);
            $data['customer_id'] = $this->db->insert_id();
        }

        if (is_array($address) && !empty($address)) {
            $address['company_id'] = $data['customer_id'];
            $this->db->insert('addresses', $address);
            $data['address_id'] = $this->db->insert_id();
        }

        if ($this->db->insert('sales', $data)) {
            $sale_id = $this->db->insert_id();
            $this->site->updateReference('so');

            foreach ($items as $item) {

                $item['sale_id'] = $sale_id;
                $this->db->insert('sale_items', $item);
                $sale_item_id = $this->db->insert_id();
                if ($data['sale_status'] == 'completed') {

                }
            }
            return $sale_id;
        }

        return false;
    }

    public function getOrder($clause) {
        if ($this->loggedIn) {
            $this->db->order_by('id desc');
            $sale = $this->db->get_where('sales', ['id' => $clause['id']], 1)->row();
            return ($sale->customer_id == $this->session->userdata('company_id')) ? $sale : FALSE;
        } elseif(!empty($clause['hash'])) {
            return $this->db->get_where('sales', $clause, 1)->row();
        }
        return FALSE;
    }

    public function order_by_id($id) {
        return $this->db->where('id',$id)->get('sma_order')->row();
    }

    public function getOrders($limit, $offset) {
        if ($this->loggedIn) {
            $this->db->select("sales.*")
            ->order_by('id', 'desc')->limit($limit, $offset);
            return $this->db->get_where('sales', ['customer_id' => $this->session->userdata('company_id')])->result();
        }
        return FALSE;
    }

    public function getOrdersCount() {
        $this->db->where('customer_id', $this->session->userdata('company_id'));
        return $this->db->count_all_results("sales");
    }

    public function getOrderItems($sale_id) {
        $this->db->select('sale_items.*, products.image, products.details as details, products.product_details as product_details, products.hsn_code as hsn_code')
            ->join('products', 'products.id=sale_items.product_id', 'left')
            ->group_by('sale_items.id')
            ->order_by('id', 'asc');

        return $this->db->get_where('sale_items', ['sale_id' => $sale_id])->result();
    }

    public function getProductPhotos($id) {
        $q = $this->db->get_where("product_photos", array('product_id' => $id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getSaleByID($id) {
        return $this->db->get_where('sales', ['id' => $id])->row();
    }

    public function getCompanyByID($id) {
        return $this->db->get_where('companies', ['id' => $id])->row();
    }

    public function updateCompany($id, $data = array()) {
        return $this->db->update('companies', $data, ['id' => $id]);
    }

    public function updateProductViews($id, $views) {
        $views = is_numeric($views) ? ($views+1) : 1;
        return $this->db->update('products', ['views' => $views], ['id' => $id]);
    }

    public function getProductForCart($id) {
        $this->db->select("{$this->db->dbprefix('products')}.*")->where('products.id', $id);
        $q = $this->db->get('products', 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getOtherProducts($id, $category_id) {
        $this->db->select("{$this->db->dbprefix('products')}.id as id, {$this->db->dbprefix('products')}.name as name, {$this->db->dbprefix('products')}.code as code, {$this->db->dbprefix('products')}.image as image, {$this->db->dbprefix('products')}.slug as slug, {$this->db->dbprefix('products')}.price, type, c.name as category_name, c.slug as category_slug, product_details")
        ->join('categories c', 'products.category_id=c.id', 'left')
        ->where('category_id', $category_id)
        ->where('products.id !=', $id)->where('hide !=', 1)
        ->order_by('rand()')->limit(4);
        return $this->db->get('products')->result();
    }

    public function getCompanyByEmail($email){
        $q = $this->db->get_where('companies', array('email' => $email), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function updateStatus($id){
        //$sale = $this->getInvoiceByID($id);
        if ($this->db->update('sales', array('sale_status' => 'cancel'), array('id' => $id))) {
            return true;
        }
        return false;
    }
    public function search_products($product,$product_type,$type)
    {
        $this->db->select("id,name")->from("products");
        if($product !="")
        {
            $this->db->where('product_type', $product_type)->where('type',$type);
            $this->db->like("name", $product);
            $this->db->order_by("name","ASC");
        }
         return $qry = $this->db->get()->result();
    }
    public function save_storage_info($data)
    {
        if($this->db->insert('storage', $data))
        {
            return $this->db->insert_id();
        }
    }
    public function update_storage_info($data, $id)
    {
        // return $this->db->update('storage', $data, ['ip_address' => $this->input->ip_address()]);
        return $this->db->update('storage', $data, ['cookie_id' => $id]);
    }
    public function get_storage($id)
    {
      //$qry = $this->db->where('ip_address', $ip)->order_by('id','DESC')->get('sma_storage');
      $qry = $this->db->where('cookie_id', $id)->order_by('id','DESC')->get('sma_storage');
      echo $this->db->last_query();
      if($qry!="")
      {
          return $qry->row();
      }
    }
    public function update_smastorage($data,$id,$edit_order = null)
    {
        if($edit_order != null){
            return $this->db->update('sma_storage', $data, ['order_id' => $id]);
        }
        else{
            return $this->db->update('sma_storage', $data, ['id' => $id]);
        }
    }
    public function delete_storage($id)
    {
        // $this->db->where('ip_address', $this->input->ip_address())->delete('sma_storage');
        $this->db->where('cookie_id', $id)->delete('sma_storage');
    }
    public function deleteStorageByID($id)
    {
        $this->db->where('id', $id)->delete('sma_storage');
    }
    public function getStorageByID($id,$edit_order = null) {
        if($edit_order != null){
            return $this->db->get_where('storage', ['order_id' => $edit_order], 1)->row();
        }else{
            return $this->db->get_where('storage', ['id' => $id], 1)->row();
        }
    }
    public function save_order($data)
    {
        if($this->db->insert('sma_order', $data))
        {
            return $this->db->insert_id();
        }
    }
    public function update_order($data, $id)
    {
        return $this->db->update('sma_order', $data, ['id' => $id]);
    }
    public function save_order_details($data)
    {
        if($this->db->insert('sma_order_details', $data))
        {
            return $this->db->insert_id();
        }
    }
    public function save_payment_details($data)
    {
        if($this->db->insert('sma_payments', $data))
        {
            return $this->db->insert_id();
        }
    }
    public function get_order($id)
    {
        $order = $this->db->select('sma_order.*, "" as order_details')
            ->from('sma_order')
            ->where('id',$id)
            ->get()->row();
        $order->order_details = $this->db->select('sma_order_details.*')
            ->from('sma_order_details')
            ->where('order_id',$id)
            ->get()->result();
        
        if ( count($order) > 0) {
        return $order;
        }
        return FALSE;
    }
    public function edit_order($track)
    {
        $order = $this->db->select('sma_order.*, "" as order_details')
            ->from('sma_order')
            ->where('trackingID',$track)
            ->get()->row();
        $order->order_details = $this->db->select('sma_order_details.*')
            ->from('sma_order_details')
            ->where('order_id',$order->id)
            ->get()->result();
        
        if ( count($order) > 0) {
        return $order;
        }
        return FALSE;
    }
}
