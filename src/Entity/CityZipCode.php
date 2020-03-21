<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityZipCodeRepository")
 */
class CityZipCode
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @Groups("default")
     * @ORM\Column(type="string", length=10)
     */
    private $code;

    /**
     * @Groups("default")
     * @ORM\Column(type="uuid")
     */
    private $city_id;

    /**
     * @Groups("cityZipCode.city")
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="zipCodes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCityId()
    {
        return $this->city_id;
    }

    public function setCityId($city_id): self
    {
        $this->city_id = $city_id;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }
}
