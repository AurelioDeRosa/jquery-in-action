(function($) {
   var namespace = 'jqiaContextMenu';

   var methods = {
      init: function(options) {
         if (!options.idMenu) {
            $.error('No menu specified');
         } else if ($('#' + options.idMenu).length === 0) {
            $.error('The menu specified does not exist');
         }

         options = $.extend(true, {}, $.fn.jqiaContextMenu.defaults, options);

         // Test if the plugin has already been initialized on one or more elements
         if (
            this.filter(function() {
               return $(this).data(namespace);
            }).length !== 0
            ) {
            $.error('The plugin has already been initialized');
         }

         this.data(namespace, options);

         // Hide the menu if the user clicks outside the elements specified
         $('html').on(
            'contextmenu.' + namespace + ' click.' + namespace,
            function() {
               $('#' + options.idMenu).hide();
            }
         );

         this.on(
            'contextmenu.' + namespace + (options.bindLeftClick ? ' click.' + namespace : ''),
            function(event) {
               event.preventDefault();
               event.stopPropagation();

               $('#' + options.idMenu)
                  .css({
                     top: event.pageY,
                     left: event.pageX
                  })
                  .show();
            }
         );

         return this;
      },
      destroy: function() {
         this
            .each(function() {
               var options = $(this).data(namespace);
               if (options !== undefined) {
                  // Hide the menu if it's currently visible
                  $('#' + options.idMenu).hide();
               }
            })
            .removeData(namespace)
            .add('html')
            .off('.' + namespace);

         return this;
      }
   };

   $.fn.jqiaContextMenu = function(method) {
      if (methods[method]) {
         return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
      } else if ($.type(method) === 'object') {
         return methods.init.apply(this, arguments);
      } else {
         $.error('Method ' + method + ' does not exist on jQuery.jqiaContextMenu');
      }
   };

   $.fn.jqiaContextMenu.defaults = {
      idMenu: null,
      bindLeftClick: false
   };
})(jQuery);