<?php
require_once 'db.php';

// Permitir solicitudes desde localhost:3000
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Verificar si se recibió la fecha y hora como parámetro
if (isset($_GET['fecha_hora'])) {
  $fecha_hora = $_GET['fecha_hora'];

  // Verificar si ya existe una reserva con la misma fecha y hora
  $existingReservation = $conn->query("SELECT * FROM reservas WHERE fecha_hora = '$fecha_hora'");

  if ($existingReservation->num_rows > 0) {
    echo json_encode(array("existe" => true));
  } else {
    echo json_encode(array("existe" => false));
  }
} else {
  echo json_encode(array("existe" => false));
}
?>
