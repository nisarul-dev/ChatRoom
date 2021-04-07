<div class="col-md-4 col-xl-3 chat">
	<div class="card mb-sm-3 mb-md-0 contacts_card">
		<!-- Profile -->
		<div class="d-flex bd-highlight container mt-2">
			<div class="img_cont">
				<img src="https://2.bp.blogspot.com/-8ytYF7cfPkQ/WkPe1-rtrcI/AAAAAAAAGqU/FGfTDVgkcIwmOTtjLka51vineFBExJuSACLcBGAs/s320/31.jpg" class="rounded-circle user_img">
				<span class="online_icon online"></span>
			</div>
			<div class="user_info">
				<span> <span style="font-size: 0.8em;"> Welcome, </span><?php echo $_SESSION['firstname']; ?></span>
				<a class="btn btn-block btn-dark btn-sm" href="logout.php" role="button">Logout</a>
			</div>
		</div>


		<div class="card-header">
			<div class="input-group">
				<input type="text" placeholder="Search..." name="" class="form-control search">
				<div class="input-group-prepend">
					<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
				</div>
			</div>
		</div>
		<div class="card-body contacts_body">
			<ui class="contacts">
				<!-- Contacts -->

				<!-- <li>
					<div class="d-flex bd-highlight">
						<div class="img_cont">
							<img src="https://2.bp.blogspot.com/-8ytYF7cfPkQ/WkPe1-rtrcI/AAAAAAAAGqU/FGfTDVgkcIwmOTtjLka51vineFBExJuSACLcBGAs/s320/31.jpg" class="rounded-circle user_img">
							<span class="online_icon offline"></span>
						</div>
						<div class="user_info">
							<span>Taherah Big</span>
							<p>Taherah left 7 mins ago</p>
						</div>
					</div>
				</li> -->
			</ui>
		</div>
		<div class="card-footer"></div>
	</div>
</div>