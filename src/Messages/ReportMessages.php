<?php

namespace Api\Messages;

final class ReportMessages
{
    public static function errorMessage_EmptyReport(): string
    {
        return "Relatorio vazio!" . PHP_EOL . PHP_EOL
            . "Nenhuma ultrapassagem realizada, use o comando 'php executarComando ultrapassar [Piloto]' para ultrapassagens";
    }
}
