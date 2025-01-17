<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
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

  $post->point1 = $data->point1;
  $post->point2 = $data->point2;
  $post->cost = $data->cost;

  // Create post
  if($post->create()) {
    echo json_encode(
      array('message' => 'Points Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Points Not Created')
    );
  }

