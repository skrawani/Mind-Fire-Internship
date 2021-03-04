<?php

class Mailer
{
    private $mailConfigs;

    public function __construct()
    {
        $this->mailConfigs = require __DIR__ . './app/config.php';
    }

    /**
     * @return mixed
     */
    public function getMailConfig()
    {
        return $this->mailConfigs;
    }
}


$mailer = new Mailer();
$mailer->getMailConfig();

var_dump($mailer->getMailConfig());
