<?php

require 'DBconnect.php';

function optionCompany($value='')
{
	global $bdd;
	$reponse = $bdd->prepare('SELECT * FROM company');
	$reponse ->execute();

	foreach($reponse as $donnees)
	{
		echo "
			<option value='". $donnees['id'] ."'>". $donnees['company_name'] ."</option>
		";
	}
}

function optionCustomer($value='')
{
	global $bdd;
	$reponse = $bdd->prepare('SELECT * FROM customers');
	$reponse ->execute();

	foreach($reponse as $donnees)
	{
		echo "
			<option value='". $donnees['last_name'] ."'>". $donnees['last_name'] ."</option>
		";
	}
}

function addFactures($value='')
{
	global $bdd;

	$invoice_number = NULL;
	$id_company = $_POST["id_company"];
	$customer_name = $_POST["customer_name"];
	$invoice_date = $_POST["invoice_date"];
	$designation = $_POST["designation"];

	if ($invoice_date != NULL AND $customer_name != "Choose" AND $id_company != "Choose" AND $designation != "") {
		$sql = $bdd->prepare('INSERT INTO invoices(invoice_number, id_company, customer_name, invoice_date, designation) VALUES(:invoice_number, :id_company, :customer_name, :invoice_date, :designation)');
		$sql->execute(array(
			'invoice_number' => $invoice_number,
			'id_company' => $id_company,
			'customer_name' => $customer_name,
			'invoice_date' => $invoice_date,
			'designation' => $designation
		));
		header("Location:invoices.php");
	}else {
    echo "Champs incomplets";
  }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<title>Ajout d'une facture</title>
</head>
<body>
<?php include 'header.php' ?>
    <h3>Création d'une facture</h3>
	<form action="" method="post">
		<div>
			<label for='id_company'>Société</label>
			<select name='id_company'>
				<option value='Choose'>Choose</option>
				<?php optionCompany(); ?>
			</select>
		</div>
		<div>
			<label for='customer_name'>Nom du client</label>
			<select name='customer_name'>
				<option value='Choose'>Choose</option>
				<?php optionCustomer(); ?>
			</select>
		</div>
		<div>
			<label for="invoice_date">Date de la facture</label>
			<input type="date" name="invoice_date">
		</div>
	    <div>
			<label for="designation">Objet de la facture</label>
			<input type="textarea" name="designation" value="">
		</div>
	    </div>
		<button type="submit" name="button">Envoyer</button>
	</form>
	<?php if (isset($_POST["button"])) addFactures(); ?>
</body>
</html>
