<?php

namespace View;

class View
{
    public static function errorMessageNewCarRaceStart(): void
    {
        echo "\e[00;31mA corrida foi Iniciada, para adicionar ou deletar novos carros a corrida precisa ser encerrada" . PHP_EOL . PHP_EOL
            . "\e[00;33mPara encerrar uma corrida digite o comando finalizarCorrida\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageNewCarExistPilot(): void
    {
        echo "\e[00;31mO Piloto já existe!" . PHP_EOL . PHP_EOL
            . "\e[00;33mVerifique os pilotos existentes com o comando exibirCarros\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageCommands(): void
    {
        echo "\e[00;31mComando nao encontrado" . PHP_EOL . PHP_EOL
            . "\e[00;33mPara para verificar comandos disponiveis digite verificarComandos\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageNewCar(): void
    {
        echo "\e[00;31mAdicione todas as informacoes para adicionar um carro" . PHP_EOL . PHP_EOL
            . "\e[00;33mComando: adicionarCarro Piloto Marca Modelo Cor Ano\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageParameters(): void
    {
        echo "\e[00;31mPara adicionar um carro, você deve preencher somente essas informacoes" . PHP_EOL . PHP_EOL
            . "\e[00;33mComando: adicionarCarro Piloto Marca Modelo Cor Ano\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageOvertakeNull(): void
    {
        echo "\e[00;31mVoce precisa identificar quem ultrapassou!" . PHP_EOL . PHP_EOL
            . "\e[00;33mComando: ultrapassager Piloto\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageEmpty(): void
    {
        echo "\e[00;31mNao existem carros." . PHP_EOL . PHP_EOL
            . "\e[00;33mPara adicionar carros use o comando adicionarCarro\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageNotFoundCar(): void
    {
        echo "\e[00;31mNenhum carro encontrado" . PHP_EOL . PHP_EOL
            . "\e[00;33mPara adicionar carros use o comando adicionarCarro\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageOneCar(): void
    {
        echo "\e[00;31mImpossivel comecar corrida com apenas um carro" . PHP_EOL . PHP_EOL
            . "\e[00;33mAdicione novos carros com o comando adicionarCarro\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageNeedDefinePosition(): void
    {
        echo "\e[00;31mPara iniciar a corrida, os carros precisam de posicoes definidas" . PHP_EOL . PHP_EOL
            . "\e[00;33mDefina as posicoes com o comando definirPosicoes \e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageStartAgain(): void
    {
        echo "\e[00;31mVoce ja iniciou a corrida!\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageNeedStart(): void
    {
        echo "\e[00;31mVoce precisa iniciar a corrida!" . PHP_EOL . PHP_EOL
            . "\e[00;33mPara iniciar uma corrida use o comando iniciarCorrida\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageOvertakingFirsPlace(string $pilot): void
    {
        echo "\e[00;31m" . $pilot . " esta em primeiro lugar\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageDeleteCar(): void
    {
        echo "\e[00;31mDigite o nome do piloto!" . PHP_EOL . PHP_EOL
            . "\e[00;33mPara executar esse comando digite excluirCarro Piloto\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageEmptyReport(): void
    {
        echo "\e[00;31mRelatorio vazio!" . PHP_EOL . PHP_EOL
            . "\e[00;33mNenhuma ultrapassagem realizada, use o comando ultrapassar\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function successMessageNewCar(): void
    {
        echo "\e[00;32mCarro Salvo com Sucesso!" . PHP_EOL . PHP_EOL
            . "\e[00;33mLembre-se de definir a posicao do seu carro com o comando definirPosicoes\033[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function successMessageSetPosition(): void
    {
        echo "\e[00;32mAs posicoes foram definidas com Sucesso!\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function successMessageStartRace(): void
    {
        echo "\e[00;32mCorrida Iniciada!\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function successMessageOvertaking(string $win, string $lost): void
    {
        echo "\e[00;32m" . $win . " ultrapassou " . $lost . "!\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function successMessageDeleteCar(): void
    {
        echo "\e[00;32mCarro deletado com sucesso!\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function showCar(array $car): void
    {
        echo "-----------------------------" . PHP_EOL
            . "Piloto - " . $car['Piloto'] . PHP_EOL
            . "Marca - " . $car['Marca'] . PHP_EOL
            . "Modelo - " . $car['Modelo'] . PHP_EOL
            . "Cor - " . $car['Cor'] . PHP_EOL
            . "Ano - " . $car['Ano'] . PHP_EOL;
        if (!empty($car['Posicao'])) {
            echo "Posicao - " . $car['Posicao'] . PHP_EOL . PHP_EOL;
        } else {
            echo PHP_EOL;
        }
    }

    public static function podium(array $cars): void
    {
        $p = 1;

        $colors = [
            0 => "\e[00;32m",
            1 => "\e[00;34m",
            2 => "\e[00;33m"
        ];

        echo "Corrida Finalizada!" . PHP_EOL . PHP_EOL;
        echo "Ganhadores:" . PHP_EOL;
        for ($i = 0; $i < 3; $i++) {
            if (!empty($cars[$i])) {
                echo $colors[$i] . $p . "- " . $cars[$i]['Piloto'] . "\e[00;37m" . PHP_EOL;
                $p++;
            }
        }
    }

    public static function report(string $item): void
    {
        echo "\e[00;36m" . $item . "\e[00;37m";
    }

    public static function descNewCar(): void
    {
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando adiciona um novo carro a corrida." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- adicionarCarro (Piloto) (Marca) (Modelo) (Cor) (Ano)\e[00;37m" . PHP_EOL;
    }

    public static function descSetPosition(): void
    {
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando define as posicoes dos carros na corrida." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- definirPosicoes\e[00;37m" . PHP_EOL;
    }

    public static function descShowCars(): void
    {
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando exibe todos os carros cadastrados." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- exibirCarros\e[00;37m" . PHP_EOL;
    }

    public static function descStartRace(): void
    {
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando inicia a Corrida, ele so funciona se existir carros com posicoes definidas." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- iniciarCorrida\e[00;37m" . PHP_EOL;
    }

    public static function descFinishRace(): void
    {
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando encerra a corrida e exibe os tres primeiros colocados." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- finalizarCorrida\e[00;37m" . PHP_EOL;
    }

    public static function descOvertake(): void
    {
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando faz as ultrapassagens na corrida, o piloto passado no comando ira ultrapassar o piloto a sua frente." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- ultrapassar (Piloto)\e[00;37m" . PHP_EOL;
    }

    public static function descReport(): void
    {
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando exibe um relatorio com todas as ultrapassagens da corrida." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- relatorioUltrapassagens\e[00;37m" . PHP_EOL;
    }

    public static function descDeleteCar(): void
    {
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando deleta os carro da corrida." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- excluirCarro Piloto\e[00;37m" . PHP_EOL;
    }

    public static function defaultMessageCommands(): void
    {
        echo "Lista dos comandos:" . PHP_EOL . PHP_EOL
            . "Para ver detalhes de cada comando digite: verificarComandos (nome do comando), lembre-se sempre de adicionar o php antes de cada comando" . PHP_EOL . PHP_EOL
            . " - adicionarCarro" . PHP_EOL
            . " - excluirCarro" . PHP_EOL
            . " - definirPosicoes" . PHP_EOL
            . " - exibirCarros" . PHP_EOL
            . " - iniciarCorrida" . PHP_EOL
            . " - finalizarCorrida" . PHP_EOL
            . " - ultrapassar" . PHP_EOL
            . " - relatorioUltrapassagens" . PHP_EOL . PHP_EOL
            . "\e[00;37m";
    }
}
