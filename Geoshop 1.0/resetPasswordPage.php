<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <form action="php/resetPassword.php" method="post">
        <label for="newPassword">New password</label>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="newPassword" placeholder="New password" id="newPassword" required>
                <button class="btn btn-outline-secondary" type="button" onclick="viewNewPassword()">Button</button>
            </div>
        <label for="confirmNewPassword">Confirm new password</label>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="confirmNewPassword" placeholder="Confirm new password" id="confirmNewPassword" required>
                <button class="btn btn-outline-secondary" type="button" onclick="viewConfirmNewPassword()">Button</button>
            </div>
        <input type="text" name="userId" id="userId" required value="<?php echo $_GET['userId']?>">
        <input type="submit" class="btn btn-primary" value="Reset Password">
    </form>
    <script>
        const newPassword = document.getElementById('newPassword');
        const confirmNewPassword = document.getElementById('confirmNewPassword')
        function viewNewPassword() {
            newPassword.type = newPassword.type === 'password' ? 'text' : 'password';
        }
        function viewConfirmNewPassword() {
            confirmNewPassword.type = confirmNewPassword.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>