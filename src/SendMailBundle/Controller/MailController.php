<?php

namespace SendMailBundle\Controller;

use SendMailBundle\Form\Type\MailType;
use SendMailBundle\Model\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends Controller
{
    /**
     * @Route("/", name="send_mail")
     */
    public function indexAction(Request $request)
    {

        $mail = new Mail();
        $form = $this->createForm(MailType::class, $mail);

       if ($request->isMethod('POST')) {
           $form->handleRequest($request);
           if($form->isValid()) {
               $this->get('mail_factory')->send($mail);
               $flash = $this->get('braincrafted_bootstrap.flash');
               $flash->success('Message sent');

               return $this->redirectToRoute('send_mail');
           }
       }
       return $this->render(
           'SendMailBundle:Mail:index.html.twig', ['form' => $form->createView()]);
    }
}
