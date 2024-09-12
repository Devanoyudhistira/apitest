<?php


header("Access-Control-Allow-Origin");
header("Content-Type:application/json");
header("Access-Control-Allow-Method:GET");
header("Access-Control-Allow-Headers:content-Type,Access-Control-Allow-Header,Authorization,X-Request-Width");

$connect = mysqli_connect("localhost", "root", "", "devapic");

$getall = mysqli_query($connect, "SELECT * FROM gallery");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $data = [
    "status-code" => 200,
    "massage" =>  "data berhasil didapatkan",
    "data" => []
  ];
  while ($row = mysqli_fetch_assoc($getall)) {
    $data["data"][] = $row;
  }

  header("HTTP/1.0 200 $data[massage]");
  echo json_encode($data);
} else {
  $datagagal = [
    "data" => "sir method is not allowed",
    "status-code" => 405
  ];
  header("HTTP/1.0 500 Internal Server Error");
  echo json_encode($datagagal);
}
