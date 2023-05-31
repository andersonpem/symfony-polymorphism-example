<?php

namespace App\Entity\Comment;

use Doctrine\Common\Collections\Collection;

interface CommentableInterface
{
    public function getId(): ?int;
    public function addComment(Comment $comment): self;
    public function removeComment(Comment $comment): self;
    public function getComments(): Collection;
}