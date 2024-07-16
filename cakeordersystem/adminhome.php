<?php
require_once "controllerUserData.php";

// Set the user information manually
$fetch_info = [
    'id' => 11,
    'name' => 'ADMIN',
    'email' => 'batrisyia1019@gmail.com',
    'status' => 'verified'
];

// Assuming connection is stored in $con
// Query to fetch orders
$orderQuery = "SELECT * FROM orders"; // Adjust this query based on your database structure
$result = mysqli_query($con, $orderQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($fetch_info['name']); ?> | Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    nav {
        padding-left: 100px!important;
        padding-right: 100px!important;
        background: #e5a3a3;
        font-family: 'Poppins', sans-serif;
    } 
    nav a.navbar-brand {
        color: black;
        font-size: 30px!important;
        font-weight: 500;
    }
    button a {
        color: #e5a3a3;
        font-weight: 500;
    }
    button a:hover {
        text-decoration: none;
    }
    h1 {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 50px;
        font-weight: 600;
    }
    table {
        width: 90%;
        margin: 20px 0;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid #ddd;
    }
    th, td {
        padding: 12px;
        text-align: center;
    }
    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    </style>
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#"><?php echo htmlspecialchars($fetch_info['name']); ?></a>
        <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
    <center>
        <table class="order-table">
            <br>
            <h3>Customer's Order</h3>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Flavor</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Pickup Time</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
            <td><?php echo htmlspecialchars($row['telephone']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['flavor']); ?></td>
            <td><?php echo htmlspecialchars($row['size']); ?></td>
            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
            <td><?php echo htmlspecialchars($row['total_price']); ?></td>
            <td><?php echo htmlspecialchars($row['pickup']); ?></td>
            <td><?php echo htmlspecialchars($row['order_date']); ?></td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
            </td>
        </tr>
        <?php
    }
} else {
    echo "<tr><td colspan='10'>No orders found.</td></tr>";
}
?>

<!-- Add JavaScript at the end of your HTML body -->
<script>
function confirmDelete(orderId) {
    if (confirm("Are you sure you want to delete this order?")) {
        // Create a FormData object and append the order_id
        var formData = new FormData();
        formData.append('order_id', orderId);

        // Send an asynchronous request using fetch
        fetch('delete_order.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                alert('Order deleted successfully.');
                // Reload the page after deletion
                location.reload();
            } else {
                alert('Failed to delete order.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
}
</script>
            </tbody>
        </table>
        <div class="image-holder">
                    <img src="images/package.png" width="300" height="300" alt="Package Image" />
                </div>
    </center>
</body>
</html>
