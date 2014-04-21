<?php include('common/header.php')?>

<div id="content" data-ng-controller="AdManagerCtrl">		
		
		<div id="content-header">
			<h1>Manage Ads/Alerts</h1>
		</div> <!-- #content-header -->	
		
		<div id="content-container">
		
			<?php include ('common/message_list.php');?>
			
			<div id="newAd-container">
				
				<form enctype="multipart/form-data" method="POST" action="<?php echo site_url('/admin/saveAd')?>" class="form parsley-form" data-validate="parsley">
				
				<h3 class="section-header">New Ad/Alert:</h3>
				
				<div class="row">
					<div class="col-sm-8">
						<div class="form-group">
							<input type="text" name="ad_title" class="form-control" placeholder="Title of Ad/Alert" data-required="true">
							<input type="hidden" name="ad_id" value="0" />
						</div>
						<div class="form-group">
							<label for="newAd_body">Ad/Alert content</label>
							<textarea name="ad_content" cols="10" rows="3" class="form-control" data-required="true"></textarea>
						</div>
					</div>
					<div class="col-sm-4">&nbsp;</div>
				</div>
				
				<div class="row">
					<div class="col-sm-2">
						<label>Top header image</label>
						<div class="fileupload fileupload-new" data-provides="fileupload">
						  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo assets_url('/img/no_image.gif');?>" alt="Placeholder"></div>
						  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
						  <div>
						    <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="ad_topImage"></span>
						    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
						  </div>
						</div>
						
					</div>
					<div class="col-sm-8">
					
						<div class="row">
							
							<div class="form-inline col-sm-12">
							
								<div class="form-group margin-right-20px">
									<input id="ad_startdate_0" name="ad_startdate" class="form-control date-picker" data-dpicker-type="startdate" type="text" placeholder="Start date">
									<span class="help-block">mm/dd/yyyy</span>
								</div>
							
								<div class="form-group margin-right-20px">
									<input id="ad_enddate_0" name="ad_enddate" class="form-control date-picker" type="text" placeholder="End date">
									<span class="help-block">mm/dd/yyyy</span>
								</div>
								
								<div class="form-group margin-right-20px inline-form-vertical-top">
									<label class="checkbox-inline">
								  		<input type="checkbox" data-chk-type="noenddate" id="noenddate_chk_0" name="noenddate_chk" value="1"> No end date
									</label>
								</div>
								
								<div class="form-group inline-form-vertical-top">
								
									<select name="ad_membergroup_id" class="form-control">
									<?php foreach($membergroup_list as $member_group):?>
										<option value="<?php echo $member_group['id'];?>"><?php echo $member_group['group_name'];?></option>
									<?php endforeach;?>
									</select>
								
								</div>
								
							</div>
							
						</div>
						
						<div class="row">
						
							<div class="form-group col-sm-12">
								
								<label class="checkbox-inline">
									<input type="checkbox" name="show_on_startup_chk" value="1"> App start-up
								</label>
								
								<label class="checkbox-inline">
									<input type="checkbox" name="show_on_afterblock_chk" value="1"> After blocking
								</label>
								
								<label class="checkbox-inline">
									<input type="checkbox" name="show_on_betweenpages_chk" value="1"> Between page swipes
								</label>
								
								<label class="checkbox-inline">
									<input type="checkbox" name="show_on_afterlogout_chk" value="1"> After Logout
								</label>
								
								<label class="checkbox-inline">
									<input type="checkbox" name="show_on_afterclosingprofile_chk" value="1"> After closing 10th profile
								</label>
								
								<label class="checkbox-inline">
									<input type="checkbox" name="show_on_firstlogin_chk" value="1"> Very first login before grid
								</label>
								
							</div>
						
						</div>
						
						
						<div class="row">
							
							<div class="form-horizontal col-sm-12">
								<div class="form-group">
									<label class="col-md-2">Top Button</label>
									<div class="col-md-5">
									  <input type="text" class="form-control" placeholder="Top button label" name="ad_topbutton_label" data-required="true">
									</div>
									<div class="col-md-2">
										<label>Top Button action:</label>
									</div>
									<div class="col-md-3">
									  	<select name="ad_topbutton_pageid" class="form-control">
										<?php foreach($page_list as $page):?>
											<option value="<?php echo $page['id'];?>"><?php echo $page['title'];?></option>
										<?php endforeach;?>
										</select>
										
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-2">Bottom Button</label>
									<div class="col-md-5">
									  <input type="text" class="form-control" placeholder="Bottom button label" name="ad_bottombutton_label" data-required="true">
									</div>
									<div class="col-md-5">&nbsp;</div>
								</div>
		
							</div>
														
						</div>
						
						<div class="row">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-success">Add to App</button>
								<button type="button" class="btn btn-tertiary" onclick="this.form.reset();">Cancel</button>
							</div>
						</div>
						
					</div>	
					
					<div class="col-sm-2">
						<label>Background image</label>
						<div class="fileupload fileupload-new" data-provides="fileupload">
						  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo assets_url('/img/no_image.gif');?>" alt="Placeholder"></div>
						  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
						  <div>
						    <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="ad_backImage"></span>
						    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
						  </div>
						</div>
						
					</div>
							
				</div>
				
				</form>
			</div>
			
			<hr/>
			
			<div id="activeAds-container">
				
				<h3 class="section-header">Active Ad/Alerts:</h3>
				
				<?php $active_ad_count = 0; ?>
				
				<?php foreach ($ad_list as $ad) :?>
				
				<?php if ($ad['is_active'] == 0) continue;?>	
				
				<div class="portlet">
				
					<div class="portlet-header">
						<h3><?php echo $ad['title']?>&nbsp;&nbsp;<span class="text-muted">(<?php echo $ad['group_name']?>)</span></h3>
						<div class="portlet-tools pull-right">
							<a href="javascript::" class="portlet-collapse-toggle-link" data-toggle="collapse" data-target="#ad_content_panel_<?php echo $ad['id'];?>"><i class="fa fa-plus-square" id="ad_content_toggle_link_<?php echo $ad['id'];?>"></i></a>
						</div>
							
					</div>
				
					<div class="portlet-content collapse" data-portlet-collapse="true" id="ad_content_panel_<?php echo $ad['id'];?>">
					
						<form enctype="multipart/form-data" method="POST" action="<?php echo site_url('/admin/saveAd')?>" class="form parsley-form" data-validate="parsley">

						<div class="row">
							<div class="col-sm-8">
								<div class="form-group">
									<input type="hidden" name="ad_title" value="<?php echo $ad['title'];?>"/>
									<input type="hidden" name="ad_id" value="<?php echo $ad['id'];?>" />
								</div>
								<div class="form-group">
									<label for="newAd_body">Ad/Alert content</label>
									<textarea name="ad_content" cols="10" rows="3" class="form-control" data-required="true"><?php echo $ad['content'];?></textarea>
								</div>
							</div>
							<div class="col-sm-4">&nbsp;</div>
						</div>
						
						<div class="row">
							<div class="col-sm-2">
								<label>Top header image</label>
								<?php if ($ad['topimage'] == ''):?>
								<div class="fileupload fileupload-new" data-provides="fileupload">
								  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo assets_url('/img/no_image.gif');?>" alt="Placeholder"></div>
								  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
								  <div>
								    <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="ad_topImage"></span>
								    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
								  </div>
								</div>
								<?php else:?>
								<div class="fileupload fileupload-exists" data-provides="fileupload">
								  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo assets_url('/img/no_image.gif');?>" alt="Placeholder"></div>
								  <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 10px;">
								  	<img src="<?php echo $ad_upload_url . $ad['topimage'];?>" alt="Placeholder">
								  </div>
								  <div>
								    <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="ad_topImage"></span>
								    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
								  </div>
								</div>
								<?php endif;?>
								
							</div>
							<div class="col-sm-8">
							
								<div class="row">
									
									<div class="form-inline col-sm-12">
									
										<div class="form-group margin-right-20px">
											<input id="ad_startdate_<?php echo $ad['id'];?>" name="ad_startdate" value="<?php echo $ad['startdate'];?>" class="form-control date-picker" data-dpicker-type="startdate" type="text" placeholder="Start date">
											<span class="help-block">mm/dd/yyyy</span>
										</div>
									
										<div class="form-group margin-right-20px">
											<input id="ad_enddate_<?php echo $ad['id'];?>" name="ad_enddate" value="<?php echo $ad['enddate'];?>" class="form-control date-picker" type="text" placeholder="End date">
											<span class="help-block">mm/dd/yyyy</span>
										</div>
										
										<div class="form-group margin-right-20px inline-form-vertical-top">
											<label class="checkbox-inline">
										  		<input type="checkbox" data-chk-type="noenddate" id="noenddate_chk_<?php echo $ad['id'];?>" name="noenddate_chk" value="1" <?php if ($ad['noenddate']) echo 'checked';?>> No end date
											</label>
										</div>
										
										<div class="form-group inline-form-vertical-top">
										
											<select name="ad_membergroup_id" class="form-control">
											<?php foreach($membergroup_list as $member_group):?>
												<option value="<?php echo $member_group['id'];?>" <?php if ($member_group['id'] == $ad['membergroup_id']) echo 'selected';?>><?php echo $member_group['group_name'];?></option>
											<?php endforeach;?>
											</select>
										
										</div>
										
									</div>
									
								</div>
								
								<div class="row">
								
									<div class="form-group col-sm-12">
										
										<label class="checkbox-inline">
											<input type="checkbox" name="show_on_startup_chk" value="1" <?php if ($ad['show_on_startup']) echo 'checked';?>> App start-up
										</label>
										
										<label class="checkbox-inline">
											<input type="checkbox" name="show_on_afterblock_chk" value="1" <?php if ($ad['show_on_afterblock']) echo 'checked';?>> After blocking
										</label>
										
										<label class="checkbox-inline">
											<input type="checkbox" name="show_on_betweenpages_chk" value="1" <?php if ($ad['show_on_betweenpages']) echo 'checked';?>> Between page swipes
										</label>
										
										<label class="checkbox-inline">
											<input type="checkbox" name="show_on_afterlogout_chk" value="1" <?php if ($ad['show_on_afterlogout']) echo 'checked';?>> After Logout
										</label>
										
										<label class="checkbox-inline">
											<input type="checkbox" name="show_on_afterclosingprofile_chk" value="1" <?php if ($ad['show_on_afterclosingprofile']) echo 'checked';?>> After closing 10th profile
										</label>
										
										<label class="checkbox-inline">
											<input type="checkbox" name="show_on_firstlogin_chk" value="1" <?php if ($ad['show_on_firstlogin']) echo 'checked';?>> Very first login before grid
										</label>
										
									</div>
								
								</div>
								
								
								<div class="row">
									
									<div class="form-horizontal col-sm-12">
										<div class="form-group">
											<label class="col-md-2">Top Button</label>
											<div class="col-md-5">
											  <input type="text" class="form-control" placeholder="Top button label" name="ad_topbutton_label" data-required="true" value="<?php echo $ad['topbutton_label'];?>">
											</div>
											<div class="col-md-2">
												<label>Top Button action:</label>
											</div>
											<div class="col-md-3">
											  	<select name="ad_topbutton_pageid" class="form-control">
												<?php foreach($page_list as $page):?>
													<option value="<?php echo $page['id'];?>" <?php if ($ad['topbutton_go_pageid'] == $page['id']) echo 'selected';?>><?php echo $page['title'];?></option>
												<?php endforeach;?>
												</select>
												
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2">Bottom Button</label>
											<div class="col-md-5">
											  <input type="text" class="form-control" placeholder="Bottom button label" name="ad_bottombutton_label" data-required="true" value="<?php echo $ad['bottombutton_label'];?>">
											</div>
											<div class="col-md-5">&nbsp;</div>
										</div>
				
									</div>
																
								</div>
								
								<div class="row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-success">Save</button>
										<button type="button" class="btn btn-tertiary" onclick="deActivateAd('<?php echo $ad['id'];?>');">De-activate</button>
										<button type="button" class="btn btn-primary" onclick="deleteAd('<?php echo $ad['id'];?>');">Delete</button>
									</div>
								</div>
								
							</div>	
							
							<div class="col-sm-2">
								<label>Background image</label>
								<?php if ($ad['backimage'] == ''):?>
								<div class="fileupload fileupload-new" data-provides="fileupload">
								  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo assets_url('/img/no_image.gif');?>" alt="Placeholder"></div>
								  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
								  <div>
								    <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="ad_backImage"></span>
								    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
								  </div>
								</div>
								<?php else:?>
								<div class="fileupload fileupload-exists" data-provides="fileupload">
								  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo assets_url('/img/no_image.gif');?>" alt="Placeholder"></div>
								  <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 10px;">
								  	<img src="<?php echo $ad_upload_url . $ad['backimage'];?>" alt="Placeholder">
								  </div>
								  <div>
								    <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="ad_backImage"></span>
								    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
								  </div>
								</div>
								<?php endif;?>
							</div>
									
						</div>
						
						</form>
					
					</div>
					
				</div>
				
				<?php $active_ad_count++; endforeach?>
				
				<?php if ($active_ad_count == 0) :?>
				
				<p class="text-muted">No active ad/alert found.</p>
				
				<?php endif;?>
				
			</div>
			
			<hr/>
			
			<div id="inactiveAds-container">
			
				<h3 class="section-header">Inactive Ad/Alerts:</h3>
				
								
				<?php $inActive_ad_count = 0; ?>
				
				<?php foreach ($ad_list as $ad) :?>
				
				<?php if ($ad['is_active'] == 1) continue;?>	
				
				<div class="portlet">
				
					<div class="portlet-header">
						<h3><?php echo $ad['title']?>&nbsp;&nbsp;<span class="text-muted">(<?php echo $ad['group_name']?>)</span></h3>
						<div class="portlet-tools pull-right">
							<a href="javascript::" class="portlet-collapse-toggle-link" data-toggle="collapse" data-target="#ad_content_panel_<?php echo $ad['id'];?>"><i class="fa fa-plus-square" id="ad_content_toggle_link_<?php echo $ad['id'];?>"></i></a>
						</div>
							
					</div>
				
					<div class="portlet-content collapse" data-portlet-collapse="true" id="ad_content_panel_<?php echo $ad['id'];?>">
					
						<form enctype="multipart/form-data" method="POST" action="<?php echo site_url('/admin/saveAd')?>" class="form parsley-form" data-validate="parsley">

						<div class="row">
							<div class="col-sm-8">
								<div class="form-group">
									<input type="hidden" name="ad_title" value="<?php echo $ad['title'];?>"/>
									<input type="hidden" name="ad_id" value="<?php echo $ad['id'];?>" />
								</div>
								<div class="form-group">
									<label for="newAd_body">Ad/Alert content</label>
									<textarea name="ad_content" cols="10" rows="3" class="form-control" data-required="true"><?php echo $ad['content'];?></textarea>
								</div>
							</div>
							<div class="col-sm-4">&nbsp;</div>
						</div>
						
						<div class="row">
							<div class="col-sm-2">
								<label>Top header image</label>
								<?php if ($ad['topimage'] == ''):?>
								<div class="fileupload fileupload-new" data-provides="fileupload">
								  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo assets_url('/img/no_image.gif');?>" alt="Placeholder"></div>
								  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
								  <div>
								    <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="ad_topImage"></span>
								    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
								  </div>
								</div>
								<?php else:?>
								<div class="fileupload fileupload-exists" data-provides="fileupload">
								  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo assets_url('/img/no_image.gif');?>" alt="Placeholder"></div>
								  <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 10px;">
								  	<img src="<?php echo $ad_upload_url . $ad['topimage'];?>" alt="Placeholder">
								  </div>
								  <div>
								    <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="ad_topImage"></span>
								    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
								  </div>
								</div>
								<?php endif;?>
								
							</div>
							<div class="col-sm-8">
							
								<div class="row">
									
									<div class="form-inline col-sm-12">
									
										<div class="form-group margin-right-20px">
											<input id="ad_startdate_<?php echo $ad['id'];?>" name="ad_startdate" value="<?php echo $ad['startdate'];?>" class="form-control date-picker" data-dpicker-type="startdate" type="text" placeholder="Start date">
											<span class="help-block">mm/dd/yyyy</span>
										</div>
									
										<div class="form-group margin-right-20px">
											<input id="ad_enddate_<?php echo $ad['id'];?>" name="ad_enddate" value="<?php echo $ad['enddate'];?>" class="form-control date-picker" type="text" placeholder="End date">
											<span class="help-block">mm/dd/yyyy</span>
										</div>
										
										<div class="form-group margin-right-20px inline-form-vertical-top">
											<label class="checkbox-inline">
										  		<input type="checkbox" data-chk-type="noenddate" id="noenddate_chk_<?php echo $ad['id'];?>" name="noenddate_chk" value="1" <?php if ($ad['noenddate']) echo 'checked';?>> No end date
											</label>
										</div>
										
										<div class="form-group inline-form-vertical-top">
										
											<select name="ad_membergroup_id" class="form-control">
											<?php foreach($membergroup_list as $member_group):?>
												<option value="<?php echo $member_group['id'];?>" <?php if ($member_group['id'] == $ad['membergroup_id']) echo 'selected';?>><?php echo $member_group['group_name'];?></option>
											<?php endforeach;?>
											</select>
										
										</div>
										
									</div>
									
								</div>
								
								<div class="row">
								
									<div class="form-group col-sm-12">
										
										<label class="checkbox-inline">
											<input type="checkbox" name="show_on_startup_chk" value="1" <?php if ($ad['show_on_startup']) echo 'checked';?>> App start-up
										</label>
										
										<label class="checkbox-inline">
											<input type="checkbox" name="show_on_afterblock_chk" value="1" <?php if ($ad['show_on_afterblock']) echo 'checked';?>> After blocking
										</label>
										
										<label class="checkbox-inline">
											<input type="checkbox" name="show_on_betweenpages_chk" value="1" <?php if ($ad['show_on_betweenpages']) echo 'checked';?>> Between page swipes
										</label>
										
										<label class="checkbox-inline">
											<input type="checkbox" name="show_on_afterlogout_chk" value="1" <?php if ($ad['show_on_afterlogout']) echo 'checked';?>> After Logout
										</label>
										
										<label class="checkbox-inline">
											<input type="checkbox" name="show_on_afterclosingprofile_chk" value="1" <?php if ($ad['show_on_afterclosingprofile']) echo 'checked';?>> After closing 10th profile
										</label>
										
										<label class="checkbox-inline">
											<input type="checkbox" name="show_on_firstlogin_chk" value="1" <?php if ($ad['show_on_firstlogin']) echo 'checked';?>> Very first login before grid
										</label>
										
									</div>
								
								</div>
								
								
								<div class="row">
									
									<div class="form-horizontal col-sm-12">
										<div class="form-group">
											<label class="col-md-2">Top Button</label>
											<div class="col-md-5">
											  <input type="text" class="form-control" placeholder="Top button label" name="ad_topbutton_label" data-required="true" value="<?php echo $ad['topbutton_label'];?>">
											</div>
											<div class="col-md-2">
												<label>Top Button action:</label>
											</div>
											<div class="col-md-3">
											  	<select name="ad_topbutton_pageid" class="form-control">
												<?php foreach($page_list as $page):?>
													<option value="<?php echo $page['id'];?>" <?php if ($ad['topbutton_go_pageid'] == $page['id']) echo 'selected';?>><?php echo $page['title'];?></option>
												<?php endforeach;?>
												</select>
												
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2">Bottom Button</label>
											<div class="col-md-5">
											  <input type="text" class="form-control" placeholder="Bottom button label" name="ad_bottombutton_label" data-required="true" value="<?php echo $ad['bottombutton_label'];?>">
											</div>
											<div class="col-md-5">&nbsp;</div>
										</div>
				
									</div>
																
								</div>
								
								<div class="row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-success">Save</button>
										<button type="button" class="btn btn-tertiary" onclick="activateAd('<?php echo $ad['id'];?>');">Activate</button>
										<button type="button" class="btn btn-primary" onclick="deleteAd('<?php echo $ad['id'];?>');">Delete</button>
									</div>
								</div>
								
							</div>	
							
							<div class="col-sm-2">
								<label>Background image</label>
								<?php if ($ad['backimage'] == ''):?>
								<div class="fileupload fileupload-new" data-provides="fileupload">
								  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo assets_url('/img/no_image.gif');?>" alt="Placeholder"></div>
								  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
								  <div>
								    <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="ad_backImage"></span>
								    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
								  </div>
								</div>
								<?php else:?>
								<div class="fileupload fileupload-exists" data-provides="fileupload">
								  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo assets_url('/img/no_image.gif');?>" alt="Placeholder"></div>
								  <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 10px;">
								  	<img src="<?php echo $ad_upload_url . $ad['backimage'];?>" alt="Placeholder">
								  </div>
								  <div>
								    <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="ad_backImage"></span>
								    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
								  </div>
								</div>
								<?php endif;?>
							</div>
									
						</div>
						
						</form>
					
					</div>
					
				</div>
				
				<?php $inActive_ad_count++; endforeach?>
				
				<?php if ($inActive_ad_count == 0) :?>
				
				<p class="text-muted">No inactive ad/alert found.</p>
				
				<?php endif;?>
			</div>
		</div>
		
</div>

<script type="text/javascript">

	var current_ad_id = <?php echo $current_ad_id;?>;

</script>


<?php include('common/footer.php')?>