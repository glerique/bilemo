<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserVoter extends Voter
{


    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    protected function supports($attribute, $subject)
    {
        
        return in_array($attribute, ['VIEW', 'DELETE'])
            && $subject instanceof User;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $client = $token->getUser();
        
        if (!$client instanceof UserInterface) {
            return false;
        }

        

        switch ($attribute) {
            case 'VIEW':
                       
            case 'DELETE':
                
                if ($subject->getClient() === $client) {
                    return true;
                }

                if ( $this->security->isGranted('ROLE_ADMIN') ) { 
                    return true; 
                }
                
                return false;
        }

        return false;
    }
}
