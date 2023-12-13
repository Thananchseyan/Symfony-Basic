<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    #[Route('/projects', name: 'app_project')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProjectController.php',
        ]);
    }

    /**
     * to console the log about the routing symfony console debug:router
     */
    #[Route('/old', name: 'old')]
    public function oldmethod() : JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your old controller!',
            'path' => 'src/Controller/ProjectController.php',
        ]);
    }

    #[Route('/project/{name}', name: 'project')]
    public function specificProject(string $name): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your '.$name.' !',
            'path' => 'src/Controller/ProjectController.php',
        ]);
    }

    /**
     * By default, routes match any HTTP verb (GET, POST, PUT, etc.) Use the methods option to restrict 
     * the verbs each route should respond to
     */

    #[Route('/method/{name}', name: 'method', methods:['GET','HEAD'])]
    public function methodSpecificFunction(string $name): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your '.$name.' !, We are getting this with method specific',
            'path' => 'src/Controller/ProjectController.php',
        ]);
    }

    #[Route('/default/{name}', name: 'default', defaults:['name' => 'null'], methods:['GET','HEAD'])]
    public function defaultSpecificFunction(string $name): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your '.$name.' !, We are getting this with default specific',
            'path' => 'src/Controller/ProjectController.php',
        ]);
    }

    /**
     * https://github.com/symfony/symfony/blob/7.0/src/Symfony/Component/Routing/RequestContext.php
     * https://symfony.com/doc/current/components/http_foundation.html#component-http-foundation-request 
     * https://symfony.com/doc/current/routing.html#routing-route-parameters 
     */
    #[Route(
        '/condition/{name}',
        name: 'condition',
        condition: "context.getMethod() in ['GET', 'HEAD'] and request.headers.get('User-Agent') matches '/firefox/i'",
        // expressions can also include config parameters:
        // condition: "request.headers.get('User-Agent') matches '%app.allowed_browsers%'"
    )]
    public function conditionSpecificFunction(string $name): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your '.$name.' !, We are getting this with default specific',
            'path' => 'src/Controller/ProjectController.php',
        ]);
    }

    /* #[Route(
        '/movie/{name}',
        name: 'movie_name',
        // expressions can retrieve route parameter values using the "params" variable
        condition: "params['name'] matches '/avenger'"
    )]
    public function matchConditionSpecificFunction(string $name): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your '.$name.' !, We are getting this with default specific',
            'path' => 'src/Controller/ProjectController.php',
        ]);
    }
 */

}
