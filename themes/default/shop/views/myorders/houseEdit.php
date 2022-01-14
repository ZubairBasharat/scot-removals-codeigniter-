<?php defined('BASEPATH') OR exit('No direct script access allowed');
   $last = $this->uri->segment(3);
   $storage_id = !empty($storage) ? $storage->id : 0;
   $selected_products = !empty($order) ? json_decode($order->products_list) : array();

   if(null != $this->session->userdata('house_removal_slug')){
         $slug = $this->session->userdata('house_removal_slug');
         $type = $this->session->userdata('house_removal_type');
   }else{
      $slug = "ground_to_ground";
      $type = "house_removal";
   }
?>
<!-- Below style is for Calendar -->
<style>
   .fc-event-container .fc-title{
      color:#0065bd;
      font-size:18px;
   }
   .fc-ltr .fc-dayGrid-view .fc-day-top .fc-day-number {
      color:rgba(0,0,0,.5);
      margin-left: 10px;
      font-weight: 600;
   }
   tr:first-child>td>.fc-day-grid-event{
      position:absolute;
      left:10px;
      top:10px;
   }
   .fc-event-container{
      position:relative;
   }
   .fc-content{ background: transparent;
      color: white;
      font-weight: bold;
      height: 25px;
      padding-top: 5px;text-align: center; 
   }
   /* tr td.fc-day:hover{
      background:#fcf8e3;
   } */
   .fc-day:hover{
      background:#fcf8e3;
      cursor: pointer;
   }
   .fc-slats, 
   .fc-content-skeleton, 
   .fc-bgevent-skeleton{
      pointer-events:none;
   }
   .fc-bgevent,
   .fc-event-container{
      pointer-events:auto;
   }
   .fc-event:hover {
   border-color: #1c7d87;
   }
   .fc-event:hover .fc-content {
   color: #1c7d87;
   /* background:#fcf8e3; */
   cursor: pointer;
   }
   .fc-scroller.fc-day-grid-container{
      min-height:100px !important;
      height:auto !important;
   }
   #time-range p {
      font-family:"Arial", sans-serif;
      font-size:14px;
      color:#333;
   }
   .ui-slider-horizontal {
      height: 8px;
      background: #D7D7D7;
      border: 1px solid #BABABA;
      box-shadow: 0 1px 0 #FFF, 0 1px 0 #CFCFCF inset;
      clear: both;
      margin: 8px 0;
      -webkit-border-radius: 6px;
      -moz-border-radius: 6px;
      -ms-border-radius: 6px;
      -o-border-radius: 6px;
      border-radius: 6px;
   }
   .ui-slider {
      position: relative;
      text-align: left;
   }
   .ui-slider-horizontal .ui-slider-range {
      top: -1px;
      height: 100%;
   }
   .ui-slider .ui-slider-range {
      position: absolute;
      z-index: 1;
      height: 8px;
      font-size: .7em;
      display: block;
      border: 1px solid #0065bd;
      box-shadow: 0 1px 0 #0065bd inset;
      -moz-border-radius: 6px;
      -webkit-border-radius: 6px;
      -khtml-border-radius: 6px;
      border-radius: 6px;
      background: #0065bd;
   }
   .ui-slider .ui-slider-handle {
      border-radius: 50%;
      background: #F9FBFA;
      background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgi…pZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiIC8+PC9zdmc+IA==');
      background-size: 100%;
      background-image: -webkit-gradient(linear, 50% 0, 50% 100%, color-stop(0%, #C7CED6), color-stop(100%, #F9FBFA));
      background-image: -webkit-linear-gradient(top, #C7CED6, #F9FBFA);
      background-image: -moz-linear-gradient(top, #C7CED6, #F9FBFA);
      background-image: -o-linear-gradient(top, #C7CED6, #F9FBFA);
      background-image: linear-gradient(top, #C7CED6, #F9FBFA);
      width: 22px;
      height: 22px;
      -webkit-box-shadow: 0 2px 3px -1px rgba(0, 0, 0, 0.6), 0 -1px 0 1px rgba(0, 0, 0, 0.15) inset, 0 1px 0 1px rgba(255, 255, 255, 0.9) inset;
      -moz-box-shadow: 0 2px 3px -1px rgba(0, 0, 0, 0.6), 0 -1px 0 1px rgba(0, 0, 0, 0.15) inset, 0 1px 0 1px rgba(255, 255, 255, 0.9) inset;
      box-shadow: 0 2px 3px -1px rgba(0, 0, 0, 0.6), 0 -1px 0 1px rgba(0, 0, 0, 0.15) inset, 0 1px 0 1px rgba(255, 255, 255, 0.9) inset;
      -webkit-transition: box-shadow .3s;
      -moz-transition: box-shadow .3s;
      -o-transition: box-shadow .3s;
      transition: box-shadow .3s;
      outline:none !important;
   }
   .ui-slider .ui-slider-handle {
      position: absolute;
      z-index: 2;
      width: 22px;
      height: 22px;
      cursor: default;
      border: none;
      cursor: pointer;
   }
   .ui-slider .ui-slider-handle:after {
      content:"";
      position: absolute;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      top: 50%;
      margin-top: -4px;
      left: 50%;
      margin-left: -4px;
      background: #0065bd;
      -webkit-box-shadow: 0 1px 1px 1px rgba(22, 73, 163, 0.7) inset, 0 1px 0 0 #FFF;
      -moz-box-shadow: 0 1px 1px 1px rgba(22, 73, 163, 0.7) inset, 0 1px 0 0 white;
      box-shadow: 0 1px 1px 1px rgba(22, 73, 163, 0.7) inset, 0 1px 0 0 #FFF;
   }
   .ui-slider-horizontal .ui-slider-handle {
      top: -.5em;
      margin-left: -.6em;
   }
   .ui-slider a:focus {
      outline:none;
   }

   #slider-range {
   margin: 0 auto;
   }
</style>
<script>

$(document).ready(function(){
   $('.ui-slider-handle').draggable();
   $("#slider-range").slider({
    range: true,
    min: 0,
    max: 1440,
    step: 15,
    values: [540, 660],
    slide: function (e, ui) {
        var hours1 = Math.floor(ui.values[0] / 60);
        var minutes1 = ui.values[0] - (hours1 * 60);
        if(ui.values[1] - ui.values[0] < 120){
          return false;
         }
        if (hours1.length == 1) hours1 = '0' + hours1;
        if (minutes1.length == 1) minutes1 = '0' + minutes1;
        if (minutes1 == 0) minutes1 = '00';
        if (hours1 >= 12) {
            if (hours1 == 12) {
                hours1 = hours1;
                minutes1 = minutes1 + " PM";
            } else {
                hours1 = hours1 - 12;
                minutes1 = minutes1 + " PM";
            }
        } else {
            hours1 = hours1;
            minutes1 = minutes1 + " AM";
        }
        if (hours1 == 0) {
            hours1 = 12;
            minutes1 = minutes1;
        }
        $('.slider-time').html(hours1 + ':' + minutes1);
        $("#strt_time").val(hours1 + ':' + minutes1);
        var hours2 = Math.floor(ui.values[1] / 60);
        var minutes2 = ui.values[1] - (hours2 * 60);

        if (hours2.length == 1) hours2 = '0' + hours2;
        if (minutes2.length == 1) minutes2 = '0' + minutes2;
        if (minutes2 == 0) minutes2 = '00';
        if (hours2 >= 12) {
            if (hours2 == 12) {
                hours2 = hours2;
                minutes2 = minutes2 + " PM";
            } else if (hours2 == 24) {
                hours2 = 11;
                minutes2 = "59 PM";
            } else {
                hours2 = hours2 - 12;
                minutes2 = minutes2 + " PM";
            }
        } else {
            hours2 = hours2;
            minutes2 = minutes2 + " AM";
        }

        $('.slider-time2').html(hours2 + ':' + minutes2);
        $("#end_time").val(hours2 + ':' + minutes2);
    }
});

});
</script>
<link href='<?= $assets ?>calendar/main.min.css' rel='stylesheet' />
<script src='<?= $assets ?>calendar/main.min.js'></script>
<script src='<?= $assets ?>calendar/interaction.min.js'></script>
<script src='<?= $assets ?>calendar/daygrid.min.js'></script>
<!-- Step 1 -->
<div class="scot-edit-steps first_div">
<div class="step-1">
<!-- Banner Section Start -->
<section class="banner_main site_c_banner" style="padding-bottom:20px !important;">
   <div class="site_banner p-0" style="background:none;">
      <div class="row m-0">
         <div class="col-lg-8 col-md-6 pr-md-4 pl-0 wow slideInLeft pr-0" data-wow-duration="1.5s">
            <div class="bg-white p-xl-5 p-3 bg_drop px-sm-10">
               <div class="banner_inner_text p-0">
                  <h3 class="mb-3"><span class="circle_icon "></span>Saving you money and time <span class="scot-red">Moving house is easy now</span></h3>
                  <!-- <p class="mb-3">Save up to a massive 42% moving through Scot Removals</p> -->
               </div>
               <div class="banner_inner_form m-0">
                  <form class="row w-100 m-0">
                     <div class="col-lg-6  pr-0 pl-0">
                        <!-- Dropdown 1 Start -->
                        <div class="w-100 main_drop_aria dop">
                           <div class="col-12 pr-0 pl-0">
                              <div class="user-input-wrp d-flex  location_area mt-1 flex-wrap">
                                 <input type="text" class="form_input w-100" placeholder="" value="<?php if(!empty($order)){ echo $order->pickup_address;}?>" required id="pickup">
                                 <span class="floating-label">Pick Up Location</span>
                              </div>
                           </div>
                           <div class="form_input drop_btn"  id="catagory1">
                              <span class="btn_selected_text" data-id="0" data-slug="">Select Property Size</span>
                              <span class="fa fa-angle-down float-right mr-3 toggle_icon"></span>
                           </div>
                           <div class="dropdown_list">
                              <div class="dropdown_content inc_width catagory1">
                                 <div class="row m-0 text-center content_list_view">
                                    <?php foreach ($products_categories as $c) { ?>
                                    <div class="col-sm-4 content_col ">
                                       <!-- <img src="<?php echo base_url();?>assets/images/home2.svg"> -->
                                       <img src="<?php echo base_url();?>assets/uploads/<?=$c->category_image?>" style="width: 57px; height: 45px;" >
                                       <ul class="p-0 mt-3 content_detail_list">
                                          <?php if(!empty($c->properties)){ foreach ($c->properties as $p) { ?>
                                          <li class="<?php if($p->lift_option == "Yes"){echo 'open_inner_dropdown';}else{echo 'not_open_dropdown';} ?>">
                                             <span data-id="5" data-slug="<?=$p->slug?>"><?=$p->name?></span>
                                          </li>
                                          <?php } } ?>
                                       </ul>
                                    </div>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Dropdown 1 End -->
                        <!-- inner_Dropdown 1 Start -->
                        <div class="w-100 main_drop_aria dop4" id="open_drop_li_click" style="display:none;">
                           <div class="form_input drop_btn" id="catagory_inner2">
                              <span class="btn_selected_text text-capitalize" data-slug="ground">Ground Floor</span>
                              <span class="fa fa-angle-down float-right mr-3 toggle_icon"></span>
                           </div>
                           <div class="dropdown_list">
                              <div class="dropdown_content catagory_inner2">
                                 <div class="row m-0 text-center content_list_view">
                                    <div class="col-12 content_col ">
                                       <h3><span  class=""><img class="svg" src="<?php echo base_url();?>assets/images/home2.svg"></span></h3>
                                       <ul class="p-0 mt-3 content_detail_list">
                                          <?php foreach ($floors as $f) { ?>
                                          <li <?php if($f->lift_option == 1){echo "class='open_checkbox1'";} ?>>
                                             <span data-id="<?=$f->id?>" data-slug="<?=$f->slug?>" ><?=$f->name?></span>
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
                     <div class="col-lg-6  pl-0 pr-0 pl-lg-2">
                        <!-- Dropdown Start 2-->
                        <div class="w-100 main_drop_aria dop2 ">
                           <div class="col-12 pr-0 pl-0">
                              <div class="user-input-wrp d-flex  location_area mt-1 flex-wrap">
                                 <input type="text" class="form_input w-100" placeholder="" value="<?php if(!empty($order)){ echo $order->delivery_address;}?>"  id="drop" required>
                                 <span class="floating-label">Drop Off Location</span>
                              </div>
                           </div>
                           <div class="form_input drop_btn"  id="catagory3">
                              <span class="btn_selected_text" data-id="0" data-slug="">Select Property Size</span>
                              <span class="fa fa-angle-down float-right mr-3 toggle_icon"></span>
                           </div>
                           <div class="dropdown_list">
                              <div class="dropdown_content inc_width catagory3">
                                 <div class="row m-0 text-center content_list_view">
                                    <?php foreach ($products_categories as $c) { ?>
                                    <div class="col-sm-4 content_col">
                                       <!-- <img src="<?php echo base_url();?>assets/images/home2.svg"> -->
                                       <img src="<?php echo base_url();?>assets/uploads/<?=$c->category_image?>" style="width: 57px; height: 45px;" >
                                       <ul class="p-0 mt-3 content_detail_list">
                                          <?php if(!empty($c->properties)){ foreach ($c->properties as $p) { ?>
                                          <li class="<?php if($p->lift_option == "Yes"){echo 'open_inner_dropdown2';}else{echo 'not_open_dropdown2';} ?>">
                                             <span data-id="5" data-slug="<?=$p->slug?>"><?=$p->name?></span>
                                          </li>
                                          <?php } } ?>
                                       </ul>
                                    </div>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Dropdown 2 End -->
                        <!-- Inner_Dropdown2 Start -->
                        <div class="w-100 main_drop_aria dop3" id="open_drop_li_click2" style="display:none;">
                           <div class="form_input drop_btn" id="catagory_inner3">
                              <span class="btn_selected_text text-capitalize" data-slug="ground">Ground Floor</span>
                              <span class="fa fa-angle-down float-right mr-3 toggle_icon"></span>
                           </div>
                           <div class="dropdown_list">
                              <div class="dropdown_content catagory_inner3">
                                 <div class="row m-0 text-center content_list_view">
                                    <div class="col-12 content_col ">
                                       <h3><span  class=""><img class="svg" src="<?php echo base_url();?>assets/images/home2.svg"></span></h3>
                                       <ul class="p-0 mt-3 content_detail_list">
                                          <?php foreach ($floors as $f) { ?>
                                          <li <?php if($f->lift_option == 1){echo "class='open_checkbox2'";} ?>>
                                             <span data-id="<?=$f->id?>" data-slug="<?=$f->slug?>"><?=$f->name?></span>
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
                        <button class="price_btn w-100 border-0 text-capitalize mb-2" type="button" id="complete_quote"  onclick="house_order_details()">
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
            <div class="map-container">
               <div id="map" class="w-100 h-100 h-lg-50"></div>
            </div>   
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
   <section class="banner_main px-0">
      <div class="container-custom mx-auto">
            <div class="row m-0">
               <div class="col-lg-8 pl-0 pr-lg-3 pr-0">
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
                  <div class="tabs_sec mb-3 d-md-block d-none">
                     <ul class="nav nav-tabs product-btn-tab border-0" id="myTab" role="tablist">
                        <?php $i = 0; foreach ($products as $p) { 
                           // print_r($p);die;
                           ?>
                        <li class="nav-item">
                           <a class="nav-link text-center <?=$p->name?>  tabs" data-name="<?=$p->name?>" onclick="switch_tab()" id="home-tab" data-toggle="tab" href="#<?=str_replace('&', '', str_replace(' ', '', strtolower($p->name)))?>" role="tab" aria-controls="home" <?php if($i == 0){ echo 'aria-selected="true"'; }else{ echo 'aria-selected="false"'; } ?> >
                              <img class="svg" src="<?php echo base_url('assets/uploads'); ?>/<?=$p->image?>">
                              <p class="mb-0 "><?=$p->name?>
                              </p>
                           </a>
                        </li>
                        <?php $i++; } ?>
                     </ul>
                  </div>   
                  <div class="tabs_sec bg-none d-md-block d-none">
                     <div class="tab-content" id="myTabContent">
                        <?php $i = 0; foreach ($products as $p) { ?>
                        <div class="tab-pane bg-none target_add_input <?=$p->name?> product_tabs" data-id="<?= $p->id ?>" id="<?=str_replace('&', '', str_replace(' ', '', strtolower($p->name)))?>" role="tabpanel" <?php if($i == 0){ echo 'aria-labelledby="home-tab"'; }else{ echo 'aria-labelledby="contact-tab"'; } ?> >
                           <?php $i++; if(!empty($p->sub_products)){$count = 0;foreach ($p->sub_products as $sp) {if($count==7){break;}?>
                           <div class="items_counter border-bottom-sr">
                              <div class="item_catagory">
                                 <div class="item_catagory_inner" data-id="<?php echo $sp->id ?>" id="counter_<?=$sp->id?>">
                                    <p data-id="<?=$sp->id?>" class="products<?=$sp->id?>" onclick="add_item_list('<?=$sp->id?>')"><span id="item_title<?=$sp->id?>" class="item_title<?=$sp->id?>"><?=$sp->name?></span><span  class="fa fa-plus ml-auto mr-3 item_category_add<?=$sp->id?>"></span></p>
                                 </div>
                                 <div class="add_counter counter_<?=$sp->id?>" style="display: none;">
                                    <ul class="d-flex align-center" data-item="1" data-id="1">
                                       <li>
                                          <button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('<?=$sp->id?>')" ></button>
                                       </li>
                                       <li>
                                          <input class="item_catagory_value item_val_<?= $sp->id ?>" id="" data-id="0" type="number" value="1" onchange = "change_qty(<?= $sp->id ?>,this)" data-item="0">
                                       </li>
                                       <li>
                                          <button class="fa fa-plus " onclick="add_qty('<?=$sp->id?>')" ></button>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <?php $count++; } } ?>
                        </div>
                        <?php } ?>
                     </div>
                  </div>
                  <div id="accordion" class="d-md-none">
                  <?php  $i = 0; foreach ($products as $p) { $p_name = str_replace(' ', '', $p->name);?>
                        <div class="card mb-2">
                           <div class="card-header border-bottom-0 bg-white">
                              <h5 class="mb-0">
                              <button class="btn btn-link w-100 d-flex align-center text-left collapsed" data-toggle="collapse" data-target="#<?php echo $p_name;?>" aria-expanded="true" aria-controls="collapseOne">
                              <?=$p->name?>
                              <span class="ml-auto collapse-icon"></span>
                              </button>
                              </h5>
                           </div>
                              <div id="<?php echo $p_name;?>" class="collapse" aria-labelledby="<?php echo $p_name;?>" data-parent="#accordion">
                                 <div class="card-body px-sm-10">
                                 <div class="tab-pane bg-none target_add_input <?=$p->name?> product_tabs" data-id="<?= $p->id ?>" id="<?=str_replace('&', '', str_replace(' ', '', strtolower($p->name)))?>" role="tabpanel" <?php if($i == 0){ echo 'aria-labelledby="home-tab"'; }else{ echo 'aria-labelledby="contact-tab"'; } ?> >
                                    <?php $i++; if(!empty($p->sub_products)){$count = 0;foreach ($p->sub_products as $sp) {if($count==7){break;}?>
                                          <div class="items_counter border-bottom-sr">
                                             <div class="item_catagory">
                                                <div class="item_catagory_in" data-id="<?php echo $sp->id ?>"  id="counter_<?=$sp->id?>">
                                                   <p data-id="<?=$sp->id?>" class="products<?=$sp->id?>" ><span id="item_title<?=$sp->id?>" class="item_title<?=$sp->id?>"><?=$sp->name?></span><span class="res_plus_btn fa fa-plus ml-auto mr-3 item_category_add<?=$sp->id?>" onclick="add_item_list('<?=$sp->id?>')"></span></p>
                                                </div>
                                                <div class="add_counter counter_<?=$sp->id?>" style="display: none;">
                                                   <ul class="d-flex align-center" data-item="1" data-id="1">
                                                      <li>
                                                         <button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('<?=$sp->id?>')" ></button>
                                                      </li>
                                                      <li>
                                                         <input class="item_catagory_value item_val_<?= $sp->id ?>" id="" data-id="0" type="number" value="1" onchange = "change_qty(<?= $sp->id ?>,this)" data-item="0">
                                                      </li>
                                                      <li>
                                                         <button class="fa fa-plus" onclick="add_qty('<?=$sp->id?>')" ></button>
                                                      </li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                       <?php $count++; } } ?>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     <?php $i++; } ?>
                  </div> 
                  <div class="tabs_sec bg-none">
                     <div class="tab-content" id="myTabContent">
                        <div class="item_add_input">
                           <input class="form-control outline-none" type="text" id="add_more" placeholder="Add more items">
                        </div>
                     </div>
                  </div>
                  <div class="instance_btn w-100 flex-wrap flex-row-reverse mr-sm-2 mr-0 mt-3 d-none d-lg-flex position-relative">
                  <div class="col-md-6 ml-auto px-0">
                     <button onclick="getPrices();"  class="price_btn w-100 border-0">
                        View My Price
                     </button>
                     <div class="spinner-border position-absolute text-white button-spinner" role="status" style="display:none;right:10px;top:23%;width:1.5rem;height:1.5rem;">
                        <span class="sr-only">Loading...</span>
                     </div>
                  </div>
                  <div class="col-md-3 px-0">
                     <a href="<?php echo base_url();?>shop/house_removal" class="back_page_btn w-100 d-flex align-items-center  text-decoration-none">
                        <span class="position-relative d-flex align-items-center w-100"><i class="fa fa-angle-left"></i><span class="mx-auto">Back</span></span>
                     </a>
                  </div>
               </div>
               </div>
               <div class="col-lg-4  pr-0 mt-5 mt-lg-0 pl-0 pl-lg-3">
                  <div class="mb-4 position-relative d-none d-lg-block">
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
                  <div class="tabs_sec cart px-0 bg-white item_counter_box">
                     <div class="item_header pb-3 pt-2">
                        <h3>My Item List<span id="items_length" style="font-size:20px"></span></h3>
                     </div>
                     <div class="counter-body" style="height:305px;">
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
<?php
// Below is for Showing Prices Card
   // print_r($order);die;
   $type = !empty($order) ?$order->order_type : "";
   $total = 0;
   $slug = $order->slug;
   $check_slug = strtok($slug, '_');
   $products = !empty($order) ? json_decode($order->products_list) : array();
   $storage_id = !empty($order) ? $order->id : 0;
   $price = $order->price+$order->km;
   $price = ceil($price)+0;
   if($price<40)
   {
      $price = 40;
   }
   // $price =  str_replace(0, '', $price);
   $box_price= 0;
   if(!empty($products)){ foreach($products as $product){
      $qry = $this->db->where("product_id",$product->id)->get('sma_premium_prices')->row();
      if(!empty($qry))
      {
      if($check_slug =="ground") 
      {
         $box_price += $qry->$slug*$product->quantity;
      }
      }
   }}
   // Prices Card End
?>
<div class="scot-edit-steps third_div" style="display:none;">
   <div class="step-3"> 
      <section class="banner_main site_c_banner">
         <div class="site_banner p-0" style="background:none;">
            <div class="row m-0">
               <div class="col-lg-8">
                  <div class="row">
                     <div class="col-lg-6 mb-3 mb-lg-0 px-0 px-lg-3">
                        <div class="price_list position-relative w-100">
                           <div class="price_list_head text-white standard-price position-relative">
                              <h3>Standard Service<span class="d-block w-100">Removal Service</span></h3>
                              <p class="price-package mb-0">£<?= $price;?>.00</p>
                           </div>
                           <div class="price_list_body">
                              <div class="d-flex i-benifits">
                                 <img class="svg" src="<?php echo base_url('assets/images/card-icon.svg');?>">
                                 <p class="price_list_p ml-2 mb-0">2 Men Team to Load and Move</p>
                              </div>
                              <div class="d-flex i-benifits">
                                 <img class="svg" src="<?php echo base_url('assets/images/card-icon.svg');?>">
                                 <p class="price_list_p ml-2 mb-0">Basic Goods in Transit Insurance Cover</p>
                              </div>
                              <div class="d-flex i-benifits">
                                 <img class="svg" src="<?php echo base_url('assets/images/card-icon.svg');?>">
                                 <p class="price_list_p ml-2 mb-0">Free 48 Hours Cancellation</p>
                              </div>
                           </div>
                           <div class="d-flex justify-content-center position-absolute card-pp w-100 px-2">
                              <button class="price_list_button text-white py-2" onclick="get_prices('standard')">Proceed to Booking</button>
                           </div>   
                        </div>
                     </div> 
                     <div class="col-lg-6 mb-3 mb-lg-0 px-0 px-lg-3">
                        <div class="price_list w-100 position-relative">
                           <div class="price_list_head premium-bg text-white premium-price position-relative">
                              <h3>All inclusive Service<span class="d-block w-100">‘Pack & Move’ Services</span></h3>
                              <p class="price-package mb-0">£<?= $price+$box_price?>.00</p>
                           </div>
                           <div class="price_list_body ">
                              <div class="d-flex i-benifits">
                                 <img class="svg" src="<?php echo base_url('assets/images/card-icon.svg');?>">
                                 <p class="price_list_p ml-2 mb-0">2 Men team to load and Move</p>
                              </div>
                              <div class="d-flex i-benifits">
                                 <img class="svg" src="<?php echo base_url('assets/images/card-icon.svg');?>">
                                 <p class="price_list_p ml-2 mb-0">Goods in Transit Insurance cover upto £30,000</p>
                              </div>
                              <div class="d-flex i-benifits">
                                 <img class="svg" src="<?php echo base_url('assets/images/card-icon.svg');?>">
                                 <p class="price_list_p ml-2 mb-0">Dismantling and Reassembling</p>
                              </div>
                              <div class="d-flex i-benifits">
                                 <img class="svg" src="<?php echo base_url('assets/images/card-icon.svg');?>">
                                 <p class="price_list_p ml-2 mb-0">Complete Packing Service</p>
                              </div>
                              <div class="d-flex i-benifits">
                                 <img class="svg" src="<?php echo base_url('assets/images/card-icon.svg');?>">
                                 <p class="price_list_p ml-2 mb-0">All packaging material</p>
                              </div>
                           </div>
                           <div class="d-flex justify-content-center  position-absolute card-pp w-100  ">
                              <button class="price_list_button text-white py-2" onclick="get_prices('premium')">View Details & Select My Date</button>
                           </div>   
                        </div>
                     </div>
                  <div class="col-md-12 px-0 d-lg-block d-none">
                     <div class="extra-service mt-4  px-3 position-relative">
                        <div class="border-r-8 shadow-sm bg-white save_money_sec position-relative overflow-hidden">
                           <img class="w-100 border-r-8" src="<?php echo base_url('assets/images/scot_movers.jpg');?>" style="object-position: -4px 2px;">
                        </div>
                        <div class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center" style="top:0px;">
                           <h3 class="p-3 bold_ext"><span class="text-white">We Save</span> <span class="privacy-1h">You Money</span></h3>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
               <div class="col-lg-4 pr-0 mt-2 mt-md-0 pl-0 pl-lg-3 d-lg-block d-flex flex-wrap  banner_inner_form mx-0" style="flex-direction:column-reverse;">
                  <div class="extra-service mt-5 d-lg-none position-relative">
                     <div class="border-r-8 shadow-sm bg-white save_money_sec position-relative overflow-hidden">
                        <img class="w-100 border-r-8 " src="<?php echo base_url('assets/images/scot_movers.jpg');?>" style="object-position: -4px 2px;">
                     </div>
                     <div class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center" style="top:0px;">
                        <h3 class="p-3 bold_ext"><span class="text-white">We Save</span> <span class="privacy-1h">Save You Money</span></h3>
                     </div>
                  </div>
                  <!-- <div class="map-container">
                     <div id="map" class="w-100 h-100 h-lg-50 mt-3 mt-lg-0"></div> 
                  </div> -->
                  <div class="tabs_sec cart  pb-0 px-0 bg-white item_counter_box mt-0 mt-lg-4 mt-3">
                     <div class="item_header pb-3 pt-2">
                        <h3>My Item List<span id="items_length_blocks" style="font-size: 20px;"></span></h3>
                     </div>
                     <div class="counter-body blocks">
                     </div>
                     <div id="extra_services_container" style="display: none;">
                        <div class="py-2 item_inner_header">
                           <span>Extra Services Items</span>
                        </div>
                        <div class="counter-body-extraservices extra_blocks">
                        </div>
                     </div>
                     <!-- <div class="text-right mt-4 mb-1">
                        <button class="edit_jobs_btn py-1 px-2 bg-none border mr-2 d-flex align-items-center ml-auto border-left" onclick="edit_job()">Edit Jobs</button>
                     </div> -->
                     <div class="edit_jb_items px-2  align-center py-3 ">
                        <div class="d-flex flex-wrap">
                           <span class="scot-blue">Pickup Location</span>
                           <!-- <a href="javascript:void(0)" class="ml-auto" onclick="edit_location();"><img class="svg" src="<?php echo base_url();?>assets/images/edit.svg"></a> -->
                        </div>
                        <P class="mb-3" id="block_pickup"></p>
                        <input type="hidden" id="pickup" value="<?= $order->pickup_address ?>">
                        <span class="privacy-1h">Drop Off Location</span>
                        <input type="hidden" id="drop" value="<?= $order->delivery_address ?>">
                        <P class="mb-0" id="block_drop"></p>
                     </div>
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
<div class="scot-edit-steps fourth_div" style="display:none;">
   <div class="step-4">
   <section class="banner_main site_c_banner">
      <?php
      $TDate = date('Y-m-d');
      $calendar_end = date('Y-m-d', strtotime($TDate. ' + 14 days'));
      ?>
         <div class="site_banner pb-0 row  my-4 page">
            <div class="pl-0 pb-0 col-md-8 pr-0 pr-md-3">
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
               <div class="bg-white p-lg-5 p-3 bg_drop">
                  <div class="d-inline-block w-100">
                     <!-- <div class="monthly" id="date_calendar"></div> -->
                     <div><h4 style="color:rgb(0, 101, 189);">Select a Date</h4></div>
                     <div id='calendar' style="display:none">
                     
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4 pl-0 pl-md-3 my-4 my-md-0 pr-0">
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
               <!-- <div id="map" class="w-100 h-lg-50 h-100"></div> -->
                  <div class="tabs_sec cart px-0 pb-0 bg-white item_counter_box">
                     <div class="item_header pb-3 pt-2">
                        <h3>My Item List<span id="items_length" style="font-size: 20px;"></span></h3>
                     </div>
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
                     <!-- <div class="text-right mt-4 mb-1">
                        <button class="edit_jobs_btn py-1 px-2 bg-none border mr-2 d-flex align-items-center ml-auto border-left" onclick="edit_job()">Edit Jobs</button>
                     </div> -->
                     <div class="edit_jb_items px-2  align-center py-3 ">
                        <div class="d-flex flex-wrap">
                           <span class="scot-blue">Pickup Location</span>
                           <!-- <a href="javascript:void(0)" class="ml-auto" onclick="edit_location();"><img class="svg" src="<?php echo base_url();?>assets/images/edit.svg"></a> -->
                        </div>
                        <P class="mb-3"><?= $order->pickup_address ?></p>
                        <span class="privacy-1h">Drop Off Location</span>
                        <P class="mb-0"><?= $order->delivery_address ?></p>
                        <!-- <div class="d-flex flex-wrap border-top mt-3 mx-min-m px-2 pt-3">
                           <h6 class="mb-0">Total Price</h6>
                           <P class="mb-0 ml-auto font-bd">200$</p>
                        </div> -->
                     </div>   
                  </div>
               </div>
            </div>
      </section>
      <!-- Modal -->
      <div class="modal fade" id="person-modal" tabindex="-1" role="dialog" aria-labelledby="person-modal" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color:white;">
            <form action="<?= base_url('order_for_edit/'.$this->uri->segment(3));?>" method="POST">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
               <input type="hidden" name="storage_id" value="<?= $this->uri->segment(3) ?>">
               <div class="modal-header">
                  <!-- <h2 class="modal-title">Sunday, 5 July</h2> -->
                  <h2 class="modal-title" id="deleivery_date" name="deleivery_date"></h2>
                  <input type="hidden" name="finaldate" id="finaldate">
                  <button type="button" class="close_modal close" data-dismiss="modal">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body bg-white pt-0">
                  <p class="modal-text-color mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                     <div class="person-select  border-bottom  align-center">
                        <div id="time-range">
                           <p>Time Duration: <span class="slider-time modal-text-color" > 9:00 AM</span> - <span class="slider-time2 modal-text-color" >11:00 AM</span>
                           <input type="hidden" id="strt_time" value="9:00 AM" name="strt_time">
                           <input type="hidden" id="end_time" value="11:00 AM" name="end_time" >
                           </p>
                           <div class="sliders_step1">
                              <div id="slider-range"></div>
                           </div>
                        </div>
                     </div>
                     <div class="person-select py-2 mb-3 border-bottom d-flex align-center">
                        <div class="person-p-detail">
                           <h5 class="mb-0 modal-text-color">1 Person</h5>
                        </div>
                        <div class="p-s-option ml-auto d-flex">
                           <label class="container_radio">-£30
                                 <input type="radio"  value="1_person" name="radio">
                                 <span class="checkmark-radio"></span>
                           </label>
                        </div>   
                     </div>
                     <div class="person-select mb-3  py-2 border-bottom d-flex align-center">
                        <div class="person-p-detail">
                           <h5 class="mb-0 modal-text-color">2 Person</h5>
                        </div>
                        <div class="p-s-option ml-auto d-flex">
                           <label class="container_radio"><span id="default_price"></span>
                                 <input type="radio" value="2_person" id="2_person" name="radio">
                                 <span class="checkmark-radio"></span>
                           </label>
                        </div>   
                     </div>
                     <div class="person-select mb-3 py-2 border-bottom d-flex align-center">
                        <div class="person-p-detail">
                           <h5 class="mb-0 modal-text-color">3 Person</h5>
                        </div>
                        <div class="p-s-option ml-auto d-flex">
                           <label class="container_radio">+£60
                                 <input type="radio" value="3_person" name="radio">
                                 <span class="checkmark-radio"></span>
                           </label>
                        </div>
                     </div>
                     <div class="total-bill-p d-flex align-center flex-wrap pr-4">
                        <h5 class="mb-0 modal-text-color">Total</h5>
                        <input type="hidden" name="new_total" id="new_total">
                        <h4 class="mb-0 ml-auto modal-text-color total-bill-text"><h4  id="total_price" name="total_price" class="modal-text-color"></h4></h4>
                        <!-- <input type="hidden" id="new_price" name="new_price" value=""> -->
                     </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn py-0 proceed_btn">Proceed & Book</button>
               </div>
            </form>
            </div>
         </div>
      </div>
   </div>
   <div class="edit-btn-container pb-3">
      <div class="grey_bg_edit text-center">
         <button class="prev-btn btn btn-primary">Prev</button>
         <button class="next-btn btn btn-primary">Next</button>
      </div>   
   </div> 
</div>  
<!-- Step 4_second -->
<div class="scot-edit-steps fourth_div2" style="display:none;">
   <div class="step-5">
      <section class="banner_main px-0">
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
                        <div id="accordion">
                           <?php $i = 0; if(!empty($products_extra)){ ?>
                              <?php foreach($products_extra as $p){ ?>
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
                                                                           <p data-id="<?=$sp->id?>" class="products<?=$sp->id?>" onclick="add_item_list_extra('<?=$sp->id?>')"><span class="item_title<?=$sp->id?>"><?=$sp->name?></span><span class="fa fa-plus ml-auto mr-3 item_category_add<?=$sp->id?>"></span></p>
                                                                     </div>
                                                                     <div class="add_counter counter_<?=$sp->id?>" style="display: none;">
                                                                           <ul class="d-flex align-center" data-item="1" data-id="1">
                                                                              <li>
                                                                                 <button class="fa fa-minus item_catagory_minus" onclick="subtract_qty_extra('<?=$sp->id?>')"></button>
                                                                              </li>
                                                                              <li>
                                                                                 <input class="item_catagory_value" id="item_val_<?=$sp->id?>" data-id="0" type="number" value="1" onchange="change_qty_extra('<?=$sp->id?>')" data-item="0" />
                                                                              </li>
                                                                              <li>
                                                                                 <button class="fa fa-plus item_catagory_plus" onclick="add_qty_extra('<?=$sp->id?>')"></button>
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
                     <a onclick="getPrices_extra();" href="javascript:void(0);" class="price_btn w-100">
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
                           <h3>My Item List<span id="items_length" style="font-size: 20px;"></span></h3>
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
                     <div class="edit_jb_items px-2  align-center py-3 ">
                        <div class="d-flex flex-wrap">
                              <span class="scot-blue">Pickup Location</span>
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
<!-- Step 5 -->
<div class="scot-edit-steps fifth_div" style="display:none;">
   <div class="step-6"> 
      <h1>step five</h1>
   </div>
   <div class="edit-btn-container pb-3">
      <div class="grey_bg_edit text-center">
         <button class="next-btn btn btn-primary">Next</button>
      </div>   
   </div> 
</div>  
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&extension=.js&key=AIzaSyCAQxRGo3kiHw9CBikEzmWtzrz1Lsz88Pk"></script>
<script>
   
   function initMap2(){
      var directionsRenderer = new google.maps.DirectionsRenderer;
      var directionsService = new google.maps.DirectionsService;
      var bounds1 = new google.maps.LatLngBounds;
      var markersArray1 = [];
      var desticon = ' <?php echo base_url();?>assets/images/favicon.png';
      var map1 = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -33, lng: 151},
      zoom: 14,
      disableDefaultUI: true,
      });
      
      var geocoder1 = new google.maps.Geocoder;
   
      var service1 = new google.maps.DistanceMatrixService;
      service1.getDistanceMatrix({
      origins: ['Stevenage'],
      destinations: ['Luton'],
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
         // var icon1 = asDestination1 ? destinationIcon1 : originIcon1;
         return function(results1, status1) {
               if (status1 === 'OK') {
                  map1.fitBounds(bounds1.extend(results1[0].geometry.location));
                  markersArray1.push(new google.maps.Marker({
                     map: map1,
                     position: results1[0].geometry.location,
                     icon: desticon,
                  }));
               } else {
                  alert('Geocode was not successful due to: ' + status1);
               }
         };
         };
         // directionsRenderer.setMap(map);
         calculateAndDisplayRoute(directionsService, directionsRenderer);
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
   $(document).on('change', '#pickup, #drop', function(){
      field_id = $(this).attr('id');
      setTimeout(function(){
         if($("#pickup").val() != "" && $("#drop").val() != ""){
            initMap($("#pickup").val(), $("#drop").val());
         }
      }, 1000);
      if(field_id=="pickup" && $('#drop').val()==""){
         $('#drop').focus();initMap($("#pickup").val(), $("#drop").val());
      }else if(field_id=="drop" && $('#pickup').val()==""){
         $('#pickup').focus();initMap($("#pickup").val(), $("#drop").val());
      }
   });
   function initMap(pick,drop) {
         var pickup = '';
         var dropup = '';
         pickup = pick;
         dropup = drop;
         var directionsRenderer = new google.maps.DirectionsRenderer({
               suppressMarkers: true,
            });
         
         var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 51.5074, lng: 0.1278},
            disableDefaultUI: true,
            zoom : 7
            
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
               text: 'Directions request failed due to '  + status
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
         initMap($("#pickup").val(), $("#drop").val());
      });
   
   function deleteMarkers(markersArray) {
       for (var i = 0; i < markersArray.length; i++) {
           markersArray[i].setMap(null);
       }
       markersArray = [];
   }
   function house_order_details(){
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
        var property1 = $("#catagory1 span:first-child").attr('data-slug');
        var property2 = $("#catagory3 span:first-child").attr('data-slug');
        var slug1 = "ground";
        var slug2 = "ground";
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
        }else{
            if(!$('#checkbox1').is(':checked')){
                  slug1 = $("#catagory_inner2 span:first-child").attr('data-slug');
            }
            if(!$('#checkbox2').is(':checked')){
               slug2 = $("#catagory_inner3 span:first-child").attr('data-slug');
            }
         }
      // $('.first_div').hide();
      // $('.second_div').show();
        
        var pickup = $("#pickup").val();
        var drop = $("#drop").val();
        $("#block_pickup").text(pickup);
        $("#block_drop").text(drop);
        var slug = slug1+"_to_"+slug2;
        $.ajax({
            type: "GET",
            url: '<?php echo base_url('shop/save_storage'); ?>',
            dataType: 'json',
            data: {'slug': slug, 'type': "house_removal",'pickup': pickup, 'drop': drop,'storage_id': '0','edit_order':"<?= $storage_id ?>"},
            beforeSend: function() {
               $('.price_btn').attr('disabled', 'disabled');
               $('.button-spinner').show();
            },
            success: function(data) {
               $('.price_btn').attr('disabled', false);
               $('.button-spinner').hide();
               $('.first_div').hide();
               $('.second_div').show();
            },
            error: function(data) { alert('Ajax call failed'); }
        });
   }
   // For Selecting product block
   var totsl_items = 0;
      "<?php if(!empty($selected_products)){ foreach($selected_products as $product){if($product->type=="house_removal" || $product->type=="extra_services"){?>"
     var append = true;
     var counter = 0;
      var next = 0;
      var space = "<?= $product->tab ?>".split(" ")[0];
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
         <?php if($product->tab!="null"){ ?>
         if(append)
         {
            $(".target_add_input."+space).append('<div class="c_ui_add items_counter o_category'+<?= $product->id ?>+'"><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+' id="counter_' +"<?= $product->id ?>"+ '"><p><span class="item_title">' +"<?= $product->name?>"+ '</span> <span class="fa fa-plus ml-auto mr-3 item_category_add'+"<?= $product->id ?>"+'"></span></p></div><div class="add_counter counter_' +"<?= $product->id ?>"+ '" style="display: none;"><ul class="d-table-cell-child" data-item="1" data-id="<?= $product->id ?>"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+"<?= $product->id ?>"+')"></button></li><li><input onchange="change_qty(<?= $product->id ?>,this)" class="item_catagory_value item_val_'+"<?= $product->id ?>"+'" type="text" id="" data-id="0" value="'+"<?= $product->quantity?>"+'" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+"<?= $product->id ?>"+')"></button></li></ul></div></div></div><input type="hidden" id="tab<?= $product->id ?>" value="<?= $product->tab ?>"><input type="hidden" id="type<?= $product->id ?>" value="<?= $product->type ?>">');
         }
         <?php } ?>
         $('.items_counter.first_row').hide();
         <?php if($product->type=="extra_services" && $product->tab==$order->order_type){ ?>
            totsl_items +=parseInt("<?= $product->quantity?>");
            $(".extra_services_container").css("display", "block");
            $(".counter-body-extra-services").append('<div class="items_counter items_counter_list'+"<?= $product->id ?>"+' all_items mb-1px" data-id='+"<?= $product->id ?>"+' ><div class="item_catagory"><div class="item_catagory_inner"><p class="item_name'+"<?= $product->id ?>"+'" >'+"<?= $product->name?>"+'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty(<?= $product->id?>)"></button></li><li class="h-100 d-flex align-center"><input class="item_catagory_value'+"<?= $product->id ?>"+'" type="number" value="'+"<?= $product->quantity?>"+'" onchange="change_qty(<?= $product->id?>,this)" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty(<?= $product->id?>)"></button></li></ul></div></div></div><input type="hidden" id="tab<?= $product->id ?>" value="<?= $product->tab ?>"><input type="hidden" id="type<?= $product->id ?>" value="<?= $product->type ?>">');
         <?php } elseif($product->type!="extra_services"){?>
         totsl_items +=parseInt("<?= $product->quantity?>");
         $(".counter-body .category_pitem").append('<div class="items_counter items_counter_list'+"<?= $product->id ?>"+' all_items mb-1px" data-id='+"<?= $product->id ?>"+' ><div class="item_catagory"><div class="item_catagory_inner"><p class="item_name'+"<?= $product->id ?>"+'" >'+"<?= $product->name?>"+'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty(<?= $product->id?>)"></button></li><li class="h-100 d-flex align-center"><input class="item_catagory_value'+"<?= $product->id ?>"+'" type="number" value="'+"<?= $product->quantity?>"+'" onchange="change_qty(<?= $product->id?>,this)" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty(<?= $product->id?>)"></button></li></ul></div></div></div><input type="hidden" id="tab<?= $product->id ?>" value="<?= $product->tab ?>"><input type="hidden" id="type<?= $product->id ?>" value="<?= $product->type ?>">');
         <?php } ?>
         $(".counter_"+"<?= $product->id ?>").css("display","block");
         $(".item_category_add"+"<?= $product->id ?>").css("display","none");
         $(".item_val_"+"<?= $product->id ?>").val("<?= $product->quantity?>");
         $(".products"+"<?= $product->id ?>").removeAttr('onclick');
         $(".item_val_"+"<?= $product->id ?>").attr('data-id',1);
      
      "<?php } } } ?>"
      $('#items_length').text(" ("+totsl_items+")");

            // Below code is for cards my items
            totsl_items = 0;
     " <?php if(!empty($products)){ foreach($products as $product){ ?>"
         counter = 0;
            $('.first_row').remove();
            "<?php if($product->type=="extra_services"){?>"
               $("#extra_services_container").css("display","block");
            $(".tabs_sec .extra_blocks").append('<div class="items_counter list_counter_right item_row'+<?= $product->id ?>+' mb-1px" data-id='+"<?= $product->id ?>"+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+'><p class="item_name'+"<?= $product->id ?>"+'" data-id = "data-id='+"<?= $product->id ?>"+'">'+ "<?= $product->name ?>" +'</p><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input class="item_catagory_value<?= $product->quantity?>" readonly type="number" value="<?= $product->quantity?>" onchange="change_qty(<?= $product->quantity?>)" data-item="<?= $product->quantity?>"></li></ul></div></div></div></div>');
            "<?php } else{ ?>"
            $(".tabs_sec .blocks").append('<div class="items_counter list_counter_right item_row'+<?= $product->id ?>+' mb-1px" data-id='+"<?= $product->id ?>"+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+'><p class="item_name'+"<?= $product->id ?>"+'" data-id = "data-id='+"<?= $product->id ?>"+'">'+ "<?= $product->name ?>" +'</p><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input class="item_catagory_value<?= $product->quantity?>" readonly type="number" value="<?= $product->quantity?>" onchange="change_qty(<?= $product->quantity?>)" data-item="<?= $product->quantity?>"></li></ul></div></div></div></div>');
            "<?php } ?>"
            counter++;
            totsl_items += parseInt("<?= $product->quantity?>");
            " <?php }} ?>"
         $('#items_length_blocks').text(" ("+totsl_items+")");
            // For cards my item list end
            
   $('.nav-tabs .nav-item:nth-child(1) .nav-link').addClass('active');
   $('.tab-pane.product_tabs:nth-child(1)').addClass('active show');
   function getPrices(){
        var main = $(".tabs_sec");
        var slug = "<?=$order->slug?>";
        var sub = $(main).find('.items_counter');
        let ids = [];
        let qtys = [];
        let home = [];
        var i = 0;
        var next = 0;
        var check_item = false;
        localStorage.setItem('type', "house");
         $(".all_items ").each(function(){
        var product_id  =  $(".all_items").eq(next).attr('data-id');
        var producd_name = $(".item_name"+product_id).text();
        var product_qty =  $(".item_catagory_value"+product_id).val();
        var type =  $("#type"+product_id).val();
        var tab =  $("#tab"+product_id).val();
        if(type=="house_removal")
        {
         check_item = true;
        }
         if(product_qty > 0){
            ids.push(product_id);
            qtys.push(product_qty);
         }
        home_obj = {"name":producd_name , "id":product_id , "quantity":product_qty, "tab":tab,"type": type};
        home.push(home_obj);
        next++;
         });
         if(home=="" || check_item==false)
        {
         swal({
         icon: 'warning',
         title: 'No Item Select',
         text: 'Please Select Item'
        });
        return; 
         }
        $.ajax({
            type: "GET",
            url: '<?php echo base_url('shop/getPrices'); ?>',
            dataType: 'json',
            data: {'id': ids, 'qty': qtys, 'slug': slug, 'type': "house_removal"},
            beforeSend: function() {
               $('.button-spinner').show();
               $('.price_btn').attr('disabled', 'disabled');
            },
              success: function(data) {
               $('.price_btn').attr('disabled', false);
                if(data[0] != null){
                  var service = new google.maps.DistanceMatrixService;
                  service.getDistanceMatrix({
                  origins: ['<?=$order->pickup_address;?>'],
                  destinations: ['<?=$order->delivery_address;?>'],
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
                              // alert(kilometers);
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
                        data: {'slug': '<?= !empty($order) ? $order->slug : '' ?>', 'type': "house_removal", 'pickup': '<?= !empty($order) ? $order->pickup_address : '' ?>', 'drop': '<?= !empty($order) ? $order->delivery_address : '' ?>', 'storage_id': '<?= !empty($order) ? $order->id : '' ?>', 'price': price, 'km': km, 'total': amount , 'items':home},
                        success:function(data)
                        {
                           $('.button-spinner').hide();
                           $('.second_div').hide()
                           $('.third_div').show();
                           // window.location.href = '<?=base_url('shop/prices/')?>'+data;
                        }
                     });
                  }
                  });
                }else{
                    alert(data[0].label);
                }
            },
            error: function(data) { alert('Ajax call failed'); }
        });
      // $('.second_div').hide()
      // $('.third_div').show();
    }
   function update_items()
   {
      var extra_services = true;
      let ids = [];
      let qtys = [];
      let home = [];
      var total_items = 0;
      var next = 0;
      $(".all_items ").each(function(){
        var product_id  =  $(".all_items").eq(next).attr('data-id');
        var producd_name = $(".item_name"+product_id).text();
        var product_qty =  $(".item_catagory_value"+product_id).val();
        var type =  $("#type"+product_id).val();
        var tab =  $("#tab"+product_id).val();
      if(product_qty > 0){
			ids.push(product_id);
            qtys.push(product_qty);
            total_items += parseInt(product_qty);
		}
      if(type=="extra_services")
      {
         extra_services = false;
      }
        home_obj = {"name":producd_name , "id":product_id , "quantity":product_qty, "tab":tab,"type": type};
        home.push(home_obj);
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
         data: {'items' : home},
         success:function(data)
         {
            return;
         }
      });
   }
   function change_qty(id,e)
   {
      var next= 0;
      var data_id = true;
      var quantity = $(e).val();
      var tab = $("#tab"+id).val();
      var type = $("#type"+id).val();
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
            $(".item_val_"+id).attr('data-id',0);
         }
      }
      var cuerrent_items = 0;
      $(".item_catagory_value"+id).val(quantity);
      $(".item_val_"+id).val(quantity);
      var name = $(".item_name"+id).text();
        update_items();
        check_items_forempty();
   }
   function add_qty(id)
   {
      var cuerrent_items = 0;
      var name = $(".item_name"+id).text();
      var tab = $("#tab"+id).val();
      var type = $("#type"+id).val();
      $(".item_catagory_value"+id).val(parseInt($(".item_catagory_value"+id).val())+1);
      $(".item_val_"+id).val(parseInt($(".item_val_"+id).val())+1);
         update_items();
   }
   function subtract_qty(id)
   {
      var next= 0;
      var cuerrent_items = 0;
      var data_id = true;
      var tab = $("#tab"+id).val();
      var type = $("#type"+id).val();
       var name = $(".item_name"+id).text();
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
            $(".item_val_"+id).attr('data-id',0);
         }
      }
      else
      {
      var qty = parseInt($(".item_catagory_value"+id).val())-1 ;
      $(".item_catagory_value"+id).val(qty);
      $(".item_val_"+id).val(qty);
      }
      update_items();
      check_items_forempty();
   }
   // auto complete  Start// 
   $( "#add_more" ).autocomplete({
      source: 
      function(request, response){
         $.ajax({
            type: "GET",
            url: '<?php echo base_url('shop/search_product'); ?>',
            dataType: 'json',
            data: {'search_product': request.term , "product_type": "house_removals" , "type": "sub_product" },
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
   function add_item_list(id)
   {
      $(".item_val_"+id).val(1); 
      var tab =  $(".active.tabs").attr('data-name');
      item_name = $("#item_title"+id).text();
      var next= 0;
      var append = true;
      $('.items_counter.first_row').hide();
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
        $('.counter_'+id).show();
        $('.res_plus_btn.item_category_add'+id+'').hide();
      $(".counter-body .category_pitem").append('<div class="items_counter_list'+id+' all_items items_counter mb-1px" data-id='+id+' ><div class="item_catagory"><div class="item_catagory_inner"><p class="item_name'+id+'">'+ item_name +'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+id+')"></button></li><li class="h-100 d-flex align-center"><input class="item_catagory_value'+id+'" type="number" value="1" onchange="change_qty('+id+',this)" data-item='+id+'></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+id+')"></button></li></ul></div></div></div><input type="hidden" id="tab'+id+'" value='+tab+'><input type="hidden" id="type'+id+'" value="house_removal">');
      $(".products"+id).removeAttr('onclick');
      update_items();
      }
      else{
         var cuerrent_items = 0;
         var count = parseInt($(".item_catagory_value"+id).val())+1 ;
         var name = $(".item_name"+id).text()
         $(".item_catagory_value"+id).val(count);
         $(".item_val_"+id).val(count);
        update_items();
      }
   }
   // below function is for extra item
   function add_item_list_extra(id)
   {
      $("#item_val_"+id).val(1);
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
     $('.tabs_sec .counter-body-extra-services').append('<div class="items_counter item_list list_counter_right'+id+' mb-1px" data-id="'+id+'" id="item_container'+id+'"><div class="item_catagory all_items" data-id="'+id+'"><div class="item_catagory_inner" data-id = "'+id+'"><p class="item_name'+id+'" data-id = "'+id+'">'+ item_name +'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><input class="item_catagory_value'+id+'"" readonly type="number" value="1" onchange="change_qty("'+id+'")" data-item="'+id+'"></li></ul></div></div></div><input type="hidden" class="type_'+id+'" value="extra_services"><input type="hidden" class="tab_'+id+'" value="<?= $order->order_type?>">');
     $(".products"+id).removeAttr('onclick');
      }
      update_items();
   }
   function add_qty_extra(id)
   {
      var cuerrent_items = 0;
      $(".item_catagory_value"+id).val(parseInt($(".item_catagory_value"+id).val())+1);
      $("#item_val_"+id).val($(".item_catagory_value"+id).val());
      update_items();
   }
   function change_qty_extra(id)
   {
      var next= 0;
      var data_id = true;
      var quantity = $("#item_val_"+id).val();
      $(".item_catagory_value"+id).val(quantity);
      if(quantity<1)
      {
         $(".list_counter_right"+id).remove();
         $(".products"+id).attr("onclick","add_item_list("+id+")");
         $(".counter_"+id).removeClass('d-block');
         $(".counter_"+id).css("display","none");
         $(".item_category_add"+id).css("display","flex");
         $(".item_category_add"+id).addClass('fa-plus');
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
        update_items();
   }
   function subtract_qty_extra(id)
   {
      var next= 0;
      var cuerrent_items = 0;
      var data_id = true;
       var name = $(".item_name"+id).text();
      if($(".item_catagory_value"+id).val()<=1)
      {
       $(".list_counter_right"+id).remove();
       $(".products"+id).attr("onclick","add_item_list("+id+")");
       $(".counter_"+id).removeClass('d-block');
       $(".counter_"+id).css("display","none");
         $(".item_category_add"+id).css("display","flex");
         $(".item_category_add"+id).addClass('fa-plus');
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
      $("#item_val_"+id).val(qty);
      }
           update_items();
   }
   function getPrices_extra(){
        var main = $(".tabs_sec");
        var slug = "<?=$order->slug?>";
        var sub = $(main).find('.items_counter');
        let ids = [];
        let qtys = [];
        let home = [];
        var i = 0;
        var premium_price = 0;
        var next = 0;
         $(".item_list").each(function(){
        var product_id  =  $(".item_list").eq(next).attr('data-id');
        var producd_name = $(".item_name"+product_id).text();
        var product_qty =  $(".item_catagory_value"+product_id).val();
        var type = $(".type_"+product_id).val();
		   if(product_qty > 0){
			ids.push(product_id);
            qtys.push(product_qty);
        }
        next++;
         });
      //   $.ajax({
      //       type: "GET",
      //       url: '<?php echo base_url('shop/getPrices'); ?>',
      //       dataType: 'json',
      //       data: {'id': ids, 'qty': qtys, 'slug': slug, 'type': "extra_services"},
      //       beforeSend: function() {
      //          $('.button-spinner').show();
      //          $('.price_btn').attr('disabled', 'disabled');
      //       },
      //         success: function(data) {
      //           if(data[0] != null){
      //             var service = new google.maps.DistanceMatrixService;
      //             service.getDistanceMatrix({
      //             origins: ['<?= $storage->pickup_location?>'],
      //             destinations: ['<?=$storage->drop_location?>'],
      //             travelMode: 'DRIVING',
      //             unitSystem: google.maps.UnitSystem.METRIC,
      //             avoidHighways: false,
      //             avoidTolls: false
      //             }, function(response, status) {
      //             if (status !== 'OK') {
      //                alert('Error was: ' + status);
      //             } else {
      //                var originList = response.originAddresses;
      //                var destinationList = response.destinationAddresses;
      //                var amount = 0;
      //                var price = 0;
      //                var km = 0;
      //                for (var i = 0; i < originList.length; i++) {
      //                      var results = response.rows[i].elements;
      //                      for (var j = 0; j < results.length; j++) {
      //                         var kilometers = results[j].distance.text;
      //                         kilometers = kilometers.replace(' km', '');
      //                         // alert(kilometers);
      //                         price = parseFloat(data[0].price);
      //                         price = premium_price+price;
      //                         km = parseFloat(kilometers)*0.621371;
      //                         km = parseFloat(km)*0.80;
      //                         amount = parseFloat(km) + parseFloat(price);
      //                         if(amount<40)
      //                         {
      //                             amount = 40;
      //                         }
      //                         localStorage.setItem('price',amount);
      //                         $.ajax({
      //                               type: "GET",
      //                               url: '<?php echo base_url('shop/save_storage'); ?>',
      //                               dataType: 'json',
      //                               data: {'slug': '<?= !empty($storage) ? $storage->slug : '' ?>', 'type': '<?= !empty($storage) ? $storage->type : '' ?>', 'pickup': '<?= !empty($storage) ? $storage->pickup_location : '' ?>', 'drop': '<?= !empty($storage) ? $storage->drop_location : '' ?>' , 'storage_id': '<?= !empty($storage) ? $storage->id : '' ?>', 'price': price, 'km': km, 'total': Math.ceil(amount) , 'items' : home},
      //                               success:function(data)
      //                               {
      //                                   $('.button-spinner').hide();
      //                                   $('.third_div').hide()
      //                                   $('.fourth_div').show();
      //                                  //  window.location.href = '<?= base_url('shop/price_options/');?>'+data;
      //                               }
      //                           });
      //                      }
      //                }
      //             }
      //             });
      //           }else{
      //               alert(data[0].label);
      //           }
      //       },
      //       error: function(data) { alert('Ajax call failed'); }
      //   });
      $('.third_div').hide();
      $('.fourth_div2').hide();
      $('.fourth_div').show();
    }
   function check_items_forempty(){
      var item_lle = $('.counter-body .items_counter').length;
      if(item_lle<=1){
         $('.items_counter.first_row').show();
      }
   }
   function add_product(product,id)
   {
      $('.items_counter.first_row').hide();
      $('#searchResult').hide();
      $('#searchResult').css('z-index', '-1');     
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
      var tab =  $(".active.tabs").attr('data-name');
      $(".active.target_add_input , .collapse.show .target_add_input").append('<div class="c_ui_add items_counter o_category'+id+'"><div class="item_catagory"><div class="item_catagory_inner" data-id='+id+' id="counter_' + id + '"><p><span class="item_title">' + product + '</span> <span class="fa fa-plus ml-auto mr-3 item_category_add'+id+'"></span></p></div><div class="add_counter counter_' + id + '" style="display: none;"><ul class="d-table-cell-child" data-item="1" data-id="'+id+'"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+id+')"></button></li><li><input onchange="change_qty('+id+',this)" class="item_catagory_value item_val_'+id+'" type="text" id="" data-id="0" value="1" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+id+')"></button></li></ul></div></div></div><input type="hidden" id="type'+id+'" value="house_removal"><input type="hidden" id="tab'+id+'" value="'+tab+'">');
      $(".counter-body .category_pitem").append('<div class="items_counter_list'+id+' all_items items_counter mb-1px" data-id='+id+' ><div class="item_catagory"><div class="item_catagory_inner"><p class="item_name'+id+'">'+ product +'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+id+')"></button></li><li class="h-100 d-flex align-center"><input class="item_catagory_value'+id+'" type="number" value="1" onchange="change_qty('+id+',this)" data-item='+id+'></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+id+')"></button></li></ul></div></div></div><input type="hidden" id="type'+id+'" value="house_removal"><input type="hidden" id="tab'+id+'" value="'+tab+'">');
      $("#add_more").val("");  
      $(".counter_"+id).css("display","block");
       $(".item_category_add"+id).css("display","none");
      $(".products_list").remove();
      $(".item_val_"+id).attr('data-id',1);
      update_items();
   }
   else
   {
      $(".counter_"+id).css("display","block");
      $('.res_plus_btn.item_category_add'+id+'').hide();
       $(".item_category_add"+id).css("display","none");
        var data_id =  $(".item_val_"+id).attr('data-id');
        if(data_id !=0)
        {
       var value = $(".item_val_"+id).val();
       value++;
       $(".item_val_"+id).val(value);
        }
        else
        {
            $(".item_val_"+id).attr('data-id',1);
        }
        $("#add_more").val("");
       add_item_list(id);
   }
}
function switch_tab()
{
   $("#add_more").val("");  
   $(".products_list").remove();
}
   // For Selecting product block end

   // For Price Cards
   function get_prices(service)
      {
         var price = '<?= $order->total ?>';
         var boox_price = '<?= $box_price ?>';
         var total = 0;
         if($.trim(service)=="standard")
         {
           $('.third_div').hide()
           $('.fourth_div2').show();
           total = parseFloat(price);
         }else if($.trim(service)=="premium"){
            $('.third_div').hide()
            $('.fourth_div').show();
            total =parseFloat(price)+parseFloat(boox_price);
         }
         var pickup = $("#pickup").val();
         var drop = $("#drop").val();
         $.ajax({
            type: "GET",
            url: '<?php echo base_url('shop/save_storage'); ?>',
            dataType: 'json',
            data: { 'pickup': pickup, 'drop': drop , 'storage_id': "<?= $storage_id ?>", 'type': '<?=!empty($order) ? $order->order_type : ''?>', 'slug': '<?=!empty($order) ? $order->slug : ''?>', 'price': '<?=!empty($order) ? $order->price : 0?>', 'km': '<?=!empty($order) ? $order->km : 0?>', 'total': total  },
            beforeSend: function () {
               $('#scr_c_loader').show();
            },
           success: function(data) {
              if(service=='standard')
              {
               $('.third_div').hide()
               $('.fourth_div2').show();
               //   window.location.href = '<?= base_url('shop/extra_services/'.$storage_id);?>';
              }
              else if(service=='premium')
              {
               $('.third_div').hide()
               $('.fourth_div').show();
               // window.location.href = '<?= base_url('shop/price_options/'.$storage_id);?>';
              }  
           },
           error: function(data) { alert('Ajax call failed'); }
         });
      }
   // For Price Cards end

   // Calendar page
   var one_person_price = 30;
   var two_person_price = 40;
   var three_person_price = 60;
   var c_price = 0;

   $(window).on('load', function(){
     $('.fc-row.fc-widget-content').each(function(){
        var parent_f = $(this);
        var dis_length = $(this).find('.fc-disabled-day');
        if(dis_length.length==7){
           $(parent_f).css({'visibility':'hidden','display':'contents'});
        }
     });
     $('.fc-row.fc-week.fc-widget-content.fc-rigid').css('height', '75px');
     $('#calendar').show();
   });

   function load_modal(clicked_date,price,index_date){
      var dd = new Date();
      var TodayDate = dd.getFullYear() + "-0" + (dd.getMonth()+1) + "-" + dd.getDate();
      var d = new Date(clicked_date);
      clickdateindex = d.getDay();
      var ind = new Date(index_date);
      calendarIndexDate = ind.getDay();
      c_price = price.replace(/[^\d\.]/g, '');
      if(clicked_date == index_date){

         }else if(calendarIndexDate == 6){
            if(clickdateindex == 6){
               c_price = parseInt(c_price) - 40;
            }else if(clickdateindex == 5){
               c_price = parseInt(c_price) - 40;
            }else{
               c_price = parseInt(c_price) - 70;
            }
         }
         else if(calendarIndexDate == 5){
            if(clickdateindex == 6){
               c_price = parseInt(c_price) - 40;
            }else if(clickdateindex == 5){
               c_price = parseInt(c_price) - 40;
            }else{
               c_price = parseInt(c_price) - 70;
            }
         }
         else if(clickdateindex == 6){
            c_price = parseInt(c_price) - 10;
         }
         else if(clickdateindex == 5){
            c_price = parseInt(c_price) - 10;
         }else if(TodayDate != clicked_date){
            c_price = parseInt(c_price) - 40;
         }
         var date    = new Date(clicked_date);
         // alert(date);return;
         var months = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
         var dates = ["SUN","MON","TUE","WED","THU","FRI","SAT"];
         yr      = date.getFullYear();
         month   = date.getMonth();
         day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate();
         var newmonth = parseInt(month)+1;
         // alert(yr + "-" + months[parseInt(month)] + "-" + day + " " + dates[parseInt(date.getDay())])
         var formatdate = months[parseInt(month)] + " " + day + ", " + yr;
         newmonth   = newmonth < 10 ? '0' + newmonth : newmonth;
         newDate = day + '-' + newmonth + '-' + yr;
         $("#deleivery_date").text(formatdate);
         $("#2_person").prop("checked", 'checked');
         $("#default_price").text("£"+c_price)
         $("#total_price").text("£"+c_price);
         $("#new_total").val(c_price);
         $("#finaldate").val(newDate);
         $('#person-modal').modal('show');
      }
      function load_eventclick(clicked_date,price){
         c_price = price.replace(/[^\d\.]/g, '');
         var date    = new Date(clicked_date);
         var months = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
         var dates = ["SUN","MON","TUE","WED","THU","FRI","SAT"];
         yr      = date.getFullYear();
         month   = date.getMonth();
         day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate();
         var newmonth = parseInt(month)+1;
         var formatdate = months[parseInt(month)] + " " + day + ", " + yr;
         newmonth   = newmonth < 10 ? '0' + newmonth : newmonth;
         newDate = day + '-' + newmonth + '-' + yr;
         $("#deleivery_date").text(formatdate);
         $("#2_person").prop("checked", 'checked');
         $("#default_price").text(price)
         $("#total_price").text(price);
         $("#new_total").val(c_price);
         $("#finaldate").val(newDate);
         $('#person-modal').modal('show');
      }
      // var total_price= $("#total_price").text();
      $("input[type='radio']").click(function(){
         // alert(c_price);return;
               var  new_total = 0
               var radioValue = $("input[name='radio']:checked").val();
               //  alert(radioValue);
               if(radioValue=="1_person"){
                  new_total = parseInt(c_price)-one_person_price;
                  $("#total_price").text("£"+new_total);
                  $("#new_total").val(new_total);
               }
               else if(radioValue=="2_person")
               {
                  // new_total = parseInt(total_price)+two_person_price;
                  $("#total_price").text("£"+c_price);
                  $("#new_total").val(c_price)
               }
               else if(radioValue=="3_person")
               {
                  new_total = parseInt(c_price)+three_person_price;
                  $("#total_price").text("£"+new_total);
                  $("#new_total").val(new_total);
               }
            });
            function parseDate(str) {
            var mdy = str.split('-');
            return new Date(mdy[2], mdy[0]-1, mdy[1]);
         }

         function datediff(first, second) {
            return Math.round((second-first)/(1000*60*60*24));
         }
      document.addEventListener('DOMContentLoaded', function() {
         //   alert(<?=json_encode($events[0][3]->date)?>);
         var calendarEl = document.getElementById('calendar');
         var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid' ],
            defaultDate: '<?=date('Y-m-d')?>',
            validRange: {
               start: '<?php echo $TDate; ?>',
               end: '<?php echo $calendar_end; ?>'
            },
            editable: false,
            header: {
               right: ''
               },
            eventLimit: true,
            events: <?=json_encode($events[0])?>,
            eventClick: function(info) 
            {
               var year = info.event.start.getFullYear();
               var month = (info.event.start.getMonth()+1) < 10 ? '0' + (info.event.start.getMonth()+1) : (info.event.start.getMonth()+1);
               var days = info.event.start.getDate() < 10 ? '0' + info.event.start.getDate() : info.event.start.getDate();
               var dd = new Date();
               var TodayDate = dd.getFullYear() + "-0" + (dd.getMonth()+1) + "-0" + dd.getDate();
               var ClickDate = year +"-"+ month +"-"+ days;
               if(ClickDate < TodayDate)
                  {
                  swal({
                        icon: 'warning',
                        title: 'Please Select Today or Next Date',
                        text: "you can't select the previous date. please select today or next date."
                     });
                  }
                  else
                  {
                     load_eventclick(ClickDate,info.event.title);
                  }
            },
            dateClick: function(info) {
               var d = new Date();
               var TodayDate = d.getFullYear() + "-0" + (d.getMonth()+1) + "-0" + d.getDate();
               if(info.dateStr < TodayDate)
                  {
                  swal({
                        icon: 'warning',
                        title: 'Please Select Today or Next Date',
                        text: "you can't select the previous date. please select today or next date."
                     });
                  }
                  else
                  {
                     var dms = new Date('<?=json_encode($events[0][0]->date)?>');
                     var dms = dms.getMonth() + "-" + dms.getDate() + "-" + dms.getFullYear()  ;
                     var als = new Date(info.dateStr);
                     var als = als.getMonth() + "-" + als.getDate() + "-" + als.getFullYear();
                     if(datediff(parseDate(dms), parseDate(als)) > 89){
                        swal({
                        icon: 'warning',
                        title: 'Please Select the Date Between 3 months.',
                        text: "you can't select the date more than 3 months. please select between 3 months date."
                        });return;
                     }
                     load_modal(info.dateStr,<?=json_encode($events[0][0]->title)?>,<?=json_encode($events[0][0]->date)?>);
                  }
            }
         });
         calendar.render();
      });
   // Calendar page
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