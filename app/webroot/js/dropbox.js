$(function() {
	var client = new Dropbox.Client({
		key: 'qvbabf98fm7um1u'
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
		client.getAccountInfo(function(err, info) {
			//var data = JSON.stringify(info._json);
			var json = info._json;
			// console.log(typeof json);
			console.log(json);
			$('#DropboxUserUid').val(json.uid);
			$('#DropboxUserEmail').val(json.email);
			$('#DropboxUserDisplayName').val(json.display_name);
			$('#DropboxUserCountry').val(json.country);
			$('#DropboxUserReferralLink').val(json.referral_link);
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
			$('#dropbox-login').hide();
			$('#DropboxUserUid').val(null);
			$('#DropboxUserEmail').val(null);
			$('#DropboxUserDisplayName').val(null);
			$('#DropboxUserCountry').val(null);
			$('#DropboxUserReferralLink').val(null);			
			$('#dropbox-connect span').text(" Connect with Dropbox");
			$('#dropbox-connect').removeClass('btn-danger').addClass('btn-primary');

		}
		// client.reset();
		client.authenticate();
	});

	// Called when the authentication status changes.
	function updateAuthenticationStatus(err, client) {
		// Once authenticated, find whether the user is on a team and
		// update UI accordingly.
		client.getAccountInfo(function(err, info) {
		});
	}

});
