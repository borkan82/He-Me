<?php
/**
 * Created by PhpStorm.
 * User: Lenovo Y520
 * Date: 3/14/2021
 * Time: 4:30 PM
 */

?>

<nav class="main_nav_contaner ml-auto">
    <ul class="main_nav">
        <li class="active"><a href="index.php<?= $linkExt ?>"><?= $vbl[41] ?></a></li>
        <li><a href="about.php<?= $linkExt ?>"><?= $vbl[96] ?></a></li>
        <li><a href="services.php<?= $linkExt ?>"><?= $vbl[97] ?></a></li>
        <li><a href="prices.php<?= $linkExt ?>"><?= $vbl[98] ?></a></li>
        <li><a href="contact.php<?= $linkExt ?>"><?= $vbl[99] ?></a></li>
    </ul>
<!--    <div class="search_button"><i class="fa fa-search" aria-hidden="true"></i></div>-->

    <!-- Hamburger -->

    <div class="hamburger menu_mm">
        <i class="fa fa-bars menu_mm" aria-hidden="true"></i>
    </div>
</nav>
