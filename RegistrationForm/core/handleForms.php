<?php
session_start();
require_once 'models.php';

// Handle CREATE and UPDATE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    
    $data = [
        'first_name' => trim($_POST['first_name']),
        'last_name' => trim($_POST['last_name']),
        'specialization' => trim($_POST['specialization']),
        'years_experience' => (int)$_POST['years_experience'],
        'preferred_language' => trim($_POST['preferred_language']),
        'is_remote_preferred' => isset($_POST['is_remote_preferred']) ? 1 : 0,
    ];

    if ($_POST['action'] == 'create') {
        if (createEngineer($data)) {
            $_SESSION['message'] = "Engineer **{$data['first_name']}** added successfully!";
        } else {
            $_SESSION['message'] = "Error adding engineer.";
        }
    } elseif ($_POST['action'] == 'update' && isset($_POST['id'])) {
        $data['id'] = (int)$_POST['id'];
        if (updateEngineer($data)) {
            $_SESSION['message'] = "Engineer record updated successfully!";
        } else {
            $_SESSION['message'] = "Error updating engineer record.";
        }
    }
    header("Location: ../index.php");
    exit();
}

// Handle DELETE (Typically from deleteEmployee.php or via GET request)
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    if (deleteEngineer($id)) {
        $_SESSION['message'] = "Engineer record deleted successfully!";
    } else {
        $_SESSION['message'] = "Error deleting engineer record.";
    }
    header("Location: ../index.php");
    exit();
}
?>