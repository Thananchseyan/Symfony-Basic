<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{

    /**
     * https://symfony.com/doc/2.0/quick_tour/the_view.html
     */
    #[Route('/view', name: 'view_movie')]
    public function viewMovie(): Response
    {
        return $this -> render('index.html.twig', [
            'title' => 'Avenger'
        ]);
    } 

    #[Route('/ifconditionview', name:'condition_view')]
    public function viewConditionMovie(): Response
    {
        return $this -> render('condition.html.twig', [
            'title' => 'Leo'
        ]);
    }

    #[Route('/elseconditionview', name:'else_condition_view')]
    public function elseConditionMovie(): Response
    {
        return $this -> render('condition.html.twig', [
            'title' => ''
        ]);
    }

    #[Route('/movies', name: 'movies')]
    public function movieView(): Response
    {
        return $this -> render('heritance.html.twig',[
            'title' => 'Leo'
        ]);
    }

    #[Route('/conditionmovies', name: 'condition_movies')]
    public function conditionMovieView(): Response
    {
        $movies = ['Leo', 'Jailer', 'Vikram'];
        return $this-> render('heritance.html.twig', array(
            'movies' => $movies
        )); 
    }
}