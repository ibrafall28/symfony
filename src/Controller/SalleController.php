<?php

namespace App\Controller;

use App\Entity\Salle;
use App\Form\SalleType;
use App\Repository\SalleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
class SalleController extends AbstractController
{
    /**
     * @Route("/liste", name="liste")
     */
    public function list(SalleRepository $salleRepository)
    {
         // Configure Dompdf according to your needs
         $pdfOptions = new Options();
         $pdfOptions->set('defaultFont', 'Arial');
         
         // Instantiate Dompdf with our options
         $dompdf = new Dompdf($pdfOptions);
       
        
        $salle = $salleRepository->findAll();
    
         // Retrieve the HTML generated in our twig file
         $html = $this->renderView('salle/liste.html.twig', [
             'salles' => $salle
         ]);
         
         // Load HTML to Dompdf
         $dompdf->loadHtml($html);
         
         // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
         $dompdf->setPaper('A4', 'portrait');
 
         // Render the HTML as PDF
         $dompdf->render();
 
         // Output the generated PDF to Browser (force download)
         $dompdf->stream("mypdf.pdf", [
             "Attachment" => false
         ]);
     }
        
    
    
    /**
     * @Route("/salle/salles", name="salle")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $salle = new Salle();
        $form = $this->createForm(SalleType::class,$salle,array('action'=>$this->generateUrl('new')));
        $data['form']=$form->createView();
        $data['salles'] = $em->getRepository('App\Entity\Salle')->findAll();
        return $this->render('salle/index.html.twig',$data);
    }
    /**
     * @Route("salle/add", name="new")
     */
    public function add(Request $requet)
    {
     
        $salle = new Salle();
        $form = $this->createForm(SalleType::class,$salle);
        $form->handleRequest($requet);
        if($form->isSubmitted() && $form->isValid()){
            $salle =$form->getData();
            $salle-> setUsers($this->getUser());
            $em =$this->getDoctrine()->getManager();
            $em->persist($salle);
            $em->flush();
            $this->addFlash('success', 'salle Crer avec succee');
            
        }
        return $this->redirectToRoute('salle');
   }
    /**
     * @Route("salle/edit/{id}", name="edit")
     */
    public function edit($id)
    {
        $em =$this->getDoctrine()->getManager();
        $salle = $em->getRepository(Salle::class)->find($id);
       
      
        $form = $this->createForm(SalleType::class,$salle,array('action'=>$this->generateUrl('update',['id'=>$id])));
        $data['form']=$form->createView();
        $data['salles'] = $em->getRepository('App\Entity\Salle')->findAll();
    
        return $this->render('salle/index.html.twig',$data);
            
        
        return $this->redirectToRoute('salle');
    
    }
    /**
     * @Route("salle/update/{id}", name="update")
     */
    public function update($id,Request $requet)
    {
     
        $salle = new Salle();
        $form = $this->createForm(SalleType::class,$salle);
        $form->handleRequest($requet);
        if($form->isSubmitted() && $form->isValid()){
            $salle =$form->getData();
 
             
            $salle->setId($id);
            $em =$this->getDoctrine()->getManager();
            $s = $em->getRepository(Salle::class)->find($id);
            $s->setNom($salle->getNom());
            $em->flush();
            
        }
        return $this->redirectToRoute('salle');
    
    }
    /**
     * @Route("salle/delate/{id}", name="delate")
     */
    public function delate($id)
    {
        $em =$this->getDoctrine()->getManager();
        $salle = $em->getRepository(Salle::class)->find($id);
            if($salle!=null){
                $em->remove($salle);
                $em->flush();
            }
        
        return $this->redirectToRoute('salle');
    
    }

}