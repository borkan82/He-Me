<?php
/**
 * Created by PhpStorm.
 * User: Lenovo Y520
 * Date: 3/14/2021
 * Time: 4:30 PM
 */
?>
<div class="container">
<div class="row d-flex justify-content-center align-items-center">
    <div class="col-sm-3 footer_links">
        <a href="<?= URL."index.php" ?>"><?= $vbl[16] ?></a> | <a href="<?= URL."about.php" ?>"><?= $vbl[17] ?></a> | <a href="<?= URL."privacy.php" ?>"><?= $vbl[18] ?></a>
    </div>
</div>
</div>

<footer class="footer">
<!--    <div class="cookieinfo">-->
<!--        <p class="cookie_text">--><?//= $vbl[102] ?><!--</p>-->
<!--        <button class="acceptCookieButton">--><?//= $vbl[103] ?><!--</button>-->
<!--    </div>-->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 footer_col">
                <div class="footer_about">
                    <div class="logo_container">
                        <a href="#">
                            <div class="logo_content d-flex flex-row align-items-end justify-content-start">
                                <div class="logo_img"><img src="images/logo.png" alt="He-me Logo"></div>
                                <div class="logo_text"></div>
                            </div>
                        </a>
                    </div>
<!--                    <div class="footer_social">-->
<!--                        <ul>-->
<!--                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>-->
<!--                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
                    <div class="copyright">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Website created by <i class="fa fa-heart-o" aria-hidden="true"></i> by Laurus<i>Studio</i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 footer_col">

            </div>
            <div class="col-lg-3 footer_col">

            </div>
        </div>
    </div>
</footer>
<script>
    function toggleLanguageBox() {
        const languageList = document.getElementById('language-box');
        languageList.classList.toggle('open');
    }

    function changeLanguage(langValue){
        // Get the current URL
        let currentUrl = new URL(window.location.href);
        // Set or update the 'lang' parameter
        currentUrl.searchParams.set('lang', langValue);
        // Reload the page with the updated URL
        window.location.href = currentUrl.toString();
    }
</script>