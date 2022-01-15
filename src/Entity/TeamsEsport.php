<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TeamsEsportRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;
use Gedmo\Mapping\Annotation as Gedmo;
#[ORM\Entity(repositoryClass: TeamsEsportRepository::class)]
#[ApiResource(
    denormalizationContext: ["groups" => ["write:TeamsEsport"]],
    #mercure: true,
    normalizationContext: ["groups" => ["read:TeamsEsport"]],
)]
class TeamsEsport
{
    #[ApiProperty(identifier: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read:TeamsEsport"])]

    private $id;
    #[Groups(["read:TeamsEsport","write:TeamsEsport"])]
    #[ORM\Column(type: 'string', length: 255)]
    private $name;
    #[Groups(["read:TeamsEsport","write:TeamsEsport"])]
    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[Groups(["read:TeamsEsport"])]
    #[ApiProperty(identifier: true)]

    #[ORM\Column(type: 'string', length: 255)]

    /**
     * @Gedmo\Slug(fields={"name"})
     */

    private $slug;
    #[Groups(["read:TeamsEsport"])]
    #[ORM\Column(type: 'datetime')]
    private $createdAt;
    #[ORM\Column(type: 'string', length: 255)]
    private $token;
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->token = Uuid::uuid4();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }
}