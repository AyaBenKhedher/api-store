<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        
         $articles = $repo->findAll();

         return $this->render("home/index.html.twig", [
            'articles' => $articles,
        ]);
    }


     /**
     * @Route("/show/{id}", name="show")
     */
    public function show($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        
        $article = $repo->find($id);


        if(!$article){
            $this->redirectToRoute('home');  
        }

        return $this->render("show/index.html.twig", [
            'article' => $article,
        ]);
    }
}
