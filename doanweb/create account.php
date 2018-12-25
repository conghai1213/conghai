<?php
session_start();

require_once './vendor/autoload.php';
use Gregwar\Captcha\CaptchaBuilder;

if (isset($_POST["btnRegister"])) {
	$input = $_POST["txtUserInput"];
	if ($input == $_SESSION["captcha"]) {

	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>D15</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
</head>
<body>
	<br />
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-2">
				<form id="f" action="" method="POST" role="form">
					<legend>Thông tin tài khoản</legend>
				
					<div class="form-group">
						<label for="txtUsername">Tên đăng nhập</label>
						<input type="text" class="form-control" id="txtUsername" name="txtUsername">
					</div>
					<div class="form-group">
						<label for="txtPWD">Mật khẩu</label>
						<input type="password" class="form-control" id="txtPWD" name="txtPWD">
					</div>
					<div class="form-group">
						<label for="txtPWD2">xác nhận</label>
						<input type="password" class="form-control" id="txtPWD2" name="txtPWD2">
					</div>
					<div class="form-group">
						<?php
							$builder = new CaptchaBuilder;
							$builder->build();
							$_SESSION["captcha"] = $builder->getPhrase();
						?>
						<img src="<?= $builder->inline() ?>" alt="captcha" />
					</div>
					<div class="form-group">
						<label for="txtUserInput">Captcha</label>
						<input type="text" class="form-control" id="txtUserInput" name="txtUserInput">
					</div>
					<button name="btnRegister" type="submit" class="btn btn-primary">
						<span class="glyphicon glyphicon-ok"></span>
						Đăng kí
					</button>
				</form>
			</div>
		</div>
	</div>
	<script src="assets/jquery-3.1.1.min.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$('#f').on('submit', function (e) {
			e.preventDefault();

			var form = this;

			var username = $('#txtUsername').val();
			if (username.length === 0) {
				alert('null');
				return;
			}

			var url = 'api/user_check.php?user=' + username;
			$.getJSON(url, function (data) {
				if (data === 1) {
					alert('existed');
				} else {
					form.submit();
				}
			});
		});
	</script>
</body>
</html>		