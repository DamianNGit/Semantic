<?php

namespace AppBundle\Controller;

use AppBundle\Form\DydaktykaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\RedirectResponse;

class DydaktykaController extends Controller
{

    /**
     * @Route("/dydaktyka", name="show_dydaktyka")
     */
    public function showTematyka()
    {
        $post = $this->getDoctrine()->getRepository('AppBundle:Dydaktyka')->find('2');

        return $this->render('default/dydaktyka.html.twig',[
            'post' => $post
        ]);
    }

    /**
     * @Route("/dydaktyka/edytuj", name="edit_dydaktyka")
     */
    public function editPracownik(Request $request)
    {

        $form = null;

        if($autor=$this->getUser())
        {
            $dydaktyka = $this->getDoctrine()->getRepository('AppBundle:Dydaktyka')->find('2');
            $form = $this->createForm(DydaktykaType::class, $dydaktyka);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                $this->addFlash('success', 'Dydaktyka została wyedytowana');

                return $this->redirectToRoute('show_dydaktyka');
            }

        }

        if(is_null($form))
        {
            $url = $this->generateUrl('fos_user_security_login');
            $response = new RedirectResponse($url);

            return $response;

        }else
        {
            return $this->render('default/edytujDydaktyka.html.twig', ['dydaktykaForm' => $form->createView(),'dydaktyka'=>$dydaktyka]);
        }


    }

}