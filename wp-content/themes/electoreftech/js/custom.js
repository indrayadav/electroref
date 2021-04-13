(function($) {

  $.fn.menumaker = function(options) {
      
      var mainmenu = $(this), settings = $.extend({
        title: "Menu",
        format: "dropdown",
        sticky: false
      }, options);

      return this.each(function() {
        mainmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
        $(this).find("#menu-button").on('click', function(){
          $(this).toggleClass('menu-opened');
          var mainmenu = $(this).next('ul');
          if (mainmenu.hasClass('open')) { 
            mainmenu.hide().removeClass('open');
          }
          else {
            mainmenu.show().addClass('open');
            if (settings.format === "dropdown") {
              mainmenu.find('ul').show();
            }
          }
        });

        mainmenu.find('li ul').parent().addClass('has-sub');

        multiTg = function() {
          mainmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
          mainmenu.find('.submenu-button').on('click', function() {
            $(this).toggleClass('submenu-opened');
            if ($(this).siblings('ul').hasClass('open')) {
              $(this).siblings('ul').removeClass('open').hide();
            }
            else {
              $(this).siblings('ul').addClass('open').show();
            }
          });
        };

        if (settings.format === 'multitoggle') multiTg();
        else mainmenu.addClass('dropdown');

        if (settings.sticky === true) mainmenu.css('position', 'fixed');

        resizeFix = function() {
          if ($( window ).width() > 768) {
            mainmenu.find('ul').show();
          }

          if ($(window).width() <= 768) {
            mainmenu.find('ul').hide().removeClass('open');
          }
        };
        resizeFix();
        return $(window).on('resize', resizeFix);

      });
  };
})(jQuery);

(function($){
$(document).ready(function(){

$(document).ready(function() {
  $("#mainmenu").menumaker({
    title: "Menu",
    format: "multitoggle"
  });

  $("#mainmenu").prepend("<div id='menu-line'></div>");

var foundActive = false, activeElement, linePosition = 0, menuLine = $("#mainmenu #menu-line"), lineWidth, defaultPosition, defaultWidth;

$("#mainmenu > ul > li").each(function() {
  if ($(this).hasClass('active')) {
    activeElement = $(this);
    foundActive = true;
  }
});

if (foundActive === false) {
  activeElement = $("#mainmenu > ul > li").first();
}

defaultWidth = lineWidth = activeElement.width();

defaultPosition = linePosition = activeElement.position().left;

menuLine.css("width", lineWidth);
menuLine.css("left", linePosition);

$("#mainmenu > ul > li").hover(function() {
  activeElement = $(this);
  lineWidth = activeElement.width();
  linePosition = activeElement.position().left;
  menuLine.css("width", lineWidth);
  menuLine.css("left", linePosition);
}, 
function() {
  menuLine.css("left", defaultPosition);
  menuLine.css("width", defaultWidth);
});

});


});
})(jQuery);



// Top Products

 jQuery(document).ready(function() {
              var owl = $('.bestselllerowl');
              owl.owlCarousel({
                loop: true,
                dots: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                smartSpeed: 2500,
        responsive: {
                  0: {
                    items: 2,
                    nav: true,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    loop: false,
                  },
                  600: {
                    items: 4,
                    nav: true,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    loop: false,
                  },
                  1000: {
                    items: 6,
                    nav: true,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    loop: false,
                    margin: 20
                  }
                }
              });
              $('.play').on('click', function() {
                owl.trigger('play.owl.autoplay', [1000])
              })
              $('.stop').on('click', function() {
                owl.trigger('stop.owl.autoplay')
              })
            });

 // Sidebar menu
(function($) {

  $.fn.sidebarmenu = function(options) {
      
      var sidebarmenuleft = $(this), settings = $.extend({
        title: "Menu",
        format: "dropdown",
        sticky: false
      }, options);

      return this.each(function() {
       
        $(this).find("#menu-button").on('click', function(){
          $(this).toggleClass('menu-opened');
          var mainmenu = $(this).next('ul');
          if (mainmenu.hasClass('open')) { 
            mainmenu.hide().removeClass('open');
          }
          else {
            mainmenu.show().addClass('open');
            if (settings.format === "dropdown") {
              mainmenu.find('ul').show();
            }
          }
        });

        sidebarmenuleft.find('li ul').parent().addClass('has-sub');

        multiTg = function() {
          sidebarmenuleft.find(".has-sub").prepend('<span class="submenu-button"></span>');
          sidebarmenuleft.find('.submenu-button').on('click', function() {
            $(this).toggleClass('submenu-opened');
            if ($(this).siblings('ul').hasClass('open')) {
              $(this).siblings('ul').removeClass('open').hide();
            }
            else {
              $(this).siblings('ul').addClass('open').show();
            }
          });
        };

        if (settings.format === 'multitoggle') multiTg();
        else sidebarmenuleft.addClass('dropdown');

        if (settings.sticky === true) sidebarmenuleft.css('position', 'fixed');

       
       

      });
  };
})(jQuery);

(function($){
$(document).ready(function(){

$("#sidebarmenuleft").sidebarmenu({
   title: "Menu",
   format: "multitoggle"
});

});
})(jQuery);

// Best Sellers

 jQuery(document).ready(function() {
              var owl = $('.bestselllerowlproduct');
              owl.owlCarousel({
                loop: true,
                dots: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                smartSpeed: 2500,
        responsive: {
                  0: {
                    items: 2,
                    nav: true,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    loop: false,
                  },
                  600: {
                    items: 4,
                    nav: true,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    loop: false,
                  },
                  1000: {
                    items: 6,
                    nav: true,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    loop: false,
                    margin: 20
                  }
                }
              });
              $('.play').on('click', function() {
                owl.trigger('play.owl.autoplay', [1000])
              })
              $('.stop').on('click', function() {
                owl.trigger('stop.owl.autoplay')
              })
            });