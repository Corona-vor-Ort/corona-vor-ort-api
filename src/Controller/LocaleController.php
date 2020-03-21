<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\LocaleRepository;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class LocaleController implements ClassResourceInterface
{
    /**
     * @var LocaleRepository
     */
    private $localeRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(LocaleRepository $localeRepository, SerializerInterface $serializer)
    {
        $this->localeRepository = $localeRepository;
        $this->serializer = $serializer;
    }

    public function cgetAction(): Response
    {
        $locales = $this->localeRepository->findAll();
        $localesData = $this->serializer->serialize($locales, 'json');

        return Response::create($localesData);
    }

    public function getAction($id): Response
    {
        $locale = $this->localeRepository->find($id);
        $localeData = $this->serializer->serialize($locale, 'json');

        return Response::create($localeData);
    }
}
