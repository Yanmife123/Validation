<?php

require('database/account.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $validateLogin = new loginValidate($_POST);
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login(testing OOP)</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <main>
        <section class="formContainer">
            <form action="" method="POST" class="form" novalidate>
                <div class="formHead">
                    <h1>Login</h1>
                </div>
                <input type="hidden" name="fullname" value="null">
                <div class="inputContainer">
                    <input type="text" name="email" class="userInput" required>
                    <label for="email" class="userLabel">email</label>
                    <div id="email" class="error"></div>
                </div>
                <div class="inputContainer">
                    <input type="password" name="password" class="userInput" required>
                    <label for="password" class="userLabel">password</label>
                    <div id="password" class="error"></div>
                </div>
                <div class="inputContainer">
                    <div class="submitContainer">
                        <button type="button" id="submitButton">submit</button>
                    </div>

                </div>
            </form>
        </section>
    </main>
    <script src="script/login.js"></script>
</body>

</html>