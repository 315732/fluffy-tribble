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

// Define pagination parameters
$limit = 100; // Number of posts per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get the current page or set default to 1
$offset = ($page - 1) * $limit; // Calculate the offset for the SQL query

// Fetch total number of posts for pagination
$totalStmt = $pdo->prepare("SELECT COUNT(*) as total FROM blogs");
$totalStmt->execute();
$totalPosts = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalPosts / $limit); // Calculate total pages

// Fetch posts for the current page
$stmt = $pdo->prepare("SELECT id, title, descriptions, category, created_at FROM blogs ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Посты</title>
    <?php include "sections/style.php"; ?>

</head>

<body>

    <?php include("sections/header.php"); ?>

    <div style="padding-top: 1rem; padding-bottom: 5rem; padding-left: 1rem; padding-right: 1rem;">

        <h2 class="h4 font-weight-bold mb-4">Посты</h2>

        <?php if (isset($_SESSION["success"])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= $_SESSION["success"];
                unset($_SESSION["success"]); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION["error"])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= $_SESSION["error"];
                unset($_SESSION["error"]); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (count($posts) > 0): ?>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Заголовок</th>
                        <th scope="col">Категория</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Вид</th>
                        <th scope="col">Редактировать</th>
                        <th scope="col">Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $index => $post): ?>
                        <tr>
                            <td><?= htmlspecialchars($post["title"]) ?></td>
                            <td><?= htmlspecialchars($post["category"]) ?></td>
                            <td><?= htmlspecialchars($post["created_at"]) ?></td>
                            <td><a class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" href="view_post.php?id=<?= $post["id"] ?>">Читать</a></td>
                            <td><a class="btn btn-success" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" href="edit_post.php?id=<?= $post["id"] ?>">Редактировать</a></td>
                            <td><a class="btn btn-danger" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" href="delete_post.php?id=<?= $post["id"] ?>">Удалить</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination Links -->
            <nav>
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo; Предыдущий</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Always show first page -->
                    <?php if ($page > 3): ?>
                        <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
                        <?php if ($page > 4): ?>
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Show nearby pages -->
                    <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
                        <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Always show last page -->
                    <?php if ($page < $totalPages - 2): ?>
                        <?php if ($page < $totalPages - 3): ?>
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        <?php endif; ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $totalPages ?>"><?= $totalPages ?></a></li>
                    <?php endif; ?>

                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                <span aria-hidden="true">Следующий &raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>

        <?php else: ?>
            <p>Нет доступных статей.</p>
        <?php endif; ?>

    </div>

    <?php include "sections/footer.php"; ?>

</body>

</html>