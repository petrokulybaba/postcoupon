<?php

namespace App\Normalizer;

use App\Entity\User;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UserNormalizer implements NormalizerInterface
{
    private const ROLE_USER = ["ROLE_USER"];

    private const ROLE_RETAILER = ["ROLE_RETAILER"];

    private const ROLE_ADMIN = ["ROLE_ADMIN"];

    public function normalize($user, $format = null, array $context = [])
    {
        if (!isset($context['normalization'])) {
            return $user;
        }

        if ($context['normalization'] === 'profile') {
            switch ($user->getRoles()) {
                case self::ROLE_USER:
                    return [
                        'userId' => $user->getId(),
                        'firstName' => $user->getFirstName(),
                        'lastName' => $user->getLastName(),
                        'about' => $user->getAbout(),
                        'picture' => $user->getPicture(),
                        'googleId' => $user->getGoogleId(),
                        'instagramId' => $user->getInstagramId(),
                        'facebookId' => $user->getFacebookId(),
                        'coupons' => count($user->getCoupons()),
                        'followers' => count($user->getFollowers()),
                        'following' => count($user->getFollowing())
                     ];
                case self::ROLE_RETAILER:
                    return [
                        'userId' => $user->getId(),
                        'firstName' => $user->getFirstName(),
                        'lastName' => $user->getLastName(),
                        'about' => $user->getAbout(),
                        'picture' => $user->getPicture(),
                        'googleId' => $user->getGoogleId(),
                        'instagramId' => $user->getInstagramId(),
                        'facebookId' => $user->getFacebookId(),
                        'company' => count($user->getCompany()),
                        'followers' => count($user->getFollowers()),
                        'following' => count($user->getFollowing())
                    ];
                case self::ROLE_ADMIN:
                    return [
                        'userId' => $user->getId(),
                        'firstName' => $user->getFirstName(),
                        'lastName' => $user->getLastName(),
                        'about' => $user->getAbout(),
                        'picture' => $user->getPicture(),
                        'googleId' => $user->getGoogleId(),
                        'instagramId' => $user->getInstagramId(),
                        'facebookId' => $user->getFacebookId(),
                        'company' => count($user->getCompany()),
                        'coupons' => count($user->getCoupons()),
                        'followers' => count($user->getFollowers()),
                        'following' => count($user->getFollowing())
                    ];
            }
        }
    }

    public function supportsNormalization($user, $format = null)
    {
        return $user instanceof User;
    }
}
