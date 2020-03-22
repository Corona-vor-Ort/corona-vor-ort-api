<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MeldungKeywordRepository")
 */
class MeldungKeyword
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @Groups("meldungKeyword.meldungs")
     * @ORM\ManyToMany(targetEntity="App\Entity\Meldung", inversedBy="keywords")
     */
    private $meldungs;

    public function __construct()
    {
        $this->meldungs = new ArrayCollection();
    }

    /**
     * @return Collection|Meldung[]
     */
    public function getMeldungs(): Collection
    {
        return $this->meldungs;
    }

    public function addMeldung(Meldung $meldung): self
    {
        if (!$this->meldungs->contains($meldung)) {
            $this->meldungs[] = $meldung;
        }

        return $this;
    }

    public function removeMeldung(Meldung $meldung): self
    {
        if ($this->meldungs->contains($meldung)) {
            $this->meldungs->removeElement($meldung);
        }

        return $this;
    }
}
