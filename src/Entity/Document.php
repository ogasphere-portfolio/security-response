<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file_upload;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $file;

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
     */
    private $created_by;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $updated_by;

    /**
     * @ORM\OneToMany(targetEntity=Member::class, mappedBy="document")
     */
    private $member;
    

    /**
     * @ORM\OneToMany(targetEntity=Announcement::class, mappedBy="document")
     */
    private $announcement;

    /**
     * @ORM\ManyToMany(targetEntity=Enterprise::class, inversedBy="documents")
     */
    private $enterprise;
    /**
     * @ORM\ManyToMany(targetEntity=Company::class, inversedBy="documents")
     */
    private $company;

    public function __construct()
    {
        $this->setUpdatedAt(new \DateTimeImmutable('now'));    
        
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTimeImmutable('now'));
        }
        if ($this->getUpdatedAt() === null) {
            $this->setUpdatedAt(new \DateTimeImmutable('now'));
        }
        $this->member = new ArrayCollection();
        $this->enterprise = new ArrayCollection();
        $this->announcement = new ArrayCollection();
        $this->company = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString() 
    {
        return $this->title;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getFileUpload(): ?string
    {
        return $this->file_upload;
    }

    public function setFileUpload(?string $file_upload): self
    {
        $this->file_upload = $file_upload;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file): self
    {
        $this->file = $file;

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
     * @return Collection|Member[]
     */
    public function getMember(): Collection
    {
        return $this->member;
    }

    public function addMember(Member $member): self
    {
        if (!$this->member->contains($member)) {
            $this->member[] = $member;
            $member->setDocument($this);
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->member->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getDocument() === $this) {
                $member->setDocument(null);
            }
        }

        return $this;
    }    

    /**
     * @return Collection|Announcement[]
     */
    public function getAnnouncement(): Collection
    {
        return $this->announcement;
    }

    public function addAnnouncement(Announcement $announcement): self
    {
        if (!$this->announcement->contains($announcement)) {
            $this->announcement[] = $announcement;
            $announcement->setDocument($this);
        }

        return $this;
    }

    public function removeAnnouncement(Announcement $announcement): self
    {
        if ($this->announcement->removeElement($announcement)) {
            // set the owning side to null (unless already changed)
            if ($announcement->getDocument() === $this) {
                $announcement->setDocument(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Enterprise[]
     */
    public function getEnterprise(): Collection
    {
        return $this->enterprise;
    }

    public function addEnterprise(Enterprise $enterprise): self
    {
        if (!$this->enterprise->contains($enterprise)) {
            $this->enterprise[] = $enterprise;
        }

        return $this;
    }

    public function removeEnterprise(Enterprise $enterprise): self
    {
        $this->enterprise->removeElement($enterprise);

        return $this;
    }

    /**
     * @return Collection|Company[]
     */
    public function getCompany(): Collection
    {
        return $this->company;
    }

    public function addCompany(Company $company): self
    {
        if (!$this->company->contains($company)) {
            $this->company[] = $company;
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        $this->company->removeElement($company);

        return $this;
    }
}
