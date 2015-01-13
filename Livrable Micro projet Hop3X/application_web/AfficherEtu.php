<?php
include("cnxBase.php");
include "header.php" ; 
if (isset($_GET['id'])){
	$id=$_GET['id'];
	
   $res=$mysqli->query("select * from tp1 where id_etu=$id group by nbQ") ;

   
						?>
                   

        <div id="content" class="col-lg-10 col-sm-12">
            <!-- content starts -->
            
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2>Informations sur l'etudiant : <?=getEtuName($mysqli,$id)?></h2>

            </div> 
					
			<div class="box-content">
			
			<a class="btn btn-success btn-sm" href="index.php">
			<i class="glyphicon glyphicon-chevron-left"></i> Retour à l'accueil
			</a><br><br>
				
								
					 <table class="table table-striped table-bordered bootstrap-datatable  responsive">
							<thead>
								<tr>
								
								<th>N° TP </th>
								<th>N° Question</th>  
								<th>Temps de début</th>
								<th>Executions avec erreurs <i class='glyphicon glyphicon-remove-circle red'></i> </th>
								<th>Executions sans erreurs <i class='glyphicon glyphicon-ok-sign green'></i> </th>   
								<th>Dernière compilation</th>   
							</tr>
							</thead>
							<tbody>
							    <?php 
								$nbrQC=0;// nbre des questions correctes
								$nbrQF=0;// nbre des questions fausses
								
								while($row=$res->fetch_array(MYSQLI_ASSOC)) { 
								
								// numero de la question actuelle
								$nbQ= $row['nbQ']; 
									//	nbre de compilations avec erreurs							
								$resCE=$mysqli->query("SELECT count(*) AS nbCE from tp1 where id_etu=$id AND  nbQ=$nbQ AND( action like 'CAE' or action like 'CME')") ;
								$rowCE=$resCE->fetch_array(MYSQLI_ASSOC);
									//nbre d'executions avec succes
								$resCSE=$mysqli->query("SELECT count(*) AS nbCSE from tp1 where id_etu=$id AND  nbQ=$nbQ AND  action like 'E' ") ;
									$rowCSE=$resCSE->fetch_array(MYSQLI_ASSOC);
									//Derniere comilation faite pour une question = etat final de la réponse d'une question
								$resDC=$mysqli->query("SELECT action AS DC from tp1 where id_etu=$id AND  nbQ=$nbQ AND  (action like 'E'  
																OR action LIKE 'CE' OR action LIKE 'CME') order by temps desc limit 1") ;
								$rowDC=$resDC->fetch_array(MYSQLI_ASSOC);
									
								 
									
								
								?>
								<tr>
							     <td><?php echo "tp1"; ?> </td> 
								 <td><?php echo $row['nbQ'];  ?> </td>
								 <td><?php 
									$original_timestamp = $row['temps'] ; 
									$timestamp = (int) substr($original_timestamp,0,-3);
									echo date('d-m-Y H:i',$timestamp); 
								  ?> </td>   
							     <td><?php echo $rowCE['nbCE'];  ?> </td>
							     <td><?php echo $rowCSE['nbCSE'];  ?> </td>
							     <td>
									<?php // derniere compilation 
										if($rowDC['DC']=="E" )
										{
										echo "<span class='label-default label label-success'> succès</span>" ;
										$nbrQC ++;
										}
										else 
										{
										echo "<span class='label-default label label-danger'> échec</span>" ;  
										$nbrQF ++;
										}
									?> 
								</td>
								</tr> 
								 <?php 
								 
								 
								 }//end while 
								 
								 ?>
								 <?php $resNQ=$mysqli->query("SELECT MAX(nbQ) AS MAXNQ from tp1 where id_etu=$id") ;
									$rowNQ=$resNQ->fetch_array(MYSQLI_ASSOC);
									
									$resCE=$mysqli->query("SELECT count(*) AS nbCE from tp1 where id_etu=$id AND ( action like 'CAE' or action like 'CME')") ;
									$rowCE=$resCE->fetch_array(MYSQLI_ASSOC);
									
									$resCSE=$mysqli->query("SELECT count(*) AS nbCSE from tp1 where id_etu=$id AND  action like 'E' ") ;
									$rowCSE=$resCSE->fetch_array(MYSQLI_ASSOC);
									
									$resDT=$mysqli->query("SELECT MAX(temps) AS mxt ,MIN(temps) as mnt  from tp1 where id_etu=$id") ;
									$rowDT=$resDT->fetch_array(MYSQLI_ASSOC);
									$dureetp =  $rowDT['mxt'] - $rowDT['mnt'];
									$dureetp = (int) substr($dureetp,0,-3); 
										?>
								<tr><td colspan="5"></td></tr>
								<tr>
							     <td><b>Total</b></td> 
								 <td><?php echo $rowNQ['MAXNQ'];  ?> </td>
								 <td><?php echo "Durée de TP ".date('H\Hi',$dureetp);  ?> </td>   
							     <td><?php echo $rowCE['nbCE'];  ?> </td>
							     <td><?php echo $rowCSE['nbCSE'];  ?> </td>
							     <td><?php echo $rowNQ['MAXNQ']." (".$nbrQC." <i class='glyphicon glyphicon-ok-sign green'></i>  + ".$nbrQF." <i class='glyphicon glyphicon-remove-circle red'></i>)";  ?> </td> 
								</tr> 
								  </table> 
					 
				
			 
			</div>
								 

                    
         </div>
                

            </div>  
        </div>
	 
     <!-- content ends -->
    </div><!--/#content.col-md-0-->
<?php } include "footer.php" ; ?>



