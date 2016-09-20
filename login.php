<?php

require("../../config.php");

//echo hash("sha512", "Mattias");
$signupEmailError = "";
$signupPasswordError = "";
$signupPasswordError2 = "";
$signupUsernameError = "";
$signupEmail = "";
$signupGender = "";
//kas on üldse olemas selline muutuja
if(isset($_POST["signupEmail"])){
	//jah on olemas
	//kas on tühi
	if(empty($_POST["signupEmail"])){
		$signupEmailError = "See väli on kohustuslik";	
	} else {
		//email on olemas
		$signupEmail = $_POST["signupEmail"];
	}
}
if(isset($_POST["signupUsername"])) {
	if(empty($_POST["signupUsername"])){
		$signupUsernameError = "Igal kasutajal peab olema kasutajanimi";
	}
}
if(isset($_POST["signupPassword"])) {
	if(empty($_POST["signupPassword"])){
		$signupPasswordError = "Parool peab olema";
	} else {
		//Siia jõuan siis kui parool on olemas ja kui parool ei ole tühi
		//kas parooli pikkus on väiksem kui kaheksa
			if (strlen($_POST["signupPassword"]) < 8) {
			$signupPasswordError = "Parool peab olema vähemalt 8 tähemärki pikk";
			}
		}
}
if(isset($_POST["signupPassword2"])) {	
	if(empty($_POST["signupPassword2"])){
		$signupPasswordError2 = "Parool peab olema";
	} else {
		//Siia jõuan siis kui parool on olemas ja kui parool ei ole tühi
		//kas parooli pikkus on väiksem kui kaheksa
		if (strlen($_POST["signupPassword2"]) < 8) {
			$signupPasswordError2 = "Parool peab olema vähemalt 8 tähemärki pikk";
		}else {
			//Kontrollin, kas paroolid ühtivad
			if ($_POST["signupPassword2"] != $_POST["signupPassword"]){
			$signupPasswordError2 = "Paroolid ei ühti";
					} 
			}
		}
	}
if( isset( $_POST["signupGender"] ) ){
		if(!empty( $_POST["signupGender"] ) ){
			$signupGender = $_POST["signupGender"];
		}
		
} 

//peab olema email ja parool ja ühtegi errorit 

if ( isset($_POST["signupEmail"]) && 
	 isset($_POST["signupPassword"]) &&
	 isset($_POST["signupPassword2"]) &&
 	 ($_POST["signupPassword2"] == $_POST["signupPassword"]) &&
	 $signupEmailError == "" && 
	 empty($signupPasswordError)) 
{
//salvestame andmebaasi
	echo "Salvestan... <br>";
	echo "email: ".$signupEmail."<br>";
	echo "password: ".$_POST["signupPassword"]."<br>";
	$password = hash("sha512", $_POST["signupPassword"]);
	echo "password hashed: ".$password."<br>";

	//echo $serverUsername;
	//ühendus
	$database = "if16_mattbleh_2";
	$database = "if16_romil";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);

		// mysqli rida
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		echo $mysqli->error;
		// stringina üks täht iga muutuja kohta (?), mis tüüp
		// string - s
		// integer - i
		// float (double) - d
		// küsimärgid asendada muutujaga
		$stmt->bind_param("ss", $signupEmail, $password);
		
		//täida käsku
		if($stmt->execute()) {
			echo "Salvestamine õnnestus";
			
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		//panen ühenduse kinni
		$stmt->close();
		$mysqli->close();
	
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Logi sisse või loo kasutaja</title>
</head>
<body>

	<h1>Logi sisse</h1>
	<form method="POST">
	
		<label>Kasutajanimi</label> <br>
		<input name="loginUsername" type="text"> <br><br>
		<input name="loginPassword" placeholder="Parool" type="password"> <br><br>
		<input type="submit" value="Logi sisse">
	
	</form>

	<h1>Loo kasutaja</h1>
	<form method="POST"> <br>
	
		<input name="signupUsername" placeholder="Kasutajanimi" type="text" > <?=$signupUsernameError; ?> <br><br>
		<input name="signupPassword" placeholder="Parool" type="password"> <?php echo $signupPasswordError; ?> <br><br>
		<input name="signupPassword2" placeholder="Sisesta parool uuesti" type="password"> <?php echo $signupPasswordError2; ?> <br><br>
		<input name="signupEmail" placeholder="E-post" type="text" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?> <br><br>
		
		<?php if($signupGender == "mees") { ?>
			<input name="signupGender" value="mees" type="radio" checked> Mees <br>
		<?php }else { ?> <!--Tühikud peavad olema-->
			<input name="signupGender" value="mees" type="radio"> Mees <br>
		<?php } ?>	
		
		
		<?php if($signupGender == "naine") { ?>
			<input name="signupGender" value="naine" type="radio" checked> Naine <br>
		<?php }else { ?> <!--Tühikud peavad olema-->
			<input name="signupGender" value="naine" type="radio"> Naine <br>
		<?php } ?>
		
		
		<?php if($signupGender == "muu") { ?>
			<input name="signupGender" value="muu" type="radio" checked> Ei soovi avaldada <br><br>
		<?php }else { ?> <!--Tühikud peavad olema-->
			<input name="signupGender" value="muu" type="radio"> Ei soovi avaldada <br><br>
		<?php } ?>
			
			
		<input type="submit" value="Loo kasutaja">
	
	</form>
	
</body>
</html>

















