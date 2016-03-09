<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Get Happy: Cheap eats, things to do, happy hour</title>
        <meta name="description" content="Find cheap eats, happy hour, plus great things to do near you in Auckland and Wellington.">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <link href="{{URL::to('css/select2.css')}}" rel="stylesheet" />
<!--         <link href="{{URL::to('bower_components/dist/css/select2.min.css')}}" rel="stylesheet">
 -->        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!--         <link rel="stylesheet" href="css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link href="{{URL::to('css/app.css')}}" rel="stylesheet" media="screen, projection">
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea', entity_encoding : "raw", element_format : 'html' });</script>

@yield('styles')
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <nav class="mynav" role="navigation">
<!--       <div class="container"> -->
         <a class="navbar-brand" href="{{URL::to('/')}}">
            <span class="headerImage">
                <img src="{{URL::to('images/happyfacetinyblue.png')}}" class="logoImage" alt="happy hour">
            </span>
         </a>
        <div class="navButton">
          <button type="button" class="hamburger">
            <span class="iconBar"></span>
            <span class="iconBar"></span>
            <span class="iconBar"></span>
          </button>
        </div>
        <div class="homeMenu">
          <ul>
            <li class="active"><a href="{{URL::to('/')}}">HOME</a></li>
            <li><a href="{{URL::to('/about')}}">ABOUT</a></li>
          </ul>  
        </div>
         <div class="socialMedia">
             <ul>
                 <li><a class="socialMediaLink" href="https://www.facebook.com/gethappynz"><i class="fa fa-facebook"></i></a></li>
                 <li><a class="socialMediaLink" href="https://www.twitter.com/gethappynz"><i class="fa fa-twitter"></i></a></li>
             </ul>
         </div>

      @if(Auth::check())
        <div class="adminStuff">
          <h4>Hi {{Auth::user()->name}}!</h4>
          <a href="{{URL::to('/articles/show')}}" class="adminLinks" target="blank">ADMIN HUB</a>
          <a href="{{URL::to('/auth/logout')}}" class="adminLinks" target="blank">LOGOUT</a>
        </div>  
      @endif
    </nav>

    @yield('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.mixitup/2.1.11/jquery.mixitup.min.js"></script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyBWBBPv_XC5CpL6F7mfyLTMFfs9dj1cfYQ&signed_in=true&libraries=places"></script>
{!! HTML::script('js/infobubble.js'); !!}
<script src="{{URL::to('js/jquery.nicescroll.min.js')}}"></script>
<script src="{{URL::to('js/select2.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-73224940-1', 'auto');
  ga('send', 'pageview');
</script>
    @yield('footer')
</body>
</html>
