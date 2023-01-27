<?php
	require_once('../vendor/autoload.php');
	$base = '../mailings/';
	$components = $base . '/components/';
	$mailingsLetterLayouts = $base . '/letters/layouts/';
	$mailingsLetters = $base . '/letters/';
	$mailingsPostcards = $base . '/postcards/';
	$mailingsPostcardsLayouts = $base . '/postcards/layouts/';
	$loader = new Twig_Loader_Filesystem(array($base,$components,$mailingsLetterLayouts, $mailingsLetters, $mailingsPostcards, $mailingsPostcardsLayouts));
	$twig = new Twig_Environment($loader);
?>
