<?php

namespace App\Controller;

use App\Entity\FeedbackRequest;
use App\Form\FeedbackRequestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackRequestController extends AbstractController
{
    /**
     * @Route("/feedback/request", name="feedback_request")
     */
    public function index()
    {
        $feedbackRequest = new FeedbackRequest();
        $form = $this->createForm(FeedbackRequestType::class, $feedbackRequest);

        return $this->render('feedback_request/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
