<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\MeldungRepository;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class MessageController implements ClassResourceInterface
{
    /**
     * @var MeldungRepository
     */
    private $entityRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(MeldungRepository $entityRepository, SerializerInterface $serializer)
    {
        $this->entityRepository = $entityRepository;
        $this->serializer = $serializer;
    }

    public function cgetAction() : Response
    {
        $request = Request::createFromGlobals();
        $zip = $request->get('zip');
        if (!empty($zip)) {
            $messages = $this->entityRepository->findByZipCode($zip);
        } else {
            $messages = $this->entityRepository->findAll();
        }

        $itemsData = $this->serializer->serialize($messages, 'json', [
            'groups' => [
                'default',
            ]
        ]);

        return Response::create($itemsData);
    }
}
