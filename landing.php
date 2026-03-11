<?php
require 'insert.php';
require 'update.php';
require 'delete.php';
require 'select.php';

$page = $_GET['page'] ?? 'consultations';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HealthyCare Hospital Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        
        .main-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .card-header {
            background: white;
            border-bottom: 2px solid #f0f0f0;
            padding: 1.5rem 1.5rem 0 1.5rem;
        }
        
        .nav-tabs {
            border-bottom: none;
        }
        
        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            margin-right: 10px;
            border-radius: 10px 10px 0 0;
            transition: all 0.3s ease;
        }
        
        .nav-tabs .nav-link:hover {
            color: #0d6efd;
            background: rgba(13, 110, 253, 0.05);
        }
        
        .nav-tabs .nav-link.active {
            color: #0d6efd;
            background: white;
            border-bottom: 3px solid #0d6efd;
            font-weight: 600;
        }
        
        .card-body {
            padding: 2rem;
        }
        
        .form-section {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            border: 1px solid #e9ecef;
        }
        
        .form-section h4 {
            color: #495057;
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-section h4 i {
            color: #0d6efd;
            font-size: 1.5rem;
        }
        
        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.6rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
        
        .btn {
            padding: 0.6rem 1.5rem;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-dark {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-dark:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-primary {
            background: #0d6efd;
        }
        
        .btn-primary:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }
        
        .btn-danger {
            background: #dc3545;
        }
        
        .btn-danger:hover {
            background: #bb2d3b;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }
        
        .btn-secondary {
            background: #6c757d;
        }
        
        .btn-secondary:hover {
            background: #5c636a;
        }
        
        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.875rem;
            border-radius: 8px;
            margin: 0 2px;
        }
        
        .table {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        
        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .table thead th {
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            padding: 1rem;
            border: none;
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
            transform: scale(1.01);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .table td {
            padding: 1rem;
            vertical-align: middle;
            font-weight: 400;
        }
        
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
        }
        
        .badge-success {
            background: #d1e7dd;
            color: #0f5132;
        }
        
        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }
        
        hr {
            margin: 2rem 0;
            border: 1px solid #e9ecef;
            opacity: 0.5;
        }
        
        .cancel-btn {
            background: #6c757d;
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .cancel-btn:hover {
            background: #5c636a;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }
        
        .total-amount {
            font-weight: 600;
            color: #198754;
        }
        
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }
            
            .table {
                font-size: 0.9rem;
            }
            
            .btn-sm {
                padding: 0.3rem 0.5rem;
                font-size: 0.8rem;
            }
        }
        
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem;
            margin-bottom: 1.5rem;
            animation: slideDown 0.5s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
        }
        
        .alert-danger {
            background: #f8d7da;
            color: #842029;
        }
        
        .alert-warning {
            background: #fff3cd;
            color: #856404;
        }
        
        .alert-info {
            background: #cff4fc;
            color: #055160;
        }
    </style>
</head>
<body style="background-color: white;">
    <div class="container mt-4">
        <h1>HealthyCare Hospital Manager</h1>
        
        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a class="nav-link <?= $page == 'consultations' ? 'active' : '' ?>" href="?page=consultations">
                    Consultations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page == 'patients' ? 'active' : '' ?>" href="?page=patients">
                    Patients
                </a>
            </li>
        </ul>

        <div class="mt-4">
            <?php if($page == 'consultations'): ?>
                <?php
                $editing = isset($_GET['edit']) && isset($_GET['id']) ? true : false;
                $consultation_to_edit = null;

                if($editing) {
                    $edit_id = $_GET['id'];
                    foreach($consultations as $cons) {
                        if($cons['consultation_id'] == $edit_id) {
                            $consultation_to_edit = $cons;
                            break;
                        }
                    }
                    if(!$consultation_to_edit) {
                        $editing = false;
                    }
                }
                ?>

                <h5><?= $editing ? 'Edit Consultation' : 'Record New Consultation' ?></h5>
                
                <form method="POST" action="<?= $editing ? 'update.php' : 'insert.php' ?>" class="row g-3 align-items-end">
                    <?php if($editing && $consultation_to_edit): ?>
                        <input type="hidden" name="consultation_id" value="<?= $consultation_to_edit['consultation_id'] ?>">
                    <?php endif; ?>

                    <div class="col-md-3">
                        <label class="form-label">Patient</label>
                        <select name="patient_id" class="form-select" required>
                            <option value="">Select patient</option>
                            <?php foreach($patients as $patient): ?>
                                <option value="<?= $patient['patient_id']; ?>"
                                    <?= ($editing && $consultation_to_edit && $consultation_to_edit['patient_id'] == $patient['patient_id']) ? 'selected' : '' ?>>
                                    <?= $patient['full_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Doctor</label>
                        <input type="text" name="doctor_name" class="form-control" 
                               value="<?= $editing && $consultation_to_edit ? $consultation_to_edit['doctor_name'] : '' ?>" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Date</label>
                        <input type="date" name="consultation_date" class="form-control" 
                               value="<?= $editing && $consultation_to_edit ? date('Y-m-d', strtotime($consultation_to_edit['consultation_date'])) : date('Y-m-d') ?>" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Diagnosis</label>
                        <input type="text" name="diagnosis" class="form-control" 
                               value="<?= $editing && $consultation_to_edit ? $consultation_to_edit['diagnosis'] : '' ?>" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Treatment</label>
                        <input type="text" name="treatment" class="form-control" 
                               value="<?= $editing && $consultation_to_edit ? $consultation_to_edit['treatment'] : '' ?>" required>
                    </div>

                    <div class="col-md-1">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" name="<?= $editing ? 'update_consultation' : 'submit_consultation' ?>" class="btn btn-success">
                            <?= $editing ? 'Update' : 'Add' ?>
                        </button>
                    </div>

                    <?php if($editing): ?>
                        <div class="col-12">
                            <a href="?page=consultations" class="btn btn-secondary">Cancel</a>
                        </div>
                    <?php endif; ?>
                </form>

                <hr class="my-4">

                <h5>Consultation Records</h5>
                
                <table class="table table-bordered table-striped mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Diagnosis</th>
                            <th>Treatment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($consultations as $consultation): ?>
                            <tr>
                                <td><?= $consultation['consultation_id']; ?></td>
                                <td><?= $consultation['full_name']; ?></td>
                                <td><?= $consultation['age']; ?></td>
                                <td><?= $consultation['gender']; ?></td>
                                <td><?= $consultation['doctor_name']; ?></td>
                                <td><?= date("M d, Y", strtotime($consultation['consultation_date'])); ?></td>
                                <td><?= $consultation['diagnosis']; ?></td>
                                <td><?= $consultation['treatment']; ?></td>
                                <td>
                                    <a href="?page=consultations&edit=1&id=<?= $consultation['consultation_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="delete.php?type=consultation&id=<?= $consultation['consultation_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this consultation?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php elseif($page == 'patients'): ?>
                <?php
                $editing = isset($_GET['edit']) ? true : false;
                $patient_to_edit = null;

                if($editing && isset($_GET['id'])) {
                    foreach($patients as $pat) {
                        if($pat['patient_id'] == $_GET['id']) {
                            $patient_to_edit = $pat;
                            break;
                        }
                    }
                }
                ?>

                <h5><?= $editing ? 'Edit Patient' : 'Add New Patient' ?></h5>
                
                <form method="POST" action="<?= $editing ? 'update.php' : 'insert.php' ?>" class="row g-3 align-items-end">
                    <?php if($editing && $patient_to_edit): ?>
                        <input type="hidden" name="patient_id" value="<?= $patient_to_edit['patient_id'] ?>">
                    <?php endif; ?>

                    <div class="col-md-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" 
                               value="<?= $editing && $patient_to_edit ? $patient_to_edit['full_name'] : '' ?>" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Age</label>
                        <input type="number" name="age" class="form-control" 
                               value="<?= $editing && $patient_to_edit ? $patient_to_edit['age'] : '' ?>" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select" required>
                            <option value="">Select</option>
                            <option value="Male" <?= ($editing && $patient_to_edit && $patient_to_edit['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= ($editing && $patient_to_edit && $patient_to_edit['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                            <option value="Other" <?= ($editing && $patient_to_edit && $patient_to_edit['gender'] == 'Other') ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" 
                               value="<?= $editing && $patient_to_edit ? $patient_to_edit['contact_number'] : '' ?>" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div>
                            <button type="submit" name="<?= $editing ? 'update_patient' : 'submit_patient' ?>" class="btn btn-success">
                                <?= $editing ? 'Update Patient' : 'Add Patient' ?>
                            </button>
                            
                            <?php if($editing): ?>
                                <a href="?page=patients" class="btn btn-secondary">Cancel</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>

                <hr class="my-4">

                <h5>Patient Records</h5>
                
                <table class="table table-bordered table-striped mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Contact Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($patients as $patient): ?>
                            <tr>
                                <td><?= $patient['patient_id']; ?></td>
                                <td><?= $patient['full_name']; ?></td>
                                <td><?= $patient['age']; ?></td>
                                <td><?= $patient['gender']; ?></td>
                                <td><?= $patient['contact_number']; ?></td>
                                <td>
                                    <a href="?page=patients&edit=1&id=<?= $patient['patient_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="delete.php?type=patient&id=<?= $patient['patient_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this patient?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>