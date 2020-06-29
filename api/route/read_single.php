<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Route.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $route = new Route($db);

  // Get ID
  $route->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $route->read_single();

  // Create array
  $route_arr = array(
    'id' => $route->id,
    'origin' => $route->origin,
    'destination' => $route->destination,
    'status' => $route->status
  );

  // Make JSON
  print_r(json_encode($route_arr));
