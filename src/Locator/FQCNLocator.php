<?php

namespace Mdb\PhpSpecRunFQCNExtension\Locator;

use PhpSpec\Locator\PSR0\PSR0Locator;

class FQCNLocator extends PSR0Locator
{
    /**
     * {@inheritdoc}
     */
    public function findResources($query)
    {
        $srcFilePath = $this->getFullSrcPath();
        $srcFilePath .= str_replace(
            str_replace('\\', '/', $this->getSrcNamespace()),
            '',
            $query
        );
        $srcFilePath .= '.php';
        $srcFilePath = str_replace('\\', '/', $srcFilePath);

        $specFilePath = $this->getFullSpecPath().substr($srcFilePath, strlen($this->getFullSrcPath()));
        $specFilePath = preg_replace('/\.php/', 'Spec.php', $specFilePath);

        return $this->findSpecResources($specFilePath);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsQuery($query)
    {
        return preg_match('#^[A-Za-z0-9\/]+$#', $query) === 1;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return 1;
    }
}
