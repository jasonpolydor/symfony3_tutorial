<?php

namespace PlatformBundle\Service;

class Antispam{

    private $mailer;
    private $locale;
    private $minLength;

    /**
     * Antispam constructor.
     *
     * En une seule ligne de configuration,
     * on vient d'injecter un service (swiftmailer) dans un autre.
     * Ce mécanisme s'appelle l'injection de dépendances
     *
     * @param \Swift_Mailer $mailer
     * @param $locale
     * @param $minLength
     */
    public function __construct(\Swift_Mailer $mailer, $locale, $minLength)
    {
        $this->mailer = $mailer;
        $this->locale = $locale;
        $this->minLength = $minLength;
    }

    /**
     * Vérifie si le texte est un spam ou non
     * @param $text
     * @return bool
     */
    public function isSpam($text)
    {
        return strlen($text) < $this->minLength;
    }

    /**
     * @return \Swift_Mailer
     */
    public function getMailer()
    {
        return $this->mailer;
    }

    /**
     * @param \Swift_Mailer $mailer
     */
    public function setMailer($mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return mixed
     */
    public function getMinLength()
    {
        return $this->minLength;
    }

    /**
     * @param mixed $minLength
     */
    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;
    }

}