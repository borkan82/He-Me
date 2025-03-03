<?php
$title = "HE-ME: Send Secret Messages & Secure Passwords - Privacy";
include __DIR__."/includes/config.php";
include __DIR__."/includes/rateLimiter.php";
require __DIR__."/includes/header.php";
include __DIR__."/includes/DbPDO.php";

//SETUP
$langId = 1;
$pageId = 5;

$dbpdo           = new DbPDO();
$getLanguage     = $dbpdo->fetchOne("SELECT * FROM secret_languages WHERE `language_code` = '". $lang ."'");
if(!empty($getLanguage)){
    $langId = $getLanguage['id'];
}
$pageTranslation = $dbpdo->fetchOne("SELECT * FROM secret_translations WHERE `language_id` = ". $langId ." AND `page_id` = ". $pageId);
?>
<style>
    .home {
        height:auto;
    }
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

    .super_container {
        overflow: auto;
    }
    a {
        color: #232525;
        text-decoration: none;
    }

    a:hover {
        color: #e15900;
        text-decoration:none;
        cursor:pointer;
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
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-sm-8" style="margin-top:160px;margin-bottom: 50px;padding-left:25px;padding-right:25px;">
                    <h4><span class="site_links"><a href="<?= URL ?>"><?= $vbl[14] ?></a></span></h4><br>
                    <?php
                    if(!empty($pageTranslation['text'])) {
                        echo $pageTranslation['text'];
                    } else {
                        echo "<h3>".$vbl[15]."</h3>";
                    }
                    ?>
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
</script>
<script src="<?= URL ?>styles/bootstrap4/popper.js"></script>
<script src="<?= URL ?>styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?= URL ?>plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?= URL ?>plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?= URL ?>js/custom.js"></script>
</body>
</html>