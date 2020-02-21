<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Undocumented function
     * @Route("/", name="home")
     * @param PostRepository $postRepository
     * @return Response
     */
    public function index(PostRepository $postRepository):Response
    {
        return $this->render('home/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }
}
