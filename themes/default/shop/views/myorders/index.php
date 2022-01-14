<style>
    body{
        background:#f5f5f5 !important;
    }
    .fas-check{
        height: 60px;
        width: 60px;
    }
    .fas-check>i{
        font-size: 25px;
    }
</style>
<div class="order-confirm_wrap">
   <div class="banner_order">
        <div class="w-100 o-back-layer position-relative mb-5" style="background:url(<?php echo base_url();?>assets/images/scot_movers.jpg) #f5f5f5 top center no-repeat;">
            <div class="container-wrapper position-relative py-5">
                <div class="d-flex flex-wrap flex-column align-items-center font-style-header">
                    <div class="fas-check d-flex align-center justify-content-center mb-3"><i class="fas text-white fa-check"></i></div>
                    <h5 class="text-white">Your ScotRemovals move is confirmed!</h5>
                    <h6 class="text-white">Thank you for booking with ScotRemovals</h6>
                </div>
                <div class="order-information-box bg-white  mt-3 p-4">
                    <div class="info-order-text">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="col-md-8 px-0">
                            <h5 class="mb-0">Booking Ref. <span><?php echo $order->trackingID; ?></span></h5>
                            </div>  
                            <div class="col-md-4 px-0">
                                <div class="d-flex flex-wrap justify-content-end">
                                <a href="<?php echo base_url('shop/edit_order');?>" class="btn btn-bg-scot text-white text-decoration-none">Edit Booking</a>
                                </div>
                            </div>  
                       </div>
                    </div>
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="job-status">
                            <h5>Job Status: <i class="fas fa-check"></i><span> Confirmed</span><h5>
                        </div>
                        <div class="order_total_amount ml-auto text-md-right mt-4">
                            <span class="total_hhd">Total Price</span>
                            <h5>£<?php echo $order->order_price?></h5>
                            <p class="mb-0">Paid: <span>£<?php echo $order->order_price?></span></p>
                        </div>
                    </div>
                    <h5 class="col-12 px-0 mt-3 order-page-head">Your Items</h5>
                    <div class="user_order_items row py-3">
                        <?php
                        foreach($order->order_details as $details){
                        ?>
                        <div class="col-md-4 mb-2">
                            <div class="order_item_box">
                            <p class="d-flex mb-0 w-100"><span> <?php echo $details->product_name; ?></span><span class="ml-auto"><?php echo $details->product_quantity; ?></span></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="border-dotted-bottom mt-2"></div>
                    <div class="row location_order_details">
                        <div class="col-sm-6 col-md-4 mt-4">
                            <h5>Pickup Details</h5>
                            <div class="order_dt_detail">
                                <p class="mb-0">Date: <span><?php echo date('j/n/yy',strtotime($order->order_date)); ?></span></p>
                                <p class="mb-0">Time Period: <span><?php echo date('h:i A',strtotime($order->strt_time)).' - '.date('h:i A',strtotime($order->end_time)); ?></span></p>
                                <p class="mt-2 mb-0"><?php echo $order->pickup_name.' , '.$order->pickup_phone; ?></p>
                                <p class="mb-0"><?php echo $order->pickup_postal; ?></p>
                                <p class="mb-0"><?php echo $order->pickup_address; ?></p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 mt-4">
                            <h5>Delivery Details</h5>
                            <div class="order_dt_detail">
                                <p class="mb-0">Date: <span><?php echo date('j/n/yy',strtotime($order->order_date)); ?></span></p>
                                <p class="mb-0">Time Period: <span><?php echo date('h:i A',strtotime($order->strt_time)).' - '.date('h:i A',strtotime($order->end_time)); ?></span></p>
                                <p class="mt-2 mb-0"><?php echo $order->delivery_name.' , '.$order->delivery_phone; ?></p>
                                <p class="mb-0"><?php echo $order->delivery_postal; ?></p>
                                <p class="mb-0"><?php echo $order->delivery_address; ?></p>
                            </div>                 
                        </div>
                        <div class="col-sm-6 col-md-4 mt-4">
                            <h5>Additional Services</h5>
                            <div class="order_dt_detail">
                            <ul class="list-unstyled">
                                <li class="position-relative dot-circle">Basic Compensation Cover</li>
                                <li class="position-relative dot-circle">1 Person Required</li>
                            </ul> 
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>