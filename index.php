<?php

require_once('./vendor/autoload.php');
require_once('./DBconnection.php');
session_start();
$loader = new \Twig\Loader\FilesystemLoader('./templates');
$twig = new \Twig\Environment($loader
	// , ['cache' => './compilation_cache',]
);
$username = '';
if ($_SESSION && array_key_exists('username', $_SESSION)) {
	$username = $_SESSION['username'];
}

$db_conn = new DBconnection();

if (array_key_exists('url', $_GET)&&$_GET['url']) {
	$url = $_GET['url'];
	$p_array = explode('/', $url);
	if (!file_exists($p_array[0] . '.php')) {
		echo "Sorry, wrong route";
		exit;
	}

	require_once($p_array[0] . '.php');
	$handle_obj = new $p_array[0]($db_conn, $twig, $username);
	if (array_key_exists(1, $p_array)) {
		$method = $p_array[1] . 'Method';
	} else {
		$method = 'indexMethod';
	}

	if (array_key_exists(2, $p_array)) {
		echo $handle_obj->$method($p_array[2]);
	} else {
		echo $handle_obj->$method();
	}	

	exit();
}




// Main page generation

$animes = $db_conn->getAllAnime();
$categories = $db_conn->getAllCategories();

$new_category = array(
	0 => 'All'
);
foreach ($categories as $category) {
	$new_category += array($category['id'] => $category['name']);
}



try {
	echo $twig->render(
		'index.html.twig', 
		array(
			'name' => 'RateMyAnime',
			'animes' => $animes,
			'categories' => $new_category,
			'c_id' => 0,
			'username' => $username 
			)
	);	
}
catch (Exception $e) {
	echo $e->getMessage();
}


