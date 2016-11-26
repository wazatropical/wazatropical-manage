<?php


namespace WAZA\ComptabiliteBundle\Controller;

use WAZA\ComptabiliteBundle\Entity\Producteur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WAZA\ComptabiliteBundle\Form\ProducteurType;

class ProducteurController extends Controller
{        
    public function listProducteurAction(){
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Producteur');
        $listproducteur = $repository->findBy(array(), array('nom' => 'asc'), null, null);
        $titre = "liste des producteurs";
        return $this->render('WAZAComptabiliteBundle:Core:listproducteur.html.twig', array('datas' => $listproducteur, 'src' => 'producteur',
                            'titre'=>$titre, 'modal' => false));
    }   
    
    public function addProducteurAction(Request $request){
        $producteur = new Producteur();
        $dateenreg = date_create("now", NULL );
        $producteur->setDateenreg($dateenreg);
        $form = $this->get('form.factory')->create(ProducteurType::class, $producteur);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $user = $this->getUser();
                $producteur->setUser($user);
                $em->persist($producteur);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Producteur bien enregistrée.');
                return $this->redirectToRoute('waza_producteur_list');
            }
        }
        return $this->render('WAZAComptabiliteBundle:Core:ajouter.html.twig', array('form' => $form->createView(),));
    }
    
    public function deleteProducteurAction(Request $request, $ids){
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Producteur');
        $ids = explode(",", $ids);
        foreach($ids as $id){
            $entity_product=$em->getRepository('WAZAComptabiliteBundle:Producteur')->findBy(array('id'=>$id));
            foreach ($entity_product as $product) {
                $em->remove($product);
            }
        }
        $em->flush();
        return $this->redirectToRoute('waza_producteur_list');
    }    
    
    public function editProducteurAction(Request $request, $id){
        $repository = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZAComptabiliteBundle:Producteur');
        $producteur = $repository->find($id);
        $form = $this->get('form.factory')->create(ProducteurType::class, $producteur);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Producteur bien modifie.');
                return $this->redirectToRoute('waza_producteur_list');
            }
        }
        $titre = "liste des producteurs";
        return $this->render('WAZAComptabiliteBundle:Core:listproducteur.html.twig', array('id' => $id, 'formEdit' => $form->createView(), 'src' => 'producteur',
                                'titre'=>$titre, 'modal' => true));
    }
    
    public function searchProducteurAction(Request $request){
        $pattern = $request->query->get('pattern');
        if($pattern == ''){
            return $this->redirectToRoute('waza_producteur_list');
        }else{
            $repository = $this->getDoctrine()
                                    ->getManager()
                                    ->getRepository('WAZAComptabiliteBundle:Producteur');
            $producteurs = $repository->findCritere($pattern);
            $request->getSession()->getFlashBag()->add('notice', count($producteurs). " producteurs trouve(s)");
            $titre = "Résultat de la recherche";
            return $this->render('WAZAComptabiliteBundle:Core:listproducteur.html.twig', array('datas' => $producteurs, 'src' => 'producteur', 
                                'titre'=>$titre, 'modal' => false));
        }
    }
}