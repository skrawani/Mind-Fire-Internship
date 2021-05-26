<?php


namespace App\EventListener;
//use App\Controller\QBOController;
use Symfony\Component\HttpKernel\Event\RequestEvent;


class QBOListener
{

    public function __construct()
    {
    }


    public function onKernelRequest(RequestEvent $event)
    {
//        $request = $event->getRequest();
//        var_dump( $request->attributes);
//        var_dump($request->server->get('_controller'));
//        $this->logger($event);
//        if ($this->isAWeekend()) {
//            $event->getRequest()->attributes->set(
//                '_controller',
//                WeekendController::class . '::notAvailable'
//            );
//        }
    }

}