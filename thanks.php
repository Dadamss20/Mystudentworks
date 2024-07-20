<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"]; // Note: In a real application, never store passwords in plain text
    $email = $_POST["email"];
    $play_time = $_POST["play_time"];
    $favorite_pack = $_POST["favorite_pack"];
    $feedback = $_POST["feedback"];

    // Validate input
    if (empty($name) || empty($username) || empty($password) || empty($email) || empty($play_time) || empty($favorite_pack) || empty($feedback)) {
        die("Error: All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }

    // Process the data (in this example, we'll just write it to a file)
    $data = "Name: $name\n";
    $data .= "Username: $username\n";
    $data .= "Email: $email\n";
    $data .= "Play Time: $play_time\n";
    $data .= "Favorite Pack: $favorite_pack\n";
    $data .= "Feedback: $feedback\n\n";

    $file = fopen("survey_results.txt", "a");
    fwrite($file, $data);
    fclose($file);

    // Send a confirmation email
    $to = $email;
    $subject = "Thank you for completing the Sims 4 Expansion Packs Survey";
    $message = "Dear $name,\n\nThank you for participating in our Sims 4 Expansion Packs Survey. We appreciate your feedback!\n\nBest regards,\nThe Survey Team";
    $headers = "From: noreply@example.com";

    mail($to, $subject, $message, $headers);

    // Redirect to a thank you page
    header("Location: thank_you.html");
    exit();
}
?>