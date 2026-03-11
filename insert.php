<?php
require 'config.php';

if (isset($_POST['submit_patient'])) {
    $full_name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact_number'];

    $sql = "INSERT INTO patients (full_name, age, gender, contact_number) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$full_name, $age, $gender, $contact_number]);

    header("Location: hospital.php?page=patients");
    exit();
}

if (isset($_POST['submit_consultation'])) {
    $patient_id = $_POST['patient_id'];
    $doctor_name = $_POST['doctor_name'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $consultation_date = $_POST['consultation_date'];

    $sql = "INSERT INTO consultations (patient_id, doctor_name, diagnosis, treatment, consultation_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$patient_id, $doctor_name, $diagnosis, $treatment, $consultation_date]);

    header("Location: hospital.php?page=consultations");
    exit();
}
?>