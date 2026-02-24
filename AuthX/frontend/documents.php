<?php
require_once "../backend/auth.php";
$dir = "$basePath/Documents";
$files = array_diff(scandir($dir), ['.','..']);
?>
<!DOCTYPE html>
<html>
<head>
<title>Documents | AuthX</title>
</head>
<body>

<h2>📄 Documents</h2>

<form action="../backend/upload_file.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="target" value="Documents">
    <input type="file" name="file" required>
    <button type="submit">Upload</button>
</form>

<ul>
<?php foreach ($files as $f): ?>
    <li>
        <?= htmlspecialchars($f) ?>
        <a href="../backend/delete_file.php?type=Documents&file=<?= urlencode($f) ?>">❌ Delete</a>
    </li>
<?php endforeach; ?>
</ul>

</body>
</html>