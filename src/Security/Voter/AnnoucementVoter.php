<?php

namespace App\Security\Voter;

use App\Entity\Announcement;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class AnnoucementVoter extends Voter
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    const ADD = 'ANNOUNCE_ADD';

    protected function supports(string $attribute, $subject): bool
    {
        if (!in_array($attribute, [self::ADD])) {
            return false;
        }

        // only vote on `Announcement` objects
        if ($subject == null) {
            return true;
        } elseif (!$subject instanceof Announcement) {
            return false;
        }
        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do grant access
        if (!$user instanceof User) {
            return true;
        }

        // you know $subject is a Announcement object, thanks to `supports()`
        /** @var Announcement $announcement */
        $announcement = $subject;

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::ADD:
                if ($this->security->isGranted('ROLE_ENTERPRISE')) {
                    return true;
                }
                if ($this->security->isGranted('ROLE_COMPANY')) {
                    return true;
                }
        }
        return false;
    }
}
