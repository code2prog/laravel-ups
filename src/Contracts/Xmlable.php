<?php

namespace Rawilk\Ups\Contracts;

use SimpleXMLElement;

interface Xmlable
{
    public function toSimpleXml(?SimpleXMLElement $parent = null, bool $createChild = true): SimpleXMLElement;

    public static function fromXml(SimpleXMLElement $xml): self;
}
