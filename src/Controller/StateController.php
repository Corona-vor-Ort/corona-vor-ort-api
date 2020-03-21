<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\StateRepository;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class StateController implements ClassResourceInterface
{
    /**
     * @var StateRepository
     */
    private $entityRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(StateRepository $entityRepository, SerializerInterface $serializer)
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
                'state.country',
                'state.translations',
                'stateTranslation.locale',
                'country.translations',
                'countryTranslation.locale',
            ]
        ]);

        return Response::create($itemData);
    }
}
