
(function ($) {
    "use strict";

    // Spinner
    let spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            } else {
                console.log("No spinner found");
            }
        }, 1);
    };
    spinner();
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });
    
    
    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
    
    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav : false,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });
    
})(jQuery);


/* Code pour le Pop-up Cookies */

document.addEventListener("DOMContentLoaded", function() {
    // Sélectionne le pop-up et les boutons
    let cookiePopup = document.querySelector("#cookie-popup");
    let acceptButton = document.querySelector("#accept-cookies");
    let rejectButton = document.querySelector("#reject-cookies");

    if (cookiePopup != null && acceptButton != null && rejectButton != null) {
        // Vérifie si l'utilisateur a déjà accepté ou refusé les cookies
        if (!localStorage.getItem("cookiesAccepted")) {
            cookiePopup.classList.remove("hidden");
        }

        // Action pour accepter les cookies
        acceptButton.addEventListener("click", function() {
            localStorage.setItem("cookiesAccepted", "true"); // Enregistre l'acceptation
            cookiePopup.classList.add("hidden"); // Cache le pop-up
        });

        // Action pour refuser les cookies
        rejectButton.addEventListener("click", function() {
            localStorage.setItem("cookiesAccepted", "false"); // Enregistre le refus
            cookiePopup.classList.add("hidden"); // Cache le pop-up
        });
    }
});


/* Fin du Code Pop-up Cookies */

