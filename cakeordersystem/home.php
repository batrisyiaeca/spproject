<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
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
    </style>
</head>
<body>
    <nav class="navbar">
    <a class="navbar-brand" href="#"><?php echo $fetch_info['name'] ?></a>
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>


    <center>
	<table>
		<tr>
			<td>
				<br><h2 style="color:black;">Cake Order Form</h2>
					
                <form action="order.php" method="post">			  
                    <p><label>Customer name: </label>
                        <input id="a" name="customer_name" required type="text"></p>
					<p><label>Telephone: <input id="b" name="telephone" required></label></p>
					<p><label>E-mail address: <input type="email" id="c" name="email" required></label></p>
                    <form action="/action_page.php">

					<fieldset width="500">
						<legend style="color:black">
							<h2>Cake Flavours</h2>
                            <select name="flavours" id="flavours">
                            <option value="Vanilla">Vanilla</option>
                            <option value="Chocolate">Chocolate</option>
                            <option value="Red Velvet">Red Velvet</option>
                            <option value="Cheese">Cheese</option>
                        </select>
						</legend><br>
					</fieldset>

                    <fieldset>
						<legend style="color:black">
							<h2>Cake Size</h2>
                            <select name="size" id="size" onchange="calculateTotalPrice()">
                            <option value="Small">Small (RM 6.00)</option>
                            <option value="Medium">Medium (RM 12.00)</option>
                            <option value="Large">Large (RM 18.00)</option>
                        </select>
						</legend><br>
					</fieldset>

                    <fieldset>
						<legend style="color:black">
							<h2>Pickup order</h2>
                            <select name="pickup" id="pickup" onchange="calculateTotalPrice()">
                            <option value="02:00">02:00 PM</option>
                            <option value="03:00">03:00 PM</option>
                            <option value="04:00">04:00 PM</option>
                            <option value="05:00">05:00 PM</option>
                            <option value="06:00">06:00 PM</option>
                            <option value="07:00">07:00 PM</option>
                            <option value="08:00">05:00 PM</option>
 
                        </select>
						</legend><br>
					</fieldset>

					<h2>Quantity</h2><input type="number" id="quantity" name="quantity" min="1" onchange="calculateTotalPrice()"></p>						
					<h2>Total Price: RM <span id="totalPrice">0.00</span></h2>
					<p id="or">
						<input id="order" name="order" type="submit" value="Make an order" onclick="myFunction()">
						<input type="Reset" id="cl" value="Clear">
					</p>
			</td>
		</tr>
	</table>
	</form>
    </center>
    
<script>
	function myFunction() {
		confirm("Are you confirm to make the cake order?");
	}

	function calculateTotalPrice() {
		var quantity = parseInt(document.getElementById('quantity').value);
		var size = document.getElementById('size').value;
		var price = 0;

		if (size === 'Small') {
			price = 6.00;
		} else if (size === 'Medium') {
			price = 12.00;
		} else if (size === 'Large') {
			price = 18.00;
		}

		var totalPrice = price * quantity;
		document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);
	}
</script>
</body>
</html>
