<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $selected_products = !empty($storage) ? json_decode($storage->products_list) : array();
?>
<!-- Banner Section Start -->

<?php
   if(null != $this->session->userdata('house_removal_slug')){
       $slug = $this->session->userdata('house_removal_slug');
       $type = $this->session->userdata('house_removal_type');
   }else{
       $slug = "ground_to_ground";
       $type = "house_removal";
   }
?>
<style>
#searchResult{
 list-style: none;
 padding: 0px;
 width:98%;
 margin-top:5px;
 position:absolute;
 height:300px;
 overflow-y:auto;
 z-index:-1;
}

#searchResult li{
 background: #f7f7f7;
 padding: 15px;
 border:1px solid #d2d2d2;
 border-bottom:0px;
}
#searchResult li:last-child{
    border-bottom:1px solid #d2d2d2; 
}

#searchResult li:hover{
 cursor: pointer;
 background: #d2d2d2;
}

</style>

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
                     <?php $i = 0; foreach ($products as $p) { ?>
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
               <div class="instance_btn w-100 mr-sm-2 mr-0 mt-3 d-block d-lg-none position-relative">
                  <button onclick="getPrices();" href="javascript:void(0);" class="price_btn w-100 border-0">
                     View My Price
                  </button>
                  <div class="spinner-border position-absolute text-white button-spinner" role="status" style="display:none;right:10px;top:23%;width:1.5rem;height:1.5rem;">
                     <span class="sr-only">Loading...</span>
                  </div>
               </div>
            </div>
         </div>
      </div> 
   </section>
  
<script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAQxRGo3kiHw9CBikEzmWtzrz1Lsz88Pk"></script>
<script>
   let current_house_removals = [];
   var totsl_items = 0;
   " <?php if(!empty($selected_products)){ foreach($selected_products as $product){if($product->type=="house_removal" || $product->type=="extra_services"){?>"
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
            // <li><button class="fa mr-1 fa-trash delete_item_trash "></button></li>
            $(".target_add_input."+space).append('<div class="c_ui_add items_counter o_category'+<?= $product->id ?>+'"><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+' id="counter_' +"<?= $product->id ?>"+ '"><p><span class="item_title">' +"<?= $product->name?>"+ '</span> <span class="fa fa-plus ml-auto mr-3 item_category_add'+"<?= $product->id ?>"+'"></span></p></div><div class="add_counter counter_' +"<?= $product->id ?>"+ '" style="display: none;"><ul class="d-table-cell-child" data-item="1" data-id="<?= $product->id ?>"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+"<?= $product->id ?>"+')"></button></li><li><input onchange="change_qty(<?= $product->id ?>,this)" class="item_catagory_value item_val_'+"<?= $product->id ?>"+'" type="text" id="" data-id="0" value="'+"<?= $product->quantity?>"+'" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+"<?= $product->id ?>"+')"></button></li></ul></div></div></div><input type="hidden" id="tab<?= $product->id ?>" value="<?= $product->tab ?>"><input type="hidden" id="type<?= $product->id ?>" value="<?= $product->type ?>">');
         }
         <?php } ?>
         $('.items_counter.first_row').hide();
         <?php if($product->type=="extra_services" && $product->tab==$storage->type){ ?>
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
      //    current_house_removals_obj = {"name":"<?= $product->name ?>" , "id":"<?= $product->id ?>" , "quantity":"<?= $product->quantity?>" , "tab":"<?= $product->tab ; ?>","type": "house_removal"};
      //   current_house_removals.push(current_house_removals_obj);
      "<?php }}} ?>"
      $('#items_length').text(" ("+totsl_items+")");
   // if(localStorage.getItem('current_house_removals')!=null)
   // {
   //    var current_house_removals_items = JSON.parse(localStorage.getItem('current_house_removals'));
   //    var counter = 0;
   //    $.each(current_house_removals_items , function(index,value){
   //       var space = current_house_removals_items[counter].tab.split(" ")[0];
   //       var append = true;
   //       var next = 0;
   //       if(current_house_removals_items[counter].quantity >=1)
   //       {
   //          $(".item_catagory_inner ").each(function(){
   //          var a = $(".item_catagory_inner").eq(next).attr("data-id");
   //             if(a==current_house_removals_items[counter].id)
   //             {
   //                append = false;
   //                return false;
   //             }
   //             else
   //             {
   //                append = true;
   //             }
   //             next++;
   //       });
   //       if(append)
   //       {
   //          $(".target_add_input."+space).append('<div class="c_ui_add items_counter o_category"><div class="item_catagory"><div class="item_catagory_inner" data-id='+current_house_removals_items[counter].id+' id="counter_' + current_house_removals_items[counter].id + '"><p><span class="item_title">' + current_house_removals_items[counter].name + '</span> <span class="fa fa-plus ml-auto mr-3 item_category_add'+current_house_removals_items[counter].id+'"></span></p></div><div class="add_counter counter_' + current_house_removals_items[counter].id + '" style="display: none;"><ul class="d-table-cell-child" data-item="1" data-id="1"><li><button class="fa mr-1 fa-trash delete_item_trash "></button></li><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+current_house_removals_items[counter].id+')"></button></li><li><input onchange="change_qty('+current_house_removals_items[counter].id+')" class="item_catagory_value" type="text" id="item_val_'+current_house_removals_items[counter].id+'" data-id="0" value="'+current_house_removals_items[counter].quantity+'" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+current_house_removals_items[counter].id+')"></button></li></ul></div></div></div>');
   //       }
   //       $(".counter-body .category_pitem").append('<div class="items_counter_list'+current_house_removals_items[counter].id+' all_items mb-1px" data-id='+current_house_removals_items[counter].id+' ><div class="item_catagory"><div class="item_catagory_inner"><p class="item_name'+current_house_removals_items[counter].id+'" >'+ current_house_removals_items[counter].name +'</p></div><div class="add_counter list_counter-right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 list_counter_right d-flex align-center mr-2" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+current_house_removals_items[counter].id+')"></button></li><li class="h-100 d-flex align-center"><input readonly class="item_catagory_value item_catagory_value'+current_house_removals_items[counter].id+'" type="number" value="'+ current_house_removals_items[counter].quantity +'" data-item="1"></li><li class="h-100 d-flex align-center"><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+current_house_removals_items[counter].id+')"></button></li></ul></div></div></div>');
   //       $(".counter_"+current_house_removals_items[counter].id).css("display","block");
   //       $(".item_category_add"+current_house_removals_items[counter].id).css("display","none");
   //       $("#item_val_"+current_house_removals_items[counter].id).val(current_house_removals_items[counter].quantity);
   //       $(".products"+current_house_removals_items[counter].id).removeAttr('onclick');
   //       $("#item_val_"+current_house_removals_items[counter].id).attr('data-id',1);
   //       current_house_removals_obj = {"name":current_house_removals_items[counter].name , "id":current_house_removals_items[counter].id , "quantity":current_house_removals_items[counter].quantity , "tab":current_house_removals_items[counter].tab};
   //      current_house_removals.push(current_house_removals_obj);
   //      localStorage.setItem('current_house_removals', JSON.stringify(current_house_removals));
   //       counter++;
   //       }
   //    });
   // }
   var home = new Array();
   $('.nav-tabs .nav-item:nth-child(1) .nav-link').addClass('active');
   $('.tab-pane.product_tabs:nth-child(1)').addClass('active show');
   function getPrices(){
        var main = $(".tabs_sec");
        var slug = "<?=$storage->slug?>";
        var sub = $(main).find('.items_counter');
        let ids = [];
        let qtys = [];
        let home = [];
        var i = 0;
        var next = 0;
        var check_item = false;
        localStorage.setItem('type', "house");
        // $.each(sub, function( index, value ) {
         // var name = $(value).find('p').text();
            // var id = $(value).find('p').attr('data-id');
            // var qty = $(value).find('ul').find('.item_catagory_value').val();
            // if(qty > 0){
                // //  ids[i] = [id, qty];
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
         // localStorage.setItem('home', JSON.stringify(home));
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
                if(data[0] != null){
                  //   alert(data[0].price);
                  var service = new google.maps.DistanceMatrixService;
                  service.getDistanceMatrix({
                  origins: ['<?=$storage->pickup_location;?>'],
                  destinations: ['<?=$storage->drop_location;?>'],
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
                              // alert('price '+amount);
                              // $.ajax({
                              //    `  type: "GET",
                              //    url: '<?php echo base_url('shop/set_prices'); ?>',
                              //    dataType: 'json',
                              //    data: {'price': amount, 'type': "house_removal"},
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
                        data: {'slug': '<?= !empty($storage) ? $storage->slug : '' ?>', 'type': "house_removal", 'pickup': '<?= !empty($storage) ? $storage->pickup_location : '' ?>', 'drop': '<?= !empty($storage) ? $storage->drop_location : '' ?>' , 'storage_id': '<?= !empty($storage) ? $storage->id : '' ?>', 'price': price, 'km': km, 'total': amount , 'items':home},
                        success:function(data)
                        {
                           $('.button-spinner').hide();
                           window.location.href = '<?=base_url('shop/prices/')?>'+data;
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
   //  $("#add_more").keyup(function(e)
   //  {
   //      $(".products_list").remove();
   //      var active_tab = 0;
   //    var search_product = $("#add_more").val();
   //    if (e.keyCode == '40') {
         
   //    }
   //    else{
   //       if(search_product!= "")
   //    {
   //    $.ajax({
   //          type: "GET",
   //          url: '<?php echo base_url('shop/search_product'); ?>',
   //          dataType: 'json',
   //          data: {'search_product': search_product },
   //          success: function(data) {
   //             if(data != "")
   //             {
   //              $.each(data , function(index,value){ 
   //                $("#searchResult").append("<li class='products_list' onclick='add_product(&#39;"+value.name+"&#39;,&#39;"+value.id+"&#39;)'>"+value.name+"</li>");
   //              });
   //              $('#searchResult').show();
   //              $('#searchResult').css('z-index', '9');
   //             }
   //             else{
   //              $('#searchResult').hide();
   //              $('#searchResult').css('z-index', '-1');
   //             }
   //          },
   //    });
   //    }
   //    else{
   //      $('#searchResult').hide();
   //      $('#searchResult').css('z-index', '-1');
   //  }
   //  }
   // });
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
      // current_house_removals_obj = {"name":product , "id":id , "quantity":1 , "tab":tab,"type": "house_removal"};
      // current_house_removals.push(current_house_removals_obj);
      update_items();
      // localStorage.setItem('current_house_removals', JSON.stringify(current_house_removals));
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
               // $.each(current_house_removals , function(index,value){
               //    if(current_house_removals[cuerrent_items].id==id)
               //    {
               //       current_house_removals.splice(cuerrent_items,1);
               //       total_length();
               //       return false;
               //    }
               //    cuerrent_items++;
               // });
               update_items();
            }
         });
      });
      initMap("<?=$storage->pickup_location;?>", "<?=$storage->drop_location;?>");
   });
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
      // current_house_removals_obj = {"name":item_name , "id":id , "quantity":1 , "tab":tab,"type": "house_removal"};
      // current_house_removals.push(current_house_removals_obj);
      update_items();

      //   localStorage.setItem('current_house_removals', JSON.stringify(current_house_removals));
      }
      else{
         var cuerrent_items = 0;
         var count = parseInt($(".item_catagory_value"+id).val())+1 ;
         var name = $(".item_name"+id).text()
         $(".item_catagory_value"+id).val(count);
         $(".item_val_"+id).val(count);
      //    $.each(current_house_removals , function(index,value){
      //       if(current_house_removals[cuerrent_items].id==id)
      //       {
      //          current_house_removals.splice(cuerrent_items,1);
      //          return false;
      //       }
      //       cuerrent_items++;
      //    });
      //    current_house_removals_obj = {"name":item_name , "id":id , "quantity":count , "tab":tab,"type": "house_removal" };
      //   current_house_removals.push(current_house_removals_obj);
        update_items();
      //   localStorage.setItem('current_house_removals', JSON.stringify(current_house_removals));
      }
   }
   function add_qty(id)
   {
      // var tab =  $(".active.tabs").attr('data-name');
      var cuerrent_items = 0;
      var name = $(".item_name"+id).text();
      var tab = $("#tab"+id).val();
      var type = $("#type"+id).val();
     $(".item_catagory_value"+id).val(parseInt($(".item_catagory_value"+id).val())+1);
     $(".item_val_"+id).val(parseInt($(".item_val_"+id).val())+1);
   //   $.each(current_house_removals , function(index,value){
   //          if(current_house_removals[cuerrent_items].id==id)
   //          {
   //             current_house_removals.splice(cuerrent_items,1);
   //             return false;
   //          }
   //          cuerrent_items++;
   //       });
   //       current_house_removals_obj = {"name":name , "id":id , "quantity":$(".item_catagory_value"+id).val() , "tab":tab, "type": type};
   //       current_house_removals.push(current_house_removals_obj);
         update_items();
      }
   function subtract_qty(id)
   {
      // var tab =  $(".active.tabs").attr('data-name');
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
      // $.each(current_house_removals , function(index,value){
      //       if(current_house_removals[cuerrent_items].id==id)
      //       {
      //          current_house_removals.splice(cuerrent_items,1);
      //          return false;
      //       }
      //       cuerrent_items++;
      //    });
      //    if(qty>0)
      //    {
      //    current_house_removals_obj = {"name":name , "id":id , "quantity":$(".item_catagory_value"+id).val(),"tab":tab,"type": type};
      //   current_house_removals.push(current_house_removals_obj);
      //    }
        update_items();
        check_items_forempty();
      //   localStorage.setItem('current_house_removals', JSON.stringify(current_house_removals));
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
      // var tab =  $(".active.tabs").attr('data-name');
      var cuerrent_items = 0;
      $(".item_catagory_value"+id).val(quantity);
      $(".item_val_"+id).val(quantity);
      var name = $(".item_name"+id).text();
      // $.each(current_house_removals , function(index,value){
      //       if(current_house_removals[cuerrent_items].id==id)
      //       {
      //          current_house_removals.splice(cuerrent_items,1);
      //          return false;
      //       }
      //       cuerrent_items++;
      //    });
      //    if(quantity>0)
      //    {
      //    current_house_removals_obj = {"name":name , "id":id , "quantity":quantity , "tab":tab,"type": type};
      //   current_house_removals.push(current_house_removals_obj);
      //    }
        update_items();
        check_items_forempty();
      //   localStorage.setItem('current_house_removals', JSON.stringify(current_house_removals));
   }
   
   // For Map end
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
      // $.each(current_house_removals , function(index,value){
        
      //    next++;
      //    });
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
</script>
