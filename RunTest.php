<?php 

$con = mysqli_connect('localhost','root','','myshop');

if (!$con) {
  die('Please Check Your Connection'.mysqli_error());
}

?>
<?php
function shortestpath($graph_array, $source, $target) {
    $vertices = array();
    $neighbours = array();
    foreach ($graph_array as $edge) {
        array_push($vertices, $edge[point1], $edge[point2]);
        $neighbours[$edge[point1]][] = array("end" => $edge[point2], "cost" => $edge[cost]);
        $neighbours[$edge[point2]][] = array("end" => $edge[point1], "cost" => $edge[cost]);
    }
    $vertices = array_unique($vertices);
 
    foreach ($vertices as $vertex) {
        $dist[$vertex] = INF;
        $previous[$vertex] = NULL;
    }
 
    $dist[$source] = 0;
    $Q = $vertices;
    while (count($Q) > 0) {
 
        // TODO - Find faster way to get minimum
        $min = INF;
        foreach ($Q as $vertex){
            if ($dist[$vertex] < $min) {
                $min = $dist[$vertex];
                $u = $vertex;
            }
        }
 
        $Q = array_diff($Q, array($u));
        if ($dist[$u] == INF or $u == $target) {
            break;
        }
 
        if (isset($neighbours[$u])) {
            foreach ($neighbours[$u] as $arr) {
                $alt = $dist[$u] + $arr["cost"];
                if ($alt < $dist[$arr["end"]]) {
                    $dist[$arr["end"]] = $alt;
                    $previous[$arr["end"]] = $u;
                }
            }
        }
    }
    $path = array();
    $u = $target;
    while (isset($previous[$u])) {
        array_unshift($path, $u);
        $u = $previous[$u];
    }
    array_unshift($path, $u);
    return $path;
}
 $sql = "SELECT * FROM points";
$result = mysqli_query($con, $sql);
$graph_array = array();
if (mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $graph_array[] = $row;

    }
 }


$query1 = mysqli_query($con, "SELECT * FROM routes WHERE status='1' ") or die (mysqli_error());

 while ($row = mysqli_fetch_array($query1)) {
       
     $path = shortestpath($graph_array, $row['origin'], $row['destination']);//origin to destination
 
    ?>
     
   <?php  } ?>
   <?php
      
header('Content-type: application/json');
echo json_encode(("The Shortest Route is: ".implode(", ", $path).""));
print_r(json_encode($path, JSON_PRETTY_PRINT));
echo "points:";
print_r(json_encode($graph_array, JSON_PRETTY_PRINT));
?>
