<?php
session_start();
require_once 'core/models.php';
$engineers = readAllEngineers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Software Engineer Registration</title>
    <style>
        /* Minimal CSS for readability */
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f9; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { border-bottom: 2px solid #ccc; padding-bottom: 10px; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"], select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        input[type="submit"] { background-color: #5cb85c; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #007bff; color: white; }
        .message { background-color: #dff0d8; color: #3c763d; padding: 10px; border: 1px solid #d6e9c6; border-radius: 4px; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Software Engineer Registration System</h1>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="message"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php endif; ?>

    <h2>Register New Engineer</h2>
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="action" value="create">
        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>
        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
        </div>
        <div>
            <label for="specialization">Specialization:</label>
            <select id="specialization" name="specialization" required>
                <option value="">-- Select Specialization --</option>
                <option value="Frontend">Frontend</option>
                <option value="Backend">Backend</option>
                <option value="Fullstack">Fullstack</option>
                <option value="DevOps">DevOps</option>
            </select>
        </div>
        <div>
            <label for="years_experience">Years of Experience:</label>
            <input type="number" id="years_experience" name="years_experience" min="0" required>
        </div>
        <div>
            <label for="preferred_language">Preferred Language:</label>
            <input type="text" id="preferred_language" name="preferred_language" required>
        </div>
        <div>
            <label>
                <input type="checkbox" name="is_remote_preferred" value="1"> 
                Prefers Remote Work
            </label>
        </div>
        <div>
            <input type="submit" value="Register Engineer">
        </div>
    </form>

    <hr>

    <h2>Registered Engineers (Read)</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Specialization</th>
                <th>Exp (Yrs)</th>
                <th>Language</th>
                <th>Remote</th>
                <th>Date Added</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($engineers)): ?>
                <?php foreach ($engineers as $engineer): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($engineer['id']); ?></td>
                        <td><?php echo htmlspecialchars($engineer['first_name'] . ' ' . $engineer['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($engineer['specialization']); ?></td>
                        <td><?php echo htmlspecialchars($engineer['years_experience']); ?></td>
                        <td><?php echo htmlspecialchars($engineer['preferred_language']); ?></td>
                        <td><?php echo $engineer['is_remote_preferred'] ? 'Yes' : 'No'; ?></td>
                        <td><?php echo htmlspecialchars(date("Y-m-d", strtotime($engineer['date_added']))); ?></td>
                        <td>
                            <a href="editEmployee.php?id=<?php echo $engineer['id']; ?>">✏️ Edit</a> |
                            <a href="deleteEmployee.php?id=<?php echo $engineer['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">🗑️ Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8">No software engineers registered yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>