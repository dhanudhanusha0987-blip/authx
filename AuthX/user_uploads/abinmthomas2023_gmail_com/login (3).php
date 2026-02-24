<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>AuthX | Login</title>

<style>
body{
    margin:0;
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:'Poppins', Arial, sans-serif;
    background:linear-gradient(135deg,#0f4cff,#1a73e8);
}
.card{
    background:#fff;
    width:420px;
    padding:40px;
    border-radius:16px;
    box-shadow:0 25px 50px rgba(0,0,0,0.3);
    text-align:center;
}
h2{
    margin:0;
    color:#0f4cff;
}
.subtitle{
    font-size:13px;
    color:#555;
    margin-bottom:25px;
}
input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:14px;
}
button{
    width:100%;
    padding:12px;
    margin-top:10px;
    border:none;
    border-radius:8px;
    background:#0f4cff;
    color:#fff;
    font-size:16px;
    cursor:pointer;
}
button:hover{
    background:#0933b8;
}
.message{
    font-size:13px;
    color:#d93025;
    margin-bottom:10px;
}
a{
    display:block;
    margin-top:15px;
    font-size:14px;
    text-decoration:none;
    color:#0f4cff;
}
</style>
</head>

<body>

<div class="card">
    <h2>AuthX Login</h2>
    <div class="subtitle">Registered users only</div>

    <?php if(isset($_SESSION['login_error'])): ?>
        <div class="message">
            <?php echo htmlspecialchars($_SESSION['login_error']); ?>
        </div>
        <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>

    <form action="../backend/login.php" method="POST">
    <input type="email" name="email" placeholder="Email address" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

    <a href="register.html">Don't have an account? Register</a>
</div>

<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>