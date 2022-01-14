<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
//   $this->db->where('ip_address', $this->input->ip_address())->delete('sma_storage');
?>
<!-- Header End -->
<style>
   .body_wrapper{
   overflow: hidden;
   }
   .overly_wrap svg{
      width:100%;
      height:100%;
   }
   .overly_content .text_overly{
      padding-left:0px !important;
   }
   .overly_content{
      padding:10px 0px;
   }
   .banner_inner_text p span:before, .circle_icon:before{
      left:-7px;
      bottom:9px;
   }

</style>
<script>
   $(document).ready(function(){
      // $('a[href^="#"]').click(function() {
      //    $('html,body').animate({
      //       scrollTop: $(this.hash).offset().top - 240
      //    }, 500);
      //    return false;
      //    e.preventDefault();
      // });
      var scroll_get = $(window).scrollTop();
      function contact_card(){
         if(scroll_get > 20){
            $('.contact-card').removeClass('activate-contact');
            $('.contact-card').addClass('deactivate-contact');
         }
         else{
            $('.contact-card').removeClass('deactivate-contact');
            $('.contact-card').addClass('activate-contact');
         }
      }
      $(window).scroll(function(){
         var scroll_get = $(window).scrollTop();
         if(scroll_get > 20){
            $('.contact-card').removeClass('activate-contact');
            $('.contact-card').addClass('deactivate-contact');
         }
         else{
            $('.contact-card').removeClass('deactivate-contact');
            $('.contact-card').addClass('activate-contact');
         }
      });
      contact_card();
      // focus validation start //
      $('.select_moving ul li').click(function(){
        if($('#pickup').val()=="" && $('#drop').val()==""){
           $('#pickup').focus();
         }
         else{
           if($('#pickup').val()!=="" && $('#drop').val()==""){
               $('#drop').focus();
            }
            else{
               if($('#pickup').val()=="" && $('#drop').val()!==""){
                  $('#pickup').focus();
               }
               else{
                 return false;
               }
            }
         }
      });
      // focus validation end //
   });
</script>
<!-- Banner Section Start -->
<section class="banner_main_home" style="min-height:425px;">
   <div class="site_banner position-relative tran_layer_c pb-3" style="background:url('<?php echo base_url();?>assets/images/curve.png');min-height:430px;background-size:56%;background-position: top -210px right -34px;background-repeat:no-repeat;">
      <div class="row mx-auto container-custom">
         <div class="col-lg-6 p-0 wow slideInLeft" data-wow-duration="1.5s" style="min-height:430px;">
            <div class="mbl-van-sec d-md-none">
               <img class="img-fluid position-absolute" src="<?php echo base_url();?>assets/images/curve.png">
               <img style="width:200px;" class="position-absolute mbl-van img-fluid" src="<?php echo base_url();?>assets/images/van-loaded.png">
            </div>
            <div class="banner_inner_text pt-5 pl-0 pr-0 pr-md-3 position-relative">
               <h3 class="mb-3 sm-text-shadow-blue">Best Price to Move Anything Anywhere</h3>
               <h5 class="mb-3 sm-text-shadow-blue"> Trusted Reliable  Professionals</h5>
               <!-- <p class="mb-0"><span class="circle_icon position-change-i"></span>The UK’s favourite delivery, removals and transport marketplace</p> -->
                  <div class="banner_inner_form home_form py-4 px-0 mx-0">
                     <form method="POST" class="row w-100 m-0">
                        <div class="col-sm-12 p-0">
                           <!-- Dropdown Start -->
                           <div class="w-100 main_drop_aria dop">
                              <div class="form_input drop_btn mt-4-md" id="select_moving" >
                                 <span class="btn_selected_text" data-id = "0" data-slug="0">What are you moving?</span>
                                 <span class="fa fa-angle-down float-right mr-3 toggle_icon"></span>
                              </div>
                              <div class="dropdown_list">
                                 <div class="dropdown_content select_moving" >
                                    <div class="row m-0">
                                       <div class="col-12 col-md-6 px-0">
                                          <ul class="p-0">
                                             <li>
                                                <button type="button"> <img class="svg" src='assets/images/home2.svg' width="23px" height="23px" class="drop-icon"> <span data-slug="1" data-slug="house_removal">House Removals</span></button>
                                             </li>
                                             <li>
                                                <button type="button"> <img class="svg" src='assets/images/office.svg' width="23px" height="23px" class="drop-icon"> <span data-slug="2" data-slug="office_removal">Office Removals</span></button>
                                             </li>
                                             <li>
                                                <button type="button"> <img class="svg" src='assets/images/Untitled-1 copy.svg' width="23px" height="23px" class="drop-icon"> <span data-slug="3" data-slug="furniture_delivery">Furniture Delivery</span></button>
                                             </li>
                                             <li>
                                                <button type="button"> <img class="svg" src='assets/images/piano2.svg' width="23px" height="23px" class="drop-icon"><span data-slug="4" class="pt-2 margin-left" data-slug="piano_removal">Piano Removals</span></button>
                                             </li>
                                             <div class="more_content">
                                                <h5>More Services</h5>
                                                <ul class="p-0">
                                                   <li>
                                                      <button type="button"> <img class="svg" src='assets/images/van2.svg' width="23px" height="23px" class="drop-icon"><span data-slug="5" data-slug="man_and_van" class="margin-left">Man & Van</span></button>
                                                   </li>
                                                   <!-- <li>
                                                      <button type="button"> <i class="fab fa-amazon"></i><span>Amazon Delivery</span></button>
                                                      </li> -->
                                                </ul>
                                             </div>
                                          </ul>
                                       </div>
                                       <div class="col-md-6 col-12 d-none d-lg-block px-0">
                                          <div class="company_van_img text-center">
                                             <img class="svg" src="<?php echo base_url();?>assets/images/home2.svg">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Dropdown End -->
                        </div>
                        <div class="col-sm-6 pr-sm-2 pr-0 pl-0">
                           <div class="user-input-wrp d-flex  location_area mt-1 flex-wrap">
                              <input type="text" class="form_input w-100" placeholder="" required id="pickup">
                              <span class="floating-label">Pick Up Location</span>
                           </div>
                        </div>
                        <div class="col-sm-6 pr-sm-0 pr-0 pl-0">
                           <div class="user-input-wrp d-flex location_area  mt-1 flex-wrap">
                              <input type="text" class="form_input w-100" placeholder="" required id="drop">
                              <span class="floating-label">Drop Off Location</span>
                           </div>
                        </div> 
                        <div class="instance_btn w-100 position-relative">
                           <button onclick="getPrices();" type="button" class="price_btn w-100 border-0">
                             Get Instance Prices
                           </button>
                           <div class="spinner-border position-absolute text-white button-spinner" role="status" style="display:none;right:10px;top:23%;width:1.5rem;height:1.5rem;">
                              <span class="sr-only">Loading...</span>
                           </div>
                        </div>
                     </form>
                  </div>
              </div>
            </div>
            <!-- <div class="col-lg-5 p-0 d-none d-lg-block">
               <div class="banner_inner_img ">
                  <?php foreach ($slider as $slide) {?>
                  <img class="duration-time wow slideInRight" data-wow-duration="1.5s" src="<?php echo base_url('assets/uploads/'.$slide->image);?>">
                  <?php }?>
               </div>
            </div> -->
            <div class="col-lg-6 position-relative d-lg-block d-none">
               <div class="rounded-circle lg-animation position-absolute"></div>
               <div class="rounded-circle md-animation position-absolute"></div>
               <div class="rounded-circle sm-animation position-absolute"></div>
               <div class="rounded-circle xsm-animation position-absolute"></div>
               <div class="position-absolute" style="top: 16%;right: -16%;max-width:440px;"><img class="w-100" src="<?php echo base_url();?>assets/images/van-loaded.png" ></div>
               <div class="position-absolute" style="bottom:49px;left:7%;"><img src="<?php echo base_url();?>assets/images/furniture.png"></div>
            </div>
      </div>
   </div>
</section>
<!-- Banner Section End -->
<!-- Tell about Moving Section Start-->
<section class="tell_about_moving mt-0" id="tell_about">
   <div class="sec_heading mt-0">
      <h3 class="text-center"><span class="circle_icon"></span>Tell us what are you moving?</h3>
   </div>
   <div class="row col-sm-12 col-md-10 col-lg-7  p-0 mx-auto">
   <div class="col-sm-6 col-md-4 mb-c-30 px-0 px-sm-3">
      <a class="nav-link px-0" href="<?= base_url('shop/house_removal');?>">
         <div class="overly_wrap wow slideInUp" data-wow-duration="1s" wow-data-offset="10">
            <div class="overly_content">
               <div class="image-icon-border">
                  <div class="service_img_sr">
                     <img class="svg" src="<?= base_url('assets/images/home2.svg'); ?>" alt="house_removels">
                  </div>
               </div>   
               <div class="text_overly">
                  <p>House Removals</p>
               </div>
            </div>
         </div>
      </a>   
   </div>
   <div class="col-sm-6 col-md-4 mb-c-30 px-0 px-sm-3">
      <a class="nav-link px-0" href="<?= base_url('shop/office_removal');?>">
         <div class="overly_wrap h-100 wow slideInUp" data-wow-duration="1.5s" wow-data-offset="10">
            <div class="overly_content h-100">
            <div class="image-icon-border">
               <div class="service_img_sr">
                  <img class="svg" src="<?= base_url('assets/images/office.svg'); ?>" alt="office_removels">
               </div>   
            </div>
               <div class="text_overly">
                  <p>Office Removals</p>
               </div>
            </div>
         </div>
      </a>   
   </div>
   <div class="col-sm-6 col-md-4 mb-c-30 px-0 px-sm-3">
      <a class="nav-link px-0" href="<?= base_url('shop/furniture_delivery');?>">
         <div class="overly_wrap wow slideInUp" data-wow-duration="2s" wow-data-offset="10">
            <div class="overly_content">
            <div class="image-icon-border">
               <div class="service_img_sr">
                  <img class="svg" src="<?= base_url('assets/images/Untitled-1 copy.svg'); ?>" alt="furniture_delivery">
               </div>   
            </div>
               <div class="text_overly">
                  <p>Furniture Delivery</p>
               </div>
            </div>
         </div>
      </a>   
   </div>
   <div class="col-sm-6 col-md-4 mb-c-30 px-0 px-sm-3">
      <a class="nav-link px-0" href="<?= base_url('shop/piano_removal');?>">
         <div class="overly_wrap wow slideInUp" data-wow-duration="1s">
            <div class="overly_content">
            <div class="image-icon-border">
               <div class="service_img_sr">
                  <img class="svg" src="<?= base_url('assets/images/piano2.svg'); ?>" alt="piano_transport">
               </div>   
            </div>
               <div class="text_overly">
                  <p>Piano Transport</p>
               </div>
            </div>
         </div>
      </a>   
   </div>
   <div class="col-sm-6 col-md-4 mb-c-30 px-0 px-sm-3">
      <a class="nav-link px-0" href="<?= base_url('shop/man_and_van');?>">
         <div class="overly_wrap h-100 wow slideInUp" data-wow-duration="1.5s">
            <div class="overly_content h-100">
            <div class="image-icon-border">
               <div class="service_img_sr">
                     <img class="svg" src="<?= base_url('assets/images/van2.svg'); ?>" alt="mans & van">
                  </div>   
            </div>
               <div class="text_overly">
                  <p>Man & Van Service</p>
               </div>
            </div>
         </div>
      </a>   
   </div>
   <div class="col-sm-6 col-md-4 mb-c-30 px-0 px-sm-3">
     <a class="nav-link px-0" href="<?= base_url('');?>">
         <div class="overly_wrap  wow slideInUp" data-wow-duration="2s">
            <div class="overly_content">
            <div class="image-icon-border">
               <div class="service_img_sr">
                  <img class="svg" src="<?= base_url('assets/images/man2.svg'); ?>" alt="man_power_only">
               </div>   
            </div>
               <div class="text_overly">
                  <p>Man Power Only</p>
               </div>
            </div>
         </div>
      </a>   
   </div>
</section>
<section>
   <div class="new-sec-padding w-100">
      <div class="row">
         <div class="col-md-6">
            <div class="new-sec-h pt-md-5 pl-0 pr-0 pr-md-3">
               <h3 class="mb-3">Best price to move anything anywhere</h3>
               <div class="mt-4">
               <div class="d-flex sec-li">
                  <div class="fas-check d-flex align-center justify-content-center"><i class="fas text-white fa-check"></i></div>
                     <li class="new-sec-li">Easy Booking</li>
                  </div>
               <div class="d-flex sec-li">
               <div class="fas-check d-flex align-center justify-content-center"><i class="fas text-white fa-check"></i></div>
                     <li class="new-sec-li">Best Instant Price</li>
                  </div>
               <div class="d-flex sec-li">
               <div class="fas-check d-flex align-center justify-content-center"><i class="fas text-white fa-check"></i></div>
                     <li class="new-sec-li">Choose Your Date & Time</li>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <img src="assets/images/laptop.png" class="img-fluid w-100">
         </div>
      </div>
   </div>
</section>
<!-- Tell about Moving Section End-->
<!-- Reviews Slider section Start-->
<section class="reviews_slider_wrapper">
   <div class="sec_heading">
      <h3 class="text-center"><span class="circle_icon"></span>Our excellent reviews and counting on google</h3>
   </div>
   <div class="owl_container">
      <div class="owl-carousel">
         <div class="owl_item text-center ">
            <div class="review-card">
               <div class="user-text">
                  <h3>Megan Easdon</h3>
                  <p>Great price for a Fast Friendly Service</p>
               </div>
               <div class="review-stars">
                  <img src="<?= base_url('assets/uploads/stars.png')?>" class="mx-auto" style="width:107px;height:19px;">
               </div>
               <div class="review-detail">
                  <p>Great price for a fast friendly service! Office removal was done efficiently & with a smile. Would highly recommend - great work guys!</p>
               </div>
            </div>
         </div>
         <div class="owl_item text-center  box_shadow">
            <div class="review-card">
               <div class="user-text">
                  <h3>Megan Easdon</h3>
                  <p>Great price for a Fast Friendly Service</p>
               </div>
               <div class="review-stars">
                  <img src="<?= base_url('assets/uploads/stars.png');?>" class="mx-auto" style="width:107px;height:19px;">
               </div>
               <div class="review-detail">
                  <p>Aiaku removals were a great service! They were cheap, reliable and very attentive. They stopped at 3 different locations for us and charged us a reasonable price. The service was quick and efficient! Highly recommend!</p>
               </div>
            </div>
         </div>
         <div class="owl_item text-center ">
            <div class="review-card">
               <div class="user-text">
                  <h3>Megan Easdon</h3>
                  <p>Great price for a Fast Friendly Service</p>
               </div>
               <div class="review-stars">
                  <img src="<?= base_url('assets/uploads/stars.png');?>" class="mx-auto" style="width:107px;height:19px;">
               </div>
               <div class="review-detail">
                  <p>I would say the best service I've ever had in my life. The Man Muhammad was super fast and especially very kind and polite and in less than one hour we did all the job. I need to say I'm impressed cause I know the most of the people doing this job sometimes...</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Reviews Slider section End-->

<!-- image gallery section Start -->
<section class="image_gallery  wow slideInUp" data-wow-duration="1s">
   <div class="row mx-0 mb-4">
      <div class="header_carousel text-center w-100">
         <h3><span class="circle_icon"></span>You would find us doing all sorts of removals </h3>
      </div>
      <!-- <div id="myModal" class="modal_gallery  col-md-8 mx-auto">
         <div class="modal_content">
            <div class="mySlides" style="display: block;">
               <div class="w-100 slide_gallery" style="background:url('background-image:url(<?= base_url("assets/uploads/van_slide.jpg");?>)');background-repeat:no-repeat;">
               </div>
            </div>
            <div class="mySlides">
               <div class="w-100 slide_gallery" style="background:url('<?= base_url("assets/uploads/slide_box.png");?>');background-repeat:no-repeat;">
               </div>
            </div>
            <div class="mySlides">
               <div class="w-100 slide_gallery" style="background:url('<?= base_url("assets/uploads/delivery_box.png");?>');background-repeat:no-repeat;">
               </div>
            </div>
            <div class="mySlides">
               <div class="w-100 slide_gallery" style="background:url('<?= base_url("assets/uploads/van_loading.jpg");?>');background-repeat:no-repeat;">
               </div>
            </div>
         </div>
         <div class="swipe_div position-relative w-100 my-3">
            <div class="d-flex  gallery_indicator w-100">
               <div class="column col-6 col-md-4 col-lg-3">
                  <div class="demo cursor " style="width:100%; background:url('<?= base_url("assets/uploads/van.png");?>');background-repeat:no-repeat;" onclick="currentSlide(1)"></div>
               </div>
               <div class="column col-6 col-md-4 col-lg-3">
                  <div class="demo cursor " style="width:100%; background:url('<?= base_url("assets/uploads/coverd_box.png");?>');background-repeat:no-repeat;" onclick="currentSlide(2)"></div>
               </div>
               <div class="column col-6 col-md-4 col-lg-3">
                  <div class="demo cursor " style="width:100%; background:url('<?= base_url("assets/uploads/small_box.png");?>');background-repeat:no-repeat;" onclick="currentSlide(3)"></div>
               </div>
               <div class="column col-6 col-md-4 col-lg-3 ">
                  <div class="demo cursor " style="width:100%; background:url('<?= base_url("assets/uploads/van_load.png");?>');background-repeat:no-repeat;" onclick="currentSlide(4)"></div>
               </div>
               <div class="column col-6 col-md-4 col-lg-3 ">
                  <div class="demo cursor " style="width:100%; background:url('<?= base_url("assets/uploads/van_load.png");?>');background-repeat:no-repeat;" onclick="currentSlide(4)"></div>
               </div>
               <div class="column col-6 col-md-4 col-lg-3 ">
                  <div class="demo cursor " style="width:100%; background:url('<?= base_url("assets/uploads/van.png");?>');background-repeat:no-repeat;" onclick="currentSlide(1)"></div>
               </div>
            </div>
         </div>
      </div> -->
      <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:480px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src='<?= base_url("assets/images/spin.svg");?>'/>
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:480px;overflow:hidden;">
            <div>
                <img data-u="image" src="<?= base_url("assets/uploads/van_slide.jpg");?>" />
                <img data-u="thumb" src="<?= base_url("assets/uploads/van_slide.jpg");?>" />
            </div>
            <div>
                <img data-u="image" src="<?= base_url("assets/uploads/slide_box.png");?>" />
                <img data-u="thumb" src="<?= base_url("assets/uploads/slide_box.png");?>" />
            </div>
            <div>
                <img data-u="image" src="<?= base_url("assets/uploads/van_loading.jpg");?>" />
                <img data-u="thumb" src="<?= base_url("assets/uploads/van_loading.jpg");?>" />
            </div>
        </div>
        <!-- Thumbnail Navigator -->
        <div data-u="thumbnavigator" class="jssort101" style="position:absolute;left:0px;bottom:0px;width:980px;height:100px;background-color:rgb(0 0 0 / 39%);" data-autocenter="1" data-scale-bottom="0.75">
            <div data-u="slides">
                <div data-u="prototype" class="p" style="width:190px;height:90px;">
                    <div data-u="thumbnailtemplate" class="t"></div>
                    <svg viewbox="0 0 16000 16000" class="cv">
                        <circle class="a" cx="8000" cy="8000" r="3238.1"></circle>
                        <line class="a" x1="6190.5" y1="8000" x2="9809.5" y2="8000"></line>
                        <line class="a" x1="8000" y1="9809.5" x2="8000" y2="6190.5"></line>
                    </svg>
                </div>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora106" style="width:55px;height:55px;top:162px;left:30px;" data-scale="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="6260.9"></circle>
                <polyline class="a" points="7930.4,5495.7 5426.1,8000 7930.4,10504.3 "></polyline>
                <line class="a" x1="10573.9" y1="8000" x2="5426.1" y2="8000"></line>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora106" style="width:55px;height:55px;top:162px;right:30px;" data-scale="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="6260.9"></circle>
                <polyline class="a" points="8069.6,5495.7 10573.9,8000 8069.6,10504.3 "></polyline>
                <line class="a" x1="5426.1" y1="8000" x2="10573.9" y2="8000"></line>
            </svg>
        </div>
    </div>
    <script type="text/javascript">jssor_1_slider_init();
    </script>
   </div>
   <div class="contact-card d-none d-lg-block position-fixed deactivate-contact">
      <div class="w-100">
         <div class="d-flex flex-wrap contact-card-container bg-white">
            <div class="col-3">
            <div class="phonering-alo-phone phonering-alo-green phonering-alo-show" id="phonering-alo-phoneIcon">
               <div class="phonering-alo-ph-circle"></div>
                  <div class="phonering-alo-ph-circle-fill"></div>
                  <a href="tel:0141-390-8967" class="pps-btn-img">
                  <div class="phonering-alo-ph-img-circle"></div>
                  </a>
               </div>
            </div>
            <div class="col-9 d-flex align-center"><p class="head-phone-text w-100 text-center"><a href="tel:0141-390-8967" class="text-decoration-none p-0 scot-blue">0141-390-8967</a></p></div>
         </div>
      </div>
   </div>
</section>
  <!-- image gallery section End-->
  <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&extension=.js&key=AIzaSyCAQxRGo3kiHw9CBikEzmWtzrz1Lsz88Pk"></script>
<script>
localStorage.clear();
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
         if($('#drop').val()==""){
            $('#drop').focus();
         }
         else{
            getPrices();
         }
       });
       autocomplete1 = new google.maps.places.Autocomplete(
           document.getElementById('drop'),
           options,
           { types: ['geocode'] });
       google.maps.event.addListener(autocomplete1, 'place_changed', function() {
         if($('#pickup').val()==""){
            $('#pickup').focus();
          
        }
        else{
         getPrices();
        }
       });
   }
   
   $(window).ready(initializee());

   function getPrices(){
      var storage_id=0;
      var pickup = $("#pickup").val();
      var drop = $("#drop").val();
      var id = $("#select_moving span:first-child").attr('data-slug');
      var link = "";
      if(id == 0 || id == "0"){
            swal(
            'Empty',
            'Please Select Category',
            'warning'
            );
         return;
      }
      if(id == 1 || id == "1"){
          link = "house_removal";
      }else if(id == 2 || id == "2"){
        link = "office_removal";
      }else if(id == 3 || id == "3"){
        link = "furniture_delivery";
      }
      else if(id == 4 || id == "4"){
        link = "piano_removal";
      }
      else if(id == 5 || id == "5"){
        link = "man_and_van";
      }
      // localStorage.setItem("pickup",pickup);
      // localStorage.setItem("drop",drop);
      if(pickup != "" && drop != "" )
      {
         $.ajax({
               type: "GET",
               url: '<?php echo base_url('shop/save_storage'); ?>',
               dataType: 'json',
               data: {'pickup': pickup, 'drop': drop , 'storage_id':0},
               beforeSend: function() {
                $('.button-spinner').show();
                $('.price_btn').attr('disabled', 'disabled');
               },
               success:function(data)
               {
                  if(data)
                  {
                     $('.button-spinner').hide();
                     window.location.href = $("#base_url").val()+"shop/"+link+"/"+data;
                  }
               }
         });
      }
      else{
        $('.button-spinner').show();
        window.location.href = $("#base_url").val()+"shop/"+link;
      }
   //    if(pickup != "" && drop != ""){
   //       $.ajax({
   //             type: "GET",
   //             url: '<?php echo base_url('shop/set_locations'); ?>',
   //             dataType: 'json',
   //             data: {'pickup': pickup, 'drop': drop},
   //             success: function(data) {
   //                if(id ==0 )
   //                {
   //                window.location.href = $("#base_url").val()+"shop/"+link;
   //                }
   //                else
   //                {
   //                   window.location.href = $("#base_url").val()+"shop/"+link+"/"+id ;
   //                }
   //             },
   //             error: function(data) { alert('Ajax call failed'); }
   //       });
   //    }else{
   //      window.location.href = $("#base_url").val()+"shop/"+link;
   //    }
    }
</script>