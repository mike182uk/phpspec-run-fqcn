#### ⚠️ This project is no longer maintained

# PHPSpec Run FQCN

[![Build Status](https://img.shields.io/travis/mike182uk/phpspec-run-fqcn.svg?style=flat-square)](http://travis-ci.org/mike182uk/phpspec-run-fqcn)
[![Scrutinizer Quality Score](https://img.shields.io/scrutinizer/g/mike182uk/phpspec-run-fqcn.svg?style=flat-square)](https://scrutinizer-ci.com/g/mike182uk/phpspec-run-fqcn/)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f2ef69ca-7903-43db-ac49-14108e067162/mini.png)](https://insight.sensiolabs.com/projects/f2ef69ca-7903-43db-ac49-14108e067162)
[![Total Downloads](https://img.shields.io/packagist/dt/mike182uk/phpspec-run-fqcn.svg?style=flat-square)](https://packagist.org/packages/mike182uk/phpspec-run-fqcn)
[![License](https://img.shields.io/github/license/mike182uk/phpspec-run-fqcn.svg?style=flat-square)](https://packagist.org/packages/mike182uk/phpspec-run-fqcn)

Run a spec for a class using its **F**ully **Q**ualified **C**lass **N**ame.

## Installation

Add this package as a dependency in your `composer.json`.

```json
{
    "require-dev": {
        "mike182uk/phpspec-run-fqcn": "0.1.*"
    }
}
```

Enable the extension in your `phpspec.yml`:

```
extensions:
  - Mdb\PhpSpecRunFQCNExtension\Extension
```

## Usage

```bash
bin/phpspec desc Foo/Bar

bin/phpspec run Foo/Bar # instead of bin/phpspec run spec/Foo/BarSpec.php
```
