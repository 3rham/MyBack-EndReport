<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO teachers (name, address, phone, salary) VALUES (:name, :address, :phone, :salary)");
        $stmt->execute([
            ':name' => $_POST['name'],
            ':address' => $_POST['address'],
            ':phone' => $_POST['phone'],
            ':salary' => $_POST['salary']
        ]);

        header("Location: view_teachers.php?success=Teacher+added+successfully");
        exit();
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher - St. Alphonsus Primary School</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        :root {
            --primary-color: #333;
            --secondary-color: #555;
        }
        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin: 30px auto;
            max-width: 700px;
        }
        .form-title {
            color: #333;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        .btn-submit {
            background-color: #4CAF50;
            border: none;
            padding: 10px 25px;
            font-weight: 500;
        }
        .btn-submit:hover {
            background-color: #3e8e41;
        }
        .navbar {
            background-color: #333 !important;
        }
        .footer {
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
    <!-- nav-bar -->
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Teachers</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="add_teacher.php">Add Teacher</a></li>
                            <li><a class="dropdown-item" href="view_teachers.php">View All Teachers</a></li>
                        </ul>
                    </li>
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

    <!-- Content -->
    <div class="container my-5">
        <div class="form-container">
            <h2 class="form-title text-center">Add New Teacher</h2>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="add_teacher.php">
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name *</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address *</label>
                    <textarea class="form-control" id="address" name="address" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number *</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary *</label>
                    <input type="number" step="0.01" class="form-control" id="salary" name="salary" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-submit btn-lg">Add Teacher</button>
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