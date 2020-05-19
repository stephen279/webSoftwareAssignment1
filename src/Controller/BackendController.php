<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Login;
use App\Entity\Products;
use App\Entity\Orders;
use App\Entity\Book;
use App\Entity\Donut;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;   
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BackendController extends AbstractController
{

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
      //  echo 'the session username is ' . $username_sess;
      //  echo 'the session username is ' . $username_sess;
    }



    /**
     * @Route("/backend", name="backend") methods=("GET","POST")
     */
    public function index()
    {

        

$request = Request::createFromGlobals();

$type = $request->request->get('type','none');

if($type == 'register'){
            // catch the username
            $username = $request->request->get('username', 'this is username');
            $password = $request->request->get('password', 'this is password');
            $acctype = $request->request->get('acctype','none');


    
            $repo = $this->getDoctrine()->getRepository(Login::class);  //type of the entity

            $person = $repo->findOneBy([
                'username' => $username,
                'password' => $password

            ]);
         
         if  ($person!==''){
            return new Response(
              ' there is already account with this '
  
            );

            // test your input function pass in the inuts

          }  


            //put into databse
            $entityManager = $this->getDoctrine()->getManager();

            $login = new Login();
            $login->setUsername($username);
            $login->setPassword($password);
            $login->setAccType($acctype);

            $entityManager->persist($login);

            $entityManager->flush();
           
         //   return $this->render('index.html.twig'); 

      //   return new RedirectResponse('http://your.google.com');

        return new Response(

         
        //  RedirectResponse('http://your.google.com')
          'New Account was saved'
         //   return $this->render('index.html.twig')
        );
    }


////////////////////////////  LOGIN ///////////////////////////////////////////////

    else if($type == 'login'){

     // $name =  $email = $gender = $comment = $website = "";
     
      $username = $request->request->get('username', 'this is username');
      $password = $request->request->get('password', 'this is password');
      if (empty($username)||empty($username)) {
  
        return new Response(
          'Email and Password is required please'
      );
     
      } else {

       $username  = trim($username );
       $username = stripslashes($username );
       $username  = htmlspecialchars($username );
        
       $password  = trim($password );
       $password = stripslashes($password );
       $password  = htmlspecialchars($password );

     

            //set user session
                      // stores an attribute in the session for later reuse
         $this->session->set('username_sess',  $username);

                      // gets an attribute by name
         $foo = $this->session->get('username_sess');

       
        
        
           

            $repo = $this->getDoctrine()->getRepository(Login::class);  //type of the entity

            $person = $repo->findOneBy([
                'username' => $username,
                'password' => $password

            ]);
         
         if  ($person==''){
          
            return new Response(
              ' No Account record please register then login '
  
            );

            // test your input function pass in the inuts

          }  

            return new Response(
              
            $person->getAcctype()
     // $foo
    
           );

           

        }

      
      }
    


    else if($type == 'logout'){
     
   
             //clear user session
          // stores an attribute in the session for later reuse
         // $session->clear();
          $this->session->set('username_sess',  "");
 
             return new Response(
            
            'session cleared and logged out'
     
     
            );
 
            
 
         }
 
     
 
 
////////////////////////////////////////////// PORDUCTS ////////////////////////////////////////////////////





    else if($type == 'products'){


      // if not logged in and no session products wont diplay
      $foo = $this->session->get('username_sess');
      if ($foo){


     //  $repo = $this->getDoctrine()->getRepository(Login::class);
    $bk = $this->getDoctrine()
    ->getRepository(Donut::class) 
    ->findAll(); 
    $res = $this->renderView('display.html.twig', array('data' => $bk)); 

        return new Response(
     
        //   $myJSON;  
        'Account' .' '.$foo . $res
    
          ); 
        
        }

        return new Response(
     
          //   $myJSON;  
         'please log in to see products'
      
            ); 

}

////////////////////////////////////////////// DISPLAYORDERS  ////////////////////////////////////////////////////



else if($type == 'displayorders'){
  
   
  $foo = $this->session->get('username_sess');
  if ($foo){
  //  $repo = $this->getDoctrine()->getRepository(Login::class);
 $or = $this->getDoctrine()
 ->getRepository(Orders::class) 
 ->findAll(); 
 $res = $this->renderView('displayOrder.html.twig', array('data' => $or)); 

     return new Response(

      'Account'.' '. $foo . $res
  
     //   $myJSON;  
   //  'in else if displayorder'
 
       ); 
     
      }

}




////////////////////////////////////////////// DISPLAYonecustomerORDER ////////////////////////////////////////////////////



else if($type == 'displayOneorder'){

   
  $foo = $this->session->get('username_sess');
  if ($foo){
  //  $repo = $this->getDoctrine()->getRepository(Login::class);
 
  $or = $this->getDoctrine()->getRepository(Orders::class);  //type of the entity

  //->findAll();

  // look for multiple Product objects matching the name, ordered by price
  $prod = $or->findBy(['username' => 's@m.com']
);
  //echo $or->getProductsordered();
 $res = $this->renderView('displayOrder.html.twig', array('data' => $prod)); 

     return new Response(

      'Account' .' '. $foo . $res
  
     //   $myJSON;  
   //  'in else if displayorder'
 
       ); 
     
      }

}


////////////////////////////////////////////// ORDER    ////////////////////////////////////////////////////


else if($type == 'orders'){

  $username_sess = $this->session->get('username_sess');


  // catch the username
  $po = $request->request->get('productsordered', 'this is product');
  $tc = $request->request->get('totalcost', 'this is the cost');


  //$un = $request->request->get('username', 'this is username');
  //$acctype = $request->request->get('acctype','none');

  //put into databse
  $entityManager = $this->getDoctrine()->getManager();

  $order = new Orders();
  //$login->setUsername($username);
  $order->setProductsordered($po);
  $order->setTotalcost($tc);
  $order->setUsername($username_sess);
  $order->setStatus("Open");
  //$login->setAccType($acctype);

  $entityManager->persist($order);

  $entityManager->flush();
 
 



return new Response(
  'orders page was called'
);
}


    


////////////////////////////////////////////// ORDER    ////////////////////////////////////////////////////


else if($type == 'updateorders'){


  $username_sess = $this->session->get('username_sess');


  // catch the username
  $po = $request->request->get('updateproductsordered', 'this is update product');


  $entityManager = $this->getDoctrine()->getManager();
  $product = $entityManager->getRepository(Orders::class)->find($po );

  if (!$product) {
      throw $this->createNotFoundException(
          'No product found for id '.$id
      );
  }

  $product->setStatus('Complete');
 
  $entityManager->flush();
  return new Response(
    'status is changed to complete'
  );

  return $this->redirectToRoute('product_show', [
      'id' => $product->getId()
  ]);



  
 



}





////////////////////////////////////////////// NEW    ////////////////////////////////////////////////////



else if($type == 'new'){

 return $this->render('display.html.twig'); 

     return new Response(
  
     //   $myJSON;  
     'your in'
     
 
       ); 
     


}



}
}
