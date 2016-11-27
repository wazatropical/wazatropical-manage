<?php


namespace WAZA\ComptabiliteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ob\HighchartsBundle\Highcharts\Highchart;
use WAZA\ComptabiliteBundle\Entity\DataChart;
use WAZA\ComptabiliteBundle\Form\ProductionType;
use WAZA\UserBundle\Entity\User;
use WAZA\SettingsBundle\Entity\SettingsUser;

class DetailController extends Controller
{   
    public function listObjetAction(Request $request, $id){
	/*$setting = $this->getDoctrine()
                            ->getManager()->getRepository('WAZASettingsBundle:SettingsUser')->find(5);
	$user = new User();
	$user->setUsername('herval');
	$user->setEmail('nganyahb@gmail.com');
	$user->setNom('Nganya Nana');
	$user->setPrenom('Herval Bernice');
	$user->setTel('004917661092645');
	$user->setPays('Allemagne');
	$user->setVille('Brandenburg an der Havel');
	$user->setCodepostal('14770');
	$user->setRue('Zanderstr. 10A');
	$dateenreg = date_create("now", NULL );
	$user->setDateenreg($dateenreg);
	$user->setSettings($setting);
	$encoder = $this->container->get('security.password_encoder');
	$encoded = $encoder->encodePassword($user, 'herval');
	$user->setPassword($encoded);
	$user->setEnabled(True);
	$em = $this->getDoctrine()->getManager();
	$em->persist($user);
	$em->flush();*/
	
        $convert = $this->container->get('waza_comptabilite.change');
        
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Production');
        $production = $repository->find($id);
        
        $repository2 = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Possederobjgain');
        $repository3 = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Possederobjdep');
        
        $convertBudget = $convert->convertValue($production->getBudget(),
                        $production->getMonnaie()->getCode(), $this->getUser()->getSettings()->getMonnaie1()->getCode());
        $convertBeneficev = $convert->convertValue($production->getBeneficev(),
                        $production->getMonnaie()->getCode(), $this->getUser()->getSettings()->getMonnaie1()->getCode());
                
        $titre = "détails de la production";
        $chGainMois = new Highchart();
        $chGainAnnee = new Highchart();
        $chGainJour = new Highchart();
        $chDepMois = new Highchart();
        $chDepAnnee = new Highchart();
        $chDepJour = new Highchart();
        $chCompMois = new Highchart();
        $chCompAnnee = new Highchart();
        $chCompJour = new Highchart();
        
        $puconvert1Gain = array();
        $puconvert2Gain = array();
        $puconvert3Gain = array();
        $puconvert1Dep = array();
        $puconvert2Dep = array();
        $puconvert3Dep = array();
        
        $objGain = array();
        $objDep = array();
        
        if($production->getGain() != NULL OR $production->getDepense() != NULL){
            if($production->getGain() != NULL )
                $objGain = $repository2->findBy(array('gain' => $production->getGain()->getId()), array('date' => 'asc'));
            if($production->getDepense() != NULL )
                $objDep = $repository3->findBy(array('depense' => $production->getDepense()->getId()), array('date' => 'asc'));
        
            foreach($objGain as $o){
                $monnaie1 = $o->getObjet()->getMonnaie()->getCode();            
                $puconvert1Gain[] = $convert->convertValue($o->getObjet()->getPu(),
                        $monnaie1, $this->getUser()->getSettings()->getMonnaie1()->getCode());
                $puconvert2Gain[] = $convert->convertValue($o->getObjet()->getPu(),
                        $monnaie1, $this->getUser()->getSettings()->getMonnaie2()->getCode());
                $puconvert3Gain[] = $convert->convertValue($o->getObjet()->getPu(),
                        $monnaie1, $this->getUser()->getSettings()->getMonnaie3()->getCode());
            }
            foreach($objDep as $o){
                $monnaie2 = $o->getObjet()->getMonnaie()->getCode();
                $puconvert1Dep[] = $convert->convertValue($o->getObjet()->getPu(),
                        $monnaie2, $this->getUser()->getSettings()->getMonnaie1()->getCode());
                $puconvert2Dep[] = $convert->convertValue($o->getObjet()->getPu(),
                        $monnaie2, $this->getUser()->getSettings()->getMonnaie2()->getCode());
                $puconvert3Dep[] = $convert->convertValue($o->getObjet()->getPu(),
                        $monnaie2, $this->getUser()->getSettings()->getMonnaie3()->getCode());
            }

            $infosGain = $this->getInformations($objGain, $puconvert1Gain);
            $infosDep = $this->getInformations($objDep, $puconvert1Dep);
            $seriesGainJour = array(
                array("name" => "Data Serie Name", "data" => $infosGain->getDatasjour(), "color"=>"green", "labels" => $infosGain->getLabelsjour())
            );
            $seriesGainMois = array(
                array("name" => "Data Serie Name", "data" => $infosGain->getDatasmois(), "color"=>"green", "labels" => $infosGain->getLabelsmois())
            );
            $seriesGainAnnee = array(
                array("name" => "Data Serie Name", "data" => $infosGain->getDatasannee(), "color"=>"green", "labels" => $infosGain->getLabelsannee())
            );
            $seriesDepMois = array(
                array("name" => "Data Serie Name", "data" => $infosDep->getDatasmois(), "color"=>"red", "labels" => $infosDep->getLabelsmois())
            );
            $seriesDepJour = array(
                array("name" => "Data Serie Name", "data" => $infosDep->getDatasjour(), "color"=>"red", "labels" => $infosDep->getLabelsjour())
            );
            $seriesDepAnnee = array(
                array("name" => "Data Serie Name", "data" => $infosDep->getDatasannee(), "color"=>"red", "labels" => $infosDep->getLabelsannee())
            );
            $seriesCompJour = array(
                array("name" => "Depenses", "data" => $infosDep->getDatasjour(), "color"=>"red", "labels" => $infosDep->getLabelsjour()),
                array("name" => "Gains", "data" => $infosGain->getDatasjour(), "color"=>"green", "labels" => $infosGain->getLabelsjour())
            );
            $seriesCompMois = array(
                array("name" => "Depenses", "data" => $infosDep->getDatasmois(), "color"=>"red", "labels" => $infosDep->getLabelsmois()),
                array("name" => "Gains", "data" => $infosGain->getDatasmois(), "color"=>"green", "labels" => $infosGain->getLabelsmois())
            );
            $seriesCompAnnee = array(
                array("name" => "Depenses", "data" => $infosDep->getDatasannee(), "color"=>"red", "labels" => $infosDep->getLabelsannee()),
                array("name" => "Gains", "data" => $infosGain->getDatasannee(), "color"=>"green", "labels" => $infosGain->getLabelsannee())
            );

            $chGainJour->chart->renderTo('linechart1');
            $chGainJour->title->text('Gains en fonction des jour');
            $chGainJour->xAxis->title(array('text' => "Jours"));
            $chGainJour->yAxis->title(array('text' => "Montants des gains (".$this->getUser()->getSettings()->getMonnaie1()->getCode().")"));
            $chGainJour->series($seriesGainJour);
            $chGainJour->xAxis->categories($infosGain->getLabelsjour());
            
            $chGainMois->chart->renderTo('linechart2');
            $chGainMois->title->text('Gains en fonction des mois');
            $chGainMois->xAxis->title(array('text' => "Mois"));
            $chGainMois->yAxis->title(array('text' => "Montants des gains (".$this->getUser()->getSettings()->getMonnaie1()->getCode().")"));
            $chGainMois->series($seriesGainMois);
            $chGainMois->xAxis->categories($infosGain->getLabelsmois());

            $chGainAnnee->chart->renderTo('linechart3');
            $chGainAnnee->title->text('Gains en fonction des annees');
            $chGainAnnee->xAxis->title(array('text' => "Annees"));
            $chGainAnnee->yAxis->title(array('text' => "Montants des gains (".$this->getUser()->getSettings()->getMonnaie1()->getCode().")"));
            $chGainAnnee->series($seriesGainAnnee);
            $chGainAnnee->xAxis->categories($infosGain->getLabelsannee());

            $chDepJour->chart->renderTo('linechart4');
            $chDepJour->title->text('Depenses en fonction des jour');
            $chDepJour->xAxis->title(array('text' => "Jour"));
            $chDepJour->yAxis->title(array('text' => "Montants des depenses (".$this->getUser()->getSettings()->getMonnaie1()->getCode().")"));
            $chDepJour->series($seriesDepJour);
            $chDepJour->xAxis->categories($infosDep->getLabelsjour());
            
            $chDepMois->chart->renderTo('linechart5');
            $chDepMois->title->text('Depenses en fonction des mois');
            $chDepMois->xAxis->title(array('text' => "Mois"));
            $chDepMois->yAxis->title(array('text' => "Montants des depenses (".$this->getUser()->getSettings()->getMonnaie1()->getCode().")"));
            $chDepMois->series($seriesDepMois);
            $chDepMois->xAxis->categories($infosDep->getLabelsmois());

            $chDepAnnee->chart->renderTo('linechart6');
            $chDepAnnee->title->text('Depenses en fonction des annees');
            $chDepAnnee->xAxis->title(array('text' => "Annees"));
            $chDepAnnee->yAxis->title(array('text' => "Montants des depenses (".$this->getUser()->getSettings()->getMonnaie1()->getCode().")"));
            $chDepAnnee->series($seriesDepAnnee);
            $chDepAnnee->xAxis->categories($infosDep->getLabelsannee());

            $chCompJour->chart->renderTo('linechart7');
            $chCompJour->title->text('Confrontation des gains et depenses en fonction des jour');
            $chCompJour->xAxis->title(array('text' => "Jour"));
            $chCompJour->yAxis->title(array('text' => "Montants"));
            $chCompJour->series($seriesCompJour);
            
            $chCompMois->chart->renderTo('linechart8');
            $chCompMois->title->text('Confrontation des gains et depenses en fonction des mois');
            $chCompMois->xAxis->title(array('text' => "Mois"));
            $chCompMois->yAxis->title(array('text' => "Montants"));
            $chCompMois->series($seriesCompMois);

            $chCompAnnee->chart->renderTo('linechart9');
            $chCompAnnee->title->text('Confrontation des gains et depenses en fonction des annees');
            $chCompAnnee->xAxis->title(array('text' => "Annee"));
            $chCompAnnee->yAxis->title(array('text' => "Montants"));
            $chCompAnnee->series($seriesCompAnnee);
        }
        
        $repository = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZAComptabiliteBundle:Production');
        $production = $repository->find($id);
        $form = $this->get('form.factory')->create(ProductionType::class, $production);
        
        return $this->render('WAZAComptabiliteBundle:Core:list_ob_prod.html.twig', array('datas' => $production, 'objGain' => $objGain,
            'objDep' => $objDep, 'src' => 'prod_op', 'chartGainJour' => $chGainJour, 'chartGainMois' => $chGainMois, 'chartGainAnnee' => $chGainAnnee,
            'chartDepJour' => $chDepJour, 'chartDepMois' => $chDepMois, 'chartDepAnnee' => $chDepAnnee, 'chartCompJour' => $chCompJour, 'chartCompMois' => $chCompMois, 'chartCompAnnee' => $chCompAnnee,
            'puconvert1Gain'=>$puconvert1Gain, 'puconvert2Gain'=>$puconvert2Gain, 'puconvert3Gain'=>$puconvert3Gain,
            'page'=> 'detailproduction', 'titre'=>$titre, 'puconvert1Dep'=>$puconvert1Dep, 'puconvert2Dep'=>$puconvert2Dep, 'puconvert3Dep'=>$puconvert3Dep, 'id' => $id,
            'convertbudget' => $convertBudget, 'convertbeneficev' => $convertBeneficev, 'modal'=> false, 'formEditModal' => $form->createView()));
    }   
    
    public function addOpAction(Request $request){
        return new Response("passe");
    }
    
    public function editOpAction(Request $request){
        return new Response("passe");
    }
    
    public function getInformations($object, $puconvert){
        $dataChart = new DataChart();
        if(sizeof($object) > 0){
            $i = 0;
            $totalannee = 0;
            $totalmois = 0;
            $totaljour = 0;
            $annee = $object[0]->getDate()->format('Y');
            $anneebis = $object[0]->getDate()->format('Y');
            $anneebis2 = $object[0]->getDate()->format('Y');
            $mois = $object[0]->getDate()->format('m');
            $moisbis = $object[0]->getDate()->format('m');
            $jour = $object[0]->getDate()->format('d');
            foreach($object as $o){
                $pt = $o->getQuantite() * $puconvert[$i];
                if($annee == $o->getDate()->format('Y')){
                    $totalannee += $pt;
                }else{
                    $datasannee[] = $totalannee;
                    $labelsannee[] = $annee;
                    $annee = $o->getDate()->format('Y');
                    $totalannee = $pt;
                }

                if(($mois == $o->getDate()->format('m')) AND ($anneebis == $o->getDate()->format('Y'))){
                    $totalmois += $pt;
                }else{
                    $datasmois[] = $totalmois;
                    $labelsmois[] = $object[$i - 1]->getDate()->format('F')." ".$object[$i - 1]->getDate()->format('Y');
                    $mois = $o->getDate()->format('m');
                    $anneebis = $o->getDate()->format('Y');
                    $totalmois = $pt;
                }
                
                if(($jour == $o->getDate()->format('d')) AND ($moisbis == $o->getDate()->format('m')) AND ($anneebis2 == $o->getDate()->format('Y'))){
                    $totaljour += $pt;
                }else{
                    $datasjour[] = $totaljour;
                    $labelsjour[] = $object[$i - 1]->getDate()->format('d').".".$object[$i - 1]->getDate()->format('m').".".$object[$i - 1]->getDate()->format('Y');
                    $jour = $o->getDate()->format('d');
                    $anneebis2 = $o->getDate()->format('Y');
                    $moisbis = $o->getDate()->format('m');
                    $totaljour = $pt;
                }
                $i += 1;
            }

            if($annee == $object[sizeof($object) - 1]->getDate()->format('Y')){
                $datasannee[] = $totalannee;
                $labelsannee[] = $object[sizeof($object) - 1]->getDate()->format('Y');
            }
            if($mois == $object[sizeof($object) - 1]->getDate()->format('m') AND ($anneebis == $object[sizeof($object) - 1]->getDate()->format('Y'))){
                $datasmois[] = $totalmois;
                $labelsmois[] = $object[sizeof($object) - 1]->getDate()->format('F')." ".$object[sizeof($object) - 1]->getDate()->format('Y');
            }
            
            if($jour == $object[sizeof($object) - 1]->getDate()->format('d') AND $moisbis == $object[sizeof($object) - 1]->getDate()->format('m') AND ($anneebis2 == $object[sizeof($object) - 1]->getDate()->format('Y'))){
                $datasjour[] = $totaljour;
                $labelsjour[] = $object[$i - 1]->getDate()->format('d').".".$object[$i - 1]->getDate()->format('m').".".$object[$i - 1]->getDate()->format('Y');
            }

            $dataChart->setDatasjour($datasjour);
            $dataChart->setDatasmois($datasmois);
            $dataChart->setDatasannee($datasannee);
            $dataChart->setLabelsannee($labelsannee);
            $dataChart->setLabelsmois($labelsmois);
            $dataChart->setLabelsjour($labelsjour);
        }
        return $dataChart;
    }
    
    /*public function getFileExport($datasProd, $gains, $depenses, $puconvert1Gain, $puconvert2Gain, $puconvert3Gain,
            $puconvert1Dep, $puconvert2Dep, $puconvert3Dep, $chGainMois, $chGainAnnee, $chDepMois,
            $chDepMois, $chCompMois, $chCompAnnee)
    {            
        $phpExcelObject = new \PHPExcel();
        $writer = new \PHPExcel_Writer_Excel2007($phpExcelObject);
        $filename = 'production'.$datasProd->getNom().'_'.$datasProd->getDatedebut()->format("dmY").'.xlsx';
        $filename = ucwords($filename);
        $filename = str_replace(" ", "", $filename);
        
        $phpExcelObject->getActiveSheet()->setTitle('Gains');
        
        $j = 0;
        $i = 7;
        foreach ($gains as $gain){
            $totalcumule = $puconvert1Gain[$j] * $gain->getQuantite();
            $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $gain->getDate()->format('d/m/Y'))
            ->setCellValue('B'.$i, $gain->getObjet()->getNom())
            ->setCellValue('C'.$i, $puconvert1Gain[$j])
            ->setCellValue('D'.$i, $puconvert2Gain[$j])
            ->setCellValue('E'.$i, $puconvert3Gain[$j])
            ->setCellValue('F'.$i, $gain->getObjet()->getMesure()->getCode())
            ->setCellValue('G'.$i, $gain->getQuantite())
            ->setCellValue('H'.$i, $puconvert1Gain[$j] * $gain->getQuantite())
            ->setCellValue('I'.$i, $puconvert2Gain[$j] * $gain->getQuantite())
            ->setCellValue('J'.$i, $puconvert3Gain[$j] * $gain->getQuantite())
            ->setCellValue('K'.$i, $totalcumule);
            $totalcumule += $puconvert1Gain[$j] * $gain->getQuantite();
            $i++;
            $j++;
        }
        //$phpExcelObject->getActiveSheet()->mergeCells('A1:J1');
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, 'TOTAL');
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('H'.$i, $totalcumule);
        $writer->save($filename);
        $path = getcwd().'/'.$filename;
        return $path;
    }*/
}
