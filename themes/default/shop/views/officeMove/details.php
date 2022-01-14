<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $selected_products = !empty($storage) ? json_decode($storage->products_list) : array(); ?>
<!-- Banner Section Start -->
<?php
if(!empty($storage)){
    $slug = $storage->slug;
    $type = $storage->type;
}else{
    $slug = "ground_to_ground";
    $type = "office_removal";
}
?>
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
<script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAQxRGo3kiHw9CBikEzmWtzrz1Lsz88Pk"></script>
<script>

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
            // <li><button class="fa mr-1 fa-trash delete_item_trash "></button></li>
            $(".target_add_input").append('<div class="c_ui_add items_counter o_category'+<?= $product->id ?>+'"><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+' id="counter_' +"<?= $product->id ?>"+ '"><p><span class="item_title">' +"<?= $product->name?>"+ '</span> <span class="fa fa-plus ml-auto mr-3 item_category_add'+"<?= $product->id ?>"+'"></span></p></div><div class="add_counter counter_' +"<?= $product->id ?>"+ '" style="display: none;"><ul class="d-table-cell-child" data-item="1" data-id="<?= $product->id ?>"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+"<?= $product->id ?>"+')"></button></li><li><input onchange="change_qty(<?= $product->id ?>,this)" class="item_catagory_value" type="text" id="item_val_'+"<?= $product->id ?>"+'" data-id="0" value="'+"<?= $product->quantity?>"+'" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+"<?= $product->id ?>"+')"></button></li></ul></div></div></div><input type="hidden" id="tab<?= $product->id ?>" value="<?= $product->tab ?>"><input type="hidden" id="type<?= $product->id ?>" value="<?= $product->type ?>">');
         }
      "<?php } ?>"
      $('.items_counter.first_row').hide();
      <?php if($product->type=="extra_services" && $product->tab==$storage->type){ ?>
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
         // current_office_removals_obj = {"name":"<?= $product->name?>", "id":"<?= $product->id ?>", "quantity":"<?= $product->quantity?>", "tab":"null", "type": "<?= $product->type?>"};
         // current_office_removals.push(current_office_removals_obj);
         counter++;
 "<?php }}} ?>"
 $('#items_length').text(" ("+totsl_items+")");
// if(localStorage.getItem('current_office_removals')!=null)
//    {
//       var current_office_removals_items = JSON.parse(localStorage.getItem('current_office_removals'));
//       var counter = 0;
//       $.each(current_office_removals_items , function(index,value){
//          if(current_office_removals_items[counter].quantity >=1)
//          {
//             var append = true;
//              var next = 0;
//             $(".item_catagory_inner ").each(function(){
//             var a = $(".item_catagory_inner").eq(next).attr("data-id");
//                if(a==current_office_removals_items[counter].id)
//                {
//                   append = false;
//                   return false;
//                }
//                else
//                {
//                   append = true;
//                }
//                next++;
//          });
//          if(append)
//          {
//             $(".target_add_input").append('<div class="c_ui_add items_counter o_category"><div class="item_catagory"><div class="item_catagory_inner" data-id='+current_office_removals_items[counter].id+' id="counter_' + current_office_removals_items[counter].id + '"><p><span class="item_title">' + current_office_removals_items[counter].name + '</span> <span class="fa fa-plus ml-auto mr-3 item_category_add'+current_office_removals_items[counter].id+'"></span></p></div><div class="add_counter counter_' + current_office_removals_items[counter].id + '" style="display: none;"><ul class="d-table-cell-child" data-item="1" data-id="1"><li><button class="fa mr-1 fa-trash delete_item_trash "></button></li><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+current_office_removals_items[counter].id+')"></button></li><li><input onchange="change_qty('+current_office_removals_items[counter].id+')" class="item_catagory_value" type="text" id="item_val_'+current_office_removals_items[counter].id+'" data-id="0" value="'+current_office_removals_items[counter].quantity+'" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+current_office_removals_items[counter].id+')"></button></li></ul></div></div></div>');
//          }
//          $(".item_catagory_inner_list").append('<div class="items_counter_list'+current_office_removals_items[counter].id+' all_items mb-1px" data-id='+current_office_removals_items[counter].id+' ><div class="item_catagory"><div class="item_catagory_inner"><p class="item_name'+current_office_removals_items[counter].id+'" >'+ current_office_removals_items[counter].name +'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty()"></button></li><li class="h-100 d-flex align-center"><input class="item_catagory_value'+current_office_removals_items[counter].id+'" type="number" value="'+ current_office_removals_items[counter].quantity +'" onchange="chnage_quantity('+ current_office_removals_items[counter].id+')" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty(65)"></button></li></ul></div></div></div>');
//          $(".counter_"+current_office_removals_items[counter].id).css("display","block");
//          $(".item_category_add"+current_office_removals_items[counter].id).css("display","none");
//          $("#item_val_"+current_office_removals_items[counter].id).val(current_office_removals_items[counter].quantity);
//          $(".products"+current_office_removals_items[counter].id).removeAttr('onclick');
//          $("#item_val_"+current_office_removals_items[counter].id).attr('data-id',1);
//          current_office_removals_obj = {"name":current_office_removals_items[counter].name , "id":current_office_removals_items[counter].id , "quantity":current_office_removals_items[counter].quantity};
//         current_office_removals.push(current_office_removals_obj);
//         localStorage.setItem('current_office_removals', JSON.stringify(current_office_removals));
//          counter++;
//          }
//       });
//    }
function getPrices(){
    var main = $(".target_add_input");
    var slug = "<?=$slug?>";
    var sub = $(main).find('.items_counter');
    let ids = [];
    let qtys = [];
    let office = [];
    var i = 0;
    var next = 0;
    var check_item = false;
    localStorage.setItem('type', "office");
    // $.each(sub, function( index, value ) {
        // var name = $(value).find('p').text();
        // var id = $(value).find('p').find('.item_title').attr('data-id');
        // var qty = $(value).find('ul').find('.item_catagory_value').val();
        // if(qty > 0){
            // // ids[i] = [id, qty];
            // ids.push(id);
            // qtys.push(qty);
            // }
        // i++;
    // });
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
   //  localStorage.setItem('office', JSON.stringify(office));
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
            if(data[0] != null){
                // alert(data[0].price);
                var service = new google.maps.DistanceMatrixService;
                service.getDistanceMatrix({
                origins: ['<?=$storage->pickup_location?>'],
                destinations: ['<?=$storage->drop_location?>'],
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
                           //  $.ajax({
                           //       type: "GET",
                           //       url: '<?php echo base_url('shop/set_prices'); ?>',
                           //       dataType: 'json',
                           //       data: {'price': amount, 'type': "office_removal"},
                           //       success: function(data) {
                           //          window.location.href = '<?=base_url('shop/prices/'.$storage->id)?>';
                           //       },
                           //       error: function(data) { alert('Ajax call failed'); }
                           //  });
                     }
                  }
                  $.ajax({
                        type: "GET",
                        url: '<?php echo base_url('shop/save_storage'); ?>',
                        dataType: 'json',
                        data: {'slug': '<?= !empty($storage) ? $storage->slug : '' ?>', 'type': "office_removal", 'pickup': '<?= !empty($storage) ? $storage->pickup_location : '' ?>', 'drop': '<?= !empty($storage) ? $storage->drop_location : '' ?>' , 'storage_id': '<?= !empty($storage) ? $storage->id : '' ?>', 'price': price, 'km': km, 'total': amount , 'items' : office},
                        success:function(data)
                        {
                           $('.button-spinner').hide();
                           // window.location.href = '<?php //base_url('shop/prices/')?>'+data;
                           window.location.href = '<?= base_url('shop/extra_services/');?>'+data;
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
}
// below functions are for map 
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
      initMap("<?=$storage->pickup_location?>", "<?=$storage->drop_location?>")
   });
   // For Map end
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
      // current_office_removals_obj = {"name":product , "id":id , "quantity":1, "tab":"null", "type": "office_removals"};
      //   current_office_removals.push(current_office_removals_obj);
      //   localStorage.setItem('current_office_removals', JSON.stringify(current_office_removals));
      update_items();
   }
   else
   {
      $("#add_more").val("");  
       $(".products_list").remove();
      //  Swal.fire({
      //       icon: 'success',
      //       title: 'Item Added',
      //       text:' Item added Successfully'
      //   });
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
      //    current_office_removals_obj = {"name":name , "id":id , "quantity":$(".item_catagory_value"+id).val(), "tab":tab, "type": type};
      //   current_office_removals.push(current_office_removals_obj);
      //   localStorage.setItem('current_office_removals', JSON.stringify(current_office_removals));
      update_items();
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
   //  current_office_removals_obj = {"name":item_name , "id":id , "quantity":1, "tab":"null", "type": "office_removals"};
   //  current_office_removals.push(current_office_removals_obj);
   //  localStorage.setItem('current_office_removals', JSON.stringify(current_office_removals));
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
         // current_office_removals_obj = {"name":name , "id":id , "quantity":count, "tab":"null", "type": "office_removals"};
         // current_office_removals.push(current_office_removals_obj);
         // localStorage.setItem('current_office_removals', JSON.stringify(current_office_removals));
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
            // current_office_removals_obj = {"name":name , "id":id , "quantity":$(".item_catagory_value"+id).val(), "tab":tab, "type": type};
            // current_office_removals.push(current_office_removals_obj);
         }   
        update_items();
        check_items_forempty();
      //   localStorage.setItem('current_office_removals', JSON.stringify(current_office_removals));
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
      //    current_office_removals_obj = {"name":name , "id":id , "quantity":$(".item_catagory_value"+id).val(), "tab":tab, "type": type};
      //   current_office_removals.push(current_office_removals_obj);
         }
        update_items();
        check_items_forempty();
      //   localStorage.setItem('current_office_removals', JSON.stringify(current_office_removals));
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
      // var extra_services = true;
      //    var total_items = 0;
      //    var next = 0;
      //    $.each(current_office_removals , function(index,value){
      //      total_items += parseInt(current_office_removals[next].quantity);
          
      //      next++;
      //    });
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
   $(document).on('click', '.delete_item_trash', function() {
        var parent = $(this).parent().parent().parent().parent().parent();
        var id = $(this).parent().parent().attr('data-id');
        var item_name = $(this).parent().parent().parent().parent().find('.item_title').text();
         swal({
               title: "Are you sure?",
               text: "Once deleted, you will not be able to recover this imaginary Product!",
               icon: "warning",
               buttons: true,
               closeOnClickOutside: false,
               dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                  swal("Deleted", {
                     icon: "success",
                     button: false,
                     timer: 2000
                  });
               $(parent).find('.item_catagory_value').val(null);
               parent.remove();
               $(".items_counter_list"+id).remove();
               var cuerrent_items= 0;
               $.each(current_office_removals , function(index,value){
                  if(current_office_removals[cuerrent_items].id==id)
                  {
                     current_office_removals.splice(cuerrent_items,1);
                     return false;
                  }
                  cuerrent_items++;
               });
               update_items(current_office_removals);
            }
         });
      });
</script>