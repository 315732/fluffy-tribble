<?php include 'sections/dependency.php'; ?>

<?php

require '../Database.php';

session_start();

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin'])) {
    if (empty($_POST['username_or_email']) || empty($_POST['password'])) {
        $errorMessage = "Барлық өрістерді толтырыңыз!";
    } else {
        $usernameOrEmail = trim(htmlspecialchars($_POST['username_or_email']));
        $password = trim(htmlspecialchars($_POST['password']));

        if (!filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) && !preg_match('/^\w+$/', $usernameOrEmail)) {
            $errorMessage = "Жарамсыз пайдаланушы аты немесе электрондық пошта!";
        } else {
            // Database connection
            $pdo = Database::connect();

            $query = "SELECT id, username, email, password_hash FROM users WHERE " .
                     (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) ? "email" : "username") . " = ?";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$usernameOrEmail]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['user_session'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['username'];
                $_SESSION['user_email'] = $user['email'];

                // Redirect after successful login
                header("Location: home.php");
                exit();
            } else {
                $errorMessage = "Қате пайдаланушы аты/электрондық пошта немесе құпиясөз!";
            }
        }
    }
}
?>

<?php include 'sections/header.php'; ?>

<div class="modal modal-sheet position-static d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">Кіру</h1>
            </div>
            <div class="modal-body p-5 pt-0">
                <form method="POST">
                    <input name="signin" type="hidden" value="1">

                    <!-- Display success message -->
                    <?php if (!empty($successMessage)): ?>
                        <div class="alert alert-success" role="alert">
                            <?= htmlspecialchars($successMessage); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Display error message -->
                    <?php if (!empty($errorMessage)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($errorMessage); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-floating mb-3">
                        <input name="username_or_email" type="text" class="form-control rounded-3" id="floatingInput"
                            placeholder="name@example.com">
                        <label for="floatingInput">Электрондық пошта</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="password" type="password" class="form-control rounded-3" id="floatingPassword"
                            placeholder="Құпиясөз">
                        <label for="floatingPassword">Құпиясөз</label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-dark rounded-pill" type="submit">Кіру</button>
                    <small class="text-body-secondary">Кіру батырмасын басу арқылы сіз пайдалану шарттарымен
                        келісесіз.</small>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'sections/footer.php'; ?>
