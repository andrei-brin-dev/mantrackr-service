<?php include('common/header.php')?>


	<div id="content" data-ng-controller="MembersCtrl">		
		
		<div id="content-header">
			<h1>Members</h1>
		</div> <!-- #content-header -->	


		<div id="content-container">

			<div class="row">

				<div class="col-md-12">

					<div class="portlet">

						<div class="portlet-header">

							<h3>
								<i class="fa fa-user"></i>
								Members
							</h3>

						</div> <!-- /.portlet-header -->

						<div class="portlet-content">						

							<div class="table-responsive">

							<table 
								id = "members_table"
								class="table table-striped table-bordered table-hover table-highlight table-checkable" 
								data-provide="datatable" 
								data-display-rows="10"
								data-info="true"
								data-search="true"
								data-length-change="true"
								data-paginate="true"
								data-s-ajax-source="<?php echo site_url('/admin/getAllMembersTable')?>"
								data-fn-row-callback="memberTableRowCallback"
								data-fn-draw-callback="memberTableDrawCallback"
								data-filter-value = "<?php echo $searchQuery; ?>"
							>
									<thead>
										<tr>
											<!-- <th class="checkbox-column">
												<input type="checkbox" class="icheck-input">
											</th> -->
											<th style="width: 150px;" class="hidden-xs hidden-sm">&nbsp;</th>
											<th data-sortable="true">Name</th>
											<th data-sortable="true" style="width: 150px;">Location</th>
											<th data-sortable="true" style="width: 300px;" class="hidden-xs hidden-sm">Member since</th>
											<th data-sortable="true" style="width: 150px;">Membership</th>
											<th data-sortable="true" style="width: 150px;" class="hidden-xs hidden-sm">Photo Approved</th>
											<th data-sortable="true" style="width: 150px;">Active</th>
											<th style="width: 200px;">Action</th>
										</tr>
									</thead>
								</table>
							</div> <!-- /.table-responsive -->
							

						</div> <!-- /.portlet-content -->

					</div> <!-- /.portlet -->

				

				</div> <!-- /.col -->

			</div> <!-- /.row -->


		</div> <!-- /#content-container -->
		
			
	</div> <!-- #content -->

<?php include('common/footer.php')?>
