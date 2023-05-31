<?php

namespace App\DataFixtures;

use App\Entity\Comment\Comment;
use App\Entity\Post\Post;
use App\Entity\User;
use App\Entity\Video\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {}

    public function load(ObjectManager $manager): void
    {
        // Create a new user
        $user = new User();
        $user->setEmail('test@test.com');
        $user->setPassword($this->hasher->hashPassword($user, '12345678')); // please ensure to encode this
        $manager->persist($user);
        $manager->flush();

        // Create a new post
        $post = new Post();
        $post->setTitle('This is a test title');
        $post->setBody('This is a test body.');
        $post->setUser($user);

        // Create a new video
        $video = new Video();
        $video->setTitle('This is a test video entity');
        $video->setUrl('https://amazonrandombucker.com/test/video.mp4');
        $video->setUser($user);


        $manager->persist($post);
        $manager->persist($video);
        $manager->flush();

        // Create a comment for the post
        $postComment = new Comment();
        $postComment->setBody('This is a test comment for the Post');
        $postComment->setCommentableId($post->getId());
        $postComment->setCommentableType(Post::class);
        $postComment->setUser($user);
        $post->addComment($postComment);

        // Create a comment for the video
        $videoComment = new Comment();
        $videoComment->setBody('This is a test comment for the video.');
        $videoComment->setCommentableId($video->getId());
        $videoComment->setCommentableType(Video::class);
        $videoComment->setUser($user);
        $video->addComment($videoComment);

        // Persist entities
        $manager->persist($postComment);
        $manager->persist($videoComment);

        $manager->flush();
    }
}
