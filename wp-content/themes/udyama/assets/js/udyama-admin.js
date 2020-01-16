jQuery(document).ready(function(jQuery) {

	"use strict";

	jQuery(document).on( 'click', '.udyama-intro-notice .be-notice-dismiss', function(e) {
		e.preventDefault();
		jQuery.ajax({
			url: ajaxurl,
			data: {
				action: 'udyama-intro-dismissed'
			},
			success: function() {
				location.reload();
			}
		});
	});

});
