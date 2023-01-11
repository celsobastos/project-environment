<?php

namespace Celso\Environment\Model;

class Cliente extends Pessoa {

    /**
     * Construct
     *
     * @param string $cnpj
     */
    public function __construct(
        private string $cnpj,
        $name,
        $endereco,
    ){
        parent::__construct($name, $endereco);
    }
}