<?php

namespace Celso\Environment\Model;

abstract class Pessoa {

    /**
     * @var Fone[] $fone
     */
    private array $fones;

    /**
     * Construct
     *
     * @param string $name
     */
    public function __construct(
        private string $name,
        private Endereco $endereco,
    )
    {}

    public function addFone(Fone $fone): void {
        $this->fones[] = $fone;
    }

    public function getFone(): array {
        return $this->fones;
    }
}