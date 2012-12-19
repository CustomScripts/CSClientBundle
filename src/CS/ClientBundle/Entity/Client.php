<?php

/*
 * This file is part of the CSClientBundle package.
 *
 * (c) Pierre du Plessis <info@customscripts.co.za>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CS\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use CS\QuoteBundle\Entity\Quote;

/**
 * CS\ClientBundle\Entity\Client
 *
 * @ORM\Table(name="clients")
 * @ORM\Entity(repositoryClass="CS\ClientBundle\Repository\ClientRepository")
 * @UniqueEntity("name")
 */
class Client
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=125, nullable=false, unique=true)
     * @Assert\NotBlank()
     * @Assert\MaxLength(125)
     */
    private $name;

    /**
     * @var string $website
     *
     * @ORM\Column(name="website", type="string", length=125, nullable=true)
     * @Assert\Url()
     * @Assert\MaxLength(125)
     */
    private $website;

    /**
     * @var Status $status
     *
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="clients", cascade={"ALL"})
     * @Assert\Valid()
     */
    private $status;

    /**
     * @var ArrayCollection $contacts
     *
     * @ORM\OneToMany(targetEntity="Contact", mappedBy="client", cascade="ALL")
     * @ORM\OrderBy({"firstname" = "ASC"})
     * @Assert\Valid()
     */
    private $contacts;

    /**
     * Constructer
     */
    public function __construct()
    {
        $this->contacts = new ArrayCollection;
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
     * @param  string $name
     * @return Client
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
     * Set status
     *
     * @param  string $status
     * @return Client
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set website
     *
     * @param  string $website
     * @return Client
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Add contact
     *
     * @param  Contact $contact
     * @return Client
     */
    public function addContact(Contact $contact)
    {
        $this->contacts[] = $contact;
        $contact->setClient($this);

        return $this;
    }

    /**
     * Removes a contact
     *
     * @param  Contact $contact
     * @return Client
     */
    public function removeContact(Contact $contact)
    {
        $this->contacts->removeElement($contact);

        return $this;
    }

    /**
     * Get contacts
     *
     * @return ArrayCollection
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Return the client name as a string
     *
     * @return string
     */
    public function __toString()
    {
    	return $this->getName();
    }
}
