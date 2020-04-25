<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    /**
     * @Route("/weather/index")
     */
    public function index()
    {
        return $this->render('weather.html.twig');
      //  return $this->render('index.html.twig');
    }
}
