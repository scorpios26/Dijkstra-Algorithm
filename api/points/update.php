<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Points.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Points($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $post->id = $data->id;

  $post->point1 = $data->point1;
  $post->point2 = $data->point2;
  $post->cost = $data->cost;

  // Update post
  if($post->update()) {
    echo json_encode(
      array('message' => 'Points Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Points Not Updated')
    );
  }

