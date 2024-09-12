
<!DOCTYPE html>
<html>
<head>
    <title>Search </title>
</head>
<body>
<div class="container mb-4">
    <form class="d-flex" method="POST" id="searchForm">
      
        <input class="form-control me-2" type="search" name="search_term" id="searchInput" placeholder="Search" aria-label="Search" value="<?= isset($_POST['search_term']) ? $_POST['search_term'] : '' ?>">
              <button class="btn btn-outline-primary" type="submit">Search</button>
        
    </form>
</div>

<div class="container-fluid mb-4"> 
    <h5>View as:</h5>
    <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true && ($_SESSION['access_level'] == 'admin' || $_SESSION['access_level'] == 'moderate')): ?>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab" type="button" role="tab" aria-controls="List" aria-selected="true"
                onclick="redirectToPage('pageloglist')">List</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab" type="button" role="tab" aria-controls="Table" aria-selected="true"
                onclick="redirectToPage('pagelogtable')">Table</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab" type="button" role="tab" aria-controls="json" aria-selected="false"
                onclick="redirectToPage('pagelogjson')">JSON</button>
        </li>
    </ul>

    <?php endif; ?>
</div>

<script>
// Function to handle redirection while passing the search term
function redirectToPage(action) {
    var searchTerm = document.getElementById('searchInput').value;
    var url = 'index.php?action=' + action;
    
    if (searchTerm) {
        url += '&search_term=' + encodeURIComponent(searchTerm);
    }

    window.location.href = url;
}

// // Add 'active' class when a nav-link button is clicked
// let navLinks = document.querySelectorAll('.nav-link');

// navLinks.forEach(tab => {
//   btn.addEventListener('click', function() {
//     // Remove 'active' class from all nav-link buttons
//     navLinks.forEach(button => button.classList.remove('active'));

//     // Add 'active' class to the clicked button
//     this.classList.add('active');
//   });
// });

</script>
</body>