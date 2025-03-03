<?php
include __DIR__."/includes/config.php";
include __DIR__."/includes/rateLimiter.php";

echo __DIR__."\includes\header.php";
$title = "HE-ME Secret";
require __DIR__."/includes/header.php";
include __DIR__."/includes/DbPDO.php";

$dbpdo = new DbPDO();

$secureCodeText = false;
if (isset($_GET['secureCodeText'])) {
    $secureCodeText = htmlspecialchars($_GET['secureCodeText']);
}
$secureRequests = $dbpdo->fetchOne("SELECT * FROM secret_requests WHERE `code` LIKE '".$secureCodeText."' AND active = 1");

$secureTextFound = false;
if(!empty($secureRequests)){
    $text = $secureRequests['secret_text'];
    $secureTextFound = true;
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
        width: 200px;
    }
    .revealBtn {
        margin:5px;
        width:50%;
    }
    .checkedGreen {
        color: #2ec92e;
        background-color: #d6f8d6;
    }
    .info-message {
        font-size: 1.7em;
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
										<div class="logo_img"><img src="<?= URL ?>images/logo.png" alt=""></div>
										<div class="logo_text"></div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

    <!-- Home -->

    <div class="home">
        <div class="home_slider_container">
              <div class="home_container">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <!-- Home Slider Nav -->
                                    <div class="featured_container_answer justify-content-center align-items-center">
                                        <?php
                                        if($secureTextFound){
                                        ?>
                                        <div class="revealBtnHolder">
                                            <div style="margin-bottom:30px;">
                                                <span class="info-message"><?= $vbl[26] ?></span><br>
                                            </div>

                                            <div class=" featured_header  flex-row align-items-center justify-content-startd-flex flex-row align-items-center justify-content-center">
                                                <button type="button" class="featured_tag revealBtn" onclick="revealCode();" style="margin:0 auto;display:block;cursor:pointer;width:500px;"><?= $vbl[12] ?> <i class="fas fa-arrow-right"></i></button>
                                                <div style="clear: both;"></div>
                                                <p style="margin: 0 auto;display: block;width: 500px;"><?= $vbl[13] ?></p>
                                            </div>
                                        </div>

                                        <div class="secretTextHolder row" style="display:none;">
                                            <div class="col-lg-12 featured_col ">
                                                <div class="featured_content justify-content-center align-items-center" style="border-radius: 10px 10px 0px 0px;">
                                                    <p><?= $vbl[7] ?></p>
                                                    <input type="hidden" id="tempCode" value="<?= $secureCodeText?>">
                                                    <textarea id="secretText" style="width:100%;padding: 10px;height:100px" placeholder="" disabled><?= $text ?></textarea>
                                                    <button id="copyTextBtn" onclick="copyTextToClipboard()" style="width:120px;cursor:pointer;margin-top: -25px;" title="<?= $vbl[25] ?>">
                                                        <svg id="copyTextIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                        </svg>
                                                        <svg display="none" id="checkedIcon" xmlns="http://www.w3.org/2000/svg" class="checkedGreen" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    </button>
                                                    <div class="featured_footer d-flex align-items-center justify-content-start">
                                                        <span class="info-message">This message will be printed only once and then destroyed. Be sure to read it.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        } else {
                                        ?>

                                            <div class="featured_content justify-content-center align-items-center" style="border-radius: 10px 10px 0px 0px;">
                                                <p style="font-size: 2em;color: #ff5e00;"><?= $vbl[8] ?></p>
                                                <br><br>
                                                <p>
                                                    <strong><?= $vbl[38] ?></strong><br>
                                                    <?= $vbl[39] ?><br>
                                                    <?= $vbl[40] ?><br>
                                                </p>
                                                <p style="font-size: 1.0em;">
                                                    <?= $vbl[41] ?>
                                                </p>
                                            </div>

                                        <?php
                                        }
                                        ?>
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
<script>
    function revealCode(){
        $('.revealBtnHolder').hide();
        $('.secretTextHolder').show();

        var secretCode = $("#tempCode").val();
        $.ajax({
            url:"../ajax/revealCode.php",
            type:"POST",
            dataType: "JSON",
            data:{"secretCode":secretCode},
            success:function(data){
                if(data.success == 1){

                }
            }
        });
        return false;


    }

    $(document).ready(function(){
        $('.revealBtn').click(function (){
            revealCode();
        });
    });

    function copyTextToClipboard(){
        var $tempInput = $('<input>');
        var textValue = $('#secretText').val();

        $tempInput.val(textValue);
        $('body').append($tempInput);
        $tempInput.select();
        document.execCommand("copy");
        $tempInput.remove();

        // Change state of icons
        $("#copyTextIcon").hide();
        $("#checkedIcon").show();
    }
</script>

<script src="<?= URL ?>js/jquery-3.2.1.min.js"></script>
<script src="<?= URL ?>styles/bootstrap4/popper.js"></script>
<script src="<?= URL ?>styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?= URL ?>plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?= URL ?>plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?= URL ?>js/custom.js"></script>
</body>
</html>