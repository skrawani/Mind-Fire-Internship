<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{

     /**
      * @Route("/", name="blog_list")
      */
     public function list( Request  $request, $page= 1): JsonResponse
     {
         $limit = $request->get('limit', 10);
         $repository = $this->getDoctrine()->getRepository(BlogPost::class);
         $items = $repository->findAll();

         return $this->json(
             [
                 'page' => $page,
                 'limit' =>$limit,
                 'data'  =>  array_map(function ( BlogPost  $item) {
                        return $this->generateUrl('blog_by_slug', ['slug' => $item->getSlug()]);
                    }, $items)
             ]
         );
     }

    /**
     * @Route("/post/{id}", name="blog_by_id", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function post(BlogPost $post): JsonResponse
    {
        return $this->json( $post );
    }

    /**
     * @Route("/post/{slug}", name="blog_by_slug", methods={"GET"})
     * @ParamConverter("post", options={"mapping" : { "slug"  : "slug" } })
     */
    public function postBySlug(BlogPost $post): JsonResponse
    {
        return $this->json( $post );
    }
    /**
     * @Route("/post/add", name="blog_add" , methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $serializer = $this->get('serializer');
        $blogPost = $serializer->deserialize($request->getContent(), BlogPost::class, 'json');
        $em = $this->getDoctrine()->getManager();
        $em->persist($blogPost);
        $em->flush();
        return $this->json($blogPost);
    }

    /**
     * @Route("/post/{id}", name="blog_delete", methods={"DELETE"})
     * @param BlogPost $post
     * @return JsonResponse
     */
    public function  delete(BlogPost $post): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
