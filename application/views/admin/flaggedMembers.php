<?php include('common/header.php')?>


	<div id="content">		
		
		<div id="content-header">
			<h1>Flagged Members</h1>
			
			<div class="top_rows_navigator_container">
				<?php if ($prev_exists):?>
				<span class="prev"><a href="<?php echo site_url('/admin/flaggedMembers?num=' . ($num - 1));?>"><i class="fa fa-arrow-circle-o-left"></i></a></span>
				<?php endif;?>
				<span><?php echo $num?>/<?php echo $flaggedMembersNum;?></span>
				<?php if ($next_exists):?>
				<span class="next"><a href="<?php echo site_url('/admin/flaggedMembers?num=' . ($num + 1));?>"><i class="fa fa-arrow-circle-o-right"></i></a></span>
				<?php endif;?>
			</div>
			
		</div> <!-- #content-header -->	

		<?php if ($no_member) :?>
		
		<div id="content-container">
			<p class="text_muted">No flagged member found.</p>
		</div>
		
		<?php else:?>
		
		<?php  include('common/member_profile.php')?>	
			
		<?php endif;?>
	</div> <!-- #content -->
	
	

<?php include('common/footer.php')?>

