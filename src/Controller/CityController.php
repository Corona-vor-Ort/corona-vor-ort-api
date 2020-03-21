<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\CityRepository;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CityController implements ClassResourceInterface
{
    /**
     * @var CityRepository
     */
    private $entityRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(CityRepository $entityRepository, SerializerInterface $serializer)
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
                'city.translations',
                'city.translations.locale',
                'city.zipCodes',
            ]
        ]);

        return Response::create($itemData);
    }
}
