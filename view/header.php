
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
    <div class="container-fluid">
    
    <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
      <a class="navbar-brand" href="index.php?action=home">Home</a>
      <a class="navbar-brand" href="index.php?action=discordLogin">Discord</a>
      <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true && ($_SESSION['access_level']== 'admin'|| $_SESSION['access_level']== 'moderator')): ?>
      <a class="navbar-brand" href="index.php?action=pageloglist">Page Log</a>
      <?php endif; ?>
      <?php endif; ?>
      <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true && ($_SESSION['access_level']== 'admin')): ?>
      <a class="navbar-brand" href="index.php?action=permission">Permission</a>
            <?php endif; ?>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> 
      
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
          
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=logout"><i class="bi-box-arrow-in-right"></i> Logout</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=login"> <i class="bi-box-arrow-in-right"></i> Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=register"> <i class="bi bi-person-plus"></i> Sign Up</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
