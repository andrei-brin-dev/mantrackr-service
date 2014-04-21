		<div id="content-container">
			
			<?php include ('message_list.php');?>

			<div class="row">

				<div class="col-md-9">

					<div class="row">

						<div class="col-md-4 col-sm-5">

							<div class="thumbnail">
							
							<?php if ($member->getPrimaryPhotoApproved()) : ?>
								<?php if ($member_images[$member->getPrimaryPhotoId()]['path'] != '') :?>
								<img src="<?php echo $upload_url . $member_images[$member->getPrimaryPhotoId()]['path']; ?>" alt="Profile Picture" />
								<?php else:?>
								<img src="<?php echo assets_url('/img/avatars/noimage.jpg'); ?>" alt="Profile Picture" />
								<?php endif; ?>
							<?php else:?>
								<img src="<?php echo assets_url('/img/avatars/pendingPhoto.png'); ?>" alt="Profile Picture" />
							<?php endif;?>
								
							</div> <!-- /.thumbnail -->

							<br />
							
							
							<div class="well">
								<?php if (count($member_flags) > 0) :?>
								<h4>Flag History</h4>
								<?php else:?>
								<h4>Flag By Admin</h4>
								<?php endif;?>
								
								<?php foreach ($member_flags as $flag) :?>
								<ul class="icons-list text-md">
			
									<li>
										<i class="icon-li fa fa-flag icon-red"></i>
			
										<strong>by <?php echo get_user_name($flag['name'], $flag['email']);?> - <?php echo date("m/d/y", strtotime($flag['flagged_date'])); ?></strong>
										<br />
										<small><i class="fa fa-gavel"></i>&nbsp;&nbsp;<?php echo $flag['flag_reason'];?></small>
									</li>
			
								</ul>
								
								<?php endforeach;?>
								
								<?php if (count($member_flags) > 0) :?>
								<button type="button" class="btn btn-default btn-block margin-bottom-20px">Clear Flag(s)</button>
								<?php endif;?>
								<button type="button" class="btn btn-tertiary btn-block margin-bottom-20px">Send Warning</button>
								<button type="button" class="btn btn-warning btn-block">Send Warning & Suspend</button>
								
							</div>
							
							
						</div> <!-- /.col -->


						<div class="col-md-8 col-sm-7">

							<h2><?php echo get_user_name($member->getName(), $member->getEmail());?></h2>

							<h4><i>Member since <?php echo date("m/d/y", strtotime($member->getCreatedDate()));?></i></h4>

							
							<ul class="icons-list">
								<li><i class="icon-li fa fa-envelope"></i>&nbsp;<?php echo $member->getEmail();?></li>
								<li><i class="icon-li fa fa-map-marker"></i>&nbsp;<?php echo $member->getLocation();?></li>
							</ul>

							
							<p>
								<a href="javascript:;" class="btn btn-tertiary">Pend Primary Photo</a>
								&nbsp;&nbsp;
								<a href="javascript:;" class="btn btn-warning">Delete Member</a>
							</p>
							
							<hr />
							
							
							<div class="row">
								
								<div class="col-md-6 col-sm-6">
								
									<div class="portlet">

										<div class="portlet-header">
				
											<h5>PUBLIC PHOTOS</h5>
				
										</div> <!-- /.portlet-header -->
				
										<div class="portlet-content">
										
										<?php foreach($member_images as $image) :?>
										
										<?php if ($image['is_public'] == 1) :?>
										
										<div class="member-public-photo-container">
											<div class="thumbnail">
					                        	<div class="thumbnail-view">
													<a href="<?php echo $upload_url . $image['path']?>" class="thumbnail-view-hover ui-lightbox"></a>
										            <img src="<?php echo $upload_url . $image['path']?>" alt="Member Public Photo">
										        </div>
										    </div>
										</div>
										
										<?php endif;?>
										
										<?php endforeach;?>
										
										
										</div> <!-- /.portlet-content -->
				
									</div>
									
								</div>
								
								<div class="col-md-6 col-sm-6">
								
								
									<div class="portlet">

										<div class="portlet-header">
				
											<h5>PRIVATE PHOTOS</h5>
				
										</div> <!-- /.portlet-header -->
				
										<div class="portlet-content">
				
										<?php foreach($member_images as $image) :?>
										
										<?php if ($image['is_public'] == 0) :?>
										
										<div class="member-private-photo-container">
											<div class="thumbnail">
					                        	<div class="thumbnail-view">
													<a href="<?php echo $upload_url . $image['path']?>" class="thumbnail-view-hover ui-lightbox"></a>
										            <img src="<?php echo $upload_url . $image['path']?>" alt="Member Private Photo">
										        </div>
										    </div>
										</div>
										
										<?php endif;?>
										
										<?php endforeach;?>
										
										</div> <!-- /.portlet-content -->
				
									</div>
									
								</div>
							
							</div>							
							
							
							
							<hr />

							<br />

							<h3 class="heading">Profile Info</h3>
														
							<h4>
								<span class="inline_text_container"><?php echo $member->getAgeString()?></span>
								<span class="inline_text_container"><?php echo $member->getHeightString()?></span>
								<span class="inline_text_container"><?php echo $member->getWeightString()?></span>
								<span class="inline_text_container last_child"><?php echo $member->getHeadline()?></span>
							</h4>
							<br/>
							<dl class="info_block_list">
								<dt>Partnered, open to</dt>
								<dd><?php echo $member->getOpenedto();?></dd>
								<dt>Looking for</dt>
								<dd><?php echo $member->getLookingfor();?></dd>
								<dt>About me</dt>
								<dd><?php echo $member->getDescription();?></dd>
								<dt>My interests</dt>
								<dd><?php echo $member->getInterests();?></dd>
							</dl>
							
							<br/>
							
							<h3 class="heading">Search Messages</h3>
							
							<input class="form-control input-sm" type="text" name="search" placeholder="Search...">
							
						</div>

					</div>

				</div>


				<div class="col-md-3 col-sm-6 col-sidebar-right">

				
					<div class="well">
						<h4>Premium History</h4>
						
						<?php if (count($member_premium_purchase_history) == 0) :?>
							<p class="text-muted">No premium history</p>
						<?php else:?>
							
							<ul class="icons-list text-md">
							
							<?php foreach($member_premium_purchase_history as $history) :?>
								<li>
									<i class="icon-li fa fa-location-arrow"></i>
		
									Purchased Premium <?php echo date("m/d/y", strtotime($history['purchase_date']))?>
									<br>
									<strong><?php echo $history['duration']?> Months</strong>
									<?php if ($history['id'] == $member->getActivePremiumPurchaseId()):?>
									&nbsp;&nbsp;<strong class="txt-orange">Active</strong>
									<?php endif;?>
									<?php if ($history['is_expired']):?>
									<br/>Expired&nbsp;&nbsp;<?php echo date("m/d/y", strtotime($history['expiry_date']));?>
									<?php endif;?>
								</li>
							<?php endforeach;?>
							
							</ul>
									
						<?php endif;?>
						
						
						<?php if ($member->getIsPremium()) :?>
						
						<?php else:?>
						<div class="btn-group">
							  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
								<i class="fa fa-clock-o"></i>  &nbsp;
							    {{premiumDurationText}} <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
					            <li><a href="javascript:;" data-ng-click="premiumType = 1" >1 Month</a></li>
					            <li><a href="javascript:;" data-ng-click="premiumType = 2">3 Months</a></li>
					            <li><a href="javascript:;" data-ng-click="premiumType = 3">6 Months</a></li>
					            <li><a href="javascript:;" data-ng-click="premiumType = 4">1 Year</a></li>
					          </ul>
						</div>
						
						<form action="<?php echo site_url("/admin/upgradeMemberPremium")?>" method="POST">
							<input type="hidden" name="memberId" value="<?php echo $member->getId()?>" />
							<input type="hidden" name="premiumTypeId" value="{{premiumType}}" />
							<button type="button" class="btn btn-tertiary btn-block margin-bottom-20px margin-top-10px" onclick="upgradePremiumMembership(this.form);">Upgrade / Extend Premium</button>
						</form>
						<?php endif;?>
						
					</div>
				
					<br/>
					
					<div class="well">
						<h4>Standout Strip History</h4>
	
						<?php if (count($member_standout_purchase_history) == 0) :?>
							<p class="text-muted">No standout strip history</p>
						<?php else:?>
						
							<ul class="icons-list text-md">
							
							<?php foreach($member_standout_purchase_history as $history) :?>
								<li>
									<i class="icon-li fa fa-location-arrow"></i>
		
									Purchased SOS <?php echo date("m/d/y", strtotime($history['purchase_date']))?>
									<br>
									<strong><?php echo $history['duration']?> Days</strong>
									<?php if ($history['id'] == $member->getActiveStandoutPurchaseId()):?>
									&nbsp;&nbsp;<strong class="txt-orange">Active</strong>
									<?php endif;?>
									<?php if ($history['is_expired']):?>
									<br/>Expired&nbsp;&nbsp;<?php echo date("m/d/y", strtotime($history['expiry_date']));?>
									<?php endif;?>
								</li>
							<?php endforeach;?>
							
							</ul>
						
						<?php endif;?>
						
						<?php if ($member->getIsStandout()) :?>
						
						<?php else:?>
						<div class="btn-group">
							  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
								<i class="fa fa-clock-o"></i>  &nbsp;
							    {{standoutDurationText}} <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
					            <li><a href="javascript:;" data-ng-click="standoutType = 1">2 Days</a></li>
					            <li><a href="javascript:;" data-ng-click="standoutType = 2">4 Days</a></li>
					            <li><a href="javascript:;" data-ng-click="standoutType = 3">1 Week</a></li>
					          </ul>
						</div>
						
						<form action="<?php echo site_url("/admin/upgradeMemberStandoutStrip")?>" method="POST">
							<input type="hidden" name="memberId" value="<?php echo $member->getId()?>" />
							<input type="hidden" name="standoutTypeId" value="{{standoutType}}" />
							<button type="button" class="btn btn-tertiary btn-block margin-bottom-20px margin-top-10px" onclick="upgradeStandoutStrip(this.form);">Upgrade / Extend SOS</button>
						</form>
						<?php endif;?>
						
					</div>
					
					<br/>
					
					<div class="list-group">  

						<a href="javascript:;" class="list-group-item">
				          <h4 class="list-group-item-heading">0</h4>
				          <p class="list-group-item-text">Gifts Sent</p>
				          
				        </a>

						<a href="javascript:;" class="list-group-item">
				          <h4 class="list-group-item-heading">0 / 0</h4>
				          <p class="list-group-item-text">Messages Sent / Received</p>

				        </a>

						<a href="javascript:;" class="list-group-item">
				          <h4 class="list-group-item-heading">0</h4>
				          <p class="list-group-item-text">Mutual Attractions</p>

				        </a>
					</div> <!-- /.list-group -->

			
			</div>


			</div> <!-- /.row -->



		</div> <!-- /#content-container -->