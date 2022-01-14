<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Banner Section Start -->
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<section class=" banner_main site_c_banner">
   <div class="site_banner p-0" style="background:none;">
      <div class="row m-0">
         <div class="col-lg-8 col-md-12 pr-lg-4 pl-0 wow slideInLeft pr-0" data-wow-duration="1.5s">
            <div class="px-0">
               <form class="booking_details">
                  <div class="w-100 bg_drop bg-white p-lg-5 p-3">
                     <h5 class="mb-4">Your Booking Detail</h5>
                     <div class="user-input-wrp mt-0">
                        <input type="text" class="inputText"  required>
                        <span class="floating-label">Fiirst Name and Last Name</span>
                     </div>
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="user-input-wrp">
                              <input type="text" class="inputText"  required>
                              <span class="floating-label">Email Adress</span>
                           </div>
                        </div>
                        <div class="col-sm-6 target_ph_in">   
                           <div class="user-input-wrp d-flex input-group-ph">
                              <input type="number" class="inputText w-auto"  required>
                              <span class="floating-label">Phone Number</span>
                              <button class="trigger_ph_in fa fa-plus" type="button"></button>
                           </div>
                        </div>
                        <div  class="position-relative col-sm-12 mt-3" style="display: block;">
                           <label class="container_checkbox"> I am business customer
                           <input type="checkbox" id="checkbox1">
                           <span class="checkmark"></span>
                           </label>
                        </div> 
                     </div>
                  </div>   
                  <div class="col-12 px-0  bg_drop bg-white mt-3">
                     <div class="p-lg-5 p-3 row mx-0">
                        <h5 class="col-12 mb-4">Pickup address & contact details</h5>
                        <div class="col-sm-5">
                           <div class="user-input-wrp mt-0">
                              <input type="text" class="inputText"  required>
                              <span class="floating-label">Post Code</span>
                           </div>
                        </div>
                        <div class="col-sm-7">
                           <div class="w-100 main_drop_aria dop3 mx-0  banner_inner_form" id="open_drop_li_click2">
                              <div class="form_input drop_btn" id="catagory_inner2">
                                 <span class="btn_selected_text" data-id="5" data-slug="th_b_flat">Ground Floor</span>
                                 <span class="fa fa-angle-down float-right mr-3 toggle_icon"></span>
                              </div>
                              <div class="dropdown_list">
                                 <div class="dropdown_content catagory_inner2" style="display: none;">
                                    <div class="row m-0 text-center content_list_view">
                                       <div class="col-12 content_col ">
                                          <h3><span class="fa fa-home"></span></h3>
                                          <ul class="p-0 mt-3 content_detail_list">
                                                                                       <li>
                                                <span data-id="5" data-slug="ground">Ground floor</span>
                                             </li>
                                                                                       <li class="open_checkbox2">
                                                <span data-id="6" data-slug="first">1st floor</span>
                                             </li>
                                                                                       <li class="open_checkbox2">
                                                <span data-id="7" data-slug="second">2nd floor</span>
                                             </li>
                                                                                       <li class="open_checkbox2">
                                                <span data-id="8" data-slug="third">3rd floor</span>
                                             </li>
                                                                                       <li class="open_checkbox2">
                                                <span data-id="9" data-slug="fourth">4th floor</span>
                                             </li>
                                                                                    </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12">
                           <p>Enter Adress Manually</p>
                        </div>
                        <div class="col-sm-6">
                           <div class="user-input-wrp mt-0">
                              <input type="text" class="inputText"  required>
                              <span class="floating-label">Email Adress at Delivery</span>
                           </div>
                        </div>
                        <div class="col-sm-6 target_ph_in">   
                           <div class="user-input-wrp mt-0 d-flex input-group-ph">
                              <input type="number" class="inputText w-auto"  required>
                              <span class="floating-label">Phone Number at Delivery</span>
                              <button class="trigger_ph_in fa fa-plus" type="button"></button>
                           </div>
                        </div>
                     </div>   
                  </div> 
                  <div class="col-12 px-0  bg_drop bg-white mt-3">
                     <div class="p-lg-5 p-3 row mx-0">
                        <h5 class="col-12 mb-4">Delivery address & contact details</h5>
                        <div class="col-sm-5">
                           <div class="user-input-wrp mt-0">
                              <input type="text" class="inputText"  required>
                              <span class="floating-label">Post Code</span>
                           </div>
                        </div>
                        <div class="col-sm-7">
                           <div class="w-100 main_drop_aria dop3 mx-0  banner_inner_form" id="open_drop_li_click3">
                              <div class="form_input drop_btn" id="catagory_inner3">
                                 <span class="btn_selected_text" data-id="5" data-slug="th_b_flat">Adress</span>
                                 <span class="fa fa-angle-down float-right mr-3 toggle_icon"></span>
                              </div>
                              <div class="dropdown_list">
                                 <div class="dropdown_content catagory_inner3" style="display: none;">
                                    <div class="row m-0 text-center content_list_view">
                                       <div class="col-12 content_col ">
                                          <h3><span class="fa fa-home"></span></h3>
                                          <ul class="p-0 mt-3 content_detail_list">
                                             <li>
                                                <span data-id="5" data-slug="ground">Ground floor</span>
                                             </li>
                                             <li class="open_checkbox2">
                                                <span data-id="6" data-slug="first">1st floor</span>
                                             </li>
                                             <li class="open_checkbox2">
                                                <span data-id="7" data-slug="second">2nd floor</span>
                                             </li>
                                             <li class="open_checkbox2">
                                                <span data-id="8" data-slug="third">3rd floor</span>
                                             </li>
                                             <li class="open_checkbox2">
                                                <span data-id="9" data-slug="fourth">4th floor</span>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12">
                           <p>Enter Adress Manually</p>
                        </div>
                        <div class="col-sm-6">
                           <div class="user-input-wrp mt-0">
                              <input type="text" class="inputText"  required>
                              <span class="floating-label">Contact Name at Delivery</span>
                           </div>
                        </div>
                        <div class="col-sm-6 target_ph_in">   
                           <div class="user-input-wrp mt-0 d-flex input-group-ph">
                              <input type="number" class="inputText w-auto"  required>
                              <span class="floating-label">Phone Number at Delivery</span>
                              <button class="trigger_ph_in fa fa-plus" type="button"></button>
                           </div>
                        </div>
                     </div>   
                  </div>              
               </form>
            </div>
         </div>
         <div class="col-md-4 pr-0 map_container">
               <div id="map" class="w-100 h-lg-50  mb-2"></div>
         <div class="cart-items_refrence bg-white p-3">
            <div class="ref-info">
              <p class="mb-0 header-text">Your Refrence</p>
              <span>123456</span>
            </div>
            <div class="cart-item-list d-flex flex-wrap my-2">
               <p class="mb-0" id="piano_name"></p>
               <button class="border-0 bg-none ml-auto"><span>edit</span> <i class="fa fa-pen"></i></button>
            </div> 
         
         </div>
      </div>    
      </div>  
   </div> 
   
</section>    
<script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAQxRGo3kiHw9CBikEzmWtzrz1Lsz88Pk"></script>

<script>
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
         var directionsService = new google.maps.DirectionsService;
         var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: {lat: 51.5074, lng: 0.1278},
            disableDefaultUI: true,
         });
         directionsRenderer.setMap(map);
         calculateAndDisplayRoute(directionsService, directionsRenderer,map,pickup,dropup);
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
            Swal.fire({
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
      
   $(document).ready(function(){
      initMap("<?=$pickup?>", "<?=$drop?>")
   });
   
   // For Map end
   // var a = JSON.parse(localStorage.getItem('furniture'));
   // var b = 0;
   // $.each(a , function(index,value){
   //    alert(a[b].name);
   //    b++;
   // });
   </script>