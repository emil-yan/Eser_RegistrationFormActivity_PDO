<?php
// Simply redirect the delete request to the form handler
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    header("Location: core/handleForms.php?action=delete&id=$id");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>