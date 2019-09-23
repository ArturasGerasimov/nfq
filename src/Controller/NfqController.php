<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\NewUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NfqController extends AbstractController
{
    /**
     * @Route("/", name="admin-page")
     */
    public function mainPage(Request $request)
    {
        $user = new User();
        $form = $this->createForm(NewUserType::class, $user);
        $form->handleRequest($request);

        $random = random_int(1, 40);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setHours(0);
            $user->setMinutes($random);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin-page');
        }

        return $this->render("mainpage/admin-page.html.twig", [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/queue", name="queue-page")
     */
    public function queueTimer()
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render("queue/queue-page.html.twig", [
            "users" => $user
        ]);
    }

    /**
     * @Route("/specialist-page", name="specialist-page")
     */
    public function specialistPage()
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render("specialist/specialist-page.html.twig", [
            "users" => $user
        ]);
    }

    /**
     * @Route("/user/delete/{user}", name="delete-user")
     */
    public function deleteDish(User $user)
    {

        $users = $this->getDoctrine()->getRepository(User::class)->findById($user->getId());

        foreach ($users as $user){
            $this->getDoctrine()->getManager()->remove($user);
        }

        $this->getDoctrine()->getManager()->remove($user);
        $this->getDoctrine()->getManager()->flush();


        return  $this->redirectToRoute('specialist-page');
    }

}