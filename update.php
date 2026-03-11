<?php
require 'config.php';

if(isset($_POST['update_consultation'])) {
    $stmt = $pdo->prepare("UPDATE consultations SET patient_id = ?, doctor_name = ?, diagnosis = ?, treatment = ?, consultation_date = ? WHERE consultation_id = ?");
    $stmt->execute([
        $_POST['patient_id'],
        $_POST['doctor_name'],
        $_POST['diagnosis'],
        $_POST['treatment'],
        $_POST['consultation_date'],
        $_POST['consultation_id']
    ]);
    header("Location: hospital.php?page=consultations");
    exit();
}

if(isset($_POST['update_patient'])) {
    $stmt = $pdo->prepare("UPDATE patients SET full_name = ?, age = ?, gender = ?, contact_number = ? WHERE patient_id = ?");
    $stmt->execute([
        $_POST['full_name'],
        $_POST['age'],
        $_POST['gender'],
        $_POST['contact_number'],
        $_POST['patient_id']
    ]);
    header("Location: hospital.php?page=patients");
    exit();
}
?>