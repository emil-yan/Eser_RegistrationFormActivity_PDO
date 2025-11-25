<?php
session_start();
require_once 'core/models.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = (int)$_GET['id'];
$engineer = readEngineerById($id);

if (!$engineer) {
    $_SESSION['message'] = "Engineer record not found.";
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Engineer Record</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f9; }
        .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { border-bottom: 2px solid #ccc; padding-bottom: 10px; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"], select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        input[type="submit"] { background-color: #ffc107; color: black; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        .back-link { display: block; margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Engineer: <?php echo htmlspecialchars($engineer['first_name'] . ' ' . $engineer['last_name']); ?></h2>
    
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($engineer['id']); ?>">
        
        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($engineer['first_name']); ?>" required>
        </div>
        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($engineer['last_name']); ?>" required>
        </div>
        <div>
            <label for="specialization">Specialization:</label>
            <select id="specialization" name="specialization" required>
                <?php $specs = ['Frontend', 'Backend', 'Fullstack', 'DevOps']; ?>
                <?php foreach ($specs as $spec): ?>
                    <option value="<?php echo $spec; ?>" <?php echo ($engineer['specialization'] == $spec) ? 'selected' : ''; ?>>
                        <?php echo $spec; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="years_experience">Years of Experience:</label>
            <input type="number" id="years_experience" name="years_experience" value="<?php echo htmlspecialchars($engineer['years_experience']); ?>" min="0" required>
        </div>
        <div>
            <label for="preferred_language">Preferred Language:</label>
            <input type="text" id="preferred_language" name="preferred_language" value="<?php echo htmlspecialchars($engineer['preferred_language']); ?>" required>
        </div>
        <div>
            <label>
                <input type="checkbox" name="is_remote_preferred" value="1" <?php echo $engineer['is_remote_preferred'] ? 'checked' : ''; ?>> 
                Prefers Remote Work
            </label>
        </div>
        <div>
            <input type="submit" value="Update Engineer Record">
        </div>
    </form>
    
    <a href="index.php" class="back-link">← Back to List</a>
</div>
</body>
</html>