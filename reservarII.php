<?php
require_once 'db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Definir los encabezados de la respuesta JSON
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Verificar que se haya enviado un método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los datos de la reserva desde la solicitud POST
  $nombre = $_POST['nombre'];
  $fecha_hora = $_POST['fecha_hora'];
  //$admi = $_POST['admi'];

  // Verificar si la reserva ya existe en la base de datos
  $existingReservations = $conn->query("SELECT * FROM reservas2 WHERE fecha_hora = '$fecha_hora'");

  if ($existingReservations->num_rows > 0) {
    echo json_encode(array("mensaje" => "Ya existe una reserva con la misma fecha y hora"));
  } else {
    // Insertar la nueva reserva en la base de datos
    $sql = "INSERT INTO reservas2 (nombre, fecha_hora) VALUES ('$nombre', '$fecha_hora')";
    if ($conn->query($sql) === TRUE) {
      echo json_encode(array("mensaje" => "Reserva agregada correctamente"));
    } else {
      echo json_encode(array("mensaje" => "Error al agregar la reserva: " . $conn->error));
    }
  }
}
?>
