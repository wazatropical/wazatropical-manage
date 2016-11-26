<?php

namespace WAZA\ComptabiliteBundle\Controller;

use WAZA\ComptabiliteBundle\Entity\Gain;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WAZA\ComptabiliteBundle\Form\GainType;

class GainController extends Controller
{
    
    public function addGainAction(Request $request){
        $gain = new Gain();
        $dateenreg = date_create("now", NULL );
        $gain->setDateenreg($dateenreg);
        $form = $this->get('form.factory')->create(GainType::class, $gain);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $user = $this->getUser();
                $gain->setUser($user);
                $em->persist($gain);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Gain bien enregistrée.');
                return $this->redirectToRoute('waza_gain_list');
            }
        }
        return $this->render('WAZAComptabiliteBundle:Core:ajouter.html.twig', array('form' => $form->createView(),));
    }
    
    public function listGainAction(){
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Gain');
        $listgain = $repository->findBy(array(), array('description' => 'asc'), null, null);
        $titre = "liste des gains";
        return $this->render('WAZAComptabiliteBundle:Core:listgain.html.twig', array('datas' => $listgain, 'src' => 'gain',
                            'titre'=> $titre, 'modal' => false));
    }
    
    public function deleteGainAction(Request $request, $ids){
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Gain');
        $ids = explode(",", $ids);
        foreach($ids as $id){
            $entity_product=$em->getRepository('WAZAComptabiliteBundle:Gain')->findBy(array('id'=>$id));
            foreach ($entity_product as $product) {
                $em->remove($product);
            }
        }
        $em->flush();
        return $this->redirectToRoute('waza_gain_list');
    }
    
    public function editGainAction(Request $request, $id){
        $repository = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZAComptabiliteBundle:Gain');
        $gain = new Gain();
        $gain = $repository->find($id);
        $form = $this->get('form.factory')->create(GainType::class, $gain);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Gain bien modifie.');
                return $this->redirectToRoute('waza_gain_list');
            }
        }
        $titre = "liste des gains";
        return $this->render('WAZAComptabiliteBundle:Core:listgain.html.twig', array('id' => $id, 'formEdit' => $form->createView(), 'src' => 'gain',
                                'titre'=> $titre, 'modal' => True));
    }
    
    public function searchGainAction(Request $request){
        $pattern = $request->query->get('pattern');
        if($pattern == ''){
            return $this->redirectToRoute('waza_gain_list');
        }else{
            $repository = $this->getDoctrine()
                                    ->getManager()
                                    ->getRepository('WAZAComptabiliteBundle:Gain');
            $gains = $repository->findCritere($pattern);
            $request->getSession()->getFlashBag()->add('notice', count($gains). " gains trouve(s)");
            $titre = "résultat de la recherche";
            return $this->render('WAZAComptabiliteBundle:Core:listgain.html.twig', array('datas' => $gains, 'src' => 'gain',
                                    'titre'=> $titre, 'modal' => false));
        }
    }
}

?>
