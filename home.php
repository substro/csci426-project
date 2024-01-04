<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Dashboard</title>
	<style>
		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
			display: flex;
			min-height: 100vh;
		}

		.dashboard {
			display: flex;
			flex: 1;
		}

		.title-bar {
			background-color: #333;
			color: #fff;
			position: sticky;
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 10px 20px;
			max-width: 100%;
		}

		.sidebar {
			background-color: #333;
			color: #fff;
			width: 250px;
			transition: width 0.3s ease;
			overflow: hidden;
			flex-shrink: 0;
			/* Sidebar won't shrink */
			height: 100vh;
			/* Extend sidebar to full height */
		}

		.sidebar.closed {
			width: 50px;
			/* Adjust the width when partially closed */
		}

		.content {
			flex: 1;
			max-width: 100%;
		}

		.menu-toggle {
			cursor: pointer;
			padding: 10px;
			background-color: #444;
			text-align: center;
			user-select: none;
		}

		.menu-toggle:hover {
			background-color: #555;
		}

		.avatar {
			width: 30px;
			height: 30px;
			border-radius: 50%;
			background-color: #fff;
			/* Placeholder color for avatar */
			/* Add your avatar image or initials styling */
		}
	</style>
</head>

<body>
	<div class="dashboard">
		<div class="sidebar" id="sidebar">
			<!-- Sidebar content -->
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