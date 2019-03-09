# twig-assert
This Twig Language Extension allows to **assert** the type of a view variable that is required for the template to render.

Acting as a **guard-clause** it stops rendering the current templte when the assertion fails.

## Add an assertion
Simply add an type assertion to your template.  
If the assertion fails, the template will not render.

Let's assume a view variable **viewModelTypeA** of type **TypeA**.
```twig
{# test.twig #}
{% assert viewModelTypeA "\\TypeA" %}

{{ some_view_model.getText }}     


{% assert viewModelTypeA "\\TypeB" %}   {# <- rendering stops here #}

{{ other_view_model.getText }}    

```
Right after assertion 2 twig stops rendering the template since the assertion mismatched.
