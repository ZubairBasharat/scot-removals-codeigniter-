$(document).ready(function() {
    // header nav-link actuve on click
    $('.navbar ul.navbar-nav li').click(function() {
        $('.navbar ul.navbar-nav li').removeClass('active');
        $(this).addClass('active');
    });

    $(window).scroll(function() {
        if ($(window).scrollTop() >= 50) {
            $('header').addClass('header_sticky slideInDown');
        } else {
            $('header').removeClass('header_sticky slideInDown');

        }
    });

    $('.item_catagory_inner').click(function() {
        var counter_opner = $(this).attr('id');
        $('.' + counter_opner).hasClass('d-block');

        if ($('.' + counter_opner).addClass('d-block')) {
            $(this).find('p span').removeClass('fa-plus');
        } else {
            $(this).find('p span').addClass('fa-plus');
        }

    });


    var living_invs = {};

    $('.item_catagory').on('click', '.item_category_add', function() {
        var ul = $(this).parent().parent().parent().find('ul');

        var ul_ic = ul.find('.item_catagory_value');
        var ic_value = parseInt(ul_ic.val());
        ul_ic.val(ic_value);

        if (living_invs[ul.data('item')] == null) {
            living_invs[ul.data('item')] = {};
            living_invs[ul.data('item')].items = {};
        }
        living_invs[ul.data('item')].items[ul.data('id')] = {};
        living_invs[ul.data('item')].items[ul.data('id')].item_catagory_value = ic_value;

        //   alert(JSON.stringify(living_invs));
    });

    $('.item_catagory').on('click', '.item_catagory_plus', function() {
        var ul = $(this).parent('li').closest('ul');

        var ul_ic = ul.find('.item_catagory_value');
        var ic_value = parseInt(ul_ic.val());
        ic_value = ic_value + 1;
        ul_ic.val(ic_value);

        if (living_invs[ul.data('item')] == null) {
            living_invs[ul.data('item')] = {};
            living_invs[ul.data('item')].items = {};
        }

        living_invs[ul.data('item')].items[ul.data('id')] = {};
        living_invs[ul.data('item')].items[ul.data('id')].item_catagory_value = ic_value;

        //   alert(JSON.stringify(living_invs));
    });

    $('.item_catagory').on('click', '.item_catagory_minus', function() {
        var ul = $(this).parent('li').closest('ul');

        var ul_ic = ul.find('.item_catagory_value');
        var ic_value = parseInt(ul_ic.val());
        ic_value = ic_value - 1;
        if (ic_value == 0) {
            delete living_invs[ul.data('item')].items[ul.data('id')];

            if (jQuery.isEmptyObject(living_invs[ul.data('item')].items)) {
                delete living_invs[ul.data('item')];
                //   alert(JSON.stringify(living_invs));
                var hide_0 = $(this).parent().parent().parent();
                $(hide_0).removeClass('d-block');
                $(hide_0).css('dislay', 'none');
                $(hide_0).parent('.item_catagory').find('.item_catagory_inner p span').addClass('fa-plus');
            }

        } else {
            ul_ic.val(ic_value);
            living_invs[ul.data('item')].items[ul.data('id')] = {};
            living_invs[ul.data('item')].items[ul.data('id')].item_catagory_value = ic_value;
        }

    });

    $('.item_catagory').on('change', '.item_catagory_value', function() {
        var ul = $(this).parent('li').closest('ul');
        var ul_ic = ul.find('.item_catagory_value');
        var ic_value = parseInt(ul_ic.val());
        living_invs[ul.data('item')].items[ul.data('id')].item_catagory_value = ic_value;

        //   alert(JSON.stringify(living_invs));
    });




    $(".carousel").swipe({
        swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
            if (direction == 'left') $(this).carousel('next');
            if (direction == 'right') $(this).carousel('prev');
        },
        allowPageScroll: "vertical"
    });


    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 3,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
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
        $('.dropdown_content').css('display', 'none');
        $(this).parent().parent().parent().parent().parent().parent().find('span.btn_selected_text').text(selected);
        $(".toggle_icon").removeClass('fa-angle-up');
        $(".toggle_icon").addClass('fa-angle-down');
        $('.drop_btn').removeClass('remove_b');

    });

    $('.dropdown_content ul li').click(function() {
        var selected = $(this).find('span').text();
        $('.dropdown_content').css('display', 'none');
        $(this).parent().parent().parent().parent().parent().parent().find('span.btn_selected_text').text(selected);
        $(".toggle_icon").removeClass('fa-angle-up');
        $(".toggle_icon").addClass('fa-angle-down');
        $('.drop_btn').removeClass('remove_b');

    });

    $('.open_inner_dropdown').click(function() {
        $('#open_drop_li_click').css('display', 'block');
    });
    $('.not_open_dropdown').click(function() {
        $('#open_drop_li_click').css('display', 'none');
    });

    $('.open_inner_dropdown2').click(function() {
        $('#open_drop_li_click2').css('display', 'block');

    });

    $('.not_open_dropdown2').click(function() {
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

        //check if the clicked area is dropDown or not
        if (container.has(e.target).length === 0) {
            $('.dop4 .dropdown_content').hide();
            $('.dop4 .toggle_icon').addClass('fa-angle-down');
            $('.dop4 .toggle_icon').removeClass('fa-angle-up');
            $('.dop4 .drop_btn').removeClass('remove_b');
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
    // Mobile Navigation Start
    $('header').append('<div id="mySidenav" class="sidenav"><div class="mt-5"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a><a class="side-link" href="#">Home</a><a class="side-link" href="#">House Removals</a><a class="side-link" href="#">Furniture Delivery</a><a  class="side-link" href="#">Office Removels</a><a class="side-link" href="#">Blog</a><a  class="side-link" href="#">Members</a></div></div>');
    // Mobile Navigation End

    // scroll to top btn start
    $('footer').append('<button onclick="topFunction()" id="back-top" title="Go to top"><i class="fa fa-angle-up"></i></button>');


    var scrollbutton = document.getElementById("back-top");

    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 50) {
            $(scrollbutton).css({
                'right': '15px',
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
        }, 1000);
        return false;
    });
    // scroll to top btn end
});

function openModal() {
    document.getElementById("myModal").style.display = "block";
}

function closeModal() {
    document.getElementById("myModal").style.display = "none";
}


var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    captionText.innerHTML = dots[slideIndex - 1].alt;
}

function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
    
const slider = document.querySelector('.gallery_indicator');
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
    isDown = true;
    slider.classList.add('active_scroll');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
});
slider.addEventListener('mouseleave', () => {
    isDown = false;
    slider.classList.remove('active_scroll');
});
slider.addEventListener('mouseup', () => {
    isDown = false;
    slider.classList.remove('active_scroll');
});
slider.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 3; //scroll-fast
    slider.scrollLeft = scrollLeft - walk;
});