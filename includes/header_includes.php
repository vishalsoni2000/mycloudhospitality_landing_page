	<?php
	include ('includes/class.php'); 
	$dbf=new UBClass();
	$website_url_array=$dbf->fetchColumns($dbf->website_con,"website_setting","*","id='1'");
	$website_url=WEBSITE_URL;
	$website_admin_url=$website_url_array['website_admin_url'];
	require_once 'Mobile_Detect.php';
	$detect = new Mobile_Detect;
	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
	$scriptVersion = $detect->getScriptVersion();
	?>
	
	<link rel='stylesheet' href="<?=CDN_URL?>css/website_all_css.css" type='text/css'>
	<link rel="stylesheet" href="<?=CDN_URL?>style.min.css" type="text/css" />
	<link rel="stylesheet" href="<?=CDN_URL?>css/ubi_css.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900,100' rel='stylesheet' type='text/css'>
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

	<script type="text/javascript" src="<?=CDN_URL?>js/website_all_js.js"></script>
	<link rel="canonical" href="http://<?php echo($_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]);?>" />
	<!--Start of ANalytics-->
	<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/53e19d888a6482154c0005b8/default';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
	</script>
	<!--<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-53523550-1', 'auto');
	  ga('send', 'pageview');
	</script>
	<script>
    (function(w,d,t,u,n,a,m){w['MauticTrackingObject']=n;
        w[n]=w[n]||function(){(w[n].q=w[n].q||[]).push(arguments)},a=d.createElement(t),
        m=d.getElementsByTagName(t)[0];a.async=1;a.src=u;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://mycloud.mautic.net/mtc.js','mt');
    mt('send', 'pageview');
</script>
	-->
	<!--End of ANalytics--> 