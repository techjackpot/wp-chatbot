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


	function convertToCSV(objArray) {
		var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
		var str = '';

		for (var i = 0; i < array.length; i++) {
			var line = '';
			for (var index in array[i]) {
				if (line != '') line += ','

				line += array[i][index];
			}

			str += line + '\r\n';
		}

		return str;
	}

	function exportCSVFile(headers, items, fileTitle) {
		if (headers) {
			items.unshift(headers);
		}

		// Convert Object to JSON
		var jsonObject = JSON.stringify(items);

		var csv = convertToCSV(jsonObject);

		var exportedFilenmae = fileTitle + '.csv' || 'export.csv';

		var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
		if (navigator.msSaveBlob) { // IE 10+
			navigator.msSaveBlob(blob, exportedFilenmae);
		} else {
			var link = document.createElement("a");
			if (link.download !== undefined) { // feature detection
				// Browsers that support HTML5 download attribute
				var url = URL.createObjectURL(blob);
				link.setAttribute("href", url);
				link.setAttribute("download", exportedFilenmae);
				link.style.visibility = 'hidden';
				document.body.appendChild(link);
				link.click();
				document.body.removeChild(link);
			}
		}
	}

	$(document).ready(function() {
		$('.chatbot-export-form').on('submit', function(e) {
			$(this).addClass('loading');
			$('#chatbot-export-submit').prop('disabled', true);
			let date_from = $('#date_from').val();
			let date_to = $('#date_to').val();
			$.post(`${api_server}/chatbot/export`, {
				from: date_from,
				to: date_to,
			}, function(data) {
				$('.chatbot-export-form').removeClass('loading');
				$('#chatbot-export-submit').prop('disabled', false);

				exportCSVFile({
					created_at: 'Date/Time',
					duration: 'Duration',
					ip: 'IP',
					title: 'Page Title',
					url: 'Page URL',
					contact: 'Extracted Contact',
					transcripts: 'Transcripts',
				}, data.map(row => {
					const duration_secs = (new Date(row.exit_at) - new Date(row.enter_at)) / 1000;
					return {
						created_at: JSON.stringify(new Date(row.created_at).toLocaleString()),
						duration: Math.floor(duration_secs / 60) + 'm',
						ip: row.ip,
						title: JSON.stringify(row.title),
						url: row.url,
						contact: JSON.stringify(JSON.parse(row.contact_raw).choices[0].text),
						transcripts: JSON.stringify(JSON.parse(row.transcripts).map(message => `${message.author}: ${message.text}`).join('\n\n')),
					};
				}), `chats_${date_from}_${date_to}`);
			});
			return false;
		});
	})

})( jQuery );
