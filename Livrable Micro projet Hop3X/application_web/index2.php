<?php
include("cnxBase.php");
/*Je charge les librairies de pChart qui se trouve dans le dossier class pour qu'il puisse afficher un graphique */
include("class/pData.class.php");
include("class/pDraw.class.php");
include("class/pImage.class.php");
include("class/pPie.class.php");
include("class/pIndicator.class.php");
include("class/pStock.class.php");
include "header.php" ; ?>

        <div id="content" class="col-lg-10 col-md-12">
            <!-- content starts -->
            
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2> Hop3X : Indicateurs graphiques</h2>

            </div> 
					
			<div class="box-content">
			 
							<div style="text-align:right">
									<a class="btn btn-warning btn-sm" href="index.php">
										<i class="glyphicon glyphicon-signal"></i>
										 Indicateurs par étudiant
									</a> - <a class="btn btn-default btn-sm" href="index2.php">
										<i class="glyphicon glyphicon-picture"></i>
										 Indicateurs globales en graphe 
									</a>	</div>
									<br>
			<ul class="nav nav-tabs" id="myTab">
<li class="active"><a href="#courte">TP avec durée courte</a></li>
<li><a href="#longue">TP avec durée longue</a></li>
<li><a href="#CE">Compilations avec erreurs</a></li>
<li><a href="#E">Exécutions sans erreurs</a></li>
 </ul>
<div id="myTabContent" class="tab-content">
<div class="tab-pane active" id="courte">
 <?php

/* Je créer un nouvel objet contenant mes données pour le graphique */
 $MyData = new pData();
//-----------------------------------------------------------
$dataset_piece_infos=$mysqli->query("select nom_etu,nbQ, (max(temps)-min(temps)) as duree from tp1  group by nom_etu ORDER BY duree  limit 5 ");
  
															
	while ($piece =  $dataset_piece_infos->fetch_array(MYSQLI_ASSOC) )
	
		  { 									
									$dureetp = (int) substr($piece['duree'],0,-3); 
										 
		  $MyData->addPoints(array(date('H\Hi',$dureetp)),"Probe 4");
		  }
//------------------------------------------------------------
/*Je présente ma série de données à utiliser pour le graphique et je détermine le titre de l'axe vertical avec setAxisName*/  
// $MyData->addPoints(array(3973.301,189.68,8663.627,1449.237,180,200,400,500,163,152,145),"Probe 3");
 $MyData->setSerieWeight("Probe 3",2);
 $MyData->setAxisName(0,"Duree EN heure");

/*J'indique les données horizontales du graphique. Il doit y avoir le même nombre que pour ma série de données précédentes (logique)*/
$dataset_piece_infos=$mysqli->query("select nom_etu,nbQ, (max(temps)-min(temps)) as duree from tp1  group by nom_etu ORDER BY duree  limit 5");
	 														
	while ($piece =  $dataset_piece_infos->fetch_array(MYSQLI_ASSOC))
	
		  {
		 
		  $MyData->addPoints(array($piece['nom_etu']),"Labels");
		  }
 
  $MyData->setSerieDescription("Labels","Années");
 $MyData->setAbscissa("Labels");
 $MyData->setPalette("Probe 3",array("R"=>255,"G"=>0,"B"=>0));

/* Je crée l'image qui contiendra mon graphique précédemment crée */
 $myPicture = new pImage(900,330,$MyData);

/* Je crée une bordure à mon image */
 $myPicture->drawRectangle(0,0,899,329,array("R"=>0,"G"=>0,"B"=>0));

/* J'indique le titre de mon graphique, son positionnement sur l'image et sa police */ 
 $myPicture->setFontProperties(array("FontName"=>"fonts/Forgotte.ttf","FontSize"=>11));
 $myPicture->drawText(200,25,"TP avec courte durée",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

/* Je choisi le fond de mon graphique */
 $myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>6));

/* Je détermine la taille du graphique et son emplacement dans l'image */
 $myPicture->setGraphArea(60,40,800,310);

/* Paramètres pour dessiner le graphique à partir des deux abscisses */
 //$scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);

$scaleSettings = array("BoxUpR"=>255,"BoxUpG"=>255,"BoxUpB"=>255,"BoxDownR"=>0,"BoxDownG"=>0,"BoxDownB"=>0);
$myPicture->drawScale($scaleSettings);

/* J'insère sur le côté droit le nom de l'auteur et les droits */ 
$myPicture->setFontProperties(array("FontName"=>"fonts/Bedizen.ttf","FontSize"=>6));
$TextSettings = array("DrawBox"=>TRUE,"BoxRounded"=>TRUE,"R"=>0,"G"=>0,"B"=>0,"Angle"=>90,"FontSize"=>10);


/* Je dessine mon graphique en fonction des paramètres précédents */
$myPicture->drawAreaChart();
$myPicture->drawLineChart(); 

/* Je rajoute des points rouge (plots) en affichant par dessus les données */
$myPicture->drawPlotChart(array("DisplayValues"=>TRUE,"PlotBorder"=>TRUE,"BorderSize"=>2,"Surrounding"=>-60,"BorderAlpha"=>80));

/* J'indique le chemin où je souhaite que mon image soit créée */
 $myPicture->Render("img/Duree_tp_etudiants_5p.png");
 //------------------------------------------------------------------------------------

?>	
<br><br>
<center><img src="img/Duree_tp_etudiants_5p.png"/></center>

 
</div>
<div class="tab-pane" id="longue">
 <?php
 
/* Je créer un nouvel objet contenant mes données pour le graphique */
 $MyData = new pData();
//-----------------------------------------------------------
$dataset_piece_infos=$mysqli->query("select nom_etu,nbQ, (max(temps)-min(temps)) as duree from tp1  group by nom_etu ORDER BY duree desc limit 5 ");
  
															
	while ($piece =  $dataset_piece_infos->fetch_array(MYSQLI_ASSOC) )
	
		  { 									
									$dureetp = (int) substr($piece['duree'],0,-3); 
										 
		  $MyData->addPoints(array(date('H\Hi',$dureetp)),"Probe 4");
		  }
//------------------------------------------------------------
/*Je présente ma série de données à utiliser pour le graphique et je détermine le titre de l'axe vertical avec setAxisName*/  
// $MyData->addPoints(array(3973.301,189.68,8663.627,1449.237,180,200,400,500,163,152,145),"Probe 3");
 $MyData->setSerieWeight("Probe 3",2);
 $MyData->setAxisName(0,"Duree EN heure");

/*J'indique les données horizontales du graphique. Il doit y avoir le même nombre que pour ma série de données précédentes (logique)*/
$dataset_piece_infos=$mysqli->query("select nom_etu,nbQ, (max(temps)-min(temps)) as duree from tp1  group by nom_etu ORDER BY duree desc limit 5");
	 														
	while ($piece =  $dataset_piece_infos->fetch_array(MYSQLI_ASSOC))
	
		  {
		 
		  $MyData->addPoints(array($piece['nom_etu']),"Labels");
		  }
 
  $MyData->setSerieDescription("Labels","Années");
 $MyData->setAbscissa("Labels");
 $MyData->setPalette("Probe 3",array("R"=>255,"G"=>0,"B"=>0));

/* Je crée l'image qui contiendra mon graphique précédemment crée */
 $myPicture = new pImage(900,330,$MyData);

/* Je crée une bordure à mon image */
 $myPicture->drawRectangle(0,0,899,329,array("R"=>0,"G"=>0,"B"=>0));

/* J'indique le titre de mon graphique, son positionnement sur l'image et sa police */ 
 $myPicture->setFontProperties(array("FontName"=>"fonts/Forgotte.ttf","FontSize"=>11));
 $myPicture->drawText(200,25,"TP avec longue durée",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

/* Je choisi le fond de mon graphique */
 $myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>6));

/* Je détermine la taille du graphique et son emplacement dans l'image */
 $myPicture->setGraphArea(60,40,800,310);

/* Paramètres pour dessiner le graphique à partir des deux abscisses */
 //$scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);

$scaleSettings = array("BoxUpR"=>255,"BoxUpG"=>255,"BoxUpB"=>255,"BoxDownR"=>0,"BoxDownG"=>0,"BoxDownB"=>0);
$myPicture->drawScale($scaleSettings);

/* J'insère sur le côté droit le nom de l'auteur et les droits */ 
$myPicture->setFontProperties(array("FontName"=>"fonts/Bedizen.ttf","FontSize"=>6));
$TextSettings = array("DrawBox"=>TRUE,"BoxRounded"=>TRUE,"R"=>0,"G"=>0,"B"=>0,"Angle"=>90,"FontSize"=>10);


/* Je dessine mon graphique en fonction des paramètres précédents */
$myPicture->drawAreaChart();
$myPicture->drawLineChart(); 

/* Je rajoute des points rouge (plots) en affichant par dessus les données */
$myPicture->drawPlotChart(array("DisplayValues"=>TRUE,"PlotBorder"=>TRUE,"BorderSize"=>2,"Surrounding"=>-60,"BorderAlpha"=>80));

/* J'indique le chemin où je souhaite que mon image soit créée */
 $myPicture->Render("img/Duree_tp_etudiants_5d.png");
 //------------------------------------------------------------------------------------

?>	

<br><br>
<center><img src="img/Duree_tp_etudiants_5d.png"/></center>

 
</div> 
<div class="tab-pane" id="E">
 <?php

/* Je créer un nouvel objet contenant mes données pour le graphique */
 $MyData = new pData();
//-----------------------------------------------------------
$dataset_piece_infos=$mysqli->query("select nom_etu,nbQ, count(*) as E_succes from tp1 where action like 'E' group by nom_etu ORDER BY E_succes DESC  limit 5");
  
															
	while ($piece =  $dataset_piece_infos->fetch_array(MYSQLI_ASSOC) )
	
		  { 									
									 	 
		  $MyData->addPoints(array($piece['E_succes']),"Probe 4");
		  }
  $MyData->setSerieWeight("Probe 3",2); 

/*J'indique les données horizontales du graphique. Il doit y avoir le même nombre que pour ma série de données précédentes (logique)*/
$dataset_piece_infos=$mysqli->query("select nom_etu,nbQ, count(*) as E_succes from tp1  where action like 'E' group by nom_etu ORDER BY E_succes DESC  limit 5");
	 														
	while ($piece =  $dataset_piece_infos->fetch_array(MYSQLI_ASSOC))
	
		  {
		 
		  $MyData->addPoints(array($piece['nom_etu']),"Labels");
		  }
 
  $MyData->setSerieDescription("Labels","Années");
 $MyData->setAbscissa("Labels");
 $MyData->setPalette("Probe 3",array("R"=>255,"G"=>0,"B"=>0));

/* Je crée l'image qui contiendra mon graphique précédemment crée */
 $myPicture = new pImage(900,330,$MyData);

/* Je crée une bordure à mon image */
 $myPicture->drawRectangle(0,0,899,329,array("R"=>0,"G"=>0,"B"=>0));

/* J'indique le titre de mon graphique, son positionnement sur l'image et sa police */ 
 $myPicture->setFontProperties(array("FontName"=>"fonts/Forgotte.ttf","FontSize"=>11));
 $myPicture->drawText(200,25,"TP avec plus de compilations avec succès",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

/* Je choisi le fond de mon graphique */
 $myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>6));

/* Je détermine la taille du graphique et son emplacement dans l'image */
 $myPicture->setGraphArea(60,40,800,310);

/* Paramètres pour dessiner le graphique à partir des deux abscisses */
 //$scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);

$scaleSettings = array("BoxUpR"=>255,"BoxUpG"=>255,"BoxUpB"=>255,"BoxDownR"=>0,"BoxDownG"=>0,"BoxDownB"=>0);
$myPicture->drawScale($scaleSettings);

/* J'insère sur le côté droit le nom de l'auteur et les droits */ 
$myPicture->setFontProperties(array("FontName"=>"fonts/Bedizen.ttf","FontSize"=>6));
$TextSettings = array("DrawBox"=>TRUE,"BoxRounded"=>TRUE,"R"=>0,"G"=>0,"B"=>0,"Angle"=>90,"FontSize"=>10);


/* Je dessine mon graphique en fonction des paramètres précédents */
$myPicture->drawAreaChart();
$myPicture->drawLineChart(); 

/* Je rajoute des points rouge (plots) en affichant par dessus les données */
$myPicture->drawPlotChart(array("DisplayValues"=>TRUE,"PlotBorder"=>TRUE,"BorderSize"=>2,"Surrounding"=>-60,"BorderAlpha"=>80));

/* J'indique le chemin où je souhaite que mon image soit créée */
 $myPicture->Render("img/Exec_succes.png");
 //------------------------------------------------------------------------------------

?>	
<br><br>
<center><img src="img/Exec_succes.png"/></center>

 
</div>			 
			 
	
<div class="tab-pane" id="CE">
 <?php

/* Je créer un nouvel objet contenant mes données pour le graphique */
 $MyData = new pData();
//-----------------------------------------------------------
$dataset_piece_infos=$mysqli->query("select nom_etu,nbQ, count(*) as c_error from tp1 where action like 'cme' or action like 'cae' group by nom_etu ORDER BY c_error DESC  limit 5");
  
															
	while ($piece =  $dataset_piece_infos->fetch_array(MYSQLI_ASSOC) )
	
		  { 									
									 	 
		  $MyData->addPoints(array($piece['c_error']),"Probe 4");
		  }
  $MyData->setSerieWeight("Probe 3",2); 

/*J'indique les données horizontales du graphique. Il doit y avoir le même nombre que pour ma série de données précédentes (logique)*/
$dataset_piece_infos=$mysqli->query("select nom_etu,nbQ, count(*) as c_error from tp1 where action like 'cme' or action like 'cae' group by nom_etu ORDER BY c_error DESC  limit 5");
	 														
	while ($piece =  $dataset_piece_infos->fetch_array(MYSQLI_ASSOC))
	
		  {
		 
		  $MyData->addPoints(array($piece['nom_etu']),"Labels");
		  }
 
  $MyData->setSerieDescription("Labels","Années");
 $MyData->setAbscissa("Labels");
 $MyData->setPalette("Probe 3",array("R"=>255,"G"=>0,"B"=>0));

/* Je crée l'image qui contiendra mon graphique précédemment crée */
 $myPicture = new pImage(900,330,$MyData);

/* Je crée une bordure à mon image */
 $myPicture->drawRectangle(0,0,899,329,array("R"=>0,"G"=>0,"B"=>0));

/* J'indique le titre de mon graphique, son positionnement sur l'image et sa police */ 
 $myPicture->setFontProperties(array("FontName"=>"fonts/Forgotte.ttf","FontSize"=>11));
 $myPicture->drawText(200,25,"TP avec plus de compilations avec erreurs",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

/* Je choisi le fond de mon graphique */
 $myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>6));

/* Je détermine la taille du graphique et son emplacement dans l'image */
 $myPicture->setGraphArea(60,40,800,310);

/* Paramètres pour dessiner le graphique à partir des deux abscisses */
 //$scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);

$scaleSettings = array("BoxUpR"=>255,"BoxUpG"=>255,"BoxUpB"=>255,"BoxDownR"=>0,"BoxDownG"=>0,"BoxDownB"=>0);
$myPicture->drawScale($scaleSettings);

/* J'insère sur le côté droit le nom de l'auteur et les droits */ 
$myPicture->setFontProperties(array("FontName"=>"fonts/Bedizen.ttf","FontSize"=>6));
$TextSettings = array("DrawBox"=>TRUE,"BoxRounded"=>TRUE,"R"=>0,"G"=>0,"B"=>0,"Angle"=>90,"FontSize"=>10);


/* Je dessine mon graphique en fonction des paramètres précédents */
$myPicture->drawAreaChart();
$myPicture->drawLineChart(); 

/* Je rajoute des points rouge (plots) en affichant par dessus les données */
$myPicture->drawPlotChart(array("DisplayValues"=>TRUE,"PlotBorder"=>TRUE,"BorderSize"=>2,"Surrounding"=>-60,"BorderAlpha"=>80));

/* J'indique le chemin où je souhaite que mon image soit créée */
 $myPicture->Render("img/c_error.png");
 //------------------------------------------------------------------------------------

?>	
<br><br>
<center><img src="img/c_error.png"/></center>

 
</div>			 
			 
		
				</div>
			</div>
        </div>  
    </div>
	 
     <!-- content ends -->
    </div><!--/#content.col-md-0-->
<?php include "footer.php" ; ?>



