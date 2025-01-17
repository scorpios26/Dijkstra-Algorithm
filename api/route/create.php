<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Route.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Route($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $post->origin = $data->origin;
  $post->destination = $data->destination;
  $post->status = $data->status=0;
  
  // Create post
  if($post->create()) {
    echo json_encode(
      array('message' => 'Route Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Route Not Created')
    );
  }
