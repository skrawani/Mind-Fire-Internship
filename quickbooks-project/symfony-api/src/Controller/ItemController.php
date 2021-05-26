<?php


namespace App\Controller;

use App\Utils\ItemService;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class TimeActivityController
 * @package App\Controller
 * @Route("/api/items")
 */
class ItemController extends AbstractController
{
    private $service;

    public function __construct(ItemService $itemService)
    {
        $this->service = $itemService;
    }

    /**
     * @return JsonResponse
     * @Route ("/",methods={"GET"})
     *
     */
    public function  getItems(): JsonResponse
    {
        try {
            $items = $this->service->getItemsByUserID();
        } catch ( Exception $ex){
            return $this->json(["success" => false, "data" => [], "err" => $ex->getMessage()]);
        }
        return $this->json(["success" => true, "data" => $items, "err" => ""]);
    }

    /**
     * @param $id
     * @return JsonResponse
     * @Route ("/{id}",methods={"GET"})
     */
    public function getItemById($id): JsonResponse
    {
        try {
            $item = $this->service->getItemsByUserById($id);
        } catch ( Exception $ex){
            return $this->json(["success" => false, "data" => [], "err" => $ex->getMessage()]);
        }
        return $this->json(["success" => true, "data" => $item, "err" => ""]);
    }

}