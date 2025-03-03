<?php
/**
 * @TODO
 * Uputstvo za oranz dugme da se klikne
 * Poruka mora biti boldovana
 */
//  https://www.freeprivacypolicy.com/free-cookie-consent/   COOOOKIEEE BANNNEER
$title = "Instant Name Gender Checker - Identify Gender by Name Quickly";
include "includes/config.php";
include INC."header.php";
include INC."DbPDO.php";
include CLASS_PATH."Geolocation.php";
include CLASS_PATH."GenderRequests.php";
include CLASS_PATH."VisitorsLog.php";

$dbpdo              = new DbPDO();
$GenderRequests     = new GenderRequests($dbpdo);
$Geolocation        = new GEOLOCATION();
$VisitorsLog        = new VisitorsLog($dbpdo);

$agent  = !empty($_SERVER['HTTP_USER_AGENT']) ? addslashes($_SERVER['HTTP_USER_AGENT']) : '';
$ip     = $GenderRequests->getIpAddress();
$VisitorsLog->insertVisitor(['ip'=>$ip, 'agent'=>$agent, 'site'=>'GENDER']);

    if(empty($_SESSION['country_origin']) && !isset($_GET['lang'])) {
        if(!empty($ip)){
            // @TODO uncomment this and change to HTTPS in Geolocation class
//        $countryCode = $Geolocation->getGeolocation($ip);
//        if(!empty($countryCode) && !empty($json[$countryCode])){
//            $vbl = $json[$countryCode];
//            $_SESSION['country_origin'] = $countryCode;
//        }
        }
    }
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

	<div class="home">
		<div class="home_slider_container">
			
			<!-- Home Slider -->
			<div class="owl-carousel owl-theme home_slider">
				
				<!-- Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(images/contact.jpg)"></div>
					<div class="home_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_content text-center">
										<div class="home_text">
                                            <h1><?= $vbl[43] ?></h1>
											<div class="home_title"><?= $vbl[4] ?></div>
											<div class="home_subtitle"><?= $vbl[5] ?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Feature Box -->

	<div class="featured">
		<div class="container">
			<div class="row">
				<div class="col">
					<!-- Home Slider Nav -->
					<div class="featured_container justify-content-center align-items-center">
						<div class="row">
							<div class="col-lg-12 featured_col ">
								<div class="featured_content justify-content-center align-items-center" style="border-radius: 10px 10px 0px 0px;">
                                    <p><?= $vbl[9] ?></p>
                                    <div class="input-container justify-content-center align-items-center">
                                        <input type="text" id="nameToCheck" placeholder="John" maxlength="30">
                                    </div>
                                    <div class="featured_header d-flex flex-row align-items-center justify-content-startd-flex flex-row align-items-center justify-content-center">
										<button type="button" class="featured_tag generateBtn" onclick="checkName();" style="cursor:not-allowed" disabled><?= $vbl[11] ?></button>
									</div>
									<div class="featured_header d-flex flex-row align-items-center justify-content-startd-flex flex-row align-items-center justify-content-center">
                                        <div class="responseContainer">
                                            <span id="responseText" class="response-text"></span>
                                        </div>

                                        
									    <span id="errorText" class="error-text"></span>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="grouped_sections">
		<div class="container">
			<div class="row">
				<!-- Why Choose Us -->
				<div class="col-lg-6 grouped_col">
					<div class="grouped_title"><?= $vbl[20] ?></div>
					<div class="accordions">
						<div class="accordion_container">
							<div class="accordion d-flex flex-row align-items-center active"><div><?= $vbl[21] ?></div></div>
							<div class="accordion_panel">
								<div>
									<p><?= $vbl[22] ?></p>
								</div>
							</div>
						</div>

						<div class="accordion_container">
							<div class="accordion d-flex flex-row align-items-center"><div><?= $vbl[23] ?></div></div>
							<div class="accordion_panel">
								<div>
									<p><?= $vbl[24] ?></p>
								</div>
							</div>
						</div>

						<div class="accordion_container">
							<div class="accordion d-flex flex-row align-items-center"><div><?= $vbl[25] ?></div></div>
							<div class="accordion_panel">
								<div>
									<p><?= $vbl[26] ?></p>
								</div>
							</div>
						</div>

						<div class="accordion_container">
							<div class="accordion d-flex flex-row align-items-center"><div><?= $vbl[27] ?></div></div>
							<div class="accordion_panel">
								<div>
									<p><?= $vbl[28] ?></p>
								</div>
							</div>
						</div>

                        <div class="accordion_container">
                            <div class="accordion d-flex flex-row align-items-center"><div><?= $vbl[29] ?></div></div>
                            <div class="accordion_panel">
                                <div>
                                    <p><?= $vbl[30] ?></p>
                                </div>
                            </div>
                        </div>

					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
    <?php
    include __DIR__."/includes/footer.php";
    ?>
</div>
<script src="js/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function(){
        $("#nameToCheck").on('keyup', function(){
            var nameToCheckValue = $(this).val();

            if(nameToCheckValue != ''){
                $(".generateBtn").removeAttr('disabled');
                $(".generateBtn").css("cursor", "pointer")
                                 .css("opacity", "1.0");
            } else {
                $(".generateBtn").attr('disabled','disabled');
                $(".generateBtn").css("cursor", "not-allowed")
                                 .css("opacity", "0.5");
            }
        });
    });

    /**
     * Generate function code
     * @returns {boolean}
     */
    function checkName(){
        var nameToCheck = $("#nameToCheck").val();
        $('#errorText').empty();

        try {

            $.ajax({
                url:"ajax/checkName.php",
                type:"POST",
                dataType: "JSON",
                data:{"nameToCheck":nameToCheck},
                success:function(data){
                    if(data.success == 1 && data.nameData != ""){
                        $("#responseText").append(data.nameData);
                        $(".responseContainer").show();
                        $(".generateBtn").hide();
                    } else {
                        console.log('error 332');
                    }

                    // $("select#senderId").html($.trim(data));

                },
                error:function(error){
                    console.error("its a error");
                    console.error(error);
                    if(error.responseText){
                        $('#errorText').append(error.responseText);
                    }
                }
            });
            return false;

        } catch (error) {
            console.error(error);
            // Expected output: ReferenceError: nonExistentFunction is not defined
            // (Note: the exact output may be browser-dependent)
        }
    }
</script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="js/custom.js"></script>
</body>
</html>