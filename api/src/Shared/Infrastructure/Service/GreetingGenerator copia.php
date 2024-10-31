<?php

namespace App\Shared\Infrastructure\Service;

class GreetingGenerator
{
    public function getRandomGreeting()
    {
        $greetings = ['Hey', 'Yo', 'Aloha'];
        $greeting = $greetings[array_rand($greetings)];

        return $greeting;
    }
}
