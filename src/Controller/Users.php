<?php

namespace Celso\Environment\Controller;

class Users {

    private string $name;
    /**
     * @param string $name
     */
    public function __construct(
        string $name
    ){
        $this->name = $name;
    }

    /**
     * Get user name.
     *
     * @return string
     *   The user name.
     */
    public function getName(): string {
        return $this->name;
    }
}
