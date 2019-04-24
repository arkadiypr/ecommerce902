<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="about")
     */
    public function index()
    {
        return $this->render('about/index.html.twig', [
            'controller_name' => 'AboutController',
        ]);
    }

    /**
     * @Route("/contact", name="about_contact")
     */
    public function contact()
    {
        $name = 'Anonymous';
        $pass = '********';

        return $this->render('about/contact.html.twig',
            [
                'userName' => $name,
                'password' => $pass
            ]);
    }
}
