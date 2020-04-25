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


    



            //put into databse
            $entityManager = $this->getDoctrine()->getManager();

            $login = new Login();
            $login->setUsername($username);
            $login->setPassword($password);
            $login->setAccType($acctype);

            $entityManager->persist($login);

            $entityManager->flush();
           
           



        return new Response(
            'register page was called'
        );
    }

    else if($type == 'login'){
     
   

            $username = $request->request->get('username', 'this is username');
            $password = $request->request->get('password', 'this is password');




            //set user session
                      // stores an attribute in the session for later reuse
                      $this->session->set('username_sess',  $username);

                      // gets an attribute by name
                    //  $username_sess = $this->session->get('username_sess');
                      //echo 'the session username is ' . $username_sess;

           

            $repo = $this->getDoctrine()->getRepository(Login::class);  //type of the entity

            $person = $repo->findOneBy([
                'username' => $username,
                'password' => $password

            ]);
         

            return new Response(
               $person->getAcctype()
            //'login page was called'
             //   'login' . var_dump($person)
            );


    }

    else if($type == 'products'){
     

     //  $repo = $this->getDoctrine()->getRepository(Login::class);
    $bk = $this->getDoctrine()
    ->getRepository(Donut::class) 
    ->findAll(); 
    return $this->render('display.html.twig', array('data' => $bk)); 

        return new Response(
     
        //   $myJSON;  
        'in products'
    
          ); 
        


}

else if($type == 'displayorders'){
   

  //  $repo = $this->getDoctrine()->getRepository(Login::class);
 $or = $this->getDoctrine()
 ->getRepository(Orders::class) 
 ->findAll(); 
 return $this->render('displayOrder.html.twig', array('data' => $or)); 

     return new Response(
  
     //   $myJSON;  
     'in else if displayorder'
 
       ); 
     


}




else if($type == 'orders'){

        $username_sess = $this->session->get('username_sess');
       //echo 'the session username is ' . $username_sess;

  // catch the username
  $po = $request->request->get('productsordered', 'this is product');

 // echo"insideOrders";


  //$un = $request->request->get('username', 'this is username');
  //$acctype = $request->request->get('acctype','none');






  //put into databse
  $entityManager = $this->getDoctrine()->getManager();

  $order = new Orders();
  //$login->setUsername($username);
  $order->setProductsordered($po);
  $order->setUsername($username_sess);
  //$login->setAccType($acctype);

  $entityManager->persist($order);

  $entityManager->flush();
 
 



return new Response(
  'orders page was called'
);
}


else if($type == 'new'){

 return $this->render('display.html.twig'); 

     return new Response(
  
     //   $myJSON;  
     'your in'
     
 
       ); 
     


}



}
}
