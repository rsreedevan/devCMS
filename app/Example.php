<?php 

namespace App;

class Example {

    private $collaborator;
    public $foo;

    function __construct(Collaborator $collaborator, $foo)
    {
        $this->collaborator = $collaborator;
    }

}