<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MeldungRepository")
 */
class Meldung
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=63, nullable=true)
     */
    private $bbk_identifier;

    /**
     * @ORM\Column(type="datetime")
     */
    private $sent;

    /**
     * @ORM\Column(type="string", length=31)
     */
    private $messageType;

    /**
     * @ORM\Column(type="string", length=511)
     */
    private $headline;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $instruction;

    /**
     * @ORM\Column(type="string", length=511, nullable=true)
     */
    private $more_information_link;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contact;

    /**
     * @ORM\Column(type="text")
     */
    private $area_description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $severity;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=127, nullable=true)
     */
    private $meldende_stelle;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\County", mappedBy="link_meldungen")
     */
    private $link_counties;

    public function __construct()
    {
        $this->link_counties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
	}

    public function getBbkIdentifier(): ?string
    {
        return $this->bbk_identifier;
    }

    public function setBbkIdentifier(?string $bbk_identifier): self
    {
        $this->bbk_identifier = $bbk_identifier;

        return $this;
    }

    public function getSent(): ?\DateTimeInterface
    {
        return $this->sent;
    }

    public function setSent(\DateTimeInterface $sent): self
    {
        $this->sent = $sent;

        return $this;
    }

    public function getMessageType(): ?string
    {
        return $this->messageType;
    }

    public function setMessageType(string $messageType): self
    {
        $this->messageType = $messageType;

        return $this;
    }

    public function getHeadline(): ?string
    {
        return $this->headline;
    }

    public function setHeadline(string $headline): self
    {
        $this->headline = $headline;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    public function setInstruction(?string $instruction): self
    {
        $this->instruction = $instruction;

        return $this;
    }

    public function getMoreInformationLink(): ?string
    {
        return $this->more_information_link;
    }

    public function setMoreInformationLink(?string $more_information_link): self
    {
        $this->more_information_link = $more_information_link;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getAreaDescription(): ?string
    {
        return $this->area_description;
    }

    public function setAreaDescription(string $area_description): self
    {
        $this->area_description = $area_description;

        return $this;
    }

    public function getSeverity(): ?int
    {
        return $this->severity;
    }

    public function setSeverity(?int $severity): self
    {
        $this->severity = $severity;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getMeldendeStelle(): ?string
    {
        return $this->meldende_stelle;
    }

    public function setMeldendeStelle(?string $meldende_stelle): self
    {
        $this->meldende_stelle = $meldende_stelle;

        return $this;
    }

    /**
     * @return Collection|County[]
     */
    public function getLinkCounties(): Collection
    {
        return $this->link_counties;
    }

    public function addLinkCounty(County $linkCounty): self
    {
        if (!$this->link_counties->contains($linkCounty)) {
            $this->link_counties[] = $linkCounty;
            $linkCounty->addLinkMeldungen($this);
        }

        return $this;
    }

    public function removeLinkCounty(County $linkCounty): self
    {
        if ($this->link_counties->contains($linkCounty)) {
            $this->link_counties->removeElement($linkCounty);
            $linkCounty->removeLinkMeldungen($this);
        }

        return $this;
    }
}
