<?php

namespace App\Entity;

use DateTimeImmutable;
use App\Repository\AnnouncementRepository;
use App\Entity\Category;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AnnouncementRepository::class)
 */
class Announcement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Merci de saisir le titre de l'annonce !!!")
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="Merci de saisir la description de l'annonce !!!")
     * @Assert\Length(
     *      min = 4,
     *      max = 300,
     *      minMessage = "Veuillez saisir un minimum de {{ limit }} charactères !!!",
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     */
    private $created_by;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $updated_by;

    /**
     * @ORM\ManyToMany(targetEntity=Certification::class, inversedBy="announcements")
     */
    private $certification;

    /**
     * @ORM\ManyToMany(targetEntity=Member::class, inversedBy="announcements")
     */
    private $members;

    /**
     * @ORM\ManyToMany(targetEntity=Specialization::class, inversedBy="announcements")
     */
    private $specialization;

    /**
     * @ORM\ManyToOne(targetEntity=Document::class, inversedBy="announcement")
     */
    private $document;
     /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="announcement")
     */
    private $category;
      /**
     * @ORM\ManyToOne(targetEntity=Enterprise::class, inversedBy="announcement")
     */
    private $enterprise;

    
    
    public function __construct()
    {
        $this->setUpdatedAt(new \DateTimeImmutable('now'));    
        
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTimeImmutable('now'));
        }
        if ($this->getUpdatedAt() === null) {
            $this->setUpdatedAt(new \DateTimeImmutable('now'));
        }
        $this->certification = new ArrayCollection();
        $this->members = new ArrayCollection();
        $this->specialization = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->created_at = new DateTimeImmutable();
    }

    public function __toString() 
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
        
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->created_by;
    }

    public function setCreatedBy(?string $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    public function getUpdatedBy(): ?string
    {
        return $this->updated_by;
    }

    public function setUpdatedBy(?string $updated_by): self
    {
        $this->updated_by = $updated_by;

        return $this;
    }

    /**
     * @return Collection|Certification[]
     */
    public function getCertification(): Collection
    {
        return $this->certification;
    }

    public function addCertification(Certification $certification): self
    {
        if (!$this->certification->contains($certification)) {
            $this->certification[] = $certification;
        }

        return $this;
    }

    public function removeCertification(Certification $certification): self
    {
        $this->certification->removeElement($certification);

        return $this;
    }

    /**
     * @return Collection|Member[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Member $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
            
        }
        
        return $this;
    }

    public function removeMember(Member $member): self
    {
        $this->members->removeElement($member);
        
        return $this;
    }

    /**
     * @return Collection|Specialization[]
     */
    public function getSpecialization(): Collection
    {
        return $this->specialization;
    }

    public function addSpecialization(Specialization $specialization): self
    {
        if (!$this->specialization->contains($specialization)) {
            $this->specialization[] = $specialization;
        }

        return $this;
    }

    public function removeSpecialization(Specialization $specialization): self
    {
        $this->specialization->removeElement($specialization);

        return $this;
    }

    public function getDocument(): ?Document
    {
        return $this->document;
    }

    public function setDocument(?Document $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getEnterprise(): ?Enterprise
    {
        return $this->enterprise;
    }

    public function setEnterprise(?Enterprise $enterprise): self
    {
        $this->enterprise = $enterprise;

        return $this;
    }

    public function getCategory(): ?ArrayCollection
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
    

    
}
