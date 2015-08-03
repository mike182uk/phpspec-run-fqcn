<?php

namespace spec\Mdb\PhpSpecRunFQCNExtension\Locator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FQCNLocatorSpec extends ObjectBehavior
{
    function it_should_be_a_PSR0Locator()
    {
        $this->shouldHaveType('PhpSpec\Locator\PSR0\PSR0Locator');
    }

    function it_should_support_a_query_for_a_FQCN()
    {
        $this->supportsQuery('Foo/Bar/Baz')->shouldReturn(true);
    }

    function it_should_be_priortiy_one()
    {
        $this->getPriority()->shouldReturn(1);
    }
}
