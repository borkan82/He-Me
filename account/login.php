<?php
/**
 * @TODO
 * Uputstvo za oranz dugme da se klikne
 * Poruka mora biti boldovana
 */
//  https://www.freeprivacypolicy.com/free-cookie-consent/   COOOOKIEEE BANNNEER
$title = "He-Me.com – API Solutions & Microservices to Transform Your Business";
include "includes/config.php";
include INC."header.php";
include INC."DbPDO.php";

$dbpdo              = new DbPDO();
// echo "here";exit;
?>
<style>
    .input-container {
        display: flex;
        align-items: center;
        width: 100%;
    }

    .input-container i {
        margin-right: 10px;
        font-size: 20px;
    }

    .input-container input {
        /*flex: 1;*/
        border-radius: 5px;
        font-size: 20px;
        padding: 5px;
        height: 50px;
        width: 300px;
    }
    .input-container select {
        margin-right: 20px;
        padding: 5px;
        height: 30px;
        width: 300px;
    }
    .generateBtn {
        border-radius: 10px;
        margin:5px;
        width:50%;
        font-size: 16px;
        height: 50px;
    }
    .checkedGreen {
        color: #2ec92e;
        background-color: #d6f8d6;
    }
    .char-counter {
        position: absolute;
        bottom: 5px;
        right: 10px;
        font-size: 12px;
        color: #666;
    }
    .error-text {
        color:#C00;
        font-size: 2em;
    }

    .responseContainer {
        display: none;
        height: auto;
        width: 300px;
        border: 3px dashed #fba119;
        padding: 10px;
        background-color: #efc191;
        color: #222;
    }

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<body>
<div class="super_container">
	<!-- Header -->
	<header class="header">
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="top_bar_container">
				<div class="container">
					<div class="row">
						<div class="col">
                            <?php
                            include __DIR__."/includes/topBar.php";
                            ?>
						</div>
					</div>
				</div>
			</div>				
		</div>

		<!-- Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col d-flex justify-content-center align-items-center">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo_container">
								<a href="#">
									<div class="logo_content d-flex flex-row align-items-end justify-content-start">
										<div class="logo_img"><img src="images/logo.png" alt="He-me Logo"></div>
										<div class="logo_text"></div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
        <?php
        include __DIR__."/includes/navigation_mm.php";
        ?>
		<div class="menu_extra">
			<div class="menu_social">
				<span class="menu_title"><?= $vbl[3] ?></span>
				<ul>
					<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
    </header>
	<!-- Home -->

	<div class="container d-flex justify-content-center align-items-center vh-100" style="margin-top: 50px;margin-bottom: 50px;">
    <div class="card p-4 shadow" style="width: 350px;">
      <h3 class="text-center mb-4">Login</h3>
      <form>
        <!-- Username Input -->
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" placeholder="Enter your username">
        </div>

        <!-- Password Input -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Enter your password">
        </div>

        <!-- Forgot Password Link -->
        <div class="mb-3 text-end">
          <a href="#" class="link-primary">Forgot password?</a>
        </div>

        <!-- Login Button -->
        <button type="submit" class="btn btn-primary w-100">Login</button>
      </form>
    </div>
  </div>

	<!-- Footer -->
    <?php
    include __DIR__."/includes/footer.php";
    ?>
</div>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>