<?php

namespace WAZA\ComptabiliteBundle\Controller;

use WAZA\ComptabiliteBundle\Entity\Objet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WAZA\ComptabiliteBundle\Form\ObjetType;

class ObjetController extends Controller
{
    
    public function addObjetAction(Request $request){
        $objet = new Objet();
        $dateenreg = date_create("now", NULL );
        $objet->setDateenreg($dateenreg);
        $form = $this->get('form.factory')->create(ObjetType::class, $objet);
        $user = $this->getUser();
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $objet->setUser($user);
                $em->persist($objet);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Objet bien enregistrée.');
                return $this->redirectToRoute('waza_objet_list');
            }
        }
        return $this->render('WAZAComptabiliteBundle:Core:ajouter.html.twig', array('form' => $form->createView(),));
    }
    
    public function listObjetAction(){
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Objet');
        $listobjet = $repository->findBy(array(), array('nom' => 'asc'), null, null);
        $repository1 = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Monnaie');
        $listmonnaie = $repository1->findBy(array(), array('code' => 'asc'), null, null);
        $titre = "liste des objets";
        return $this->render('WAZAComptabiliteBundle:Core:listobjet.html.twig', array('datas' => $listobjet, 'src' => 'objet',
                            'titre'=>$titre, 'monnaies'=>$listmonnaie, 'modal'=>True));
    }
    
    public function deleteObjetAction(Request $request, $ids){
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Objet');
        $ids = explode(",", $ids);
        foreach($ids as $id){
            $entity_product=$em->getRepository('WAZAComptabiliteBundle:Objet')->findBy(array('id'=>$id));
            foreach ($entity_product as $product) {
                $em->remove($product);
            }
        }
        $em->flush();
        return $this->redirectToRoute('waza_objet_list');
    }
    
    public function editObjetAction(Request $request, $id){
        $repository = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZAComptabiliteBundle:Objet');
        $objet = new Objet();
        $objet = $repository->find($id);
        $form = $this->get('form.factory')->create(ObjetType::class, $objet);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Objet bien modifie.');
                return $this->redirectToRoute('waza_objet_list');
            }
        }
        $titre = "liste des objets";
        return $this->render('WAZAComptabiliteBundle:Core:listobjet.html.twig', array('id' => $id, 'formEdit' => $form->createView(), 'src' => 'objet',
                            'titre'=>$titre, 'modal', True));
    }
    
    public function searchObjetAction(Request $request){
        $pattern = $request->query->get('pattern');
        if($pattern == ''){
            return $this->redirectToRoute('waza_objet_list');
        }else{
            $repository = $this->getDoctrine()
                                    ->getManager()
                                    ->getRepository('WAZAComptabiliteBundle:Objet');
            $objets = $repository->findCritere($pattern);
            $request->getSession()->getFlashBag()->add('notice', count($objets). " objets trouve(s)");
            $titre = "Résultat de la recherche";
            return $this->render('WAZAComptabiliteBundle:Core:listobjet.html.twig', array('datas' => $objets,
                'titre'=>$titre, 'src' => 'objet'));
        }
    }
    
}

?>
