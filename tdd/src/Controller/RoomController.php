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

class RoomController extends AbstractController
{

    #[Route('/user', name: 'user')]
    public function index():Response
    {

        $user = new User();
        $user->setUserName('Neha Mayur Honrao');
        $user->setCredit(100);
        $user->setPremiumMember(true);
        $form = $this->createFormBuilder($user)
            ->add('userName', TextType::class)
            ->add('credit',  TextType::class)
            ->add('premiumMember',TextType::class)
            ->add('Save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

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
