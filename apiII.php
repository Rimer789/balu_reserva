<?php
require_once 'db.php';

// Definir los encabezados de la respuesta JSON
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Función para obtener las reservas de la tabla "reservas"
function getReservas() {
  eliminarReservasExpiradas();
  global $conn;
  $today = date("Y-m-d");
  $sql = "SELECT * FROM reservas2 WHERE DATE(fecha_hora) = CURDATE()";
  $result = $conn->query($sql);
  $reservas = array();
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $reservas[] = $row;
    }
  }
  return $reservas;
}

function eliminarReservasExpiradas() {
  global $conn;
  $sql = "DELETE FROM reservas2 WHERE fecha_hora < (NOW() - INTERVAL 10 MINUTE)";
  $conn->query($sql);
}

// Ruta para la API
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $reservas = getReservas();
  echo json_encode($reservas);
}
?>

