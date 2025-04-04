   <!-- There on the side to use if needed -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'St. Alphonsus Primary School'; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- your custom CSS -->
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: left;
            padding: 50px;
        }
        .navbar {
            background-color: #333 !important;
        }
        /* Add any other custom styles here */
    </style>
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="logo9.png" alt="School Logo" width="50"> St. Alphonsus Primary
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    
                    <!-- Pupils Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pupilsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pupils
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="pupilsDropdown">
                            <li><a class="dropdown-item" href="add_pupil.php">Add Pupil</a></li>
                            <li><a class="dropdown-item" href="view_pupils.php">View All Pupils</a></li>
                        </ul>
                    </li>
                    
                    <!-- Teachers Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="teachersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Teachers
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="teachersDropdown">
                            <li><a class="dropdown-item" href="add_teacher.php">Add Teacher</a></li>
                            <li><a class="dropdown-item" href="view_teachers.php">View All Teachers</a></li>
                        </ul>
                    </li>
                    
                    <!-- Classes Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="classesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Classes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="classesDropdown">
                            <li><a class="dropdown-item" href="reception_year.php">Reception Year</a></li>
                            <li><a class="dropdown-item" href="year_one.php">Year One</a></li>
                            <li><a class="dropdown-item" href="year_two.php">Year Two</a></li>
                            <li><a class="dropdown-item" href="year_three.php">Year Three</a></li>
                            <li><a class="dropdown-item" href="year_four.php">Year Four</a></li>
                            <li><a class="dropdown-item" href="year_five.php">Year Five</a></li>
                            <li><a class="dropdown-item" href="year_six.php">Year Six</a></li>
                        </ul>
                    </li>
                    
                    <!-- Parents Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="parentsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Parents
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="parentsDropdown">
                            <li><a class="dropdown-item" href="add_parent.php">Add Parent/Guardian</a></li>
                            <li><a class="dropdown-item" href="view_parents.php">View All Parents</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Content Container -->
    <div class="container main-container">