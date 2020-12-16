<?php

namespace App\Controller;

use App\Entity\Machine;
use App\Form\MachineType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MachineController extends AbstractController
{
    /**
     * @Route("/machine/machines", name="machine")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $machine = new Machine();
        $form = $this->createForm(MachineType::class,$machine,array('action'=>$this->generateUrl('new_machine')));
        $data['form']=$form->createView();
        $data['machines'] = $em->getRepository('App\Entity\Machine')->findAll();
        return $this->render('machine/index.html.twig',$data);
    }
    /**
     * @Route("machine/add", name="new_machine")
     */
    public function add(Request $requet)
    {
      
        $machine = new Machine();
        $form = $this->createForm(MachineType::class,$machine);
        $form->handleRequest($requet);
        if($form->isSubmitted() && $form->isValid()){
            $machine =$form->getData();
            $machine-> setUsers($this->getUser());
           
            $em =$this->getDoctrine()->getManager();
            $em->persist($machine);
            $em->flush();

        }
        return $this->redirectToRoute('machine');
    
    }
    
}
