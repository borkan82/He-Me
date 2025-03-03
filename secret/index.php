<?php
/**
 * @TODO
 * Uputstvo za oranz dugme da se klikne
 * Poruka mora biti boldovana
 */
//  https://www.freeprivacypolicy.com/free-cookie-consent/   COOOOKIEEE BANNNEER
$title = "HE-ME: Send One-Time Secret Messages & Secure Passwords";
include "includes/config.php";
include INC."header.php";
include INC."DbPDO.php";
include CLASS_PATH."SecretRequests.php";
include CLASS_PATH."Geolocation.php";
include CLASS_PATH."VisitorsLog.php";

$dbpdo              = new DbPDO();
$Secretrequests     = new SecretRequests($dbpdo);
$Geolocation        = new GEOLOCATION();
$VisitorsLog        = new VisitorsLog($dbpdo);

$agent  = !empty($_SERVER['HTTP_USER_AGENT']) ? addslashes($_SERVER['HTTP_USER_AGENT']) : '';
$ip     = $Secretrequests->getIpAddress();
$VisitorsLog->insertVisitor(['ip'=>$ip, 'agent'=>$agent, 'site'=>'SECRET']);

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
        flex: 1;
        padding: 5px;
        height: 30px;
        width: 50%
    }
    .input-container select {
        margin-right: 20px;
        padding: 5px;
        height: 30px;
        width: 300px;
    }
    .generateBtn {
        margin:5px;
        width:70%;
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
                                    <div class="textarea-container justify-content-center align-items-center">
                                        <textarea id="secretText" style="width:100%;padding: 10px;height:100px" maxlength="10000" placeholder="<?= $vbl[10] ?>"></textarea>
                                        <div id="charCounter" class="char-counter">0 / 10000</div>
                                    </div>
                                    <div class="input-container justify-content-center align-items-center" style="margin-bottom: 5px;">
                                        <select id="expirationPeriod">
                                            <option value="1"><?= $vbl[19] ?></option>
                                            <option value="3"><?= $vbl[20] ?></option>
                                            <option value="5" selected><?= $vbl[21] ?></option>
                                            <option value="7"><?= $vbl[22] ?></option>
                                            <option value="14"><?= $vbl[23] ?></option>
                                            <option value="30"><?= $vbl[24] ?></option>
                                        </select>
                                    </div>
                                    <div class="input-container justify-content-center align-items-center">
                                        <i class="fas fa-link"></i>
                                        <input type="text" id="secretLink" placeholder="https://secret.he-me.com/secure/**********" disabled>
                                        <button id="copyTextBtn" onclick="copyTextToClipboard()" style="width:100px;cursor:pointer;display: none;" title="<?= $vbl[25] ?>">
                                            <svg display="none" id="copyTextIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                            <svg display="none" id="checkedIcon" xmlns="http://www.w3.org/2000/svg" class="checkedGreen" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="featured_header d-flex flex-row align-items-center justify-content-startd-flex flex-row align-items-center justify-content-center">
										<button type="button" class="featured_tag generateBtn" onclick="generateCode();" style="cursor:not-allowed" disabled><?= $vbl[11] ?></button>
									</div>
									<div class="featured_header d-flex flex-row align-items-center justify-content-startd-flex flex-row align-items-center justify-content-center">
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
					<div class="grouped_title"><?= $vbl[27] ?></div>
					<div class="accordions">
						<div class="accordion_container">
							<div class="accordion d-flex flex-row align-items-center active"><div><?= $vbl[28] ?></div></div>
							<div class="accordion_panel">
								<div>
									<p><?= $vbl[29] ?></p>
								</div>
							</div>
						</div>

						<div class="accordion_container">
							<div class="accordion d-flex flex-row align-items-center"><div><?= $vbl[30] ?></div></div>
							<div class="accordion_panel">
								<div>
									<p><?= $vbl[31] ?></p>
								</div>
							</div>
						</div>

						<div class="accordion_container">
							<div class="accordion d-flex flex-row align-items-center"><div><?= $vbl[32] ?></div></div>
							<div class="accordion_panel">
								<div>
									<p><?= $vbl[33] ?></p>
								</div>
							</div>
						</div>

						<div class="accordion_container">
							<div class="accordion d-flex flex-row align-items-center"><div><?= $vbl[34] ?></div></div>
							<div class="accordion_panel">
								<div>
									<p><?= $vbl[35] ?></p>
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
        /**
         * Copy click
         */
        $("#copyTextIcon").click(function(){
            $(this).hide();
            $("#checkedIcon").hide();
        });

        var maxLength = $("#secretText").attr("maxlength");

        // Update the character count initially
        $("#charCounter").text(0 + " / " + maxLength);

        $("#secretText").on('keyup', function(){
            var secretTextValue = $(this).val();

            if(secretTextValue != ''){
                console.log(secretTextValue);
                $(".generateBtn").removeAttr('disabled');
                $(".generateBtn").css("cursor", "pointer")
                                 .css("opacity", "1.0");
            } else {
                console.log("nemanista");

                $(".generateBtn").attr('disabled','disabled');
                $(".generateBtn").css("cursor", "not-allowed")
                                 .css("opacity", "0.5");
            }

            var currentLength = $(this).val().length;
            $("#charCounter").text(currentLength + " / " + maxLength);
        });
    });

    /**
     * Generate function code
     * @returns {boolean}
     */
    function generateCode(){
        var secretText = $("#secretText").val();
        var expirationPeriod = $("#expirationPeriod").val();
        $('#errorText').empty();

        try {

            $.ajax({
                url:"ajax/generateCode.php",
                type:"POST",
                dataType: "JSON",
                data:{"secretText":secretText,"expirationPeriod":expirationPeriod},
                success:function(data){
                    console.log(data);

                    if(data.success == 1 && data.secretLink != ""){
                        $("#secretLink").val(data.secretLink);
                        $(".generateBtn").hide();
                        $("#copyTextBtn").show();
                        $("#copyTextIcon").show();
                    } else {
                        console.log();
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

    /**
     * Function to copy all from textarea to clipboard
     */
    function copyTextToClipboard(){
        var $tempInput = $('<input>');
        var linkValue = $('#secretLink').val();

        $tempInput.val(linkValue);
        $('body').append($tempInput);
        $tempInput.select();
        document.execCommand("copy");
        $tempInput.remove();

        // Change state of icons
        $("#copyTextIcon").hide();
        $("#checkedIcon").show();
    }
</script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="js/custom.js"></script>
</body>
</html>