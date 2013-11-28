<?php

namespace Home\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Home\UserBundle\Form\Type\RegistrationType;
use Home\UserBundle\Form\Model\Registration;

class AccountController extends Controller
{
    public function registerAction()
    {
        $registration = new Registration();
        
        $form = $this->createForm(new RegistrationType(), $registration, array(
            'action' => $this->generateUrl('account_create')
        ));
        
        return $this->render('HomeUserBundle:Account:register.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function createAction(Request $request)
    {
        $factory = $this->get('security.encoder_factory');
        
        $em = $this->getDoctrine()->getManager();
        
        $form = $this->createForm(new RegistrationType(), new Registration());
        
        $form->handleRequest($request);
        
        if($form->isValid()) {
            $registration = $form->getData();
            //print_r($registration->getUser());die;
            $encoder = $factory->getEncoder($registration->getUser());
            $password = $encoder->encodePassword('ryanpass', $registration->getUser()->getSalt());
            $registration->getUser()->setPassword($password);
            
            $em->persist($registration->getUser());
            $em->flush();
            return $this->redirect($this->generateUrl('account_success'));
        }
        
        return $this->render('HomeUserBundle:Account:register.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
