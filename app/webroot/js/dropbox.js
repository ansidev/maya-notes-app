$(function() {
	var client = new Dropbox.Client({
		key: 'zqbqp0fe1i6oacx'
	});

	// Try to finish OAuth authorization.
	client.authenticate({
		interactive: false
	}, function(error) {
		if (error) {
			alert('Authentication error: ' + error);
		}
	});

	if (client.isAuthenticated()) {
		//client.getAccessToken();
		// client.token();
		// document.write(info);
		// alert('Connected');
		// $('#dropbox-login').show();
		// $('#dropbox-connect span').text(" Sign out of Dropbox").removeClass('fa-dropbox').addClass('fa-sign-out');
		// $('#dropbox-connect').removeClass('btn-primary').addClass('btn-danger');
		$('#dropbox-connect').hide();
		client.getAccountInfo(function(err, info) {
			var json = info._json;
			// console.log(typeof json);
			console.log(json);
			$('#UserId').val(json.uid);
			$('#UserEmail').val(json.email);
			$('#UserDisplayName').val(json.display_name);
			$('#UserCountry').val(json.country);
			$('#UserReferralLink').val(json.referral_link);
			$('#UserLoginForm').submit();
		});
	}

	$('#dropbox-connect').click(function(e) {
		e.preventDefault();
		if (client.isAuthenticated()) {
			//client.getAccessToken();
			client.signOut();
			$('.error-message').hide();
			$('#dropbox-login').hide();
			$('#UserId').val(null);
			$('#UserEmail').val(null);
			$('#UserDisplayName').val(null);
			$('#UserCountry').val(null);
			$('#UserReferralLink').val(null);			
			$('#dropbox-connect span').text(" Connect with Dropbox");
			$('#dropbox-connect').removeClass('btn-danger').addClass('btn-primary').show();
			$(location).attr('href','/maya-notes-app/users/logout');

		}
		// client.reset();
		client.authenticate();
	});
});
