<?php
$base_url = 'http://www.modpix.com.au/';
$js = $base_url.'js/';
$css = $base_url.'css/';
$images = $base_url.'images/';

$fileUploadDirectory = $_SERVER['DOCUMENT_ROOT'].'/uploadedfile/';
$ProductUploadDirectory = $_SERVER['DOCUMENT_ROOT'].'/product/';
$ProductItemUploadDirectory = $_SERVER['DOCUMENT_ROOT'].'/product/item/';
$fileUploadUrl = $base_url.'uploadedfile/';
$dir = str_replace(chr(92),chr(47),getcwd());
$userprofile = $_SERVER['DOCUMENT_ROOT'].'/user/profile/';
$userprofile = str_replace(chr(92),chr(47),$userprofile);
?>