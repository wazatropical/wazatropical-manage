<?php

namespace WAZA\SettingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WAZA\SettingsBundle\Form\SettingsAppType;

class AppController extends Controller
{
    public function showAction(Request $request)
    {
        $repository = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZASettingsBundle:SettingsApp');
        $settingsApp = $repository->findAll()[0];
        $form = $this->get('form.factory')->create(SettingsAppType::class, $settingsApp);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Paramètres enregistrés');
                return $this->redirectToRoute('waza_settings_app_homepage');
            }
        }
        return $this->render('WAZASettingsBundle::settingsapp.html.twig', array('form' => $form->createView(),));
    }
    
    public function saveAction(Request $request, $userid){
        $idMonnaie1 = $request->request->get('monnaie1');
        $idMonnaie2 = $request->request->get('monnaie2');
        $idMonnaie3 = $request->request->get('monnaie3');
        $idExtension = $request->request->get('extension');
        $errorMessageMonnaie = "Les idMonnaies doivent etre toutes differentes";
        $error = FALSE;
        if($idMonnaie1 == $idMonnaie2){
            $error = TRUE;
        }else{
            if($idMonnaie1 == $idMonnaie3)
                $error = TRUE;
            else{
                if($idMonnaie3 == $idMonnaie2)
                    $error = TRUE;
            }
        }
        if($error == TRUE){
            $request->getSession()->getFlashBag()->add('notice', $errorMessageMonnaie);
            return $this->redirectToRoute('waza_settings_user_homepage', array('userid' => $userid));
        }
        
        $repositorySettings = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZASettingsBundle:SettingsUser');
        
        $repositoryMonnaie = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZAComptabiliteBundle:Monnaie');
        $repositoryFile = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZAFileBundle:FormatExport');
        
        $monnaie1 = $repositoryMonnaie->find($idMonnaie1);
        $monnaie2 = $repositoryMonnaie->find($idMonnaie2);
        $monnaie3 = $repositoryMonnaie->find($idMonnaie3);
        $extension = $repositoryFile->find($idExtension);
        
        $settings = $repositorySettings->find($userid);
        $settings->setFormatExpFile($extension);
        $settings->setMonnaie1($monnaie1);
        $settings->setMonnaie2($monnaie2);
        $settings->setMonnaie3($monnaie3);
        
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', "Parametres enregistre");
        return $this->redirectToRoute('waza_gestion_homepage', array('flash'=>true));
    }
}