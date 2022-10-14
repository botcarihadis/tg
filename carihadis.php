<?php
require 'Bot.php';
$konten = file_get_contents("\x68\x74\x74\x70\x73\x3A\x2F\x2F\x6B\x69\x74\x61\x62\x68\x61\x64\x69\x73\x2E\x77\x6F\x72\x64\x70\x72\x65\x73\x73\x2E\x63\x6F\x6D\x2F\x3F\x73\x3D$katakunci");
preg_match_all('/<h1 class="entry-title">(.*)<\/h1>/i',$konten,$hasil);
$text = "Artikel tentang <b>".$katakunci."</b>:\n\n";
if(count($hasil[1])>0){
    foreach($hasil[1] as $no => $link){
    $no = $no+1;
    $text .= $no.". ".$link."\n\n";
    }
}else{
    $text .= "tidak ditemukan";
}
echo $text;
