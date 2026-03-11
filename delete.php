<?php
require 'config.php';

if(isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];

    if($type == "consultation"){
        $stmt = $pdo->prepare("DELETE FROM consultations WHERE consultation_id = ?");
        $stmt->execute([$id]);
        header("Location: hospital.php?page=consultations");
    }

    if($type == "patient"){
        $stmt = $pdo->prepare("DELETE FROM consultations WHERE patient_id = ?");
        $stmt->execute([$id]);
        
        $stmt = $pdo->prepare("DELETE FROM patients WHERE patient_id = ?");
        $stmt->execute([$id]);
        header("Location: hospital.php?page=patients");
    }
    
    exit();
}
?>