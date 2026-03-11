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
</head>
<body>
    <div class="container mt-4">
        <h3>HealthyCare Hospital Manager</h3>
        
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
                
                <form method="POST" action="<?= $editing ? 'update.php' : 'insert.php' ?>" class="row g-3 mt-2">
                    <?php if($editing && $consultation_to_edit): ?>
                        <input type="hidden" name="consultation_id" value="<?= $consultation_to_edit['consultation_id'] ?>">
                    <?php endif; ?>

                    <div class="col-md-3">
                        <label class="form-label">Patient</label>
                        <select name="patient_id" class="form-select" required>
                            <option value="">Select patient...</option>
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
                        <button type="submit" name="<?= $editing ? 'update_consultation' : 'submit_consultation' ?>" class="btn btn-primary d-block">
                            <?= $editing ? 'Update' : 'Save' ?>
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
                                    <a href="?page=consultations&edit=1&id=<?= $consultation['consultation_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
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
                
                <form method="POST" action="<?= $editing ? 'update.php' : 'insert.php' ?>" class="row g-3 mt-2">
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
                                <?= $editing ? 'Update' : 'Add' ?>
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
                                    <a href="?page=patients&edit=1&id=<?= $patient['patient_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
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