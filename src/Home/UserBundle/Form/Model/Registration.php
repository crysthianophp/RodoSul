<?php

namespace Home\UserBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

use Home\UserBundle\Entity\User;

class Registration
{
    /**
     * @Assert\Type(type="Home\UserBundle\Entity\User")
     * @Assert\Valid() 
     */
    protected $user;
    
    /**
     * @Assert\NotBlank()
     * @Assert\True()
     */
    protected $termsAccepted;
    
    public function User(User $user)
    {
        $this->user = $user;
    }
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }
    
    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = (Boolean) $termsAccepted;
    }
}
