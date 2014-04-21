<?php foreach ($messages as $msg):?>
	<?php
		if ($msg['msg_type'] == 0){
			$css = 'alert-success';
		} 
		else if ($msg['msg_type'] == 1){
			$css = 'alert-warning';
		}
		else if ($msg['msg_type'] == 2){
			$css = 'alert-danger';
		}
		else if ($msg['msg_type'] == 3){
			$css = 'alert-info';
		}
	?>
	<div class="alert <?php echo $css;?>">
		<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
		<?php if ($msg['head'] != ''):?>
		<strong><?php echo $msg['head'];?>.&nbsp;</strong>
		<?php endif;?>
		<?php echo $msg['msg_content']?>
	</div>
			
<?php endforeach;?>