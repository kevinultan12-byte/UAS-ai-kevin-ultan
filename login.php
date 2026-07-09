<?php include 'includes/header.php'; ?>

<style>
    body {
        background: url('img/tempat-ibadah.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
    }

    .form-container {
        max-width: 400px;
        margin: 100px auto;
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .form-container h3 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-container form input[type="text"],
    .form-container form input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    .form-container button {
        background-color: #e0c200;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
    }

    .form-container button:hover {
        background-color: #e0c200;
    }
</style>

<div class="form-container">
    <h3>Login Admin</h3>
    <form action="proses_login.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
