</div> <!-- #wrapper -->

<footer id="footer">
	<ul class="nav pull-right">
		<li>
			Copyright &copy; 2014, Mantrackr.
		</li>
	</ul>
</footer>

<script type="text/javascript">
<!--

	var gSiteInfo = <?php echo $mantrackrObj; ?>

-->
</script>

<script src="<?php echo assets_url()?>/js/libs/jquery-1.9.1.min.js"></script>
<script src="<?php echo assets_url()?>/js/libs/jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?php echo assets_url()?>/js/libs/bootstrap.min.js"></script>

<?php foreach ($js_list as $js) :?>
<script src="<?php echo $js; ?>"></script>
<?php endforeach;?>
	
<script src="<?php echo assets_url()?>/js/App.js"></script>

<script src="<?php echo assets_url()?>/js/libs/angular/angular.min.js"></script>
<script src="<?php echo assets_url()?>/js/libs/angular/angular-route.js"></script>
<script src="<?php echo assets_url()?>/js/libs/angular/firebase.js"></script>
<script src="<?php echo assets_url()?>/js/libs/angular/angularfire.min.js"></script>
<script src="<?php echo assets_url()?>/js/libs/angular/angular-strap.min.js"></script>
<script src="<?php echo assets_url()?>/js/libs/angular/angular-strap.tpl.min.js"></script>

<script src="<?php echo assets_url()?>/js/libs/angular/application.js"></script> 
<script src="<?php echo assets_url()?>/js/libs/angular/controllers/root.js"></script>
<script src="<?php echo assets_url()?>/js/libs/angular/controllers/members.js"></script>
<script src="<?php echo assets_url()?>/js/libs/angular/controllers/member.js"></script>
<script src="<?php echo assets_url()?>/js/libs/angular/controllers/dashboard.js"></script>
<script src="<?php echo assets_url()?>/js/libs/angular/controllers/admanager.js"></script>
<script src="<?php echo assets_url()?>/js/libs/angular/controllers/pendingphotos.js"></script>

</body>
</html>