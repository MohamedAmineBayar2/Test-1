<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/crud/book')]

class CrudBookController extends AbstractController
{
    #[Route('/list', name: 'app_crud_book')]
    public function listBook(BookRepository $repository): Response
    {

        $books=$repository->findAll();
        return $this->render('crud_author/listBook.html.twig',['books'=>$books]);
    }
    #[Route('/book/recherche/{title}', name: 'book_search')]
    public function searchByTitle(string $title,BookRepository $repository): Response
    {
        $book=$repository->find($title);

        return $this->render('crud_author/show.html.twig', [
            'book' => $book,
        ]);
    }

}
