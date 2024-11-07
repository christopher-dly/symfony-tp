<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\Email(message: "L'adresse email n'est pas valide.")]
    private ?string $email = null;

    #[ORM\Column(type: 'string')]
    private ?string $password = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $pseudo = null;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $avatar = 'img/download.png';

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $emploi = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Assert\Regex(pattern: "/^\+?[0-9]*$/", message: "Le numéro de téléphone n'est pas valide.")]
    private ?string $telephone = null;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Assert\Url(message: "L'URL du site web n'est pas valide.")]
    private ?string $siteURL = null;

    public function eraseCredentials(): void
    {
        // Cette méthode peut être utilisée pour effacer les données sensibles
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
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
     * Get the value of roles
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get the value of pseudo
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of avatar
     */
    public function getAvatar()
    {
        return $this->avatar ?? 'img/download.png';
    }

    /**
     * Set the value of avatar
     *
     * @return  self
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get the value of emploi
     */
    public function getEmploi()
    {
        return $this->emploi;
    }

    /**
     * Set the value of emploi
     *
     * @return  self
     */
    public function setEmploi($emploi)
    {
        $this->emploi = $emploi;

        return $this;
    }

    /**
     * Get the value of telephone
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @return  self
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get the value of siteURL
     */
    public function getSiteURL()
    {
        return $this->siteURL;
    }

    /**
     * Set the value of siteURL
     *
     * @return  self
     */
    public function setSiteURL($siteURL)
    {
        $this->siteURL = $siteURL;

        return $this;
    }
}
