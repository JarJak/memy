<?php

namespace Memy\MemeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 */
class Tag
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $memeCount;

    /**
     * @var string
     */
    private $userIp;

    /**
     * @var \DateTime
     */
    private $insertedAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \Memy\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $memes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->memes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Tag
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
     * Set memeCount
     *
     * @param integer $memeCount
     * @return Tag
     */
    public function setMemeCount($memeCount)
    {
        $this->memeCount = $memeCount;

        return $this;
    }

    /**
     * Get memeCount
     *
     * @return integer 
     */
    public function getMemeCount()
    {
        return $this->memeCount;
    }

    /**
     * Set userIp
     *
     * @param string $userIp
     * @return Tag
     */
    public function setUserIp($userIp)
    {
        $this->userIp = $userIp;

        return $this;
    }

    /**
     * Get userIp
     *
     * @return string 
     */
    public function getUserIp()
    {
        return $this->userIp;
    }

    /**
     * Set insertedAt
     *
     * @param \DateTime $insertedAt
     * @return Tag
     */
    public function setInsertedAt($insertedAt)
    {
        $this->insertedAt = $insertedAt;

        return $this;
    }

    /**
     * Get insertedAt
     *
     * @return \DateTime 
     */
    public function getInsertedAt()
    {
        return $this->insertedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Tag
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
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set user
     *
     * @param \Memy\UserBundle\Entity\User $user
     * @return Tag
     */
    public function setUser(\Memy\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Memy\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add memes
     *
     * @param \Memy\MemeBundle\Entity\Meme $memes
     * @return Tag
     */
    public function addMeme(\Memy\MemeBundle\Entity\Meme $memes)
    {
        $this->memes[] = $memes;

        return $this;
    }

    /**
     * Remove memes
     *
     * @param \Memy\MemeBundle\Entity\Meme $memes
     */
    public function removeMeme(\Memy\MemeBundle\Entity\Meme $memes)
    {
        $this->memes->removeElement($memes);
    }

    /**
     * Get memes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMemes()
    {
        return $this->memes;
    }
}
