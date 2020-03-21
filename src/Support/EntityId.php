<?php declare(strict_types=1);

namespace App\Support;

use Doctrine\ORM\Mapping as ORM;

trait EntityId
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }
}
