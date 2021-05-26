<?php


namespace App\Controller;



use App\Utils\EmployeeService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TimeActivityController
 * @package App\Controller
 * @Route("/api/employees")
 */
class EmployeeController extends AbstractController
{

    private $service;

    public function __construct(EmployeeService $employeeService)
    {
        $this->service = $employeeService;
    }

    /**
     * @return JsonResponse
     * @Route ("/",methods={"GET"})
     *
     */
    public function getEmployees(): JsonResponse
    {
        try {
            $allActivity = $this->service->getEmployeesByUserID();
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
    public function getEmployeeById($id): JsonResponse
    {
        try {
            $activity = $this->service->getEmployeeByUserById($id);
        } catch ( Exception $ex){
            return $this->json(["success" => false, "data" => [], "err" => $ex->getMessage()]);
        }
        return $this->json(["success" => true, "data" => $activity, "err" => ""]);
    }

}


