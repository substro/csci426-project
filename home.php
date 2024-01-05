<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="./assets/styles/reset.css">
	<link rel="stylesheet" href="./assets/styles/home.css">

	<title>Dashboard</title>
</head>

<body>
	<div class="dashboard">
		<div class="sidebar" id="sidebar">
			<!-- Sidebar content -->
			<ul class="sidebar-nav">
				<li><a href="#">Dashboard</a></li>
				<li><a href="#">Profile</a></li>
				<li><a href="#">Settings</a></li>
				<li><a href="#">Logout</a></li>
			</ul>
		</div>
		<div class="content">
			<div class="title-bar">
				<button onclick="toggleDrawer()">Toggle Sidebar</button>
				<div class="avatar"></div>
				<!-- Title bar content -->
			</div>
			<h1>hello</h1>
			<!-- Main content -->
		</div>
	</div>
	<script>
		const sidebar = document.getElementById('sidebar');

		function toggleDrawer() {
			sidebar.classList.toggle('closed');
		}
	</script>
</body>

</html>