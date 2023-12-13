<?php

namespace App\Controller;

use App\Entity\Module;
use Doctrine\ORM\EntityManagerInterface;
use LDAP\Result;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ModuleController extends AbstractController
{
    
    #[Route('/module', name: 'app_module')]
    public function index(): Response
    {
        return $this->render('module/index.html.twig', [
            'controller_name' => 'ModuleController',
        ]);
    }

    /**
     * EntityManagerInterface is helping to save and fetch the data objects from db.
     */
    #[Route('/createmodule', name:'create_module')]
    public function createModule(EntityManagerInterface $entityManager): Response
    {
        $module = new Module();
        $module->setName('Physics');
        $module->setCode('phy');
        //doctrine will eventually save the procuct, manage the object 
        $entityManager->persist($module);
        //to execute the query, it will decide whether it is update or insert 
        $entityManager->flush();
        return new Response('Saved a new module with id '.$module->getId());
    }

    #[Route('/create_mistake', name:'create_mistake')]
    public function createMistake(ValidatorInterface $validator): Response
    {
        $module = new Module();
        $module->setName('null');
        $module->setCode(166);
        $errors = $validator->validate($module);
        if (count($errors)>0) {
            return new Response((string)$errors, 400);
        }
    }

    #[Route('/getmodule/{id}', name:'fetch_data')]
    public function show(EntityManagerInterface $entityManager, int $id): Response 
    {
        //We can think a repository as a PHP class. 
        $module = $entityManager->getRepository(Module::class)->find($id);

        if (!$module) {
            throw $this->createNotFoundException(
                'No Module is found in the ID'
            );
        }

        return new Response('Got a module under the name '.$module->getName());
    }
}
