<?php
defined('TYPO3') or die();

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use SPT\SptSocialmedia\Controller\SocialmediaController;

call_user_func(
    function()
	{
        ExtensionUtility::configurePlugin(
            'SptSocialmedia',
            'Sptsocialmedia',
            [
                
                SocialmediaController::class => 'list'
            ],
            // non-cacheable actions
            [
                SocialmediaController::class => 'list'
            ]
        );
	}
);
