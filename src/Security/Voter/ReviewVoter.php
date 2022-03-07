<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class ReviewVoter extends Voter
{
    public const ADD = 'REVIEW_ADD';

    protected function supports(string $attribute, $subject): bool
    {
        if ($attribute !== 'REVIEW_ADD')
        {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        // utilisateur connecté
        /** @var User */ 
        $user = $token->getUser();

        // si l'email contient un a alors c'est bon
        if (strpos($user->getEmail(), 'a') !== false)
        {
            return true;
        }

        return false;
    }
}
