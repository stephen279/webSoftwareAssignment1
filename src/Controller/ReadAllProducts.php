<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Products;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;   

class ReadAllProducts extends AbstractController
{
    /**
     * @Route("/readAllProducts", name="readAllProducts") methods=("GET","POST")
     */
    public function index()
    {
       
        return $this->render('readAllProducts/index.html.twig',[
            'controller_name'=>'ReadAllProducts',
        ]);
    }
}