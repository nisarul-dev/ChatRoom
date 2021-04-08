<?php
if(isset($_POST['img_submit'])) {
	if(isset($_FILES['image'])) {
		include "../processes/functions.php";

		$target_dir = "../images/users/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
			} else {
				$uploadOk = 0;
			}
		}

		// Check if file already exists
		if (file_exists($target_file)) {
		$uploadOk = 0;
		}

		// Check file size
		if ($_FILES["image"]["size"] > 500000) {
		$uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		$uploadOk = 0;
		// Check if $uploadOk is set to 0 by an error
		} else {
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			if(!empty($_SESSION['profile_img'])) {
				unlink("../images/users/" . $_SESSION['profile_img']);
			}

			$file_name = $_FILES["image"]["name"];
			rename("../images/users/" . $file_name,"../images/users/" . $_SESSION['email'] . "." . $imageFileType  );
			$file_name = $_SESSION['email'] . "." . $imageFileType;
			$usr_id = $_SESSION['id'];
			$connection->query("UPDATE `users` SET `profile_img` = '$file_name' WHERE `users`.`usr_id` = $usr_id ");

			$usr_table = $connection->query("SELECT * FROM users WHERE usr_id = $usr_id");
			$_SESSION['profile_img'] = $usr_table->fetch_object()->profile_img;
		}
		}
	}
	header("Location: ../");
	die();
}
?>
<div class="col-md-4 col-xl-3 chat">
	<div class="card mb-sm-3 mb-md-0 contacts_card">
		<!-- Profile -->
		<div class="d-flex bd-highlight container mt-2">
			<div class="img_cont">
				<div class="pro-img-div">
				<div class="hover-div"><button id="myInput" class="btn btn-dark btn-sm"  data-toggle="modal" data-target="#exampleModal">Upload <br> Photo</button></div>
					<img src="images/users/<?php echo !empty($_SESSION['profile_img']) ? $_SESSION['profile_img'] : "usericon-self.png" ?>" class="rounded-circle user_img">
				</div>

				<span class="online_icon online"></span>
			</div>
			<div class="user_info">
				<span> <span style="font-size: 0.8em;"> Welcome, </span><?php echo $_SESSION['firstname']; ?></span>
				<a class="btn btn-block btn-dark btn-sm" href="logout.php" role="button">Logout</a>
			</div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="includes/chat-left-side-bar.php" method="POST" enctype="multipart/form-data">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Upload Profile Picture</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="file" name="image" class="form-control" id="customFile" />
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="img_submit" class="btn btn-primary">Save changes</button>
				</div>
				</div>
			</form>
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