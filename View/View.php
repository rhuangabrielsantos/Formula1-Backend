<?php

namespace View;

class View
{
    public static function errorMessageNewCarRaceStart()
    {
        View::logo();
        echo "\e[00;31mA corrida foi Iniciada, para adicionar novos carros a corrida precisa ser encerrada" . PHP_EOL . PHP_EOL
            . "\e[00;33mPara encerrar uma corrida digite o comando finalizarCorrida\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageDeleteCarStartRace()
    {
        View::logo();
        echo "\e[00;31mA corrida foi Iniciada, para deletar carros a corrida precisa ser encerrada" . PHP_EOL . PHP_EOL
            . "\e[00;33mPara encerrar uma corrida digite o comando finalizarCorrida\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageNewCarExistPilot()
    {
        View::logo();
        echo "\e[00;31mO Piloto já existe!" . PHP_EOL . PHP_EOL
            . "\e[00;33mVerifique os pilotos existentes com o comando exibirCarros\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageCommands()
    {
        View::logo();
        echo "\e[00;31mComando nao encontrado" . PHP_EOL . PHP_EOL
            . "\e[00;33mPara para verificar comandos disponiveis digite verificarComandos\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageNewCar()
    {
        View::logo();
        echo "\e[00;31mAdicione todas as informacoes para adicionar um carro" . PHP_EOL . PHP_EOL
            . "\e[00;33mComando: adicionarCarros Piloto Marca Modelo Cor Ano\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageOvertakeNull()
    {
        View::logo();
        echo "\e[00;31mVoce precisa identificar quem ultrapassou!" . PHP_EOL . PHP_EOL
            ."\e[00;33mComando: ultrapassager Piloto\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageNeedAddCars()
    {
        View::logo();
        echo "\e[00;31mVoce precisa adicionar carros" . PHP_EOL . PHP_EOL
            . "\e[00;33mPara adicionar carros use o comando adicionarCarros\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageNotFoundCar()
    {
        View::logo();
        echo "\e[00;31mNenhum carro encontrado" . PHP_EOL . PHP_EOL
            . "\e[00;33mPara adicionar carros use o comando adicionarCarros\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageOneCar()
    {
        View::logo();
        echo "\e[00;31mImpossivel comecar corrida com apenas um carro" . PHP_EOL . PHP_EOL
            . "\e[00;33mAdicione novos carros com o comando adicionarCarros\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageNeedDefinePosition()
    {
        View::logo();
        echo "\e[00;31mPara iniciar a corrida, os carros precisam de posicoes definidas" . PHP_EOL . PHP_EOL
            . "\e[00;33mDefina as posicoes com o comando definirPosicoes \e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageStartAgain()
    {
        View::logo();
        echo "\e[00;31mVoce ja iniciou a corrida!\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageNeedStart()
    {
        View::logo();
        echo "\e[00;31mVoce precisa iniciar a corrida!" . PHP_EOL . PHP_EOL
            . "\e[00;33mPara iniciar uma corrida use o comando iniciarCorrida\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageOvertakingFirsPlace($car)
    {
        View::logo();
        echo "\e[00;31m" . $car['Piloto'] . " esta em primeiro lugar\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageNotFoundPilot()
    {
        View::logo();
        echo "\e[00;31mPiloto nao encontrado!". PHP_EOL . PHP_EOL
            ."\e[00;33mVerifique o nome do piloto e escreva novamente\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageDeleteCar()
    {
        View::logo();
        echo "\e[00;31mDigite o nome do piloto!". PHP_EOL . PHP_EOL
            ."\e[00;33mPara executar esse comando digite excluirCarro Piloto\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageInvalidPassword()
    {
        View::logo();
        echo "\e[00;31mSenha invalida!\e[00;37m". PHP_EOL . PHP_EOL;
    }

    public static function errorMessageEmptyReport()
    {
        echo "\e[00;31mRelatorio vazio!". PHP_EOL . PHP_EOL
            ."\e[00;33mNenhuma ultrapassagem realizada, use o comando ultrapassar\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function errorMessageTests()
    {
        View::logo();
        echo "\e[00;33mModo Teste Desativado\e[00;37m" . PHP_EOL . PHP_EOL
            ."\e[00;33mPor favor ative para realizar os testes!\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function successMessageNewCar()
    {
        View::logo();
        echo "\e[00;32mCarro Salvo com Sucesso!" . PHP_EOL . PHP_EOL
            . "\e[00;33mLembre-se de definir a posicao do seu carro com o comando definirPosicoes\033[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function successMessageSetPosition()
    {
        View::logo();
        echo "\e[00;32mAs posicoes foram definidas com Sucesso!\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function successMessageStartRace()
    {
        View::logo();
        echo "\e[00;32mCorrida Iniciada!\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function successMessageOvertaking($win, $lost)
    {
        View::logo();
        echo "\e[00;32m" . $win . " ultrapassou " . $lost['Piloto'] . "!\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function successMessageDeleteCar()
    {
        View::logo();
        echo "\e[00;32mCarro deletado com sucesso!\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function messageGodModeOn()
    {
        View::logo();
        echo "\e[00;33mModo Teste Ativado!\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function messageGodModeOff()
    {
        View::logo();
        echo "\e[00;32mModo Teste Desativado!\e[00;37m" . PHP_EOL . PHP_EOL;
    }

    public static function showCars($car)
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

    public static function podium($cars)
    {
        View::logo();
        $p = 1;
        echo "Corrida Finalizada!" . PHP_EOL . PHP_EOL;
        echo "Ganhadores:" . PHP_EOL;
        for ($i = 0; $i < 3; $i++) {
            echo $p . "- " . $cars[$i]['Piloto'] . PHP_EOL;
            $p++;
        }
    }

    public static function report($item)
    {
        echo "\e[00;36m" . $item . "\e[00;37m" ;
    }

    public static function descNewCar()
    {
        View::logo();
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando adiciona um novo carro a corrida." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- adicionarCarros (Piloto) (Marca) (Modelo) (Cor) (Ano)\e[00;37m" . PHP_EOL;
    }

    public static function descSetPosition()
    {
        View::logo();
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando define as posicoes dos carros na corrida." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- definirPosicoes\e[00;37m" . PHP_EOL;
    }

    public static function descShowCars()
    {
        View::logo();
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando exibe todos os carros cadastrados." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- exibirCarros\e[00;37m" . PHP_EOL;
    }

    public static function descStartRace()
    {
        View::logo();
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando inicia a Corrida, ele so funciona se existir carros com posicoes definidas." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- iniciarCorrida\e[00;37m" . PHP_EOL;
    }

    public static function descFinishRace()
    {
        View::logo();
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando encerra a corrida e exibe os tres primeiros colocados." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- finalizarCorrida\e[00;37m" . PHP_EOL;
    }

    public static function descOvertake()
    {
        View::logo();
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando faz as ultrapassagens na corrida, o piloto passado no comando ira ultrapassar o piloto a sua frente." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- ultrapassar (Piloto)\e[00;37m" . PHP_EOL;
    }

    public static function descReport()
    {
        View::logo();
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando exibe um relatorio com todas as ultrapassagens da corrida." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- relatorioUltrapassagens\e[00;37m" . PHP_EOL;
    }

    public static function descDeleteCar()
    {
        View::logo();
        echo "\e[00;31mDescricao:" . PHP_EOL
            . " \e[00;33m- Esse comando deleta os carro da corrida." . PHP_EOL . PHP_EOL
            . "\e[00;31mComo usar:" . PHP_EOL
            . " \e[00;33m- excluirCarro Piloto\e[00;37m" . PHP_EOL;
    }

    public static function defaultMessageCommands()
    {
        View::logo();
        echo "Lista dos comandos:" . PHP_EOL . PHP_EOL
             . "Para ver detalhes de cada comando digite: verificarComandos (nome do comando)" . PHP_EOL . PHP_EOL
             . " - adicionarCarros" . PHP_EOL
             . " - excluirCarro" . PHP_EOL
             . " - definirPosicoes" . PHP_EOL
             . " - exibirCarros" . PHP_EOL
             . " - iniciarCorrida" . PHP_EOL
             . " - finalizarCorrida" . PHP_EOL
             . " - ultrapassar" . PHP_EOL
             . " - relatorioUltrapassagens" . PHP_EOL . PHP_EOL
             . "\e[00;37m";
    }

    public static function logo()
    {
        echo "\e[01;34;47mP"
               ."\e[01;31mr"
               ."\e[01;33mo"
               ."\e[01;34mj"
               ."\e[01;32me"
               ."\e[01;31mt"
               ."\e[01;31mo "
               ."\e[01;34mT"
               ."\e[01;31mG"
               ."\e[00;37m"
               . PHP_EOL . PHP_EOL;
    }
}
