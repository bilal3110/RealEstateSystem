// const { forEach } = require("lodash");

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

console.log("Script loaded at top level");

let rent = document.getElementById("rent"); //1
let sale = document.getElementById("sale"); //2
let profit = document.getElementById("profit"); //3
let totalSpendings = document.getElementById("totalSpendings"); //4
let spendings = document.getElementById("spendings");
let totalSales = document.getElementById("totalSales");
let totalRent = document.getElementById("totalRent");
let totalInvest = document.getElementById("totalInvest");
let totalDisposed = document.getElementById("totalDisposed");
let d_rent = document.getElementById("d_rent");
let d_sale = document.getElementById("d_sale");
let d_invest = document.getElementById("d_invest");
// let quote = document.getElementById('quotation');

document.addEventListener("DOMContentLoaded", function () {
    if (document.body.classList.contains("Analytics")) {
        loadPage();
        // addRentProperty();
    }

    // console.log("Script loaded at top level");

    if(document.body.classList.contains("rentPage")) {
        fetch(window.location.origin + "/api/rent/show")
        .then(response => response.json())
        .then(data => console.log("API Data:", data))
        .catch(error => console.log("Fetch Error:", error));      
    }
    
    
    
    if (document.body.classList.contains("rentForm")) {
        function addRentProperty() {
            let rentSubmit = document.getElementById("rentSubmit");

            rentSubmit.addEventListener("click", function (e) {
                e.preventDefault();

                let form = document.getElementById("rentForm");
                let formData = new FormData(form);

                $.ajax({
                    url: "/api/rent/add",
                    method: "POST",
                    data: formData,
                    JSON: true,
                    processData: false, // Prevent jQuery from converting it to string
                    contentType: false, // Let browser set the correct content type
                    success: function (response) {
                        console.log(response);
                        alert("Rent Property Added");
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    },
                });
            });
        }

        // Call the function after DOM loads
        $(function () {
            addRentProperty();
        });
    }

    if (document.body.classList.contains("RentSinglePage")) {
        let urlSegments = window.location.pathname.split("/");
        let propertyId = urlSegments[urlSegments.length - 1];

        $.ajax({
            url: "/api/rent/property/show/" + propertyId,
            method: "GET",
            success: function (response) {
                console.log(response);

                let images = [];
                let baseUrl = window.location.origin;
                let defaultImage = baseUrl + "../img/elements/4.png";

                if (response.prop_img) {
                    try {
                        images = JSON.parse(response.prop_img);
                    } catch (e) {
                        console.error("Error parsing images:", e);
                    }
                }

                if (!Array.isArray(images) || images.length === 0) {
                    images = [defaultImage];
                } else {
                    images = images.map(
                        (img) => baseUrl + "/" + img.replace(/^\/+/, "")
                    );
                }

                let carouselIndicators = "";
                let carouselInner = "";

                images.forEach((image, index) => {
                    let activeClass = index === 0 ? "active" : "";
                    carouselIndicators += `
                        <button type="button" data-bs-target="#carouselExample" 
                            data-bs-slide-to="${index}" class="${activeClass}" 
                            aria-label="Slide ${index + 1}"></button>
                    `;

                    carouselInner += `
                        <div class="carousel-item ${activeClass}">
                            <img class="d-block w-100" src="${image}" alt="Property Image" onerror="this.onerror=null; this.src='${defaultImage}';">
                        </div>
                    `;
                });

                $("#carouselExample .carousel-indicators").html(
                    carouselIndicators
                );
                $("#carouselExample .carousel-inner").html(carouselInner);

                $("#RentShowCard h5.card-header").text(response.prop_title);
                $("#demand").text(response.demand);
                $("#location").text(response.prop_loc);
                $("#area").text(response.prop_area);
                $("#contact").text(response.seller_contact);
                $("#owner").text(response.seller_name);
                $("#description").text(response.prop_desc);
            },
            error: function (error) {
                console.log("Error fetching property data", error);
            },
        });
    }

});

function loadPage() {
    $.ajax({
        url: "/analytics",
        method: "GET",
        success: function (response) {
            console.log("API Response:", response);

            if (response && response.data) {
                let data = response.data;

                rent.innerHTML = data.rent;
                sale.innerHTML = data.sale;
                profit.innerHTML = Number(data.net_income).toLocaleString(
                    "en-US",
                    { maximumFractionDigits: 0 }
                );
                totalSpendings.innerHTML = Number(
                    data.showSpending
                ).toLocaleString("en-US", { maximumFractionDigits: 0 });
                totalRent.innerHTML = Number(data.rent_income).toLocaleString(
                    "en-US",
                    { maximumFractionDigits: 0 }
                );
                totalSales.innerHTML = Number(data.sale_income).toLocaleString(
                    "en-US",
                    { maximumFractionDigits: 0 }
                );
                totalInvest.innerHTML = Number(
                    data.invest_income
                ).toLocaleString("en-US", { maximumFractionDigits: 0 });

                totalDisposed.innerHTML = Number(
                    data.totalDisposed
                ).toLocaleString("en-US", { maximumFractionDigits: 0 });
            } else {
                console.error("Invalid data structure:", response);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error loading data:", error);
        },
    });
}

// Rent Properties Functions

function jsonconvert(target) {
    var arr = $(target).serializeArray();
    var obj = {};

    for (var a = 0; a < arr.length; a++) {
        if (arr[a].value == "") {
            return false;
        }
        obj[arr[a].name] = arr[a].value;
    }

    return JSON.stringify(obj);
}

