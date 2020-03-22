<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\CountyRepository;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CountyController implements ClassResourceInterface
{
    /**
     * @var CountyRepository
     */
    private $entityRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(CountyRepository $entityRepository, SerializerInterface $serializer)
    {
        $this->entityRepository = $entityRepository;
        $this->serializer = $serializer;
    }

    public function cgetAction(): Response
    {
        $items = $this->entityRepository->findAll();
        $itemsData = $this->serializer->serialize($items, 'json', [
            'groups' => [
                'default',
            ]
        ]);

        return Response::create($itemsData);
    }

    public function getAction($id): Response
    {
        $item = $this->entityRepository->find($id);
        $itemData = $this->serializer->serialize($item, 'json', [
            'groups' => [
                'default',
                'county.country',
                'county.state',
                'state.country',
            ]
        ]);

        return Response::create($itemData);
    }
}
