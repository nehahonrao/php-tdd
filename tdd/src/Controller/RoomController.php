<?php

namespace App\Controller;

use App\Entity\Room;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints as Assert;


class RoomController extends AbstractController

{

    #[Route('/user', name: 'user')]
    public function index(Request $request,ManagerRegistry $doctrine):Response
    {

        $user = new User();
        // $user->setUserName('Neha Mayur Honrao');
        // $user->setCredit(100);
        // $user->setPremiumMember(true);
        $form = $this->createFormBuilder($user)
            ->add('userName', TextType::class)
            ->add('credit',  TextType::class)
            ->add('premiumMember',TextType::class)
            ->add('Save', SubmitType::class, ['label' => 'Register'])
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
                $name = $form['userName']->getData();
                $credit = $form['credit']->getData();
                $premium = $form['premiumMember']->getData();

                $user->setUserName($name);
                $user->setCredit($credit);
                $user->setPremiumMember($premium);


    
               // tell Doctrine you want to (eventually) save the Product (no queries yet)
               $entityManager = $doctrine->getManager();
               $entityManager->persist($user);
               
              // actually executes the queries (i.e. the INSERT query)
              $entityManager->flush();

            }

            return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }


    #[Route('/room', name: 'room')]
    public function room(EntityManagerInterface $roomRepository): Response
    {

        $rooms = $roomRepository->getRepository(Room::class)->findAll();

        return $this->render('room/index.html.twig', [
            'rooms' => $rooms,
        ]);
    }
}
