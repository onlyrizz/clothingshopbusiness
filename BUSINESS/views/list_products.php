<?php
require_once __DIR__ . '/../config/db.php';

$sql = "
    SELECT 
        p.product_id, 
        p.product_name, 
        p.category, 
        p.price, 
        b.brand_name,
        u1.first_name AS added_by_name,
        u2.first_name AS updated_by_name,
        p.created_at,
        p.last_updated
    FROM products p
    JOIN brands b ON p.brand_id = b.brand_id
    LEFT JOIN users u1 ON p.added_by = u1.id
    LEFT JOIN users u2 ON p.last_updated_by = u2.id
    ORDER BY p.product_id DESC
";
$stmt = $pdo->query($sql);

echo "<h2>Product List</h2>";
echo "<table border='1' cellpadding='8' cellspacing='0' style='border-collapse:collapse;'>
<tr style='background:#f2f2f2; font-weight:bold;'>
    <th>ID</th>
    <th>Product</th>
    <th>Category</th>
    <th>Price</th>
    <th>Brand</th>
    <th>Added By</th>
    <th>Last Updated By</th>
    <th>Created At</th>
    <th>Last Updated</th>
</tr>";

while ($row = $stmt->fetch()) {
    echo "<tr>
        <td>{$row['product_id']}</td>
        <td>{$row['product_name']}</td>
        <td>{$row['category']}</td>
        <td>{$row['price']}</td>
        <td>{$row['brand_name']}</td>
        <td>" . ($row['added_by_name'] ?? 'N/A') . "</td>
        <td>" . ($row['updated_by_name'] ?? 'N/A') . "</td>
        <td>" . ($row['created_at'] ?? 'N/A') . "</td>
        <td>" . ($row['last_updated'] ?? 'N/A') . "</td>
    </tr>";
}
echo "</table>";
?>
