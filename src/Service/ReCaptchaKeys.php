<?php

namespace App\Service;

class ReCaptchaKeys
{
    private $secretKey;
    private $siteKey;

    public function __construct(string $secretKey, string $siteKey)
    {
        $this->secretKey = $secretKey;
        $this->siteKey = $siteKey;
    }

    public function getSecret(): string
    {
        return $this->secretKey;
    }

    public function getSite(): string
    {
        return $this->siteKey;
    }
}