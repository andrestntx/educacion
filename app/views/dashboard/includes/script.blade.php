<!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
<?php 
	$url_jquery = URL::to('assets/js/vendor/jquery-2.1.1.min.js');
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>!window.jQuery && document.write(decodeURI('%3Cscript src="{{$url_jquery}}"%3E%3C/script%3E'));</script>

<!-- Bootstrap.js, Jquery plugins and Custom JS code -->

{{ HTML::script('assets/js/vendor/bootstrap.min.js'); }}
{{ HTML::script('assets/js/plugins.js'); }}
{{ HTML::script('assets/js/app.js'); }}
{{ HTML::script('assets/js/admin.js'); }}
{{ HTML::script('assets/js/plugins/fileinput/fileinput.min.js'); }}