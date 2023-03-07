(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	const api_server = 'https://iq.sixaxisllc.com';

  $(document).ready(function() {

    function checkStatus() {
      $.get(`${api_server}/chatbot/status`, function(data) {
        if (!data.conversion) return;
        $('#conversion_from').val(data.conversion.from);
        $('#conversion_to').val(data.conversion.to);
        $('.chatbot-conversion-form').show();
      });
    }

    checkStatus();

    $('.chatbot-conversion-form').on('submit', function(e) {
      $('.chatbot-conversion-form').addClass('loading');
      $('#chatbot-conversion-submit').prop('disabled', true);
      $.post(`${api_server}/chatbot/set_conversion`, {
        from: $('#conversion_from').val(),
        to: $('#conversion_to').val(),
      }, function(data) {
				$('.chatbot-conversion-form').removeClass('loading');
				$('#chatbot-conversion-submit').prop('disabled', false);
      });
      return false;
    })
  });

})( jQuery );
