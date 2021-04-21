<?php

namespace Api\Messages;

final class RacingDriverMessages
{
    public static function errorMessage_RacingDriverAlreadyExists(): string
    {
        return "O Piloto já existe!";
    }

    public static function errorMessage_NameIsNull(): string
    {
        return "Digite o nome do piloto!";
    }

    public static function errorMessage_NameIsInvalid(): string
    {
        return "Piloto não existe!";
    }
}
