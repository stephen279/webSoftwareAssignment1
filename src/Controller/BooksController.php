<?php  
namespace App\Controller;  

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; 
use Symfony\Bundle\FrameworkBundle\Controller\Controller; 
use Symfony\Component\HttpFoundation\Response;  
use App\Entity\Book;
use App\Entity\Orders;
 use Symfony\Component\HttpFoundation\Request; 
 use Symfony\Component\Form\Extension\Core\Type\TextType; 
 use Symfony\Component\Form\Extension\Core\Type\SubmitType;  

class BooksController extends Controller { 
   /** 
      * @Route("/books/author") 
   */ 
   public function authorAction() { 
      return $this->render('books/author.html.twig'); 
   } 

   /** 
   * @Route("/books/display", name="app_book_display") 
*/ 
public function displayAction() { 
  //  $repo = $this->getDoctrine()->getRepository(Login::class);
    $bk = $this->getDoctrine()
    ->getRepository(Book::class) 
    ->findAll(); 
    return $this->render('display.html.twig', array('data' => $bk)); 
 }


/**
   * @Route("/books/new", name="app_book_new") 
*/ 
public function new(Request $request) { 
    $book = new Book(); 
    $form = $this->createFormBuilder($book) 
       ->add('name', TextType::class) 
       ->add('author', TextType::class) 
       ->add('price', TextType::class) 
       ->add('save', SubmitType::class, array('label' => 'Submit')) 
       ->getForm();  
    
    $form->handleRequest($request);  
    
    if ($form->isSubmitted() && $form->isValid()) { 
       $book = $form->getData(); 
       $doct = $this->getDoctrine()->getManager();  
       
       // tells Doctrine you want to save the Product 
       $doct->persist($book);  
       
       //executes the queries (i.e. the INSERT query) 
       $doct->flush();  
       
       return $this->redirectToRoute('app_book_display'); 
    } else { 
       return $this->render('new.html.twig', array( 
          'form' => $form->createView(), 
       )); 
    } 
         
}














}