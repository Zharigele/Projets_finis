<?php
include("cnxBase.php");
?>

<?php include "header.php" ; ?>

        <div id="content" class="col-lg-10 col-md-12">
            <!-- content starts -->
            
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2> Hop3X : affichage des indicateurs</h2>

            </div> 
					
			<div class="box-content">
 
									<div style="text-align:right">
									<a class="btn btn-default btn-sm" href="index.php">
										<i class="glyphicon glyphicon-signal"></i>
										 Indicateurs par étudiant
									</a> - <a class="btn btn-warning btn-sm" href="index2.php">
										<i class="glyphicon glyphicon-picture"></i>
										 Indicateurs globales en graphe 
									</a>	</div>
									<br>	
					 <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
							<tr>
								<th>id etudiant</th>
								<th>Nom etudiant </th>
								<th>numéro TP </th>
								<th>Date </th> 
								<th>Afficher détails</th>
							</tr>
							</thead>
							<tbody>
							<?php   $res=$mysqli->query("select  id_etu, nom_etu,temps from tp1 group by id_etu") ;

						while($row=$res->fetch_array(MYSQLI_ASSOC)) { ?>
                        <tr>
					
					
							     <td><?php echo $row['id_etu'] ; ?> </td> 
								 <td><?php echo $row['nom_etu'] ; ?> </td>   
							     <td><?php echo "tp1"; ?> </td>
								 <td><?php 
									$original_timestamp = $row['temps'] ; 
									$timestamp = (int) substr($original_timestamp,0,-3);
									echo date('d-m-Y',$timestamp); 
								  ?> </td>   
								 
								   <td class="center">
									<a class="btn btn-success btn-sm" href="AfficherEtu.php?id=<?php echo $row['id_etu'] ; ?>">
										<i class="glyphicon glyphicon-zoom-in icon-white"></i>
										Afficher
									</a>
									 
								  </td>
								 
								 
								 
								 </tr> 
								 <?php }//end while ?>
								  </table> 
								
			 
			</div>
								 

                    
         </div>
                

            </div>  
        </div>
	 
     <!-- content ends -->
    </div><!--/#content.col-md-0-->
<?php include "footer.php" ; ?>



