<?php

namespace Oppodelldog\TwigExtension\Assert;

use Twig_Token;
use Twig_TokenParser;

class AssertTokenParser extends Twig_TokenParser
{
    /**
     * @throws \Twig_Error_Syntax
     */
    public function parse(Twig_Token $token): AssertNode
    {
        $lineNumber = $token->getLine();
        $stream = $this->parser->getStream();

        $viewVariable = $this->parser->getExpressionParser()->parseExpression();
        $expectedType = $this->parser->getExpressionParser()->parseExpression();

        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return new AssertNode($viewVariable, $expectedType, $lineNumber, $this->getTag());
    }

    public function getTag(): string
    {
        return 'assert';
    }
}