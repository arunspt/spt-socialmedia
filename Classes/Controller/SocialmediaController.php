<?php
namespace SPT\SptSocialmedia\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\LinkHandling\LinkService;
use SPT\SptSocialmedia\Domain\Repository\SocialmediaRepository;

/***
 *
 * This file is part of the "Social Media Widget" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021 Arun Chandran <arun@spawoz.com>, Spawoz Technologies Pvt. Ltd
 *
 ***/

/**
 * SocialmediaController
 */
class SocialmediaController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
    * socialmediaRepository
    * 
    * @var socialmediaRepository
    */
    protected $socialmediaRepository = null;
   
   /**
    * @param SocialmediaRepository $socialmediaRepository
    */
    public function injectBookEditionRepository(SocialmediaRepository $socialmediaRepository)
    {
        $this->socialmediaRepository = $socialmediaRepository; 
    }

    /**
     * action list
     *
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        $socialicons = null;
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $linkService = GeneralUtility::makeInstance(LinkService::class);
        $rootPageID = $GLOBALS['TSFE']->rootLine[0]['uid'];
        $socialmedias = $this->socialmediaRepository->findAll();
        foreach ($socialmedias as $key => $value) {
            $linkData = explode(' ', $value->getLink());
            $target = isset($linkData[1]) ? $linkData[1] : '_self';
            if( $value->getType() != 'phone'  && $value->getType() != 'envelope-o' && $value->getType() != 'file-o' && $value->getType() != 'link' ) {
                if (!preg_match("~^(?:f|ht)tps?://~i", $linkData[0])) {                
                    $linkData[0] = "http://" . $linkData[0];                
                }
            } elseif ($value->getType() == 'link') {
                $linkInfo = $linkService->resolve($linkData[0]);
                $linkData[0] = $this->uriBuilder->reset()->setTargetPageUid((int)$linkInfo['pageuid'])->build ();
            } elseif ($value->getType() == 'file-o') {
                $fileInfo = $linkService->resolve($linkData[0]);
                $linkData[0] = '/fileadmin'.$fileInfo['file']->getIdentifier();
            }

            if (isset($target)) {
                $socialicons .= "'".$value->getType()."': { class: '".$value->getType()."', use: true, link: '".$linkData[0]."', extras: 'target=_blank', title: '".$value->getTitle()."'},";
            } else {
                $socialicons .= "'".$value->getType()."': { class: '".$value->getType()."', use: true, link: '".$linkData[0]."', title: '".$value->getTitle()."'},";
            }            
        }

        $extPath = PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath($this->request->getControllerExtensionKey()));
        $socialmediaAttributes = "
            $(document).ready(function(){
                $.contactButtons({
                  effect  : 'slide-on-scroll',
                  buttons : {".$socialicons."}
                });
            });            
        ";
        $pageRenderer->addFooterData('<script type="text/javascript">'.$socialmediaAttributes.'</script>');
        $this->view->assignMultiple([
            'socialmedias' => $socialmedias,
            'settings' => $this->settings
        ]);

        return $this->htmlResponse();
    }
}
