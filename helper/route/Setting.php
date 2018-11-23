<?php
namespace Helper\Route;

use Helper\DataSet;
use Helper\DataArrayAccessTrait;

class Setting extends DataSet implements \ArrayAccess
{
    use DataArrayAccessTrait;
}