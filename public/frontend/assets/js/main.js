!(function(e) {
    var s = e(window).width();
    e(".navbar-toggle").on("click", function() {
        e("#mobile-nav").slideToggle(300);
    }),
        e(".mHc").length && e(".mHc").matchHeight(),
        e(".mHc0").length && e(".mHc0").matchHeight(),
        e(".mHc1").length && e(".mHc1").matchHeight(),
        e(".mHc2").length && e(".mHc2").matchHeight(),
        e(".mHc3").length && e(".mHc3").matchHeight(),
        e(".mHc4").length && e(".mHc4").matchHeight(),
        e(".mHc5").length && e(".mHc5").matchHeight(),
        e(".mHc6").length && e(".mHc6").matchHeight(),
        e(window).scroll(function() {
            var s = e(window).scrollTop();
            e(".page-banner-bg").css({
                "-webkit-transform": "scale(" + (1 + s / 2e3) + ")",
                "-moz-transform": "scale(" + (1 + s / 2e3) + ")",
                "-ms-transform": "scale(" + (1 + s / 2e3) + ")",
                "-o-transform": "scale(" + (1 + s / 2e3) + ")",
                transform: "scale(" + (1 + s / 2e3) + ")"
            });
        }),
        e(".fancybox").length && e(".fancybox").fancybox({}),
        s <= 991 &&
            e(".hambergar-icon").on("click", function(s) {
                e(".main-nav").slideToggle(500),
                    e(this).toggleClass("cross-icon");
            }),
        e(".toggle-btn").on("click", function() {
            e(this).toggleClass("menu-expend"),
                e(".toggle-bar ul").slideToggle(500);
        }),
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener("scroll", function() {
                window.scrollY > 150
                    ? (document
                          .getElementById("navbar_top")
                          .classList.add("fixed-top"),
                      (navbar_height = document.querySelector(".main-nav")
                          .offsetHeight),
                      (document.body.style.paddingTop = navbar_height + "px"))
                    : (document
                          .getElementById("navbar_top")
                          .classList.remove("fixed-top"),
                      (document.body.style.paddingTop = "0"));
            });
        }),
        e(".ftr-to-top").click(function() {
            e("html, body").animate({ scrollTop: 0 }, 1e3);
        }),
        e(".selectpicker").selectpicker();
    var t = e(".Advance-Slider"),
        i = 0;
    if (
        (t.on("init", function(s, t, l, o) {
            e("button.slick-arrow").append('<div class="thumb"></div>'),
                (i = t.slideCount),
                console.log(i),
                (next_img = e(t.$slides[1])
                    .find("img")
                    .attr("src")),
                (prev_img = e(t.$slides[i - 1])
                    .find("img")
                    .attr("src")),
                e("button.slick-next .thumb").append(
                    '<img src="' + next_img + '">'
                ),
                e("button.slick-prev .thumb").append(
                    '<img src="' + prev_img + '">'
                );
        }),
        t.slick({
            arrows: !1,
            autoplay: !0,
            autoplaySpeed: 4e3,
            speed: 1e3,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: !0,
            pauseOnHover: !1,
            infinite: !1,
            customPaging: function(s, t) {
                var i = e(s.$slides[t])
                    .find(".dots-img")
                    .attr("src");
                return (
                    console.log(i),
                    '<button><div class="mextrix"><a><img src="' +
                        i +
                        '"></a></div></button>'
                );
            }
        }),
        e("button.slick-arrow , .Advance-Slider ul.slick-dots li button").hover(
            function() {
                e(this).addClass("hover-in"), e(this).removeClass("hover-out");
            },
            function() {
                e(this).removeClass("hover-in"), e(this).addClass("hover-out");
            }
        ),
        t.on("afterChange", function(s, t, l) {
            console.log("afterChange: " + l),
                (prev_img = e(t.$slides[l - 1])
                    .find("img")
                    .attr("src")),
                (next_img = e(t.$slides[l + 1])
                    .find("img")
                    .attr("src")),
                l == i &&
                    (prev_img = e(l - 1)
                        .find("img")
                        .attr("src")),
                0 == l &&
                    (console.log("if call"),
                    (prev_img = e(t.$slides[i - 1])
                        .find("img")
                        .attr("src"))),
                l == i - 1 &&
                    (next_img = e(t.$slides[0])
                        .find("img")
                        .attr("src")),
                e("button.slick-arrow ")
                    .find("img")
                    .remove(),
                e("button.slick-next .thumb").append(
                    '<img src="' + next_img + '">'
                ),
                e("button.slick-prev .thumb").append(
                    '<img src="' + prev_img + '">'
                );
        }),
        e(".filter-bar").length)
    ) {
        var l = e("#spanOutput"),
            o = e("#slider");
        o.slider({
            range: !0,
            min: 0,
            max: 2e3,
            values: [0, 1169],
            slide: function(s, t) {
                l.html(t.values[0] + " - " + t.values[1] + " Years"),
                    e("#minAmount").val(t.values[0]),
                    e("#maxAmount").val(t.values[1]);
            }
        }),
            l.html(
                o.slider("values", 0) + " - " + o.slider("values", 1) + " Years"
            ),
            e("#minAmount").val(o.slider("values", 0)),
            e("#maxAmount").val(o.slider("values", 1));
    }
    e(".qty").length &&
        e(".qty").each(function() {
            var s = e(this),
                t = s.find('input[type="number"]'),
                i = s.find(".plus"),
                l = s.find(".minus"),
                o = t.attr("max");
            i.click(function() {
                var e = parseFloat(t.val());
                if (e <= o) var i = e;
                else var i = e + 1;
                s.find("input").val(i), s.find("input").trigger("change");
            }),
                l.click(function() {
                    var e = parseFloat(t.val());
                    if (e <= 1) var i = e;
                    else var i = e - 1;
                    s.find("input").val(i), s.find("input").trigger("change");
                });
        }),
        e(".add-media-tabs").length &&
            (e(".add-media-tabs:first").show(),
            e(".add-media-tabs-menu ul li:first").addClass("active"),
            e(".add-media-tabs-menu ul li").on("click", function() {
                (index = e(this).index()),
                    e(".add-media-tabs-menu ul li").removeClass("active"),
                    e(this).addClass("active"),
                    e(".add-media-tabs").hide(),
                    e(".add-media-tabs")
                        .eq(index)
                        .show();
            })),
        e(".tabs").length &&
            (e(".tabs:first").show(),
            e(".tab-info-wrp ul li:first").addClass("active"),
            e(".tab-info-wrp ul li").on("click", function() {
                (index = e(this).index()),
                    e(".tab-info-wrp ul li").removeClass("active"),
                    e(this).addClass("active"),
                    e(".tabs").hide(),
                    e(".tabs")
                        .eq(index)
                        .show();
            })),
        e(".vn-product-zoom-img").length &&
            e(".vn-product-zoom-img").slick({
                pauseOnHover: !1,
                autoplay: !1,
                autoplaySpeed: 5e3,
                dots: !1,
                infinite: !1,
                arrows: !0,
                speed: 700,
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: !0,
                focusOnSelect: !0,
                prevArrow: e(".grds-nxt-prev .fl-prev"),
                nextArrow: e(".grds-nxt-prev .fl-next"),
                asNavFor: ".ppp-thumb-slider"
            }),
        e(".client-slider").length &&
            e(".client-slider").slick({
                dots: !1,
                infinite: !1,
                autoplay: !0,
                arrows: !0,
                autoplaySpeed: 4e3,
                speed: 700,
                slidesToShow: 1,
                slidesToScroll: 1,
                prevArrow: e(".client-nxt-prev .fl-prev"),
                nextArrow: e(".client-nxt-prev .fl-next")
            }),
        e(".ppp-thumb-slider").length &&
            e(".ppp-thumb-slider").slick({
                dots: !1,
                infinite: !1,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: !0,
                focusOnSelect: !0,
                selectorTrigger: !0,
                asNavFor: ".vn-product-zoom-img",
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: !0
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: { slidesToShow: 3, slidesToScroll: 3 }
                    },
                    {
                        breakpoint: 575,
                        settings: { slidesToShow: 2, slidesToScroll: 2 }
                    }
                ]
            }),
        e(".hm-cty-shop-slider").length &&
            e(".hm-cty-shop-slider").slick({
                dots: !1,
                infinite: !1,
                autoplay: !1,
                arrows: !0,
                autoplaySpeed: 4e3,
                speed: 700,
                slidesToShow: 8,
                slidesToScroll: 1,
                prevArrow: e(".bnr-nxt-prev .fl-prev"),
                nextArrow: e(".bnr-nxt-prev .fl-next"),
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: !0,
                            dots: !0
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: { slidesToShow: 2, slidesToScroll: 2 }
                    },
                    {
                        breakpoint: 480,
                        settings: { slidesToShow: 1, slidesToScroll: 1 }
                    }
                ]
            }),
        s <= 767 &&
            e(".ssl-slider").length &&
            e(".ssl-slider").slick({
                dots: !0,
                infinite: !1,
                autoplay: !0,
                arrows: !1,
                autoplaySpeed: 4e3,
                speed: 700,
                slidesToShow: 15,
                slidesToScroll: 5,
                responsive: [
                    {
                        breakpoint: 575,
                        settings: {
                            slidesToShow: 10,
                            slidesToScroll: 10,
                            infinite: !0,
                            dots: !0
                        }
                    },
                    {
                        breakpoint: 479,
                        settings: { slidesToShow: 8, slidesToScroll: 2 }
                    }
                ]
            }),

        e(".hm-product-grid-slider-items").length &&
            e(".hm-product-grid-slider-items").slick({
                dots: !1,
                infinite: !1,
                autoplay: !1,
                arrows: !0,
                autoplaySpeed: 4e3,
                speed: 700,
                slidesToShow: 5,
                slidesToScroll: 1,
                prevArrow: e(".product-btn .fl-prev"),
                nextArrow: e(".product-btn .fl-next"),
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: !0,
                            dots: !0
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: { slidesToShow: 2, slidesToScroll: 2 }
                    },
                    {
                        breakpoint: 480,
                        settings: { slidesToShow: 1, slidesToScroll: 1 }
                    }
                ]
        }),
        e(".hm-product-grid-slider-items-1").length &&
            e(".hm-product-grid-slider-items-1").slick({
                dots: !1,
                infinite: !1,
                autoplay: !1,
                arrows: !0,
                autoplaySpeed: 4e3,
                speed: 700,
                slidesToShow: 5,
                slidesToScroll: 1,
                prevArrow: e(".best-btn .fl-prev"),
                nextArrow: e(".best-btn .fl-next"),
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: !0,
                            dots: !0
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: { slidesToShow: 2, slidesToScroll: 2 }
                    },
                    {
                        breakpoint: 480,
                        settings: { slidesToShow: 1, slidesToScroll: 1 }
                    }
                ]
        }),
        e(".hm-product-grid-slider-items-2").length &&
            e(".hm-product-grid-slider-items-2").slick({
                dots: !1,
                infinite: !1,
                autoplay: !1,
                arrows: !0,
                autoplaySpeed: 4e3,
                speed: 700,
                slidesToShow: 5,
                slidesToScroll: 1,
                prevArrow: e(".trending-btn .fl-prev"),
                nextArrow: e(".trending-btn .fl-next"),
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: !0,
                            dots: !0
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: { slidesToShow: 2, slidesToScroll: 2 }
                    },
                    {
                        breakpoint: 480,
                        settings: { slidesToShow: 1, slidesToScroll: 1 }
                    }
                ]
        }),
        e(".hm-product-grid-slider-items-3").length &&
            e(".hm-product-grid-slider-items-3").slick({
                dots: !1,
                infinite: !1,
                autoplay: !1,
                arrows: !0,
                autoplaySpeed: 4e3,
                speed: 700,
                slidesToShow: 5,
                slidesToScroll: 1,
                prevArrow: e(".product-btn-new .fl-prev"),
                nextArrow: e(".product-btn-new .fl-next"),
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: !0,
                            dots: !0
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: { slidesToShow: 2, slidesToScroll: 2 }
                    },
                    {
                        breakpoint: 480,
                        settings: { slidesToShow: 1, slidesToScroll: 1 }
                    }
                ]
        }),
        e(".hm-best-seller-slider-items").length &&
            e(".hm-best-seller-slider-items").slick({
                dots: !1,
                infinite: !1,
                autoplay: !0,
                arrows: !0,
                autoplaySpeed: 4e3,
                speed: 700,
                slidesToShow: 4,
                slidesToScroll: 1,
                prevArrow: e(".best .fl-prev"),
                nextArrow: e(".best .fl-next"),
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: !0,
                            dots: !0
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: { slidesToShow: 2, slidesToScroll: 2 }
                    },
                    {
                        breakpoint: 480,
                        settings: { slidesToShow: 1, slidesToScroll: 1 }
                    }
                ]
        }),
        e("#hm-new-arrivale-slider").length &&
            e("#hm-new-arrivale-slider").slick({
                dots: !1,
                infinite: !1,
                autoplay: !0,
                arrows: !1,
                autoplaySpeed: 4e3,
                speed: 700,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            infinite: !0,
                            dots: !0
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: { slidesToShow: 2, slidesToScroll: 2 }
                    },
                    {
                        breakpoint: 480,
                        settings: { slidesToShow: 1, slidesToScroll: 1 }
                    }
                ]
            }),
        e(".responsive-slider").length &&
            e(".responsive-slider").slick({
                dots: !0,
                infinite: !1,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: !0,
                            dots: !0
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: { slidesToShow: 2, slidesToScroll: 2 }
                    },
                    {
                        breakpoint: 480,
                        settings: { slidesToShow: 1, slidesToScroll: 1 }
                    }
                ]
            });
    var n = [
        {
            featureType: "water",
            elementType: "geometry",
            stylers: [{ color: "#e9e9e9" }, { lightness: 17 }]
        },
        {
            featureType: "landscape",
            elementType: "geometry",
            stylers: [{ color: "#f5f5f5" }, { lightness: 20 }]
        },
        {
            featureType: "road.highway",
            elementType: "geometry.fill",
            stylers: [{ color: "#ffffff" }, { lightness: 17 }]
        },
        {
            featureType: "road.highway",
            elementType: "geometry.stroke",
            stylers: [{ color: "#ffffff" }, { lightness: 29 }, { weight: 0.2 }]
        },
        {
            featureType: "road.arterial",
            elementType: "geometry",
            stylers: [{ color: "#ffffff" }, { lightness: 18 }]
        },
        {
            featureType: "road.local",
            elementType: "geometry",
            stylers: [{ color: "#ffffff" }, { lightness: 16 }]
        },
        {
            featureType: "poi",
            elementType: "geometry",
            stylers: [{ color: "#f5f5f5" }, { lightness: 21 }]
        },
        {
            featureType: "poi.park",
            elementType: "geometry",
            stylers: [{ color: "#dedede" }, { lightness: 21 }]
        },
        {
            elementType: "labels.text.stroke",
            stylers: [
                { visibility: "on" },
                { color: "#ffffff" },
                { lightness: 16 }
            ]
        },
        {
            elementType: "labels.text.fill",
            stylers: [
                { saturation: 36 },
                { color: "#333333" },
                { lightness: 40 }
            ]
        },
        { elementType: "labels.icon", stylers: [{ visibility: "off" }] },
        {
            featureType: "transit",
            elementType: "geometry",
            stylers: [{ color: "#f2f2f2" }, { lightness: 19 }]
        },
        {
            featureType: "administrative",
            elementType: "geometry.fill",
            stylers: [{ color: "#fefefe" }, { lightness: 20 }]
        },
        {
            featureType: "administrative",
            elementType: "geometry.stroke",
            stylers: [{ color: "#fefefe" }, { lightness: 17 }, { weight: 1.2 }]
        }
    ];
    if (e("#mapID").length) {
        var r = e("#mapID").data("latitude"),
            a = e("#mapID").data("longitude"),
            d = new google.maps.LatLng(r, a);
        google.maps.event.addDomListener(window, "load", function e() {
            var s = {
                    center: d,
                    mapTypeControl: !0,
                    scrollwheel: !1,
                    zoomControl: !0,
                    disableDefaultUI: !0,
                    zoom: 7,
                    streetViewControl: !1,
                    rotateControl: !0,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    styles: n
                },
                t = new google.maps.Map(document.getElementById("mapID"), s);
            new google.maps.Marker({ position: d }).setMap(t);
        });
    }
    new WOW().init();
})(jQuery);
