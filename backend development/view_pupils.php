<?php
require 'db_connect.php';

$sql = "SELECT p.pupil_id, p.name, p.address, p.medical_info, c.class_name 
        FROM pupils p
        JOIN classes c ON p.class_id = c.class_id
        ORDER BY p.name ASC";

$result = $conn->query($sql);

if (!$result) {
    die("Database error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Pupils - St. Alphonsus Primary School</title>
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
            background-color: var(--primary-color);
            color: white;
        }
        .navbar {
            background-color: var(--primary-color) !important;
            padding: 10px 0;
        }
        .footer {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>

<!-- complete navigation menu -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="logo9.png" alt="School Logo" width="40"> St. Alphonsus Primary
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                
                <!-- pupils dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Pupils</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="add_pupil.php">Add Pupil</a></li>
                        <li><a class="dropdown-item" href="view_pupils.php">View All Pupils</a></li>
                    </ul>
                </li>
                
                <!-- teachers dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Teachers</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="add_teacher.php">Add Teacher</a></li>
                        <li><a class="dropdown-item" href="view_teachers.php">View All Teachers</a></li>
                    </ul>
                </li>
                
                <!-- classes dropdown -->
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
                
                <!-- parents dropown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Parents</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="add_parent.php">Add Parent</a></li>
                        <li><a class="dropdown-item" href="view_parents.php">View All Parents</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- main content -->
<div class="container-main">
    <h2 class="text-center mb-4">Pupil Records</h2>
    
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
                        <th>Medical Info</th>
                        <th>Class</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['pupil_id']) ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['address']) ?></td>
                                <td><?= nl2br(htmlspecialchars($row['medical_info'])) ?></td>
                                <td><?= htmlspecialchars($row['class_name']) ?></td>
                                <td>
                                    <a href="delete_pupil.php?id=<?= htmlspecialchars($row['pupil_id']) ?>" 
                                       class="btn btn-danger btn-action btn-sm" 
                                       onclick="return confirm('Are you sure you want to delete this pupil?')">
                                       Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <h5>No pupils found</h5>
                                <a href="add_pupil.php" class="btn btn-primary mt-3">Add First Pupil</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- footer -->
<footer class="footer">
    <div class="container">
        <p class="mb-0">&copy; 2024 St. Alphonsus Primary School. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
