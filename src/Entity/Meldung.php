<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MeldungRepository")
 */
class Meldung
{
    /**
     * @Groups("default")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("default"))
     * @ORM\Column(type="string", length=63, nullable=true)
     */
    private $bbk_identifier;

    /**
     * @Groups("default")
     * @ORM\Column(type="datetime")
     */
    private $sent;

    /**
     * @Groups("default")
     * @ORM\Column(type="string", length=31)
     */
    private $messageType;

    /**
     * @Groups("default")
     * @ORM\Column(type="string", length=511)
     */
    private $headline;

    /**
     * @Groups("default")
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Groups("default")
     * @ORM\Column(type="text", nullable=true)
     */
    private $instruction;

    /**
     * @Groups("default")
     * @ORM\Column(type="string", length=511, nullable=true)
     */
    private $more_information_link;

    /**
     * @Groups("default")
     * @ORM\Column(type="text", nullable=true)
     */
    private $contact;

    /**
     * @Groups("default")
     * @ORM\Column(type="text")
     */
    private $area_description;

    /**
     * @Groups("default")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $severity;

    /**
     * @Groups("default")
     * @ORM\Column(type="string", length=7)
     */
    private $language;

    /**
     * @Groups("default")
     * @ORM\Column(type="string", length=127, nullable=true)
     */
    private $meldende_stelle;

    /**
     * @Groups("meldung.linkCounties")
     * @ORM\ManyToMany(targetEntity="App\Entity\County", mappedBy="link_meldungen")
     */
    private $link_counties;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MeldungLink", mappedBy="meldung", orphanRemoval=true)
     */
    private $meldungLinks;

    /**
     * @Groups("meldung.keywords")
     * @ORM\ManyToMany(targetEntity="App\Entity\MeldungKeyword", mappedBy="meldungs")
     */
    private $keywords;

    public function __construct()
    {
        $this->link_counties = new ArrayCollection();
        $this->meldungLinks = new ArrayCollection();
        $this->keywords = new ArrayCollection();
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

    /**
     * @Groups("default")
     * @return Collection|MeldungLink[]
     */
    public function getMeldungLinks(): Collection
    {
        return $this->meldungLinks;
    }

    public function addMeldungLink(MeldungLink $meldungLink): self
    {
        if (!$this->meldungLinks->contains($meldungLink)) {
            $this->meldungLinks[] = $meldungLink;
            $meldungLink->setMeldung($this);
        }

        return $this;
    }

    public function removeMeldungLink(MeldungLink $meldungLink): self
    {
        if ($this->meldungLinks->contains($meldungLink)) {
            $this->meldungLinks->removeElement($meldungLink);
            // set the owning side to null (unless already changed)
            if ($meldungLink->getMeldung() === $this) {
                $meldungLink->setMeldung(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MeldungKeyword[]
     */
    public function getKeywords(): Collection
    {
        return $this->keywords;
    }

    public function addKeyword(MeldungKeyword $keyword): self
    {
        if (!$this->keywords->contains($keyword)) {
            $this->keywords[] = $keyword;
            $keyword->addMeldung($this);
        }

        return $this;
    }

    public function removeKeyword(MeldungKeyword $keyword): self
    {
        if ($this->keywords->contains($keyword)) {
            $this->keywords->removeElement($keyword);
            $keyword->removeMeldung($this);
        }

        return $this;
    }
}
