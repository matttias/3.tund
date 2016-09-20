<?php
$signupEmailError = "";
$signupPasswordError = "";
$signupPasswordError2 = "";
$signupUsernameError = "";
//kas on üldse olemas selline muutuja
if(isset($_POST["signupEmail"])){
	//jah on olemas
	//kas on tühi
	if(empty($_POST["signupEmail"])){
		$signupEmailError = "See väli on kohustuslik";	
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
	
		<input name="signupUsername" placeholder="Kasutajanimi" type="text"> <?php echo $signupUsernameError; ?> <br><br>
		<input name="signupPassword" placeholder="Parool" type="password"> <?php echo $signupPasswordError; ?> <br><br>
		<input name="signupPassword2" placeholder="Sisesta parool uuesti" type="password"> <?php echo $signupPasswordError2; ?> <br><br>
		<input name="signupEmail" placeholder="E-post" type="text"> <?php echo $signupEmailError; ?> <br><br>
		<input name="signupGender" value="mees" type="radio" > Mees <br>
		<input name="signupGender" value="naine" type="radio" > Naine <br>
		<input name="signupGender" value="muu" type="radio" > Ei soovi avaldada <br><br>
		<input type="submit" value="Loo kasutaja">
	
	</form>
	
</body>
</html>

