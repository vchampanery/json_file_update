<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ApiService;
use Exception;

class UpdatefileController extends AbstractController
{
    private $apiService;

    /**
     * UpdatefileController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }


    /**
     * @Route("/", name="app_updatefile")
     * @return Response
     */
    public function index(): Response
    {
        $fileName = $_ENV['UPLOAD_FILE'];
        
       
        try {
            if (file_exists($fileName)) {
                $json = "[".file_get_contents('test.json')."]";
                $json = str_replace("]},]", "]}]", str_replace("]}", "]},", $json));
                $jd = json_decode($json);
                $this->apiService->setValid()
                    ->setMessage('Jsonl file parsed Successfully')
                    ->addRespData('orderdata', $jd);
            } else {
                $this->apiService->setMessage('Jsonl file not found');
            }
        } catch (Exception $e) {
            $this->apiService->addRespData('exeception', $e)
                ->setMessage('Something went wronge, contact Admin ');
        }
        return $this->apiService->respond();
    }
}
