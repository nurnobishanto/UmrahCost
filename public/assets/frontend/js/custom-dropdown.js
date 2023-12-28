let airportList = [
                    {location:"Dhaka",name:"Hazrat Shahjalal International Airport"}, 
                    {location:"Chittagong",name:"Shah Amanat International Airport"},
                    {location:"Rajshahi",name:"Shah Makhdum Airport"},
                    {location:"Sylhet",name:"Osmani International Airport"},
                    {location:"Cox's Bazar",name:"Cox's Bazar Airport"},
                    {location:"Jessore",name:"Jashore Airport"},
                    {location:"Barishal",name:"Barishal Airport"},
                    {location:"Saidpur",name:"Saidpur Airport"}
                ]

let hotelList = [
                    {location:"Dhaka",name:"Hotel Radison Blu"},
                    {location:"Dhaka",name:"Hotel La Meridian"},
                    {location:"Chittagong",name:"The Peninsula Chittagong Limited"},
                    {location:"Rajshahi",name:"Grand Riverview Hotel"},
                    {location:"Sylhet",name:"Rose View Hotel"},
                    {location:"Cox's Bazar",name:"Hotel Sea Crown "},
                    {location:"Cox's Bazar",name:"Best Western Heritage"},
                    {location:"Cox's Bazar",name:"Hotel Cox's Today"},
                    {location:"Cox's Bazar",name:"Hotel Oasis International"}
                ]

let countries = [{name:"Afghanistan",code:"AFG"}, {name:"Algeria",code:"ALG"}, {name:"Australia",code:"AUS"}, {name:"Bangladesh",code:"BD"}, {name:"Bhutan",code:"BU"},
                {name:"Canada",code:"CNA"}, {name:"China",code:"CN"}, {name:"Germany",code:"GER"},
                {name:"India",code:"IND"}, {name:"Japan",code:"JAP"}, {name:"Malaysia",code:"MAL"},
                {name:"Maldives",code:"MAD"}, {name:"Nepal",code:"NEP"}, {name:"Sri Lanka",code:"SRI"},
                {name:"Thailand",code:"THA"}, {name:"Turkey",code:"TUR"}, {name:"United States",code:"USA"}, {name:"United Kingdom",code:"UK"}];
                

const airports = document.querySelectorAll(".airport-select");
const hotels = document.querySelectorAll(".hotel-select");
const visa = document.querySelectorAll(".country-select");

airports.forEach(each => {

    const selectBtn = each.querySelector(".option-select-btn"),
    searchInp = each.querySelector(".option-select-content input"),
    options = each.querySelector(".filter-options-list");

    function addAirports(selectedAirports) {
        options.innerHTML = "";
        airportList.forEach(airport => {
            let isSelected = airport == selectedAirports ? "selected" : "";
            let li = `<li class="${isSelected}">
                        <p>${airport.location}</p>
                        <span>${airport.name}</span>
                    </li>`;
            options.insertAdjacentHTML("beforeend", li);
        });
    }

    addAirports();

    function updateName(selectedLi) {
        searchInp.value = "";
        // addCountry(selectedLi.innerText);
        each.classList.remove("active");
        selectBtn.firstElementChild.innerText = selectedLi.firstElementChild.innerText;
        selectBtn.lastElementChild.innerText = selectedLi.lastElementChild.innerText;
    }

    function optionSelect(){
        options.querySelectorAll("li").forEach(each => {
            each.addEventListener("click", function(e) {
                updateName(this)
            })
        })
    }

    optionSelect()

    searchInp.addEventListener("keyup", () => {
        let arr = [];
        let searchWord = searchInp.value.toLowerCase();
        arr = airportList.filter(data => {
            return data.location.toLowerCase().startsWith(searchWord);
        }).map(data => {
            let isSelected = data == selectBtn.firstElementChild.innerText ? "selected" : "";
            return `<li class="${isSelected}">
                        <p>${data.location}</p>
                        <span>${data.name}</span>
                    </li>`;
        }).join("");
        options.innerHTML = arr ? arr : `<p style="margin-top: 10px;">Oops! Country not found</p>`;
        optionSelect();
    });

    selectBtn.addEventListener("click", () => each.classList.toggle("active"));
    
});

hotels.forEach(each => {

    const selectBtn = each.querySelector(".option-select-btn"),
    searchInp = each.querySelector(".option-select-content input"),
    options = each.querySelector(".filter-options-list");

    function addHotels(selectedHotels) {
        options.innerHTML = "";
        hotelList.forEach(hotel => {
            let isSelected = hotel == selectedHotels ? "selected" : "";
            let li = `<li class="${isSelected}">
                        <p>${hotel.location}</p>
                        <span>${hotel.name}</span>
                    </li>`;
            options.insertAdjacentHTML("beforeend", li);
        });
    }

    addHotels();

    function updateName(selectedLi) {
        searchInp.value = "";
        // addCountry(selectedLi.innerText);
        each.classList.remove("active");
        selectBtn.firstElementChild.innerText = selectedLi.firstElementChild.innerText;
        selectBtn.lastElementChild.innerText = selectedLi.lastElementChild.innerText;
    }

    function optionSelect(){
        options.querySelectorAll("li").forEach(each => {
            each.addEventListener("click", function(e) {
                updateName(this)
            })
        })
    }

    optionSelect()

    searchInp.addEventListener("keyup", () => {
        let arr = [];
        let searchWord = searchInp.value.toLowerCase();
        arr = hotelList.filter(data => {
            return data.location.toLowerCase().startsWith(searchWord);
        }).map(data => {
            let isSelected = data == selectBtn.firstElementChild.innerText ? "selected" : "";
            return `<li class="${isSelected}">
                        <p>${data.location}</p>
                        <span>${data.name}</span>
                    </li>`;
        }).join("");
        options.innerHTML = arr ? arr : `<p style="margin-top: 10px;">Oops! Country not found</p>`;
        optionSelect();
    });

    selectBtn.addEventListener("click", () => each.classList.toggle("active"));
    
});

visa.forEach(each => {

    const selectBtn = each.querySelector(".option-select-btn"),
    searchInp = each.querySelector(".option-select-content input"),
    options = each.querySelector(".filter-options-list");

    function addCountry(selectedCountry) {
        options.innerHTML = "";
        countries.forEach(country => {
            let isSelected = country == selectedCountry ? "selected" : "";
            let li = `<li class="${isSelected}">
                        <p>${country.name}</p>
                        <span>${country.code}</span>
                    </li>`;
            options.insertAdjacentHTML("beforeend", li);
        });
    }

    addCountry();

    function updateName(selectedLi) {
        searchInp.value = "";
        // addCountry(selectedLi.innerText);
        each.classList.remove("active");
        selectBtn.firstElementChild.innerText = selectedLi.firstElementChild.innerText;
        selectBtn.lastElementChild.innerText = selectedLi.lastElementChild.innerText;
    }

    function optionSelect(){
        options.querySelectorAll("li").forEach(each => {
            each.addEventListener("click", function(e) {
                updateName(this)
            })
        })
    }

    optionSelect()

    searchInp.addEventListener("keyup", () => {
        let arr = [];
        let searchWord = searchInp.value.toLowerCase();
        arr = countries.filter(data => {
            return data.name.toLowerCase().startsWith(searchWord);
        }).map(data => {
            let isSelected = data == selectBtn.firstElementChild.innerText ? "selected" : "";
            return `<li class="${isSelected}">
                        <p>${data.name}</p>
                        <span>${data.code}</span>
                    </li>`;
        }).join("");
        options.innerHTML = arr ? arr : `<p style="margin-top: 10px;">Oops! Country not found</p>`;
        optionSelect();
    });

    selectBtn.addEventListener("click", () => each.classList.toggle("active"));
    
});