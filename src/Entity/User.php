<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
   /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */

    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $promo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", inversedBy="users")
     */
    private $user_event;

    public function __construct()
    {
        $this->user_event = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPromo(): ?string
    {
        return $this->promo;
    }

    public function setPromo(string $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getUserEvent(): Collection
    {
        return $this->user_event;
    }

    public function addUserEvent(Event $userEvent): self
    {
        if (!$this->user_event->contains($userEvent)) {
            $this->user_event[] = $userEvent;
        }

        return $this;
    }

    public function removeUserEvent(Event $userEvent): self
    {
        if ($this->user_event->contains($userEvent)) {
            $this->user_event->removeElement($userEvent);
        }

        return $this;
    }
}
