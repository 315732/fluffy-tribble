<!DOCTYPE html>
<html>

<head>
    <title>Admin Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="modal modal-sheet position-static d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2">Кіру</h1>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form method="POST">
                        <input name="signin" type="hidden" value="1">
                        <div class="form-floating mb-3">
                            <input name="username_or_email" type="text" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Электрондық пошта</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="password" type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Құпиясөз">
                            <label for="floatingPassword">Құпиясөз</label>
                        </div>
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-dark rounded-pill" type="submit">Кіру</button>
                        <small class="text-body-secondary">Кіру батырмасын басу арқылы сіз пайдалану шарттарымен келісесіз.</small>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>