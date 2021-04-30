<?php

namespace App\App;

class Environment{

    /**
     * Método responsável por carregar as variáveis de ambiente do projeto
     * @param  string $dir Caminho absoluto da pasta onde encontra-se o arquivo .env
     */
    public static function load(string $dir)
    {
        //VERIFICA SE O ARQUIVO .ENV EXISTE
        if(!file_exists($dir.'/.env')){
            return false;
        }

        //DEFINE AS VARIÁVEIS DE AMBIENTE
        $lines = file($dir.'/.env');
        foreach($lines as $line){
            //Valida se não a linha esta vazia
            if($line === "\n"){continue;}
            putenv(trim($line));
        }
    }

}