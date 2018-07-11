</div>
<footer>
	<div class="footer-left"><p> © 18 Blue Data Asset Management Specialists </p></div>
	<div class="footer-right">
		<ul>
			<li><a href="#"><img src="{{ asset('public/images/fb-icon.png')}}"></a></li>
			<li><a href="#"><img src="{{ asset('public/images/tw-icon.png')}}"></a></li>
			<li><a href="#"><img src="{{ asset('public/images/gogl_icon.png')}}"></a></li>
			<li><a href="#"><img src="{{ asset('public/images/in-icon.png')}}"></a></li>
		</ul>
	</div>
</footer>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('public/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/popper.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/bootstrap.min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>

<script type="text/javascript">
	$(".toggle-password").click(function() {
		$(this).toggleClass("field-icon");
		var input = $($(this).attr("toggle"));
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		} else {
			input.attr("type", "password");
		}
	});	
</script>
<script>
	(function($){
		$(window).on("load",function(){
			$(".demo-y").mCustomScrollbar();
		});
	})(jQuery);

	$(".tob-nve-btn").click(function() {
		$("body").toggleClass('sild-menu');
	});	
</script>
</body>
</html>