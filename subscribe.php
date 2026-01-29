<?php
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error"]);
        exit;
    }

    $stmt = $pdo->prepare(
        "INSERT IGNORE INTO newsletter_subscribers (email) VALUES (?)"
    );
    $stmt->execute([$email]);

    echo json_encode(["status" => "success"]);
}