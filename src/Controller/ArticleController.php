<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ArticleController
 * @package App\Controller
 * @Route ("/article")
 */

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article", methods={"GET"})
     * @param ArticleRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ArticleRepository $repository)
    {
        $article = $repository->findLatest(3);
        return $this->render('article/index.html.twig', [
            'articles' => $article
        ]);
    }

    /**
     * @Route("/new", name="article_new", methods={"GET", "POST"})
     * @param EntityManager $manager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(EntityManager $manager, Request $request)
    {
        $form = $this->createForm(ArticleType::class, new Article());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $article = $form->getData();
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('article');
        }

        return $this->render('article/index.html.twig', [
            'create_form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/{id}", name="article_show", methods={"GET"})
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Article $article)
    {
        $form = $this->createForm( FormType::class, null,[
            'method' => 'DELETE',
            'action' => $this->generateUrl('article_delete', ['id' => $article->getId()])
        ]);

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'delete_form' => $form->createView()
        ]);
    }


    /**
     * @Route ("/{id}/edit", name="article_edit", methods={"GET", "PUT"})
     * @param Article $article
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function edit(Article $article, EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $article->setDerMaj(new \DateTime());
            $manager->flush();
            return $this->redirectToRoute('article_show', ['id' => $article->getId()]);
        }
        return $this->render('article/edit.html.twig', [
            'edit_form' => $form->createView()
        ]);
    }


    /**
     * @Route ("/{id}/delete", name="article_delete", methods={"DELETE"})
     * @param Article $article
     * @param EntityManagerInterface $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Article $article, EntityManagerInterface $manager)
    {
        $manager->remove($article);
        $manager->flush();
        return $this->redirectToRoute('article');
    }
}
