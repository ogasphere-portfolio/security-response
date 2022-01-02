<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $ForgotPasswordToken;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?\DateTimeImmutable $ForgotPasswordTokenRequestedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?\DateTimeImmutable $ForgotPasswordTokenMustBeVerifiedBefore;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?\DateTimeImmutable $ForgotPasswordTokenVerifiedAt;

    /**
     * @ORM\OneToOne(targetEntity=Member::class, inversedBy="user", cascade={"persist", "remove"})
     */
    private $userMember;

    /**
     * @ORM\OneToOne(targetEntity=Enterprise::class, inversedBy="user", cascade={"persist", "remove"})
     */
    private $userEnterprise;
    /**
     * @ORM\OneToOne(targetEntity=Company::class, inversedBy="user", cascade={"persist", "remove"})
     */
    private $userCompany;

    /**
     * @ORM\OneToMany(targetEntity=Answer::class, mappedBy="user")
     */
    private $answers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;



    public function __construct()
    {
        $this->setUpdatedAt(new \DateTimeImmutable('now'));

        if ($this->getUpdatedAt() === null) {
            $this->setUpdatedAt(new \DateTimeImmutable('now'));
        }
        $this->answers = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }


    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }


    public function getUsername(): string
    {
        return (string) $this->username;
    }



    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function setUpdatedBy(string $updated_by): self
    {
        $this->updated_by = $updated_by;

        return $this;
    }

    public function getEnterprise(): ?Enterprise
    {
        return $this->enterprise;
    }

    public function setEnterprise(?Enterprise $enterprise): self
    {
        // unset the owning side of the relation if necessary
        if ($enterprise === null && $this->enterprise !== null) {
            $this->enterprise->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($enterprise !== null && $enterprise->getUser() !== $this) {
            $enterprise->setUser($this);
        }

        $this->enterprise = $enterprise;

        return $this;
    }



    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(Member $member): self
    {
        // unset the owning side of the relation if necessary
        if ($member === null && $this->member !== null) {
            $this->member->setUser(null);
        }
        // set the owning side of the relation if necessary
        if ($member->getUser() !== $this) {
            $member->setUser($this);
        }

        $this->member = $member;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getUserMember(): ?Member
    {
        return $this->userMember;
    }

    public function setUserMember(?Member $userMember): self
    {
        $this->userMember = $userMember;

        return $this;
    }

    public function getUserEnterprise(): ?Enterprise
    {
        return $this->userEnterprise;
    }

    public function setUserEnterprise(?Enterprise $userEnterprise): self
    {
        $this->userEnterprise = $userEnterprise;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }
    public function getUserCompany(): ?Company
    {
        return $this->userCompany;
    }

    public function setUserCompany(?Company $userCompany): self
    {
        $this->userCompany = $userCompany;

        return $this;
    }

    /**
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setUser($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getUser() === $this) {
                $answer->setUser(null);
            }
        }

        return $this;
    }



    /**
     * Get the value of ForgotPasswordToken
     */
    public function getForgotPasswordToken(): ?string
    {
        return $this->ForgotPasswordToken;
    }

    /**
     * Set the value of ForgotPasswordToken
     *
     * @return  self
     */
    public function setForgotPasswordToken(?string $ForgotPasswordToken): self
    {
        $this->ForgotPasswordToken = $ForgotPasswordToken;

        return $this;
    }

    /**
     * Get the value of ForgotPasswordTokenRequestedAt
     */
    public function getForgotPasswordTokenRequestedAt(): ?\DateTimeImmutable
    {
        return $this->ForgotPasswordTokenRequestedAt;
    }

    /**
     * Set the value of ForgotPasswordTokenRequestedAt
     *
     * @return  self
     */
    public function setForgotPasswordTokenRequestedAt(?\DateTimeImmutable $ForgotPasswordTokenRequestedAt)
    {
        $this->ForgotPasswordTokenRequestedAt = $ForgotPasswordTokenRequestedAt;

        return $this;
    }

    /**
     * Get the value of ForgotPasswordTokenMustBeVerifiedBefore
     */
    public function getForgotPasswordTokenMustBeVerifiedBefore(): ?\DateTimeImmutable
    {
        return $this->ForgotPasswordTokenMustBeVerifiedBefore;
    }

    /**
     * Set the value of ForgotPasswordTokenMustBeVerifiedBefore
     *
     * @return  self
     */
    public function setForgotPasswordTokenMustBeVerifiedBefore(?\DateTimeImmutable $ForgotPasswordTokenMustBeVerifiedBefore)
    {
        $this->ForgotPasswordTokenMustBeVerifiedBefore = $ForgotPasswordTokenMustBeVerifiedBefore;

        return $this;
    }

    /**
     * Get the value of ForgotPasswordTokenVerifiedAt
     */
    public function getForgotPasswordTokenVerifiedAt(): ?\DateTimeImmutable
    {
        return $this->ForgotPasswordTokenVerifiedAt;
    }

    /**
     * Set the value of ForgotPasswordTokenVerifiedAt
     *
     * @return  self
     */
    public function setForgotPasswordTokenVerifiedAt(?\DateTimeImmutable $ForgotPasswordTokenVerifiedAt)
    {
        $this->ForgotPasswordTokenVerifiedAt = $ForgotPasswordTokenVerifiedAt;

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
}
