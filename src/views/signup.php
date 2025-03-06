<?php include('sections/header.php'); ?>

<p>Sign up</p>

<?php if (isset($message)) echo "<p style='color: green;'>$message</p>"; ?>

<form method="POST" action="">
    <input type="hidden" name="signup" value="1">
    
    <label>Username:</label>
    <input type="text" name="username" required>
    <br>
    <label>Email:</label>
    <input type="email" name="email" required>
    <br>
    <label>Password:</label>
    <input type="password" name="password" required>
    <br>
    <button type="submit">Signup</button>
</form>

<?php include('sections/footer.php'); ?>