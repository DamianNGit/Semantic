<?php

namespace AppBundle\Controller;

use AppBundle\Form\DydaktykaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\RedirectResponse;

class TematykaBadawczaController extends Controller
{

    /**
     * @Route("/tematykaBadawcza", name="show_tematyka")
     */
    public function showTematyka()
    {
        $post = $this->getDoctrine()->getRepository('AppBundle:Dydaktyka')->find('1');

        return $this->render('default/tematykaBadawcza.html.twig',[
            'post' => $post
        ]);
    }

    /**
     * @Route("/tematykaBadawcza/edytuj", name="edit_tematyka")
     */
    public function editPracownik(Request $request)
    {

        $form = null;

        if($autor=$this->getUser())
        {
            $dydaktyka = $this->getDoctrine()->getRepository('AppBundle:Dydaktyka')->find('1');
            $form = $this->createForm(DydaktykaType::class, $dydaktyka);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                $this->addFlash('success', 'Tematyka badawcza została wyedytowana');

                return $this->redirectToRoute('show_tematyka');
            }

        }

        if(is_null($form))
        {
            $url = $this->generateUrl('fos_user_security_login');
            $response = new RedirectResponse($url);

            return $response;

        }else
        {
            return $this->render('default/edytujTematyka.html.twig', ['dydaktykaForm' => $form->createView(),'dydaktyka'=>$dydaktyka]);
        }


    }

}