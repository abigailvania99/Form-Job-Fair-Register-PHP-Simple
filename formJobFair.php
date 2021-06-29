<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registration Job Fair</title>
</head>
<style>
.error {color: #FF0000;}
fieldset {
  background-color: #eeeeee;
}

legend {
  background-color: gray;
  color: white;
  padding: 5px 10px;
}
</style>

<body>
    <?php
        $nameErr = $emailErr = $genderErr = $phoneErr = "";
        $name = $email = $gender = $phone = "";
        $flag=0;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
                $flag=1;
            } else {
                $name = $_POST["name"];
            }
            
            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
                $flag=1;
            } else {
                $email = $_POST["email"];
            }
                
            if (empty($_POST["phone"])) {
                $phoneErr = "Phone is required";
                $flag=1;
            } else {
                $phone = $_POST["phone"];
            }

            if (empty($_POST["gender"])) {
                $genderErr = "Gender is required";
                $flag=1;
            } else {
                $gender = $_POST["gender"];
            }

            if($flag != 1){
                $flag=2;
            }
        }
    ?>

    <h1 style="text-align: center;">Form Registration Job Fair</h1>
<center>
<fieldset>
<legend>Registration:</legend>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

Name: <input type="text" name="name"><br>
<span class="error"><?php echo $nameErr;?></span>
<br><br>
E-mail:
<input type="text" name="email"><br>
<span class="error"> <?php echo $emailErr;?></span>
<br><br>
Phone:
<input type="text" name="phone"><br>
<span class="error"><?php echo $phoneErr;?></span>
<br><br>
Gender:
<input type="radio" name="gender" value="female">Female
<input type="radio" name="gender" value="male">Male
<input type="radio" name="gender" value="other">Other
<br>
<span class="error"><?php echo $genderErr;?></span>
<br><br>
<input type="submit" name="submit" value="Submit">

</form>
</fieldset>


<?php
if($flag == 2){
    echo "<h2>Your Input:</h2>";
    echo $name;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $phone;
    echo "<br>";
    echo $gender. "<br><br>";

    $conn = new PDO("mysql:host=localhost;dbname=jobfairregister", "root", "");

    $queryMasukkanCustomer = "INSERT INTO `peserta` (`id`, `name`, `email`, `phone`, `gender`) VALUES (NULL, '$name', '$email', '$phone', '$gender')";
    // $queryMasukkanCustomer = "INSERT INTO peserta ('name', email, phone,gender) VALUES ($name, $email, $phone, $gender)";
	$stmt = $conn->prepare($queryMasukkanCustomer); 
	$stmt->execute();

    $queryAmbilCustomer = "SELECT * FROM peserta";
		$stmt = $conn->prepare($queryAmbilCustomer); 
		$stmt->execute();
		
		foreach($stmt->fetchAll() as $customer) { 
	        echo $customer["name"]. " | ". $customer["email"]. " | ". $customer["phone"]. "<br>";
	    }
}
?>
</center>

</body>
</html>