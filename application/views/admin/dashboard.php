<?php include('common/header.php')?>


	<div id="content" data-ng-controller="DashboardCtrl">		
		
		<div id="content-header">
			<h1>Dashboard</h1>
		</div> <!-- #content-header -->	


		<div id="content-container">

			<div>
				<h4 class="heading-inline text-primary">Crucial Metrics&nbsp;&nbsp;&nbsp;</h4>

				<div class="btn-group" data-ng-cloak>
				  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
					<i class="fa fa-clock-o"></i>  &nbsp;
				    {{crucialMetricRangeText}} <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu" role="menu">
		            <li><a href="javascript:;" ng-click="crucialMetricRange = 0">Today</a></li>
		            <li><a href="javascript:;" ng-click="crucialMetricRange = 1">This Week</a></li>
		            <li><a href="javascript:;" ng-click="crucialMetricRange = 2">This Month</a></li>
		            <li><a href="javascript:;" ng-click="crucialMetricRange = 3">This Year</a></li>
		            <li class="divider"></li>
		            <li><a href="javascript:;" ng-click="crucialMetricRange = 4">All Years (Totals)</a></li>
		          </ul>
				</div>
			</div>

			<br />


			<div class="row" data-ng-cloak>

				<div class="col-md-3 col-sm-6">
				
					<a class="dashboard-stat primary no-hover">
						<div class="details">
							<span class="content">New Members</span>
							<span class="value">{{crucialMetrics.new_members_count}}</span>
						</div> <!-- /.details -->
					</a> <!-- /.dashboard-stat -->

				</div> <!-- /.col-md-3 -->

				<div class="col-md-3 col-sm-6">

					<a class="dashboard-stat secondary no-hover">
						<div class="details">
							<span class="content">New Premium Memberships</span>
							<span class="value">{{crucialMetrics.new_premium_count}}&nbsp;&nbsp;<small class="text-black smaller" style="vertical-align: top">{{crucialMetrics.new_premium_percent}}%</small></span>
						</div> <!-- /.details -->
					</a> <!-- /.dashboard-stat -->

				</div> <!-- /.col-md-3 -->

				<div class="col-md-3 col-sm-6">

					<a class="dashboard-stat tertiary no-hover">
						<div class="details">
							<span class="content">New Standout Strip Orders</span>
							<span class="value">{{crucialMetrics.new_standout_count}}</span>
						</div> <!-- /.details -->
					</a> <!-- /.dashboard-stat -->

				</div> <!-- /.col-md-3 -->

				<div class="col-md-3 col-sm-6">

					<a class="dashboard-stat no-hover">
						<div class="details">
							<span class="content">New Gifts Purchased</span>
							<span class="value">{{crucialMetrics.new_gifts_count}}</span>
						</div> <!-- /.details -->
					</a> <!-- /.dashboard-stat -->

				</div> <!-- /.col-md-9 -->
				
			</div> <!-- /.row -->




			<div class="row">

				<div class="col-md-9">

					<div class="portlet">

						<div class="portlet-header">

							<h3>Membership</h3>

						</div> <!-- /.portlet-header -->

						<div class="portlet-content">

							<div class="pull-left">
								<div class="btn-group" data-toggle="buttons">
								  <label class="btn btn-sm btn-default active" data-ng-click="membershipAreaChartStep = 0">
								    <input type="radio" name="options" id="option1"> Day
								  </label>
								  <label class="btn btn-sm btn-default" data-ng-click="membershipAreaChartStep = 1">
								    <input type="radio" name="options" id="option2"> Week
								  </label>
								  <label class="btn btn-sm btn-default" data-ng-click="membershipAreaChartStep = 2">
								    <input type="radio" name="options" id="option3"> Month
								  </label>
								</div>
							</div>

							<div class="clear"></div>
							<hr />

							<div id="membership-area-chart" class="chart-holder" style="height: 250px"></div> <!-- /#bar-chart -->

						</div> <!-- /.portlet-content -->

					</div> <!-- /.portlet -->

					
					<div class="portlet">

						<div class="portlet-header">

							<h3>Purchase Volume</h3>

						</div> <!-- /.portlet-header -->

						<div class="portlet-content">

							<div class="pull-left">
								<div class="btn-group" data-toggle="buttons">
								  <label class="btn btn-sm btn-default active" data-ng-click="purchaseVolumeChartStep = 0">
								    <input type="radio" name="options" id="option1"> Day
								  </label>
								  <label class="btn btn-sm btn-default" data-ng-click="purchaseVolumeChartStep = 1">
								    <input type="radio" name="options" id="option2"> Week
								  </label>
								  <label class="btn btn-sm btn-default" data-ng-click="purchaseVolumeChartStep = 2">
								    <input type="radio" name="options" id="option3"> Month
								  </label>
								</div>
							</div>

							<div class="clear"></div>
							<hr />

							<div id="purchasevolume-area-chart" class="chart-holder" style="height: 250px"></div> <!-- /#bar-chart -->

						</div> <!-- /.portlet-content -->

					</div> <!-- /.portlet -->
					
					
					<div class="portlet">

						<div class="portlet-header">

							<h3>Purchase Selections</h3>

						</div> <!-- /.portlet-header -->

						<div class="portlet-content">

							<div class="pull-left">
								<div class="btn-group" data-toggle="buttons">
								  <label class="btn btn-sm btn-default active" data-ng-click="purchaseSelectionChartStep = 0">
								    <input type="radio" name="options" id="option1"> Day
								  </label>
								  <label class="btn btn-sm btn-default" data-ng-click="purchaseSelectionChartStep = 1">
								    <input type="radio" name="options" id="option2"> Week
								  </label>
								  <label class="btn btn-sm btn-default" data-ng-click="purchaseSelectionChartStep = 2">
								    <input type="radio" name="options" id="option3"> Month
								  </label>
								</div>
							</div>
							<div class="pull-right">
								<div class="btn-group">
								    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
								      {{purchaseSelectionChartTypeString}}
								      <span class="caret"></span>
								    </button>
								    <ul class="dropdown-menu">
								      <li><a href="javascript:;" ng-click="purchaseSelectionChartType = 0">Premium</a></li>
								      <li><a href="javascript:;" ng-click="purchaseSelectionChartType = 1">Standout Strip</a></li>
								      <li><a href="javascript:;" ng-click="purchaseSelectionChartType = 2">Gifts</a></li>
								    </ul>
								  </div>
							</div>
							<div class="clear"></div>
							<hr />

							<div id="purchaseselection-area-chart" class="chart-holder" style="height: 250px"></div> <!-- /#bar-chart -->

						</div> <!-- /.portlet-content -->

					</div> <!-- /.portlet -->

					
					<div class="portlet">

						<div class="portlet-header">

							<h3>Gross Revenue</h3>

						</div> <!-- /.portlet-header -->

						<div class="portlet-content">

							<div class="pull-left">
								<div class="btn-group" data-toggle="buttons">
								  <label class="btn btn-sm btn-default active" data-ng-click="grossRevenueChartStep = 0">
								    <input type="radio" name="options" id="option1"> Day
								  </label>
								  <label class="btn btn-sm btn-default" data-ng-click="grossRevenueChartStep = 1">
								    <input type="radio" name="options" id="option2"> Week
								  </label>
								  <label class="btn btn-sm btn-default" data-ng-click="grossRevenueChartStep = 2">
								    <input type="radio" name="options" id="option3"> Month
								  </label>
								</div>
							</div>

							<div class="clear"></div>
							<hr />

							<div id="grossrevenue-area-chart" class="chart-holder" style="height: 250px"></div> <!-- /#bar-chart -->

						</div> <!-- /.portlet-content -->

					</div> <!-- /.portlet -->
					

				</div> <!-- /.col-md-9 -->




				<div class="col-md-3">

					<div class="summary-list-group">
						<div class="summary-list-item">
							<h1 class="summary-list-item-heading">11</h1>
							<p class="summary-list-item-content">Members Logged In</p>
						</div>
						<div class="summary-list-item">
							<h1 class="summary-list-item-heading">3</h1>
							<p class="summary-list-item-content">Members Looking</p>
						</div>
					</div>
					
					<div class="list-group">  

						<a class="list-group-item no-hover">
				          <h4 class="list-group-item-heading">0</h4>
				          <p class="list-group-item-text">Total Messages Sent</p>
				        </a>
				        
				        <a class="list-group-item no-hover">
				          <h4 class="list-group-item-heading">0</h4>
				          <p class="list-group-item-text">Total Mutual Attractions</p>
				        </a>
				        
				        <a class="list-group-item no-hover">
				          <h4 class="list-group-item-heading">0</h4>
				          <p class="list-group-item-text">Total Woofs Sent</p>
				        </a>
				        
				        <a class="list-group-item no-hover">
				          <h4 class="list-group-item-heading">0</h4>
				          <p class="list-group-item-text">Total Gifts Sent</p>
				        </a>
				        
				        <a  class="list-group-item no-hover">
				          <h4 class="list-group-item-heading">0m</h4>
				          <p class="list-group-item-text">Average Session Duration</p>
				        </a>

					</div>
					
					<div class="portlet">

						<div class="portlet-header">

							<h3>
								<i class="fa fa-bar-chart-o"></i>
								Premium Trigger Page
							</h3>

						</div> <!-- /.portlet-header -->

						<div class="portlet-content">

							<div id="donut-chart" class="chart-holder" style="height: 250px"></div>
							

						</div> <!-- /.portlet-content -->

					</div> <!-- /.portlet -->


					<div class="portlet">

						<div class="portlet-header">

							<h3>
								<i class="fa fa-bar-chart-o"></i>
								Payment Method
							</h3>

						</div> <!-- /.portlet-header -->

						<div class="portlet-content">

							<div id="donut-chart2" class="chart-holder" style="height: 300px"></div>
							

						</div> <!-- /.portlet-content -->

					</div> <!-- /.portlet -->

				</div> <!-- /.col -->

			</div> <!-- /.row -->

		</div> <!-- /#content-container -->
		

	</div> <!-- #content -->	


<?php include('common/footer.php')?>