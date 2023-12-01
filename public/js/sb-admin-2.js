(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
    
    // Toggle the side navigation when window is resized below 480px
    if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
      $("body").addClass("sidebar-toggled");
      $(".sidebar").addClass("toggled");
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

    // Add a click event listener to the navCollapseZero link
  $(document).on('click', '.carousel-item', function(e) {
    $('.container-fluid').remove();
        // Toggle the 'collapsed' class on the navCollapseZero link
    $(this).toggleClass('collapsed');

        // Toggle the 'show' class on the collapseZero section
    $('#collapseZero').toggleClass('show');
  });

  document.addEventListener('htmx:beforeSwap', function (event) {
    if (typeof $.fn.DataTable !== 'undefined') {
      $(event.target).find('#dataTable').DataTable().destroy();
    }
  });

})(jQuery); // End of use strict

$(document).on('click', '.collapse-item', function() {
  $(this).toggleClass('collapsed');
  $(this).closest('.collapse').toggleClass('show');
});


$(document).ready(function() {
        // Show dropdown on hover
    $('#userMenuContainer').hover(
        function() {
            $(this).find('#userMenu, #userInformation').addClass('show');
        },
        function() {
            $(this).find('#userMenu, #userInformation').removeClass('show');
        }
        );
});


// document.body.addEventListener('htmx:beforeRequest', function(evt) {
//     htmx.addClass(htmx.find('#app'), 'd-none');
//     console.log(evt);
// });

document.body.addEventListener('htmx:targetError', function(evt) {
    var targetNotExist = document.getElementById("htmx-alert");
    targetNotExist.innerText = 'Error selecting target:' + evt.detail.target;
    targetNotExist.removeAttribute("hidden");
    targetNotExist.classList.add('alert', 'alert-warning');
    htmx.addClass(htmx.find('.container-fluid'), 'd-none');
});

document.body.addEventListener('htmx:afterRequest', function (evt) {
    const errorTarget = document.getElementById("htmx-alert");
    if (evt.detail.successful) {
        //htmx.removeClass(htmx.find('#app'), 'd-none');
        const collapseElements = htmx.findAll('.collapse');
        collapseElements.forEach(function (element) {
            htmx.removeClass(element, 'show');
        });
        // Successful request, clear out alert
        errorTarget.setAttribute("hidden", "true")
        errorTarget.innerText = "";
    } else if (evt.detail.failed && evt.detail.xhr) {
        // Server error with response contents, equivalent to htmx:responseError
        console.warn("Server error", evt.detail)
        const xhr = evt.detail.xhr;
        errorTarget.innerHTML = `Unexpected server error: ${xhr.status} - ${xhr.response}`;
        errorTarget.removeAttribute("hidden");
        $('#hulk-button').addClass('d-none');
    } else {
        // Unspecified failure, usually caused by network error
        console.error("Unexpected htmx error", evt.detail)
        errorTarget.innerText = "Unexpected error, check your connection and try to refresh the page.";
        errorTarget.classList.add('alert', 'alert-warning');
        errorTarget.removeAttribute("hidden");
    }
});
