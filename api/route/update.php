<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Route.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $route = new Route($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $route->id = $data->id;

  $route->origin = $data->origin;
  $route->destination = $data->destination;
  $route->status = $data->status;

  // Update post
  if($route->update()) {
    echo json_encode(
      array('message' => 'Route Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Route not updated')
    );
  }
