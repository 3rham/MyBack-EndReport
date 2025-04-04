<?php
require 'db_connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$classes = $conn->query("SELECT class_id, class_name FROM classes");
if (!$classes) {
    die("Error loading classes: " . $conn->error);
}

$class_count = $classes->num_rows;
error_log("Fetched $class_count classes from database");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pupil - St. Alphonsus Primary School</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
        .content {
            max-width: 600px;
            text-align: center;
        }
        .image-section img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .navbar {
            background-color: #333;
        }
        .footer {
            background-color: #333;
            color: white;
        }
        .logo {
            width: 200px;
            display: block;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>
    <!-- /Applications/XAMPP/xamppfiles/htdocsvbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="logo9.png" alt="School Logo" width="50"> St. Alphonsus Primary
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>

         
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Pupils</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="add_pupil.php">Add Pupil</a></li>
                            <li><a class="dropdown-item" href="view_pupils.php">View All Pupils</a></li>
                        </ul>
                    </li>

                    <!-- Teacheers Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Teachers</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="add_teacher.php">Add Teacher</a></li>
                            <li><a class="dropdown-item" href="view_teachers.php">View All Teachers</a></li>
                        </ul>
                    </li>

                    <!-- Classes Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Classes</a>
                        <ul class="dropdown-menu">
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
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Parents</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="add_parent.php">Add Parent/Guardian</a></li>
                            <li><a class="dropdown-item" href="view_parents.php">View All Parents</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<!-- main Content -->
<div class="container my-5">
    <div class="form-container">
        <h2 class="text-center mb-4">Add New Pupil</h2>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>
        
        <form action="process_add_pupil.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            
            <div class="mb-3">
                <label for="medical_info" class="form-label">Medical Information</label>
                <textarea class="form-control" id="medical_info" name="medical_info" rows="3"></textarea>
            </div>
            
            <!-- CLASS SELECTION DROPDOWN 
            <div class="mb-3">
                <label for="class_id" class="form-label">Class</label>
                <select class="form-select" id="class_id" name="class_id" required>
                    <?php if ($class_count > 0): ?>
                        <?php while ($class = $classes->fetch_assoc()): ?>
                            <option value="<?= $class['class_id'] ?>">
                                <?= htmlspecialchars($class['class_name']) ?>
                            </option>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <option value="" disabled>No classes found in database</option>
                    <?php endif; ?>
                </select>
                <?php if ($class_count === 0): ?>
                    <div class="text-danger mt-1">Please add classes to the database first</div>
                <?php endif; ?>
            </div>
            
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-dark px-4 py-2">Add Pupil</button>
            </div>
        </form>
    </div>
</div>

<!-- Footer -->
    <footer class="footer text-center p-3 mt-5">
        <p>&copy; 2025 St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>