<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:spt_socialmedia/Resources/Private/Language/locallang_db.xlf:tx_sptsocialmedia_domain_model_socialmedia',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
		'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
		'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
		'searchFields' => 'title,type,link',
        'iconfile' => 'EXT:spt_socialmedia/Resources/Public/Icons/tx_sptsocialmedia_domain_model_socialmedia.gif'
    ],
    'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, type, link',
    ],
    'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, type, link, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
		'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_sptsocialmedia_domain_model_socialmedia',
                'foreign_table_where' => 'AND tx_sptsocialmedia_domain_model_socialmedia.pid=###CURRENT_PID### AND tx_sptsocialmedia_domain_model_socialmedia.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ]
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                ],
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
        ],
        'title' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:spt_socialmedia/Resources/Private/Language/locallang_db.xlf:tx_sptsocialmedia_domain_model_socialmedia.title',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'type' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:spt_socialmedia/Resources/Private/Language/locallang_db.xlf:tx_sptsocialmedia_domain_model_socialmedia.type',
	        'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', ''],
                    ['Facebook', 'facebook'],
                    ['Google+', 'google-plus'],
                    ['Twitter', 'twitter'],
                    ['LinkedIn', 'linkedin'],
                    ['Xing', 'xing'],
                    ['Pinterest', 'pinterest-p'],
                    ['Youtube', 'youtube'],
                    ['Instagram', 'instagram'],
                    ['Phone', 'phone'],
                    ['E-Mail', 'envelope-o'],
                    ['File', 'file-o'],
                    ['Internal Link', 'link'],
                    ['External Link', 'external-link'],
                ],
                'minitems' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            ],
	    ],
	    'link' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:spt_socialmedia/Resources/Private/Language/locallang_db.xlf:tx_sptsocialmedia_domain_model_socialmedia.link',
	        'config' => [
                'type' => 'link',
                'eval' => 'required'
            ],
	    ],
    ],
];