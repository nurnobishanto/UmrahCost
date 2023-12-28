/**
 *
 * ----------------------------------------------------------
 *
 * Template : AmerSolution
 * Author : AkaatIt
 * Author URI : https://akaarit.com/
 *
 * ----------------------------------------------------------
 *
 **/

;(function($){

    'use strict'

    var dropDown = $('.has-children'),
        sidebar = $('.ams-sidebar'),
        dashboard = $('.dashboard-content'),
        toggle = $('.nav-toggle');

    dropDown.click(function(e){

        if($(window).width() > 1200){

            if($(".ams-sidebar").hasClass("active")){

                return false

            }else{

                $(this).next('.sub-menu').slideToggle("fast");
                $(this).toggleClass('active');
            }
            
        }else{
            $(this).next('.sub-menu').slideToggle("fast");
            $(this).toggleClass('active');
        }
    })
    
    toggle.click(function(){

        if(dropDown.hasClass("active")){

            $('.has-children.active + .sub-menu').slideToggle("fast");

        }

        sidebar.toggleClass('active')
    })

    if($("#supplier-table").length){
       
        $("#supplier-table").DataTable({
            responsive: true,
            scrollX: true
        });
    }

    if($(".unit-select-box").length){
        
        $('.unit-select-box').select2();
    }
    
    // Advanced Search Box

    if($(".advanced-btn").length){

        $(".advanced-btn").on("click",function(){

            if($(".panel-advanced-search").length){
                $(".panel-advanced-search").slideToggle("fast")
            }
        })
        
    }

    // Nice Select

    // if($(".panel-form-select").length){

    //     $(".panel-form-select").niceSelect();

    // }

    // Range Date Picker

    $(function() {
        $('input[name="datetimes"]').daterangepicker({
          timePicker: true,
          startDate: moment().startOf('hour'),
          endDate: moment().startOf('hour').add(32, 'hour'),
          locale: {
            format: 'DD/M hh:mm A'
          }
        });
    });

    // User Table

    if($("#user-table").length){

        $("#user-table tr").on("click",function(){

            $(".user-container").addClass("active");

        })

        $(".close-details").on("click",function(){

            $(".user-container").removeClass("active");

        })
    }

    // User Edit Options

    if($("#more-action").length){

        $("#more-action").on("click",function(){

            $(".btn-toolbar .dropdown-menu").slideToggle("300")

        })
    }

    if($(".edit-user").length){

        $(".edit-user").on("click",function(){

            $(".user-edit-modal").addClass("show")

        })

        $(".cls-user-edit").on("click",function(){
            
            $(".user-edit-modal").removeClass("show")

        })

    }

    $("#view-all").on("click",function(){
        $(".ams-route-track").addClass("show")
    })

    $(".track-toggle").on("click",function(){
        $(".ams-route-track").removeClass("show")
    })


    
})(jQuery);

function langSelect(){
    document.getElementById("lang-dropdown").classList.toggle("show");
}

function actionSelect() {
    document.getElementById("action-dropdown").classList.toggle("show");
}


// Small Screen Stack Menu

function profileSelect(){
    document.getElementById("profile-dropdown").classList.toggle("show");
}

function notifySelect(){
    document.getElementById("notify-dropdown").classList.toggle("show");
}

(function(){

    var stackMenu = document.querySelector(".menu-stack");

    if(stackMenu != null){
        stackMenu.addEventListener("click", () => {
            document.querySelector(".main-nav").classList.toggle("move");
        })
    }

    window.onclick = function(event) {
        if(event.length){
            if ((!event.target.matches('.dropbtn')) && (!event.taget.matches(".ams-admin"))) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                    }
                }
            }
        }
    }
 
    // Text Editor
    
    var path = window.location.pathname;
    var page = path.split("/").pop();
    if(page=='add-supplier.html'){
        CKEDITOR.replace( 'textbox' );    
    }


    // Sidebar fixed

    var navToggle = document.querySelector(".nav-toggle");

    if(navToggle != null){
        navToggle.onclick = function(){
            if(window.innerWidth <=1200 ){
               document.querySelector(".ams-nav-wpr").classList.toggle("fixed");
            }
        }
    }

    // Search Input

    var searchIocn = document.querySelector(".search-icon");
    var navSearch = document.querySelector(".nav-search-input");
    var closeIcon = document.querySelector(".search-close");
    
    if(searchIocn != null){
        searchIocn.addEventListener("click",() => {
            navSearch.classList.add("open");
        })
    }

    if(closeIcon != null){
        closeIcon.onclick = function(){
            navSearch.classList.remove("open");
        }
    }

    // Get the products container
    var producttList = document.getElementsByClassName("product-list")

    if(producttList.length > 0){
       
        // Get all products with class="single-product" inside the container
        var cartProducts = producttList[0].getElementsByClassName("single-product");

        // Loop through the products and add the count class to the current/clicked div
        for (var i = 0; i < cartProducts.length; i++) {
            cartProducts[i].addEventListener("click", function() {
            this.className += " count";
           });
        }

    }

    // Dragable List

    const dragList = document.querySelectorAll('.nested');

    if(dragList.length > 0){

        dragula([].slice.apply(dragList));

    }

    // Profile Pic

    $(document).ready(function() {

    
        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
    
                reader.onload = function (e) {
                    $('.profile-pic').attr('src', e.target.result);
                }
        
                reader.readAsDataURL(input.files[0]);
            }
        }
        
    
        $(".file-upload").on('change', function(){
            readURL(this);
        });
        
        $(".upload-image").on('click', function() {
           $(".file-upload").click();
        });

        $(".upload-button").on('click', function() {
            $(".ams-file-modal").addClass("show")
        });

    });

    if($(".close-modal").length){

        $(".close-modal").on("click",function(){
            
            $(".ams-file-modal").removeClass("show")
        })
    }

    const loadImages = document.querySelectorAll(".image-container .single-image");

    // if(loadImages != null){

    //     for(let i=0; i< loadImages.length ; i++){
    //         loadImages[i].addEventListener("click",function(){
    //             this.classList.add("show")
    //         })
    //     }
    // }
    
    // Phone Input

    var input = document.querySelector("#phone"),
    output = document.querySelector("#output");
  
    var iti = window.intlTelInput(input, {
    nationalMode: true,
    utilsScript: "../../build/js/utils.js?1638200991544" // just for formatting/placeholders etc
    });
  
    var handleChange = function() {
        var text = (iti.isValidNumber()) ? "International: " + iti.getNumber() : "Please enter a number below";
        var textNode = document.createTextNode(text);
        output.innerHTML = "";
        output.appendChild(textNode);
    };
  
    // listen to "keyup", but also "change" to update when the user selects a country
    input.addEventListener('change', handleChange);
    input.addEventListener('keyup', handleChange);

})()
   

