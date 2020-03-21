<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\LocaleRepository;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class LocaleController implements ClassResourceInterface
{
    /**
     * @var LocaleRepository
     */
    private $localeRepository;

    public function __construct(LocaleRepository $localeRepository)
    {
        $this->localeRepository = $localeRepository;
    }

    public function cgetAction()
    {
        return JsonResponse::create($this->localeRepository->findAll());
    }

    public function getAction($id)
    {
        return JsonResponse::create($this->localeRepository->find($id));
    }
}
