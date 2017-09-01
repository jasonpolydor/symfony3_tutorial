<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class LuckyController{
    /**
     * @Route("/lucky/number")
     */
    public function numberAction(){
        $data=array('lucky_number' => rand(0,100));
        
        return new JsonResponse($data);
    }
}