<?php

namespace Api\Messages;

final class CommandMessages
{
    public static function errorMessage_CommandNotFound(): string
    {
        return "Comando não encontrado";
    }

    public static function errorMessageCommandEmpty(): string
    {
        return "Nome do Comando vazio!";
    }

    public static function descNewCar(): void
    {
        echo "Descricao:" . PHP_EOL
            . " - Esse comando adiciona um novo carro a corrida." . PHP_EOL . PHP_EOL
            . "Como usar:" . PHP_EOL
            . " - php executarComando adicionarCarro [Piloto] [Marca] [Modelo] [Cor] [Ano]" . PHP_EOL;
    }

    public static function descSetPosition(): void
    {
        echo "Descricao:" . PHP_EOL
            . " - Esse comando define as posicoes dos carros na corrida." . PHP_EOL . PHP_EOL
            . "Como usar:" . PHP_EOL
            . " - php executarComando definirPosicoes" . PHP_EOL;
    }

    public static function descShowCars(): void
    {
        echo "Descricao:" . PHP_EOL
            . " - Esse comando exibe todos os carros cadastrados." . PHP_EOL . PHP_EOL
            . "Como usar:" . PHP_EOL
            . " - php executarComando exibirCarros" . PHP_EOL;
    }

    public static function descStartRace(): void
    {
        echo "Descricao:" . PHP_EOL
            . " - Esse comando inicia a Corrida, ele so funciona se existir carros com posicoes definidas." . PHP_EOL . PHP_EOL
            . "Como usar:" . PHP_EOL
            . " - php executarComando iniciarCorrida" . PHP_EOL;
    }

    public static function descFinishRace(): void
    {
        echo "Descricao:" . PHP_EOL
            . " - Esse comando encerra a corrida e exibe os tres primeiros colocados." . PHP_EOL . PHP_EOL
            . "Como usar:" . PHP_EOL
            . " - php executarComando finalizarCorrida" . PHP_EOL;
    }

    public static function descOvertake(): void
    {
        echo "Descricao:" . PHP_EOL
            . " - Esse comando faz as ultrapassagens na corrida, o piloto passado no comando ira ultrapassar o piloto a sua frente." . PHP_EOL . PHP_EOL
            . "Como usar:" . PHP_EOL
            . " - php executarComando ultrapassar (Piloto)" . PHP_EOL;
    }

    public static function descReport(): void
    {
        echo "Descricao:" . PHP_EOL
            . " - Esse comando exibe um relatorio com todas as ultrapassagens da corrida." . PHP_EOL . PHP_EOL
            . "Como usar:" . PHP_EOL
            . " - php executarComando relatorio" . PHP_EOL;
    }

    public static function descDeleteCar(): void
    {
        echo "Descricao:" . PHP_EOL
            . " - Esse comando deleta os carro da corrida." . PHP_EOL . PHP_EOL
            . "Como usar:" . PHP_EOL
            . " - php executarComando excluirCarro Piloto" . PHP_EOL;
    }

    public static function defaultMessageCommands(): void
    {
        echo "Lista dos comandos:" . PHP_EOL . PHP_EOL
            . "Para ver detalhes de cada comando digite: verificarComandos (nome do comando)" . PHP_EOL . PHP_EOL
            . " - adicionarCarro" . PHP_EOL
            . " - excluirCarro" . PHP_EOL
            . " - definirPosicoes" . PHP_EOL
            . " - exibirCarros" . PHP_EOL
            . " - iniciarCorrida" . PHP_EOL
            . " - finalizarCorrida" . PHP_EOL
            . " - ultrapassar" . PHP_EOL
            . " - relatorio" . PHP_EOL . PHP_EOL
            . "";
    }
}
