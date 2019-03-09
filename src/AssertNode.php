<?php

namespace Oppodelldog\TwigExtension\Assert;

use Twig_Compiler;
use Twig_Node;
use Twig_Node_Expression_Constant;

class AssertNode extends Twig_Node
{
    public function __construct(
        Twig_Node $viewVariable,
        Twig_Node_Expression_Constant $expectedType,
        int $lineno,
        string $tag
    )
    {
        $nodes = [
            'viewVariable' => $viewVariable,
            'expectedType' => $expectedType,
        ];
        parent::__construct($nodes, [], $lineno, $tag);
    }

    /**
     * {@inheritdoc}
     */
    public function compile(Twig_Compiler $compiler)
    {
        $variableName = $this->getNode('viewVariable')->getAttribute('name');
        $expectedFQCN = $this->getNode('expectedType')->getAttribute('value');
        $expectedFQCN = trim($expectedFQCN);
        $expectedFQCN = preg_replace('/\s+/', '', $expectedFQCN);
        $expectedFQCN = str_replace("\\\\", "\\", $expectedFQCN);
        $expectedFQCNClass = $expectedFQCN . "::class";

        $compiler
            ->addDebugInfo($this)
            ->write('if(get_class(')
            ->subcompile($this->getNode('viewVariable'))
            ->raw(')==')
            ->raw($expectedFQCNClass)
            ->raw('){' . "\n")
            ->indent()
            ->write("echo '<!-- assert successful $variableName is of type  $expectedFQCN ({$this->getTemplateName()})-->\n'; \n")
            ->outdent()
            ->write('}' . "\n")
            ->write('else{' . "\n")
            ->indent()
            ->write("echo '<!-- assert mismatch $variableName is not of type  $expectedFQCN ({$this->getTemplateName()})-->\n'; \n")
            ->write("return; \n")
            ->outdent()
            ->write('}' . "\n");
    }
}
