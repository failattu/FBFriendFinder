<html>
<header>

</header>

<body>
<div id="fb-root"></div>
<script>
var yoururl = "Your domain"
  window.fbAsyncInit = function() {
  FB.init({
    appId      : 'FBAppid',
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });

  FB.Event.subscribe('auth.authResponseChange', function(response) {

    if (response.status === 'connected') {
		var accessToken = response.authResponse.accessToken;
		var fbresponse = response.status;
      location.href = yoururl + "/Program.php?fbresp="+fbresponse+"&atoken="+accessToken;
    } else if (response.status === 'not_authorized') {
      FB.login(function(){},{scope:'basic_info,email,friends_location'});
    } else {
    FB.login(function(){},{scope:'basic_info,email,friends_location'});
    }
  });
  };
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    if (response.status === 'connected') {
      var accessToken = response.authResponse.accessToken;
		var fbresponse = response.status;
      location.href = yoururl + "/Program.php?fbresp="+fbresponse+"&atoken="+accessToken;
    } else if (response.status === 'not_authorized') {
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
  // Load the SDK asynchronously
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));

function login ()
{
FB.login(function(){},{scope:'basic_info,email,friends_location'});
}
</script>
<div class="fb-login-button" scope:"basic_info,email,friends_location" onlogin="checkLoginState();" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="false"></div>
<input type="button" onclick="login()" name="Login FB">Login FB</button>
</body>

<p>Hello this site requires you to login with your Facebook account.</p>
<p>Please make sure you can see Javascript popups. <br>
This application is meant to show you where your friends are located have fun.
</p>
</html>
