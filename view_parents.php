<?php
require_once 'config.php';

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->query("SELECT * FROM parents ORDER BY name ASC");
    $parents = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Parents - St. Alphonsus Primary School</title>
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
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container-main">
        <h2 class="text-center mb-4">Parent Records</h2>
        
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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($parents)): ?>
                            <?php foreach ($parents as $parent): ?>
                                <tr>
                                    <td><?= isset($parent['id']) ? htmlspecialchars($parent['id']) : 'N/A' ?></td>
                                    <td><?= isset($parent['name']) ? htmlspecialchars($parent['name']) : 'N/A' ?></td>
                                    <td><?= isset($parent['email']) ? htmlspecialchars($parent['email']) : 'N/A' ?></td>
                                    <td><?= isset($parent['phone']) ? htmlspecialchars($parent['phone']) : 'N/A' ?></td>
                                    <td>
    <?php if (isset($parent['parent_id'])): ?>
        
        <a href="delete_parent.php?id=<?= htmlspecialchars($parent['parent_id']) ?>" 
           class="btn btn-danger btn-action btn-sm" 
           onclick="return confirm('Are you sure you want to delete this parent?')">
           Delete
        </a>
    <?php else: ?>
        <span class="text-muted">No action</span>
    <?php endif; ?>
</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <h5>No parents found</h5>
                                    <a href="add_parent.php" class="btn btn-primary mt-3">Add First Parent</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>