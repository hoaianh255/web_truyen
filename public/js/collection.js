$(document).ready(function(){
    $(window).scroll(function(){
        if($(this).scrollTop() > 100){
            $('.scrolltop').fadeIn();
        }
        else{
            $('.scrolltop').fadeOut();
        }
    });
    $(".link").on('click', function(event) {

        if (this.hash !== "") {

            event.preventDefault();

            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top
            },500, function() {

                window.location.hash = hash;
            });
        }
    });
    $("#gallery img").on({
        mouseover: function() {
            $(this).css({
                'filter' : 'grayscale(0%)',
                'cursor' : 'pointer',
                'transform': 'scale(1.1)'

            });
        },
        mouseout: function(){
            $(this).css({
                'filter' : 'grayscale(100%)',
                'transform': 'scale(1)'
            });
        },
        click: function(){
            var urlImg = $(this).attr('src');
            $('#mainImg').fadeOut(300,function(){
                $(this).attr('src',urlImg);
            }).fadeIn(300);
        }
    });
    $('#demoForm').submit(function(e){
        e.preventDefault();
        var name = $('#name').val();
        var email = $('#email').val();
        var sdt = $('#sdt').val();
        var diachi = $('#diachi').val();

        $(".error").remove();

        if(name == ""){
            $("#name").after('<span class="error">Ban chua nhap ten!</span>');
        }
        if(sdt == ""){
            $("#sdt").after('<span class="error">Ban chua nhap so dien thoai!</span>');
        }else{
            var bieuthuc = /[0-9]{10,11}/;
            var valid = bieuthuc.test(sdt);
            if(!valid){
                $("#sdt").after('<span class="error">so dien thoai khong hop le</span>');
            }
        }
        if(diachi == ""){
            $("#diachi").after('<span class="error">Ban chua nhap dia chi!</span>');
        }
    });

    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("topbar").style.top = "0";
            document.getElementById("bottombar").style.bottom = "0";

        } else {
            document.getElementById("topbar").style.top = "-80px";
            document.getElementById("bottombar").style.bottom = "-80px";
        }
        prevScrollpos = currentScrollPos;
    }



});
