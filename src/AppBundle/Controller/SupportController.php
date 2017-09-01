<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\ContactFormType;

class SupportController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)       
    {
        //dump($request);
        //form object instance
        $form = $this->createForm(ContactFormType::class,null,['action'=>$this->generateUrl('handle_form_submission')]);

        return $this->render('support/index.html.twig',['our_form'=>$form->createView()]);
    }
    
    
    /**
     * @param Request $request
     * @Route("/form-submission", name="handle_form_submission")
     * @Method("POST")
     */
    public function handleFormSubmissionAction(Request $request)
    {
        $form = $this->createForm(ContactFormType::class);
        
        $form->handleRequest($request);
        
        if(!$form->isSubmitted() || !$form->isValid()){
            return $this->redirectToRoute('homepage');
        }

        $data = $form->getData();

        $message = \Swift_Message::newInstance()
                    ->setSubject('Contact Submission')
                    ->setFrom($data['from'])
                    ->setTo('jasonpolydor@gmail.com')
                    ->setBody($data['message'],'text/plain');

        $this->get('mailer')->send($message);
        $this->addFlash('success', 'Your message has been sent!');
        return $this->redirectToRoute('homepage');
    }
}
