$(document).ready(function(){


    $(document).on('resize', teamImg);

    function teamImg(){

        $('.team-member-big img').each(function(i){
            $(this).attr('id', 'img-' + i).on('load', loadImg);
        });
    }
    teamImg();
    function loadImg (){
        var img = document.getElementById('img-0'); 
        var width = img.clientWidth;
        var height = img.clientHeight;
        $(this).height(height);

    };

    /*table wraping*/
    $('.article-content table').wrap('<div class="table-wrapper">');
    /*end table wraping*/

    /*tooltip*/
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
    /*end tooltip*/

    /*menu*/
    $('#hamburger').click(function(){

        $('body').toggleClass('fix-body');
        $('#nav').fadeToggle();
        $('.hidden-profile').fadeToggle();
        $('#hamburger .fa').toggleClass('fa-bars');
        $('#hamburger .fa').toggleClass('fa-times');
    });

    if ($(window).width() > '1199'){
        $('.headerMenu li').hover(
            function () {
                $('.headerMenu-submenu', this).stop().slideDown(350);
            }, 
            function () {
                $('.headerMenu-submenu', this).stop().slideUp(200);            
            }
        );
    }else{
        $('.headerMenu li').on('click', function(event) {

            $('.headerMenu-submenu').css('display', 'none');
            $('.headerMenu-submenu', this).css('display', 'block');

            $(this).each(function() {
                var clickCount = $(this).attr("data-count");
                clickCount ++;
                if (clickCount == 1) {
                    $(this).attr("dataCount", clickCount);
                    return false;
                } else {
                    return true;
                }
            });

        });


        $(".headerMenu>li:nth-child(2)").one("click", false);
        $(".headerMenu>li:nth-child(3)").one("click", false);
        $(".headerMenu>li:nth-child(4)").one("click", false);
        $(".headerMenu>li:nth-child(6)").one("click", false);

    }
    /*popup video*/
   

    /*e.preventDefault();
    $.magnificPopup.close();
    $('#v-player').get(0).pause(); */

    /*end popup video*/
    /*animate css*/
    new WOW().init();

    function owl11(){

        $(".owl-carousel11").owlCarousel({
            items: 3,
            loop: false,
            dots: true,
            dotsEach: true,
            smartSpeed: 500,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            nav: true,
            navText: ["<i class=\"fa fa-angle-left\"></i>","<i class=\"fa fa-angle-right\"></i>"],
            responsive:{
                0:{
                    items: 3
                },
                480:{
                    items: 1

                },
                769:{
                    items: 3
                }
            }
        });
    }
    owl11();


    /*slider1*/
    $(".owl-carousel1").owlCarousel({
        items: 3,
        loop: false,
        dots: true,
        dotsEach: true,
        smartSpeed: 500,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        nav: true,
        navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
        responsive:{
            0:{
                items: 1
            },
            480:{
                items: 1

            },
            769:{
                items: 3
            }
        }
    });

    /*slider2*/
    $(".owl-carousel2").owlCarousel({
        items: 3,
        loop: true,
        dots: true,
        nav: true,
        center: true,
        smartSpeed: 500,
        navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
        responsive:{
            0:{
                items: 1
            },
            480:{
                items: 1

            },
            769:{
                items: 3
            }
        }
    });
    /* top slider  s-cat_wrapper*/
    $(".owl-carousel-cat-small").owlCarousel({
        items: 1,
        loop: false,
        dots: false,
        nav: true,
        smartSpeed: 500,
        navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"]
    });
    /*team-member*/
    $(".team-member-big").owlCarousel({
        items: 5,
        loop: true,
        dots: true,
        nav: true,
        smartSpeed: 500,
        responsive:{
            0:{
                items: 1
            },
            480:{
                items: 3

            },
            769:{
                items: 5
            }
        },
        navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
        
    });
    $('.form_date').datetimepicker({
        language:  'ru',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });


    /*$(".spincrement").spincrement();  roles*/

    $('.cattegory-item').mouseenter(function() {
        $(this).find('.mask-cat').addClass('class-color-mask');
    }).mouseleave(function() {
        $(this).find('.mask-cat').removeClass('class-color-mask');
    });

    $('.cattegory-item').mouseover(function(){
        $(this).find('.icon-start').css('display', 'none').end().find('.icon-hover').css('display', 'inline-block');
    }).mouseout(function(){
        $(this).find('.icon-start').css('display', 'block').end().find('.icon-hover').css('display', 'none');
    });

    $('.s-cat_item').mouseover(function(){
        $(this).find('.icon-start').css('display', 'none').end().find('.icon-hover').css('display', 'inline-block');
    }).mouseout(function(){
        $(this).find('.icon-start').css('display', 'inline-block').end().find('.icon-hover').css('display', 'none');
    });


    /*magnific popup*/
    $('.popup-with-form').magnificPopup({
        type: 'inline',
        preloader: true,
        callbacks: {

            elementParse: function(item) {

                if($(item.el).hasClass('popup-register')){
                    console.log('1');
                    $('.top-row').find('.top-row_left').removeClass('active').end().find('.top-row_right').addClass('active');
                    $('#popup-check_in').find('#login').removeClass('active').css('display', 'none').end().find('#checkin').addClass('active').css('display', 'block');
                }
                $('#popup-check_in-login-phone #login1').css('display', 'block');

            }
        }
    });
    $('.popup-with-form-login').magnificPopup({
        type: 'inline',
        preloader: true,
        callbacks: {

            elementParse: function(item) {
                console.log('2');
                if($(item.el).hasClass('popup-register')){
                    $('.top-row').find('.top-row_left').removeClass('active').end().find('.top-row_right').addClass('active');
                    $('#popup-check_in').find('#login').removeClass('active').css('display', 'block').end().find('#checkin').addClass('active').css('display', 'block');
                }

            }
        }
    });

    $('.popup-with-form-login-phone').magnificPopup({
        type: 'inline',
        preloader: true,
        callbacks: {
            open: function() {
                $('#login').css({'display':'block'});
            },
            elementParse: function(item) {
                console.log('3');
                if($(item.el).hasClass('popup-register')){
                    $('.top-row').find('.top-row_left').removeClass('active').end().find('.top-row_right').addClass('active');
                    $('#ppopup-check_in-login-phone').find('#login').removeClass('active').css('display', 'block').end().find('#checkin').addClass('active').css('display', 'block');
                }

            }
        }
    });
    $('.popup-with-form2').magnificPopup({
        type: 'inline',
        preloader: true,
        callbacks: {
            open: function(){
                $('#abt-video').get(0).play();
            },
            close: function(){
                $('#abt-video').get(0).pause();
            }

        }
    });

    $('.popup-with-form-thanks').magnificPopup({
        type: 'inline',
        preloader: true
    });
    /* video ended*/
    if ( $('#abt-video').get(0)){
        $('#abt-video').get(0).addEventListener('ended',myHandler,false);
    
        function myHandler(e) {
           $.magnificPopup.close();
        }
    }
    /*end video ended*/

    var clock = new FlipClock(
        $('.your-clock'),
        $('input[name="startTime"]').val() - Math.floor(Date.now()/1000),
        {
            clockFace: 'DailyCounter',
            countdown: true,
            callbacks: {
                stop: function() {
                    console.log('stopMain');
                    window.location.reload();
                }
            }
        }
    );
    if(document.getElementById('video-id')){
        var video_id = $('#video-id').data('id');
        console.log(video_id);

        player3.source = {
            type: 'video',
            sources: [{
                src: video_id,
                provider: 'youtube'
            }]
        };
    }


    var acc = $("#accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight){
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }


    $(".scroll-to-join").click(function() {
        $('html, body').animate({
            scrollTop: $("#join").offset().top
        }, 1000);
    });

    $(".read-more").click(function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $("#read-more").offset().top
        }, 1000);
    });


    /*** SOCIAL-LIKES ***/
    if(document.getElementsByClassName('articel-share-row_soc1')[0]){
        $(document).on('click', '.share-fb', function(e){
           e.preventDefault();
            var post_id = $(this).data('id');
            var submit = $('.social-form').attr('action');
            var _this = $(this);
            FB.ui({
                method: 'share',
                display: 'popup',
                href: $('meta[property="og:url"]').attr('content'),
                picture: $('meta[property="og:image"]').attr('content'),
                name: $('meta[property="og:title"]').attr('content'),
                description: $('meta[property="og:description"]').attr('content')
            }, function(response){
                if(response !== undefined){
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "POST",
                        data: {'post_id': post_id, 'social' : 'facebook'},
                        url: submit,
                        success: function( msg ) {
                            var counter = $(_this).find('.fb-span').text();
                            $(_this).find('.fb-span').html(Number(counter) + 1);
                        }
                    });
                }});
        });

        $(document).on('click', '.share-tw', function(e){
            e.preventDefault();
            var post_id = $(this).data('id');
            var submit = $('.social-form').attr('action');
            var _this = $(this);

            url  = 'http://twitter.com/share?';
            url += 'text='      + encodeURIComponent($('meta[property="og:title"]').attr('content'));
            url += '&url='      + encodeURIComponent($('meta[property="og:url"]').attr('content'));
            url += '&counturl=' + encodeURIComponent($('meta[property="og:url"]').attr('content'));
            window.open(url,'','toolbar=0,status=0,width=626,height=436');

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: {'post_id': post_id, 'social' : 'twitter'},
                url: submit,
                success: function( msg ) {
                    var counter = $('.tw-span').text();
                    $(_this).find('.tw-span').html(Number(counter) + 1);
                }
            });
        });

        $(document).on('click', '.share-gg', function(e) {
            e.preventDefault();
            var post_id = $(this).data('id');
            var submit = $('.social-form').attr('action');
            var _this = $(this);



            url  = 'https://plus.google.com/share?';
            url += 'url='          + encodeURIComponent($('meta[property="og:url"]').attr('content'));
            url += '&text=' + encodeURIComponent($('meta[property="og:description"]').attr('content'));
            window.open(url,'','toolbar=0,status=0,width=626,height=436');

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: {'post_id': post_id, 'social' : 'google'},
                url: submit,
                success: function( msg ) {
                    var counter = $(_this).find('.gg-span').text();
                    $(_this).find('.gg-span').html(Number(counter) + 1);
                }
            });

        });

        $(document).on('click', '.share-tl', function(e){
            e.preventDefault();
            var post_id = $(this).data('id');
            var submit = $('.social-form').attr('action');
            var _this = $(this);

            url = 'https://telegram.me/share/url?';
            url += 'url=' + encodeURIComponent($('meta[property="og:url"]').attr('content'));
            url += '&text=' + encodeURIComponent($('meta[property="og:description"]').attr('content'));
            window.open(url,'','toolbar=0,status=0,width=626,height=436');

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: {'post_id': post_id, 'social' : 'telegram'},
                url: submit,
                success: function( msg ) {
                    var counter = $(_this).find('.tl-span').text();
                    $(_this).find('.tl-span').html(Number(counter) + 1);
                }
            });
        });

    }
    if(document.getElementsByClassName('articel-share-row_soc')[0]){
        var post_id = $('#share-fb').data('id');
        var submit = $('form#social-form').attr('action');

        document.getElementById('share-fb').onclick = function(e) {
            e.preventDefault();
            FB.ui({
                method: 'share',
                display: 'popup',
                href: $('meta[property="og:url"]').attr('content'),
                picture: $('meta[property="og:image"]').attr('content'),
                name: $('meta[property="og:title"]').attr('content'),
                description: $('meta[property="og:description"]').attr('content')
            }, function(response){
                if(response !== undefined){
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "POST",
                        data: {'post_id': post_id, 'social' : 'facebook'},
                        url: submit,
                        success: function( msg ) {
                            var counter = $('.fb-span').text();
                            $('.fb-span').html(Number(counter) + 1);
                        }
                    });
                }});};

        document.getElementById('share-tw').onclick = function(e) {
            e.preventDefault();
            url  = 'http://twitter.com/share?';
            url += 'text='      + encodeURIComponent($('meta[property="og:title"]').attr('content'));
            url += '&url='      + encodeURIComponent($('meta[property="og:url"]').attr('content'));
            url += '&counturl=' + encodeURIComponent($('meta[property="og:url"]').attr('content'));
            window.open(url,'','toolbar=0,status=0,width=626,height=436');

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: {'post_id': post_id, 'social' : 'twitter'},
                url: submit,
                success: function( msg ) {
                    var counter = $('.tw-span').text();
                    $('.tw-span').html(Number(counter) + 1);
                }
            });
        };

        if(document.getElementById('share-vk')){
            document.getElementById('share-vk').onclick = function(e) {
                e.preventDefault();

               VK.Widgets.Like('share-vk', {type: "button"});

               VK.Observer.subscribe("widgets.like.shared", function() {
                   $.ajax({
                       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                       type: "POST",
                       data: {'post_id': post_id, 'social' : 'vk'},
                       url: submit,
                       success: function( msg ) {
                            var counter = $('.vk-span').text();
                            $('.vk-span').html(Number(counter) + 1);
                       }
                   });
                });
            };
        }

        document.getElementById('share-gg').onclick = function(e) {

            e.preventDefault();
            Share.google();
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: {'post_id': post_id, 'social' : 'google'},
                url: submit,
                success: function( msg ) {
                    var counter = $('.gg-span').text();
                    $('.gg-span').html(Number(counter) + 1);
                }
            });
        };

        document.getElementById('share-tl').onclick = function(e) {
            e.preventDefault();
            Share.telegram();
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: {'post_id': post_id, 'social' : 'telegram'},
                url: submit,
                success: function( msg ) {
                    var counter = $('.tl-span').text();
                    $('.tl-span').html(Number(counter) + 1);
                }
            });
        };

        Share = {
            google: function() {
                url  = 'https://plus.google.com/share?';
                url += 'url='          + encodeURIComponent($('meta[property="og:url"]').attr('content'));
                url += '&text=' + encodeURIComponent($('meta[property="og:description"]').attr('content'));
                Share.popup(url);
            },
            telegram: function() {
                url = 'https://telegram.me/share/url?';
                url += 'url=' + encodeURIComponent($('meta[property="og:url"]').attr('content'));
                url += '&text=' + encodeURIComponent($('meta[property="og:description"]').attr('content'));
                Share.popup(url);
            },

            popup: function(url) {
                window.open(url,'','toolbar=0,status=0,width=626,height=436');
            }
        };
        ////////////////////

    }
    /*** SOCIAL-LIKES END ***/



    $('.statistic-counter').counterUp({
        delay: 10,
        time: 2000
    });

    $('.update-info').on('click', function (e) {
        e.preventDefault();

        $('.account-form input:not(input[type="file"]), .account-form select').toggle();
        $('.account-form span.span-input').toggle().toggleClass('toggle-block');
        $('.link-save').toggleClass('block-important');
        $('label[for="avatar"]').toggleClass('block-important');

        if($(this).hasClass('update-info-close')){
            $('.cancel-i').remove();
            $(this).removeClass('update-info-close');
        }else{
            $(this).addClass('update-info-close');
            if(!$('.cancel-i').length && $(".avatar").attr('src') !== '' && $('input[name="old_img"]').attr('value') !== ''){
                $(this).parent().append('<i class="fa fa-times cancel-i" aria-hidden="true"></i>');
            }
        }

    });

    $('.link-save').on('click', function (e) {
        e.preventDefault();
        
        $('.account-form').submit();
    });


    $(document).on('dblclick', '.account-form span.span-input', function(){
        $('.update-info').trigger('click');
        $('.name-first').focus();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(".avatar").attr('src', e.target.result);
                if(!$('.cancel-i').length)
                    $(".avatar").parent().append('<i class="fa fa-times cancel-i" aria-hidden="true"></i>')

            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("input[id='avatar']").change(function(){
        readURL(this);
    });

    $(document).on('click', '.cancel-i', function(e){
        e.preventDefault();
        $(".avatar").attr('src', "/../../img/account-avatar.jpg");
        $("input[id='avatar']").val("");
        $(this).remove();
    });

    /*search*/
    $('.h-search').click(function(event) {
        $('.search-window').slideToggle();
    });
    $('.search-window-exit').click(function(event) {
        $('.search-window').toggleClass('displaynone');
    });
    $('.search-window').mouseup(function (e) {
        if ($(".search-wrapper").has(e.target).length === 0){
            $('.search-window').removeClass('displaynone');
        }
    });

    /*** article popup ***/
    if(document.getElementById('popup-half')){
        var open = true;
        var waypoint = new Waypoint({
            element: document.getElementById('popup-half'),
            handler: function(direction) {
                if(open){
                    open = false;
                    $.magnificPopup.open({
                        items: {
                            src: '.popup-special_propos'
                        },
                        type: 'inline'
                    });
                }
            },
            offset: '50%'
        });
    }
    /*** article popup end ***/

    /*** referal ajax ***/

    $('#ref_btn').on('click', function (e) {
        e.preventDefault();
        var submit = $(this).parent().attr('action');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: submit,
            success: function( msg ) {
                $('.span-referal-link').text(msg);
            }
        });
    });

    /*** referal ajax end ***/

    /*** sort pjax ***/

    var pjax_el = '#pjax-main .training-sorting a, .c-pad-top, #pjax-main .tabs a';

    $(document).on('pjax:end', function() {
        zoomGallery();
        owl11();
        if(document.getElementById('js-player')){
            console.log('js-player');
            var player = new Plyr('#js-player');
        }
    });

    if(document.getElementById('pjax-main')){
        console.log('pjax-main');
        $(document).pjax(pjax_el, '#pjax-main',{scrollTo: false});

        if ($.support.pjax)
            $.pjax.defaults.timeout = 2000;
    }

    /*** sort pjax end ***/

    /*** auth popup ***/

    function getSearchParameters() {
        var prmstr = window.location.search.substr(1);
        return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
    }

    function transformToAssocArray( prmstr ) {
        var params = {};
        var prmarr = prmstr.split("&");
        for ( var i = 0; i < prmarr.length; i++) {
            var tmparr = prmarr[i].split("=");
            params[tmparr[0]] = tmparr[1];
        }
        return params;
    }

    var params = getSearchParameters();
    if(params['auth']){
        $('.popup-with-form').magnificPopup('open');
    }

    if(params['status']){
        console.log(params['status']);
        $('.popup-with-form-thanks').magnificPopup('open');
    }

    if(params['number']){

       // var link = $('[data-id="' + params['number'] + '"]').find('img').trigger('click');


       var _this = $('[data-id="' + params['number'] + '"]');
        var linkYoutube =  _this.data('youtube');
       
        player.source = {
            type: 'video',
            sources: [{
                src: linkYoutube,
                provider: 'youtube'
            }]
        };

        var socialLink = $('.articel-share-row_soc1 li');

        $(socialLink).find('.fb-span').html(_this.data('fb-span'));
        $(socialLink).find('.tw-span').html(_this.data('tw-span'));
        $(socialLink).find('.gg-span').html(_this.data('gg-span'));
        $(socialLink).find('.tl-span').html(_this.data('tl-span'));
        $(socialLink).find('a').attr('data-id', _this.data('id'));
        $(socialLink).find('a').attr('data-url-copy', _this.data('url-copy'));

        $('#myInput').val(_this.data('url-copy'));

        // $('.share-block-link').html(linkYoutube).slideUp();

        _this.find('img').trigger('click');
    }



    if($('input[name="reg_auth"]').length){
        $('.popup-with-form').magnificPopup('open');
    }

    if($('#login-form .help-block strong').text() === 'Данные введены неверно.')
        $('.popup-with-form').magnificPopup('open');
    /*** auth popup end ***/


    /*** Payment ***/

    function getPackageCount(){
        return parseFloat($('.payment-item.active').find('.how-much').text()).toFixed(2);
    }
    function setPackageCount(price){

        $('.total-price').text(price);
        $('input[name="total-price"]').val(price);
    }
    function setPackageCountSmall(price){
        $('.total-price').text(price);
        $('input[name="total-price"]').val(price);
    }
    function getBonusCount() {
        return parseFloat($('.input-number').val()).toFixed(2);
    }

    function setQuant(count){
        $('input[name="quant"]').val(count);
        $('.total-bonus').html(count);
    }

    $(document).on('click', '.payment-item', function (e) {
        var price = parseFloat($(this).find('.how-much').text()).toFixed(2);
        var bonus = getBonusCount();

        $('.payment-item').removeClass('active');
        $(this).addClass('active');
        $('.count-package').text(price);
        $('input[name="package"]').val($(this).data('id'));

        var coastItem = parseFloat(getPackageCount());

        if(bonus/100 > parseFloat(price) / 2) {

            setPackageCount((coastItem / 2).toFixed(2));
            setQuant( (coastItem / 2) * 100 );

        }else{
            if(parseFloat(bonus/100) > parseFloat(price)){
                setPackageCount(coastItem / 2); //0
            }else{

                if(bonus/100 < parseFloat(price) / 2) {

                    setPackageCount((price - bonus/100).toFixed(2));
                }else{
                    setPackageCount(coastItem / 2); //0
                }
            }
        }

    });


    $('.check-sum').click(function(e){
        e.preventDefault();

        var type      = $(this).attr('data-type');
        var input = $("input[name='quant']");
        var currentVal = parseInt(input.val());
        var count = 0;
        if (!isNaN(currentVal)) {
            if(type == 'minus') {
                if(currentVal > input.attr('min')) {
                    count = currentVal - 1;
                    input.val(count.toFixed(0)).change();
                }else{
                    count = currentVal;
                }
            } else if(type == 'plus') {

                if(currentVal < input.attr('max')) {
                    count = currentVal + 1;
                    input.val(count.toFixed(0)).change();
                }else{
                    count = currentVal;
                }
            }
        } else {
            count = 0;
            input.val(0).change();
        }

        var coastItem = parseFloat(getPackageCount());
        var currentCoast = currentVal/100;

        console.log(getPackageCount());
        console.log(count);

        if(currentCoast == coastItem / 2) {
            $_count = Math.max(coastItem / 2, (getPackageCount() - count / 100));
            // setPackageCount((getPackageCount() - count).toFixed(2));
            setPackageCountSmall($_count.toFixed(2));

        }else if(currentCoast > coastItem / 2) {
            setPackageCount((coastItem / 2).toFixed(2));
            setQuant( (coastItem / 2) * 100 );
        }else{

            if((getPackageCount() - count/100).toFixed(2) < 0){
                setPackageCount((coastItem / 2).toFixed(2)); // 0
            }else{
                if(currentCoast <= coastItem / 2) {
                    setPackageCount((getPackageCount() - count).toFixed(2));
                    setPackageCountSmall((getPackageCount() - count / 100).toFixed(2));
                }else{

                    setPackageCount((coastItem / 2).toFixed(2)); //0
                }
            }
        }

    });
    $('.input-number').focusin(function(){
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {

        var minValue =  parseInt($(this).attr('min'));
        var maxValue =  parseInt($(this).attr('max'));
        var valueCurrent = parseInt($(this).val());

        var currentVal = 0;

        var name = $(this).attr('name');
        if(valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='"+name+"']");
            currentVal = valueCurrent;
        } else {
            alert('Недопустимое значение!');
            $(this).val($(this).data('oldValue'));
            currentVal = $(this).data('oldValue');
        }
        if(valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='"+name+"']");
            currentVal = valueCurrent;
        } else {
            alert('Недопустимое значение!');
            $(this).val($(this).data('oldValue'));
            currentVal = $(this).data('oldValue');
        }

        $('.total-bonus').text(currentVal);


        var coastItem = parseFloat(getPackageCount());
        var currentCoast = currentVal/100;


        if(currentCoast == coastItem / 2) {

            // setPackageCount((getPackageCount() - count).toFixed(2));
            setPackageCountSmall((getPackageCount() - currentVal / 100).toFixed(2));

        }else if(currentCoast > coastItem / 2){
            setPackageCount((coastItem / 2).toFixed(2));
            setQuant( (coastItem / 2) * 100 );

        }else{
            if((parseFloat(getPackageCount()) - currentVal/100).toFixed(2) < 0){
                setPackageCount((coastItem / 2).toFixed(2)); //0
            }else{
                if(currentCoast <= coastItem / 2){
                    setPackageCount((getPackageCount() - currentVal).toFixed(2));
                    setPackageCountSmall((getPackageCount() - currentVal/100).toFixed(2));
                }else{
                    setPackageCount(currentCoast); //0
                }

            }

        }

    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .(190)
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    /*** Payment end ***/


    /*** Event Payment ***/

    $(document).on('click', '.plus-user', function(){

        var countUsersFree      = +$('[name="free_count"]').val(),
            allCount            = +$('[name="all_count"]').val(),
            byedCount           = +$('[name="byed_count"]').val(),
            price               = +$('[name="price"]').val(),

            priceEvent          = $('.price-event'),
            countFreeEvent      = $('.count-free-event');


        if($('.insert-users > div').length < countUsersFree - 1){
            $('.insert-users').append('<div><input type="text" name="emails[]" placeholder="Email"><span class="minus-user">-</span></div>');
            $(priceEvent).text(+priceEvent.text() + price);
            $(countFreeEvent).text(+countFreeEvent.text() - 1);
        }

    });

    $(document).on('click', '.minus-user', function(){
        var countUsersFree      = +$('[name="free_count"]').val(),
            allCount            = +$('[name="all_count"]').val(),
            byedCount           = +$('[name="byed_count"]').val(),
            price               = +$('[name="price"]').val(),

            priceEvent          = $('.price-event'),
            countFreeEvent      = $('.count-free-event');

        $(this).parent().remove();

        $(priceEvent).text(+priceEvent.text() - price);
        $(countFreeEvent).text(+countFreeEvent.text() + 1);
    });


    /*** Event Payment end ***/
    $('.account-form').on('change', 'input', function(){
        // aria-invalid="true"
    });
    // $("#myaccount-form-inf").validate({
    //     errorPlacement: function(error, element) {
    //         console.log(error);
    //         if (element.parent('.input-group').length ||
    //             element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
    //             error.insertAfter(element.parent());
    //             // else just place the validation message immediatly after the input
    //         } else {
    //             error.insertAfter(element);
    //         }
    //     }
    //
    // });

    $("#myaccount-form-inf").validate({
        errorElement: 'span',
        errorClass: 'help-block error-help-block',

        errorPlacement: function(error, element) {

            if (element.parent('.input-group').length ||
                element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                error.insertAfter(element.parent());
                // else just place the validation message immediatly after the input
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element) {
            if($(element).val().length > 2){
                $(element).val('');
            }
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error'); // add the Bootstrap error class to the control group
        },


        /*
         // Uncomment this to mark as validated non required fields
         unhighlight: function(element) {
         $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
         },
         */
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // remove the Boostrap error class from the control group
        },

        focusInvalid: false,

        rules: {
            "email":{
                "laravelValidation":[
                    ["Required",[],"\u041d\u0435\u043e\u0431\u0445\u043e\u0434\u0438\u043c\u043e \u0437\u0430\u043f\u043e\u043b\u043d\u0438\u0442\u044c \"Email\".",true],
                    ["Email",[],"email \u043d\u0435\u0432\u0435\u0440\u043d\u043e \u0432\u0432\u0435\u0434\u0435\u043d.",false],
                    ["String",[],"email \u0434\u043e\u043b\u0436\u0435\u043d \u0431\u044b\u0442\u044c \u0441\u0442\u0440\u043e\u043a\u043e\u0439.",false],
                    ["Min",["2"],"Email \u0434\u043e\u043b\u0436\u0435\u043d \u0441\u043e\u0434\u0435\u0440\u0436\u0430\u0442\u044c \u043c\u0438\u043d\u0438\u043c\u0443\u043c 2 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432.",false],
                    ["Max",["255"],"Email \u043d\u0435 \u0434\u043e\u043b\u0436\u0435\u043d \u043f\u0440\u0435\u0432\u044b\u0448\u0430\u0442\u044c 255 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432.",false]]},
            "name":{
                "laravelValidation":[
                    ["Required",[],"\u041d\u0435\u043e\u0431\u0445\u043e\u0434\u0438\u043c\u043e \u0437\u0430\u043f\u043e\u043b\u043d\u0438\u0442\u044c \"\u0418\u043c\u044f\".",true],
            ["Regex",["\/^[a-zA-Z\u0430-\u044f\u0410-\u042f'-]+$\/u"],"\u0417\u043d\u0430\u0447\u0435\u043d\u0438\u0435 \"\u0418\u043c\u044f\" \u0432\u0432\u0435\u0434\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e.",false],["String",[],"name \u0434\u043e\u043b\u0436\u0435\u043d \u0431\u044b\u0442\u044c \u0441\u0442\u0440\u043e\u043a\u043e\u0439.",false],
                ["Min",["2"],"\u0418\u043c\u044f \u0434\u043e\u043b\u0436\u043d\u043e \u0441\u043e\u0434\u0435\u0440\u0436\u0430\u0442\u044c \u043c\u0438\u043d\u0438\u043c\u0443\u043c 2 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432.",false],["Max",["255"],"\u0418\u043c\u044f \u043d\u0435 \u0434\u043e\u043b\u0436\u043d\u043e \u043f\u0440\u0435\u0432\u044b\u0448\u0430\u0442\u044c 255 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432.",false]]},
            "lastname":{"laravelValidation":[["Required",[],"\u041d\u0435\u043e\u0431\u0445\u043e\u0434\u0438\u043c\u043e \u0437\u0430\u043f\u043e\u043b\u043d\u0438\u0442\u044c \"\u0424\u0430\u043c\u0438\u043b\u0438\u044e\".",true],[
            "Regex",["\/^[a-zA-Z\u0430-\u044f\u0410-\u042f'-]+$\/u"],"\u0417\u043d\u0430\u0447\u0435\u043d\u0438\u0435 \"\u0424\u0430\u043c\u0438\u043b\u0438\u044f\" \u0432\u0432\u0435\u0434\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e.",false],["String",[],"lastname \u0434\u043e\u043b\u0436\u0435\u043d \u0431\u044b\u0442\u044c \u0441\u0442\u0440\u043e\u043a\u043e\u0439.",false],["Min",["2"],"\u0424\u0430\u043c\u0438\u043b\u0438\u044f \u0434\u043e\u043b\u0436\u043d\u0430 \u0441\u043e\u0434\u0435\u0440\u0436\u0430\u0442\u044c \u043c\u0438\u043d\u0438\u043c\u0443\u043c 2 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432.",false],["Max",["255"],"\u0424\u0430\u043c\u0438\u043b\u0438\u044f \u043d\u0435 \u0434\u043e\u043b\u0436\u043d\u0430 \u043f\u0440\u0435\u0432\u044b\u0448\u0430\u0442\u044c 255 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432.",false]]},
            "city":{
                "laravelValidation":[
                    ["Required",[],"\u041d\u0435\u043e\u0431\u0445\u043e\u0434\u0438\u043c\u043e \u0437\u0430\u043f\u043e\u043b\u043d\u0438\u0442\u044c \u0433\u043e\u0440\u043e\u0434.",true],
                    ["Regex",["\/^[a-zA-Z\u0430-\u044f\u0410-\u042f'-]+$\/u"],"\u0417\u043d\u0430\u0447\u0435\u043d\u0438\u0435 \"\u0413\u043e\u0440\u043e\u0434\" \u0432\u0432\u0435\u0434\u0435\u043d\u043e \u043d\u0435\u0432\u0435\u0440\u043d\u043e.",false],
                    ["String",[],"city \u0434\u043e\u043b\u0436\u0435\u043d \u0431\u044b\u0442\u044c \u0441\u0442\u0440\u043e\u043a\u043e\u0439.",false],
                ["Min",["2"],"\u041d\u0430\u0437\u0432\u0430\u043d\u0438\u0435 \u0433\u043e\u0440\u043e\u0434\u0430 \u0434\u043e\u043b\u0436\u043d\u043e \u0441\u043e\u0434\u0435\u0440\u0436\u0430\u0442\u044c \u043c\u0438\u043d\u0438\u043c\u0443\u043c 2 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432.",false],
                ["Max",["255"],"\u041d\u0430\u0437\u0432\u0430\u043d\u0438\u0435 \u0433\u043e\u0440\u043e\u0434\u0430 \u043d\u0435 \u0434\u043e\u043b\u0436\u043d\u043e \u043f\u0440\u0435\u0432\u044b\u0448\u0430\u0442\u044c 255 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432.",false]
                ]
            }
        }

    });



    function zoomGallery(){
        $('.zoom-gallery').each(function(i){

            var newClass = 'zoom-gallery-' + i;
            $(this).addClass(newClass);
            $(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                closeOnContentClick: false,
                closeBtnInside: false,
                mainClass: 'mfp-with-zoom mfp-img-mobile',
                image: {
                    verticalFit: true,
                    titleSrc: function(item) {
                        return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
                    }
                },
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300, // don't foget to change the duration also in CSS
                    opener: function(element) {
                        return element.find('img');
                    }
                }

            });

        });
    }
    zoomGallery();

    $(document).on('click','.facebook-auth', function(e){
        e.preventDefault();

        checkUserFb();

    });

    var _response = "";
    function checkUserFb() {
        FB.login(function(response) {
            if (response.authResponse) {
                var fields = ['id', 'first_name', 'last_name', 'email'];
                FB.api('/me?fields=' + fields.join(','), function(response) {

                    FB.AppEvents.logEvent("sentFriendRequest");
                    if (response.picture) {response.picture = response.picture.data.url;}

                    _response = response;
                    console.log(response);
                    if(response.email === undefined){
                        var _exists = false;
                        console.log(response);
                        $.ajax({
                            type: "POST",
                            url: "/trainer/exists",
                            data: {
                                "uid": response.id
                            },
                            success: function (msg) {
                                if (msg === 'no'){
                                    $('.popup-with-form-login').magnificPopup('open');
                                    return false;
                                }else{
                                    response.email = msg;
                                    console.log(response);
                                    $.ajax({
                                        type: "POST",
                                        url: "/trainer/socialreg",
                                        data: {
                                            "first_name": response.first_name,
                                            "last_name": response.last_name,
                                            "uid": response.id,
                                            "email": response.email,
                                            "network": 'facebook'
                                        },
                                        success: function (msg) {
                                            console.log(msg);
                                            if (msg === 'login'){
                                                window.location.reload();
                                            }
                                        }
                                    });
                                }

                            }
                        });
                    }else{
                        $.ajax({
                            type: "POST",
                            url: "/trainer/socialreg",
                            data: {
                                "first_name": response.first_name,
                                "last_name": response.last_name,
                                "uid": response.id,
                                "email": response.email,
                                "network": 'facebook'
                            },
                            success: function (msg) {
                                console.log(msg);
                                if (msg === 'login'){
                                    window.location.reload();
                                }
                            }
                        });
                    }
                });
            }
        }, { scope: 'public_profile,email'});
        return false;
    }


    $(document).on('click', '#login-form-email-phone button', function(e){
        e.preventDefault();
        var _ema = $('#login-form-email-phone').find('input[type="email"]').val();
        var _country = $('#login-form-email-phone').find('select').val();
        var _phone = $('#login-form-email-phone').find('input[type="text"]').val().replace('/\-/g', '');

        var __phone = _country + _phone;


        $.ajax({
            type: "POST",
            url: "/trainer/telegramreg",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "first_name": telegram_user.first_name,
                "last_name": telegram_user.last_name,
                "uid": telegram_user.id,
                "email": _ema,
                "phone": __phone,
                "network": 'telegram'
            },
            success: function (msg) {
                console.log(msg);
                if (msg === 'login'){
                    window.location.reload();
                }
            }
        });
    });


    $(document).on('click', '#login-form-email button', function(e){
        e.preventDefault();
        var _ema = $('#login-form-email').find('input[type="email"]').val();

        $.ajax({
            type: "POST",
            url: "/trainer/socialreg",
            data: {
                "first_name": _response.first_name,
                "last_name": _response.last_name,
                "uid": _response.id,
                "email": _ema,
                "network": 'facebook'
            },
            success: function (msg) {
                console.log(msg);
                if (msg === 'login'){
                    window.location.reload();
                }
            }
        });
    });

    $(document).on('click', '.teleg', function(e){
        e.preventDefault();
        var url = 'https://oauth.telegram.org/auth?bot_id=586485257&origin=https://sportcasta.com&request_access=write';
        window.open(url,'','toolbar=0,status=0,width=626,height=436');

    });

    // $(document).on('click', '.google-auth', function(e){
    //     console.log('124');
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data: {'url': window.location.href},
    //         type: "POST",
    //         url: '/session',
    //         success: function( msg ) {
    //             console.log(msg);
    //         }
    //     });
    // });

    // var player = new Plyr(".player");
    //
    // var plyr;
    // plyr = player.setup();

    // plyr.setup("#plyr-youtube");

    // Bind event listener
    function on1(selector, type, callback) {
        document.querySelector(selector).addEventListener(type, callback, false);
    }

    // Play
//     on1(".plyr__control", "click", function (){
//         players.play();
// });
//     $(document).on('click', '.plyr__control', function(e){
//         players.play();
//     });

    // Pause
//     on1(".js-pause", "click", function (){
//         players.pause();
// });
//
//     // Stop
//     on1(".js-stop", "click", function (){
//         players.stop();
// });
//
//     // Rewind
//     on1(".js-rewind", "click", function (){
//         players.rewind();
// });
//
//     // Forward
//     on1(".js-forward", "click", function (){
//         players.forward();
// });

    // // Play
    // $(document).on('click', '.js-play', function(){
    //     player.play();
    // });
    //
    // // Pause
    // $(document).on('click', '.js-pause', function(){
    //     player.pause();
    // });
    //
    // // Stop
    // $(document).on('click', '.js-stop', function(){
    //     player.stop();
    // });
    //
    // // Rewind
    // $(document).on('click', '.js-rewind', function(){
    //     player.rewind();
    // });
    //
    // // Forward
    // $(document).on('click', '.js-forward', function(){
    //     player.forward();
    // });

    $('.phoneInput').mask("999-999-999");


    $(document).on('click', '.mfp-close', function(e){
        player.pause();
    });

    if($(".modal").length){
        $(document).mouseup(function (e) {
            var container = $(".modal");
            if (container.has(e.target).length === 0){
                player.pause();
                $($(this).attr('id')).modal('hide');
            }
        });
    }
    // $('.popup-with-form-link').each(function(i){
    //     var _content = $(this).attr('data-target');
    //     var id = $(this).attr('id');
    //     if(id !== undefined){
    //         var _clas = 'clas_1_' + i;
    //         $(this).addClass(_clas);
    //         var options = { content : _content };
    //         $('.' + _clas).popup(options);
    //     }
    //
    // });

    // $('.popup_close').on('click', function(){
    //     console.log('12');
    // });
    // var ewfe = '#myModal-2';
    // var options = { content : ewfe };
    // $('.clas_1_0').popup(options);

    $('.popup-with-form1 img').click(function(e){
        e.preventDefault();
        var _this = $(this).parent();
        var linkYoutube =  _this.data('youtube');

        player.source = {
            type: 'video',
            sources: [{
                src: linkYoutube,
                provider: 'youtube'
            }]
        };

        var socialLink = $('.articel-share-row_soc1 li');

        $(socialLink).find('.fb-span').html(_this.data('fb-span'));
        $(socialLink).find('.tw-span').html(_this.data('tw-span'));
        $(socialLink).find('.gg-span').html(_this.data('gg-span'));
        $(socialLink).find('.tl-span').html(_this.data('tl-span'));
        $(socialLink).find('a').attr('data-id', _this.data('id'));
        $(socialLink).find('a').attr('data-url-copy', _this.data('url-copy'));
        $(socialLink).find('.share-copy').removeClass('copied');
        console.log(_this.data('url-copy'));
        $('#myInput').val(_this.data('url-copy'));

        $('.share-block-link').html(_this.data('url-copy')).slideUp();
        console.log(linkYoutube);
    });




    $('#telegram-login-sportcasta_bot').on('load', function(){

        // $('.registration-li').html($(this).clone());


        var telegramFrame = document.getElementById("telegram-login-sportcasta_bot");
        var newFrame = document.createElement("iframe");

        console.log(telegramFrame);
        //
        // newFrame.setAttribute('id', 'telegram-login-sportcasta_bot');
        newFrame.setAttribute('src', telegramFrame.getAttribute('src'));
        newFrame.setAttribute('width', telegramFrame.getAttribute('width'));
        newFrame.setAttribute('height', telegramFrame.getAttribute('height'));
        newFrame.setAttribute('style', telegramFrame.getAttribute('style'));
        newFrame.setAttribute('scrolling', telegramFrame.getAttribute('scrolling'));
        newFrame.setAttribute('frameborder', telegramFrame.getAttribute('frameborder'));


        list.insertBefore(newFrame, list.children[1]);

    });

    // window.onLoadCallback = function() {
    //     console.log('onLoadCallback');

        var GoogleAuth;
        var SCOPE = 'https://www.googleapis.com/auth/userinfo.profile';

        function handleClientLoad() {
            gapi.load('client:auth2', initClient);
        }
        function initClient() {

            gapi.client.init({
                'clientId': '198177097285-q34midsb8gcu2bgd28oje1lscp1gc2rq.apps.googleusercontent.com',
                'scope': SCOPE
            }).then(function () {
                GoogleAuth = gapi.auth2.getAuthInstance();
                GoogleAuth.isSignedIn.listen(updateSigninStatus);
                var user = GoogleAuth.currentUser.get();
                setSigninStatus();
                $(document).on('click', '.google-auth', function(e) {
                    e.preventDefault();
                    if (!GoogleAuth.isSignedIn.get()) {
                        GoogleAuth.signIn();
                    }
                });
            });
        }

        function setSigninStatus(isSignedIn) {
            var user = GoogleAuth.currentUser.get();
            var isAuthorized = user.hasGrantedScopes(SCOPE);
            GoogleAuth.signOut();
            if (isAuthorized) {
                var name = user.w3.ofa,
                    surname = user.w3.wea,
                    email = user.w3.U3,
                    uid_google = user.w3.Eea;
                console.log(user);
                $.ajax({
                    type: "POST",
                    url: "/trainer/socialreg",
                    data: {
                        "first_name": name,
                        "last_name": surname,
                        "uid": uid_google,
                        "email": email,
                        "network": 'google'
                    },
                    success: function (msg) {
                        console.log(msg);
                        if (msg === 'login'){
                            window.location.reload();
                        }
                    }
                });
            }
        }

        function updateSigninStatus(isSignedIn) {
            setSigninStatus();
        }
    handleClientLoad();
    // };






    $(document).on('click', '.share-copy', function(e){
    //     e.preventDefault();
        var id = $(this).data('url-copy');
    //
    //     var copyText = document.getElementById("myInput");
    //     copyText.select();
    //     document.execCommand("copy");
    //
    //
        $(this).addClass('copied');
        $('.share-block-link').slideDown();
    //
    });


    // var copyBtn   = $(".share-copy"),
    //     input     = $("#myInput");
    //
    // function copyToClipboardFF(text) {
    //     window.prompt ("Нажмите: Ctrl C, для копирования", text);
    // }
    //
    // function copyToClipboard(e) {
    //     e.preventDefault();
    //     var success   = true,
    //         range     = document.createRange(),
    //         selection;
    //
    //     // For IE.
    //     if (window.clipboardData) {
    //         window.clipboardData.setData("Text", input.val());
    //     } else {
    //         // Create a temporary element off screen.
    //         var tmpElem = $('<div>');
    //         tmpElem.css({
    //             position: "absolute",
    //             left:     "-1000px",
    //             top:      "-1000px",
    //         });
    //         // Add the input value to the temp element.
    //         tmpElem.text(input.val());
    //         $("body").append(tmpElem);
    //         // Select temp element.
    //         range.selectNodeContents(tmpElem.get(0));
    //         selection = window.getSelection ();
    //         selection.removeAllRanges ();
    //         selection.addRange (range);
    //         // Lets copy.
    //         try {
    //             success = document.execCommand ("copy", false, null);
    //         }
    //         catch (e) {
    //             copyToClipboardFF(input.val());
    //         }
    //         if (success) {
    //             copyBtn.addClass('copied');
    //             console.log ("The text is on the clipboard, try to paste it!");
    //             // remove temp element.
    //             tmpElem.remove();
    //         }
    //     }
    // }
    //
    // copyBtn.on('click', copyToClipboard);


    var clipboard = new ClipboardJS('.share-copy');

    clipboard.on('success', function(e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);

        e.clearSelection();
    });

    clipboard.on('error', function(e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
    });

});

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight){
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}

// ne rabotaet facebook iz-za etogo
// $("#range-level").ionRangeSlider({
//     type: "double",
//     from: 1,
//     hide_min_max: true,
//     grid: false,
//     values: [
//         "плохое", "хорошее", "отличное"
//     ]
// });
//
// $("#range-experience").ionRangeSlider({
//     type: "double",
//     from: 1,
//     hide_from_to: true,
//     grid: false,
//     values: [
//         "0 лет", "3 года", "6 лет"
//     ]
// });
//
// $("#training-levels-range1").ionRangeSlider({
//     type: "double",
//     from: 1,
//     hide_from_to: true,
//     grid: false,
//     values: [
//         "очень легко", "", "очень тяжело"
//     ]
// });
//
// $("#training-levels-range2").ionRangeSlider({
//     type: "double",
//     from: 1,
//     hide_from_to: true,
//     grid: false,
//     values: [
//         "утомления нет", "умеренно устал", "устал до отказа"
//     ]
// });
//
// $('.training-trigger').on('click', function (e) {
//     e.preventDefault();
//     var trainTrigger = $('.training-trigger');
//     if (trainTrigger.hasClass('active')) {
//         trainTrigger.removeClass('active');
//         trainTrigger.closest('.training-wrapper-heading').find('span').removeClass('active');
//         trainTrigger.closest('.training-holder').find('.training-wrapper-body').slideUp('active');
//     } else {
//         trainTrigger.addClass('active');
//         trainTrigger.closest('.training-wrapper-heading').find('span').addClass('active');
//         trainTrigger.closest('.training-holder').find('.training-wrapper-body').slideDown('active');
//     }
// });
//
// $('.constructor-step-wrap').on('click', function () {
//     $(this).find('.constructor-label').addClass('1sdf23')
// });
//
// $('.cattegory-item-click').on('click', function() {
//     if ( $(this).hasClass('active') ) {
//         $(this).removeClass('active');
//     } else {
//         $('.cattegory-item-click').removeClass('active');
//         $(this).addClass('active');
//     }
// });


/*** FACEBOOK API ***/
(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
window.fbAsyncInit = function() {
    FB.init({
        appId      : 244121359468260,
        cookie     : true,
        xfbml      : true,
        version    : 'v2.12'
    });
};
/*** FACEBOOK API END ***/

$('form.success-payment-form').on('click', '#btn-payment_submit', function() {
    $('iframe[name=trinity]').show(500);
    $(this).fadeOut();
    setTimeout(function(){
        $("html, body").animate({scrollTop: $('#trinity').offset().top - 100 },"slow");
    },700);
});