<?php
require 'config.php';

$stmt = $pdo->query("SELECT * FROM patients ORDER BY patient_id ASC");
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("
    SELECT consultations.consultation_id, 
           patients.full_name, 
           patients.age,
           patients.gender,
           patients.contact_number,
           consultations.doctor_name,
           consultations.consultation_date,
           consultations.diagnosis,
           consultations.treatment,
           consultations.patient_id
    FROM consultations 
    INNER JOIN patients ON consultations.patient_id = patients.patient_id 
    ORDER BY consultations.consultation_id DESC
");
$stmt->execute();
$consultations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>