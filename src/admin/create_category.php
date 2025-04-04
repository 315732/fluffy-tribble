<?php
session_start();

if (!isset($_SESSION["admin_session"])) {
    header("Location: admin-signin.php");
    exit();
}

require_once "../../Database.php";

try {
    $pdo = Database::connect();
} catch (PDOException $e) {
    error_log("Ошибка подключения к базе данных: " . $e->getMessage());
    $_SESSION["error"] = "Произошла ошибка сервера. Повторите попытку позже.";
    header("Location: _404.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $category_name = htmlspecialchars(stripslashes($_POST["name"]));
    $category_description = htmlspecialchars(stripslashes($_POST["description"]));

    // Make sure the column you're checking is the correct one, here we assume it's 'title'
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM categories WHERE title = :name");
    $stmt->bindParam(":name", $category_name);
    $stmt->execute();
    
    if ($stmt->fetchColumn() > 0) {
        $_SESSION["error"] = "Название категории уже существует.";
    } else {
      
        // Ensure column names match with your database schema
        $stmt = $pdo->prepare("INSERT INTO categories (title, descriptions) VALUES (:title, :description)");
        $stmt->bindParam(":title", $category_name);
        $stmt->bindParam(":description", $category_description);

        if ($stmt->execute()) {
            $_SESSION["success"] = "Категория успешно создана!";
            header("Location: " . $_SERVER["PHP_SELF"]);
            exit();
        } else {
            $_SESSION["error"] = "Не удалось создать категорию.";
        }
    }

    header("Location: " . $_SERVER["PHP_SELF"]);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать категорию</title> 
    <?php include "sections/style.php"; ?>

</head>

<body>

    <?php include("sections/header.php"); ?>

    <div class="container" style="padding-top: 2rem; padding-bottom: 5rem;">
        <h2 class="h4 fort-weight-bold mb-4">Создать категорию</h2>

        <?php if (isset($_SESSION["success"])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= $_SESSION["success"]; unset($_SESSION["success"]); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION["error"])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= $_SESSION["error"]; unset($_SESSION["error"]); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="create_category.php" method="POST" class="mt-4" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="name" class="form-label">Название категории:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Название категории" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Описание:</label>
                <textarea class="form-control" id="description" name="description" placeholder="Добавить описание" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Создать категорию</button>

        </form>
    </div>

    <?php include("sections/footer.php"); ?>

</body>

</html>
