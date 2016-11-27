<?php

namespace WAZA\SettingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WAZA\SettingsBundle\Entity\SettingsUser;
use WAZA\UserBundle\Entity\User;
use WAZA\SettingsBundle\Form\SettingsUserType;

class UserController extends Controller
{
    public function showAction(Request $request, $userid)
    {
        $repository = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZAUserBundle:User');
        $repositoryMonnaie = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZAComptabiliteBundle:Monnaie');
        $repositoryFile = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZAFileBundle:FormatExport');
        
        $user = $repository->find($userid);
        return $this->render('WAZASettingsBundle::settingsuser.html.twig', array(
                            'monnaies'=>$repositoryMonnaie->findAll(),
                            'extensions'=>$repositoryFile->findAll(),
                            'currentExtension'=>$user->getSettings()->getFormatExpFile()->getCode(),
                            'currentMonnaie1'=>$user->getSettings()->getMonnaie1()->getCode(),
                            'currentMonnaie2'=>$user->getSettings()->getMonnaie2()->getCode(),
                            'currentMonnaie3'=>$user->getSettings()->getMonnaie3()->getCode()));
    }
    
    public function saveAction(Request $request, $userid){
        $idMonnaie1 = $request->request->get('monnaie1');
        $idMonnaie2 = $request->request->get('monnaie2');
        $idMonnaie3 = $request->request->get('monnaie3');
        $idExtension = $request->request->get('extension');
        $errorMessageMonnaie = "Les identifiants de monnaie doivent etre toutes differentes";
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
        
        $repositoryUser = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZAUserBundle:User');
        
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
	//return new Response($userid);
        
        $user = $repositoryUser->find($userid);
        $user->getSettings()->setFormatExpFile($extension);
        $user->getSettings()->setMonnaie1($monnaie1);
        $user->getSettings()->setMonnaie2($monnaie2);
        $user->getSettings()->setMonnaie3($monnaie3);
        
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', "Parametres enregistre");
        return $this->redirectToRoute('waza_comptabilite_homepage', array('flash'=>true));
    }
}
