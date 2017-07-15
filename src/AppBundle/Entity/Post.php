<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Med\UploadBundle\Annotation\Uploadable;
use Symfony\Component\HttpFoundation\File\File;
use Med\UploadBundle\Annotation\UploadableField;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 * @Uploadable()
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
    * @UploadableField(filename="filename", path="uploads")
    */
    private $file;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=255)
     */
    private $avatar;

    /**
    * @UploadableField(filename="avatar", path="avatars")
    */
    private $avatarFile;


    /**
     * Get file
     *
     * @return File|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set file
     *
     * @param File|null $file
     *
     * @return Post
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Post
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return Post
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Post
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getupdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return Post
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }


     /**
     * Get avatarFile
     *
     * @return avatarFile|null
     */
    public function getAvatarFile()
    {
        return $this->avatarFile;
    }

    /**
     * Set avatarFile
     *
     * @param File|null $avatarFile
     *
     * @return Post
     */
    public function setAvatarFile($avatarFile)
    {
        $this->avatarFile = $avatarFile;

        return $this;
    }
}

