<?php
namespace Helper\Route\Http;

use Helper\DataSet;
use Helper\DataArrayAccessTrait;

class Environment extends DataSet implements \ArrayAccess
{
    use DataArrayAccessTrait;
}