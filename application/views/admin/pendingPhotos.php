<?php include('common/header.php')?>

<div id="content" data-ng-controller="PendingPhotoMembersCtrl">


	<div id="content-header">
			<h1>Pending Photos</h1>
	</div> <!-- #content-header -->	

	<div id="content-container">
	
		<?php include ('common/message_list.php');?>
		
		<div class="row">
		
			<div class="col-md-12">
			
				<ul id="pendingPhotosTab" class="nav nav-tabs">
					<li class="active">
						<a href="#photoModeration" data-toggle="tab">Photo Moderation</a>
					</li>
					<li>
						<a href="#photoDeclineEmail" data-toggle="tab">Photo Decline EmailText</a>
					</li>
				</ul>
				
				
				<div id="pendingPhotosTabContent" class="tab-content">
					<div class="tab-pane fade in active" id="photoModeration">
					
						<!-- <div class="row">
							<div class="col-md-12">
								<div class="btn-group">
								  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
									All&nbsp;&nbsp;<span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" role="menu">
						            <li><a href="javascript:;">All</a></li>
						            <li><a href="javascript:;">New Members</a></li>
						            <li><a href="javascript:;">Existing Members</a></li>
						            <li class="divider"></li>
						            <li><a href="javascript:;">Undo Last Action</a></li>
						          </ul>
								</div>
							</div>
							<hr/>
						</div> -->
						
						<?php $count = 0; $new_row_ended = true;?>
						
						<?php foreach($members as $member) :?>
						
							<?php if ($count % 4 == 0) {?>
							
							<?php if (!$new_row_ended) {echo '</div>'; $new_row_ended = true; }?>
							
							<div class="row">
							
							<?php 
														
							}?>
															
							<?php if ($member['path'] != '') $image_path = $upload_url . $member['path'];
								   else $image_path = assets_url('/img/avatars/noimage.jpg');?>
								   
							
							<div class="col-md-3 col-sm-6">
			
								<div class="thumbnail">
									<div class="thumbnail-view">
										<a href="<?php echo $image_path;?>" class="thumbnail-view-hover ui-lightbox"></a>
							            <img src="<?php echo $image_path?>" style="width: 100%" alt="Member Primary Photo">
							        </div>
						            <div class="caption">
						              <div class="pull-left">
						              	<a href="javascript:declinePendingPhoto('<?php echo $member['id'];?>');" class="btn btn-primary btn-sm btn-sm" >No</a> 
						              	<a href="javascript:approvePendingPhoto('<?php echo $member['id'];?>');" class="btn btn-info btn-sm btn-sm">Yes</a>
						              </div>
						              
						              <div class="pull-right">
										<div class="btn-group">
										  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
										    <i class="fa fa-cog"></i> &nbsp;&nbsp;<span class="caret"></span>
										  </button>
										  <ul class="dropdown-menu pull-right" role="menu">
										    <li><a href="javascript:downloadPhoto('<?php echo $member['primary_photo_id']?>');">Download Photo</a></li>
										    <li><a href="javascript:openReplaceDialog('<?php echo $image_path;?>', '<?php echo $member['primary_photo_id'];?>', '<?php echo $member['id'];?>')">Replace Photo</a></li>
										    <li><a href="javascript:deleteMemberFromPendingPhoto('<?php echo $member['id']?>');">Delete Member</a></li>
										  </ul>
										</div>
									 </div>
									 
									 <div class="clearfix"></div>
						            </div>
						            
						            <div class="thumbnail-footer">
						            	<div class="pull-left">
							            	<a href="<?php echo site_url('/admin/member?memberId=') . $member['id'];?>" class="pendingphoto-member-link"><?php echo get_user_name($member['name'], $member['email']);?></a>
							            </div>
			
							            <div class="pull-right">
							            	<a href="javascript:;"><i class="fa fa-clock-o"></i>&nbsp; <?php echo $member['created_time_ago'];?></a>
							            </div>
						            </div>
						          </div>		
	
							</div>
						
							<?php $count++; $new_row_ended = false;?>
							
						<?php endforeach;?>
						
						<?php if (!$new_row_ended) echo '</div>'?>		
			
					</div>

					<div class="tab-pane fade" id="photoDeclineEmail">
					
						<div class="row">
						
							<div class="col-md-12">
							
								<div class="form-group">
									<label for="text-input">Subject</label>
									<input type="text" id="mail_subject"  name="mail_subject" class="form-control">
								</div>
							
								<div class="form-group">
									<label for="textarea-input">Message</label>
									<textarea name="textarea-input" id="mail_content"  name="mail_content" rows="15" class="form-control"></textarea>
								</div>
								
								<div class="form-group">
									<button type="button" class="btn btn-tertiary">Save</button>
									<button type="button" class="btn btn-tertiary">Cancel</button>
								</div>
							</div>
						
						</div>
						
					</div>

				</div>
			
			</div>
		
		</div>
	
	</div>
	
</div>

<div id="replacePhotoModal" class="modal fade">
  <div class="modal-dialog">
  
   <form enctype="multipart/form-data" method="POST" action="<?php echo site_url('/admin/replacePhoto')?>" class="form">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Photo Replace</h3>
      </div>
      <div class="modal-body">
      	
      	<div class="row">
	      	<div class="col-sm-12" style="text-align: center">
		      	
		      				      		
		      		<div class="fileupload fileupload-exists" data-provides="fileupload">
					  <div class="fileupload-new thumbnail" style="width: 300px; height: 200px;"><img src="<?php echo assets_url('/img/no_image.gif');?>" alt="Placeholder"></div>
					  <div class="fileupload-preview fileupload-exists thumbnail" style="width: 300px; height: 200px; line-height: 10px;">
					  	<img src="" alt="Placeholder" id="currentPhotoThumb">
					  </div>
					  <div>
					  	<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="replaceFile" id="replaceFile"></span>
					  	<input type="hidden" name="replacePhotoId" id="replacePhotoId" value=""/>
					  	<input type="hidden" name="replaceMemberId" id="replaceMemberId" value=""/>
					  </div>
					</div>
		      	
		      	
	      	</div>
      	</div>
      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
    
    </form>
    
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include('common/footer.php')?>