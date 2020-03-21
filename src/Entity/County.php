<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountyRepository")
 */
class County
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @Groups("default")
     * @ORM\Column(type="uuid")
     */
    private $country_id;

    /**
     * @Groups("default")
     * @ORM\Column(type="uuid", nullable=true)
     */
    private $state_id;

    /**
     * @Groups("county.country")
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="counties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @Groups("county.state")
     * @ORM\ManyToOne(targetEntity="App\Entity\State", inversedBy="counties")
     */
    private $state;

    public function getCountryId()
    {
        return $this->country_id;
    }

    public function setCountryId($country_id): self
    {
        $this->country_id = $country_id;

        return $this;
    }

    public function getStateId()
    {
        return $this->state_id;
    }

    public function setStateId($state_id): self
    {
        $this->state_id = $state_id;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

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
}
