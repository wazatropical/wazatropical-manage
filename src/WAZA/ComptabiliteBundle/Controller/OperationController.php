<?php


namespace WAZA\ComptabiliteBundle\Controller;

use WAZA\ComptabiliteBundle\Entity\Possederobjgain;
use WAZA\ComptabiliteBundle\Entity\Possederobjdep;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use WAZA\ComptabiliteBundle\Form\PossederobjgainType;
use WAZA\ComptabiliteBundle\Form\PossederobjdepType;

class OperationController extends Controller
{        
    public function listObjetAction(Request $request, $id, $op){
        $convert = $this->container->get('waza_comptabilite.change');
        if($op == 'dep'){
            $operation = 'depense';
            $titre = "Détails de la dépense";
        }else{
            $operation = 'gain';
            $titre = "Détails du gain";
        }
        
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Possederobj'. $op);
        
        $repositoryOp = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:'. ucfirst($operation));
        
        $listop = $repository->findBy(array($operation=>$id), array('date' => 'asc'));
        $puconvert1 = array();
        $puconvert2 = array();
        $puconvert3 = array();
        foreach($listop as $o){
            $monnaie1 = $o->getObjet()->getMonnaie()->getCode();
            $puconvert1[] = $convert->convertValue($o->getObjet()->getPu(),
                    $monnaie1, $this->getUser()->getSettings()->getMonnaie1()->getCode());
            $puconvert2[] = $convert->convertValue($o->getObjet()->getPu(),
                    $monnaie1, $this->getUser()->getSettings()->getMonnaie2()->getCode());
            $puconvert3[] = $convert->convertValue($o->getObjet()->getPu(),
                    $monnaie1, $this->getUser()->getSettings()->getMonnaie3()->getCode());
        }
        
        return $this->render('WAZAComptabiliteBundle:Core:listobjet.html.twig', array('datas' => $listop, 'src' => 'op_objet',
                            'titre'=> $titre, 'typeOperation'=>$operation, 'operation'=> $repositoryOp->find($id), 'op'=>$op,
                            'id' => $id, 'puconvert1'=>$puconvert1, 'puconvert2'=>$puconvert2, 'puconvert3'=>$puconvert3, 'modal'=> false));
    }   
    
    public function addObjetAction(Request $request, $id, $op){    
        if($op == 'gain'){
            $operation = 'Gain';
            $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:'.$operation);
            $oper = $repository->find($id);
            $objop = new Possederobjgain();  
            if($oper != NULL)
                $objop->setGain($oper);
            $objop->setQuantite(1);   
            $form = $this->get('form.factory')->create(PossederobjgainType::class, $objop);
        }else{
            $operation = 'Depense';
            $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:'.$operation);  
            $oper = $repository->find($id);
            $objop = new Possederobjdep();  
            if($oper != NULL)        
                $objop->setDepense($oper);
            $objop->setQuantite(1);   
            $form = $this->get('form.factory')->create(PossederobjdepType::class, $objop);
        }
        $user = $this->getUser();
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Possederobj'.$op);
                if($op == 'gain'){
                    $objg = $repository->findRelation($objop->getGain()->getId(), $objop->getObjet()->getId(), $objop->getDate(), $objop->getResponsable());
                }else{
                    $objg = $repository->findRelation($objop->getDepense()->getId(), $objop->getObjet()->getId(), $objop->getDate(), $objop->getResponsable());
                }
                if(sizeof($objg) != 0){
                    $qte = 0;
                    foreach($objg as $ob){
                        $qte += $ob->getQuantite();
                    }
                    $objg[0]->setQuantite($objop->getQuantite() + $qte);                    
                }else{
                    $objop->setUser($user);
                    $em->persist($objop);
                }
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Objet bien ajoute.');
                return $this->redirectToRoute('waza_op_objet_list', array('op'=>$op, 'id'=>$id, 'monnaie'=>'GBP'));
            }
        }
        return $this->render('WAZAComptabiliteBundle:Core:ajouter.html.twig', array('form' => $form->createView(),));
    }
    
    public function deleteObjetAction(Request $request, $ids, $op, $id){
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Possederobj'.$op);
        $ids = explode(",", $ids);
        ($op == 'dep')?$operation = 'depense':$operation = 'gain';
        foreach($ids as $i){
            $objop = $em->getRepository('WAZAComptabiliteBundle:Possederobj'.$op)->findBy(array($operation=>$id,
                                        'objet'=>$i));
            foreach ($objop as $o) {
                $em->remove($o);
            }
        }
        $em->flush();
        return $this->redirectToRoute('waza_op_objet_list', array('op'=> $op,
                                        'id'=>$id));
    }
    
    public function editObjetAction(Request $request, $op, $id){
        if($op == 'dep'){
            $operation = 'depense';
            $titre = "Détails de la dépense";
        }else{
            $operation = 'gain';
            $titre = "Détails du gain";
        }
        
        $repository = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZAComptabiliteBundle:Possederobj'.$op);
        $objop = $repository->find($id);
        if($op == "gain"){
            $form = $this->get('form.factory')->create(PossederobjgainType::class, $objop);
            $idOp = $objop->getGain()->getId();
        }else{
            $form = $this->get('form.factory')->create(PossederobjdepType::class, $objop);
            $idOp = $objop->getDepense()->getId();
        }
        $repository1 = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Monnaie');
        $listmonnaie = $repository1->findBy(array(), array('code' => 'asc'), null, null);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Objet bien modifie.');
                return $this->redirectToRoute('waza_op_objet_list', array('id' => $idOp, 'op'=> $op, 'monnaie'=>'GBP'));
            }
        }
        return $this->render('WAZAComptabiliteBundle:Core:listobjet.html.twig', array('id' => $id, 'formEdit' => $form->createView(), 'src' => 'op_objet',
                                'titre'=> $titre, 'op'=> $op, 'monnaies'=>$listmonnaie, 'modal' => True));
    }
}