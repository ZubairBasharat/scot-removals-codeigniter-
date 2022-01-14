<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $selected_products = !empty($storage) ? json_decode($storage->products_list) : array(); ?>
<!-- Banner Section Start -->

<?php
   if(null != $this->session->userdata('furniture_delivery_slug')){
       $slug = $this->session->userdata('furniture_delivery_slug');
       $type = $this->session->userdata('furniture_delivery_type');
   }else{
       $slug = "ground_to_ground";
       $type = "furniture_delivery";
   }
?>

<section class="banner_main site_c_banner">
   <div class="site_banner p-0" style="background:none;">
      <div class="row m-0">
         <div class="col-lg-8 col-md-12 pr-lg-4 pl-0 wow slideInLeft pr-0" data-wow-duration="1.5s">
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
            <div class="bg-white p-xl-5 p-3 bg_drop">
               <div class="banner_inner_text p-0">
                  <h3 class="mb-0"><span class="circle_icon"></span>Get an accurate quote in just 3 mins!</h3>
                  <p>Save up to a massive 42% moving through AnyVan</p>
               </div>
               <div class="banner_inner_form m-0">
                  <form class="row w-100 m-0">
                     <?php foreach ($products as $p) { ?>
                     <div class="col-md-4 pr-md-2 pr-0 pl-0">
                        <div class="dropdown">
                           <button class="btn py-0 align-center d-flex min-h-50 btn-dropdown dropdown-toggle" type="button" id="dropdownMenuButton<?=$p->id?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <span><img class="svg" src="<?php echo base_url('assets/uploads/'.$p->image.''); ?>"></span><span class="text-overflow-e"><?=$p->name?></span>
                           </button>
                           <div class="dropdown-menu w-fit-content" role="menu" aria-labelledby="dropdownMenuButton">
                              <?php if(!empty($p->sub_products)){ ?>
                              <?php foreach ($p->sub_products as $sp) { ?>
                                <a onclick="addProduct('<?=$sp->id?>', '<?=strlen($sp->name) > 20 ? mb_substr($sp->name, 0, 20, 'utf-8') . '...' : $sp->name?>');" class="dropdown-item" href="javascript:void(0);"><?=$sp->name?></a>
                              <?php } ?>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                     <?php } ?>
                     <div class="col-md-4 pr-sm-2 pl-0  pr-0">
                        <div class="dropdown">
                           <button class="btn btn-dropdown w-100 d-flex min-h-50 py-0 align-center" type="button" data-toggle="modal" data-target="#add_item_modal">
                           <span><img class="svg" src="<?php echo base_url('assets/uploads/more.svg'); ?>"></span>Add Your Own Item
                           </button>
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
                           <a href="<?php echo base_url();?>shop/furniture_delivery" class="back_page_btn w-100 d-flex align-items-center  text-decoration-none">
                              <span class="position-relative d-flex align-items-center w-100"><i class="fa fa-angle-left"></i><span class="mx-auto">Back</span></span>
                           </a>
                        </div>
                     </div> 
                  </form>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-12 p-0 ml-auto mt-5 mt-lg-0">
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
            <div class="tabs_sec cart px-0 bg-white item_counter_box">
               <div class="item_header pb-3 pt-2">
                  <h3>My Item List<span id="items_length" style="font-size: 20px;"></span></h3>
               </div>
               <div class="counter-body furniture-detail-list-height">
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
            <button onclick="getPrices();" href="#" class="price_btn w-100 border-0">
               Complete My Quote
            </button>
            <div class="spinner-border position-absolute text-white button-spinner" role="status" style="display:none;right:10px;top:23%;width:1.5rem;height:1.5rem;">
               <span class="sr-only">Loading...</span>
            </div>
         </div>
      </div>
   </div>
   <script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAQxRGo3kiHw9CBikEzmWtzrz1Lsz88Pk"></script>
   <script>
   let current_furniture = [];
   totsl_items = 0;
   " <?php if(!empty($selected_products)){ foreach($selected_products as $product){if($product->type=="furniture_removals" || $product->type=="extra_services"){ ?>"
      counter=0;
      $('.first_row').hide();
      <?php if($product->type=="extra_services" && $product->tab==$storage->type){ ?>
            totsl_items += parseInt("<?= $product->quantity ?>");
            $(".extra_services_container").css("display", "block");
            $('.counter-body-extra-services').append('<div class="items_counter mb-1px" id="item_container'+"<?= $product->id ?>"+'"><div class="item_catagory all_items" data-id="'+"<?= $product->id ?>"+'"><div class="item_catagory_inner" data-id = "'+"<?= $product->id ?>"+'"><p class="item_name'+"<?= $product->id ?>"+'" data-id = "'+"<?= $product->id ?>"+'">'+"<?= $product->name ?>" +'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+"<?= $product->id ?>"+')"></button></li><li class="h-100 d-flex align-center"><input class="item_catagory_value'+"<?= $product->id ?>"+'" type="number" value="'+ "<?= $product->quantity ?>" +'" onchange="chnage_quantity('+"<?= $product->id ?>"+')" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+"<?= $product->id ?>"+')"></button></li></ul></div></div></div><input type="hidden" id="tab<?= $product->id ?>" value="<?= $product->tab ?>"><input type="hidden" id="type<?= $product->id ?>" value="<?= $product->type ?>">');
      <?php } elseif($product->type!="extra_services"){ ?>
            totsl_items += parseInt("<?= $product->quantity ?>");
            $('.tabs_sec  .counter-body .category_pitem').append('<div class="items_counter mb-1px" id="item_container'+"<?= $product->id ?>"+'"><div class="item_catagory all_items" data-id="'+"<?= $product->id ?>"+'"><div class="item_catagory_inner" data-id = "'+"<?= $product->id ?>"+'"><p class="item_name'+"<?= $product->id ?>"+'" data-id = "'+"<?= $product->id ?>"+'">'+"<?= $product->name ?>" +'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+"<?= $product->id ?>"+')"></button></li><li class="h-100 d-flex align-center"><input class="item_catagory_value'+"<?= $product->id ?>"+'" type="number" value="'+ "<?= $product->quantity ?>" +'" onchange="chnage_quantity('+"<?= $product->id ?>"+')" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+"<?= $product->id ?>"+')"></button></li></ul></div></div></div><input type="hidden" id="tab<?= $product->id ?>" value="<?= $product->tab ?>"><input type="hidden" id="type<?= $product->id ?>" value="<?= $product->type ?>">');
      <?php } ?>
            counter++;
      " <?php }}} ?>"
      $('#items_length').text(" ("+totsl_items+")");
   //  if(localStorage.getItem('current_furniture')!=null)
   // {
   //    $('.first_row').hide();
   //    var current_furniture_items = JSON.parse(localStorage.getItem('current_furniture'));
   //    var counter = 0;
   //    $.each(current_furniture_items , function(index,value){
   //       if(current_furniture_items[counter].quantity>0)
   //       {
   //          $('.tabs_sec  .counter-body .category_pitem').append('<div class="items_counter mb-1px" id="item_container'+current_furniture_items[counter].id+'"><div class="item_catagory all_items" data-id="'+current_furniture_items[counter].id+'"><div class="item_catagory_inner" data-id = "'+current_furniture_items[counter].id+'"><p class="item_name'+current_furniture_items[counter].id+'" data-id = "'+current_furniture_items[counter].id+'">'+ current_furniture_items[counter].name +'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+current_furniture_items[counter].id+')"></button></li><li class="h-100 d-flex align-center"><input class="item_catagory_value'+current_furniture_items[counter].id+'" type="number" value="'+ current_furniture_items[counter].quantity +'" onchange="chnage_quantity('+current_furniture_items[counter].id+')" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+current_furniture_items[counter].id+')"></button></li></ul></div></div></div>');
   //          current_furniture_obj = {"name":current_furniture_items[counter].name , "id":current_furniture_items[counter].id , "quantity":current_furniture_items[counter].quantity};
   //          current_furniture.push(current_furniture_obj);
   //          localStorage.setItem('current_furniture', JSON.stringify(current_furniture));
   //       }
   //       counter++;
   //    });
   // }
      $(document).ready(function(){
         $('.dropdown-toggle').dropdown();
      
      });
      function addProduct(id, name) {
        $('.first_row').hide();
        if(name.length > 20){
            name = name.substring(0, 20) + "...";
        }
        next = 0;
        var append =true;
        $(".item_catagory_inner ").each(function(){
         var a = $(".item_catagory_inner").eq(next).attr("data-id");
       if(a==id)
       {
          append = false;
          return false ; 
       }
       else
       {
          append = true;
       }
         next++;
   });
         if(append)
         {
         $('.tabs_sec .counter-body .category_pitem').append('<div class="items_counter mb-1px" id="item_container'+id+'"><div class="item_catagory all_items" data-id="'+id+'"><div class="item_catagory_inner" data-id = "'+id+'"><p class="item_name'+id+'" data-id = "'+id+'">'+ name +'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+id+')"></button></li><li class="h-100 d-flex align-center"><input class="item_catagory_value'+id+'" type="number" value="1" onchange="chnage_quantity('+id+')" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+id+')"></button></li></ul></div></div></div><input type="hidden" id="tab'+id+'" value="null"><input type="hidden" id="type'+id+'" value="furniture_removals">');
         //  current_furniture_obj = {"name":name , "id":id , "quantity":1};
         //  current_furniture.push(current_furniture_obj);
         //  localStorage.setItem('current_furniture', JSON.stringify(current_furniture));
         }
         else
         {
            var cuerrent_items = 0;
            // alert(current_furniture[cuerrent_items].quantity);
           var quantity = $(".item_catagory_value"+id).val();
           quantity++;
           $(".item_catagory_value"+id).val(quantity);
         //   $.each(current_furniture , function(index,value){
         //       if(current_furniture[cuerrent_items].id==id)
         //       {
         //          current_furniture.splice(cuerrent_items,1);
         //          return false;
         //       }
         //       cuerrent_items++;
         //    });
         //    current_furniture_obj = {"name":name , "id":id , "quantity":quantity};
         //    current_furniture.push(current_furniture_obj);
         //    localStorage.setItem('current_furniture', JSON.stringify(current_furniture));
         }
         update_items();
    }
      function getPrices(){
        var main = $(".tabs_sec");
        var slug = "<?= $storage->slug?>";
        var sub = $(main).find('.items_counter');
        let ids = [];
        let qtys = [];
        let furniture = [];
        var i = 0;
        var next = 0;
        var check_item = false;
        localStorage.setItem('type', "furniture");
        // $.each(sub, function( index, value ) {
            // var id = $(value).find('p').attr('data-id');
            // var name = $(value).find('p').text();
            // var qty = $(value).find('ul').find('.item_catagory_value'+id).val();
            // if(qty > 0)
            // {
               // // ids[i] = [id];
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
            if(type=="furniture_removals")
            {
               check_item = true;
            }
               if(product_qty > 0){
                  ids.push(product_id);
                  qtys.push(product_qty);
               }
            furniture_obj = {"name":producd_name , "id":product_id , "quantity":product_qty, "tab":"null", "type":type};
            furniture.push(furniture_obj);
            next++;
         });
      //   localStorage.setItem('furniture', JSON.stringify(furniture));
        if(furniture=="" || check_item==false)
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
            data: {'id': ids, 'qty': qtys, 'slug': slug, 'type': "furniture_delivery"},
            beforeSend: function() {
               $('.button-spinner').show();
               $('.price_btn').attr('disabled', 'disabled');
            },
           success: function(data) {
                if(data[0] != null){
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
                              // $.ajax({
                              //    type: "GET",
                              //    url: '<?php echo base_url('shop/set_prices'); ?>',
                              //    dataType: 'json',
                              //    data: {'price': amount, 'type': "furniture_delivery"},
                              //    success: function(data) {
                              //       window.location.href = '<?=base_url('shop/prices/'.$storage->id)?>';
                              //    },
                              //    error: function(data) { alert('Ajax call failed'); }
                              // });
                           }
                        }
                        $.ajax({
                              type: "GET",
                              url: '<?php echo base_url('shop/save_storage'); ?>',
                              dataType: 'json',
                              data: {'slug': '<?= !empty($storage) ? $storage->slug : '' ?>', 'type': "furniture_delivery", 'pickup': '<?= !empty($storage) ? $storage->pickup_location : '' ?>', 'drop': '<?= !empty($storage) ? $storage->drop_location : '' ?>' , 'storage_id': '<?= !empty($storage) ? $storage->id : '' ?>', 'price': price, 'km': km, 'total': amount , 'items' : furniture},
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
      
   $(document).ready(function(){
      initMap("<?=$storage->pickup_location?>", "<?=$storage->drop_location?>");
   });
   // For Map end
   function check_items_forempty(){
      var item_lle = $('.counter-body .items_counter').length;
      if(item_lle<=1){
         $('.items_counter.first_row').show();
      }
   }
   function chnage_quantity(id)
   {
      var cuerrent_items= 0;
      var quantity = $(".item_catagory_value"+id).val();
      var name = $(".item_name"+id).text();
      $(".item_catagory_value"+id).val(quantity);
      if(quantity<=0)
      {
         $("#item_container"+id).remove();
      }
         // $.each(current_furniture , function(index,value){
         //    if(current_furniture[cuerrent_items].id==id)
         //    {
         //       current_furniture.splice(cuerrent_items,1);
         //       return false;
         //    }

         //    cuerrent_items++;
         // });
         // current_furniture_obj = {"name":name , "id":id , "quantity":quantity};
         // current_furniture.push(current_furniture_obj);
         // localStorage.setItem('current_furniture', JSON.stringify(current_furniture));
         update_items();
         check_items_forempty();
   }
   function add_qty(id)
   {
      var cuerrent_items= 0;
      $(".item_catagory_value"+id).val(parseInt($(".item_catagory_value"+id).val())+1);
      var quantity = $(".item_catagory_value"+id).val();
      var name = $(".item_name"+id).text();
      //   $.each(current_furniture , function(index,value){
      //       if(current_furniture[cuerrent_items].id==id)
      //       {
      //          current_furniture.splice(cuerrent_items,1);
      //          return false;
      //       }

      //       cuerrent_items++;
      //    });
      //    current_furniture_obj = {"name":name , "id":id , "quantity":quantity};
      //    current_furniture.push(current_furniture_obj);
      //    localStorage.setItem('current_furniture', JSON.stringify(current_furniture));
      update_items();
      check_items_forempty();
   }
   function subtract_qty(id)
   {
      var cuerrent_items= 0;
      $(".item_catagory_value"+id).val(parseInt($(".item_catagory_value"+id).val())-1);
      if($(".item_catagory_value"+id).val()==0)
      {
         $("#item_container"+id).remove();
      }
      update_items();
      check_items_forempty();
      // var quantity = $(".item_catagory_value"+id).val();
      // var name = $(".item_name"+id).text();
      // $.each(current_furniture , function(index,value){
      //       if(current_furniture[cuerrent_items].id==id)
      //       {
      //          current_furniture.splice(cuerrent_items,1);
      //          return false;
      //       }

      //       cuerrent_items++;
      //    });
      //    current_furniture_obj = {"name":name , "id":id , "quantity":quantity};
      //    current_furniture.push(current_furniture_obj);
      //    localStorage.setItem('current_furniture', JSON.stringify(current_furniture));
   }
   function update_items()
   {
      var extra_services = true;
      var total_items = 0;
       var furniture = new Array();
       var next = 0;
       $(".all_items ").each(function(){
            var product_id  =  $(".all_items").eq(next).attr('data-id');
            var producd_name = $(".item_name"+product_id).text();
            var product_qty =  $(".item_catagory_value"+product_id).val();
            var type =  $("#type"+product_id).val();
            var tab =  $("#tab"+product_id).val();
            furniture_obj = {"name":producd_name , "id":product_id , "quantity":product_qty, "tab":tab, "type":type};
            furniture.push(furniture_obj);
            next++;
            total_items += parseInt(product_qty) ;
            if(type=="extra_services")
            {
               extra_services = false;
            }
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
            data: {'items' : furniture},
            success:function(data)
            {
               return;
            }
        });
   }
   </script>
</section>