<?php defined('BASEPATH') OR exit('No direct script access allowed');
$products = !empty($storage) ? json_decode($storage->products_list) : array();
$storage_id = !empty($storage) ? $storage->id : 0;
$type = !empty($storage) ?$storage->type : "";
?>
<link href='<?= $assets ?>calendar/main.min.css' rel='stylesheet' />
<script src='<?= $assets ?>calendar/main.min.js'></script>
<script src='<?= $assets ?>calendar/interaction.min.js'></script>
<script src='<?= $assets ?>calendar/daygrid.min.js'></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
               <div class="text-right mt-4 mb-1">
                  <button class="edit_jobs_btn py-1 px-2 bg-none border mr-2 d-flex align-items-center ml-auto border-left" onclick="edit_job()">Edit Jobs</button>
               </div>
               <div class="edit_jb_items px-2  align-center py-3 ">
                  <div class="d-flex flex-wrap">
                     <span class="scot-blue">Pickup Location</span>
                     <a href="javascript:void(0)" class="ml-auto" onclick="edit_location();"><img class="svg" src="<?php echo base_url();?>assets/images/edit.svg"></a>
                  </div>
                  <P class="mb-3"><?= $storage->pickup_location ?></p>
                  <span class="privacy-1h">Drop Off Location</span>
                  <P class="mb-0"><?= $storage->drop_location ?></p>
                  <!-- <div class="d-flex flex-wrap border-top mt-3 mx-min-m px-2 pt-3">
                     <h6 class="mb-0">Total Price</h6>
                     <P class="mb-0 ml-auto font-bd">200$</p>
                  </div> -->
               </div>   
            </div>
         </div>      
      </div>
   <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#person-modal">
      Launch demo modal
 </button> -->
</section>
<!-- Modal -->
<div class="modal fade" id="person-modal" tabindex="-1" role="dialog" aria-labelledby="person-modal" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="background-color:white;">
      <form action="<?= base_url('order/'.$this->uri->segment(3));?>" method="POST">
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
                  <!-- <div class="person-p-detail">
                        <h5 class="mb-0 modal-text-color">Start Time:</h5>
                        <input type="time" id="strt_time" name="strt_time" class="form-control" placeholder="Select time">
                  </div>
                  <div class="person-p-detail">
                        <h5 class="mb-0 modal-text-color">End Time:</h5>
                        <input type="time" id="end_time" name="end_time" class="form-control" placeholder="Select time">
                  </div> -->
                  <div id="time-range">
                     <p>Time Duration: <span class="slider-time modal-text-color" > 9:00 AM</span> - <span class="slider-time2 modal-text-color" >11:00 AM</span>
                     <input type="hidden" id="strt_time" value="9:00 AM" name="strt_time">
                     <input type="hidden" id="end_time" value="5:00 PM" name="end_time" >
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

<style>
   .modal-dialog.modal-dialog-centered{
      top:0px;
      z-index:1050;
   }
   .desc {
      max-width: 250px;
      text-align: left;
      font-size:14px;
      padding-top:30px;
      line-height: 1.4em;
   }
   .resize {
      background: #222;
      display: inline-block;
      padding: 6px 15px;
      border-radius: 22px;
      font-size: 13px;
   }
   @media (max-height: 700px) {
      .sticky {
         position: relative;
      }
   }
   @media (max-width: 600px) {
      .resize {
         display: none;
      }
   }

</style>
<!-- CSS ======================================================= -->
<link rel="stylesheet" href="<?= $assets; ?>monthly.css">
<!-- JS ======================================================= -->
<!-- <script type="text/javascript" src="<?= $assets; ?>jquery.js"></script> -->
<script type="text/javascript" src="<?= $assets; ?>monthly.js"></script>
<script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAQxRGo3kiHw9CBikEzmWtzrz1Lsz88Pk"></script>
<script type="text/javascript">
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
// if(localStorage.getItem('type')=="piano")
// {
//    if(localStorage.getItem("piano_nam")!=null) 
//    {
//       $('.first_row').remove();
//       // var product_list = "<div class='w-100 d-flex'>"+"<p class='mb-0 products' data-id='"+localStorage.getItem('piano_id')+"' >"+ localStorage.getItem("piano_nam") +"</p>"+
//       // "<button class='border-0 bg-none ml-auto'>"+"<span>"+"edit"+"</span>"+ "<i class='fa fa-pen'>"+"</i>"+"</button>"+"</div>";
//        $(".tabs_sec .counter-body .category_pitem").append('<div class="items_counter mb-1px" data-id='+localStorage.getItem('piano_id')+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+localStorage.getItem('piano_id')+'><p data-id = "data-id='+localStorage.getItem('piano_id')+'">'+ localStorage.getItem("piano_nam") +'</p></div><div class="add_counter h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input readonly class="item_catagory_value'+localStorage.getItem('piano_id')+'" type="text" value="1" data-item="1"></li><li class="h-100 d-flex align-center"><button class="h-100 border-0 px-2 bg-silver d-flex align-center" data-toggle="modal" data-target="#add_item_modal"><img src="<?php echo base_url();?>assets/images/edit.svg" style="width:19px;"></button></li></ul></div></div></div>');
//    }
// }
// if(localStorage.getItem('type')=="furniture")
// {
//    if(localStorage.getItem('furniture')!=null)
//    {
//       var furniture = JSON.parse(localStorage.getItem('furniture'));
//       var counter = 0;
//       $.each(furniture , function(index,value){
//          $('.first_row').remove();
//          $(".tabs_sec ").append('<div class="items_counter mb-1px" data-id='+furniture[counter].id+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+furniture[counter].id+'><p data-id = "data-id='+furniture[counter].id+'">'+ furniture[counter].name +'</p></div><div class="add_counter h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input readonly class="item_catagory_value'+furniture[counter].id+'" type="text" value="'+ furniture[counter].quantity +'" data-item="1"></li><li class="h-100 d-flex align-center"><button class="h-100 border-0 px-2 bg-silver d-flex align-center" data-toggle="modal" data-target="#add_item_modal"><img src="<?php echo base_url();?>assets/images/edit.svg" style="width:19px;"></button></li></ul></div></div></div>');
//          counter++;
//       });
//    }
// }
// if(localStorage.getItem('type')=="office")
// {
//    if(localStorage.getItem('office')!=null)
//    {
//       var office = JSON.parse(localStorage.getItem('office'));
//       office_counter = 0;
//       $.each(office,function(index,value){
//          $('.first_row').remove();
//          $(".tabs_sec .counter-body .category_pitem").append('<div class="items_counter mb-1px" data-id='+office[office_counter].id+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+office[office_counter].id+'><p data-id = "data-id='+office[office_counter].id+'">'+ office[office_counter].name +'</p></div><div class="add_counter h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input readonly class="item_catagory_value'+ office[office_counter].id +'" type="text"  data-item="1" value="'+ office[office_counter].quantity +'"></li><li class="h-100 d-flex align-center"><button class="h-100 border-0 px-2 bg-silver d-flex align-center" data-toggle="modal" data-target="#add_item_modal"><img src="<?php echo base_url();?>assets/images/edit.svg" style="width:19px;"></button></li></ul></div></div></div>');
//          office_counter++;
//       });
//    }
// }
// if(localStorage.getItem('type')=="house")
// {
//    if(localStorage.getItem('home')!=null)
//    {
//    var home = JSON.parse(localStorage.getItem('home'));
//       home_counter = 0;
//       $.each(home,function(index,value){
//          $('.first_row').remove();
//          $(".tabs_sec .counter-body .category_pitem").append('<div class="items_counter mb-1px" data-id='+home[home_counter].id+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+home[home_counter].id+'><p data-id = "data-id='+home[home_counter].id+'">'+home[home_counter].name+'</p></div><div class="add_counter h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input readonly class="item_catagory_value'+home[home_counter].id+'" type="text" value="'+ home[home_counter].quantity +'" data-item="1"></li><li class="h-100 d-flex align-center"><button class="h-100 border-0 px-2 bg-silver d-flex align-center" data-toggle="modal" data-target="#add_item_modal"><img src="<?php echo base_url();?>assets/images/edit.svg" style="width:19px;"></button></li></ul></div></div></div>');
//          home_counter++;
//       });
//    }
// } 
// if(localStorage.getItem('type')=="man_and_van")
// {
//    if(localStorage.getItem('man_and_van')!=null)
//    {
//    var man_and_van = JSON.parse(localStorage.getItem('man_and_van'));
//    man_and_van_counter = 0;
//       $.each(home,function(index,value){
//          $('.first_row').remove();
//          $(".tabs_sec .counter-body .category_pitem").append('<div class="items_counter mb-1px" data-id='+man_and_van[man_and_van_counter].id+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+man_and_van[man_and_van_counter].id+'><p data-id = "data-id='+man_and_van[man_and_van_counter].id+'">'+man_and_van[man_and_van_counter].name+'</p></div><div class="add_counter h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input readonly class="item_catagory_value'+man_and_van[man_and_van_counter].id+'" type="text" value="'+ man_and_van[man_and_van_counter].quantity +'" data-item="1"></li><li class="h-100 d-flex align-center"><button class="h-100 border-0 px-2 bg-silver d-flex align-center" data-toggle="modal" data-target="#add_item_modal"><img src="<?php echo base_url();?>assets/images/edit.svg" style="width:19px;"></button></li></ul></div></div></div>');
//          man_and_van_counter++;
//       });
//    }
// }  totsl_items = 0;
     var totsl_items = 0
       " <?php if(!empty($products)){ foreach($products as $product){ ?>"
            counter=0;
            $('.first_row').remove();
            <?php if($product->type=="extra_services"){ ?>
            $(".extra_services_container").css("display", "block");
            $(".counter-body-extra-services").append('<div class="items_counter list_counter_right item_row'+<?= $product->id ?>+' mb-1px" data-id='+"<?= $product->id ?>"+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+'><p class="item_name'+"<?= $product->id ?>"+'" data-id = "data-id='+"<?= $product->id ?>"+'">'+ "<?= $product->name ?>" +'</p><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input class="item_catagory_value<?= $product->id?>" readonly type="number" value="<?= $product->quantity?>" onchange="change_qty(<?= $product->id?>)" data-item="<?= $product->id?>"></li></ul></div></div></div></div>');
            <?php }else{ ?>
            $(".tabs_sec .counter-body .category_pitem").append('<div class="items_counter list_counter_right item_row'+<?= $product->id ?>+' mb-1px" data-id='+"<?= $product->id ?>"+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+'><p class="item_name'+"<?= $product->id ?>"+'" data-id = "data-id='+"<?= $product->id ?>"+'">'+ "<?= $product->name ?>" +'</p><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input class="item_catagory_value<?= $product->id?>" readonly type="number" value="<?= $product->quantity?>" onchange="change_qty(<?= $product->id?>)" data-item="<?= $product->id?>"></li></ul></div></div></div></div>');
            <?php } ?>
            counter++;
            totsl_items += parseInt("<?= $product->quantity?>");
            $('#items_length').text(" ("+totsl_items+")");
            " <?php }} ?>"
function initMap2(pickup, drop){
      var bounds1 = new google.maps.LatLngBounds;
      var markersArray1 = [];
      var origin1 = pickup;
      var destination1 = drop;
   
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
            window.alert('Directions request failed due to ' + status);
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
   // For Map end

   $(document).ready(function(){
      // $('#person-modal').modal('show');
      // $("#person-modal").modal();
      <?php if(null != $this->session->userdata('pickup_location')){ ?>
         // initMap('<?=$this->session->userdata('pickup_location')?>', '<?=$this->session->userdata('drop_location')?>');
      <?php }else{ ?>
         // initMap("<?=$pickup?>", "<?=$drop?>");
      <?php } ?>
   });
   
   function deleteMarkers(markersArray) {
       for (var i = 0; i < markersArray.length; i++) {
           markersArray[i].setMap(null);
       }
       markersArray = [];
   }

   function load_orderpage(){
      window.location.href = '<?= base_url('shop/order');?>';
   }

	// $(window).load( function() {

	// 	$('#date_calendar').monthly({
   //       mode: 'event',
	// 		//jsonUrl: 'events.json',
   //       //dataType: 'json'
   //       maxWidth: false,
   //       // xmlUrl: 'events.xml',
   //    });
      
	// switch(window.location.protocol) {
	// case 'http:':
	// case 'https:':
	// // running on a server, should be good.
	// break;
	// case 'file:':
	// alert('Just a heads-up, events will not work when run locally.');
	// }

	// });
</script>

<script>
   var one_person_price = 30;
   var two_person_price = 40;
   var three_person_price = 60;
   var c_price = 0;
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
      eventLimit: true, // allow "more" link when too many events
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
               // var date1 = new Date(TodayDate); 
               // var date2 = new Date(info.dateStr); 
               // var Difference_In_Time = date2.getTime() - date1.getTime(); 
               // var Difference_In_Days = '3';
               //  Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
               // alert('diffirence ' + Difference_In_Days);
               load_modal(info.dateStr,<?=json_encode($events[0][0]->title)?>,<?=json_encode($events[0][0]->date)?>);
            }
         // $('#person-modal').modal('show'); 
         // alert(info.dateStr);
         // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
         // alert('Current view: ' + info.view.type);
         // change the day's background color just for fun
         // info.dayEl.style.backgroundColor = 'red';
      }
    });

    calendar.render();
    
    
  });
  function add_qty(id)
   {
      $(".item_catagory_value"+id).val(parseInt($(".item_catagory_value"+id).val())+1);
      var quantity = $(".item_catagory_value"+id).val();
      $(".item_catagory_value"+id).val(quantity);
      update_items();
   }
   function subtract_qty(id)
   {
      if( $(".item_catagory_value"+id).val()==1)
      {
         $(".item_row"+id).remove();
      }
      else
      {
         $(".item_catagory_value"+id).val(parseInt($(".item_catagory_value"+id).val())-1);
         var quantity = $(".item_catagory_value"+id).val();
         $(".item_catagory_value"+id).val(quantity);
      }
      update_items();
   }
   function update_items()
   {
      var items = new Array();
       var next = 0;
       $(".list_counter_right ").each(function(){
            var product_id  =  $(".list_counter_right").eq(next).attr('data-id');
            var producd_name = $(".item_name"+product_id).text();
            var product_qty =  $(".item_catagory_value"+product_id).val();
            items_obj = {"name":producd_name , "id":product_id , "quantity":product_qty, "tab": "null"};
            items.push(items_obj);
            next++;
         });
         $.ajax({
            type: "GET",
            url: '<?php echo base_url('shop/update_items_tdb'); ?>',
            dataType: 'json',
            data: {'items' : items},
            success:function(data)
            {
               return;
            }
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