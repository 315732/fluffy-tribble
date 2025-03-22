<?php include('sections/header.php'); ?>

<div class="modal modal-sheet position-static d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">Тіркелу</h1>
            </div>
            <div class="modal-body p-5 pt-0">
                <form method="POST">
                    <input type="hidden" name="signup" value="1">
                    
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
                        <input type="text" name="username" class="form-control rounded-3" id="username" placeholder="name@example.com">
                        <label for="username">Пайдаланушы аты</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control rounded-3" id="email" placeholder="name@example.com">
                        <label for="email">Электрондық пошта</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control rounded-3" id="password" placeholder="Құпиясөз">
                        <label for="password">Құпиясөз</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password_match" class="form-control rounded-3" id="password_match" placeholder="Құпиясөз">
                        <label for="password_match">Құпиясөзді қайталау</label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-dark rounded-pill" type="submit" name="signup">Тіркелу</button>
                    <small class="text-body-secondary">Тіркелу батырмасын басу арқылы сіз пайдалану шарттарымен келісесіз.</small>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('sections/footer.php'); ?>
