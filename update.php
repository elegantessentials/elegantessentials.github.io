<?php 
    include('./partials/connect.php'); 

    $userdisplay = ''; 
    $emaildisplay = ''; 
    $mobiledisplay = ''; 
    $update_id=''; 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        if (isset($_POST['update'])) { 
            $name = $_POST['name']; 
            $email = $_POST['email']; 
            $address = $_POST['address']; 
            $number = $_POST['number']; 

            // Update query using the mobile number to identify the record
            $update_query = "UPDATE `customer` SET name='$name', email='$email', address='$address' WHERE number='$number'"; 
            $result_query = mysqli_query($con, $update_query); 

            if ($result_query) { 
                echo "<script>alert('Data updated successfully')</script>"; 
                echo "<script>window.open('display.php','_self')</script>"; 
            } else { 
                die(mysqli_error($con)); 
            } 
        } 
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD Updating Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 15px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
   <div class="container">
       <form action="" method="post">
           <div class="form-group">
               <label>Name</label>
               <input type="text" required="required" autocomplete="off" placeholder="Enter your username" name="name" value="<?php echo $userdisplay ?>">
           </div>

           <div class="form-group">
               <label>Email</label>
               <input type="email" required="required" autocomplete="off" placeholder="Enter your email" name="email" value="<?php echo $emaildisplay ?>">
           </div>

            <div class="form-group">
               <label>Mobile number</label>
               <input type="text" required="required" autocomplete="off" placeholder="Enter your mobile number" name="number" value="<?php echo $mobiledisplay ?>" minlength="10" maxlength="10">
           </div>

           <div class="form-group">
               <label>Address</label>
               <input type="text" required="required" autocomplete="off" placeholder="Enter your address" name="address">
           </div>

           <button type="submit" name="update">Update</button>
       </form>
   </div>   
</body>
</html>
