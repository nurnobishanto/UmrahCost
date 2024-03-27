;(function($){

    // WOW Animation

    $(document).ready(function () {
        new WOW().init();
    });

    // Offer Slider


    $(".banner-slider").owlCarousel({
        items: 1,
        loop:true,
        autoplay:true,
        nav:true,
        navText: ["<i class='icofont-thin-left'></i>","<i class='icofont-thin-right'></i>"],
        dots:false,
    })

    // Trip Slider


    $(".trips-slider").owlCarousel({
        loop:true,
        autoplay:true,
        slideBy: 1,
        nav:true,
        navText: ["<i class='icofont-thin-left'></i>","<i class='icofont-thin-right'></i>"],
        dots:false,
        margin: 16,
        responsive:{
            0:{
                items: 1.15,
            },
            575:{
                items: 2.5,
            },
            767:{
                items: 3.5,
            },
            992:{
                items: 4.5
            },
            1200:{
                items: 5.5
            }
        }
    })

    // Quick Links Slider

    $(".quick-links-slider").owlCarousel({
        loop:true,
        autoplay:true,
        slideBy: 1,
        nav:true,
        navText: ["<i class='icofont-thin-left'></i>","<i class='icofont-thin-right'></i>"],
        dots:false,
        margin: 16,
        responsive:{
            0:{
                items: 1,
            },
            575:{
                items: 1.25,
            },
            767:{
                items: 2
            },
            992:{
                items: 2.25,
            },
            1200:{
                items:3
            }
        }
    })

    // Hotel Image Slider

    $(".hotel-image-slides").owlCarousel({
        items:1,
        loop:true,
        autoplay:true,
        nav:true,
        navText: ["<i class='icofont-thin-left'></i>","<i class='icofont-thin-right'></i>"],
        dots:false,
        margin:8,
    })

    $('.owl-nav button').attr('aria-label', 'owl-navigation');

    // Ticket Options

    $(".option-select-btn").on("click",function(){
        $(this).next(".travel-options").addClass("show")
        // $(".travel-options").addClass("show");
    })

    $(".travel-options .opts-apply").on("click",function(){
        $(".travel-options").removeClass("show");
    })

    // Room Options

    $(".option-select-btn").on("click",function(){
        $(this).next(".room-options").addClass("show")
        // $(".travel-options").addClass("show");
    })

    $(".room-options .opts-apply").on("click",function(){
        $(".room-options").removeClass("show");
    })

    $(window).click(function(){
        if($(".room-options").hasClass("show")){

        }
    })

    // Nice Select

    $(".nice-select").niceSelect();

    // Toggle Price Range

    $(".flight-category .nav-link").on("click",function(){
        if($("#short-tab").hasClass("active")){
            $(".price-filter").css("display", "none")
        }else{
            $(".price-filter").css("display", "block");
        }
    })

    // toggle Flight Info

    $(".info-toggle").on("click",function(){
        if($(this).text() == 'Show Flight Details'){
            $(this).text("Hide Flight Details")
        }else{
            $(this).text("Show Flight Details")
        }
        $(this).parent().siblings('.flight-info-details').slideToggle("")
    })

    $(".booking-info-tgl").on("click",function(){
        if($(this).text() == 'Show Details'){
            $(this).text("Hide Details")
        }else{
            $(this).text("Show Details")
        }

        $(this).parent().siblings('.meta-info-wpr').slideToggle("")
    })

    // Toggle Visa Info

    $(".require-info-toggle").on("click",function(){
        if($(this).text() == 'View Required Documents'){
            $(this).text("Hide Required Documents")
        }else{
            $(this).text("View Required Documents")
        }
        $(this).parents().siblings('.visa-requirement-details').slideToggle("300")
    })

    // Card Content Toggle

    $(".content-toggle").on("click",function(){
        $("i", this).toggleClass("icofont-circled-up icofont-circled-down");
        $(this).siblings(".card-body").slideToggle("300")
    })

    // Range Date Picker

    $(function() {
        $('input[name="datetimes"]').daterangepicker({
          timePicker: false,
          startDate: moment().startOf('hour'),
          endDate: moment().startOf('hour').add(32, 'hour'),
          locale: {
            format: 'MM/DD/YYYY'
          }
        });

        $(".datetimes").each(function(i,elem){
            $(elem).on("change",function(){

                const selecDates = $(this).val().split("-");
                const depDate = selecDates[0];
                const reDate = selecDates[1];

                // const selectDate = $(this).val();
                // const lastDate = selectDate.split("-")[1];

                // const lastDateStr = new Date(lastDate);

                const depDateStr = new Date(depDate);
                const reDateStr = new Date(reDate);

                const options = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };

                let formateDepDate = depDateStr.toLocaleDateString('en-DE', options);
                let depDateValue = formateDepDate.split(/,| /);
                depDateValue.splice(1,1);

                let formateReDate = reDateStr.toLocaleDateString('en-DE', options);
                let reDateValue = formateReDate.split(/,| /);
                reDateValue.splice(1,1);

                // var dateEle =  '<h2>'+ dateValue[1] +'<sub>'+ dateValue[2] +'\''+ dateValue[3].slice(-2) +'</sub></h2> <p>'+ dateValue[0] +'</p>';

                let depDateEle =  `<h2>${depDateValue[1]} <sub>${depDateValue[2]}'${depDateValue[3].slice(-2)}</sub></h2> <p>${depDateValue[0]}</p>`;
                let reDateEle =  `<h2>${reDateValue[1]} <sub>${reDateValue[2]}'${reDateValue[3].slice(-2)}</sub></h2> <p>${reDateValue[0]}</p>`;

                $("#dep-date").siblings(".option-select-btn").html(depDateEle)
                $(this).siblings('.option-select-btn').html(reDateEle)

            })
        })
    });

    // Date Picker

    if($(".datePicker").length){
        $(".datePicker").datepicker({
            format:'mm/dd/yyyy',
            autoclose:true,
            offset: 10,
        }).datepicker("setDate",'now');

        $(function() {

            $(".option-select-btn").siblings('.datePicker').each(function(i,elem){
                const currentDate = $(elem).datepicker( "getDate" );
                const options = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };
                let formateDate = currentDate.toLocaleDateString('en-DE', options);
                let dateValue = formateDate.split(/,| /);
                dateValue.splice(1,1);

                let dateEle =  `<h2>${dateValue[1]} <sub>${dateValue[2]}'${dateValue[3].slice(-2)}</sub></h2> <p>${dateValue[0]}</p>`;

                $(this).siblings('.option-select-btn').html(dateEle);

            })

        });

        $(".datePicker").on("focus",function(){
            var dim = $(this).offset();

            if($(this).parent(".option-select-wrapper")){
                $(".datepicker.dropdown-menu").offset({
                    top     :   dim.top + 60,
                    left    :   dim.left - 20
                });
            }
        })

        $('.datePicker').on('change', function(){
            // const selectDate = new Date(this.value);
            // const selectDate = new Date($(this).val());
            const selectDate = $(this).datepicker("getDate");
            const options = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };
            let formateDate = selectDate.toLocaleDateString('en-DE', options);
            let dateValue = formateDate.split(/,| /);
            dateValue.splice(1,1);


            // var dateEle =  '<h2>'+ dateValue[1] +'<sub>'+ dateValue[2] +'\''+ dateValue[3].slice(-2) +'</sub></h2> <p>'+ dateValue[0] +'</p>';
            let dateEle =  `<h2>${dateValue[1]} <sub>${dateValue[2]}'${dateValue[3].slice(-2)}</sub></h2> <p>${dateValue[0]}</p>`;

            $(this).siblings('.option-select-btn').html(dateEle);
        });

    }

    // Filter Date

    $(".option-select-btn").on("click",function(){
        let datePickerInput = $(this).siblings(".datePicker");
        let dateTimeInput = $(this).siblings('input[name="datetimes"]');
        datePickerInput.focus();
        dateTimeInput.focus()
    })

    // Toggle Traveler Data

    $(".continue-btn").on("click",function(){
        $(".traveler-details-card").toggleClass("hide");
        $(this).css("display","none");
        $(".traveler-data-wpr").css("display","block")
    })

    // Confirm Message

    $(".booking-btn").on("click",function(){
        $(this).parent().css("display","none");
        $(this).parent().siblings(".terms").css("display","none")
        $(".booking-confirm-msg").css("display","block")
    })

    // Sign Modal

    $(".login-btn").on("click",function(e){
        // e.preventDefault();
        // $(".sign-modal-wpr").addClass("show")
    })

    $(".modal-close").on("click",function(){
        // $(".sign-modal-wpr").removeClass("show")
    })

    // Sign Form Toggle

    $(".sign-up-link").on("click",function(e){
        e.preventDefault();
        $(".sign-in-content").css("display","none");
        $(".forget-content").css("display","none")
        $(".sign-up-content").css("display","block")
    })

    $(".sign-in-link").on("click",function(e){
        e.preventDefault();
        $(".sign-up-content").css("display","none");
        $(".forget-content").css("display","none")
        $(".sign-in-content").css("display","block")
    })
    $(".forget-link").on("click",function(e){
        e.preventDefault();
        $(".sign-up-content").css("display","none");
        $(".sign-in-content").css("display","none")
        $(".forget-content").css("display","block")
    })

    // Password Type Toggle

    $(".pass-input > i").click(function(){
        console.log($(this));
        $(this).toggleClass("icofont-eye-blocked icofont-eye-alt");
        if($(this).parent().siblings("input").attr("type") == "text"){
           $(this).parent().siblings("input").attr("type","password")
        }
        else{
         $(this).parent().siblings("input").attr("type","text")
        }
    })

     // Faq Dropdown

    $(".faq-label").on("click", function () {
        var $this = $(this);
        $("i", this).toggleClass("icofont-rounded-down icofont-rounded-up");
        $($this).next().slideToggle("1000");
    });

    // Add Member Form Toggle

    $(".add-mem-btn").on("click",function(){
        $(this).parent().slideToggle("")
        $(this).parent().siblings(".personal-details").slideToggle("")
    })

    // Filter Widget Toggle

    $(".filter-toggle").on("click",function(){
        $(".sidebar-filter-wpr").addClass("show")
    })

    $(".filter-cls").on("click",function(){
        $(".sidebar-filter-wpr").removeClass("show")
    })

    // Menu Toggle

    $(".nav-btn").on("click",function(){

        $(".nav-menu").slideToggle(300)
    })

})(jQuery);

(function(){

    // Sticky Nav

    const headerContainer = document.querySelector(".header-wpr");

    if(headerContainer != null){
        window.onscroll = ()=>{
            let pageHeight = document.querySelector("body").scrollHeight;
            if( pageHeight > 900){
                this.scrollY > 50 ? headerContainer.classList.add("sticky") : headerContainer.classList.remove("sticky");
            }
        }
    }

    // Countdown Timer

    const startMinutes = 10;
    let time = startMinutes * 60;

    const CountdownEl = document.getElementById("countdown");

    if(CountdownEl != null){

        setInterval(updateCountdown,1000)

        function updateCountdown(){
            const min = Math.floor(time / 60);
            let sec = time % 60;

            sec = sec < 10 ? '0' + sec : sec ;

            CountdownEl.innerHTML = `<span>${min}</span> : <span>${sec}</span>`;
            time--;
        }
    }

    // Range Slider

   const slideValue = document.querySelector(".range-value .right");
   const inputSlider = document.querySelector(".range-field input");
   const rangeBg = document.querySelector(".range-bg");

   if(slideValue != null || inputSlider != null || rangeBg !=null){
        let minValue = 3000;
        let currentValue = inputSlider.value - minValue;
        let maxValue = 10000;
        let rangeValue = (maxValue - minValue);

        rangeBg.style.width = (((currentValue * 100 ) / rangeValue) - 2.5 ) + '%';

        inputSlider.oninput = (()=>{
            currentValue = inputSlider.value - minValue;
            slideValue.innerHTML = inputSlider.value + ' BDT';
            rangeBg.style.width = (((currentValue * 100 ) / rangeValue) - 2.5 ) + '%';
        });
    }

    // IntelPhoneInput

    var phoneInput = document.querySelectorAll(".phone");

    if(phoneInput != null){

        phoneInput.forEach(each => {

            window.intlTelInput(each, {
                separateDialCode: true,
                preferredCountries: ["bd", "sa"]
            });
        })
    }

    // Image Preview

    const hotelImgs = document.querySelectorAll(".hotel-images");

    if(hotelImgs != null){

        hotelImgs.forEach(each => {

        const previewImg = each.querySelector(".preview-img img");
        const thumbImgs = each.querySelectorAll(".thumbnail-images span");

            thumbImgs.forEach(each => {
                each.addEventListener("mouseover",function(){
                    const imgSrc = this.querySelector("img").getAttribute('src');
                    previewImg.setAttribute("src",imgSrc)
                })
            })

        });

    }


    // ScrollToWatch

    const stickyMenu = document.querySelector(".overview-navigation");

    if(stickyMenu != null){
        var spy = new Gumshoe('.overview-nav-menu a',{
            offset: function () {
                return headerContainer.getBoundingClientRect().height + 150;
            }
        });
    }

    // Increment Decrement Event

    const increBtn = document.querySelectorAll(".qun-up");
    const decreBtn = document.querySelectorAll(".qun-dwn");

    increBtn.forEach(each => {
        each.addEventListener("click",function(){
            const qtyInput = this.previousElementSibling;
            (qtyInput.value)++;
        })
    })

    decreBtn.forEach(each => {
        each.addEventListener("click",function(){
            const qtyInput = this.nextElementSibling;
            if(qtyInput.value == 1){
                return
            }else{
                (qtyInput.value)--;
            }
        })
    })

    // Room Selection

    const roomApply = document.querySelector(".room-apply");

    if(roomApply != null){
        roomApply.addEventListener("click",function(event){
            const qtyInputWpr = this.parentElement.parentElement;
            const qtyInputs = qtyInputWpr.querySelectorAll(".quantity-input")

            const optionValueEle = qtyInputWpr.previousElementSibling;

            optionValueEle.innerHTML = `<h2>${qtyInputs[0].value} <sub>Room</sub> ${qtyInputs[1].value} <sub>Adults</sub></h2>`
        })
    }

    // Flight Selection

    const flightApply = document.querySelector(".flight-apply");

    if(flightApply != null){
        flightApply.addEventListener("click",function(event){
            const qtyInputWpr = this.parentElement.parentElement;
            const adultValue = qtyInputWpr.querySelector('input[name="adult"]:checked').nextElementSibling.innerText;
            const childValue = qtyInputWpr.querySelector('input[name="child"]:checked').nextElementSibling.innerText;
            const infantValue = qtyInputWpr.querySelector('input[name="infant"]:checked').nextElementSibling.innerText;
            const ticketClass = qtyInputWpr.querySelector('input[name="ticket-class"]:checked').nextElementSibling.innerText;

            const totalTrvlr = parseInt(adultValue) + parseInt(childValue) + parseInt(infantValue);

            const optionValueEle = qtyInputWpr.previousElementSibling;

            optionValueEle.innerHTML = `<h2>${totalTrvlr} <sub>Traveler</sub></h2>
                                        <p>${ticketClass}</p>
                                        <p class="info">Group Bookings Not Available!</p>`
        })
    }

    // Multi Select

    new MultiSelectTag('custom-multiple-select')


})()
