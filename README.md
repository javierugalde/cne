
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/aasanchez/cne/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/aasanchez/cne/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/aasanchez/cne/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/aasanchez/cne/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/aasanchez/cne/v/stable)](https://packagist.org/packages/aasanchez/cne)
[![Total Downloads](https://poser.pugx.org/aasanchez/cne/downloads)](https://packagist.org/packages/aasanchez/cne)
[![License](https://poser.pugx.org/aasanchez/cne/license)](https://packagist.org/packages/aasanchez/cne)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/b090a912-009b-4b51-a9c0-0095dbdd38da/mini.png)](https://insight.sensiolabs.com/projects/b090a912-009b-4b51-a9c0-0095dbdd38da)
[![StyleCI](https://styleci.io/repos/62661448/shield?branch=master)](https://styleci.io/repos/62661448)

NOT READY FOR PRODUCTION, THIS PACKAGE ITS UNDER DEVELOP

# aasanchez/cne

This Package that allows you to get CNE information in a json format.

## Installation

Add aasanchez/cne as a require dependency in your composer.json file:

```
composer require aasanchez/cne
```

## Usage

Create a CNE Client instance:
```php
use aasanchez\Cne;

$elector = new Cne('V', '5892464');
echo $elector->search().PHP_EOL;
```
