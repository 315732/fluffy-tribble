<?php include('sections/header.php'); ?>

<p>Sign In</p>

<?php if (isset($message)) echo "<p style='color: green;'>$message</p>"; ?>

<form method="POST" action="">
    <input type="hidden" name="signin" value="1">

    <label>Username:</label>
    <input type="text" name="username" required>
    <br>
    <label>Password:</label>
    <input type="password" name="password" required>
    <br>
    <button type="submit">Login</button>
</form>

<?php include('sections/footer.php'); ?>