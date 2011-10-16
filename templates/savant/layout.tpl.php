<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php $this->eprint($this->window_title); ?></title>
	
	<!-- load some css styles -->
	<link rel="stylesheet" href="<?php echo $this->base_url; ?>styles/reset.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="<?php echo $this->base_url; ?>styles/style.css" type="text/css" media="screen" charset="utf-8" />
	
	<!-- load the javascripts -->
	<script type="text/javascript" src="<?php echo $this->base_url; ?>scripts/lib/jquery-1.6.4.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->base_url; ?>scripts/lib/ejs.js"></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"> </script>
	
	<?php if($this->page_content == "dashboard"): ?>
	<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js"></script> 
	<script type="text/javascript" src="<?php echo $this->base_url; ?>scripts/crowded.js"></script>
	<?php endif; ?>
	
	<?php if($this->page_content == "venue"): ?>
	<script type="text/javascript" src="<?php echo $this->base_url; ?>scripts/venue.js"></script>
	<?php endif; ?>
	
	<script type="text/javascript">
	  (function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'https://apis.google.com/js/plusone.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>
	
	<!-- some snippet stuff -->
	<link rel="image_src" href="<?php echo $this->base_url ?>images/thumb.png" />
	<meta itemprop="name" content="Crowded">
	<meta itemprop="description" 
		content="Crowded is a silly little website that tries to find crowded places. 
		It checks for Foursquare checkins and display it on the map in groups. This 
		way you know where are the places with most checkins.">
	<meta itemprop="image" content="<?php echo $this->base_url ?>images/thumb.png">
	
</head>
<body>
	<!-- header container start -->
	<div id="headerContainer">
		<div class="pageContainer">
			<span class="logo"></span>
		</div>
	</div><!-- header container ends -->
	
	<!-- body container start -->
	<div id="bodyContainer">
		<div class="pageContainer">
			
			<?php $this->display($this->dir . $this->page_content .".tpl.php"); ?>
			
		</div>
	</div><!-- body container ends -->
	
	<!-- footer container start -->
	<div id="footerContainer">
		<div class="pageContainer">
		</div>
	</div><!-- footer container ends -->
</body>
</html>