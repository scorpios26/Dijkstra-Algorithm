<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Points.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Points($db);

  // Get ID
  $post->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $post->read_single();

  // Create array
  $post_arr = array(
    'id' => $post->id,
    'point1' => $post->point1,
    'point2' => $post->point2,
    'created_at' => $post->created_at
   
  );

  // Make JSON
  print_r(json_encode($post_arr));