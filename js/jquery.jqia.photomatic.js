(function($) {

   function showPhoto(options, index) {
      $(options.photoElement).attr(
         'src',
         options.transformer(options.$thumbnails[index].src)
      );
      options.current = index;
   }

   var methods = {
      init: function(options) {
         options = $.extend(
            true,
            {},
            $.fn.jqiaPhotomatic.defaults,
            options,
            {
               current: 0,
               $thumbnails: this.filter('img')
            }
         );

         options.$thumbnails.click(function() {
            showPhoto(options, options.$thumbnails.index(this));
         });

         $(options.photoElement + ', ' + options.nextControl).click(function() {
            showPhoto(options, (options.current + 1) % options.$thumbnails.length);
         });

         $(options.previousControl).click(function() {
            showPhoto(options, options.current === 0 ? options.$thumbnails.length - 1 : options.current - 1);
         });

         $(options.firstControl).click(function() {
            showPhoto(options, 0);
         }).triggerHandler('click');

         $(options.lastControl).click(function() {
            showPhoto(options, options.$thumbnails.length - 1);
         });

         var tick;
         $(options.playControl).click(function() {
            var $this = $(this);
            if ($this.attr('src').indexOf('play') !== -1) {
               tick = window.setInterval(
                  function() {
                     $(options.nextControl).triggerHandler('click');
                  },
                  options.delay
               );
               $this.attr('src', $this.attr('src').replace('play', 'pause'));
            } else {
               window.clearInterval(tick);
               $this.attr('src', $this.attr('src').replace('pause', 'play'));
            }
         });

         return this;
      }
   };

   $.fn.jqiaPhotomatic = function(method) {
      if (methods[method]) {
         return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
      } else if ($.type(method) === 'object') {
         return methods.init.apply(this, arguments);
      } else {
         $.error('Method ' + method + ' does not exist on jQuery.jqiaPhotomatic');
      }
   };

   $.fn.jqiaPhotomatic.defaults = {
      photoElement: 'img.photomatic-photo',
      transformer: function(name) {
         return name.replace('thumbnail', 'photo');
      },
      nextControl: null,
      previousControl: null,
      firstControl: null,
      lastControl: null,
      playControl: null,
      delay: 3000
   };
})(jQuery);