<?php

require 'DBconnect.php';

echo $_SESSION["TypeUser"];

function showPeople($value='')
{
  global $bdd;

  echo "
    <tr>
		<th>Company</th>
     <th>Last name</th>
     <th>First name</th>
     <th>Phone number</th>
     <th>Email</th>
    </tr>
  ";

  $reponse = $bdd->prepare('SELECT * FROM customers');
  $reponse ->execute();

  foreach($reponse as $donnees)
  {
    echo "
      <tr>
				<td>" . $donnees['company'] . "</td>
        <td>" . $donnees['last_name'] . "</td>
        <td>" . $donnees['first_name'] . "</td>
        <td>" . $donnees['phone_number'] . "</td>
        <td>" . $donnees['email'] . "</td>
        <td>
          <form class='' action='' method='post'>
            <input type='submit' name='submitShow' value='Show'>
            <input type='hidden' name='show' value='".$donnees['Customer_number']."'>
            <input type='hidden' name='hiddenPage' value='annuaire.php'>
          </form>
          <form class='' action='update-annuaire.php?id=". $donnees['Customer_number']."' method='post'>
            <input type='submit' name='submitEdit' value='Edit'>
            <input type='hidden' name='edit' value='".$donnees['Customer_number']."'>
            <input type='hidden' name='hiddenPage' value='annuaire.php'>
          </form>
          <form class='' action='delete-annuaire.php' method='post'>
						<input type='submit' name='submitDelete' value='Delete'>
						<input type='hidden' name='delete' value='".$donnees['Customer_number']."'>
						<input type='hidden' name='hiddenPage' value='annuaire.php'>
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
    <title>Annuaire</title>
  </head>
  <body>
		<?php include 'header.php' ?>
    <form class="" action="add-contact-bulma.php" method="post">
      <input type="submit" name="submit" value="Ajouter un client">
    </form>
    <table>
	  	<?php showPeople(); ?>
    </table>
  </body>
</html>
