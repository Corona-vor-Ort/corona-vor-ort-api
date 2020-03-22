<?php declare(strict_types=1);

namespace App\Support;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait EntityTimestamps
{
    /**
     * @Groups("detail")
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @Groups("detail")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
