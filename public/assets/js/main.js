(function ($) {
    "use strict";

    // ======================================================
    //      Centralized Plugin Initialization Function
    // ======================================================
    function initializeThemePlugins() {
        console.log("⚡ Initializing/Re-initializing theme plugins..."); // Debug Log

        // --- Hero slider 1 ---
        // Note: If this slider is outside Livewire components,
        // initializing it only once on page load might be enough.
        // If it can be inside a Livewire component, keep it here.
        $(".hero-slider-1").each(function () {
            if ($(this).hasClass("slick-initialized")) {
                try {
                    $(this).slick("unslick");
                } catch (e) {
                    console.error("Error unslicking hero-slider-1:", e);
                }
            }
            // Add a check if the element exists before initializing
            if ($(this).length) {
                $(this).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    /*loop: false,*/ infinite: true,
                    dots: true,
                    arrows: true,
                    prevArrow:
                        '<span class="slider-btn slider-prev"><i class="fi-rs-angle-left"></i></span>',
                    nextArrow:
                        '<span class="slider-btn slider-next"><i class="fi-rs-angle-right"></i></span>',
                    appendArrows: ".hero-slider-1-arrow",
                    autoplay: true,
                });
            }
        });

        // --- Carausel 6 columns ---
        $(".carausel-6-columns").each(function () {
            var $slider = $(this);
            var sliderID = $slider.attr("id");
            var $arrowContainer = $("#" + sliderID + "-arrows");

            if (
                !sliderID ||
                $slider.length === 0 ||
                $arrowContainer.length === 0
            )
                return;

            if ($slider.hasClass("slick-initialized")) {
                try {
                    $slider.slick("unslick");
                } catch (e) {
                    console.error("Error unslicking:", sliderID, e);
                }
            }

            $slider.slick({
                dots: false,
                infinite: true,
                speed: 1000,
                arrows: true,
                autoplay: true,
                slidesToShow: 6,
                slidesToScroll: 1,
                adaptiveHeight: true,
                responsive: [
                    { breakpoint: 1025, settings: { slidesToShow: 4 } },
                    { breakpoint: 768, settings: { slidesToShow: 3 } },
                    { breakpoint: 480, settings: { slidesToShow: 2 } },
                ],
                prevArrow:
                    '<span class="slider-btn slider-prev"><i class="fi-rs-angle-left"></i></span>',
                nextArrow:
                    '<span class="slider-btn slider-next"><i class="fi-rs-angle-right"></i></span>',
                appendArrows: $arrowContainer,
            });
        });

        //     var sliderID = "#" + $(item).attr("id");
        //     var appendArrowsClassName = sliderID + "-arrows";

        //     if ($(sliderID).length === 0) return;

        //     if ($(sliderID).hasClass("slick-initialized")) {
        //         try {
        //             $(sliderID).slick("unslick");
        //         } catch (e) {
        //             console.error("Error unslicking carausel-8:", sliderID, e);
        //         }
        //     }

        //     $(sliderID).slick({
        //         dots: false,
        //         infinite: true,
        //         speed: 1000,
        //         arrows: true,
        //         autoplay: true,
        //         slidesToShow: 6,
        //         slidesToScroll: 1,
        //         adaptiveHeight: true,
        //         responsive: [
        //             { breakpoint: 1025, settings: { slidesToShow: 4, slidesToScroll: 1 } },
        //             { breakpoint: 768, settings: { slidesToShow: 3, slidesToScroll: 1 } },
        //             { breakpoint: 480, settings: { slidesToShow: 2, slidesToScroll: 1 } },
        //         ],
        //         prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-angle-left"></i></span>',
        //         nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-angle-right"></i></span>',
        //         appendArrows: appendArrowsClassName,
        //     });
        // });

        // --- Carausel 4 columns ---
        $(".carausel-4-columns").each(function (key, item) {
            var sliderID = "#" + $(this).attr("id");
            var appendArrowsClassName = sliderID + "-arrows";
            if ($(sliderID).length === 0) return; // Skip if element not found
            if ($(sliderID).hasClass("slick-initialized")) {
                try {
                    $(sliderID).slick("unslick");
                } catch (e) {
                    console.error("Error unslicking carausel-4:", sliderID, e);
                }
            }
            // Add a check if the element exists before initializing
            if ($(sliderID).length) {
                $(sliderID).slick({
                    dots: false,
                    infinite: true,
                    speed: 1000,
                    arrows: true,
                    autoplay: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    /*loop: false,*/ adaptiveHeight: true,
                    responsive: [
                        {
                            breakpoint: 1025,
                            settings: { slidesToShow: 3, slidesToScroll: 3 },
                        }, // Check slidesToScroll: 3 ?
                        {
                            breakpoint: 480,
                            settings: { slidesToShow: 2, slidesToScroll: 1 },
                        },
                    ],
                    prevArrow:
                        '<span class="slider-btn slider-prev"><i class="fi-rs-angle-left"></i></span>',
                    nextArrow:
                        '<span class="slider-btn slider-next"><i class="fi-rs-angle-right"></i></span>',
                    appendArrows: appendArrowsClassName,
                });
            }
        });

        // --- Fix Bootstrap 5 tab & slick slider ---
        // Use .off to prevent duplicate event listeners
        $('button[data-bs-toggle="tab"]')
            .off("shown.bs.tab.slickfix")
            .on("shown.bs.tab.slickfix", function (e) {
                console.log("Tab shown, adjusting slick position..."); // Debug Log
                $(
                    ".carausel-4-columns, .carausel-6-columns, .product-slider-active-1, .testimonial-active-1, .testimonial-active-3, .categories-slider-1"
                ).slick("setPosition");
            });

        // --- Timer Countdown ---
        // Important: Re-initializing countdowns on every Livewire update might restart them
        // or cause issues if not handled carefully. Only re-init if necessary.
        // Consider initializing only once on page load or using AlpineJS for timers within Livewire.
        $("[data-countdown]").each(function () {
            if (!$(this).data("countdown-initialized")) {
                // Simple flag to prevent re-initialization
                var $this = $(this),
                    finalDate = $(this).data("countdown");
                $this.countdown(finalDate, function (event) {
                    $(this).html(/* ... your strftime format ... */);
                });
                $(this).data("countdown-initialized", true);
            }
        });

        // --- Product slider active 1 ---
        $(".product-slider-active-1").each(function () {
            if ($(this).length === 0) return;
            if ($(this).hasClass("slick-initialized")) {
                try {
                    $(this).slick("unslick");
                } catch (e) {
                    console.error("Error unslicking product-slider-1:", e);
                }
            }
            if ($(this).length) {
                $(this).slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    autoplay: true,
                    fade: false,
                    /*loop: false,*/ infinite: true,
                    dots: false,
                    arrows: true,
                    prevArrow:
                        '<span class="pro-icon-1-prev"><i class="fi-rs-angle-small-left"></i></span>',
                    nextArrow:
                        '<span class="pro-icon-1-next"><i class="fi-rs-angle-small-right"></i></span>',
                    responsive: [
                        /* ... */
                    ],
                });
            }
        });

        // --- Testimonial active 1 ---
        $(".testimonial-active-1").each(function () {
            if ($(this).length === 0) return;
            if ($(this).hasClass("slick-initialized")) {
                try {
                    $(this).slick("unslick");
                } catch (e) {
                    console.error("Error unslicking testimonial-1:", e);
                }
            }
            if ($(this).length) {
                $(this).slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    fade: false,
                    /*loop: false,*/ infinite: true,
                    dots: false,
                    arrows: true,
                    prevArrow:
                        '<span class="pro-icon-1-prev"><i class="fi-rs-angle-small-left"></i></span>',
                    nextArrow:
                        '<span class="pro-icon-1-next"><i class="fi-rs-angle-small-right"></i></span>',
                    responsive: [
                        /* ... */
                    ],
                });
            }
        });

        // --- Testimonial active 3 ---
        $(".testimonial-active-3").each(function () {
            if ($(this).length === 0) return;
            if ($(this).hasClass("slick-initialized")) {
                try {
                    $(this).slick("unslick");
                } catch (e) {
                    console.error("Error unslicking testimonial-3:", e);
                }
            }
            if ($(this).length) {
                $(this).slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    fade: false,
                    /*loop: false,*/ infinite: true,
                    dots: true,
                    arrows: false,
                    responsive: [
                        /* ... */
                    ],
                });
            }
        });

        // --- Categories slider 1 ---
        $(".categories-slider-1").each(function () {
            if ($(this).length === 0) return;
            if ($(this).hasClass("slick-initialized")) {
                try {
                    $(this).slick("unslick");
                } catch (e) {
                    console.error("Error unslicking categories-1:", e);
                }
            }
            if ($(this).length) {
                $(this).slick({
                    slidesToShow: 6,
                    slidesToScroll: 1,
                    fade: false,
                    /*loop: false,*/ infinite: true,
                    dots: false,
                    arrows: false,
                    responsive: [
                        /* ... */
                    ],
                });
            }
        });

        // --- Product details big image slider ---
        $(".pro-dec-big-img-slider").each(function () {
            if ($(this).length === 0) return;
            // Check if it's already a nav for a small slider to prevent re-init issues if possible
            var isNavFor = $(this).slick("slickGetOption", "asNavFor");
            if ($(this).hasClass("slick-initialized") && !isNavFor) {
                // Avoid unslicking if it's part of a synced pair maybe? Test this.
                try {
                    $(this).slick("unslick");
                } catch (e) {
                    console.error("Error unslicking pro-dec-big:", e);
                }
            }
            // Re-init only if not initialized
            if (!$(this).hasClass("slick-initialized")) {
                if ($(this).length) {
                    $(this).slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        draggable: false,
                        fade: false,
                        asNavFor:
                            ".product-dec-slider-small , .product-dec-slider-small-2",
                    });
                }
            }
        });

        // --- Product details small image slider ---
        $(".product-dec-slider-small").each(function () {
            if ($(this).length === 0) return;
            if ($(this).hasClass("slick-initialized")) {
                try {
                    $(this).slick("unslick");
                } catch (e) {
                    console.error("Error unslicking pro-dec-small:", e);
                }
            }
            if ($(this).length) {
                $(this).slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: ".pro-dec-big-img-slider",
                    dots: false,
                    focusOnSelect: true,
                    fade: false,
                    arrows: false,
                    responsive: [
                        /* ... */
                    ],
                });
            }
        });
        // Add .product-dec-slider-small-2 similarly if needed

        // --- Magnific Popup ---
        // Usually needs init only once, unless Livewire loads new content with '.img-popup' links
        if ($(".img-popup").length > 0) {
            // Check if already initialized on the body or a parent container to avoid duplicates
            // Simple approach: Initialize directly. Test if duplicates cause issues.
            $(".img-popup").magnificPopup({
                type: "image",
                gallery: { enabled: true },
            });
        }

        // --- Select active (Select2) ---
        if ($(".select-active").length > 0) {
            try {
                // Attempt to destroy existing Select2 instances before re-initializing
                $(".select-active").each(function () {
                    if ($(this).data("select2")) {
                        $(this).select2("destroy");
                    }
                });
            } catch (e) {
                console.error("Error destroying select2:", e);
            }
            $(".select-active").select2();
        }

        // --- CounterUp ---
        // Similar to Countdown, re-initializing might not be desired unless the numbers change via Livewire.
        // Consider initializing once or using AlpineJS.
        // $(".count").counterUp({ delay: 10, time: 2000 }); // Initialize if needed

        // --- Isotope ---
        // Isotope needs careful handling with Livewire. Re-initializing the whole grid
        // might be okay for simple cases, but for adding/removing items,
        // you'll need to use Isotope's API (e.g., 'reloadItems', 'appended', 'remove').
        // var $grid = $(".grid");
        // if ($grid.length > 0 && typeof $.fn.imagesLoaded !== 'undefined' && typeof $.fn.isotope !== 'undefined') {
        //     $grid.imagesLoaded(function () {
        //         $grid.isotope({
        //             itemSelector: ".grid-item", percentPosition: true, layoutMode: "masonry",
        //             masonry: { columnWidth: ".grid-item" }
        //         });
        //     });
        // }

        // --- Sticky Sidebar (TheiaStickySidebar) ---
        // Usually needs init only once. Check if already initialized.
        if (
            $(".sticky-sidebar").length > 0 &&
            typeof $.fn.theiaStickySidebar !== "undefined"
        ) {
            if (!$(".sticky-sidebar").data("theiaStickySidebar")) {
                // Check if not already initialized
                console.log("Initializing sticky sidebar..."); // Debug Log
                $(".sticky-sidebar").theiaStickySidebar();
            }
        }

        // --- ElevateZoom on Modal ---
        // This is tied to the modal 'shown.bs.modal' event, which should be okay.
        // Make sure the elevateZoom call itself is robust.
        $(".modal")
            .off("shown.bs.modal.elevateZoom")
            .on("shown.bs.modal.elevateZoom", function (e) {
                console.log("Modal shown, initializing ElevateZoom..."); // Debug Log
                $(".product-image-slider .slick-active img").each(function () {
                    // Destroy previous instance if exists? (Check elevateZoom docs)
                    try {
                        $(this).data("elevateZoom") &&
                            $(this).data("elevateZoom").destroy();
                    } catch (ezError) {}
                    // Init elevateZoom
                    $(this).elevateZoom({
                        zoomType: "inner",
                        cursor: "crosshair",
                        zoomWindowFadeIn: 500,
                        zoomWindowFadeOut: 750,
                    });
                });
                // Ensure sliders in modal are positioned correctly
                $(".product-image-slider, .slider-nav-thumbnails").slick(
                    "setPosition"
                );
            });

        console.log(
            "✅ Theme plugins initialization/re-initialization finished."
        ); // Debug Log
    }

    // ======================================================
    //      Initializations & Event Listeners (Run Once)
    // ======================================================

    // --- Page loading ---
    $(window).on("load", function () {
        $("#preloader-active").delay(450).fadeOut("slow");
        $("body").delay(450).css({ overflow: "visible" });
        // $("#onloadModal").modal("show"); // Uncomment if you need the modal on load

        // Initial call to setup plugins after page load
        initializeThemePlugins();
    });

    // --- Menu Stick ---
    var header = $(".sticky-bar");
    var win = $(window);
    win.on("scroll", function () {
        var scroll = win.scrollTop();
        if (scroll < 200) {
            header.removeClass("stick");
            $(".header-style-2 .categori-dropdown-active-large").removeClass(
                "open"
            );
            $(".header-style-2 .categori-button-active").removeClass("open");
        } else {
            header.addClass("stick");
        }
    });

    // --- ScrollUp ---
    if (typeof $.scrollUp !== "undefined") {
        $.scrollUp({
            scrollText: '<i class="fi-rs-arrow-up"></i>',
            easingType: "linear",
            scrollSpeed: 100,
            animation: "fade",
        });
    }

    // --- Wow Active ---
    if (typeof WOW !== "undefined") {
        new WOW().init();
    }

    // --- Slider Range JS (jQuery UI) ---
    // Initialize once, unless Livewire dynamically changes the range/values
    if ($("#slider-range").length && typeof $.ui !== "undefined") {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 500,
            values: [130, 250], // Adjust min/max/values as needed
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            },
        });
        // Set initial value only if the element exists
        if ($("#amount").length) {
            $("#amount").val(
                "$" +
                    $("#slider-range").slider("values", 0) +
                    " - $" +
                    $("#slider-range").slider("values", 1)
            );
        }
    }
    // --- Second Price range slider ---
    if ($("#slider-range-2").length && typeof $.ui !== "undefined") {
        // Assuming you might have another slider like this
        var sliderrange = $("#slider-range-2"); // Use a different variable name
        var amountprice = $("#amount-2"); // Use a different target element
        sliderrange.slider({
            range: true,
            min: 16,
            max: 400,
            values: [0, 300], // Adjust as needed
            slide: function (event, ui) {
                amountprice.val("$" + ui.values[0] + " - $" + ui.values[1]);
            },
        });
        if (amountprice.length) {
            amountprice.val(
                "$" +
                    sliderrange.slider("values", 0) +
                    " - $" +
                    sliderrange.slider("values", 1)
            );
        }
    }

    // --- Category toggle function ---
    // Use event delegation for dynamically added elements if needed, but direct binding is usually fine here.

    // Close dropdown if clicking outside - needs careful implementation if inside Livewire updates
    // $(document).on('click', function(event) { ... }); // Add if needed

    // --- Shop filter active ---
    $(document).on("click", ".shop-filter-toogle", function (e) {
        e.preventDefault();
        $(".shop-product-fillter-header").slideToggle();
        $(this).toggleClass("active");
    });

    // --- Checkout toggle functions ---
    $(document).on("click", ".checkout-click1", function (e) {
        e.preventDefault();
        $(".checkout-login-info").slideToggle(900);
    });
    $(document).on("click", ".checkout-click3", function (e) {
        e.preventDefault();
        $(".checkout-login-info3").slideToggle(1000);
    });
    $(document).on("click", ".checkout-toggle2", function () {
        $(".open-toggle2").slideToggle(1000);
    });
    $(document).on("click", ".checkout-toggle", function () {
        $(".open-toggle").slideToggle(1000);
    });

    // --- Checkout paymentMethod function ---
    // Use event delegation on a static parent if the payment methods are loaded dynamically
    $(document).on(
        "click",
        '.payment-method input[name="payment_method"]',
        function () {
            var selectedClass = "payment-selected";
            var parent = $(this).closest(".sin-payment"); // Use closest for reliability
            parent
                .addClass(selectedClass)
                .siblings()
                .removeClass(selectedClass);
        }
    );

    // --- SidebarSearch ---
    function sidebarSearch() {
        var searchTrigger = $(".search-active"),
            endTriggersearch = $(".search-close"),
            container = $(".main-search-active");
        searchTrigger.on("click", function (e) {
            e.preventDefault();
            container.addClass("search-visible");
        });
        endTriggersearch.on("click", function () {
            container.removeClass("search-visible");
        });
        // Optional: Close on clicking outside the search container
        $(document).on("click", function (event) {
            if (
                !$(event.target).closest(".search-active, .main-search-active")
                    .length
            ) {
                container.removeClass("search-visible");
            }
        });
    }
    sidebarSearch(); // Call it once

    // --- Mobile Header Active ---
    function mobileHeaderActive() {
        var navbarTrigger = $(".burger-icon"),
            endTrigger = $(".mobile-menu-close"),
            container = $(".mobile-header-active"),
            wrapper = $("body"); // Renamed variable

        if (!$(".body-overlay-1").length) {
            wrapper.prepend('<div class="body-overlay-1"></div>');
        }
        var overlay = $(".body-overlay-1"); // Cache the overlay

        navbarTrigger.on("click", function (e) {
            e.preventDefault();
            container.addClass("sidebar-visible");
            wrapper.addClass("mobile-menu-active");
            overlay.fadeIn(); // Show overlay
        });

        function closeMobileMenu() {
            container.removeClass("sidebar-visible");
            wrapper.removeClass("mobile-menu-active");
            overlay.fadeOut(); // Hide overlay
        }

        endTrigger.on("click", closeMobileMenu);
        overlay.on("click", closeMobileMenu); // Use the cached overlay selector
    }

    mobileHeaderActive2(); // Call it once

    // --- Mobile menu active (Submenu toggle) ---
    var $offCanvasNav = $(".mobile-menu");
    var $offCanvasNavSubMenu = $offCanvasNav.find(".dropdown");

    $offCanvasNavSubMenu.parent().each(function () {
        if ($(this).find("> .menu-expand").length === 0) {
            // Add only if not already present
            $(this).prepend(
                '<span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span>'
            );
        }
    });
    // $offCanvasNavSubMenu.slideUp(); // Don't slide up initially if some menus should be open

    $offCanvasNav.on("click", "li a, li .menu-expand", function (e) {
        var $this = $(this);
        var $li = $this.parent("li");
        var $subMenu = $this.siblings("ul.dropdown"); // Target direct child submenu

        if (
            $li.hasClass("menu-item-has-children") ||
            $li.hasClass("has-children") ||
            $li.hasClass("has-sub-menu")
        ) {
            if ($this.attr("href") === "#" || $this.hasClass("menu-expand")) {
                e.preventDefault();
                if ($subMenu.is(":visible")) {
                    $li.removeClass("active");
                    $subMenu.slideUp();
                } else {
                    // Close other sibling menus
                    $li.siblings(".active")
                        .removeClass("active")
                        .find("ul.dropdown:visible")
                        .slideUp();
                    // Open current menu
                    $li.addClass("active");
                    $subMenu.slideDown();
                }
            }
        }
    });

    // --- Language/Currency active ---
    $(".mobile-language-active").on("click", function (e) {
        e.preventDefault();
        $(".lang-dropdown-active").slideToggle(900);
    });
    $(".categori-button-active-2").on("click", function (e) {
        e.preventDefault();
        $(".categori-dropdown-active-small").slideToggle(900);
    });

    // --- Mobile demo active ---
    $(".view-demo-btn-active").on("click", function (e) {
        e.preventDefault();
        $(".tm-demo-options-wrapper").toggleClass("demo-open");
    });

    // --- More Categories Open ---
    $(".more_slide_open").slideUp(); // Keep initial state hidden
    $(".more_categories").on("click", function () {
        $(this).toggleClass("show");
        $(".more_slide_open").slideToggle();
    });

    // --- News Flash (vTicker) ---
    if ($("#news-flash").length && typeof $.fn.vTicker !== "undefined") {
        $("#news-flash").vTicker({
            speed: 500,
            pause: 3000,
            animation: "fade",
            mousePause: false,
            showItems: 1,
        });
    }

    // ======================================================
    //      Livewire Hooks for Re-initialization
    // ======================================================
    document.addEventListener("livewire:init", () => {
        console.log("Livewire initialized, setting up hooks."); // Debug Log

        // Livewire v3 hook after component updates
        Livewire.hook(
            "commit",
            ({ component, commit, respond, succeed, fail }) => {
                // Runs after the component update succeeds and the DOM is patched
                succeed(({ snapshot, effect }) => {
                    console.log(
                        `Livewire component [${component.name}] finished update. Running re-init.`
                    ); // Debug Log
                    // Use queueMicrotask or setTimeout to ensure DOM is fully ready
                    queueMicrotask(() => {
                        initializeThemePlugins();
                    });
                    // Alternative: setTimeout(initializeThemePlugins, 1); // Minimal delay
                });

                // Optional: Runs if the component update fails
                fail(() => {
                    console.warn(
                        `Livewire component [${component.name}] update failed.`
                    ); // Debug Log
                });
            }
        );
    });

    document.addEventListener("livewire:navigated", () => {
        console.log("Livewire navigated, re-initializing theme plugins."); // Debug Log
        initializeThemePlugins();
    });

    document.addEventListener("livewire:commit", () => {
        console.log("Livewire committed, re-initializing theme plugins."); // Debug Log
        initializeThemePlugins();
    });

    document.addEventListener("livewire:init", () => {
        $(document).on("mouseenter", ".categori-button-active", function (e) {
            e.preventDefault();
            var $button = $(this);
            var $dropdown = $button.siblings(".categori-dropdown-active-large");
            $button.toggleClass("open");
            $dropdown.toggleClass("open");
        });
    });
})(jQuery);
