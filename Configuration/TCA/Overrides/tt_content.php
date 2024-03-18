<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

ExtensionUtility::registerPlugin(
    'SptSocialmedia',
    'Sptsocialmedia',
    'Social Media Widget',
    'EXT:spt_socialmedia/Resources/Public/Icons/Extension.svg'
);

ExtensionManagementUtility::addStaticFile('spt_socialmedia', 'Configuration/TypoScript', 'Social Media Widget');
