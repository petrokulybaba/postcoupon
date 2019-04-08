<?php

namespace App\Services;

use App\Entity\Coupon;
use App\Entity\User;

class EmailService
{
    /**
     * @var \Swift_Mailer $mailer
     */
    private $mailer;

    /**
     * @var string $adminEmail
     */
    private $adminEmail;

    /**
     * EmailService constructor.
     * @param string $adminEmail
     * @param \Swift_Mailer $mailer
     */
    public function __construct(string $adminEmail, \Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->adminEmail = $adminEmail;
    }

    public function sendRegistrationEmail(User $user)
    {
        $message = (new \Swift_Message('Registration email'))
            ->setFrom($this->adminEmail)
            ->setTo($user->getEmail())
            ->setBody('Congratulations! ' . $user->getFirstName() . ' ' . $user->getLastName() . ', you are successfully registered. ' . 'Email: ' . $user->getEmail() . '. Password: ' . $user->getPlainPassword() . '.');
        $this->mailer->send($message);
    }

    public function sendCouponEmail(User $user, Coupon $coupon)
    {
        $message = (new \Swift_Message('Coupon email'))
            ->setFrom($this->adminEmail)
            ->setTo($user->getEmail())
            ->setBody('Congratulations! ' . $user->getFirstName() . ' ' . $user->getLastName() . ', you received a coupon with ' . $coupon->getPercentDiscount() . '% discount from the company - ' . $coupon->getCompany()->getName() . '.');
        $this->mailer->send($message);
    }
}
