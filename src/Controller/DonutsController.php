<?php  
namespace App\Controller;  

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; 
use Symfony\Bundle\FrameworkBundle\Controller\Controller; 
use Symfony\Component\HttpFoundation\Response;  
use App\Entity\Donut;
use App\Entity\Orders;
 use Symfony\Component\HttpFoundation\Request; 
 use Symfony\Component\Form\Extension\Core\Type\TextType; 
 use Symfony\Component\Form\Extension\Core\Type\SubmitType;  

class DonutsController extends Controller { 
   /** 
      * @Route("/donuts/author") 
   */ 
   public function authorAction() { 
      return $this->render('donuts/author.html.twig'); 
   } 

   /** 
   * @Route("/donuts/display", name="app_donut_display") 
*/ 
public function displayAction() { 
  //  $repo = $this->getDoctrine()->getRepository(Login::class);
    $bk = $this->getDoctrine()
    ->getRepository(donut::class) 
    ->findAll(); 
    return $this->render('display.html.twig', array('data' => $bk)); 
 }


/**
   * @Route("/donuts/new", name="app_donut_new") 
*/ 
public function new(Request $request) { 
    $donut = new donut(); 
    $form = $this->createFormBuilder($donut) 
       ->add('name', TextType::class) 
       ->add('description', TextType::class) 
       ->add('price', TextType::class) 
       ->add('save', SubmitType::class, array('label' => 'Submit')) 
       ->getForm();  
    
    $form->handleRequest($request);  
    
    if ($form->isSubmitted() && $form->isValid()) { 
       $donut = $form->getData(); 
       $doct = $this->getDoctrine()->getManager();  
       
       // tells Doctrine you want to save the Product 
       $doct->persist($donut);  
       
       //executes the queries (i.e. the INSERT query) 
       $doct->flush();  
       
       return $this->redirectToRoute('app_donut_display'); 
    } else { 
       return $this->render('new.html.twig', array( 
          'form' => $form->createView(), 
       )); 
    } 
         
}














}