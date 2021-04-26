<?php

namespace App\Controller;

use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
    /**
     * @Route("/person", name="person")
     */
    public function index()
    {
        return $this->render('person/index.html.twig');
    }

    /**
     * @Route("/API/person/{id}", name="api_person", methods={"GET"})
     */
    public function getPerson($id): Response
    {
        $person = $this->getDoctrine()->getRepository(Person::class)->find($id);
        return $this->json([
            'message' => 'accessing person',
            'person' => $person,
        ]);
    }

    /**
     * @Route("/API/persons", name="api_persons", methods={"GET"})
     */
    public function getPersons(): Response
    {
        $persons = $this->getDoctrine()->getRepository(Person::class)->findAll();
        return $this->json([
            'message' => 'accessing persons',
            'persons' => $persons,
        ]);
    }

    /**
     * @Route("/API/person/add", name="api_person_add", methods={"POST"})
     */
    public function addPerson(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);
        $entityManager->persist($person);

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));
    
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();
    
                return $this->json([
                    'message' => 'person added succesfully',
                    'name' => $form->getName(),
                    'firstname' => $form->getFirstName(),
                    'birthdate' => $form->getBirthDate(),
                ]);
            }
        }

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PersonController.php',
        ]);
    }
}
