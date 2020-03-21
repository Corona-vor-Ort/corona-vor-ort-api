<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocaleRepository")
 */
class Locale
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $iso;

    public function getIso(): ?string
    {
        return $this->iso;
    }

    public function setIso(string $iso): self
    {
        $this->iso = $iso;

        return $this;
    }
}
