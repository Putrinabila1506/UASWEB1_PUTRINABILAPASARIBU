<?php
session_start();
include 'koneksi.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if ($row = mysqli_fetch_assoc($result)) {

        if ($password == $row['password']) {

            $_SESSION['email'] = $row['email'];
            $_SESSION['name']  = $row['name'];
            $_SESSION['role']  = $row['role'];

            header("Location: dashboard.php");
            exit;

        } else {
            $error = "Password salah";
        }

    } else {
        $error = "Email tidak ditemukan";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | POLGAN MART</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1e90ff, #facc15);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: #fff;
            width: 380px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1e90ff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
        }

        input:focus {
            border-color: #1e90ff;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #1e90ff;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
            background: #187bcd;
        }

        .btn-reset {
            width: 100%;
            padding: 10px;
            background: #facc15;
            border: none;
            border-radius: 8px;
            margin-top: 10px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-reset:hover {
            background: #eab308;
        }

        .error {
            background: #ffe4e6;
            color: #b91c1c;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
            margin-bottom: 15px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #555;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="login-card">
    <h2>POLGAN MART</h2>

    <?php if ($error != "") { ?>
        <div class="error"><?= $error; ?></div>
    <?php } ?>

    <form method="post">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Masukkan email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit" class="btn">Login</button>
        <button type="reset" class="btn-reset">Batal</button>
    </form>

    <div class="footer">
        <p>© 2026 POLGAN MART</p>
    </div>
</div>

</body>
</html>
