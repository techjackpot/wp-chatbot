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

	const api_server = 'http://127.0.0.1:9001';

  $(document).ready(function() {

    function checkStatus() {
      $.get(`${api_server}/chatbot/status`, function(data) {
        console.log(data);
        $('.chatbot-embedding-status').html(`
          <p>Last Run Date: <span>${new Date(data.crawl.lastRunDate).toLocaleString()}</span></p>
          ${data.crawl.is_running && `<p>Status: <strong>Running</strong></p>` || ''}
        `);
        $('#chatbot-embedding-submit').prop('disabled', data.crawl.is_running);
        $('.chatbot-embedding-form').show();
      });
    }

    setInterval(function() {
      checkStatus();
    }, 1000 * 15);

    checkStatus();

    $('.chatbot-embedding-form').on('submit', function(e) {
      if (!confirm('Do you want to start crawling embedding data?')) {
        return false;
      }
      $.post(`${api_server}/chatbot/crawl`, function(data) {
        $('#chatbot-embedding-submit').prop('disabled', true);
        checkStatus();
      });
      return false;
    })
  });

})( jQuery );
