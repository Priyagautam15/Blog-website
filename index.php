<?php
require 'config.php';

$stmt = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC');
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <center><h1>Blog Posts</h1></center>
        <h2><a href="create.php">Create New Post</a></h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Author</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td>
                            <a href="post.php?id=<?= $post['id']; ?>">
                                <?= htmlspecialchars($post['title']); ?>
                            </a>
                            <small>by <?= htmlspecialchars($post['author']); ?></small>
                        </td>
                        <td><?= htmlspecialchars($post['title']); ?></td>
                        <td><?= htmlspecialchars(substr($post['content'], 0, 100)); ?>...</td>
                        <td><a href="edit.php?id=<?= $post['id']; ?>">Edit</a></td>
                        <td><a href="delete.php?id=<?= $post['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
