(function ($) {
'use strict';

  /**
   * Collapse main menu
   *
   * Make target menu collapsible.
   * @param
   * - target: css selector denoting wrapper around menu.
   * - collapsed: bolean, denoted whether to add or remove collapsibility.
   * - toggle: String. Text used on toggle link.
   */
  var collapsibleElement = (function() {

    function collapsible (target, collapsed, toggle) {
      var $elWrapper = $(target);
      var $toggle;

      // Test that function hasn't already been run and that a text has been defined.
      if ($elWrapper.find('.toggle').length === 0 && toggle) {

        // Add a link to show/hide target menu.
        $toggle = $('<a />', {
          'href'   : '#',
          'text'   : toggle,
          'class'  : 'toggle collapsible'
          })
          .prependTo($elWrapper);

        // Add an event to show/hide menu when our link is clicked.
        $elWrapper.delegate('.toggle', 'click', function (event) {
          $toggle.toggleClass('collapsed');
          $elWrapper.find('.menu').slideToggle();

          // Prevent default action.
          event.preventDefault();
        });

        // Collapse menu immediately.
        if (collapsed) {
          $elWrapper.find('.menu').hide();
          $toggle.addClass('collapsed');
        }
      }
      // If collapsed is set to false, remove collabsibility instead.
      if (collapsed === false && $elWrapper.find('.toggle').length > 0) {
        $elWrapper.find('.menu').show();
        $elWrapper.find('.toggle').detach();
        $elWrapper.undelegate('.toggle', 'click');
      }
    }

    return {
      collapse: collapsible
    };


  }());

 /**
  * Setup media query listeners.
  *
  * Adapt website to different screen sizes.
  * Use enquire.js to trigger js based on mediaqueries.
  */
  var adaptContent = (function() {

    function initialize () {
      /* global enquire: true */

      // Register enguire
      enquire.register('screen and (max-width: 30.75em)', {

        // REQUIRED
        // Triggered when the media query transitions
        // from *unmatched* to *matched*
        match : function() {
          collapsibleElement.collapse('.menu-region', true, 'Menu');
          tabToAccordion('.ui-tabs', '.ui-tabs-nav', '.ui-tabs-panel');
        },

        // OPTIONAL
        // Triggered when the media query transitions
        // from a *matched* to *unmatched*
        unmatch : function() {
          collapsibleElement.collapse('.menu-region', false);
          accordionToTab('.ui-tabs');
        },

        // OPTIONAL
        // Triggered once immediately upon registration of handler
        setup : function() {},

        // OPTIONAL
        // Defaults to false
        // If true, defers execution of the setup function
        // until the first media query is matched (still just once)
        deferSetup : true
      })
      .register('screen and (max-width: 46em)', {
        match : function() {
          moveContent('.block-system-user-menu .menu', '.block-menu-menu-footer-menu', 'vagrant-menu');
        },
        unmatch : function() {
          moveContent('.vagrant-menu', '.block-system-user-menu');
        },
        setup : function() {},
        deferSetup : true
      })
      .register('screen and (min-width : 46em) and (max-width : 62em)' , {
        match : function() {
          tabToAccordion('.ui-tabs', '.ui-tabs-nav', '.ui-tabs-panel');
        },
        unmatch : function() {
          accordionToTab('.ui-tabs');
        },
        setup : function() {},
        deferSetup : true
      })
      .register('screen and (min-width : 86em)', {
        match : function() {
          moveContent('.list-logos', '.page-top');
        },
        unmatch : function() {
          moveContent('.list-logos', '.footer-region');
        },
        setup : function() {},
        deferSetup : true
      })
      .listen();
    }

    // Move content from target to destination. Add identifier class for easy retrieval.
    function moveContent (target, destination, identifier) {
      // Cache jquery object
      var $target = $(target);
      var $destination = $(destination);

      // Move sidebar info to main content
      $target.addClass(identifier);
      $destination.append($target);
    }

    // Switch between tabbed menu and accordion menu.
    function tabToAccordion (wrapper, nav, tabs) {
      var $tabwrapper = $(wrapper);
      var $tabs = $(tabs, $tabwrapper);
      var $tabnav = $(nav, $tabwrapper);

      // Move tab content into lists.
      // Run through $tabs array.
      $tabs.each(function () {
          // Grab id from tab content.
          var id = $(this).attr('id');
          // Find matching tab control.
          var $target = $('[href="#' + id + '"]');
          $target.addClass('vacc-control');
          // Insert tab content into the tab link itself.
          $(this).insertAfter($target);
        })
        .addClass('vacc-tab');
      $tabnav.addClass('st-vacc');
    }

    function accordionToTab (wrapper) {
      var $tabwrapper = $(wrapper);
      var $tabs = $('.vacc-tab', $tabwrapper);
      var $tablinks = $('.vacc-control', $tabwrapper);
      var $tabnav = $('.st-vacc', $tabwrapper);

      // Move tabs back out into wrapper.
      $tabs.appendTo($tabwrapper)
        .removeClass('vacc-tab');

      // Remove styling classes.
      $tablinks.removeClass('vacc-control');
      $tabnav.removeClass('st-vacc');
    }

    return {
      move: moveContent,
      init: initialize,
      accord: tabToAccordion,
      unAccord: accordionToTab
    };

  }());

 /**
  * Activate modal behavior for selected content.
  * Uses Bootstrap modal library.
  */
  var modalEffect = (function() {
    function addModalEffect () {
      var $modal = $('.block-modal');
      var $trigger = $modal.find('.modal-trigger');

      $trigger
        // Make a copy of the title to show inside the modal.
        .clone()
        // Remove class used to trigger modal.
        .addClass('modal-trigger-link')
        // Add icon wrapper
        .append($('<span />', {'class' : 'icon-subscribe'}))
        // Add class to modal content.
        .insertBefore($modal);

      $(document).delegate('.modal-trigger-link', 'click', open);
    }

    function open () {
      var $content = $(this).siblings().filter('.block-modal');
      $content.modal({
        opacity:40,
        overlayCss: {backgroundColor:'#000'},
        closeClass: 'icon-close'
      });
    }

    return {
      init: addModalEffect
    };
  }());

   /**
  * Activate modal behavior for selected content.
  * Uses Bootstrap modal library.
  */
  var responsiveMagic = (function() {
    function fitVideo () {
      $('.fluid-width-video-wrapper').fitVids();
    }

    return {
      vids: fitVideo
    };
  }());

  /**
   * Run functions on document ready.
   */
  $(document).ready(function() {
    // Add class to html if no support for Media Queries.
    if (!Modernizr.mq('only all')) {
      $('html').addClass('no-mq');
    }
    // Use Modernizr to conditionally load and call function on load.
    Modernizr.load([
      {
        // Test for mediaMatch support and load polyfill if needed.
        test: window.matchMedia,
        nope: '/sites/all/themes/personaleweb/js/libs/matchMedia.js'
      },
      {
        // Load enguire.js
        load: '/sites/all/themes/personaleweb/js/libs/enquire.js',
        callback : adaptContent.init
      },
      {
        // Load simplemodal.js
        load: '/sites/all/themes/personaleweb/js/libs/jquery.simplemodal.1.4.3.min.js',
        callback : modalEffect.init
      },
      {
        // Load fitvids.js
        load: '/sites/all/themes/personaleweb/js/libs/jquery.fitvids.js',
        callback : responsiveMagic.vids
      }
    ]);
  });

  Drupal.behaviors.pwb_print_link = {
    attach: function (context, settings) {
      $('a.print-page').attr('href', '#').click(function(event){
      event.preventDefault();

      window.print();
      });
    }
  };

  })(jQuery);
