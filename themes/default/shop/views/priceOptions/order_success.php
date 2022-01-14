<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    body{
        background:#f7f7f7;
    }
</style>
<div class="row mx-0 my-5">
    <div class="col-md-10 mx-auto">
        <div class="user-order-status text-center">
           <img src="<?php echo base_url();?>assets/images/order-complete.png" width="120px" height="120px">
           <div class="order-status-text">
               <h5>Your Booking Completed Successfully!</h5>
               <p class="mb-4">Thank you for ordering. We received your order <br>and will begin processing it soon.</p>
           </div>
            <div class="header-status-item">
                <h5>Your Inventory</h5>
            </div>
            <?php 
            $total_item = 0;
            foreach($order->order_details as $order_detail){ 
                $total_item = $order_detail->product_quantity + $total_item;
                ?>
            <div class="order-status-items items-card-bar">
               <div class="d-flex align-items-center bg-white items-bar">
                   <p class="mb-0"><?= $order_detail->product_name ?></p>
                   <p class="mb-0 ml-auto"><?= $order_detail->product_quantity ?></p>
               </div>
           </div>
            <?php } ?>
           
            <div class="order-status-items">
                <div class="d-flex flex-wrap  bg-white items-bar">
                   <div class="col-sm-5 px-0 pl-sm-0">
                       <div class="location-detail text-left">
                          <h5>Pick Up Location</h5>
                          <span><?= $order->pickup_address ?></span>
                       </div>
                   </div>
                   <div class="col-sm-2 px-0 d-flex align-items-center location-sign flex-wrap justify-content-center">
                        <img src="<?php echo base_url();?>assets/images/location-sign.png" class="img-fluid">
                   </div>
                   <div class="col-sm-5 px-0 pl-sm-3">
                        <div class="location-detail text-left">
                            <h5 class="max-fit-content ml-auto">Drop Off Location</h5>
                            <span class="max-fit-content ml-auto d-block"><?= $order->delivery_address ?></span>
                        </div>
                   </div>
               </div>
           </div>
            <div class="order-status-items total-detail">
               <div class="bg-white items-bar">
                    <div class="mb-1 pt-1 d-flex align-items-center">
                        <p class="mb-0">Total Items</p>
                        <h6 class="mb-0 ml-auto"><?= $total_item ?></h6>
                    </div>
                   <div class="d-flex align-items-center bg-white w-100 br-cus-top py-1">
                        <p class="mb-0">Total Price</p>
                        <h6 class="mb-0 ml-auto">£<?= $order->order_price+0 ?>.00</h6>
                    </div>
               </div>
           </div>
            <div class="order-status-items mt-4">
               <div class="d-flex align-items-center bg-cus-primary items-bar">
                   <p class="mb-0">Order Tracking ID</p>
                   <p class="mb-0 ml-auto"><?= $order->trackingID ?></p>
               </div>
           </div>
           <div class="width-res-helpine">
                <div class="mb-2 position-relative">
                    <div class="position-absolute" style="bottom: 0px; left: -12px; z-index: 99;">
                        <img src="<?php echo base_url('assets/images/helpline.png');?>" class="img-fluid helpline-img">
                    </div>
                    <div class="helpline position-relative py-1">
                        <span class="helpline-shape"></span>
                        <div class="mt-4 mb-4 px-5">
                        <p class="text-center helpline-text mb-0">Prefer to get a price over the phone?</p>
                        <p class="text-center helpline-num"><a class="num-clr" href="tel:0141-390-8967">0141-390-8967</a></p>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>