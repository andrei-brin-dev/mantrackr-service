<?php include('common/header.php')?>

<div id="content">

	<div id="content-header">
			<h1>Emails to Members</h1>
	</div> <!-- #content-header -->	

	<div id="content-container">
	
		<div class="row">
		
			<div class="col-md-12">
			
				<ul id="emailTabs" class="nav nav-tabs">
					<li class="active">
						<a href="#photoModeration" data-toggle="tab">Photo Moderation</a>
					</li>
					<li>
						<a href="#adminDeletedAccounts" data-toggle="tab">Admin-Deleted Accounts</a>
					</li>
					<li>
						<a href="#selfCanceledAccounts" data-toggle="tab">Self-Canceled Accounts</a>
					</li>
					<li>
						<a href="#newMembers" data-toggle="tab">New Members</a>
					</li>
					<li>
						<a href="#inactiveMembers" data-toggle="tab">Inactive Members</a>
					</li>
				</ul>
				
				
				<div id="emailTabsContent" class="tab-content">
					<div class="tab-pane fade in active" id="photoModeration">
					
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
									<button type="button" class="btn btn-tertiary">Send</button>
									<button type="button" class="btn btn-tertiary">Cancel</button>
								</div>
							</div>
						
						</div>
					
					</div>
					
					<div class="tab-pane fade" id="adminDeletedAccounts">
					
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
									<button type="button" class="btn btn-tertiary">Send</button>
									<button type="button" class="btn btn-tertiary">Cancel</button>
								</div>
							</div>
						
						</div>
					
					</div>
					
					<div class="tab-pane fade" id="selfCanceledAccounts">
					
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
									<button type="button" class="btn btn-tertiary">Send</button>
									<button type="button" class="btn btn-tertiary">Cancel</button>
								</div>
							</div>
						
						</div>
					
					</div>
					
					
					<div class="tab-pane fade" id="newMembers">
					
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
									<button type="button" class="btn btn-tertiary">Send</button>
									<button type="button" class="btn btn-tertiary">Cancel</button>
								</div>
							</div>
						
						</div>
					
					</div>
					
					
					<div class="tab-pane fade" id="inactiveMembers">
					
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
									<button type="button" class="btn btn-tertiary">Send</button>
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



<?php include('common/footer.php')?>