<!doctype html>
<html lang="ar">
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="font/ttf">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{$PUBLIC_ASSETS}}/img/forweb2.jpg" type="image/x-icon">
	<title>
		{{$title}}
	</title>

	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/main.css">

	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/slicknav.css">

	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/color-switcher.css">

	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/responsive.css">
	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/custom.css">
	<link rel="stylesheet" media="screen" href="{{$PUBLIC_ASSETS}}/fonts/font-awesome/font-awesome.min.css">
	<link rel="stylesheet" media="screen" href="{{$PUBLIC_ASSETS}}/fonts/simple-line-icons.css">

	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/extras/owl/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/extras/owl/owl.theme.css">
	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/extras/animate.css">
	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/extras/normalize.css">
	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/colors/green.css" media="screen">
	<link rel="stylesheet" id="colors" href="{{$PUBLIC_ASSETS}}/css/colors/green.css" type="text/css">
	<link rel="stylesheet" href="{{$PUBLIC_ASSETS}}/css/color-switcher.css" type="text/css">
	<script src="{{$PUBLIC_ASSETS}}/js/jquery-min.js"></script>
	{{-- <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
  	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  	<link rel="stylesheet" href="{{$PUBLIC_ASSETS}}/fonts/font-awesome.min.css">
          <link rel="stylesheet" href="{{$PUBLIC_ASSETS}}/css/jquery.social-buttons.css">
	<script src="{{$PUBLIC_ASSETS}}/js/custom.js"></script> 
	<script src="{{$PUBLIC_ASSETS}}/js/search.js"></script>
	<script src="{{$PUBLIC_ASSETS}}/js/jquery.social-buttons.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script> 
	<style type="text/css">

		.sweet-alert {
			border: 2px solid #83ab33 !important;
  			box-shadow: 2px 2px 15px #999 !important;
		}

		.footerDrawer {
		  width: 100%;
		  position: fixed;
		  bottom: 59px;
		  z-index: 99;
		}

		.footerDrawer .open {
		  background-color: #83ab33;
		  text-align: center;
		  cursor: pointer;
		}

		.footerDrawer .content {
		  background-color: #cde69a;
		  display: none;
		  max-height: 40vh;
		  color: #214300;
		}


		.aboveDrawer {
		  width: 100%;
		  position: absolute;
		  /* top: 173px; */
		  z-index: 99;
		}

		.aboveDrawer .open {
		  background-color: #83ab33;
		  text-align: center;
		  cursor: pointer;
		}

		.aboveDrawer .content {
		  height: auto;
		  background-color: #cde69a;
		  display: none;
		  max-height: 40vh;
		  color: #214300;
		}

	</style>
	@stack('css')
</head>
<body>


	
	@include('user/header')


	@yield('data')



	@include('user/footer')


	@stack('js')
	<script type="text/javascript">
	var menuOpened = false;
	var navOpen = false;
	
	function myFunction() {
		if(!navOpen) {
		document.querySelector('#logo + .inner-tabs').style.height = '360px';
		document.querySelector('.topnav').classList.add ('responsive');
		navOpen = true;
		}
		else {
			document.querySelector('#logo + .inner-tabs').style.height = '0';
			document.querySelector('.topnav').classList.remove ('responsive');
			navOpen = false;
		}
 	}
 
	var aboveDrawerOpen = false;
	var footerDrawerOpen = false;
	$('.footerDrawer > div .triangle').on('click', function () {

		$('.footerDrawer .content').slideToggle(350, showstate);

		function showstate() {
			if ($(this).attr('style') === "display: none;") {
				$('.footerDrawer .open').show();

			} else {
				$('.footerDrawer .open').show();
			}
		}

		if (!footerDrawerOpen) {
			$(this).css({
				'transform': 'rotate(360deg)',
				'bottom': '-31px'
			});
			footerDrawerOpen = true;
		} else {
			$(this).css({
				'transform': 'rotate(180deg)',
				'bottom': '-7px'
			});
			footerDrawerOpen = false;
		}

		if ($('.aboveDrawer .content').css('display') === 'block') {
			$('.aboveDrawer .content').hide('350ms');
			$('.aboveDrawer .triangle').css({
				'transform': 'rotate(360deg)',
				'top': '-7px'
			});
			aboveDrawerOpen = false;
		}

		// hide main menu when clicked on triangle
		if($('.topnav').hasClass('responsive'))
		{
			$('.topnav').removeClass('responsive');
			$('#logo + .inner-tabs').css('height', '0');
			navOpen = false;
		}
	});

	
	$('.aboveDrawer .triangle').on('click', function () {

		$('.aboveDrawer .content').slideToggle(350, showstate);

		function showstate() {
			if ($(this).attr('style') === "display: none;") {
				$('.aboveDrawer .open').show();


			} else {
				$('.aboveDrawer .open').show();
			}
		}


		if (!aboveDrawerOpen) {
			$(this).css({
				'transform': 'rotate(180deg)',
				'top': '-31px'
			});
			aboveDrawerOpen = true;
		} else {
			$(this).css({
				'transform': 'rotate(360deg)',
				'top': '-7px'
			});
			aboveDrawerOpen = false;
		}
		if ($('.footerDrawer .content').css('display') === 'block') {
			$('.footerDrawer .content').hide('350ms');
			$('.footerDrawer .triangle').css({
				'transform': 'rotate(180deg)',
				'bottom': '-7px'
			});
			footerDrawerOpen = false;
		}
		
		// hide main menu when clicked on triangle
		if($('.topnav').hasClass('responsive'))
		{
			$('.topnav').removeClass('responsive');
			$('#logo + .inner-tabs').css('height', '0');
			navOpen = false;
		}
	});

	// close aboveDrawer content and footerDrawer content when main menu is opened
	$('.topnav a.icon').click(function(){
			if($('.topnav').hasClass('responsive')) {
				if(($('.aboveDrawer .content').css('display') === 'block')) {
					$('.aboveDrawer .content').hide('350ms');
					$('.aboveDrawer .triangle').css({
						'transform': 'rotate(360deg)',
						'top': '-7px'
					});
					aboveDrawerOpen = false;
				}

				if ($('.footerDrawer .content').css('display') === 'block') {
				$('.footerDrawer .content').hide('350ms');
				$('.footerDrawer .triangle').css({
					'transform': 'rotate(180deg)',
					'bottom': '-7px'
				});
				footerDrawerOpen = false;
			}
		}
	});

		$('.language').on('mouseenter', function(){
			$('section.quran_menu').css('margin-top', '40px');
		});
		$('.language').on('mouseleave', function(){
			$('section.quran_menu').css('margin-top', '0');
		});
	</script>

<script type="text/javascript">
	function googleTranslateElementInit() {
		new google.translate.TranslateElement({pageLanguage: 'no', includedLanguages: 'en,no', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false, multilanguagePage: true}, 'google_translate_element');
	}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script>
	function translateLanguage(lang, id) {
		$(id).closest('ul').find('li').removeClass("active");
		$(id).closest('li').addClass('active');
		if (lang === "English") {
				$.cookie("googtrans", '/no/en');
				$('.no').addClass('not-selected');
				$('.en').removeClass('not-selected');
				$('section.script_box a.container_btn1').css('left', '160px');

		} else {
				$.cookie("googtrans", '/en/no');
				$('.no').removeClass('not-selected');
				$('.en').addClass('not-selected');
				$('section.script_box a.container_btn1').css('left', '180px');

		}
		var $frame = $('.goog-te-menu-frame:first');
		if (!$frame.size()) {
				alert("Error: Could not find Google translate frame.");
				return false;
		}
		$frame.contents().find('.goog-te-menu2-item span.text:contains(' + lang + ')').get(0).click();
		return false;
	}
	</script>
</body>


</html>