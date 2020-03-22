<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StateTranslationRepository")
 */
class StateTranslation
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @Groups("default")
     * @ORM\Column(type="uuid")
     */
    private $state_id;

    /**
     * @Groups("default")
     * @ORM\Column(type="uuid")
     */
    private $locale_id;

    /**
     * @Groups("stateTranslation.state")
     * @ORM\ManyToOne(targetEntity="App\Entity\State", inversedBy="translations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $state;

    /**
     * @Groups("default")
     * @ORM\ManyToOne(targetEntity="App\Entity\Locale", inversedBy="stateTranslations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $locale;

    /**
     * @Groups("default")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getStateId()
    {
        return $this->state_id;
    }

    public function setStateId($state_id): self
    {
        $this->state_id = $state_id;

        return $this;
    }

    public function getLocaleId()
    {
        return $this->locale_id;
    }

    public function setLocaleId($locale_id): self
    {
        $this->locale_id = $locale_id;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getLocale(): ?Locale
    {
        return $this->locale;
    }

    public function setLocale(?Locale $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
