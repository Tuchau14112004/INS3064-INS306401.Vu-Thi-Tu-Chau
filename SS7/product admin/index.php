<?php
require_once 'Database.php';

// Get database connection using Singleton pattern
$db = Database::getInstance()->getConnection();

// Get user input from URL (search & category filter)
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

/*
    SQL query to retrieve product data along with category name
    - LEFT JOIN is used to ensure all products are displayed
      even if they do not belong to any category (category_id = NULL)
*/
$sql = "SELECT p.id, p.name, p.price, p.stock, c.category_name
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE 1=1";

// Initialize parameters array for prepared statement
$params = [];

/*
    Add search filter:
    - Use LIKE to search product name
    - Prepared statement prevents SQL Injection
*/
if (!empty($search)) {
    $sql .= " AND p.name LIKE :search";
    $params[':search'] = "%$search%";
}

/*
    Add category filter:
    - Filter products by selected category ID
    - Also uses prepared statement for security
*/
if (!empty($category)) {
    $sql .= " AND p.category_id = :category";
    $params[':category'] = $category;
}

// Sort products by newest (highest ID first)
$sql .= " ORDER BY p.id DESC";

/*
    Prepare and execute SQL query securely
    - prepare(): prevents SQL injection
    - execute(): binds parameters safely
*/
$stmt = $db->prepare($sql);
$stmt->execute($params);

// Fetch all results as associative array
$products = $stmt->fetchAll();

/*
    Retrieve all categories for dropdown filter
    - Using prepared statement (best practice)
*/
$catStmt = $db->prepare("SELECT * FROM categories");
$catStmt->execute();
$categories = $catStmt->fetchAll();

/*
    Dashboard statistics:
    - Total products
    - Number of products with low stock (< 10)
*/
$totalProducts = count($products);
$lowStock = count(array_filter($products, fn($p) => $p['stock'] < 10));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <!-- Import Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            display: flex;
        }

        /* Sidebar navigation */
        .sidebar {
            width: 220px;
            background: #2c3e50;
            color: white;
            height: 100vh;
            padding: 20px;
        }

        .sidebar h3 {
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #bdc3c7;
            padding: 10px;
            text-decoration: none;
            border-radius: 6px;
        }

        .sidebar a:hover {
            background: #34495e;
            color: white;
        }

        /* Main content */
        .main {
            flex: 1;
            padding: 20px;
        }

        .header {
            font-size: 22px;
            margin-bottom: 20px;
        }

        /* Dashboard cards */
        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .card h4 {
            margin: 0;
            color: #888;
        }

        .card h2 {
            margin-top: 10px;
        }

        /* Filter form */
        form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        input, select {
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            background: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        .reset {
            background: #95a5a6;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
        }

        /* Table styling */
        table {
            width: 100%;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            border-collapse: collapse;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        th {
            background: #34495e;
            color: white;
            padding: 12px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #f9f9f9;
        }

        /* Highlight products with low stock */
        .low-stock {
            background: #ffe5e5;
            color: #c0392b;
        }

        /* Status badge */
        .badge {
            padding: 5px 10px;
            border-radius: 6px;
            color: white;
            font-size: 12px;
        }

        .ok {
            background: #2ecc71;
        }

        .low {
            background: #e74c3c;
        }
    </style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3>🛒 Admin</h3>
    <a href="index.php">Dashboard</a>
    <a href="index.php">Products</a>
    <a href="index.php">Categories</a>
</div>

<!-- Main content -->
<div class="main">

    <div class="header">📊 Product Dashboard</div>

    <!-- Dashboard statistics -->
    <div class="cards">
        <div class="card">
            <h4>Total Products</h4>
            <h2><?= $totalProducts ?></h2>
        </div>

        <div class="card">
            <h4>Low Stock</h4>
            <h2><?= $lowStock ?></h2>
        </div>
    </div>

    <!-- Filter form -->
    <form method="GET">
        <input type="text" name="search" placeholder="Search..."
               value="<?= htmlspecialchars($search) ?>">

        <select name="category">
            <option value="">All Categories</option>
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c['id'] ?>"
                    <?= ($category == $c['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['category_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Filter</button>
        <a href="index.php" class="reset">Reset</a>
    </form>

    <!-- Product table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Stock</th>
            <th>Status</th>
        </tr>

        <?php foreach ($products as $p): ?>
        <tr class="<?= ($p['stock'] < 10) ? 'low-stock' : '' ?>">
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td>$<?= number_format($p['price'], 2) ?></td>
            <td><?= htmlspecialchars($p['category_name'] ?? 'No Category') ?></td>
            <td><?= $p['stock'] ?></td>
            <td>
                <?php if ($p['stock'] < 10): ?>
                    <span class="badge low">Low</span>
                <?php else: ?>
                    <span class="badge ok">OK</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</div>

</body>
</html>
