<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    private array $authors;

    public function __construct()
    {
        // Initialize the authors list
        $this->authors = [
            ['id' => 1, 'authorName' => 'Victor Hugo', 'nbrBooks' => 40, 'picture' => '/images/Victor_Hugo.jpg'],
            ['id' => 2, 'authorName' => 'Taha Hussein', 'nbrBooks' => 5, 'picture' => '/images/Taha_Hussein.jpg'],
        ];
    }

    #[Route('/author', name: 'show_author')]
    public function showAuthor(): Response
    {
        $authorName = "Victor Hugo";
        $authorEmail = "victorhugo@gmail.com";

        return $this->render('author/showAuthor.html.twig', [
            'authorName' => $authorName,
            'authorEmail' => $authorEmail,
        ]);
    }

    #[Route('/authors/', name: 'show_authors')]
    public function showAuthors(): Response
    {
        return $this->render('author/showAuthors.html.twig', [
            'authors' => $this->authors,  // Use the class property for authors
        ]);
    }

    #[Route('/author/details/{id}/', name: 'author_details')]
    public function authorDetails(int $id): Response
    {
        // Find the author by ID
        $author = null;
        foreach ($this->authors as $a) {
            if ($a['id'] === $id) {
                $author = $a;
                break;
            }
        }

        // If author is not found, you can throw a 404 error or handle it as desired
        if (!$author) {
            throw $this->createNotFoundException('Author not found.');
        }

        return $this->render('author/show.html.twig', [
            'author' => $author,
        ]);
    }
}
