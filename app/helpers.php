<?php

function lang_url($url = '/')
{
    $supportedLocales = Config::get('app.locales');
    $currentLang = Config::get('app.locale'); // get used locale 
    $defaultLang = Config::get('app.defaultLocale'); // get default locale 

    if ($defaultLang != $currentLang) {
        $url = $currentLang . '/' . $url;
    }
    return url($url);
}

function stringToUrl($string)
{
    return mb_ereg_replace('[^\w\s]', '', $string);
}
