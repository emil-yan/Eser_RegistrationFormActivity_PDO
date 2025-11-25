<?php
require_once 'dbConfig.php';

// --- C (Create) ---
function createEngineer($data) {
    global $pdo;
    $sql = "INSERT INTO software_engineers (first_name, last_name, specialization, years_experience, preferred_language, is_remote_preferred) 
            VALUES (:fn, :ln, :spec, :exp, :lang, :remote)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':fn' => $data['first_name'],
        ':ln' => $data['last_name'],
        ':spec' => $data['specialization'],
        ':exp' => $data['years_experience'],
        ':lang' => $data['preferred_language'],
        ':remote' => $data['is_remote_preferred']
    ]);
}

// --- R (Read - All) ---
function readAllEngineers() {
    global $pdo;
    $sql = "SELECT * FROM software_engineers ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// --- R (Read - Single) ---
function readEngineerById($id) {
    global $pdo;
    $sql = "SELECT * FROM software_engineers WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// --- U (Update) ---
function updateEngineer($data) {
    global $pdo;
    $sql = "UPDATE software_engineers SET first_name = :fn, last_name = :ln, specialization = :spec, 
            years_experience = :exp, preferred_language = :lang, is_remote_preferred = :remote 
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':id' => $data['id'],
        ':fn' => $data['first_name'],
        ':ln' => $data['last_name'],
        ':spec' => $data['specialization'],
        ':exp' => $data['years_experience'],
        ':lang' => $data['preferred_language'],
        ':remote' => $data['is_remote_preferred']
    ]);
}

// --- D (Delete) ---
function deleteEngineer($id) {
    global $pdo;
    $sql = "DELETE FROM software_engineers WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}
?>