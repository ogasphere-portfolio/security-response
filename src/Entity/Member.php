<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MemberRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=MemberRepository::class)
 */
class Member
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="integer")
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $job_status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
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
     * @ORM\ManyToMany(targetEntity=Announcement::class, mappedBy="members")
     */
    private $announcements;

    /**
     * @ORM\ManyToMany(targetEntity=SocialNetwork::class, inversedBy="members")
     */
    private $social_network;

    /**
     * @ORM\ManyToMany(targetEntity=Specialization::class, inversedBy="members")
     */
    private $specialization;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="userMember", cascade={"persist", "remove"})
     * 
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Document::class, inversedBy="member")
     */
    private $document;

    public function __construct()
    {
        $this->setUpdatedAt(new \DateTimeImmutable('now'));

        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTimeImmutable('now'));
        }
        if ($this->getUpdatedAt() === null) {
            $this->setUpdatedAt(new \DateTimeImmutable('now'));
        }
        $this->announcements = new ArrayCollection();
        $this->social_network = new ArrayCollection();
        $this->specialization = new ArrayCollection();
        
    }
    public function __toString()
    {
        return $this->firstname;
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getJobStatus(): ?int
    {
        return $this->job_status;
    }

    public function setJobStatus(int $job_status): self
    {
        $this->job_status = $job_status;

        return $this;
    }

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
     * @return Collection|SocialNetwork[]
     */
    public function getSocialNetwork(): Collection
    {
        return $this->social_network;
    }

    public function addSocialNetwork(SocialNetwork $socialNetwork): self
    {
        if (!$this->social_network->contains($socialNetwork)) {
            $this->social_network[] = $socialNetwork;
        }

        return $this;
    }

    public function removeSocialNetwork(SocialNetwork $socialNetwork): self
    {
        $this->social_network->removeElement($socialNetwork);

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

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

    /**
     * @return Collection|Announcement[]
     */
    public function getAnnouncements(): Collection
    {
        return $this->announcements;
    }

    public function addAnnouncement(Announcement $announcement): self
    {
        if (!$this->announcements->contains($announcement)) {
            $this->announcements[] = $announcement;
            $announcement->addMember($this);
        }

        return $this;
    }

    public function removeAnnouncement(Announcement $announcement): self
    {
        if ($this->announcements->removeElement($announcement)) {
            $announcement->removeMember($this);
        }

        return $this;
    }
}
