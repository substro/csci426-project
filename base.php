<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/styles/base.css">
  <title>base</title>
</head>
<body>

<div class="wrapper">
  <div class="sidebar">
    <button class="toggle-button" onclick="toggleSidebar()">☰</button>
    <ul class="sidebar-nav">
      <li><a href="#" class="active">Dashboard</a></li>
      <li><a href="settings.php">Settings</a></li>
      <li><a href="projectBase.php">Projects</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>

  <div class="content">
    <div class="navbar">
      </div> 
    <h1>Coming soon ...</h1> 
  </div>
</div>

<script>
  function toggleSidebar() {
    document.querySelector('.wrapper').classList.toggle('sidebar-closed');
  }
</script>

</body>
</html>
