<?php
session_start();
if(!isset($_SESSION['user_email'])){
    header("Location: login.php"); exit;
}

$email = $_SESSION['user_email'];
$username = $_SESSION['username'];

$userFolder = preg_replace('/[^a-zA-Z0-9]/','_',$email);
$base = __DIR__."/../user_uploads/$userFolder/";

$folders = [
    "documents" => "📄 Documents",
    "pictures"  => "🖼 Pictures"
];

$limit = 50 * 1024 * 1024; // 50MB

function folderSize($dir){
    $size=0;
    foreach(glob("$dir/*") as $f){
        $size+= is_file($f)? filesize($f):0;
    }
    return $size;
}

$totalUsed=0;
foreach($folders as $k=>$v){
    $totalUsed+= folderSize($base.$k);
}
$percent = min(100,($totalUsed/$limit)*100);
?>
<!DOCTYPE html>
<html>
<head>
<title>My Files | AuthX</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
body{margin:0;font-family:Poppins;background:#f4f7fb}
.layout{display:flex;height:100vh}
.sidebar{width:240px;background:#fff;padding:15px;border-right:1px solid #ddd}
.sidebar a{display:block;padding:10px;border-radius:6px;color:#111;text-decoration:none}
.sidebar a:hover{background:#eef}
.main{flex:1;padding:25px}
.progress{background:#ddd;height:14px;border-radius:10px}
.progress span{display:block;height:100%;background:#2563eb;border-radius:10px}
table{width:100%;background:#fff;border-radius:10px;border-collapse:collapse}
th,td{padding:12px;border-bottom:1px solid #eee}
.btn{padding:6px 10px;border-radius:5px;color:#fff;text-decoration:none}
.open{background:#2563eb}
.del{background:#dc2626}
</style>
</head>
<body>

<div class="layout">

<div class="sidebar">
<h3>Home</h3>
<?php foreach($folders as $k=>$v): ?>
<a href="#<?= $k ?>"><?= $v ?></a>
<?php endforeach; ?>
<a href="logout.php">🚪 Logout</a>
</div>

<div class="main">
<h2>Welcome, <?= htmlspecialchars($username) ?></h2>
<p><?= htmlspecialchars($email) ?></p>

<h4>Storage Usage</h4>
<div class="progress"><span style="width:<?= $percent ?>%"></span></div>
<p><?= round($totalUsed/1024/1024,2) ?> MB / 50 MB</p>

<form method="post" action="../backend/upload_file.php" enctype="multipart/form-data">
<input type="file" name="file" required>
<button>Upload</button>
</form>

<?php foreach($folders as $key=>$label): ?>
<h3 id="<?= $key ?>"><?= $label ?></h3>
<table>
<tr><th>Name</th><th>Size</th><th>Action</th></tr>

<?php
$dir=$base.$key;
@mkdir($dir,0777,true);
$files=array_diff(scandir($dir),['.','..']);
if(!$files){
    echo "<tr><td colspan=3>No files</td></tr>";
}
foreach($files as $f):
$size=round(filesize("$dir/$f")/1024,1)." KB";
?>
<tr>
<td><?= htmlspecialchars($f) ?></td>
<td><?= $size ?></td>
<td>
<a class="btn open" target="_blank"
href="../user_uploads/<?= $userFolder ?>/<?= $key ?>/<?= urlencode($f) ?>">Open</a>
<a class="btn del"
href="../backend/delete_file.php?type=<?= $key ?>&file=<?= urlencode($f) ?>"
onclick="return confirm('Delete file?')">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endforeach; ?>

</div>
</div>
</body>
</html>