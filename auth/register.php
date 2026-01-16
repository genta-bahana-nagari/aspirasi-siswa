<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role']; // student/admin
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssss", $name, $email, $password, $role);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Email already exists";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex vh-100 align-items-center justify-content-center">
    <div class="card shadow p-4" style="width: 450px;">
        <h4 class="text-center mb-3">Register</h4>

        <form method="POST">
            <div class="mb-3">
                <label>Name</label>
                <input name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input name="email" type="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input name="password" type="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-select">
                    <option value="student">Student</option>
                    <option value="admin">School Admin</option>
                </select>
            </div>

            <button class="btn btn-success w-100">Register</button>
        </form>

        <div class="text-center mt-3">
            <a href="login.php">Already have an account?</a>
        </div>
    </div>
</div>

</body>
</html>
