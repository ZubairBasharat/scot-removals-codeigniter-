<?php defined('BASEPATH') OR exit('No direct script access allowed');
$type = !empty($storage) ?$storage->type : "";
$total = 0;
$slug = $storage->slug;
$check_slug = strtok($slug, '_');
$products = !empty($storage) ? json_decode($storage->products_list) : array();
$storage_id = !empty($storage) ? $storage->id : 0;
$price = $storage->price+$storage->km;
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
?>
<!-- Banner Section Start -->
<style>

</style>
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
                        <!-- <div class="d-flex  align-center not-benifits">
                           <img class="svg" src="<?php echo base_url('assets/images/card-icon.svg');?>">
                           <p class="price_list_p ml-2 mb-0">Free Updates</p>
                        </div>
                        <div class="d-flex  align-center not-benifits">
                           <img class="svg" src="<?php echo base_url('assets/images/card-icon.svg');?>">
                           <p class="price_list_p ml-2 mb-0">Get all minor updates for free</p>
                        </div>
                        <div class="d-flex i-benifits">
                           <img class="svg" src="<?php echo base_url('assets/images/card-icon.svg');?>">
                           <p class="price_list_p ml-2 mb-0">Custom modifications</p>
                        </div> -->
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
                        <!-- <div class="d-flex i-benifits">
                           <img class="svg" src="<?php echo base_url('assets/images/card-icon.svg');?>">
                           <p class="price_list_p ml-2 mb-0">Full Packing Service</p>
                        </div>
                        <div class="d-flex i-benifits">
                           <img class="svg" src="<?php echo base_url('assets/images/card-icon.svg');?>">
                           <p class="price_list_p ml-2 mb-0">All Packing materiald</p>
                        </div> -->
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
               <!-- <div class="extra-service-text position-relative mt-4 ml-3">
                  <p class="extra-service-heading">You can add extra service on the next step</p>
                  <p class="font-weight-bold mb-0"><i>For Example:</i></p>
                  <p class="extra-service-links"><a href="<?= base_url('shop/extra_services/'.$storage->id);?>" class="ml-0 extra-service-links-1">Dismantling and reassembling</a>  <a href="<?= base_url('shop/extra_services/'.$storage->id);?>"  class="extra-service-links-2">Packing Service</a>  <a href="<?= base_url('shop/extra_services/'.$storage->id);?>">Packaging Material</a></p>
               </div> -->
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
               <!-- <div class="extra-service-text position-relative mt-4 ml-3">
                  <p class="extra-service-heading">You can add extra service on the next step</p>
                  <p class="font-weight-bold mb-0"><i>For Example:</i></p>
                  <p class="extra-service-links"><a href="<?= base_url('shop/extra_services/'.$storage->id);?>" class="ml-0 extra-service-links-1">Dismantling and reassembling</a>  <a href="<?= base_url('shop/extra_services/'.$storage->id);?>"  class="extra-service-links-2">Packing Service</a>  <a href="<?= base_url('shop/extra_services/'.$storage->id);?>">Packaging Material</a></p>
               </div> -->
            </div>
            <div class="map-container">
               <div id="map" class="w-100 h-100 h-lg-50 mt-3 mt-lg-0"></div> 
            </div>
            <div class="tabs_sec cart  pb-0 px-0 bg-white item_counter_box mt-0 mt-lg-4 mt-3">
               <div class="item_header pb-3 pt-2">
                  <h3>My Item List<span id="items_length" style="font-size: 20px;"></span></h3>
               </div>
               <div class="counter-body">
               </div>  
               <div id="extra_services_container" style="display: none;">
                  <div class="py-2 item_inner_header">
                     <span>Extra Services Items</span>
                  </div>
                  <div class="counter-body-extraservices">
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
                  <P class="mb-3"><?= $storage->pickup_location ?></p>
                  <input type="hidden" id="pickup" value="<?= $storage->pickup_location ?>">
                  <span class="privacy-1h">Drop Off Location</span>
                  <input type="hidden" id="drop" value="<?= $storage->drop_location ?>">
                  <P class="mb-0"><?= $storage->drop_location ?></p>
               </div> 
            </div>

         </div>
      </div>
   </div>
</section>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&extension=.js&key=AIzaSyCAQxRGo3kiHw9CBikEzmWtzrz1Lsz88Pk"></script>
<script>
// localStorage.removeItem("extra_service");
      // if(localStorage.getItem("pickup")!=null)
      // {
      //    $("#pickup").val(localStorage.getItem("pickup"));
      // }
      // if(localStorage.getItem("drop")!=null)
      // {
      //    $("#drop").val(localStorage.getItem("drop"));
      // }
      $(document).on('change', '#pickup, #drop', function(){
         field_id = $(this).attr('id');
         setTimeout(function(){
            if($("#pickup").val() != "" && $("#drop").val() != ""){
               initMap($("#pickup").val(), $("#drop").val());
            }
         }, 1000);
         if(field_id=="pickup" && $('#drop').val()==""){
            $('#drop').focus();
         }else if(field_id=="drop" && $('#pickup').val()==""){
            $('#pickup').focus();
         }
      });
      $(document).ready(function(){
         // var pickup = localStorage.getItem('pickup');
         // var drop = localStorage.getItem('drop');
         // initMap(pickup, drop);
      // if(localStorage.getItem('type')=="piano")
      // {
      //    if(localStorage.getItem("piano_nam")!=null) 
      //    {
      //       $('.first_row').remove();
      //       $(".tabs_sec .counter-body").append('<div class="items_counter mb-1px" data-id='+localStorage.getItem('piano_id')+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+localStorage.getItem('piano_id')+'><p data-id = "data-id='+localStorage.getItem('piano_id')+'">'+ localStorage.getItem("piano_nam") +'</p></div><div class="add_counter h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input readonly class="item_catagory_value'+localStorage.getItem('piano_id')+'" type="text" value="1" data-item="1"></li><li class="h-100 d-flex align-center"><button class="h-100 border-0 px-2 bg-silver d-flex align-center" data-toggle="modal" data-target="#add_item_modal"><img src="<?php echo base_url();?>assets/images/edit.svg" style="width:19px;"></button></li></ul></div></div></div>');
      //    }
      // }
      // if(localStorage.getItem('type')=="furniture")
      // {
      //    if(localStorage.getItem('furniture')!=null)
      //    {
      //       var furniture = JSON.parse(localStorage.getItem('furniture'));
      //       var counter = 0;
      //       $.each(furniture , function(index,value){
      //             $('.first_row').remove();
      //             $(".tabs_sec .counter-body").append('<div class="items_counter mb-1px" data-id='+furniture[counter].id+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+furniture[counter].id+'><p data-id = "data-id='+furniture[counter].id+'">'+ furniture[counter].name +'</p></div><div class="add_counter h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input readonly class="item_catagory_value'+furniture[counter].id+'" type="text" value="'+ furniture[counter].quantity +'" data-item="1"></li><li class="h-100 d-flex align-center"><button class="h-100 border-0 px-2 bg-silver d-flex align-center" data-toggle="modal" data-target="#add_item_modal"><img src="<?php echo base_url();?>assets/images/edit.svg" style="width:19px;"></button></li></ul></div></div></div>');
      //             counter++;
      //       });
      //    }
      // }
      totsl_items = 0;
     " <?php if(!empty($products)){ foreach($products as $product){ ?>"
         counter = 0;
            $('.first_row').remove();
            "<?php if($product->type=="extra_services"){?>"
               $("#extra_services_container").css("display","block");
            $(".tabs_sec .counter-body-extraservices").append('<div class="items_counter list_counter_right item_row'+<?= $product->id ?>+' mb-1px" data-id='+"<?= $product->id ?>"+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+'><p class="item_name'+"<?= $product->id ?>"+'" data-id = "data-id='+"<?= $product->id ?>"+'">'+ "<?= $product->name ?>" +'</p><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input class="item_catagory_value<?= $product->quantity?>" readonly type="number" value="<?= $product->quantity?>" onchange="change_qty(<?= $product->quantity?>)" data-item="<?= $product->quantity?>"></li></ul></div></div></div></div>');
            "<?php } else{ ?>"
            $(".tabs_sec .counter-body").append('<div class="items_counter list_counter_right item_row'+<?= $product->id ?>+' mb-1px" data-id='+"<?= $product->id ?>"+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+'><p class="item_name'+"<?= $product->id ?>"+'" data-id = "data-id='+"<?= $product->id ?>"+'">'+ "<?= $product->name ?>" +'</p><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input class="item_catagory_value<?= $product->quantity?>" readonly type="number" value="<?= $product->quantity?>" onchange="change_qty(<?= $product->quantity?>)" data-item="<?= $product->quantity?>"></li></ul></div></div></div></div>');
            "<?php } ?>"
            counter++;
            totsl_items += parseInt("<?= $product->quantity?>");
            " <?php }} ?>"
         $('#items_length').text(" ("+totsl_items+")");
      // if(localStorage.getItem('type')=="office")
      // {
      //    if(localStorage.getItem('office')!=null)
      //    {
      //       var office = JSON.parse(localStorage.getItem('office'));
      //       office_counter = 0;
      //       $.each(office,function(index,value){
      //             $('.first_row').remove();
      //             $(".tabs_sec .counter-body").append('<div class="items_counter mb-1px" data-id='+office[office_counter].id+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+office[office_counter].id+'><p data-id = "data-id='+office[office_counter].id+'">'+ office[office_counter].name +'</p></div><div class="add_counter h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input readonly class="item_catagory_value'+ office[office_counter].id +'" type="text"  data-item="1" value="'+ office[office_counter].quantity +'"></li><li class="h-100 d-flex align-center"><button class="h-100 border-0 px-2 bg-silver d-flex align-center" data-toggle="modal" data-target="#add_item_modal"><img src="<?php echo base_url();?>assets/images/edit.svg" style="width:19px;"></button></li></ul></div></div></div>');
      //             office_counter++;
      //       });
      //    }
      // }
      // if(localStorage.getItem('type')=="house")
      // {
      //    if(localStorage.getItem('home')!=null)
      //    {
      //       var home = JSON.parse(localStorage.getItem('home'));
      //       home_counter = 0;
      //       $.each(home,function(index,value){
      //             $('.first_row').remove();
      //             $(".tabs_sec .counter-body").append('<div class="items_counter mb-1px" data-id='+home[home_counter].id+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+home[home_counter].id+'><p data-id = "data-id='+home[home_counter].id+'">'+home[home_counter].name+'</p></div><div class="add_counter h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input readonly class="item_catagory_value'+home[home_counter].id+'" type="text" value="'+ home[home_counter].quantity +'" data-item="1"></li><li class="h-100 d-flex align-center"><button class="h-100 border-0 px-2 bg-silver d-flex align-center" data-toggle="modal" data-target="#add_item_modal"><img src="<?php echo base_url();?>assets/images/edit.svg" style="width:19px;"></button></li></ul></div></div></div>');
      //             home_counter++;
      //       });
      //    }
      // } 
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
               suppressMarkers: true
            });
         var directionsService = new google.maps.DirectionsService;
         var map = new google.maps.Map(document.getElementById('map'), {
            // zoom: 20,
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
      function get_prices(service)
      {
         var price = '<?= $storage->total ?>';
         var boox_price = '<?= $box_price ?>';
         var total = 0;
         if($.trim(service)=="standard")
         {
           total = parseFloat(price);
         }else if($.trim(service)=="premium"){
            total =parseFloat(price)+parseFloat(boox_price);
         }
         var pickup = $("#pickup").val();
         var drop = $("#drop").val();
         $.ajax({
            type: "GET",
            url: '<?php echo base_url('shop/save_storage'); ?>',
            dataType: 'json',
            data: { 'pickup': pickup, 'drop': drop , 'storage_id': "<?= $storage_id ?>", 'type': '<?=!empty($storage) ? $storage->type : ''?>', 'slug': '<?=!empty($storage) ? $storage->slug : ''?>', 'price': '<?=!empty($storage) ? $storage->price : 0?>', 'km': '<?=!empty($storage) ? $storage->km : 0?>', 'total': total  },
            beforeSend: function () {
               $('#scr_c_loader').show();
               // $('body').addClass("overflow-hidden");
            },
           success: function(data) {
              if(service=='standard')
              {
                 window.location.href = '<?= base_url('shop/extra_services/'.$storage_id);?>';
              }
              else if(service=='premium')
              {
               window.location.href = '<?= base_url('shop/price_options/'.$storage_id);?>';
              }  
           },
           error: function(data) { alert('Ajax call failed'); }
         });
      }
  
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