<?php
	session_start();
   ob_start(); 
   
  $id=$_GET['id'];
 try {$bdd = new pdo('mysql:host=localhost;dbname=nissan', 'root', '');} catch (Exception $e) {die('Erreur : '.$e->getMessage()); }   
$req=$bdd->query('select * from command,item,modele_veh,client where (command.id_command='.$id.' and item.id_command=command.id_command and item.id_modele_veh=modele_veh.id_modele_veh and modele_veh.designation=item.designation and client.id_client=command.id_client)');
  $i=0;
  $sommeQte=0;
  $somme_prix_selon=0;
   while ($donnee2=$req->fetch()) {

     $des[$i]=$donnee2['designation'];
     $Qte[$i]=$donnee2['quantite'];
     $sommeQte=$sommeQte+$donnee2['quantite'];
     $couleur[$i]=$donnee2['couleur'];
     $prix[$i]=$donnee2['TTC'];
     $prix_selon[$i]=$donnee2['prix_selon_bon'];
     $somme_prix_selon=$somme_prix_selon+$donnee2['prix_selon_bon'];
     $timbre=$donnee2['TIMBRE'];
     $num=$donnee2['numero_bon'];
     $nom=$donnee2['nom'];
     $date=$donnee2['date_command'];
     $delai=$donnee2['dalai_livraison'];
     $adresse=$donnee2['adresse'];
     $tel=$donnee2['tele'];
     $total=$donnee2['montat'];
     $mode=$donnee2['mode_de_paymant'];
     $adress_liv=$donnee2['adresse_livraison'];
     $matricul=$donnee2['matricul_fiscal'];
     $registe=$donnee2['n_registre'];
     $date_verse=$donnee2['date_de_versement'];
     $verser=$donnee2['montant_verser'];
    $reste=$donnee2['rest_a_payer'];


     $i=$i+1;   
   }
   $prixht=$somme_prix_selon-($timbre*$sommeQte);
$cont=$i;
$req->closeCursor();


?>


<page backtop="0mm" backleft="10mm" backright="10mm" backbottom="8mm" >
  <link href="css.css" rel="stylesheet" type="text/css" />
<div id="header">
         <div id="logo">
            <img src="images/nissan.png" id="logo_nissan" />
         </div>
         <div id="slogo">
        <p id="titre1">DJURDJURA MOTORS, Akbou</p>
        <p id="titre2">AGENT AGREE NISSAN ALGERIE</p>
        <p id="text1">
          siège social:La RN 26,Azaghar,Akbou,bejaia<br>
          Mob:0552 27 45 95<br>
          Email:djurdjuramotors@hotmail.com<br>
          www.nissan.dz
        </p>
            </div>
            <h3 id="bon">BON DE COMMANDE</h3>
</div>
<div id="body">
  <table   id="info">
  <tr>
    <td colspan="2" width="430" class="ligne1"><strong>N°:</strong> <?php echo $num; ?></td>
    <td width="250" class="ligne1"><strong>Vendeur:</strong> <?php echo $_SESSION['nom']; ?></td>
  </tr>
  <tr>
    <td colspan="2" class="ligne2">client</td>
    <td class="ligne2"><?php echo'adresse de livraison';?></td>
  </tr>
  <tr >
    <td  colspan="2" class="ligne3"><p>Nom: <?php echo $nom;?></p>

      <p>Adresse: <?php echo $adresse;?> </p>

      <p>Tel : <?php echo $tel;?></p>

      <p>Mat.fisc: <?php echo $matricul;?></p>

      <p>Registre de commerce N°: <?php echo $registe;?></p>
    </td>
    <td class="ligne31"><?php echo'DJURDJURA motors akbou';?></td>
  </tr>
  <tr>
    <td class="ligne40" height="15">DATE DE<br>COMMANDE</td>
    <td class="ligne400"><?php echo $date;?></td>
    <td rowspan="3 "class="ligne41">
                                <p>Versement: <?php echo $verser?></p>

                                <p>Date:<?php $date_verse?></p>

                                <p>Montant en Chiffre: <?php ?></p>
    </td>
  </tr>
  <tr>
    <td class="ligne40">DELAI DE<br>LIVRAISON</td>
    <td class="ligne4"><?php  echo $delai;?></td>
  </tr>
  <tr>
    <td class="ligne40">MODE DE<br>PAIMENT </td>
    <td class="ligne4"><?php echo $mode;?></td>
  </tr>
</table>
<br>
<!-- ******************************************************************************************** -->
<!-- ******************************************************************************************** -->
<!-- ******************************************************************************************** -->
<table width="680" height="476" id="item">
  <tr>
    <td width="57">Item</td>
    <td width="325">Designation</td>
    <td width="55">Qté</td>
    <td width="120">Prix unitaire HD/DA</td>
    <td width="120">Montant HD/DA</td>
  </tr>

  <tr class="itembloc">

    <td class="itemtr">

     <?php 
     for ($i=1; $i <$cont+1 ; $i++) { 
       echo $i.'<br>';
     }
     ?>
    </td>
    <td class="itemdes">
<?php
for ($j=0; $j <$cont; $j++) { 


      echo'<p class="vehicule">'.$des[$j].'</p>
    <p class="couleur">couleur :'.$couleur[$j].'</p><br>';
    }

?>
  </td>
    <td class="itemtr"><?php 
     for ($a=0; $a <$cont ; $a++) { 
       echo $Qte[$a].'<br>';
     }
     ?></td><!-- la quantite de l'item -->
    <td class="itemtr"><?php 
     for ($z=0; $z <$cont ; $z++) { 
       echo $prix[$z].'<br>';
     }
     ?></td>
    <td class="itemtr"><?php 
     for ($e=0; $e <$cont ; $e++) { 
       echo $prix_selon[$e].'<br>';
     }
     ?>
   
   </td>
  </tr>
  <tr class="montant">
    <td rowspan="3">&nbsp;</td>
    <td rowspan="3"><p id="montantenchiffre"><U>ARREIER LE BON DE COMMANDE A LA SOMME:</U></p> </td>
    <td colspan="2" class="prix">TOTAL HT</td>
    <td>&nbsp;<?php echo $prixht;?></td>
  </tr>
  <tr>
    <td colspan="2" class="prix">TVA 17% non incluse</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="prix" >TOTAL ANDI</td>
    <td>&nbsp;<?php echo $somme_prix_selon;?></td>
  </tr>
  <tr>
    <td rowspan="5">&nbsp;</td>
    <td rowspan="5">
        <P id="condition">Cette commande ne deviendra ferme et définitive qu'après acception pas<br>
          les deux parties des conditions générales de vente indiquées au verso.<br>
          prière en prendre connaissance.

        </p>

    </td>
    <td colspan="2" class="prix">TIMBRE</td>
    <td>&nbsp;<?php echo $timbre*$sommeQte;?></td>
  </tr>
  <tr>
    <td colspan="2" class="prix">NET A PAYER TTC</td>
    <td>&nbsp;<?php echo $somme_prix_selon;?></td>
  </tr>
  <tr>
    <td colspan="2" class="prix">VERSEMENT</td>
    <td>&nbsp;<?php echo $verser?></td>
  </tr>
  <tr>
    <td colspan="2" class="prix">RESTE A PAYER</td>
    <td>&nbsp;<?php echo $reste; ?></td>
  </tr>
  <tr>
    <td colspan="3" >&nbsp;</td>
  </tr>
</table> 
</div>
<div id="footer">
    <table width="600">
      <tr>
        <td id="fingauche">R.C N°99-B-0010908
        </td>
        <td id="findroite"> ID N° 099216019484509
        </td>
      </tr>
      <tr>
        <td id="markgauche">FONDE DE POUVOIR
        </td>
        <td id="markdroite">CLIENT
        </td>

      </tr>
    </table>
  </div>



</page>


<?php	

    $content = ob_get_clean();

    // convert to PDF
     require('../../html2pdf/html2pdf_v4.03/html2pdf.class.php'); // cette commande est pour préciser le chemin où il se trouve "html2pdf.class.php"
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content);
        $html2pdf->Output('certificat1pdf.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>



