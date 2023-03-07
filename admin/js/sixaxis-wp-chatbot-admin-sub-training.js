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
        $('.chatbot-training-status').html(`
          <p>Last Run Date: <span>${new Date(data.crawl.lastRunDate).toLocaleString()}</span></p>
          ${data.crawl.is_running && `<p>Status: <strong>Running</strong></p>` || ''}
        `);
        $('#chatbot-training-submit').prop('disabled', data.crawl.is_running);
        $('.chatbot-training-form').show();
      });
    }

    setInterval(function() {
      checkStatus();
    }, 1000 * 15);

    checkStatus();

    $('.chatbot-training-form').on('submit', function(e) {
      if (!confirm('Do you want to start crawling training data?')) {
        return false;
      }
      $.post(`${api_server}/chatbot/crawl`, function(data) {
        $('#chatbot-training-submit').prop('disabled', true);
        checkStatus();
      });
      return false;
    })
  });

})( jQuery );
