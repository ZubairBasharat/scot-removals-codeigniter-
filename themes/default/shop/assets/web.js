var count_id_item_p = 1;
// $('#scr_c_loader').show();
$(document).ready(function() {
    // setTimeout(function() {
    //     $('#scr_c_loader').hide();
    // }, 1200);
    // $('body').removeClass("overflow-hidden");
    // header nav-link actuve on click
    $('.menuBtn').click(function() {
        $(this).toggleClass('act');
        if ($(this).hasClass('act')) {
            $('.mainMenu').addClass('act');
            $('body').addClass('overflow-hidden');
        } else {
            $('.mainMenu').removeClass('act');
            $('body').removeClass('overflow-hidden');
        }
    });
    $('input#pickup , input#drop').on('mouseover', function(){
        if($(this).val()==""){
            $(this).focus();
            $(this).attr('placeholder', 'Post Code or Adress');
            $(this).css('background', '#fbfbfb');
        }else{
           return false;
        }
      });
      $('input#pickup , input#drop').on('mouseout', function(){
        $(this).attr('placeholder', '');
        $(this).css('background', '#fff');
    });
    // $(window).scroll(function() {
    //     if ($(window).scrollTop() >= 50) {
    //         $('header').addClass('header_sticky slideInDown');
    //     } else {
    //         $('header').removeClass('header_sticky slideInDown');

    //     }
    // });
    // $('#add_more').on('keydown' , function(e){
    //     var dropdown_s = $('#searchResult');
    //     if (e.which == 40) { 
    //       if ($(dropdown_s).css('display') == 'block'){
    //         $(dropdown_s).show();
    //         $(dropdown_s).find('li').first().addClass('active');
    //       }
    //     }    
    // });
    var mr = $('.navbar-brand').offset().left;
    $('.carousel_row').css('padding-left', mr);
    var gt_w = $(window).width();

    // function scrollspy() {
    //     if (gt_w < 768) {
    //         $('.tabs_sec ul li a').click(function() {
    //             var a = $(this).attr('href');
    //             setTimeout(function() {
    //                 $('html,body').animate({
    //                     scrollTop: $(a).offset().top - 180
    //                 }, 500);
    //             }, 0);
    //         });
    //     } else {
    //         return false;
    //     }
    // }

    // scrollspy();
    $(window).resize(function() {
        scrollspy();
        var mr2 = $('.navbar-brand').offset().left;
        $('.carousel_row').css('padding-left', mr2);
    });
    // $(document).on('click', '.c_ui_add .item_catagory_minus', function() {
    //     var val = $(this).parent().parent().find('.item_catagory_value').val();
    //     if (val == 1) {
    //         var parent = $(this).parent().parent().parent().parent().parent();
    //         var al = $(parent).find('.item_catagory_value').val(null);
    //         parent.remove();
    //         var item_name = $(this).parent().parent().parent().parent().find('.item_title').text();
    //         Swal.fire({
    //             icon: 'success',
    //             title: 'Deleted',
    //             text: item_name
    //         });
    //     }
    // });

    $(".carousel").swipe({
        swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
            if (direction == 'left') $(this).carousel('next');
            if (direction == 'right') $(this).carousel('prev');
        },
        allowPageScroll: "vertical"
    });
    $(document).on('click', '.trigger_ph_in', function() {
        var ph_add = $(this).parent().clone();
        var icon = ph_add.find('.trigger_ph_in');
        if ($(this).hasClass('fa-plus')) {
            icon.removeClass('fa-plus');
            icon.addClass('fa-minus');
            ph_add.find('input').attr('name', 'second' + count_id_item_p);
            ph_add.find('input').removeAttr('id');
            ph_add.find('input').addClass('sub_input_number');
            ph_add.find('input').val("");
            $(ph_add).find('.floating-label').text('Second Number');
            $(this).parent().parent().append(ph_add);
            $(this).attr('disabled', true);
            count_id_item_p++;
        } else {
            var pr = $(this).parent().parent().parent();
            $(pr).find('.trigger_ph_in.fa-plus').attr('disabled', false);
            $(this).parent().find('input').val(null);
            $(this).parent().remove();
        }
        ph_add.find('input').removeClass('order_validation');
        ph_add.find('.val_message').remove();
        ph_add.find('.val_message_num').remove();
    });

    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 3,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,

            },
            768: {
                items: 2,

            },
            992: {
                items: 3,

            }
        }

    });
    $(document).on('click', '.item_catagory_inner', function() {
        var counter_opner = $(this).attr('id');
        $('.' + counter_opner).hasClass('d-block');

        if ($('.' + counter_opner).addClass('d-block')) {
            $(this).find('p span').removeClass('fa-plus');
        } else {
            $(this).find('p span').addClass('fa-plus');
        }

    });
    var living_invs = {};
    // $(document).on('click', '.item_catagory .item_category_add', function() {
    //     alert("here");
    //     var ul = $(this).parent().parent().parent().find('ul');

    //     var ul_ic = ul.find('.item_catagory_value');
    //     var ic_value = parseInt(ul_ic.val());
    //     ul_ic.val(ic_value);

    //     if (living_invs[ul.data('item')] == null) {
    //         living_invs[ul.data('item')] = {};
    //         living_invs[ul.data('item')].items = {};
    //     }
    //     living_invs[ul.data('item')].items[ul.data('id')] = {};
    //     living_invs[ul.data('item')].items[ul.data('id')].item_catagory_value = ic_value;

    //     //   alert(JSON.stringify(living_invs));
    // });


    // // $(document).on('click', '.item_catagory .item_catagory_minus', function() {
    // //     var ul = $(this).parent('li').closest('ul');

    // //     var ul_ic = ul.find('.item_catagory_value');
    // //     var ic_value = parseInt(ul_ic.val());
    // //     if (ic_value == 1) {
    // //         // delete living_invs[ul.data('item')].items[ul.data('id')];

    // //         // if (jQuery.isEmptyObject(living_invs[ul.data('item')].items)) {
    // //         delete living_invs[ul.data('item')];
    // //         //   alert(JSON.stringify(living_invs));
    // //         ic_value = ic_value - 0;
    // //         var hide_0 = $(this).parent().parent().parent();
    // //         $(hide_0).removeClass('d-block');
    // //         $(hide_0).css('dislay', 'none');
    // //         $(hide_0).parent('.item_catagory').find('.item_catagory_inner p span.fa').addClass('fa-plus');
    //         // }


    //     } else {
    //         ic_value = ic_value - 1;
    //         ul_ic.val(ic_value);
    //         living_invs[ul.data('item')].items[ul.data('id')] = {};
    //         living_invs[ul.data('item')].items[ul.data('id')].item_catagory_value = ic_value;
    //     }

    // });

    $(document).on('change', '.item_catagory .item_catagory_value', function() {
        var ul = $(this).parent('li').closest('ul');
        var ul_ic = ul.find('.item_catagory_value');
        var ic_value = parseInt(ul_ic.val());
        living_invs[ul.data('item')].items[ul.data('id')].item_catagory_value = ic_value;

        //   alert(JSON.stringify(living_invs));
    });

    // $(document).on('click', '.item_catagory .item_catagory_plus', function() {
    //     var ul = $(this).parent('li').closest('ul');
    //     var ul_ic = ul.find('.item_catagory_value');
    //     var ic_value = parseInt(ul_ic.val());
    //     ic_value = ic_value + 1;
    //     ul_ic.val(ic_value);

    //     if (living_invs[ul.data('item')] == null) {
    //         living_invs[ul.data('item')] = {};
    //         living_invs[ul.data('item')].items = {};
    //     }

    //     living_invs[ul.data('item')].items[ul.data('id')] = {};
    //     living_invs[ul.data('item')].items[ul.data('id')].item_catagory_value = ic_value;

    //     //   alert(JSON.stringify(living_invs));
    // });


    /*
     * Replace all SVG images with inline SVG
     */
    jQuery('img.svg').each(function() {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');

    });
    // dropdown juquery
    $('.drop_btn').click(function() {
        var dropdown_data = $(this).attr('id');
        var toggle_icon = $(this).parent().find('.toggle_icon');
        if ($('.' + dropdown_data).css("display") == "none") {
            $('.' + dropdown_data).css("display", "block");
            $(this).parent().parent().parent().find('.toggle_icon').removeClass('fa-angle-up');
            $(this).parent().parent().parent().find('.toggle_icon').addClass('fa-angle-down');
            $(toggle_icon).addClass('fa-angle-up');
            $(this).addClass('remove_b');
        } else {

            $('.dropdown_content').css("display", "none");
            $(this).removeClass('remove_b');
            $(this).parent().parent().parent().find('.toggle_icon').removeClass('fa-angle-up');
            $(this).parent().parent().parent().find('.toggle_icon').addClass('fa-angle-down');
            // $(toggle_icon).removeClass('fa-angle-up');
            $(toggle_icon).addClass('fa-angle-down');

        }

    });

    $('.dropdown_content ul li').click(function() {
        var selected = $(this).find('span').text();
        var selected_slug = $(this).find('span').attr('data-slug');
        var selected_id = $(this).find('span').attr('data-id');
        $('.dropdown_content').css('display', 'none');
        $(this).parent().parent().parent().parent().parent().parent().find('span.btn_selected_text').text(selected);
        $(this).parent().parent().parent().parent().parent().parent().find('span.btn_selected_text').attr('data-slug', selected_slug);
        $(this).parent().parent().parent().parent().parent().parent().find('span.btn_selected_text').attr('data-id', selected_id);
        $(".toggle_icon").removeClass('fa-angle-up');
        $(".toggle_icon").addClass('fa-angle-down');
        $('.drop_btn').removeClass('remove_b');

    });

    $('.dropdown_content ul .more_content ul li').click(function() {
        var selected = $(this).find('span').text();
        var selected_slug = $(this).find('span').attr('data-slug');
        var selected_id = $(this).find('span').attr('data-id');
        $('.dropdown_content').css('display', 'none');
        $(this).parent().parent().parent().parent().parent().parent().parent().parent().find('span.btn_selected_text').text(selected);
        $(this).parent().parent().parent().parent().parent().parent().parent().parent().find('span.btn_selected_text').attr('data-slug', selected_slug);
        $(this).parent().parent().parent().parent().parent().parent().parent().parent().find('span.btn_selected_text').attr('data-id', selected_id);
        $(".toggle_icon").removeClass('fa-angle-up');
        $(".toggle_icon").addClass('fa-angle-down');
        $('.drop_btn').removeClass('remove_b');

    });

    $('.dropdown_content ul li').click(function() {
        var selected = $(this).find('span').text();
        var selected_slug = $(this).find('span').attr('data-slug');
        var selected_id = $(this).find('span').attr('data-id');
        $('.dropdown_content').css('display', 'none');
        $(this).parent().parent().parent().parent().parent().parent().find('span.btn_selected_text').text(selected);
        $(this).parent().parent().parent().parent().parent().parent().find('span.btn_selected_text').attr('data-slug', selected_slug);
        $(this).parent().parent().parent().parent().parent().parent().find('span.btn_selected_text').attr('data-id', selected_id);
        $(this).parent().parent().parent().parent().parent().parent().parent().find('.btn_selected_text').attr('data-slug', selected_slug);
        $(this).parent().parent().parent().parent().parent().parent().parent().find('.btn_selected_text').attr('data-id', selected_id);
        $(".toggle_icon").removeClass('fa-angle-up');
        $(".toggle_icon").addClass('fa-angle-down');
        $('.drop_btn').removeClass('remove_b');

    });

    $('.open_inner_dropdown').click(function() {
        $('#open_drop_li_click').css('display', 'block');
    });
    $('.not_open_dropdown').click(function() {
        $('#inner_checkbox1').hide();
        $('#inner_checkbox1 input').prop('checked', false);
        $('#open_drop_li_click').css('display', 'none');
    });

    $('.open_inner_dropdown2').click(function() {
        $('#open_drop_li_click2').css('display', 'block');

    });

    $('.not_open_dropdown2').click(function() {
        $('#inner_checkbox2').hide();
        $('#inner_checkbox2 input').prop('checked', false);
        $('#open_drop_li_click2').css('display', 'none');
    });

    $('#open_drop_li_click ul li').click(function() {
        if ($(this).hasClass('open_checkbox1')) {
            $('#inner_checkbox1').css('display', 'block');
        } else {
            $('#inner_checkbox1').css('display', 'none');
        }

    });

    $('#open_drop_li_click2 ul li').click(function() {
        if ($(this).hasClass('open_checkbox2')) {
            $('#inner_checkbox2').css('display', 'block');
        } else {
            $('#inner_checkbox2').css('display', 'none');
        }


    });
    $('.open_checkbox2 , .open_checkbox1').on('click', function(){
      if($(this).find('span').text()=="Above 4th floor"){
        swal({
            icon: "warning",
            closeOnClickOutside: false,
            title: 'Above 4th floor',
            text: 'Not Available yet',
        });
        $('#complete_quote').attr("onclick", 'return false');
      }else{
        $('#complete_quote').attr("onclick", 'house_order_details()');
      }
    });

    $(document).click(function(e) {
        e.stopPropagation();
        var container = $(".dop");

        //check if the clicked area is dropDown or not
        if (container.has(e.target).length === 0) {
            $('.dop .dropdown_content').hide();
            $('.dop .toggle_icon').addClass('fa-angle-down');
            $('.dop .toggle_icon').removeClass('fa-angle-up');
            $('.dop .drop_btn').removeClass('remove_b');
        }
    });
    $(document).click(function(e) {
        e.stopPropagation();
        var container = $(".dop2");

        //check if the clicked area is dropDown or not
        if (container.has(e.target).length === 0) {
            $('.dop2 .dropdown_content').hide();
            $('.dop2 .toggle_icon').addClass('fa-angle-down');
            $('.dop2 .toggle_icon').removeClass('fa-angle-up');
            $('.dop2 .drop_btn').removeClass('remove_b');
        }
    });

    $(document).click(function(e) {
        e.stopPropagation();
        var container = $(".dop3");

        //check if the clicked area is dropDown or not
        if (container.has(e.target).length === 0) {
            $('.dop3 .dropdown_content').hide();
            $('.dop3 .toggle_icon').addClass('fa-angle-down');
            $('.dop3 .toggle_icon').removeClass('fa-angle-up');
            $('.dop3 .drop_btn').removeClass('remove_b');
        }
    });



    $(document).click(function(e) {
        e.stopPropagation();
        var container = $(".dop4");
        var search_dropdown = $('#searchResult');
        //check if the clicked area is dropDown or not
        if (container.has(e.target).length === 0) {
            $('.dop4 .dropdown_content').hide();
            $('.dop4 .toggle_icon').addClass('fa-angle-down');
            $('.dop4 .toggle_icon').removeClass('fa-angle-up');
            $('.dop4 .drop_btn').removeClass('remove_b');
        }
        if (search_dropdown.has(e.target).length === 0) {
            search_dropdown.find('li').remove();
            search_dropdown.hide();
        }
    });

    $('#next_page').click(function() {
        var source = $('.drop_btn .btn_selected_text').text();
        var trimStr = $.trim(source);
        var str = trimStr;
        var decodeurl = (str.replace(/\s/g, ''));
        $('#next_page').attr('href', decodeurl + '.html');
        if ($(".drop_btn .btn_selected_text").text() == "What are you moving?") {
            $('#next_page').attr('href', '#tell_about');
        }
    });

    // scroll to top btn start
    $('footer').append('<button id="back-top" title="Go to top"><i class="fa fa-angle-up"></i></button>');


    var scrollbutton = document.getElementById("back-top");

    window.onscroll = function() {
        scrollFunction();
    }

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 50) {
            $(scrollbutton).css({
                'right': '30px',
                'visibility': 'visible'
            });
        } else {
            $(scrollbutton).css({
                'right': '-100px',
                'visibility': 'hidden'
            });
        }
    }
    // scroll to top on click
    $('#back-top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 0);
        return false;
    });
    // scroll to top btn end

    // const slider = document.querySelector('.gallery_indicator');
    // let isDown = false;
    // let startX;
    // let scrollLeft;

    // slider.addEventListener('mousedown', (e) => {
    //     isDown = true;
    //     slider.classList.add('active_scroll');
    //     startX = e.pageX - slider.offsetLeft;
    //     scrollLeft = slider.scrollLeft;
    // });
    // slider.addEventListener('mouseleave', () => {
    //     isDown = false;
    //     slider.classList.remove('active_scroll');
    // });
    // slider.addEventListener('mouseup', () => {
    //     isDown = false;
    //     slider.classList.remove('active_scroll');
    // });
    // slider.addEventListener('mousemove', (e) => {
    //     if (!isDown) return;
    //     e.preventDefault();
    //     const x = e.pageX - slider.offsetLeft;
    //     const walk = (x - startX) * 3; 
    //     slider.scrollLeft = scrollLeft - walk;
    //     console.log(walk);
    // });
    
});
// var slideIndex = 1;
// showSlides(slideIndex);

// function plusSlides(n) {
//     showSlides(slideIndex += n);
// }

// function currentSlide(n) {
//     showSlides(slideIndex = n);
// }

// function showSlides(n) {
//     var i;
//     var slides = document.getElementsByClassName("mySlides");
//     var dots = document.getElementsByClassName("demo");
//     var captionText = document.getElementById("caption");
//     if (n > slides.length) {
//         slideIndex = 1
//     }
//     if (n < 1) {
//         slideIndex = slides.length
//     }
//     for (i = 0; i < slides.length; i++) {
//         slides[i].style.display = "none";
//     }
//     for (i = 0; i < dots.length; i++) {
//         dots[i].className = dots[i].className.replace(" active", "");
//     }
//     slides[slideIndex - 1].style.display = "block";
//     dots[slideIndex - 1].className += " active";
//     captionText.innerHTML = dots[slideIndex - 1].alt;
// }
function openModal() {
    document.getElementById("myModal").style.display = "block";
}

function closeModal() {
    document.getElementById("myModal").style.display = "none";
}


function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

// function handle(e) {
//     var all_text_get = $('.target_add_input.rc_add , .target_add_input.tab-pane.product_tabs.active').find('span.item_title');
//     if (e.keyCode === 13) {
//         e.preventDefault();
//         var item_val = $('.item_add_input input').val();
//         spc_n = item_val.replace(/\s/g, '');
//         var t = $.trim(item_val);
//         var count_i_p = item_val + count_id_item_p;
//         id_filter = count_i_p.replace(/\s/g, '');
//         if (t == '' || t == ' ') {
//             swal(
//                 'Empty',
//                 'Please Enter Item Name First',
//                 'warning'
//             );
//         } else {
//             var check = false;
//             var val = "";
//             $(all_text_get).each(function() {
//                 val = $(this).text();
//                 if (item_val == val) {
//                     check = true;
//                 }
//             });
//             if (check == true) {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Oops...',
//                     text: item_val + ' Already Exist!'
//                 });
//             } else {
//                 var regex = /[^\w\s]/gi;
//                 if (regex.test(item_val) == true) {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Special Character ',
//                         text: item_val + ' is not Valid Name!'
//                     });
//                 } else {
//                     $('.target_add_input.rc_add , .target_add_input.tab-pane.product_tabs.active').append(' <div class="c_ui_add items_counter o_category"><div class="item_catagory"><div class="item_catagory_inner" id="counter_' + id_filter + '"><p><span class="item_title">' + item_val + '</span> <span class="fa fa-plus ml-auto mr-3 item_category_add"></span></p></div><div class="add_counter counter_' + id_filter + '" style="display: none;"><ul class="d-table-cell-child" data-item="1" data-id="1"><li><button class="fa mr-1 fa-trash delete_item_trash "></button></li><li><button class="fa fa-minus item_catagory_minus"></button></li><li><input class="item_catagory_value" type="text" value="1" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus"></button></li></ul></div></div></div> ');
//                     $('.item_add_input input').val(null);
//                     $('.c_ui_add .item_category_add.fa-plus').click();
//                     count_id_item_p++;
//                 }
//             }

//         }
//     }

// }
// jquery touch script//
!function(a){function f(a,b){if(!(a.originalEvent.touches.length>1)){a.preventDefault();var c=a.originalEvent.changedTouches[0],d=document.createEvent("MouseEvents");d.initMouseEvent(b,!0,!0,window,1,c.screenX,c.screenY,c.clientX,c.clientY,!1,!1,!1,!1,0,null),a.target.dispatchEvent(d)}}if(a.support.touch="ontouchend"in document,a.support.touch){var e,b=a.ui.mouse.prototype,c=b._mouseInit,d=b._mouseDestroy;b._touchStart=function(a){var b=this;!e&&b._mouseCapture(a.originalEvent.changedTouches[0])&&(e=!0,b._touchMoved=!1,f(a,"mouseover"),f(a,"mousemove"),f(a,"mousedown"))},b._touchMove=function(a){e&&(this._touchMoved=!0,f(a,"mousemove"))},b._touchEnd=function(a){e&&(f(a,"mouseup"),f(a,"mouseout"),this._touchMoved||f(a,"click"),e=!1)},b._mouseInit=function(){var b=this;b.element.bind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),c.call(b)},b._mouseDestroy=function(){var b=this;b.element.unbind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),d.call(b)}}}(jQuery);