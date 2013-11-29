<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?=$this->page_title?></title>
<link rel="shortcut icon" href="<?=SERVER_URL?>images/favicon/favicon.ico" />
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" media="all" href="css/iecrapmulticol.css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="css/layout.css">
<link rel="stylesheet" type="text/css" href="css/skin.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/listing.css">
<link rel="stylesheet" type="text/css" href="css/lightbox.css">
<link rel="stylesheet" type="text/css" href="css/formStyles.css">
<link rel="stylesheet" type="text/css" href="css/profilepage.css">
<link rel="stylesheet" type="text/css" href="css/slideshow.css">
<link rel="stylesheet" type="text/css" href="css/formStyles.css">
<link rel="stylesheet" type="text/css" href="css/carousel.css">
<link rel="stylesheet" type="text/css" href="css/navMain.css"><!--10052012 -->
<link href='http://fonts.googleapis.com/css?family=Nova+Round' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="webfonts/stylesheet.css">

<link rel="stylesheet" type="text/css" href="scripts/development-bundle/themes/base/jquery.ui.all.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery1.80.js"></script>
<script type="text/javascript" src="scripts/jquery.core.js"></script>
<script type="text/javascript" src="scripts/jquery.widget.js"></script>
<script type="text/javascript" src="scripts/jquery.tabs.js"></script>
<script type="text/javascript" src="scripts/jquery.cycle.all.js"></script>
<script type="text/javascript" src="scripts/jquery.validate.js"></script>
<script type="text/javascript" src="scripts/jcarousel/lib/jquery.jcarousel.js"></script><!--added 9-24-2012 -->
<script type="text/javascript" src="js/jcarousellite_1.0.1.pack.js"></script>
<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" media="all" href=css/iecrap.css" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" media="all" href="css/iecrap.css" />
<![endif]-->
<script type="text/javascript">

//<![CDATA[ 
$(window).load(function(){
	var lBoxHt = $(document).height();
	var lBoxWt = $(document).width();
	
	function mycarousel_initCallback(carousel)//added sept 24 2012
	{
		// Disable autoscrolling if the user clicks the prev or next button.
		carousel.buttonNext.bind('click', function() {
			carousel.startAuto(0);
		});
				
		jQuery('.jcarousel-scroll select').bind('change', function() {
			carousel.options.scroll = jQuery.jcarousel.intval(this.options[this.selectedIndex].value);
			return false;
		}); 
	
		carousel.buttonPrev.bind('click', function() {
			carousel.startAuto(0);
		});
	
		// Pause autoscrolling if the user moves with the cursor over the clip.
		carousel.clip.hover(function() {
			carousel.stopAuto();
		}, function() {
			carousel.startAuto();
		});
	};
	
	$('.backdrop').css("height",lBoxHt );
	
	$('.backdrop').click(function(){
		$(this).hide();
		//$('.liteBoxSignUp').hide();
		$('.liteBoxSteps').hide();
	});
	
	$('.closeButton').click(function(){
		$('.backdrop').hide();
		//$('.liteBoxSignUp').hide();
		$('.liteBoxSteps').hide();
	});
	
	$('#slideshow').cycle({
        fx:      'fade',
        timeout:  1500,
        prev:    '#prev',
        next:    '#next',
        pager:   '#nav',
        pagerAnchorBuilder: pagerFactory,
		
    });

    function pagerFactory(idx, slide) {
        var s = idx > 6 ? ' style=""' : '';
        return '<li'+s+'><a href="#">'+(idx+1)+'</a></li>';
    };
	
	jQuery('#mycarousel').jcarousel({//added sept 24, 2012
        auto: 4,//site the time interval for each bactch to scroll
        wrap: 'circular',
		visible: 3, // the number of list to show per batch
		initCallback: mycarousel_initCallback
    });
	
	//$('#navMain li ul:first li', '#navMain li ul:first li a').width($(this).innerWidth());
	
	//$('div:first', this).fadeIn().width($(this).innerWidth());
	//october 5
	$('#navMain li').hover(
		function () {
			$('div:first', this).css('visibility', 'visible').width($(this).innerWidth());
		}, 
		function () {
			$('div', this).css('visibility', 'hidden');		
		}
	);
	
	
});
//]]> 

$(document).ready(function(){
	$("#signUpForm").validate();
});
</script>
<script type="text/javascript">
$(function() {
		$( "#tabs" ).tabs();
	});
$(document).ready(function() {
	// validate signup form on keyup and submit
	var validator = $("#registerForm").validate({
		rules: {
			
			username: {
				required: true,
				minlength: 2/*,
				remote: "users.php"*/
			},
			password: {
				required: true,
				minlength: 5
			},
			password_confirm: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true/*,
				remote: "emails.php"*/
			},
			birthDate: "required",
			gender: "required"
		},
		messages: {
			
			username: {
				required: "请输入用户名",
				minlength: jQuery.format("请输入{5}到{12}位半角字母 （字母，数字，符号）不区分大小写")/*,
				remote: jQuery.format("{0} is already in use")*/
			},
			password: {
				required: "请输入登录密码",
				rangelength: jQuery.format("请输入{5}到{12}位半角字母 （字母，数字，符号）不区分大小写")
			},
			password_confirm: {
				required: "请确认登录密码",
				minlength: jQuery.format("请输入{5}到{12}位半角字母 （字母，数字，符号）不区分大小写"),
				equalTo: "您输入确认密码和密码不一致"
			},
			email: {
				required: "请填写有效邮箱地址",
				minlength: "请填写有效邮箱地址"/*,
				remote: jQuery.format("{0} is already in use")*/
			},
			dateformat: "Choose your preferred dateformat",
			gender: "please choose a gender"
		},
		// the errorPlacement has to take the table layout into account
		// specifying a submitHandler prevents the default submit, good for the demo
		submitHandler: function(form) {
			form.submit();						
		},
		// set this class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			//label.html("&nbsp;").addClass("checked");
		}
	});
	
	/*$(".currentactivity-scroller").jCarouselLite({
		vertical: true,
		hoverPause:true,
		visible: 3,
		auto:10000,
		speed:1000
	});*/
				
});
	
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php if(isset($_SESSION['id'])) { if(!isset($_GET['editprofile'])) { $this->unsetUserErrorData(); $this->unsetUserEntryData(); } } ?>
<?php if(!isset($_GET['register']) && !isset($_GET['registeruser'])) { $this->unsetUserErrorData(); $this->unsetUserEntryData(); } ?>
<body>
