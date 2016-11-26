<?php

namespace WAZA\ComptabiliteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $repositoryObj = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Objet');
        $repositoryGain = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Gain');
        $repositoryDep = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Depense');
        $repositoryProducteur = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Producteur');
        $repositoryProduction = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Production');
        $repositoryPossederobjgain = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Possederobjgain');
        $repositoryPossederobjdep = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Possederobjdep');
        $nbObjUser = sizeof($repositoryObj->findBy(array('user'=>$this->getUser()->getId())));
        $nbGainjUser = sizeof($repositoryGain->findBy(array('user'=>$this->getUser()->getId())));
        $nbDepUser = sizeof($repositoryDep->findBy(array('user'=>$this->getUser()->getId())));
        $nbProducteurUser = sizeof($repositoryProducteur->findBy(array('user'=>$this->getUser()->getId())));
        $nbProductionUser = sizeof($repositoryProduction->findBy(array('user'=>$this->getUser()->getId())));
        $nbProductionActUser = sizeof($repositoryProduction->findBy(array('user'=>$this->getUser()->getId(), 'etat'=>1)));
        $nbProductionInUser = sizeof($repositoryProduction->findBy(array('user'=>$this->getUser()->getId(), 'etat'=>0)));
        $nbPossederobjgainUser = sizeof($repositoryPossederobjgain->findBy(array('user'=>$this->getUser()->getId())));
        $nbPossederobjdepUser = sizeof($repositoryPossederobjdep->findBy(array('user'=>$this->getUser()->getId())));
        return $this->render('WAZAComptabiliteBundle:Default:index.html.twig', array('nbObjUser'=>$nbObjUser,
                                                                                        'nbGainjUser'=>$nbGainjUser,
                                                                                        'nbDepUser'=>$nbDepUser,
                                                                                        'nbProducteurUser'=>$nbProducteurUser,
                                                                                        'nbProductionUser'=>$nbProductionUser,
                                                                                        'nbProductionActUser'=>$nbProductionActUser,
                                                                                        'nbProductionInUser'=>$nbProductionInUser,
                                                                                        'nbPossederobjgainUser'=>$nbPossederobjgainUser,
                                                                                        'nbPossederobjdepUser'=>$nbPossederobjdepUser,
            
                                                                                        'nbObjUserT'=>sizeof($repositoryObj->findAll()),
                                                                                        'nbGainjUserT'=>sizeof($repositoryGain->findAll()),
                                                                                        'nbDepUserT'=>sizeof($repositoryDep->findAll()),
                                                                                        'nbProducteurUserT'=>sizeof($repositoryProducteur->findAll()),
                                                                                        'nbProductionUserT'=>sizeof($repositoryProduction->findAll()),
                                                                                        'nbProductionActUserT'=>sizeof($repositoryProduction->findBy(array('etat'=>1))),
                                                                                        'nbProductionInUserT'=>sizeof($repositoryProduction->findBy(array('etat'=>0))),
                                                                                        'nbPossederobjgainUserT'=>sizeof($repositoryPossederobjgain->findAll()),
                                                                                        'nbPossederobjdepUserT'=>sizeof($repositoryPossederobjdep->findAll())));
    }
}
