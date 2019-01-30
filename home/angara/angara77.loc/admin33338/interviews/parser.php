<?php
$d = new DOMDocument;
$mock = new DOMDocument;
$d->loadHTML(file_get_contents('https://hh.ru/resume/8ec2629a0002478cd2000a28e17430654a5043?fromResponsesPage=true&vacancyId=25700753&resumeId=38243538&t=1144933121&page=0&collection=response&print=true'));
$body = $d->getElementsByTagName('body')->item(0);
foreach ($body->childNodes as $child){
    $mock->appendChild($mock->importNode($child, true));
}

echo $mock->saveHTML();