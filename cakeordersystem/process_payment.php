<?php
require_once "controllerUserData.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        exit("Invalid CSRF token"); 
    }

    // Retrieve the form data
    $cardNumber = $_POST["cardNumber"];
    $expiryDate = $_POST["expiryDate"];
    $cvv = $_POST["cvv"];

    $transactionId = generateTransactionId();
    
    // Database connection configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "users";

    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Encryption settings
    $encryptionKey = "Cake@123";
    $encryptionMethod = "AES-256-CBC";
    $iv = "Cakeisdelicious!"; // 16 bytes IV

    // Encrypt sensitive data
    $encryptedCardNumber = openssl_encrypt($cardNumber, $encryptionMethod, $encryptionKey, 0, $iv);
    $encryptedExpiryDate = openssl_encrypt($expiryDate, $encryptionMethod, $encryptionKey, 0, $iv);
    $encryptedCVV = openssl_encrypt($cvv, $encryptionMethod, $encryptionKey, 0, $iv);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO payments (card_number, expiry_date, cvv, transaction_id) VALUES (?, ?, ?, ?)");

    // Bind the parameters to the statement
    $stmt->bindParam(1, $encryptedCardNumber);
    $stmt->bindParam(2, $encryptedExpiryDate);
    $stmt->bindParam(3, $encryptedCVV);
    $stmt->bindParam(4, $transactionId);

    // Execute the statement
    $stmt->execute();

    // Close the database connection
    $conn = null;
}

// Generate a random transaction ID
function generateTransactionId() {
    $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $transactionId = "";
    for ($i = 0; $i < 10; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $transactionId .= $characters[$randomIndex];
    }
    return $transactionId;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $fetch_info['name'] ?> | Home</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    nav{
        padding-left: 100px!important;
        padding-right: 100px!important;
        background: #e5a3a3;
        font-family: 'Poppins', sans-serif;
    } 
    nav a.navbar-brand{
        color: black;
        font-size: 30px!important;
        font-weight: 500;
    }
    button a{
        color: #e5a3a3;
        font-weight: 500;
    }
    button a:hover{
        text-decoration: none;
    }
    h1{
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 50px;
        font-weight: 600;
    }
    h2{
        position: absolute;
        top: 20%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 50px;
        font-weight: 600;
    }
    h3{
        position: absolute;
        top: 30%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 30px;
        font-weight: 600;
    }
    .image-holder {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Or any specific height you want */
        }
        .image-holder img {
            margin: auto;
            display: block;
        }
    </style>
</head>
<body>
<body>
    <nav class="navbar">
    <a class="navbar-brand" href="#">Payment</a>
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
    <br>
    <div class="container">
        <div class="transaction-id">
            <h2>Transaction ID: <?php echo $transactionId; ?> </h2>
        </div>
        <div class="message">
            <h3>Please wait for our staff to call you to pick up the order.</h3>
        </div>
        <div class="image-holder">
    <img src="images/call.png" width="300" height="300" alt="Calling Image" />
</div>
        </div>
    </div>
</body>
</html>