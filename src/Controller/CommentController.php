<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * Displaying all comments
     */
    #[Route('/', name: 'app_comment')]
    public function index(CommentRepository $commentRepository): Response
    {   
        $comments = $commentRepository->findAll();

        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
        ]);
    }

    /**
     * Add a comment
     */
    #[Route('/comment/new', name: 'app_comment_new')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $comment = new Comment();

        $comment->setTitle('');
        $comment->setContent('');
        $comment->setAuthor('');
        $comment->setIpAddress($request->getClientIp());
        $comment->setPublishedAt(new \DateTimeImmutable('now'));

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('app_comment');
        }
        
        return $this->render('comment/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
