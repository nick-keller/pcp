<?php

namespace JE\FinancesBundle\DQL;


use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;

/**
 * SumFunction ::= "SUM" "(" ArithmeticPrimary ")"
 */
class Sum extends FunctionNode
{
    public $date = null;

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->date = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        return 'SUM(' .
        $this->date->dispatch($sqlWalker) .
        ')';
    }
}