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
    $onlyLetters = mb_ereg_replace('[^\\p{L}\s]', '', $string);
    $onlyLetters = preg_replace('/([\s])\1+/', ' ', $onlyLetters);
    $onlyLetters = preg_replace('/\s/', '-', trim($onlyLetters));
    return $onlyLetters;
}

function getSameUrlInOtherLang($toLang)
{
    $request = request();
    $segments = $request->segments();
    foreach (Config::get('app.locales') as $locale) {
        if (($key = array_search($locale, $segments)) !== false) {
            unset($segments[$key]);
        }
    }
    if ($toLang != Config::get('app.defaultLocale')) {
        array_unshift($segments, $toLang);
    }
    return implode('/', $segments);
}
