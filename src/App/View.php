<?php

namespace App\App;

/**
 * classe para retornar o html
 */
class View
{
    /**Variável padrão da view */
    private static array $vars = [];

    private function __construct(){}

    /**Método responsável por definir os dados iniciais da classe */
    public static function init(array $vars = [])
    {
        self::$vars = $vars;
    }

    /**Método responsável por retornar o conteudo de uma view */
    private static function getContentView(string $view): string
    {
        $file = __DIR__.'/../../views/'.$view.'.php';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Método reponsável por retornar o conteúdo renderizado de uma view
     * $vars são as variaveis que serão passadas para a view
     */
    public static function render(string $view, Array $vars = []): string
    {
        //Content da view
        $contentView = self::getContentView($view);
        //Merge da variáveis da view
        $vars = array_merge(self::$vars, $vars);

        //Chave do array de variáveis
        $keys = array_keys($vars);
        $keys = array_map(function($item){return '{{'.$item.'}}';}, $keys);
        //Retorna o conteudo renderizado
        return str_replace($keys, array_values($vars), $contentView);
    }
}