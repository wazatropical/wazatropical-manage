<?php


namespace WAZA\ComptabiliteBundle\Controller;

use WAZA\ComptabiliteBundle\Entity\Production;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WAZA\ComptabiliteBundle\Form\ProductionType;

class ProductionController extends Controller
{        
    public function listProductionAction(){
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Production');
        $listproduction = $repository->findBy(array(), array('nom' => 'asc'), null, null);
        $titre = "liste des productions";
        return $this->render('WAZAComptabiliteBundle:Core:listproduction.html.twig', array('datas' => $listproduction, 'src' => 'production',
                            'titre'=>$titre, 'modal' => false));
    }   
    
    public function addProductionAction(Request $request){
        $production = new Production();
        $dateenreg = date_create("now", NULL );
        $production->setDateenreg($dateenreg);
        $form = $this->get('form.factory')->create(ProductionType::class, $production);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $user = $this->getUser();
                $production->setUser($user);
                $em->persist($production);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Production bien enregistrée.');
                return $this->redirectToRoute('waza_production_list');
            }
        }
        return $this->render('WAZAComptabiliteBundle:Core:ajouter.html.twig', array('form' => $form->createView(), 'modal'=>true));
    }
    
    public function deleteProductionAction(Request $request, $ids){
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Production');
        $ids = explode(",", $ids);
        //return new Response(sizeof($ids)."");
        foreach($ids as $id){
            $entity_product=$em->getRepository('WAZAComptabiliteBundle:Production')->findBy(array('id'=>$id));
            foreach ($entity_product as $product) {
                $em->remove($product);
            }
        }
        $em->flush();
        return $this->redirectToRoute('waza_production_list');
    }    
    
    public function editProductionAction(Request $request, $id){
        $repository = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZAComptabiliteBundle:Production');
        $production = $repository->find($id);
        $form = $this->get('form.factory')->create(ProductionType::class, $production);
        $stay = $request->query->get('stay');
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Production bien modifie.');
                if(!$stay)
                    return $this->redirectToRoute('waza_production_list');
                else
                    return $this->redirectToRoute('waza_prod_op_list', array('id'=>$id));
            }
        }
        $titre = "liste des productions";
            return $this->render('WAZAComptabiliteBundle:Core:listproduction.html.twig', array('id' => $id, 'formEdit' => $form->createView(), 'src' => 'production',
                                'titre'=>$titre, 'modal' => true));
    }
    
    public function searchProductionAction(Request $request){
        $pattern = $request->query->get('pattern');
        if($pattern == ''){
            return $this->redirectToRoute('waza_production_list');
        }else{
            $repository = $this->getDoctrine()
                                    ->getManager()
                                    ->getRepository('WAZAComptabiliteBundle:Production');
            $productions = $repository->findCritere($pattern);
            $request->getSession()->getFlashBag()->add('notice', count($productions). " productions trouve(s)");
            $titre = "résultat de la recherche";
            return $this->render('WAZAComptabiliteBundle:Core:listproduction.html.twig', array('datas' => $productions, 'src' => 'production', 
                                'titre'=>$titre, 'modal' => false));
        }
    }
}