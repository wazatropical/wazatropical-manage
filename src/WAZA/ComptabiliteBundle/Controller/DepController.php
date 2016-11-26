<?php

namespace WAZA\ComptabiliteBundle\Controller;

use WAZA\ComptabiliteBundle\Entity\Depense;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WAZA\ComptabiliteBundle\Form\DepenseType;

class DepController extends Controller
{
    
    public function addDepAction(Request $request){
        $dep = new Depense();
        $dateenreg = date_create("now", NULL );
        $dep->setDateenreg($dateenreg);
        $form = $this->get('form.factory')->create(DepenseType::class, $dep);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $user = $this->getUser();
                $dep->setUser($user);
                $em->persist($dep);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Depense bien enregistrée.');
                return $this->redirectToRoute('waza_dep_list');
            }
        }
        return $this->render('WAZAComptabiliteBundle:Core:ajouter.html.twig', array('form' => $form->createView(),));
    }
    
    public function listDepAction(){
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('WAZAComptabiliteBundle:Depense');
        $listdep = $repository->findBy(array(), array('description' => 'asc'), null, null);
        $titre = "liste des dépenses";
        return $this->render('WAZAComptabiliteBundle:Core:listdep.html.twig', array('datas' => $listdep, 'src' => 'dep',
                            'titre'=>$titre, 'modal' => false));
    }
    
    public function deleteDepAction(Request $request, $ids){
        $em = $this->getDoctrine()->getManager();
        $ids = explode(",", $ids);
        foreach($ids as $id){
            $entity_product=$em->getRepository('WAZAComptabiliteBundle:Depense')->findBy(array('id'=>$id));
            foreach ($entity_product as $product) {
                $em->remove($product);
            }
        }
        $em->flush();
        return $this->redirectToRoute('waza_dep_list');
    }
    
    public function editDepAction(Request $request, $id){
        $repository = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('WAZAComptabiliteBundle:Depense');
        $dep = $repository->find($id);
        $form = $this->get('form.factory')->create(DepenseType::class, $dep);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Depense bien modifie.');
                return $this->redirectToRoute('waza_dep_list');
            }
        }
        $titre = "Résultat de la recherche";
        return $this->render('WAZAComptabiliteBundle:Core:listdep.html.twig', array('id' => $id, 'formEdit' => $form->createView(), 'src' => 'dep',
                                'titre'=>$titre, 'modal' => True));
    }
    
    public function searchDepAction(Request $request){
        $pattern = $request->query->get('pattern');
        if($pattern == ''){
            return $this->redirectToRoute('waza_dep_list');
        }else{
            $titre = "Résultat de la recherche";
            $repository = $this->getDoctrine()
                                    ->getManager()
                                    ->getRepository('WAZAComptabiliteBundle:Depense');
            $deps = $repository->findCritere($pattern);
            $request->getSession()->getFlashBag()->add('notice', count($deps). " depenses trouve(s)");
            return $this->render('WAZAComptabiliteBundle:Core:listdep.html.twig', array('datas' => $deps, 'src' => 'dep',
                                    'titre'=>$titre, 'modal' => false));
        }
    }
}

?>
