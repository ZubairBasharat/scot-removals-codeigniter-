<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$products = !empty($storage) ? json_decode($storage->products_list) : array();
$price = !empty($storage) ? $storage->total : 0;
$storage_id = !empty($storage) ? $storage->id : 0;
$type = !empty($storage) ?$storage->type : "";
 if(!empty($storage)){if(!empty($storage->strt_time)){$strt_time = $storage->strt_time; }}
 if(!empty($storage)){if(!empty($storage->end_time)){$end_time = $storage->end_time; }}
?>
<style>
body.modal-open{
    padding-right:0px !important;
}
   .modal-backdrop.show{
      z-index:0 !important;
    }
    div.modal{
        background: #00000085;
        padding-right:0px !important;
    }
   .modal .main_drop_aria .dropdown_content{
       height:300px;
       overflow-y:auto;
       overflow-x:hidden;
    }
        .panel-title {
        display: inline;
        font-weight: bold;
        }
        .display-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }
        .panel-title {
        display: inline;
        font-weight: bold;
        }
        .display-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }
        .booking_details .user-input-wrp input#pickup ~ .floating-label, .booking_details .user-input-wrp input#drop ~ .floating-label {
            background: #fff !important;
        }
        .user-input-wrp input#pickup ~ .floating-label, .user-input-wrp input#drop ~ .floating-label {
            top: -13px;
            left: 10px;
            font-size: 13px;
            opacity: 1;
            background: #404257;
        }
   </style>
<section class="banner_main site_c_banner">
   <div class="site_banner pb-0 row  py-md-4 page">
        <div class="pl-0 pr-0 pr-md-3 pb-0 col-md-8">
            <div class="mb-4 position-relative d-md-none">
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
            <form class="booking_details" method="post" action="<?php echo base_url('save_order'); ?>">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <input type="hidden" name="OrderDate" id="order_date" value="<?= $OrderDate ?>">
                <input type="hidden" name="persons" id="order_persons" value="<?= $persons ?>">
                <input type="hidden" name="start_time" id="start_time" value="<?= $strt_time ?>">
                <input type="hidden" name="end_time" id="end_time" value="<?= $end_time ?>">
                    <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p><?php echo $this->session->flashdata('success'); ?></p>
                    </div>
                    <?php } ?>
                <div class="bg-white p-xl-5 p-3 bg_drop">
                    <div class="banner_inner_text p-0">
                        <h3 class="mb-0"><span class="circle_icon position-change-i"></span>Your booking details</h3>
                    </div>
                    <div class="d-inline-block w-100">
                        <div class="email_input adress_form row mx-0">
                            <div class="user-input-wrp col-12 px-0">
                                <input type="text" class="inputText focus_val_input order_validation border sys_val pr-3" autocomplete="off" data-id="focus_fname" value="<?= (!empty($order_data)? $order_data->booking_first_last_name : '') ?>"  name="booking_name" id="booking_name" required>
                                <span class="floating-label">First and Last Name</span>
                            </div>
                            <div class="user-input-wrp col-sm-6 pl-0 pr-0 pr-sm-3">
                                <input type="text" class="inputText focus_val_input text-lowercase order_validation border pr-3 focus_fname" autocomplete="off" data-id="focus_email" value="<?= !empty($order_data)? $order_data->bookig_email : '' ?>" name="booking_email" id="booking_email" required>
                                <span class="floating-label">Email Address</span>
                            </div>
                            <div class="col-sm-6 px-0 target_ph_in">   
                                <div class="user-input-wrp d-flex  input-group-ph flex-wrap">
                                    <input type="number" class="position-relative inputText focus_val_input order_validation focus_email w-auto pr-3 booking_phone" data-id="at_delivery" value="<?= !empty($order_data)? $order_data->booking_phone : '' ?>" name="booking_phone" id="booking_phone" required>
                                    <span class="floating-label">Phone Number at Delivery</span>
                                    <button class="trigger_ph_in fa fa-plus position-absolute add-phone-num-btn" type="button"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="bg-white p-xl-5 p-3 bg_drop my-4">
                    <div class="banner_inner_text p-0 mb-4">
                        <h3 class="mb-0"><span class="circle_icon position-change-i"></span>Pickup address & contact details</h3>
                    </div>
                    <div class="d-inline-block w-100">
                        <div class="email_input adress_form row mx-0">
                                <div class="user-input-wrp mt-0 col-sm-5 pl-0 pr-0 pr-sm-3">
                                    <input type="text" class="inputText focus_val_input order_validation at_delivery border sys_val_post pr-3" data-id="post_cd" autocomplete="off" value="<?= !empty($order_data)? $order_data->pickup_postal : '' ?>" name="pickup_postal" id="pickup_postal" required>
                                    <span class="floating-label">Post Code</span>
                                </div>
                                <div class="col-sm-7 px-0 banner_inner_form m-0">
                                    <div class="user-input-wrp d-flex input-group-ph mt-0 flex-wrap mt-sm-25">
                                        <input class="form_input w-100" type="text" autocomplete="off" value="<?= $storage->pickup_location ?>" id="pickup" required >
                                        <span class="floating-label">Pick Up Location</span>
                                    </div>
                                </div>
                                <div class="user-input-wrp col-sm-5 pl-0 pr-0 pr-sm-3">
                                    <input type="text" autocomplete="off" class="inputText order_validation focus_val_input border sys_val pr-3 post_cd" data-id="ph_pick" autocomplete="off" value="<?= !empty($order_data)? $order_data->pickup_name : '' ?>" name="pickup_name" id="pickup_name" required>
                                    <span class="floating-label">Contact Name at Pickup</span>
                                </div>
                                <div class="col-sm-7 px-0 target_ph_in">   
                                    <div class="user-input-wrp d-flex input-group-ph flex-wrap">
                                        <input type="number" class="position-relative inputText order_validation focus_val_input_validation w-auto pr-3 ph_pick focus_val_input pickup_phone" data-id="pn_pick" value="<?= !empty($order_data)? $order_data->pickup_phone : '' ?>" name="pickup_phone" id="pickup_phone" required>
                                        <span class="floating-label">Phone Number at Pickup</span>
                                        <button class="trigger_ph_in fa fa-plus add-phone-num-btn position-absolute" type="button"></button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div> 
                <div class="bg-white p-xl-5 p-3 bg_drop my-4">
                    <div class="banner_inner_text p-0 mb-4">
                        <h3 class="mb-0"><span class="circle_icon position-change-i"></span>Delivery address & contact details</h3>
                    </div>
                    <div class="d-inline-block w-100">
                        <div class="email_input adress_form row mx-0">
                            <div class="user-input-wrp mt-0 col-sm-5 pl-0 pr-0 pr-sm-3">
                                <input type="text" class="inputText order_validation border focus_val_input sys_val_post pr-3 pn_pick" data-id="cn_del" autocomplete="off" value="<?= !empty($order_data)? $order_data->delivery_postal : '' ?>" name="delivery_postal" id="delivery_postal" required>
                                <span class="floating-label">Postcode</span>
                            </div>
                            <div class="col-sm-7 px-0 banner_inner_form m-0">
                                    <div class="user-input-wrp d-flex input-group-ph mt-0 flex-wrap mt-sm-25">
                                        <input class="form_input w-100" type="text" value="<?= $storage->drop_location ?>" autocomplete="off" required id="drop">
                                        <span class="floating-label">Drop Off Location</span>
                                    </div>
                                </div>
                            <div class="user-input-wrp col-sm-5 pl-0 pr-0 pr-sm-3">
                                <input type="text" class="inputText order_validation focus_val_input border sys_val pr-3 cn_del" data-id="ph_ppc" value="<?= !empty($order_data)? $order_data->delivery_name : '' ?>" name="delivery_name" autocomplete="off" id="delivery_name" required>
                                <span class="floating-label">Contact Name at Delivery</span>
                            </div>
                            <div class="col-sm-7 px-0 target_ph_in">
                                <div class="user-input-wrp d-flex input-group-ph flex-wrap">
                                    <input type="number" class="position-relative inputText order_validation ph_ppc focus_val_input w-auto pr-3 drop_phone" value="<?= !empty($order_data)? $order_data->delivery_phone : '' ?>"  name="delivery_phone" id="delivery_phone" required>
                                    <span class="floating-label">Phone Number at Delivery</span>
                                    <button class="trigger_ph_in fa fa-plus position-absolute add-phone-num-btn" type="button"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-block instance_btn w-100 mx-0 mt-4">
                    <button type="button" data-toggle="modal" class="price_btn w-100 border-0 pt-0" id="complete_quote" onclick="save_order();">
                        Complete My Quote
                    </button>
                </div>
           </form>
       </div>

    <div class="col-md-4 pr-0 pl-0 pl-md-3 mt-4 mt-md-0">
        <div class="mb-4 position-relative d-none d-md-block">
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
         <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4945541.406433895!2d-6.812930082618514!3d52.75357023711754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d0a98a6c1ed5df%3A0xf4e19525332d8ea8!2sEngland%2C%20UK!5e0!3m2!1sen!2s!4v1582885261968!5m2!1sen!2s" width="100%" height="300px" frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
            <div class="tabs_sec cart px-0 pb-0 bg-white item_counter_box">
               <div class="item_header pb-3 pt-2">
                  <h3>My Item List<span id="items_length" style="font-size: 20px;"></span></h3>
               </div>
               <!-- <div class="d-block d-md-none edit_jb_items px-2 d-flex align-center justify-content-center py-3 cursor-pointer border-top" onclick="edit_job()">Edit Jobs</div> -->
                <div class="counter-body">
                    <div class="category_pitem"></div>
                    <div class="extra_services_container" style="display: none;"> 
                     <div class="py-2 item_inner_header">
                        <span>Extra Services Items</span>
                     </div>
                     <div class="counter-body-extra-services">
                     </div>
                    </div>   
               </div>   
               <div class="edit_jb_items px-2  align-center py-3 ">
                  <div class="d-flex flex-wrap">
                     <span class="scot-blue">Pickup Location</span>
                     <a href="javascript:void(0)" class="ml-auto" onclick="edit_location();"><img class="svg" src="<?php echo base_url();?>assets/images/edit.svg"></a>
                  </div>
                  <P class="mb-3"><?= $storage->pickup_location ?></p>
                  <span class="privacy-1h">Drop Off Location</span>
                  <P class="mb-0"><?= $storage->drop_location ?></p>
                  <div class="d-flex flex-wrap border-top mt-3 mx-min-m px-2 pt-3">
                     <h6 class="mb-0">Total Price</h6>
                     <P class="mb-0 ml-auto font-bd">£<?= $price+0?>.00</p>
                  </div>
               </div>    
            </div>
        </div>
        
        <div class="d-block d-md-none instance_btn w-100 mx-0 mt-4">
            <button type="button" data-toggle="modal" class="price_btn w-100 border-0 pt-0" id="complete_quote" onclick="save_order();">
                Complete My Quote
            </button>
        </div>      
   </div>
   </section>
       <!-- modal -->
       <div class="modal fade" id="paypal-stripe_modal" tabindex="-1" role="dialog" aria-labelledby="paypal-stripe_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-white">
                    <div class="new-modal-h mt-4 mb-3">
                        <h3 class="modal-heading-font-size text-center">Select payment method</h3>
                        <p class="text-center mb-0 scot-blue">We are not saving your payment details</p>
                    </div>
                    <div  data-toggle="modal" data-target="#payment_modal" class="" id="payment_popup_opener" data-dismiss="modal">
                        <div class="row">
                            <div class="mx-auto col-7 px-0 py-0 d-flex justify-content-center shadow-sm mb-4 payment-method-logo">
                                <div id="paypal-button-container"></div>
                                <div id="paypal-button" class="w-100"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div style="cursor: pointer;" class="mx-auto col-7 px-3 py-2 d-flex justify-content-center shadow-sm mb-5 payment-method-logo">
                                <img  src="<?php echo base_url();?>assets/images/cards.png" class="img-fluid" style="width: 115px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- modal end -->

       <!-- payment modal -->
       <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="payment_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color:white;">
                <div class="new-modal-h mt-4 mb-3">
                    <h3 class="modal-heading-font-size">Enter payments details</h3>
                </div>
                <form role="form" action="<?php echo base_url('shop/stripePost') ?>" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>" id="payment-form">
                    <input type="hidden" name="storage_id" value="<?= $this->uri->segment($this->uri->total_segments()) ?>">
                    <input type="radio" checked style="height:15px; width:15px;">
                    <img src="<?php echo base_url();?>assets/images/cards.png" style="width: 110px;" class="img-fluid ml-2">
                    <input type = "hidden" name = "<?=$this->security->get_csrf_token_name()?>" value = "<?=$this->security->get_csrf_hash()?>" />
                    <div class='form-row row mt-4'>
                        <div class='col-8 form-group required'>
                            <input class='form-control new-modal-input' size='4' type="text" value="test" placeholder="Name on card">
                        </div>
                        <div class="col-4">
                            <img src="<?php echo base_url();?>assets/images/PCI_DSS_Validated.png"  class="img-fluid" style="height:48px;">
                        </div>
                    </div>
                    <div class='form-row row'>
                        <div class='col-8 form-group required'>
                            <input autocomplete='off' class='form-control card-number new-modal-input' value="4242424242424242" maxlength='20' type='text' placeholder="Card Number">
                        </div>
                    </div>
                    <div class='form-row row'>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <select class='form-control card-expiry-month new-modal-select' type='text'>
                                <option selected>Exp. Month</option>
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>10</option>
                                <option>11</option>
                                <option selected>12</option>
                            </select>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <select class='form-control card-expiry-year new-modal-select' type='text'>
                                <option selected>Exp. Year</option>
                                <?php $c_year = date('Y'); 
                                for($i=$c_year; $i<=$c_year+10; $i++)
                                {
                                ?>
                                <option ><?= $i ?></option>
                                <?php }  ?>
                            </select>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                            <!-- <label class='control-label'>CVC</label> -->
                            <input autocomplete='off' minlength="3" class='form-control card-cvc kako' maxlength='3' type='text' value="123" placeholder="CVV">
                        </div>
                    </div>
                    <div class='form-row row'>
                        <div class='col-md-12 error form-group hide'>
                            <div class='alert-danger alert'>
                                Your driver only receives payment upon job completion
                            </div>
                        </div>
                    </div>
                    <div class="row position-relative">
                        <div class="col-12 new-modal-border-bottom">
                            <div class="d-flex">
                                <div>
                                    <h5 class="modal-text-color">Total Price</h5>
                                </div>
                                <div class="ml-auto">
                                    <h4 class="new-modal-p2">£<?= $price+0?>.00</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer px-0">
                        <div class="row mx-0">
                            <div class="col-md-6 px-0">
                                <p class="new-modal-text">By Clicking Book Now, you agree with our Privacy Policy and Terms of Use.</p>
                            </div>
                            <div class="col-md-6 px-0">
                                <button type="button" class="new-modal-btn1" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="new-modal-btn2">Book Now</button>
                            </div>
                        </div>           
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal end -->
<script src="<?= $assets; ?>validation.js?v=5"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="<?=base_url('assets/js/checkout.js')?>"></script>
<script>
   $('#drop').prop('disabled', true);
   $('#pickup').prop('disabled', true);
    var scrolled=0;
    var input_status = 0;
        $( ".card-cvc" ).keyup(function(e) {
            if (/\D/g.test(this.value))
            {
                // Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, '');
            }
        });
        $( ".card-number" ).keyup(function(e) {
            if (/\D/g.test(this.value))
            {
                // Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, '');
            }
        });

       $(document).ready(function(){
        $('.modal').on("hidden.bs.modal", function (e) { 
            if ($('.modal:visible').length) { 
                $('body').addClass('modal-open');
            }
        });
          var totsl_items = 0;
         " <?php if(!empty($products)){ foreach($products as $product){ ?>"
            <?php if($product->type=="extra_services"){ ?>
            $(".extra_services_container").css("display", "block");
            $(".counter-body-extra-services").append('<div class="items_counter list_counter_right item_row'+<?= $product->id ?>+' mb-1px" data-id='+"<?= $product->id ?>"+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+'><p class="item_name'+"<?= $product->id ?>"+'" data-id = "data-id='+"<?= $product->id ?>"+'">'+ "<?= $product->name ?>" +'</p><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input class="item_catagory_value<?= $product->id?>" readonly type="number" value="<?= $product->quantity?>" onchange="change_qty(<?= $product->id?>)" data-item="<?= $product->id?>"></li></ul></div></div></div></div>');
            <?php }else{ ?>
            $(".tabs_sec .counter-body .category_pitem").append('<div class="items_counter list_counter_right item_row'+<?= $product->id ?>+' mb-1px" data-id='+"<?= $product->id ?>"+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+'><p class="item_name'+"<?= $product->id ?>"+'" data-id = "data-id='+"<?= $product->id ?>"+'">'+ "<?= $product->name ?>" +'</p><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input class="item_catagory_value<?= $product->id?>" readonly type="number" value="<?= $product->quantity?>" onchange="change_qty(<?= $product->id?>)" data-item="<?= $product->id?>"></li></ul></div></div></div></div>');
            <?php } ?>
            totsl_items += parseInt("<?= $product->quantity?>");
            " <?php }} ?>"
            $('#items_length').text(" ("+totsl_items+")");
       });
       $(function () {
         $('[data-toggle="tooltip"]').tooltip();
        });
        $(function() {
    var $form         = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
        'input[type=text]', 'input[type=file]',
        'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');
        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault();
      }
    });
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
  });
  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
    function save_order(){
        $('html, body').animate({
            scrollTop: 0
        }, 100);
        $('.order_validation').each(function(){
          if($(this).val()==""){
            $(this).parent().find('.val_message').remove();
            $(this).parent().append('<span class="text-danger val_message  mt-2 d-block w-100">Field should not be empty</span>');
          }
          else{
            $(this).parent().find('.val_message').remove();
            input_status++;
          }
        });
        if(input_status >=9){
            // var pick = $('#pickup').val();
            // var drop = $('#drop').val();
            var booking_name = $('#booking_name').val();
            var booking_email = $('#booking_email').val();
            var booking_phone = $('#booking_phone').val();
            var b_s_number = $('.booking_phone.sub_input_number').val();
            var pickup_postal = $('#pickup_postal').val();
            var pickup_name = $('#pickup_name').val();
            var pickup_phone = $('#pickup_phone').val();
            var delivery_postal = $('#delivery_postal').val();
            var delivery_name = $('#delivery_name').val();
            var delivery_phone = $('#delivery_phone').val();
            var order_date = $('#order_date').val();
            var start_time = $('#start_time').val();
            var end_time = $('#end_time').val();
            var order_persons = $('#order_persons').val();
            var regex_email = /(.+)@(.+){2,}\.(.+){3,}/;
            var validpostal = /^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([AZa-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/;
            booking_email = booking_email.toLowerCase();
            if (!regex_email.test(booking_email)) {
                $('#booking_email').parent().find('.val_message').remove();
                $('#booking_email').parent().append('<span class="text-danger val_message  mt-2 d-block w-100">Email Not Valid</span>');
                 return;
            } else{
                if(!validpostal.test(pickup_postal)){
                    $('#pickup_postal').parent().find('.val_message').remove();
                    $('#pickup_postal').parent().find('.val_message_num').remove();
                    $('#pickup_postal').parent().append('<span class="text-danger val_message  mt-2 d-block w-100">Postal Code Not Valid</span>');
                    if(!validpostal.test(delivery_postal)){
                        $('#delivery_postal').parent().find('.val_message').remove();
                        $('#delivery_postal').parent().find('.val_message_num').remove();
                        $('#delivery_postal').parent().append('<span class="text-danger val_message  mt-2 d-block w-100">Postal Code Not Valid</span>');
                    } 
                    return;
                }else if(!validpostal.test(delivery_postal)){
                    $('#delivery_postal').parent().find('.val_message').remove();
                    $('#delivery_postal').parent().find('.val_message_num').remove();
                    $('#delivery_postal').parent().append('<span class="text-danger val_message  mt-2 d-block w-100">Postal Code Not Valid</span>');
                    if(!validpostal.test(pickup_postal)){
                        $('#pickup_postal').parent().find('.val_message').remove();
                        $('#pickup_postal').parent().find('.val_message_num').remove();
                        $('#pickup_postal').parent().append('<span class="text-danger val_message  mt-2 d-block w-100">Postal Code Not Valid</span>');
                    }
                    return;
                }
                 else{
                setTimeout(() => {
                $('#paypal-stripe_modal').modal('show');
                }, 1000);
                var storage_id = '<?= $this->uri->segment($this->uri->total_segments()) ?>';
                $.ajax({
                    type: "GET",
                    url: '<?php echo base_url('save_order'); ?>',
                    dataType: 'json',
                    data: {'edit_order':'yes','storage_id':storage_id,'order_date':order_date,'order_persons':order_persons,'booking_name': booking_name, 'booking_email': booking_email,'booking_phone': booking_phone, 'pickup_postal': pickup_postal,'pickup_name': pickup_name, 'pickup_phone': pickup_phone,'delivery_postal': delivery_postal, 'delivery_name': delivery_name, 'delivery_phone':delivery_phone , "start_time": start_time , "end_time": end_time},
                    success: function(data) {
                    },
                    error: function(data) { alert('Error in Order Saving.'); }
                });
                input_status = 0;
            }
        }
            }
        else{
            input_status = 0;
        }
    }
    // order form validation end
    </script>
    <script>
        paypal.Button.render({
            env: '<?php echo $paypal_env; ?>',
            style: {
            size: 'responsive',
            color: 'silver',
            shape: 'rect',
            label: 'checkout',
            tagline: 'false',
            border : 'false'
            },
            client: {
                <?php if($paypal_env == "production") { ?>
                    production: '<?php echo $paypal_clientid; ?>'
                <?php } else { ?>
                    sandbox: '<?php echo $paypal_clientid; ?>'
                <?php } ?>
                },
                payment: function (data, actions) {
                return actions.payment.create({
                    transactions: [{
                    amount: {
                    total: '<?php echo !empty($storage) ? number_format($storage->total, 2) : 0.00; ?>',
                    currency: '<?php echo $currency; ?>'
                }
            }],
        });
        },
        onAuthorize: function (data, actions) {
            return actions.payment.execute()
            .then(function () {
                window.location = "<?php echo $return_url;?>?paymentID="+data.paymentID+"&payerID="+data.payerID+"&token="+data.paymentToken+"&sid=<?php echo $storage_id; ?>&edit_order=<?= $this->uri->segment($this->uri->total_segments()) ?>";
            });
        }
        }, '#paypal-button');
   function edit_job()
    {
      if('<?= $type?>'=="piano_transport")
       {
        window.location.href = '<?= base_url('shop/piano_removal');?>';
       }
       else
       {
         window.location.href = '<?= base_url('shop/'.$type.'/details/'.$storage_id);?>';
       }
    }
    function edit_location(){
      window.location.href = '<?= base_url('shop/'.$type.'');?>';
    }
    </script>
