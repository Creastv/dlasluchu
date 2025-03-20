/*
| ==========================================================
| Scroll To Top
| ========================================================== */

jQuery(document).ready(function () {
    "use strict";
    // Scroll To Top
    jQuery("body").prepend(
        '<div class="go-top"><span id="top">top</span></div>'
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


// document.addEventListener('DOMContentLoaded', function() {
//   var navLinks = document.querySelectorAll('.navbar-nav .menu-item a')
//   var smoothScrollLinks = document.querySelectorAll('.smooth-scroll');
//   var navbarCollapse = document.querySelector('.navbar-collapse')
//   var mergedLinks = Array.from(smoothScrollLinks).concat(Array.from(navLinks));

//   mergedLinks.forEach(function(link) {
//     link.addEventListener('click', function(event) {
//       event.preventDefault()
//       var targetId = this.getAttribute('href').substring(1)
//       var targetElement = document.getElementById(targetId)
//       if (targetElement) {
//         window.scrollTo({
//           top: targetElement.offsetTop,
//           behavior: 'smooth',
//         })
//       }
//       if (window.innerWidth < 992) {
//         // Check if the screen width is less than 992px (Bootstrap's lg breakpoint)
//         var bsCollapse = new bootstrap.Collapse(navbarCollapse, {
//           toggle: false,
//         })
//         bsCollapse.hide()
//       }
//     })
//   })
// })
