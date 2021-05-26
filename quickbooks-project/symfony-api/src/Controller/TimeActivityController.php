<?php


namespace App\Controller;



use App\Entity\TimeActivity;
use Exception;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Utils\TimeActivityService;
/**
 * Class TimeActivityController
 * @package App\Controller
 * @Route("/api/time_activities")
 */
class TimeActivityController extends AbstractController
{

    private $service;

    public function __construct(TimeActivityService $activityService)
    {
        $this->service = $activityService;
    }

    /**
     * @return JsonResponse
     * @Route ("/",methods={"GET"})
     */
    public function  getTimeActivities(): JsonResponse
    {
        try {
            $allActivity = $this->service->getTimeActivitiesByUserID();
        } catch ( Exception $ex){
            return $this->json(["success" => false, "data" => [], "err" => $ex->getMessage()]);
        }
        return $this->json(["success" => true, "data" => $allActivity, "err" => ""]);
    }

    /**
     * @param $id
     * @return JsonResponse
     * @Route ("/{id}",methods={"GET"})
     */
    public function getTimeActivityById($id): JsonResponse
    {
        try {
            $activity = $this->service->getTimeActivitiesById($id);
        } catch ( Exception $ex){
            return $this->json(["success" => false, "data" => [], "err" => $ex->getMessage()]);
        }
        return $this->json(["success" => true, "data" => $activity, "err" => ""]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route ("/",methods={"POST"})
     */
    public function setTimeActivity(Request $request): JsonResponse
    {
        try {
            $data = $request->toArray();
            $this->service->setTimeActivity($data);
            return $this->json(["success" => true, "err"=>""] );
        } catch (Exception $ex) {
            return $this->json(["success" => false, "err" => $ex]);
        }
    }


}


