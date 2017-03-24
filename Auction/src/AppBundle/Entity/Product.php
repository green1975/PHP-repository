<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;

/**
 * Product
 */
class Product 
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $price;


    
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
     * Set title
     *
     * @param string $title
     *
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * @var \AppBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Product
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ratingproducts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ratingproducts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rating = new ArrayCollection();
        $this->comments = new ArrayCollection();

    }

    /**
     * Add ratingproduct
     *
     * @param \AppBundle\Entity\Ratingproduct $ratingproduct
     *
     * @return Product
     */
    public function addRatingproduct(\AppBundle\Entity\Ratingproduct $ratingproduct)
    {
        $this->ratingproducts[] = $ratingproduct;

        return $this;
    }

    /**
     * Remove ratingproduct
     *
     * @param \AppBundle\Entity\Ratingproduct $ratingproduct
     */
    public function removeRatingproduct(\AppBundle\Entity\Ratingproduct $ratingproduct)
    {
        $this->ratingproducts->removeElement($ratingproduct);
    }

    /**
     * Get ratingproducts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRatingproducts()
    {
        return $this->ratingproducts;
    }

      public function __tostring()
    {
        return 'hello';
    }
}
