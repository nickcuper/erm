<?php

/**
 * 
 * @method CCache getParent()
 */
class CacheWrapBehavior extends CBehavior
{
    public function wrap($id, $expire, $render, $dependency = null)
    {
        $cache = $this->getOwner();
        /* @var $cache CCache */
        
        if (is_array($id))
            $id = implode('-', $id);
        
        $value = $cache->get($id);
        if ($value === false) {
            $value = $render();
            $cache->set($id, $value, $expire, $dependency);
        }
        
        return $value;
    }
}

/**
 * @method mixed wrap(string $id, integer $expire, callable $render)
 */
//class CCache
//{}
