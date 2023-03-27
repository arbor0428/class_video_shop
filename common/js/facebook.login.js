window.fbAsyncInit = function() {
	FB.init({
		appId      : '465074033889862',
		cookie     : true,
		xfbml      : true,
		version    : 'v2.8'
	});
	FB.AppEvents.logPageView();   
};

(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}
(document, 'script', 'facebook-jssdk'));

function checkLoginState() {
	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});
}

function fblogin(){
	FB.login(function(response) {
	  checkLoginState()
	}, {scope: 'public_profile,email'});
}

function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      call_api();
    } else {
      // The person is not logged into your app or we are unable to tell.
      alert("페이스북 인증 실패.");
    }
}

function call_api() {
    FB.api('/me',{fields: 'email,name,id'}, function(response) {
		
		$.ajax({
			type: "POST",
			url: g5_url+"/sns_login/facebook_callback.php",
			data: {
				"id": response.id,
				"name": response.name,
				"email": response.email
			},
			cache: false,
			async: false,
			success: function(data) {
				document.location.href = data;
			}
		});
    });
}