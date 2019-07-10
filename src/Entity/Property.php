<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 * @UniqueEntity("title")
 * @Vich\Uploadable
 */
class Property
{
    const TYPE = [
        0 => 'Football',
        1 => 'Basketball',
        2 => 'Handball',
        3 => 'Tennis',
        4 => 'Hockey',
        5 => 'Concert',
        6 => 'Privé'
    ] ;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */

    private $filename;

    /**
     * var File|null
     * @Assert\Image(
     *     mimeTypes="image/jpeg"
     * )
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
     */

    private $imageFile;


    /**
     * @Assert\Length(min=5, max=255)
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $start;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $destination;

    /**
     * @Assert\Regex("/^[0-9]/")
     * @ORM\Column(type="integer")
     */
    private $seats;

    /**
     * @Assert\Regex("/^[0-9]/")
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @Assert\Regex("/^[0-9]/")
     * @ORM\Column(type="integer")
     */
    private $time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $participation = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->options = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $full = false;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Option", inversedBy="properties")
     */
    private $options;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->title);
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStart(): ?string
    {
        return $this->start;
    }

    public function setStart(string $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getSeats(): ?int
    {
        return $this->seats;
    }

    public function setSeats(int $seats): self
    {
        $this->seats = $seats;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getFormattedPrice(): string
    {
        return number_format($this->price, 0, '', ' ');
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getEventType(): string
    {
        return self::TYPE[$this->type];
    }

    public function getParticipation(): ?bool
    {
        return $this->participation;
    }

    public function setParticipation(bool $participation): self
    {
        $this->participation = $participation;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getFull(): ?bool
    {
        return $this->full;
    }

    public function setFull(bool $full): self
    {
        $this->full = $full;

        return $this;
    }

    /**
     * @return Collection|Option[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->addProperty($this);
        }

        return $this;
    }

    public function removeOption(Option $option): self
    {
        if ($this->options->contains($option)) {
            $this->options->removeElement($option);
            $option->removeProperty($this);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return Property
     */
    public function setFilename(?string $filename): Property
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param mixed $imageFile
     * @return Property
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     * @return Property
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }




}
