<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\CountryRepository;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CountryController implements ClassResourceInterface
{
    /**
     * @var CountryRepository
     */
    private $countryRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(CountryRepository $countryRepository, SerializerInterface $serializer)
    {
        $this->countryRepository = $countryRepository;
        $this->serializer = $serializer;
    }

    public function cgetAction(): Response
    {
        $items = $this->countryRepository->findAll();
        $itemsData = $this->serializer->serialize($items, 'json', [
            'groups' => [
                'default',
            ]
        ]);

        return Response::create($itemsData);
    }

    public function getAction($id): Response
    {
        $item = $this->countryRepository->find($id);
        $itemData = $this->serializer->serialize($item, 'json', [
            'groups' => [
                'default',
                'country.translations',
                'countryTranslation.locale',
                'country.states',
            ]
        ]);

        return Response::create($itemData);
    }
}
