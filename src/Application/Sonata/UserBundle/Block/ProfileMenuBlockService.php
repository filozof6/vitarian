<?php
/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Sonata\UserBundle\Block;

use Sonata\UserBundle\Block\ProfileMenuBlockService as BaseService;

/**
 * Class ProfileMenuBlockService
 *
 * @package Sonata\UserBundle\Block
 *
 * @author Hugo Briand <briand@ekino.com>
 */
class ProfileMenuBlockService extends BaseService
{
    protected function getMenu(BlockContextInterface $blockContext)
    {
        $settings = $blockContext->getSettings();
           die("lol0");
        $menu = parent::getMenu($blockContext);

        if (null === $menu || "" === $menu) {
            $menu = $this->menuBuilder->createProfileMenu(
                array(
                    'childrenAttributes' => array('class' => $settings['menu_class']),
                    'attributes'         => array('class' => $settings['children_class']),
                )
            );
            $menu->setCurrentUri($settings['current_uri']);
        }

        return $menu;
    }
}