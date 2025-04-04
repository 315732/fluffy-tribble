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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form inputs
    $title = stripslashes($_POST["title"]);
    $description = stripslashes($_POST["description"]);
    $category = htmlspecialchars(stripslashes($_POST["category"]));
    $content = htmlentities(stripslashes($_POST["content"]));

    if ($title && $description && $category && $content) {
        try {
            // Create post in database
            $stmt = $pdo->prepare("INSERT INTO blogs (title, descriptions, category, content) VALUES (:title, :description, :category, :content)");
            $stmt->bindParam(":title", $title, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":category", $category, PDO::PARAM_STR);
            $stmt->bindParam(":content", $content, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $_SESSION["success"] = "Пост успешно создан! <a href='../post.php?id=" . $pdo->lastInsertId() . "' target='_blank'>Проверить пост</a>";

                // Generate sitemap entry for the new post
                $postId = $pdo->lastInsertId(); // Get the ID of the new post
                $postUrl = "https://zamzametodika.kz/post.php?id=" . $postId;
                $lastmod = date("Y-m-d");

                // Load existing sitemap or create new XML structure
                $sitemapFile = '../sitemap.xml';
                if (file_exists($sitemapFile)) {
                    $xml = simplexml_load_file($sitemapFile);
                } else {
                    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');
                }

                // Add new URL entry to the sitemap
                $url = $xml->addChild("url");
                $url->addChild("loc",htmlspecialchars($postUrl));
                $url->addChild("lastmod", $lastmod);
                $url->addChild("changefreq", "weekly");
                $url->addChild("priority", "0.8");

                // Save updated sitemap
                $xml->asXML($sitemapFile);

                // Redirect if "save_and_exit" button was clicked
                if ($_POST["action"] === "save_and_exit") {
                    header("Location: list_posts.php");
                    exit();
                }
            } else {
                $_SESSION["error"] = "Не удалось создать пост.";
            }
        } catch (PDOException $e) {
            $_SESSION["error"] = "Ошибка базы данных: " . $e->getMessage();
        }
    } else {
        $_SESSION["error"] = "Отсутствуют обязательные поля.";
    }
}

$stmt = $pdo->prepare("SELECT id, title FROM categories");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать пост</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>

    <link href="plugins/summernote.css" rel="stylesheet">
    <script src="plugins/summernote.js"></script>

</head>

<body>

    <ul class="nav nav-pills">
        <li class="nav-item"><a href="admin-dashboard.php" class="nav-link">Панель инструментов</a></li>
        <li class="nav-item"><a href="list_posts.php" class="nav-link">Посты</a></li>
    </ul>

    <div style="padding-top: 2rem; padding-bottom: 5rem; padding-left: 1rem; padding-right: 1rem;">
        <h2 class="h4 font-weight-bold mb-4">Новый пост</h2>

        <?php if (isset($_SESSION["success"])): ?>
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= $_SESSION["success"];
                unset($_SESSION["success"]); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION["error"])): ?>
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= $_SESSION["error"];
                unset($_SESSION["error"]); ?>
            </div>
        <?php endif; ?>

        <form action="create_post.php" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="title" class="form-label">Заголовок:</label>
                <input type="text" id="title" name="title" required class="form-control" placeholder="Название нового поста">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Описание:</label>
                <input type="text" id="description" name="description" required class="form-control" placeholder="Описание">
                <small id="descriptionCharCount" class="form-text text-muted">0 / 500 букв</small>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Категория:</label>
                <select name="category" id="category" class="form-select" required>
                    <option value="" disabled selected>Выберите категорию</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo htmlspecialchars($category["title"]); ?>">
                            <?php echo htmlspecialchars($category["title"]); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Содержание:</label>
                <textarea id="content" name="content" rows="10" required class="form-control" maxlength="65535"></textarea>
            </div>

            <button type="submit" name="action" value="save_and_stay" class="btn btn-success">Создать пост</button>
            <button type="submit" name="action" value="save_and_exit" class="btn btn-info">Создать пост и выйти</button>

        </form>

    </div>

    <?php include("assets/footer.php"); ?>

    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 500,
                codemirror: { // codemirror options
                    theme: 'yeti',
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('description').addEventListener('input', function() {
                let descriptionInput = this.value;
                let charCount = descriptionInput.length;

                // Update the character count display
                document.getElementById('descriptionCharCount').textContent = charCount + " / 500 букв";

                // Restrict input if character count exceeds 500
                if (charCount > 500) {
                    this.value = descriptionInput.substring(0, 500);
                }
            });
        });
    </script>

</body>

</html>