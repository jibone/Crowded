<?php
// 
//  index.php
//  Project Crowded
//  
//  Created by J Shamsul Bahri on 2011-08-29.
//  Copyright 2011 jShamsul.com. All rights reserved.
// 


// -- load required files ---------------------------*/
require_once 'system/Slim/Slim.php';
require_once 'system/Savant3/Savant3.php';
require_once 'system/Kirby/kirby.php';
require_once 'system/Kirby/plugins/remote.php';


// -- initiate config files -------------------------*/
require_once 'config.php';


// -- initiate app ----------------------------------*/
$app = new Slim();
$tpl = new Savant3();


// -- set template settings -------------------------*/
$tpl->dir = "templates/savant/";
$tpl->path = $tpl->dir ."layout.tpl.php";
$tpl->base_url = substr($_SERVER['PHP_SELF'], 0, -9);


// -- start app -------------------------------------*/
$app->get('/', function () use ($tpl) {
	
	$tpl->window_title = "Crowded";
	$tpl->page_content = "dashboard";
	
	$tpl->display($tpl->path);
	
});

$app->get('/venue/:venue_id', function ($venue_id) use ($app, $tpl) {
	
	// -- get venue data
	$id = c::get('4sq_id');
	$secret = c::get('4sq_secret');
	$url = "https://api.foursquare.com/v2/venues/". $venue_id ."?client_id=". $id ."&client_secret=". $secret;
	$data = remote::get($url);

	if($data['status'] == 'error') {
		$tpl->error = true;
		$tpl->window_title = "Error...";
	} else {
		$tpl->data = json_decode($data);
		$tpl->window_title = "Venue information: ". $tpl->data->response->venue->name;
		$tpl->error = false;
	}
	
	
	$tpl->page_content = "venue";
	$tpl->display($tpl->path);
	
});

// -- fetch trending places from 4sq
$app->get('/4sq/trending/:lat/:long', function ($lat, $long) use ($app, $tpl) {
	
	$id = c::get('4sq_id');
	$secret = c::get('4sq_secret');	
	$url = "https://api.foursquare.com/v2/venues/trending?ll=".$lat.",".$long."&limit=50&radius=2000&client_id=". $id ."&client_secret=". $secret;
	$data = remote::get($url);
	
	header("Content-Type: application/json");
	echo json_encode($data);
	
});

$app->run();

/* -- helpers functions -----------------------------*/