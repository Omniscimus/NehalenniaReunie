<?php

return array(
    "mysql-host" => "localhost",
    "mysql-port" => "3306",
    "mysql-user" => "root",
    "mysql-password" => "",
    "mysql-database" => "reunie",

    "mail-host" => "test.mail.server",
    "mail-user" => "test@mailserver.com",
    "mail-password" => "",
    "mail-smtp-secure" => "ssl",
    "mail-smtp-port" => 123,
    "mail-name" => "Joe", // In what name should the mail be sent
    "mail-reply-to" => "you@mailserver.com",
    "mail-reply-to-name" => 'You',

    "captcha-sitekey" => "",
    "captcha-secretkey" => "",

    "results-password" => "12345",

    "menu" => array(
        array('Index', 'index.php'),
        array('Inschrijven', 'inschrijven.php'),
        array('Deelnemers', 'deelnemers.php'),
        array('Programma', 'agenda.php'),
        array('Veelgestelde vragen', 'faq.php'),
        array('Contact', 'contact.php')
    )
);
