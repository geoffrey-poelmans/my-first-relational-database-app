<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=cogip;charset=utf8', 'root', '');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}

function showInvoices($value='')
{
  global $bdd;

  echo "
    <tr>
		<th>Company</th>
		<th>Nom du client</th>
     <th>Invoice date</th>
     <th>Designation</th>
    </tr>
  ";

  $reponse = $bdd->prepare('SELECT Invoices.invoice_number,Invoices.id_company,Invoices.customer_name,Invoices.invoice_date,Invoices.designation, company.company_name
FROM invoices, company
WHERE id_company = company.id');
  $reponse ->execute();

  foreach($reponse as $donnees)
  {
    echo "
      <tr>
				<td>" . $donnees['company_name'] . "</td>
				<td>" . $donnees['customer_name'] . "</td>
        <td>" . $donnees['invoice_date'] . "</td>
        <td>" . $donnees['designation'] . "</td>
        <td>
          <form class='' action='' method='post'>
            <input type='submit' name='submitShow' value='Show'>
						<input type='hidden' name='show' value='".$donnees['invoice_number']."'>
						<input type='hidden' name='hiddenPage' value='invoices.php'>
					</form>
          <form class='' action='update-invoices.php?id=". $donnees['invoice_number']."' method='post'>
            <input type='submit' name='submitEdit' value='Edit'>
            <input type='hidden' name='edit' value='".$donnees['invoice_number']."'>
            <input type='hidden' name='hiddenPage' value='invoices.php'>
          </form>
          <form class='' action='delete-invoices.php' method='post'>
            <input type='submit' name='submitDelete' value='Delete'>
            <input type='hidden' name='delete' value='".$donnees['invoice_number']."'>
            <input type='hidden' name='hiddenPage' value='invoices.php'>
          </form>
        </td>
      </tr>
    ";
  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Factures</title>
  </head>
  <body>
		<a href="log-in-form.php">Déconnexion</a>
	  <a href="accueil.php">Retour à l'accueil</a>
    <h1>Factures</h1>
    <h3>Factures</h3>
    <a href="#">Accueil</a>
    <a href="#">Fournisseurs</a>
    <a href="#">Clients</a>
    <form class="" action="add-factures.php" method="post">
			<input type="submit" name="submit" value="Ajouter une facture">
    </form>
    <table>
	  	<?php showInvoices(); ?>
    </table>
  </body>
</html>
