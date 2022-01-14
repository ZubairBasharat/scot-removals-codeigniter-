<?php defined('BASEPATH') OR exit('No direct script access allowed');
$last = $this->uri->segment(3);
// if($last==null || $last==0)
// {
//    $this->db->where('ip_address',$this->input->ip_address())->delete('sma_storage');
//    $storage = array();
// }
$storage_id = !empty($storage) ? $storage->id : 0;
?>
<!-- Banner Section Start -->
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<section class="banner_main site_c_banner">
   <div class="site_banner p-0" style="background:none;">
      <div class="row m-0">
         <div class="col-lg-8 col-md-6 pr-md-4 pl-0 wow slideInLeft pr-0" data-wow-duration="1.5s">
            <div class="bg-white p-xl-5 p-3 bg_drop px-sm-10">
               <div class="banner_inner_text p-0">
                  <h3 class="mb-3"><span class="circle_icon "></span>Saving you money and time <span class="scot-red">Moving house is easy now<span></h3>
                  <!-- <p class="mb-3">Save up to a massive 42% moving through Scot Removals</p> -->
               </div>
               <div class="banner_inner_form m-0">
                  <form class="row w-100 m-0">
                     <div class="col-lg-6  pr-0 pl-0">
                        <!-- Dropdown 1 Start -->
                        <div class="w-100 main_drop_aria dop">
                           <div class="col-12 pr-0 pl-0">
                              <div class="user-input-wrp d-flex  location_area mt-1 flex-wrap">
                                 <input type="text" class="form_input w-100" placeholder="" value="<?php if(!empty($storage)){ echo $storage->pickup_location;}?>" required id="pickup">
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
                                 <input type="text" class="form_input w-100" placeholder="" value="<?php if(!empty($storage)){ echo $storage->drop_location;}?>"  id="drop" required>
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
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGmh2t2Z5ebO54ldM_gu4zY43i-c0iPOA"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&extension=.js&key=AIzaSyCAQxRGo3kiHw9CBikEzmWtzrz1Lsz88Pk"></script>
<script>
// if(localStorage.getItem("pickup")!=null)
// {
//    $("#pickup").val(localStorage.getItem("pickup"));
// }
// if(localStorage.getItem("drop")!=null)
// {
//    $("#drop").val(localStorage.getItem("drop"));
// }
   
   function initMap2(){
      var directionsRenderer = new google.maps.DirectionsRenderer;
      var directionsService = new google.maps.DirectionsService;
      var bounds1 = new google.maps.LatLngBounds;
      var markersArray1 = [];
      // var origin1 = pickup;
      // var destination1 = drop;
      // if(pickup == "" && drop == ""){
         // origin1 = "London, UK";
         // destination1 = "London, UK";
      // }
      // var destinationIcon1 = 'https://chart.googleapis.com/chart?' +
      //    'chst=d_map_pin_letter&chld=D|FF0000|000000';
      // var originIcon1 = 'https://chart.googleapis.com/chart?' +
      //    'chst=d_map_pin_letter&chld=O|FFFF00|000000';
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
                  //  outputDiv.innerHTML += originList[i] + ' to ' + destinationList[j] +
                  //      ': ' + results[j].distance.text + ' in ' +
                  //      results[j].duration.text + '<br>';
                  //  alert(results[j].distance.text);
                  //  kilometers = results[j].distance.text;
               }
            }
            
      }
      });
   }
   // $(document).on('change', '#pickup, #drop', function(){
   //    if($("#pickup").val() != "" && $("#drop").val() != ""){
   //       var map1 = new google.maps.Map(document.getElementById('map'), {
   //          center: {lat: -33, lng: 151},
   //          zoom: 14,
   //          disableDefaultUI: true,
   //          });
   //          // Below lines are for removing old directions
   //          var directionsDisplay = new google.maps.DirectionsRenderer();
   //          directionsDisplay.setMap(null);
   //          directionsDisplay = null;
   //       initMap($("#pickup").val(), $("#drop").val())
   //    }
   // });
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
            //   polylineOptions: {
            //     strokeColor: "red"
            //   },
               suppressMarkers: true,
               // zoom : 3,
               // preserveViewport: true
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
         initMap($("#pickup").val(), $("#drop").val())
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
      // localStorage.setItem("pickup",$("#pickup").val());
      // localStorage.setItem("drop",$("#drop").val());
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
            //   if(property1 == "o_b_house" || property1 == "t_b_house" || property1 == "th_b_house" || property1 == "fp_b_house" || property1 == "storage_unit"){
            //    slug1 = property1;   
            //   }else{
            if(!$('#checkbox1').is(':checked')){
                  slug1 = $("#catagory_inner2 span:first-child").attr('data-slug');
            }
            //   }
            //   if(property2 == "o_b_house" || property2 == "t_b_house" || property2 == "th_b_house" || property2 == "fp_b_house" || property2 == "storage_unit"){
            //    slug2 = property2;
            //   }else{
            if(!$('#checkbox2').is(':checked')){
               slug2 = $("#catagory_inner3 span:first-child").attr('data-slug');
            }
            //   }
         }
        var pickup = $("#pickup").val();
        var drop = $("#drop").val();
        var slug = slug1+"_to_"+slug2;
        $.ajax({
            type: "GET",
            url: '<?php echo base_url('shop/save_storage'); ?>',
            dataType: 'json',
            data: {'slug': slug, 'type': "house_removal",'pickup': pickup, 'drop': drop,'storage_id': "<?= $storage_id ?>"},
            beforeSend: function() {
               $('.price_btn').attr('disabled', 'disabled');
               $('.button-spinner').show();
            },
            success: function(data) {
               $('.button-spinner').hide();
               window.location.href = '<?= base_url('shop/house_removal/details/');?>'+data;
            },
            error: function(data) { alert('Ajax call failed'); }
        });
   }
</script>