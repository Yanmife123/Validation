<?php

require('database/account.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $add = new addAccount($_POST);
    if ($add->addTo_Database() === 'done') {
        header("location: login.php");
    }
    /*   $add->viewProperties(); */
    // $validateEmail_Result = $add->validateEmail();
    // echo $validateEmail_Result;
    // $add->addTo_Database();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <main>
        <section class="formContainer">
            <form action="" method="POST" class="form" novalidate>
                <div class="formHead">
                    <h1> register</h1>
                </div>
                <div class="inputContainer">
                    <input type="text" name="fullname" class="userInput" required>
                    <label for="fullname" class="userLabel">fullname</label>
                    <div id="fullname" class="error"></div>
                </div>
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
                    <input type="password" name="confirmPassword" class="userInput" required>
                    <label for="confirmPassword" class="userLabel">confirm-password</label>
                    <div id="confirmPassword" class="error"></div>
                </div>
                <div class="inputContainer">
                    <div class="submitContainer">
                        <button type="button" id="submitButton">submit</button>
                    </div>

                </div>
            </form>
        </section>
        <a href="login.php">Login page</a>
    </main>
    <script src="script/index.js"></script>
</body>

</html>