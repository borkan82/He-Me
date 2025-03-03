<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
    <ul class="top_bar_contact_list">
        <li><div class="question"><?= $vbl[0] ?></div></li>
        <li>
            <div><?= $vbl[1] ?></div>
        </li>
        <li>
            <div><?= $vbl[2] ?></div>
        </li>
    </ul>
    <div class="top_bar_login ml-auto">
        <div class="language" onclick="toggleLanguageBox();" style="cursor:pointer;">
            <span class="languageSelectionCode"><?= $lang ?></span>
        </div>
    </div>
</div>
<div id="language-box" class="language-box">
    <div id="language-list" class="language-list">
        <div class="language-item" onclick="changeLanguage('EN');">English</div>
        <div class="language-item" onclick="changeLanguage('FR');">French</div>
        <div class="language-item" onclick="changeLanguage('DE');">German</div>
        <div class="language-item" onclick="changeLanguage('IT');">Italian</div>
        <div class="language-item" onclick="changeLanguage('ES');">Spanish</div>
    </div>
</div>