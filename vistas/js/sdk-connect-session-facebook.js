
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '139453148022040',    /* => id de nuestra aplicacion creado en plataforma facebook */
      xfbml      : true,
      version    : 'v9.0'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
