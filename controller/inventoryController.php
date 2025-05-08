<?php

session_start();
include '../config/db.php';

$error_message = '';
$success_message = '';

$stmt = $conn->prepare("SELECT * FROM inventory");
$stmt->execute();
$parts = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Add inventory
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_inventory'])) {
    $part_name = $_POST['part_name'];
    $brand = $_POST['brand'];
    $stocks = $_POST['stocks'];
    $cost =  $_POST['cost'];
    $supplier = $_POST['supplier'];

    if (empty($part_name) || empty($brand) || empty($stocks) || empty($stocks) || empty($cost) || empty($supplier)) {
        $_SESSION['error_message'] = 'Fill in the blanks';
        header("Location: ../views/inventory");
        exit;
    } 
    
    else {
        $stmt = $conn->prepare("INSERT INTO inventory (part_name, brand, stocks, cost, supplier)
                                VALUES (:part_name, :brand, :stocks, :cost, :supplier)");
        $stmt->bindParam(':part_name', $part_name);
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':stocks', $stocks);
        $stmt->bindParam(':cost', $cost);
        $stmt->bindParam(':supplier', $supplier);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Inventory part added successfully';
            header("Location: ../views/inventory");
            exit;
        } 
        
        else {
            $_SESSION['error_message'] = 'There was an error. Please try again.';
        }
    }

    header("Location: ../views/inventory");
    exit;
}

//Edit inventory
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edit_inventory'])) {
    $id = $_POST['id'];
    $part_name = $_POST['part_name'];
    $brand = $_POST['brand'];
    $stocks = $_POST['stocks'];
    $cost =  $_POST['cost'];
    $supplier = $_POST['supplier'];

    if ($stmt->execute()) {
        $stmt = $conn->prepare("UPDATE inventory SET part_name = :part_name, brand = :brand, stocks = :stocks, 
                                cost = :cost, supplier = :supplier WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':part_name', $part_name);
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':stocks', $stocks);
        $stmt->bindParam(':cost', $cost);
        $stmt->bindParam(':supplier', $supplier);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Inventory part updated successfully';
            header("Location: ../views/inventory");
            exit;
        } 
        
        else {
            $_SESSION['error_message'] = 'There was an error. Please try again.';
        }
    }

    header("Location: ../views/inventory");
    exit;
}

//Delete button
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];

    $stmt = $conn->prepare("DELETE FROM inventory WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()){
        $_SESSION['success_message'] = 'Inventory part deleted successfully';
        header("Location: ../views/inventory");
        exit;
    }

    else {
        $_SESSION['error_message'] = 'There was an error. Please try again.';
    }

    header("Location: ../views/inventory");
    exit;
}

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}