<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data safely
    $name   = isset($_POST['name']) ? trim($_POST['name']) : '';
    $city   = isset($_POST['city']) ? trim($_POST['city']) : '';
    $budget = isset($_POST['budget']) ? trim($_POST['budget']) : '';
    $mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
    $email  = isset($_POST['email']) ? trim($_POST['email']) : '';

    // Prepare data string
    $data = "Name: " . $name . "\n" .
            "City: " . $city . "\n" .
            "Budget: " . $budget . "\n" .
            "Mobile: " . $mobile . "\n" .
            "Email: " . $email . "\n" .
            "----------------------------------\n";

    // Save to file
    file_put_contents("response.txt", $data, FILE_APPEND | LOCK_EX);

    // Confirmation & redirect
    echo "<script>alert('Thank you! Your response has been saved.'); window.location.href='index.html';</script>";
}
?>
