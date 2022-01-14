<?php defined('BASEPATH') OR exit('No direct script access allowed');
   $last = $this->uri->segment(3);
   if(!empty($order)){
      // print_r($order);die;
      $slug = $order->slug;
      $type = $order->order_type;
  }else{
      $slug = "ground_to_ground";
      $type = "office_removal";
  }
  $storage_id = !empty($order) ? $order->id : 0;
?>
<?php $selected_products = !empty($order) ? json_decode($order->products_list) : array(); ?>
<!-- Step 1 -->
<div class="scot-edit-steps first_div">
   <div class="step-1">
   <!-- Banner Section Start -->
      <section class="banner_main site_c_banner" style="padding-bottom:20px !important;">
         <div class="site_banner  p-0" style="background:none;">
            <div class="row m-0">
               <div class="col-lg-8 col-md-6 pr-md-4 pl-0 wow slideInLeft pr-0" data-wow-duration="1.5s">
                  <div class="bg-white p-xl-5 p-3 bg_drop px-sm-10">
                     <div class="banner_inner_text p-0">
                        <h3 class="mb-0"><span class="circle_icon"></span>Get an accurate quote in just 3 mins!</h3>
                        <p class="mb-3">Save up to a massive 42% moving through Scot Removals</p>
                     </div>
                     <div class="banner_inner_form m-0">
                        <form class="row w-100 m-0">
                           <div class="col-lg-6  pr-0 pl-0">
                              <div class="user-input-wrp d-flex  location_area mt-1 flex-wrap">
                                 <input type="text" class="form_input w-100" placeholder="" value="<?php if(!empty($order)){ echo $order->pickup_address;}?>" required id="pickup">
                                 <span class="floating-label">Pick Up Location</span>
                              </div>
                           </div>
                           <div class="col-lg-6  pl-0 pl-lg-2 pr-0 mt-1">
                              <!-- inner_Dropdown 1 Start -->
                              <div class="w-100 main_drop_aria dop4" id="open_drop_li_click" >
                                 <div class="form_input drop_btn" id="catagory_inner2">
                                 <span class="btn_selected_text" data-id="0" data-slug="">Select Property Size</span>
                                    <span class="fa fa-angle-down float-right mr-3 toggle_icon"></span>
                                 </div>
                                 <div class="dropdown_list">
                                    <div class="dropdown_content catagory_inner2">
                                       <div class="row m-0 text-center content_list_view">
                                          <div class="col-12 content_col ">
                                             <img src="<?php echo base_url()?>assets/images/home2.svg">
                                             <ul class="p-0 mt-3 content_detail_list">
                                                <?php foreach ($floors as $f) { ?>
                                                <li <?php if($f->lift_option == 1){echo "class='open_checkbox1'";} ?>>
                                                   <span data-id="<?=$f->id?>" data-slug = "<?=$f->slug?>"><?=$f->name?></span>
                                                </li>
                                                <?php } ?>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- inner_Dropdown1 End -->
                              <!-- Checkbox inner_dropdown1 start -->
                              <div id="inner_checkbox1" class="position-relative" style="display:none;">
                                 <label class="container_checkbox">Lift Available
                                 <input type="checkbox" id="checkbox1"  >
                                 <span class="checkmark"></span>
                                 </label>
                              </div>
                              <!-- Checkbox inner_dropdown1 end -->
                           </div>
                           <div class="col-lg-6  pr-0 pl-0">
                              <div class="user-input-wrp d-flex  location_area mt-1 flex-wrap">
                                 <input type="text" class="form_input w-100" placeholder="" value="<?php if(!empty($order)){ echo $order->delivery_address;}?>" required id="drop">
                                 <span class="floating-label">Drop Off Location</span>
                              </div>
                           </div>
                           <div class="col-lg-6 pl-0 pr-0 pl-lg-2 mt-1">
                              <!-- Inner_Dropdown2 Start -->
                              <div class="w-100 main_drop_aria dop3" id="open_drop_li_click2">
                                 <div class="form_input drop_btn" id="catagory_inner3">
                                    <span class="btn_selected_text" data-id="0" data-slug="">Select Property Size</span>
                                    <span class="fa fa-angle-down float-right mr-3 toggle_icon"></span>
                                 </div>
                                 <div class="dropdown_list">
                                    <div class="dropdown_content catagory_inner3">
                                       <div class="row m-0 text-center content_list_view">
                                          <div class="col-12 content_col ">
                                             <img src="<?php echo base_url()?>assets/images/home2.svg">
                                             <ul class="p-0 mt-3 content_detail_list">
                                                <?php foreach ($floors as $f) { ?>
                                                <li <?php if($f->lift_option == 1){echo "class='open_checkbox2'";} ?>>
                                                   <span data-id="<?=$f->id?>" data-slug = "<?=$f->slug?>"><?=$f->name?></span>
                                                </li>
                                                <?php } ?>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- inner_Dropdown2 End -->
                              <!-- Checkbox inner_dropdown2 start -->
                              <div id="inner_checkbox2" class="position-relative" style="display:none;">
                                 <label class="container_checkbox">Lift Available
                                 <input type="checkbox" id="checkbox2"  >
                                 <span class="checkmark"></span>
                                 </label>
                              </div>
                              <!-- Checkbox inner_dropdown2 end -->
                           </div>
                           <div class="instance_btn w-100 position-relative">
                              <button class="price_btn w-100 border-0" id="complete_quote2" type="button" onclick="office_order_details()">
                              Complete My Quote
                              </button>
                              <div class="spinner-border position-absolute text-white button-spinner" role="status" style="display:none;right:10px;top:23%;width:1.5rem;height:1.5rem;">
                                 <span class="sr-only">Loading...</span>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 p-0 ml-auto mt-4 mt-md-0">
                  <h5 class="mb-3 mb-md-1 pb-2 color-rgb">Smart Way to Book Us</h5>
                  <!-- <div class="banner_inner_img h-100"> -->
                     <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4945541.406433895!2d-6.812930082618514!3d52.75357023711754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d0a98a6c1ed5df%3A0xf4e19525332d8ea8!2sEngland%2C%20UK!5e0!3m2!1sen!2s!4v1582885261968!5m2!1sen!2s" width="100%" height="346px" frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
                     <div class="map-container-lg h-lg-h">
                        <div id="map" class="w-100 h-100 mb-2"></div>
                     </div>
                  <!-- </div> -->
               </div>
            </div>
         </div>
      </section>
    </div>
    <div class="edit-btn-container pb-3">
        <div class="grey_bg_edit text-center">
            <button class="next-btn btn btn-primary">Next</button>
        </div>   
    </div>   
</div>
<!-- Step 2 -->
   <div class="scot-edit-steps second_div" style="display:none;">
      <div class="step-2">
         <section class="banner_main site_c_banner">
            <div class="site_banner pb-0 my-4" style="background:none;">
               <div class="row m-0">
                     <div class="col-md-8  pr-md-4 pl-0 wow slideInLeft pr-0 " data-wow-duration="1.5s">
                        <div class="mb-4 position-relative d-md-none">
                              <div class="position-absolute" style="bottom: 0px; left: -12px; z-index: 99;">
                              <img src="<?php echo base_url();?>assets/images/helpline.png" class="img-fluid helpline-img">
                           </div>
                           <div class="helpline position-relative py-1">
                              <span class="helpline-shape"></span>
                              <div class="mt-4 mb-4 px-5">
                                 <p class="text-center helpline-text mb-0">Prefer to get a price over the phone?</p>
                                 <p class="text-center helpline-num"><a class="num-clr" href="tel:0141-390-8967">0141-390-8967</a></p>
                              </div>
                           </div>
                        </div>
                     <div class="bg-white p-4 bg_drop">
                        <div class="banner_inner_text p-0">
                           <h3 class="mb-0"><span class="circle_icon position-change-i"></span>Quick Office Inventory</h3>
                           <p class="mb-3">Save up to a massive 42% moving through Scot Removals</p>
                        </div>
                        <div class="target_add_input rc_add ">
                                 <?php $count = 0; foreach ($products as $p) { if($count==7){break;} ?>
                                    <div class="items_counter o_category">
                                       <div class="item_catagory ">
                                             <div class="item_catagory_inner" data-id="<?=$p->id?>" id="counter_<?=$p->id?>">
                                                <p onclick="add_item_list('<?=$p->id?>')" class="products<?= $p->id?>"><span data-id="<?=$p->id?>" class="item_title "><span class="item_title<?=$p->id?>"><?=$p->name?></span></span> <span class="fa fa-plus ml-auto item_title mr-3 item_category_add<?=$p->id?>"></span></p>
                                             </div>
                                             <div class="add_counter counter_<?=$p->id?>" style="display: none;">
                                                <ul class="d-table-cell-child d-flex align-center" data-item="1" data-id="1">
                                                   <li>
                                                         <button class="fa fa-minus item_catagory_minus" onclick="subtract_qty(<?=$p->id?>)"></button>
                                                   </li>
                                                   <li>
                                                         <input class="item_catagory_value item_val_<?=$p->id?>" data-id="0" type="number" id="item_val_<?=$p->id?>" onchange="change_qty(<?=$p->id?>,this)" value="1" data-item="1">
                                                   </li>
                                                   <li>
                                                         <button class="fa fa-plus item_catagory_plus" onclick="add_qty(<?=$p->id?>)"></button>
                                                   </li>
                                                </ul>
                                             </div>
                                       </div>
                                    </div>
                                 <?php $count++; } ?>
                           </div> 
                           <div class="item_add_input mt-2">
                                 <form class="w-100" action="" method="">
                                    <input class="form-control outline-none" type="text" id="add_more"  placeholder="Add more items">
                                 </form>
                           </div>
                        </div>   
                        <div class="instance_btn w-100 flex-wrap flex-row-reverse mr-sm-2 mr-0 mt-3 d-none d-md-flex position-relative">
                           <div class="col-md-6 ml-auto px-0">
                              <button onclick="getPrices();"  class="price_btn w-100 border-0">
                                 View My Price
                              </button>
                              <div class="spinner-border position-absolute text-white button-spinner" role="status" style="display:none;right:10px;top:23%;width:1.5rem;height:1.5rem;">
                                 <span class="sr-only">Loading...</span>
                              </div>
                           </div>
                           <div class="col-md-3 px-0">
                              <a href="<?php echo base_url();?>shop/office_removal" class="back_page_btn w-100 d-flex align-items-center  text-decoration-none">
                                 <span class="position-relative d-flex align-items-center w-100"><i class="fa fa-angle-left"></i><span class="mx-auto">Back</span></span>
                              </a>
                           </div>
                        </div>                  
                     </div>
                     <div class="col-md-4  pr-0 mt-5 mt-md-0 pl-0 pl-md-3">
                        <!-- <div class="banner_inner_img h-100"> -->
                           <!-- <div id="map" class="w-100 h-100 h-lg-50"></div> -->
                        <!-- </div> -->
                        <div class="mb-4 position-relative d-none d-md-block">
                           <div class="position-absolute" style="bottom: 0px; left: -12px; z-index: 99;">
                              <img src="<?php echo base_url();?>assets/images/helpline.png" class="img-fluid helpline-img">
                           </div>
                           <div class="helpline position-relative py-1">
                              <span class="helpline-shape"></span>
                              <div class="mt-4 mb-4 px-5">
                                 <p class="text-center helpline-text mb-0">Prefer to get a price over the phone?</p>
                                 <p class="text-center helpline-num"><a class="num-clr" href="tel:0141-390-8967">0141-390-8967</a></p>
                              </div>
                           </div>
                        </div>
                        <div class="tabs_sec cart px-0 bg-white item_counter_box">
                        <div class="item_header pb-3 pt-2">
                           <h3>My Item List<span id="items_length" style="font-size:20px;"></span></h3>
                        </div>
                        <div class="counter-body select-item-list-height">
                           <div class="category_pitem">
                              <div class="items_counter first_row">
                                 <div class="item_catagory">
                                    <div class="item_catagory_inner" data-id="0">
                                       <p>Empty......</p>
                                    </div>
                                    <div class="add_counter"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="extra_services_container" style="display: none;"> 
                              <div class="py-2 item_inner_header">
                                 <span>Extra Services Items</span>
                              </div>
                              <div class="counter-body-extra-services">
                              </div>
                           </div>   
                        </div>  
                     </div>
               </div>
                  <div class="d-block d-md-none instance_btn w-100 mr-sm-2 mr-0 mt-3 position-relative">
                     <button class="price_btn w-100 border-0" id="complete_quote2" onclick="getPrices();" href="javascript:void(0);">
                        Complete My Quote
                     </button>
                     <div class="spinner-border position-absolute text-white button-spinner" role="status" style="display:none;right:10px;top:23%;width:1.5rem;height:1.5rem;">
                        <span class="sr-only">Loading...</span>
                     </div>
                  </div>    
            </div>
         </section>
      </div>
      <div class="edit-btn-container pb-3">
         <div class="grey_bg_edit text-center">
            <button class="prev-btn btn btn-primary">Prev</button>
            <button class="next-btn btn btn-primary">Next</button>
         </div>   
      </div>  
   </div>
<!-- Step 3 -->
<div class="scot-edit-steps third_div" style="display:none;">
   <div class="step-3"> 
      <section>
         <div class="container-custom mx-auto">
            <div class="row m-0">
               <div class="col-md-8 pl-0 pr-md-3 pr-0">
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
                  <div class="tabs_sec bg-none">
                     <h3 class="header-title-collapse mb-3 ">You can add extra service</h3>
                     <!-- <p class="extra-ser-text pl-1">You can add extra service on the next step</p> -->
                     <div id="accordion">
                           <?php $i = 0; if(!empty($products)){ ?>
                              <?php foreach($products as $p){ ?>
                                 <?php if($p->add_limit_check == 2){ ?>
                                       <?php if($i == 0){ ?>
                                          <h3 class="header-title-collapse-inner">Packing service</h3>
                                       <?php } ?>
                                 <?php $i++; } ?>
                                 <div class="card mb-2">
                                       <div class="card-header py-1 border-bottom-0 bg-white px-sm-custom" id="headingOne_<?=$p->id?>">
                                          <h5 class="mb-0">
                                             <button class="btn btn-link collapsed w-100 d-flex align-center text-left" data-toggle="collapse" data-target="#collapseOne_<?=$p->id?>" aria-expanded="true" aria-controls="collapseOne_<?=$p->id?>">
                                                <?=$p->name?>
                                                <span class="ml-auto collapse-icon"></span>
                                             </button>
                                          </h5>
                                       </div>
                                       <div id="collapseOne_<?=$p->id?>" class="collapse extra_services" aria-labelledby="headingOne_<?=$p->id?>" data-parent="#accordion">
                                          <div class="card-body px-sm-10">
                                             <?php if(!empty($p->sub_products)){ ?>
                                                <?php foreach($p->sub_products as $sp){ ?>
                                                   <div class="tab-content">
                                                      <div class="tab-pane bg-none target_add_input Living product_tabs active show" data-id="<?=$sp->id?>" id="living" role="tabpanel" aria-labelledby="home-tab">
                                                         <div class="items_counter border-bottom-sr">
                                                            <div class="item_catagory">
                                                               <div class="item_catagory_inner" data-id="<?=$sp->id?>" id="counter_<?=$sp->id?>">
                                                                  <p data-id="<?=$sp->id?>" class="products<?=$sp->id?>" onclick="add_item_list('<?=$sp->id?>')"><span class="item_title<?=$sp->id?>"><?=$sp->name?></span><span class="fa fa-plus ml-auto mr-3 item_category_add<?=$sp->id?>"></span></p>
                                                               </div>
                                                               <div class="add_counter counter_<?=$sp->id?>" style="display: none;">
                                                                  <ul class="d-flex align-center" data-item="1" data-id="1">
                                                                     <li>
                                                                        <button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('<?=$sp->id?>')"></button>
                                                                     </li>
                                                                     <li>
                                                                        <input class="item_catagory_value" id="item_val_<?=$sp->id?>" data-id="0" type="number" value="1" onchange="change_qty('<?=$sp->id?>')" data-item="0" />
                                                                     </li>
                                                                     <li>
                                                                        <button class="fa fa-plus item_catagory_plus" onclick="add_qty('<?=$sp->id?>')"></button>
                                                                     </li>
                                                                  </ul>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                <?php } ?>
                                             <?php } ?>
                                          </div>
                                       </div>
                                 </div>
                              <?php } ?>
                           <?php } ?>
                     </div>
                  </div>
                  <div class="comment-box w-100">
                     <h3 class="header-title-collapse-inner">Any special requirements or notes</h3>
                     <form class="w-100" action="" method="">
                           <textarea></textarea>
                     </form>
                  </div>
                  <div class="d-none d-md-block instance_btn w-100 mr-sm-2 mr-0 mt-3 position-relative">
                     <a onclick="getPrices();" href="javascript:void(0);" class="price_btn w-100">
                           Proceed to Booking
                     </a>
                     <div class="spinner-border position-absolute text-white button-spinner" role="status" style="display:none;right:10px;top:23%;width:1.5rem;height:1.5rem;">
                           <span class="sr-only">Loading...</span>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 mt-md-0 mt-4 pr-0 pl-0 pl-md-3">
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
                  <div class="tabs_sec cart px-0 pb-0 bg-white item_counter_box">
                     <div class="item_header pb-3 pt-2">
                        <h3>My Item List<span id="extra_items_length" style="font-size: 20px;"></span></h3>
                     </div>
                     <div class="counter-body">
                        <div class="items_counter first_row">
                           <div class="item_catagory_list">
                              <div class="item_catagory_inner_list" data-id="0"></div>
                           </div>
                        </div>
                     </div>
                     <div class="extra_services_container" style="display: none;"> 
                        <div class="py-2 item_inner_header">
                           <span>Extra Services Items</span>
                        </div>
                        <div class="counter-body-extra-services">
                        </div>
                     </div>
                     <div class="text-right mt-4 mb-1">
                        <button class="edit_jobs_btn py-1 px-2 bg-none border mr-2 d-flex align-items-center ml-auto border-left" onclick="edit_job()">Edit Jobs</button>
                     </div>
                  <div class="edit_jb_items px-2  align-center py-3 ">
                     <div class="d-flex flex-wrap">
                           <span class="scot-blue">Pickup Location</span>
                           <a href="javascript:void(0)" class="ml-auto" onclick="edit_location();"><img class="svg" src="<?php echo base_url();?>assets/images/edit.svg"></a>
                     </div>
                     <P class="mb-3"><?= $order->pickup_address ?></p>
                     <span class="privacy-1h">Drop Off Location</span>
                     <P class="mb-0"><?= $order->delivery_address ?></p>
                        <div class="d-flex flex-wrap border-top mt-3 mx-min-m px-2 pt-3">
                           <h6 class="mb-0">Total Price</h6>
                           <P class="mb-0 ml-auto font-bd">£<span id="t_price"><?= $price;?></span>.00</p>
                     </div>
                  </div>   
                  </div>
               </div>
               <div class="d-block d-md-none instance_btn w-100 mr-sm-2 mr-0 mt-3 position-relative">
                  <a onclick="getPrices();" href="javascript:void(0);" class="price_btn w-100">
                     Proceed to Booking
                  </a>
                  <div class="spinner-border position-absolute text-white button-spinner" role="status" style="display:none;right:10px;top:23%;width:1.5rem;height:1.5rem;">
                     <span class="sr-only">Loading...</span>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
   <div class="edit-btn-container pb-3">
      <div class="grey_bg_edit text-center">
         <button class="prev-btn btn btn-primary">Prev</button>
         <button class="next-btn btn btn-primary">Next</button>
      </div>   
   </div> 
</div>  
<!-- Step 4 -->
<div class="scot-edit-steps" style="display:none;">
   <div class="step-4"> 
   </div>
   <div class="edit-btn-container pb-3">
      <div class="grey_bg_edit text-center">
         <button class="prev-btn btn btn-primary">Prev</button>
         <button class="next-btn btn btn-primary">Next</button>
      </div>   
   </div> 
</div>  
<!-- Step 5 -->
<div class="scot-edit-steps" style="display:none;">
   <div class="step-5"> 
   </div>
   <div class="edit-btn-container pb-3">
      <div class="grey_bg_edit text-center">
         <button class="prev-btn btn btn-primary">Prev</button>
         <button class="next-btn btn btn-primary">Next</button>
      </div>   
   </div> 
</div>  
<!-- Step 6 -->
<div class="scot-edit-steps" style="display:none;">
   <div class="step-6"> 

   </div>
   <div class="edit-btn-container pb-3">
      <div class="grey_bg_edit text-center">
         <button class="next-btn btn btn-primary">Next</button>
      </div>   
   </div> 
</div>  
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&extension=.js&key=AIzaSyCAQxRGo3kiHw9CBikEzmWtzrz1Lsz88Pk"></script>
<script>
   
   $(document).on('change', '#pickup, #drop', function(){
      field_id = $(this).attr('id');
      setTimeout(function(){
         if($("#pickup").val() != "" && $("#drop").val() != ""){
            initMap($("#pickup").val(), $("#drop").val());
         }
      }, 1000);
      if(field_id=="pickup" && $('#drop').val()==""){
         $('#drop').focus();
         initMap($("#pickup").val(), $("#drop").val());
      }else if(field_id=="drop" && $('#pickup').val()==""){
         $('#pickup').focus();
         initMap($("#pickup").val(), $("#drop").val());
      }
   });
   function initMap2(pickup, drop){
      var bounds1 = new google.maps.LatLngBounds;
      var markersArray1 = [];
      var origin1 = pickup;
      var destination1 = drop;
      if(pickup == "" && drop == ""){
         origin1 = "London, UK";
         destination1 = "London, UK";
      }
   
      var destinationIcon1 = 'https://chart.googleapis.com/chart?' +
         'chst=d_map_pin_letter&chld=D|FF0000|000000';
      var originIcon1 = 'https://chart.googleapis.com/chart?' +
         'chst=d_map_pin_letter&chld=O|FFFF00|000000';
      var map1 = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 55.53, lng: 9.4},
      zoom: 10
      });
      
      var geocoder1 = new google.maps.Geocoder;
   
      var service1 = new google.maps.DistanceMatrixService;
      service1.getDistanceMatrix({
      origins: [origin1],
      destinations: [destination1],
      travelMode: 'DRIVING',
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false
      }, function(response1, status1) {
      if (status1 !== 'OK') {
         alert('Error was: ' + status1);
      } else {
         var originList1 = response1.originAddresses;
         var destinationList1 = response1.destinationAddresses;
         deleteMarkers(markersArray1);
   
         var showGeocodedAddressOnMap1 = function(asDestination1) {
         var icon1 = asDestination1 ? destinationIcon1 : originIcon1;
         return function(results1, status1) {
               if (status1 === 'OK') {
                  map1.fitBounds(bounds1.extend(results1[0].geometry.location));
                  markersArray1.push(new google.maps.Marker({
                     map: map1,
                     position: results1[0].geometry.location,
                     icon: icon1
                  }));
               } else {
                  swal({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Geocode was not successful due to: ' + status1
               });
               }
         };
         };
            for (var i = 0; i < originList1.length; i++) {
               var results1 = response1.rows[i].elements;
               geocoder1.geocode({'address': originList1[i]},
                     showGeocodedAddressOnMap1(false));
               for (var j = 0; j < results1.length; j++) {
                     geocoder1.geocode({'address': destinationList1[j]},
                        showGeocodedAddressOnMap1(true));
               }
            }
      }
      });
   }
   function initMap(pick,drop) {
         var pickup = '';
         var dropup = '';
         pickup = pick;
         dropup = drop;
         var directionsRenderer = new google.maps.DirectionsRenderer({
            //   polylineOptions: {
            //     strokeColor: "red"
            //   },
               suppressMarkers: true
            });
         var map = new google.maps.Map(document.getElementById('map'), {
            // zoom: 20,
            center: {lat: 51.5074, lng: 0.1278},
            disableDefaultUI: true,
         });
         if(pick != '' && drop != '' ){
            // alert('found');
         var directionsService = new google.maps.DirectionsService;
         directionsRenderer.setMap(map);
         calculateAndDisplayRoute(directionsService, directionsRenderer,map,pickup,dropup);
         }else{
            // alert('not fount');
            var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 51.5074, lng: 0.1278},
            disableDefaultUI: true,
            zoom : 7
         });
         }
      }
      function calculateAndDisplayRoute(directionsService, directionsRenderer,map , pick, drop) {
         var pickup = '<?php echo base_url();?>assets/images/pickup.png';
         var dropoff = '<?php echo base_url();?>assets/images/dropoff.png';
         if(pick == '' && drop == '' ){
            // pick = 'guildford';
            // drop = 'woking';
            pick = {lat: 51.3190, lng: 0.5340};
            drop = {lat: 51.2406, lng: 0.5651};
         }
         
            // for marker testing
         var icons = {
            start: new google.maps.MarkerImage( pickup),
            end: new google.maps.MarkerImage( dropoff )
            };
            // for marker testing end

         directionsService.route({
          origin: pick,  // Haight.
          destination: drop,  // Ocean Beach.
          travelMode: google.maps.TravelMode["DRIVING"],
         }, function(response, status) {
          if (status == 'OK') {
            directionsRenderer.setDirections(response);
            var leg = response.routes[ 0 ].legs[ 0 ];
            makeMarker(map, leg.start_location, icons.start, "title" );
            makeMarker(map, leg.end_location, icons.end, 'title' );
          } else {
               swal({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Geocode was not successful due to: ' + status
               });
          }
         });
         
      }
      function makeMarker(map, position, icon, title ) {
         console.log(icon);
         new google.maps.Marker({
         position: position,
         map: map,
         icon: icon,
         title: title
         });
         }
         var autocomplete;
         var autocomplete1;
         var options;
         function initializee() {
         // for google location
            options = {
            types: ['(regions)'],
            componentRestrictions: {country: "uk"}
            };
            autocomplete = new google.maps.places.Autocomplete(
               document.getElementById('pickup'),
               options,
               { types: ['geocode'] });
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
            });
            autocomplete1 = new google.maps.places.Autocomplete(
               document.getElementById('drop'),
               options,
               { types: ['geocode'] });
            google.maps.event.addListener(autocomplete1, 'place_changed', function() {
            });
         }
         $(window).ready(initializee());
   $(document).ready(function(){
      initMap($("#pickup").val(), $("#drop").val())
   });
   
   function deleteMarkers(markersArray) {
       for (var i = 0; i < markersArray.length; i++) {
           markersArray[i].setMap(null);
       }
       markersArray = [];
   }

   // ======== For next Section ====  //
   function office_order_details(){
      if($("#pickup").val()=="")
      {
         swal(
            'Empty',
            'Please enter pick up location',
            'warning'
         );
         return;
      }
      if($("#drop").val()=="")
      {
         swal(
            'Empty',
            'Please enter drop off location',
            'warning'
         );
         return;
      }
      var property1 = $("#catagory_inner2 span:first-child").attr('data-slug');
      var property2 = $("#catagory_inner3 span:first-child").attr('data-slug');
         function no_item_select(){
            swal(
            'Empty',
            'Please Select Property Size',
            'warning'
         );
         
        }
        if(property1 == ""){
           if(property1 != "ground" || property1 != "first" || property1 != "second" || property1 != "third" || property1 != "fourth"){
            no_item_select();
            return;
           }
         }else if(property2 == ""){
            if(property2 != "ground" || property2 != "first" || property2 != "second" || property2 != "third" || property2 != "fourth"){
               no_item_select();
               return;
            }
         }
         var slug1 = "ground";
         if(!$('#checkbox1').is(':checked')){
            slug1 = $("#catagory_inner2 span:first-child").attr('data-slug');
         }
         var slug2 = "ground";
         if(!$('#checkbox2').is(':checked')){
            slug2 = $("#catagory_inner3 span:first-child").attr('data-slug');
         }
         var slug = slug1+"_to_"+slug2;
        
         var pickup = $("#pickup").val();
         var drop = $("#drop").val();
         $.ajax({
            type: "GET",
            url: '<?php echo base_url('shop/save_storage'); ?>',
            dataType: 'json',
            data: {'slug': slug, 'type': "office_removal",'pickup': pickup, 'drop': drop , 'storage_id': "<?= $storage_id?>"},
            beforeSend: function() {
                  $('.button-spinner').show();
                  $('.price_btn').attr('disabled', 'disabled');
               },
            success: function(data) {
               $('.price_btn').attr('disabled', false);
               $('.button-spinner').hide();
               $('.first_div').hide();
               $('.second_div').show();
                  // window.location.href = '<?= base_url('shop/office_removal/details/');?>'+data;
            },
            error: function(data) { alert('Ajax call failed'); }
         });
      }
   // ======== For next Section End ===== //
   // ====== For Details section =======//

   let current_office_removals = [];
   var office = new Array();
   var totsl_items = 0;
   "<?php if(!empty($selected_products)){ foreach($selected_products as $product){if($product->type=="office_removals" || $product->type=="extra_services"){ ?>"
      var counter = 0;
      var append = true;
      var next = 0;
      $(".item_catagory_inner ").each(function(){
         var a = $(".item_catagory_inner").eq(next).attr("data-id");
            if(a=="<?= $product->id ?>")
            {
               append = false;
               return false;
            }
            else
            {
               append = true;
            }
            next++;
         });
         "<?php if($product->type=="office_removals"){?>"
         if(append)
         {
            $(".target_add_input").append('<div class="c_ui_add items_counter o_category'+<?= $product->id ?>+'"><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+' id="counter_' +"<?= $product->id ?>"+ '"><p><span class="item_title">' +"<?= $product->name?>"+ '</span> <span class="fa fa-plus ml-auto mr-3 item_category_add'+"<?= $product->id ?>"+'"></span></p></div><div class="add_counter counter_' +"<?= $product->id ?>"+ '" style="display: none;"><ul class="d-table-cell-child" data-item="1" data-id="<?= $product->id ?>"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+"<?= $product->id ?>"+')"></button></li><li><input onchange="change_qty(<?= $product->id ?>,this)" class="item_catagory_value" type="text" id="item_val_'+"<?= $product->id ?>"+'" data-id="0" value="'+"<?= $product->quantity?>"+'" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+"<?= $product->id ?>"+')"></button></li></ul></div></div></div><input type="hidden" id="tab<?= $product->id ?>" value="<?= $product->tab ?>"><input type="hidden" id="type<?= $product->id ?>" value="<?= $product->type ?>">');
         }
         "<?php } ?>"
         $('.items_counter.first_row').hide();
         <?php if($product->type=="extra_services" && $product->tab==$order->order_type){ ?>
            totsl_items += parseInt("<?= $product->quantity?>");
            $(".extra_services_container").css("display", "block");
            $(".counter-body-extra-services").append('<div class="items_counter items_counter_list'+"<?= $product->id ?>"+' all_items mb-1px" data-id='+"<?= $product->id ?>"+' ><div class="item_catagory"><div class="item_catagory_inner"><p class="item_name'+"<?= $product->id ?>"+'" >'+"<?= $product->name?>"+'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+"<?= $product->id ?>"+')"></button></li><li class="h-100 d-flex align-center"><input class="item_catagory_value'+"<?= $product->id ?>"+'" type="number" value="'+"<?= $product->quantity?>"+'" onchange="change_qty(<?= $product->id?>,this)" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+"<?= $product->id ?>"+')"></button></li></ul></div></div></div><input type="hidden" id="tab<?= $product->id ?>" value="<?= $product->tab ?>"><input type="hidden" id="type<?= $product->id ?>" value="<?= $product->type ?>">');
         <?php } elseif($product->type!="extra_services"){?>
            totsl_items += parseInt("<?= $product->quantity?>");
            $(".counter-body .category_pitem").append('<div class="items_counter items_counter_list'+"<?= $product->id ?>"+' all_items mb-1px" data-id='+"<?= $product->id ?>"+' ><div class="item_catagory"><div class="item_catagory_inner"><p class="item_name'+"<?= $product->id ?>"+'" >'+"<?= $product->name?>"+'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+"<?= $product->id ?>"+')"></button></li><li class="h-100 d-flex align-center"><input class="item_catagory_value'+"<?= $product->id ?>"+'" type="number" value="'+"<?= $product->quantity?>"+'" onchange="change_qty(<?= $product->id?>,this)" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+"<?= $product->id ?>"+')"></button></li></ul></div></div></div><input type="hidden" id="tab<?= $product->id ?>" value="<?= $product->tab ?>"><input type="hidden" id="type<?= $product->id ?>" value="<?= $product->type ?>">');
         <?php } ?>
            $(".counter_"+"<?= $product->id ?>").css("display","block");
            $(".item_category_add"+"<?= $product->id ?>").css("display","none");
            $("#item_val_"+"<?= $product->id ?>").val("<?= $product->quantity?>");
            $(".products"+"<?= $product->id ?>").removeAttr('onclick');
            $("#item_val_"+"<?= $product->id ?>").attr('data-id',1);
            counter++;
      "<?php }}} ?>"
      $('#items_length').text(" ("+totsl_items+")"); 

      // auto complete  Start// 
   $( "#add_more" ).autocomplete({
      source: 
      function(request, response){
         $.ajax({
            type: "GET",
            url: '<?php echo base_url('shop/search_product'); ?>',
            dataType: 'json',
            data: {'search_product': request.term, "product_type": "office_removals", "type":"product"},
            success: function( data ) {
               response( $.map( data, function( item ) {
                  return {
                     label: item.name,
                     id: item.id,  
                  }
               }));  
   
            }
            
         });
      },
      select: function( event, ui ) {
         add_product(ui.item.label,ui.item.id);
            return false;
         }  
   });
   // auto complete  End// 
   function add_product(product,id)
   { 
      var next = 0;
      var append = false;
      $(".item_catagory_inner ").each(function(){
      var a = $(".item_catagory_inner").eq(next).attr("data-id");
       if(a==id)
       {
          append = false;
          return false;
       }
       else
       {
          append = true;
       }
       next++;
   });
   if(append)
   {
      $('.items_counter.first_row').hide();
      $(".target_add_input").append('<div class="c_ui_add items_counter o_category'+id+'"><div class="item_catagory"><div class="item_catagory_inner" data-id="'+id+'" id="counter_' + id + '"><p><span class="item_title'+id+'">' + product + '</span> <span class="fa fa-plus ml-auto mr-3 item_category_add"></span></p></div><div class="add_counter counter_' + id + '" style="display: none;"><ul class="d-table-cell-child" data-item="1" data-id="'+id+'"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+id+')"></button></li><li><input onchange="change_qty('+id+',this)" class="item_catagory_value" type="text" id="item_val_'+id+'" data-id="0" value="1" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+id+')"></button></li></ul></div></div></div><input type="hidden" id="tab'+id+'" value="null"><input type="hidden" id="type'+id+'" value="office_removals"><input type="hidden" id="tab'+id+'" value="null"><input type="hidden" id="type'+id+'" value="office_removals">'); 
      $(".counter-body .category_pitem").append('<div class="items_counter_list'+id+' items_counter all_items mb-1px" data-id='+id+' ><div class="item_catagory"><div class="item_catagory_inner"><p class="item_name'+id+'" >'+ product +'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+id+')"></button></li><li class="h-100 d-flex align-center"><input class="item_catagory_value'+id+'" type="number" value="'+1+'" onchange="change_qty('+id+',this)" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+id+')"></button></li></ul></div></div></div><input type="hidden" id="tab'+id+'" value="null"><input type="hidden" id="type'+id+'" value="office_removals">');
      $('.c_ui_add .item_category_add.fa-plus').click();
      $("#add_more").val("");  
      $(".products_list").remove();
      $("#item_val_"+id).attr('data-id',1);
      
      update_items();
   }
   else
   {
      $("#add_more").val("");  
       $(".products_list").remove();
      
       $(".counter_"+id).css("display","block");
       $(".item_category_add"+id).css("display","none");
        var data_id =  $("#item_val_"+id).attr('data-id');
        if(data_id !=0)
        {
       var value = $("#item_val_"+id).val();
       value++;
       $("#item_val_"+id).val(value);
       $(".item_val_"+id).val(value);
        }
        else
        {
            $("#item_val_"+id).attr('data-id',1);
        }
       add_item_list(id)
   }
}
function check_items_forempty(){
   var item_lle = $('.counter-body .items_counter').length;
   if(item_lle<=1){
      $('.items_counter.first_row').show();
   }
}
function add_item_list(id)
   {
    item_name = $(".item_title"+id).text();
      var next= 0;
      var append = true;
      $(".items_counter_list"+id).each(function(){
      var itme_id = $(".items_counter_list"+id).eq(next).attr("data-id");
       if(itme_id==id)
       {
          append = false;
          return false;
       }
       else
       {
          append = true;
       }
       next++;
   });
   if(append){
      $("#item_val_"+id).val(1);
      $('.items_counter.first_row').hide();
      $(".counter-body .category_pitem").append('<div class="items_counter_list'+id+' items_counter all_items mb-1px" data-id='+id+' ><div class="item_catagory"><div class="item_catagory_inner"><p class="item_name'+id+'">'+ item_name +'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+id+')"></button></li><li class="h-100 d-flex align-center"><input class="item_catagory_value'+id+'" type="number" value="1" onchange="change_qty('+id+',this)" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+id+')"></button></li></ul></div></div></div><input type="hidden" id="tab'+id+'" value="null"><input type="hidden" id="type'+id+'" value="office_removals">');
      $(".products"+id).removeAttr('onclick');
      update_items();
      }
      else{
         var cuerrent_items = 0;
         var name = $(".item_name"+id).text()
      var count = parseInt($(".item_catagory_value"+id).val())+1 ;
      $(".item_catagory_value"+id).val(count);
      $.each(current_office_removals , function(index,value){
            if(current_office_removals[cuerrent_items].id==id)
            {
               current_office_removals.splice(cuerrent_items,1);
               return false;
            }
            cuerrent_items++;
         });
         update_items();
      }
   }
   function subtract_qty(id)
   {
      var next= 0;
      var cuerrent_items = 0;
      var data_id = true;
      var name = $(".item_name"+id).text();
      var type = $("#type"+id).val();
      var tab = $("#tab"+id).val();
      if($(".item_catagory_value"+id).val()<=1)
      {
         $(".o_category"+id).remove();
       $(".items_counter_list"+id).remove();
       $(".products"+id).attr("onclick","add_item_list("+id+")");
       $(".counter_"+id).removeClass('d-block');
       $(".counter_"+id).css("display","none");
        $(".item_category_add"+id).css("display","flex");
        $(".item_category_add"+id).addClass("fa-plus");
        $(".item_catagory_inner ").each(function(){
            var a = $(".item_catagory_inner").eq(next).attr("data-id");
            if(a==id)
            {
               data_id = false;
               return false;
            }
            else
            {
               data_id = true;
            }
            next++;
         });
         if(data_id)
         {
         }
         else
         {
            $("#item_val_"+id).attr('data-id',0);
         }
      }
      else
      {
         var qty = parseInt($(".item_catagory_value"+id).val())-1 ;
         $(".item_catagory_value"+id).val(qty);
         $("#item_val_"+id).val(qty)
      } 
      $.each(current_office_removals , function(index,value){
            if(current_office_removals[cuerrent_items].id==id)
            {
               current_office_removals.splice(cuerrent_items,1);
               return false;
            }
            cuerrent_items++;
         });
         if(qty>0)
         {
         }   
        update_items();
        check_items_forempty();
   }
   function change_qty(id,e)
   {
      var next= 0;
      var data_id = true;
      var quantity = $(e).val();
      var type = $("#type"+id).val();
      var tab = $("#tab"+id).val();
      var cuerrent_items = 0;
      if(quantity<=0)
      {
         $(".o_category"+id).remove();
       $(".items_counter_list"+id).remove();
       $(".products"+id).attr("onclick","add_item_list("+id+")");
       $(".counter_"+id).removeClass('d-block');
       $(".counter_"+id).css("display","none");
         $(".item_category_add"+id).css("display","flex");
         $(".item_category_add"+id).addClass("fa-plus");
         $(".item_catagory_inner ").each(function(){
            var a = $(".item_catagory_inner").eq(next).attr("data-id");
            if(a==id)
            {
               data_id = false;
               return false;
            }
            else
            {
               data_id = true;
            }
            next++;
         });
         if(data_id)
         {
         }
         else
         {
            $("#item_val_"+id).attr('data-id',0);
         }
      }
      $(".item_catagory_value"+id).val(quantity);
      $("#item_val_"+id).val(quantity)
      var name = $(".item_name"+id).text();
      $.each(current_office_removals , function(index,value){
            if(current_office_removals[cuerrent_items].id==id)
            {
               current_office_removals.splice(cuerrent_items,1);
               return false;
            }
            cuerrent_items++;
         });
         if(quantity>0)
         {
         }
        update_items();
        check_items_forempty();
   }
function add_qty(id)
   {
     var cuerrent_items = 0;
     var name = $(".item_name"+id).text();
     var type = $("#type"+id).val();
     var tab = $("#tab"+id).val();
     $(".item_catagory_value"+id).val(parseInt($(".item_catagory_value"+id).val())+1);
     $("#item_val_"+id).val($(".item_catagory_value"+id).val());
     $.each(current_office_removals , function(index,value){
            if(current_office_removals[cuerrent_items].id==id)
            {
               current_office_removals.splice(cuerrent_items,1);
               return false;
            }
            cuerrent_items++;
         });
     
      update_items();
   }
   function update_items()
   {
      let ids = [];
      let qtys = [];
      let office = [];
      var i = 0;
      var next = 0;
      var total_items = 0;
      var extra_services = true;
      $(".all_items").each(function(){
        var product_id  =  $(".all_items").eq(next).attr('data-id');
        var producd_name = $(".item_name"+product_id).text();
        var product_qty =  $(".item_catagory_value"+product_id).val();
        var type =  $("#type"+product_id).val();
        var tab =  $("#tab"+product_id).val();
		if(product_qty > 0){
			ids.push(product_id);
            qtys.push(product_qty);
		}
      if(type=="extra_services")
         {
            extra_services = false;
         }
        office_obj = {"name":producd_name , "id":product_id , "quantity":product_qty, "tab": tab, "type":type};
        office.push(office_obj);
        total_items += parseInt(product_qty);
        next++;
      });
      
         if(extra_services==true)
         {
            $(".extra_services_container").css("display","none");
         }
         $('#items_length').text(" ("+total_items+")");
         $.ajax({
            type: "GET",
            url: '<?php echo base_url('shop/update_items_tdb'); ?>',
            dataType: 'json',
            data: {'items' : office},
            success:function(data)
            {
               return;
            }
        });
   }
   function getPrices(){
      var main = $(".target_add_input");
      var slug = "<?=$slug?>";
      alert(slug);
      var sub = $(main).find('.items_counter');
      let ids = [];
      let qtys = [];
      let office = [];
      var i = 0;
      var next = 0;
      var check_item = false;
      localStorage.setItem('type', "office");
      $(".all_items ").each(function(){
         var product_id  =  $(".all_items").eq(next).attr('data-id');
         var producd_name = $(".item_name"+product_id).text();
         var product_qty =  $(".item_catagory_value"+product_id).val();
         var type =  $("#type"+product_id).val();
         var tab =  $("#tab"+product_id).val();
         if(type=="office_removals")
         {
            check_item=true;
         }
         if(product_qty > 0){
            ids.push(product_id);
               qtys.push(product_qty);
         }
         office_obj = {"name":producd_name , "id":product_id , "quantity":product_qty, "tab": tab, "type":type};
         office.push(office_obj);
         next++;
         });
         if(ids=="" || check_item==false)
         {
            swal({
                  icon: "warning",
                  closeOnClickOutside: false,
                  title: 'No Item Select',
                  text: 'Please Select Item',
            });
            return; 
         }
         $.ajax({
            type: "GET",
            url: '<?php echo base_url('shop/getPrices'); ?>',
            dataType: 'json',
            data: {'id': ids, 'qty': qtys, 'slug': slug, 'type': "office_removal"},
                  beforeSend: function() {
                     $('.button-spinner').show();
                     $('.price_btn').attr('disabled', 'disabled');
                  },
                  success: function(data) {
                     $('.price_btn').attr('disabled', false);
                     if(data[0] != null){
                     // alert(data[0].price);
                     var service = new google.maps.DistanceMatrixService;
                     service.getDistanceMatrix({
                     origins: ['<?=$order->pickup_address?>'],
                     destinations: ['<?=$order->delivery_address?>'],
                     travelMode: 'DRIVING',
                     unitSystem: google.maps.UnitSystem.METRIC,
                     avoidHighways: false,
                     avoidTolls: false
                     }, function(response, status) {
                     if (status !== 'OK') {
                     alert('Error was: ' + status);
                     } else {
                        var originList = response.originAddresses;
                        var destinationList = response.destinationAddresses;
                        var price = 0;
                        var km = 0;
                        var amount = 0;
                        for (var i = 0; i < originList.length; i++) {
                           var results = response.rows[i].elements;
                           for (var j = 0; j < results.length; j++) {
                                 var kilometers = results[j].distance.text;
                                 kilometers = kilometers.replace(' km', '');
                                 price = parseFloat(data[0].price);
                                 km = parseFloat(kilometers)*0.621371;
                                 km = parseFloat(km)*0.80;
                                 amount = parseFloat(km) + parseFloat(data[0].price);
                                 localStorage.setItem('price',amount);
                              }
                        }
                        $.ajax({
                              type: "GET",
                              url: '<?php echo base_url('shop/save_storage'); ?>',
                              dataType: 'json',
                              data: {'slug': '<?= !empty($order) ? $order->slug : '' ?>', 'type': "office_removal", 'pickup': '<?= !empty($order) ? $order->pickup_address : '' ?>', 'drop': '<?= !empty($order) ? $order->delivery_address : '' ?>' , 'storage_id': '<?= !empty($order) ? $order->id : '' ?>', 'price': price, 'km': km, 'total': amount , 'items' : office},
                              success:function(data)
                              {
                                 $('.button-spinner').hide();
                                 $('.second_div').hide();
                                 $('.third_div').show();
                                 // window.location.href = '<?= base_url('shop/extra_services/');?>'+data;
                              }
                           });
                        }
                        });
                     }else{
                        alert(data[0].label);
                     }
                  },
                  error: function(data) { alert('Ajax call failed 2'); }
               });
            }
   // ===== Details Section end =======//

   // ===== Extra Services ====//
   let current_house_removals = [];
   let new_current_house_removals = [];
   totsl_items = 0;
   " <?php if(!empty($selected_products)){ foreach($selected_products as $product){ ?>"
    counter = 0;
    "<?php if($product->type!="extra_services"){ ?>"
       $(".tabs_sec .counter-body").append('<div class="items_counter item_list list_counter_right'+<?= $product->id ?>+' item_row'+<?= $product->id ?>+' mb-1px" data-id='+"<?= $product->id ?>"+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+'><p class="item_name'+"<?= $product->id ?>"+'" data-id = "data-id='+"<?= $product->id ?>"+'">'+ "<?= $product->name ?>" +'</p><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input class="item_catagory_value<?= $product->id?>" readonly type="number" value="<?= $product->quantity?>" onchange="change_qty(<?= $product->id?>)" data-item="<?= $product->id?>"></li></ul></div></div></div></div><input type="hidden" class="type_'+<?= $product->id ?>+'" value="<?= $product->type ?>"><input type="hidden" class="tab_'+<?= $product->id ?>+'" value="<?= $product->tab ?>">');
    "<?php }else{ ?>" 
        $(".extra_services_container").css("display","block");
        $(".counter-body-extra-services").append('<div class="items_counter item_list list_counter_right'+<?= $product->id ?>+' item_row'+<?= $product->id ?>+' mb-1px" data-id='+"<?= $product->id ?>"+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+'><p class="item_name'+"<?= $product->id ?>"+'" data-id = "data-id='+"<?= $product->id ?>"+'">'+ "<?= $product->name ?>" +'</p><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input class="item_catagory_value<?= $product->id?>" readonly type="number" value="<?= $product->quantity?>" onchange="change_qty(<?= $product->id?>)" data-item="<?= $product->id?>"></li></ul></div></div></div></div><input type="hidden" class="type_'+<?= $product->id ?>+'" value="<?= $product->type ?>"><input type="hidden" class="tab_'+<?= $product->id ?>+'" value="<?= $product->tab ?>">');
    "<?php } ?>"       
       $(".counter_"+"<?= $product->id ?>").css("display","block");
            $(".item_category_add"+"<?= $product->id ?>").css("display","none");
            $("#item_val_"+"<?= $product->id ?>").val("<?= $product->quantity ?>");
            $(".products"+"<?= $product->id ?>").removeAttr('onclick');
            $("#item_val_"+"<?= $product->id ?>").attr('data-id',1);
            counter++;
         totsl_items += parseInt("<?= $product->quantity ?>");
     " <?php }} ?>"
         $('#extra_items_length').text(" ("+totsl_items+")");
   // ===== Extra Services End ==//

   $(document).ready(function(){
      $('.next-btn').click(function(){
         $(this).parent().parent().parent().hide()
         $(this).parent().parent().parent().next().show();
      });
      $('.prev-btn').click(function(){
         $(this).parent().parent().parent().hide()
         $(this).parent().parent().parent().prev().show();
      });
   });
</script>