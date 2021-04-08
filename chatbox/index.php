<?php require_once "includes/header.php";?>

<div id="message1"></div>
<div class="container-fluid h-100">
	<div class="row justify-content-center h-100">

		<?php require_once "includes/chat-left-side-bar.php"; ?>

		<div class="col-md-8 col-xl-6 chat" id="to-message">
			<div class="card">

				<?php require_once "includes/chat-box-header.php"; ?>
				<?php require_once "includes/chat-texts.php"; ?>
				<?php require_once "includes/chat-form.php"; ?>

			</div>
		</div>
	</div>
</div>

<?php require_once "includes/footer.php"; ?>