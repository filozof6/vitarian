<?php

namespace Vitarian\ReceptyBundle\Entity;


/**
 * Interface for searchable entities
 */
interface SearchableInterface
{
    

    /**
     * Get string representation of name of the searched entity
     *
     * @param string $title
     * @return string
     */
     public function getSearchName();

    /**
     * Return the string representation of the section from where the
     * searched entity come from (for better user orientation)
     *
     * 
     * @return string
     */
     public function getSearchCategory();
   
}
