function BasicForm (jqueryElement) {
	var self = this;

	self.form = jqueryElement;
	self.form.submit(function (e) {
		// Submit to session creation controller
		var jqxhr = $.ajax({
			type: "POST",
			url: self.form.attr('action'),
			data: self.form.serialize(),
			dataType: "json"
		});
		jqxhr.done(function (data) {
			if (data.status == "okay") {
				if (typeof data.redirect !== 'undefined') {
					location.href = data.redirect;
				}
				else if (typeof self.form.data('success-url') !== 'undefined') {
					location.href = self.form.data('success-url');
				}
			} else if (data.status == "error") {
				self.set_error_message(data);
			} else {
				self.set_error_message("An unknown error occured :/");
			}
		});
		jqxhr.fail(function () {
			alert("An error occured communicating with the server. Did your internet connection go down?");
		});

		// Prevent form from being handled further
		e.stopPropagation();
		e.preventDefault();
	});
}

BasicForm.prototype.set_error_message = function(data) {
	// Get error box
	var errorBox = this.form.find('.error-message').first();

	if (errorBox.length > 0) {
		// Apply message
		errorBox.html(data.message);
		// Display error box
		errorBox.removeClass('dispnone');
	} else {
		alert(data.message);
	}
};
