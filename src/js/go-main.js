/*
| ==========================================================
| Scroll To Top
| ========================================================== */

jQuery(document).ready(function () {
    "use strict";
    // Scroll To Top
    jQuery("body").prepend(
        '<div class="go-top"><span id="top"></span></div>'
    );

    jQuery(window).scroll(function () {
        if (jQuery(window).scrollTop() > 500) {
            jQuery(".go-top").fadeIn(600);
        } else {
            jQuery(".go-top").fadeOut(600);
        }
    });

    jQuery("#top").click(function () {
        jQuery("html, body").animate({ scrollTop: 0 }, 800);
        return false;
    });
});
// Sticky Header
jQuery(window).scroll(function () {
    var scroll = jQuery(window).scrollTop();

    if (scroll >= 122) {
        jQuery(".navbar").addClass("active");
    } else {
        jQuery(".navbar").removeClass("active");
    }
});





var navLinks = document.querySelectorAll('.navbar-nav .menu-item a');

function toggleNavbar() {
    const navbarCollapse = document.querySelector('.navbar-collapse');
    const toggler = document.querySelector('.navbar-toggler');

    if (navbarCollapse) {
        const isShown = navbarCollapse.classList.contains('show');

        if (isShown) {
            // Jeśli pokazane → chowamy
            navbarCollapse.classList.remove('show');
            if (toggler) {
                toggler.setAttribute('aria-expanded', 'false');
            }
        } else {
            // Jeśli schowane → pokazujemy
            navbarCollapse.classList.add('show');
            if (toggler) {
                toggler.setAttribute('aria-expanded', 'true');
            }
        }
    }
}


document.querySelectorAll('.menu-item a span').forEach(function(link) {
    link.addEventListener('click', function() {
        toggleNavbar();
        setTimeout(() => {
            history.replaceState(null, null, window.location.pathname + window.location.search);
        }, 10); // małe opóźnienie
        
    });
});


// const button = document.querySelector('.navbar-toggler');

// button.addEventListener('click', function() {
//     document.querySelector('.navbar-collapse').classList.toggle('show');
//     console.log('test')
// });