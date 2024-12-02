<?php
// actualizar_stock.php

// Establecer conexión con la base de datos
$host = 'localhost';
$dbname = 'marcosweb';
$username = 'root';
$password = 'G@bo1007';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}

// Obtener los datos enviados desde el frontend
$data = json_decode(file_get_contents('php://input'), true);
$productName = $data['productName']; // nombre del producto
$quantityPurchased = $data['quantityPurchased']; // cantidad comprada

// Verificar que el producto exista y obtener el stock actual
$sql = "SELECT Stock FROM producto WHERE nombre_producto = :productName";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':productName', $productName);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Si el producto existe y hay suficiente stock
if ($product && $product['Stock'] >= $quantityPurchased) {
    // Actualizar el stock del producto
    $sql = "UPDATE producto SET Stock = Stock - :quantity WHERE nombre_producto = :productName";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':quantity', $quantityPurchased);
    $stmt->bindParam(':productName', $productName);
    $result = $stmt->execute();

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'mensaje' => 'Error al actualizar el stock']);
    }
} else {
    // Si no hay suficiente stock
    echo json_encode(['success' => false, 'mensaje' => 'No hay suficiente stock']);
}
?>
