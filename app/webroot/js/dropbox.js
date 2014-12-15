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
		$('#dropbox-login').show();
		$('#dropbox-connect span').text(" Sign out of Dropbox").removeClass('fa-dropbox').addClass('fa-sign-out');
		$('#dropbox-connect').removeClass('btn-primary').addClass('btn-danger');
		// $('#dropbox-connect').hide();
		client.getAccountInfo(function(err, info) {
			//var data = JSON.stringify(info._json);
			var json = info._json;
			// console.log(typeof json);
			console.log(json);
			$('#UserId').val(json.uid);
			$('#UserEmail').val(json.email);
			$('#UserDisplayName').val(json.display_name);
			$('#UserCountry').val(json.country);
			$('#UserReferralLink').val(json.referral_link);
			// $.ajax({
			// 	type: "post",
			// 	url: '/maya-notes-app/users/login_via_dropbox/',
			// 	data: {data: json},
			// 	dataType: 'json',
	  //           success: function(response) {
   //                  // alert(typeof response);
   //                  var json = JSON.parse(response);
   //                  console.log(json);
			// 	},
			// 	error:function (status) {
			// 	      // alert(status);
			// 	}
			// });
		});

		// var data;
		// var data = JSON.parse(xhr.responseText);
		// var data = xhr.getResponseHeader("Date");
		// $('#result').text(data);
		// alert(typeof data);
		// alert(token.responseText);
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
			$('#dropbox-connect').removeClass('btn-danger').addClass('btn-primary');
			$(location).attr('href','/maya-notes-app/users/logout');

		}
		// client.reset();
		client.authenticate();
	});
});
