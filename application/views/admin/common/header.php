<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" ng-app="mantrackrAdminApp" data-ng-controller="RootCtrl"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" ng-app="mantrackrAdminApp" data-ng-controller="RootCtrl"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" ng-app="mantrackrAdminApp" data-ng-controller="RootCtrl"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" ng-app="mantrackrAdminApp" data-ng-controller="RootCtrl"> <!--<![endif]-->
<head>
    <title><?php echo $page_title; ?> - Mantrackr Admin</title>
    
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="">
	<meta name="author" content="" />
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,800italic,400,600,800" type="text/css">

	<link rel="stylesheet" href="<?php echo assets_url()?>/css/font-awesome.min.css" type="text/css" />		
	<link rel="stylesheet" href="<?php echo assets_url()?>/css/bootstrap.min.css" type="text/css" />	
	<link rel="stylesheet" href="<?php echo assets_url()?>/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css" type="text/css" />
	
	<?php foreach ($css_list as $css) :?>
	<link rel="stylesheet" href="<?php echo $css;?>" type="text/css" />
	<?php endforeach;?>
	
	<link rel="stylesheet" href="<?php echo assets_url()?>/css/App.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo assets_url()?>/css/custom.css" type="text/css" />
	
	<style>
	[data-ng-cloak] {
	    display: none !important;
	}
	</style>
	
</head>

<body>

<div id="wrapper">

	<header id="header">

		<h1 id="site-logo">
			<a href="<?php echo site_url('/admin');?>">
				<img src="<?php echo assets_url()?>/img/logos/logo-mantrackr.png" alt="Mantrackr Admin Logo" />
			</a>
		</h1>	

		<a href="javascript:;" data-toggle="collapse" data-target=".top-bar-collapse" id="top-bar-toggle" class="navbar-toggle collapsed">
			<i class="fa fa-cog"></i>
		</a>

		<a href="javascript:;" data-toggle="collapse" data-target=".sidebar-collapse" id="sidebar-toggle" class="navbar-toggle collapsed">
			<i class="fa fa-reorder"></i>
		</a>

	</header> <!-- header -->


	<nav id="top-bar" class="collapse top-bar-collapse">

		<ul class="nav navbar-nav pull-left">
			<li class="">
				<a href="<?php echo site_url('/admin');?>">
					<i class="fa fa-home"></i> 
					Home
				</a>
			</li>
		</ul>

		<ul class="nav navbar-nav pull-right">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
					<i class="fa fa-user"></i>
		        	<?php echo $session['user_name']?>
		        	<span class="caret"></span>
		    	</a>

		    	<ul class="dropdown-menu" role="menu">
			        <li>
			        	<a href="<?php echo site_url('/admin/logout');?>">
			        		<i class="fa fa-sign-out"></i> 
			        		&nbsp;&nbsp;Logout
			        	</a>
			        </li>
		    	</ul>
		    </li>
		</ul>

	</nav> <!-- /#top-bar -->


	<div id="sidebar-wrapper" class="collapse sidebar-collapse">
	
		<div id="search">
			<form action="<?php echo site_url("/admin/members")?>" method="GET">
				<input class="form-control input-sm" type="text" name="s" placeholder="Search member..." />

				<button type="submit" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
			</form>		
		</div> <!-- #search -->
	
		<nav id="sidebar">		
			
			<ul id="main-nav" class="open-active">			

				<li class="<?php if ($current_action == 'admin_dashboard') echo "active";?>">				
					<a href="<?php echo site_url('/admin/dashboard');?>">
						<i class="fa fa-dashboard"></i>
						Dashboard
					</a>				
				</li>
				
				<li class="<?php if ($current_action == 'admin_members') echo "active";?>">				
					<a href="<?php echo site_url('/admin/members');?>">
						<i class="fa fa-user"></i>
						Members
					</a>				
				</li>
				
				
				<li class="<?php if ($current_action == 'admin_pendingPhotos') echo "active";?>">				
					<a href="<?php echo site_url('/admin/pendingPhotos');?>">
						<i class="fa fa-camera"></i>
						Pending Photos
						<?php if ($pendingPhotosNum > 0):?>
						&nbsp;&nbsp;<span class="badge badge-primary"><?php echo $pendingPhotosNum;?></span>
						<?php endif;?>
					</a>				
				</li>
				
				
				<li class="<?php if ($current_action == 'admin_flaggedMembers') echo "active";?>">				
					<a href="<?php echo site_url('/admin/flaggedMembers');?>">
						<i class="fa fa-flag"></i>
						Flagged Members
						<?php if ($flaggedMembersNum > 0):?>
						&nbsp;&nbsp;<span class="badge badge-primary"><?php echo $flaggedMembersNum;?></span>
						<?php endif;?>
					</a>				
				</li>
				
				<li class="dropdown">
					<a href="javascript:;">
						<i class="fa fa-arrow-circle-o-down"></i>
						Export Email Lists
						<span class="caret"></span>
					</a>
					
					<ul class="sub-nav">
						<li>				
							<a href="<?php echo site_url('/admin/exportPremiumMembers');?>">
								<i class="fa fa-arrow-circle-o-down"></i>
								Premium
							</a>				
						</li>
						<li>				
							<a href="<?php echo site_url('/admin/exportFreemiumMembers');?>">
								<i class="fa fa-arrow-circle-o-down"></i>
								Freemium
							</a>				
						</li>
						<li>				
							<a href="<?php echo site_url('/admin/exportInactiveMembers');?>">
								<i class="fa fa-arrow-circle-o-down"></i>
								Inactive
							</a>				
						</li>
						<li>				
							<a href="<?php echo site_url('/admin/exportCanceledMembers');?>">
								<i class="fa fa-arrow-circle-o-down"></i>
								Canceled Members
							</a>				
						</li>
						<li>				
							<a href="<?php echo site_url('/admin/exportPremiumExpMembers');?>">
								<i class="fa fa-arrow-circle-o-down"></i>
								Premium Expirations
							</a>				
						</li>
						<li>				
							<a href="<?php echo site_url('/admin/exportPremiumCancelMembers');?>">
								<i class="fa fa-arrow-circle-o-down"></i>
								Premium Cancelations
							</a>				
						</li>
					</ul>	
									
				</li>
				
				<li class="<?php if ($current_action == 'admin_mailboard') echo "active";?>">				
					<a href="<?php echo site_url('/admin/mailboard');?>">
						<i class="fa fa-envelope"></i>
						Emails to Members
					</a>				
				</li>
				
				<li class="<?php if ($current_action == 'admin_adalertManage') echo "active";?>">				
					<a href="<?php echo site_url('/admin/adalertManage');?>">
						<i class="fa fa-bullhorn"></i>
						Manage Ads/Alerts
					</a>				
				</li>
				
				<li class="<?php if ($current_action == 'admin_visitorStats') echo "active";?>">				
					<a href="<?php echo site_url('/admin/visitorStats');?>">
						<i class="fa fa-bar-chart-o"></i>
						Visitor Stats
					</a>				
				</li>
			</ul>
					
		</nav> <!-- #sidebar -->

	</div> <!-- /#sidebar-wrapper -->