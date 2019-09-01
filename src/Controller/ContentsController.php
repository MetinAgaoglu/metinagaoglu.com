<?php

namespace App\Controller;

use App\Entity\Contents;

use App\Repository\ContentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContentsController extends AbstractController
{
	/**
	 * @Route("/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods={"GET"}, name="contents_index")
	 * @param int $page
	 * @param ContentsRepository $contentsRepository
	 * @return Response
	 */
    public function index(int $page = 0,ContentsRepository $contentsRepository): Response
    {

		$latestPosts = $contentsRepository->findLatest($page);
        return $this->render('contents/index.html.twig', [
            'paginator' => $latestPosts,
        ]);
    }

	/**
	 * @Route("/detail/{contentId}", name="contents_show", methods={"GET"})
	 * @param Contents $content
	 * @return Response
	 */
    public function show(Contents $content): Response
    {
        return $this->render('contents/show.html.twig', [
            'content' => $content,
        ]);
    }

}
