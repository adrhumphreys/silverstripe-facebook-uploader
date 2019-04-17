<div id="facebook-uploader" name="$Name"></div>

<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId: '{$getAttribute('FACEBOOK_APP_ID')}',
            cookie: true, // This is important, it's not enabled by default
            version: 'v2.2'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<% require javascript("resources/facebook-uploader/js/dist/index.js") %>
