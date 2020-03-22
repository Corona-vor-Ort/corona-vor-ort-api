<?php declare(strict_types=1);

namespace App\Support;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;

trait EntityId
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @Groups("default")
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $id;

    public function getId(): string
    {
        return (string) $this->id;
    }
}
