<?php
require 'config.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM posts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_POST['author'];

        $stmt = $pdo->prepare('UPDATE posts SET title = ?, content = ?, author = ? WHERE id = ?');
        $stmt->execute([$title, $content, $author, $_GET['id']]);

        header('Location: post.php?id=' . $_GET['id']);
        exit;
    }
} else {
    die('Post not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
   <div class="container">
   <center> <h1>Edit Post</h1></center>
   <a href="post.php?id=<?= $post['id']; ?>">Back to Post</a>
    <form action="edit.php?id=<?= $post['id']; ?>" method="POST">
        <label for="title" class="form-control">Title:</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($post['title']); ?>" required class="form-control"><br>

        <label for="content" class="form-control">Content:</label>
        <textarea name="content" id="content" required class="form-control"><?= htmlspecialchars($post['content']); ?></textarea><br>

        <label for="author" class="form-control">Author:</label>
        <input type="text" class="form-control"  name="author" id="author" value="<?= htmlspecialchars($post['author']); ?>" required><br>

        <button type="submit" class="btn btn-success">Update Post</button>
    </form>
    
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>