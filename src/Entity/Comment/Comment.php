<?php

namespace App\Entity\Comment;

use App\Entity\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Repository\Comment\CommentRepository")]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "text")]
    private $body;

    #[ORM\Column(type: "string")]
    private ?string $commentable_type;

    #[ORM\Column(type: "integer")]
    private ?int $commentable_id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private $user;



    public function getCommentableType(): ?string
    {
        return $this->commentable_type;
    }

    public function setCommentableType(string $commentable_type): self
    {
        $this->commentable_type = $commentable_type;

        return $this;
    }

    public function getCommentableId(): ?int
    {
        return $this->commentable_id;
    }

    public function setCommentableId(int $commentable_id): self
    {
        $this->commentable_id = $commentable_id;

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
