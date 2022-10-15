<?php
require __DIR__ . '/simple_html_dom.php';
require __DIR__ . '/Bot.php';

$bot = new Bot($token, $username);

$bot->start("Tulis kalimat yang mau Anda cari");

$bot->text(function ($katakunci) {
    $s = urlencode($katakunci);
    $url = "\x68\x74\x74\x70\x73";
    $url .= "\x3A\x2F\x2F";
    $url .= "\x6B\x69\x74\x61\x62\x68\x61\x64\x69\x73";
    $url .= "\x2E\x77\x6F\x72\x64\x70\x72\x65\x73\x73";
    $url .= "\x2E\x63\x6F\x6D";
    $url .= "\x2F\x3F\x73\x3D";
    $url .= $s;
    return extract_text($url, $katakunci);
});

$bot->run();

function kirimtext($text){
    Bot::sendMessage($text, ['parse_mode'=>'html', 'disable_web_page_preview'=>true]);
}

function extract_text($html, $katakunci){
    $html = file_get_html($html);
    $text = "";
    $hasils = $html->find('h1');
    $links = $html->find('a');
    foreach ($hasils as $hasil) {
        $innertext = strip_tags($hasil->innertext, '<a>');
        $text .= $innertext."\n\n";
    }
    if(strlen($text)>4096){
        $text = substr($text, 0, 4096);
    }
    kirimtext($text);

    foreach($links as $link){
        $href = $link->href;
        $cek = strpos($link->outertext, 'Pos-pos Lebih Lama');
        if($cek !== false){
            extract_text($href, $katakunci);
        }
    }
}

