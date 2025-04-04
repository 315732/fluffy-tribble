<?php
session_start(); // Start the session to store messages

if (!isset($_SESSION["admin_session"])) {
    header("Location: admin-signin.php");
    exit();
}

// Connect to the database
require_once "../../Database.php";

try {
    $pdo = Database::connect();
} catch (PDOException $e) {
    error_log("Ошибка подключения к базе данных: " . $e->getMessage());
    $_SESSION["error"] = "Произошла ошибка сервера. Повторите попытку позже.";
    header("Location: _404.php");
    exit();
}

// Check if the 'id' parameter is set in the URL and is a valid integer
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = intval($_GET["id"]);

    // Prepare and execute the query to fetch the post
    $stmt = $pdo->prepare("SELECT title, descriptions, category, content, created_at FROM blogs WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    // Fetch the post data
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the post exists
    if (!$post) {
        $_SESSION["error"] = "Сообщение не найдено."; // Optionally redirect or show a message if the post doesn't exist
        header("Location: _404.php");
        exit();
    }
} else {
    $_SESSION["error"] = "Неверный идентификатор сообщения."; // Handle invalid ID case
    header("Location: _404.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post["title"]) ?></title>
    <?php include("sections/style.php"); ?>
    
</head>

<body>

    <?php include("sections/header.php"); ?>

    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-3 rounded-3">
                <li class="breadcrumb-item"><a href="dashboard.php">Домашняя страница</a></li>
                <li class="breadcrumb-item"><a href="list_posts.php">Посты</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($post["title"]) ?></li>
            </ol>
        </nav>

    </div>

    <div class="container mt-5" style="padding-bottom: 5rem;">
        
        <h1 class="h2"><?= htmlspecialchars($post["title"]) ?></h1>

        <p><strong>Категория:</strong> <?= htmlspecialchars($post["category"]) ?></p>
        
        <?php if ($post["image"]): ?>
            <div>
                <img src="../uploads/<?= htmlspecialchars($post["image"]) ?>" alt="<?= htmlspecialchars($post["title"]) ?>" style="width: 300px; height: auto;">
            </div>
        <?php else: ?>
            <p><strong>Изображение доступно</strong></p>
        <?php endif; ?>
        
        <p><strong>Дата:</strong> <?= htmlspecialchars($post["created_at"]) ?></p>
        
        <div>
            <strong>Описание:</strong>
            <p><?= nl2br(htmlspecialchars($post["description"])) ?></p>
        </div>
        
        <div>
            <strong>Содержание:</strong>
            <p><?= htmlspecialchars_decode(nl2br($post["content"])) ?></p>
        </div>

    </div>

    <?php include("sections/footer.php"); ?>

</body>

</html>