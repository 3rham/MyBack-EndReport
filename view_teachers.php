<?php
require_once 'config.php';

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Updated query to match  database structure
    $stmt = $conn->query("SELECT teacher_id, name, address, phone, salary FROM teachers ORDER BY name ASC");
    $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Teachers - St. Alphonsus Primary School</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container-main {
            flex: 1;
            padding: 30px 15px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .table-container {
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 25px;
            margin-top: 20px;
        }
        .table thead th {
            background-color: #333;
            color: white;
        }
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
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
    <!-- Navbar -->
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

    <div class="container-main">
        <h2 class="text-center mb-4">Teacher Records</h2>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success text-center"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>
        
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($teachers)): ?>
                            <?php foreach ($teachers as $teacher): ?>
                                <tr>
                                    <td><?= htmlspecialchars($teacher['teacher_id']) ?></td>
                                    <td><?= htmlspecialchars($teacher['name']) ?></td>
                                    <td><?= htmlspecialchars($teacher['address']) ?></td>
                                    <td><?= htmlspecialchars($teacher['phone'] ?? 'N/A') ?></td>
                                    <td>£<?= number_format(htmlspecialchars($teacher['salary']), 2) ?></td>
                                    <td>
                                        <a href="delete_teacher.php?id=<?= $teacher['teacher_id'] ?>" 
                                           class="btn btn-danger btn-action" 
                                           onclick="return confirm('Are you sure you want to delete this teacher?')">
                                           Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <h5>No teachers found</h5>
                                    <a href="add_teacher.php" class="btn btn-primary mt-3">Add First Teacher</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer text-center p-3 mt-5">
        <p>&copy; 2025 St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>