<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Strona;
use AppBundle\Form\StronaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\RedirectResponse;

class PracownikController extends Controller
{

    /**
     * @Route("/pracownik/{id}", name="show_pracownik")
     */
    public function showPracownik(Strona $strona)
    {
        $form = $this->createForm(StronaType::class);
        return $this->render('default/pracownik.html.twig',[
            'strona' => $strona,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/dodaj", name="add_pracownik")
     */
    public function addPracownik(Request $request)
    {

        $form = null;

        //jeśli użytkownik będzie zalogowany
        if($autor=$this->getUser())
        {
            $dodajPr = new Strona();

            $dodajPr->setAutor($autor);

            $form = $this->createForm(StronaType::class, $dodajPr);
            $form->handleRequest($request);

            if($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($dodajPr);
                $em->flush();

                $this->addFlash('success', 'Pracownik został dodany');

                return $this->redirectToRoute('show_pracownik', array('id' => $dodajPr->getId()));
            }

        }

        if(is_null($form))
        {
            $url = $this->generateUrl('fos_user_security_login');
            $response = new RedirectResponse($url);

            return $response;

        }else
        {
            return $this->render('default/dodaj.html.twig',['form' => $form->createView()]);
        }
    }

    /**
     * @Route("/edytuj/pracownik/{id}", name="edit_pracownik")
     */
    public function editPracownik(Request $request, Strona $strona)
    {

        $form = null;

        if($autor=$this->getUser())
        {

            $form = $this->createForm(StronaType::class, $strona);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                $this->addFlash('success', 'Pracownik został wyedytowany');

                return $this->redirectToRoute('show_pracownik', array('id' => $strona->getId()));
            }

        }

        if(is_null($form))
        {
            $url = $this->generateUrl('fos_user_security_login');
            $response = new RedirectResponse($url);

            return $response;

        }else
        {
            return $this->render('default/edytuj.html.twig', ['stronaForm' => $form->createView()]);
        }


    }

    /**
     * @Route("/wybierz", name="chose_pracownik")
     */
    public function chosePracownik(Request $request)
    {

        $qb = $this->getDoctrine()
            ->getManager()
            ->createQueryBuilder()
            ->from('AppBundle:Strona','tresc')
            ->select('tresc');

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $qb,
            $request->query->get('page',1),
            5
        );

        return $this->render('default/wybierz.html.twig',['stronaW' => $pagination]);

    }


    /**
     * @Route("/dousuniecia", name="chosetodelete_pracownik")
     */
    public function choseToDeletePracownik(Request $request)
    {

        $qb = $this->getDoctrine()
            ->getManager()
            ->createQueryBuilder()
            ->from('AppBundle:Strona','tresc')
            ->select('tresc');

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $qb,
            $request->query->get('page',1),
            5
        );

        return $this->render('default/dousuniecia.html.twig',['stronaW' => $pagination]);

    }

    /**
     * @Route("/usun/pracownik/{id}", name="delete_pracownik")
     */
    public function deletePracownik(Request $request, Strona $strona)
    {
        $form = null;

        if($autor=$this->getUser())
        {

            $form = $this->createForm(StronaType::class, $strona);
            $form->handleRequest($request);


                $em = $this->getDoctrine()->getManager();
                $em->remove($strona);
                $em->flush();

                $this->addFlash('success', 'Pracownik został usunięty');

                return $this->redirectToRoute('chosetodelete_pracownik');

        }

        if(is_null($form))
        {
            $url = $this->generateUrl('fos_user_security_login');
            $response = new RedirectResponse($url);

            return $response;

        }

    }

}