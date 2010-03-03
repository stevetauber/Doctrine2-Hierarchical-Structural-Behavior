<?php

namespace DoctrineExtensions\Hierarchical\NestedSet;

interface NestedSetNodeInfo
{
    public function getLeftValue();
    public function setLeftValue($value);

    public function getRightValue();
    public function setRightValue($value);

    public function getLevel();
    public function setLevel($value);

    public function getRoot();
    public function setRoot($value);

    public function setParent($value);
}