<?php
namespace Gasparonik\Components;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Web\HttpClient;
use Bitrix\Main\Loader;

class BookmarkAdd extends \CBitrixComponent implements Controllerable {

    public function onPrepareComponentParams($params)
    {
        return $params;
    }


    public function configureActions()
    {
        return [
            'add' => [
                'prefilters' => [],
            ],
            'delete' => [
                'prefilters' => [],
            ]
        ];
    }


    function addAction($data){
        $checkCP1251 = $description = $keywords = $title = [];
        $reason = 'unknown';
        if(Loader::includeModule('iblock')){
            if(\CIBlockElement::GetList(
                false,
                [
                    'IBLOCK_ID' => $data['iblock_id'],
                    '=PROPERTY_' . $data['PROPERTY_LINK'] => $data['link'],
                    'CREATED_BY' => $GLOBALS['USER']->GetID()
                ],
                false,
                false,
                ['ID', 'IBLOCK_ID', 'PROPERTY_' . $data['PROPERTY_LINK']]
            )->Fetch()){
                $reason = 'Element exist';
            }else{
                $httpClient =  new HttpClient();
                if($html = $httpClient->get($data['link'])){
                    if(preg_match('~<head.*>.+</head>~sU', $html, $head)){
                        $html = $head[0];
                        /*favicon*/
                        $domain = parse_url($data['link']);
                        $favicon = $this->getFavicon($domain, $html);
                        preg_match('~<title.*>(.*)</title>~sU', $html, $title);
                        preg_match('~<meta\s+name=[\'"]description[\'"]\s+content=[\'"](.*)[\'"][\s*/]*>~sU', $html, $description);
                        preg_match('~<meta\s+name=[\'"]keywords[\'"]\s+content=[\'"](.*)[\'"][\s*/]*>~sU', $html, $keywords);

                        if(preg_match('~<meta\s+charset=[\'"]windows-1251[\'"][\s*/]*>~sU', $html, $checkCP1251)){
                            $title[1] = iconv('cp1251', 'utf-8', $title[1]);
                            $description[1] = iconv('cp1251', 'utf-8', $description[1]);
                            $keywords[1] = iconv('cp1251', 'utf-8', $keywords[1]);
                        }

                        $CIBlockElement = new \CIBlockElement();
                        $elementId = $CIBlockElement->Add([
                            'IBLOCK_ID' => $data['iblock_id'],
                            'NAME' => $title[1],
                            'CREATED_BY' => $GLOBALS['USER']->GetID(),
                            'PROPERTY_VALUES' => [
                                $data['PROPERTY_LINK'] => $data['link'],
                                $data['PROPERTY_FAVICON'] => \CFile::MakeFileArray($favicon),
                                $data['PROPERTY_DESCRIPTION'] => $description[1],
                                $data['PROPERTY_KEYWORDS'] => $keywords[1],
                                $data['PROPERTY_PASSWORD'] => $data['password'],
                            ],
                        ]);
                        if($elementId){
                            return [
                                'status' => 'success',
                                'url' => $CIBlockElement::GetByID($elementId)->GetNext()['DETAIL_PAGE_URL']
                            ];
                        }else{
                            $reason = $CIBlockElement->LAST_ERROR;
                        }
                    }
                }else{
                    $reason = 'Page not found';
                }
            }
        }else{
            $reason = 'Module iblock not found';
        }


        return [
            'status' => 'error',
            'reason' => $reason
        ];
    }

    function deleteAction($data){
        $status = false;
        $reason = 'Access denied';
        if(Loader::includeModule('iblock')){
            $CIBlockElement = new \CIBlockElement();
            if(
                ($data['id'] > 0) &&
                ($data['iblock_id'] > 0) &&
                ($GLOBALS['USER']->GetID()) &&
                (strlen($data['password']))
            ){
                $element = $CIBlockElement::GetList(false, [
                    'LOGIC' => 'AND',
                    [
                        'ID' => $data['id'],
                        'IBLOCK_ID' => $data['iblock_id'],
                        'PROPERTY_PASSWORD' => $data['password'],
                        'CREATED_BY' => $GLOBALS['USER']->GetID(),
                    ]
                ],
                    false,
                    ['nTopCount' => 1],
                    ['ID']
                )->Fetch();
                if($element['ID']){
                    $status = $CIBlockElement->Delete($element['ID']);
                    $reason = $CIBlockElement->LAST_ERROR;
                }
            }
        }

        return [
            'status' => $status ? 'success' : 'error',
            'reason' => $reason
        ];
    }

    function rel2abs( $rel, $base ) {
        extract( parse_url( $base ) );
        if ( strpos( $rel,"//" ) === 0 ) return $scheme . ':' . $rel;
        if ( parse_url( $rel, PHP_URL_SCHEME ) != '' ) return $rel;
        if ( $rel[0] == '#' or $rel[0] == '?' ) return $base . $rel;
        $path = preg_replace( '#/[^/]*$#', '', $path);
        if ( $rel[0] ==  '/' ) $path = '';
        $abs = $host . $path . "/" . $rel;
        $abs = preg_replace( "/(\/\.?\/)/", "/", $abs);
        $abs = preg_replace( "/\/(?!\.\.)[^\/]+\/\.\.\//", "/", $abs);
        return $scheme . '://' . $abs;
    }

    function getFavicon($domain, $html){
        $favicon = false;
        $regExPattern = '/((<link[^>]+rel=.(icon|shortcut icon|alternate icon)[^>]+>))/i';
        if (@preg_match($regExPattern, $html, $matchTag)) {
            $regExPattern = '/href=(\'|\")(.*?)\1/i';
            if (isset($matchTag[1]) and @preg_match($regExPattern, $matchTag[1], $matchUrl)) {
                if (isset($matchUrl[2])) {
                    $favicon = $this->rel2abs(trim($matchUrl[2]),$domain['scheme'] . '://' . $domain['host'] . '/');
                }
            }
        }

        // Мне повезёт!
        if (empty($favicon)) {
            $favicon = $domain['scheme'] . '://' . $domain['host'] . '/favicon.ico';
        }

        return $favicon;
    }

    function executeComponent()
    {
        $this->arResult = [];
        $bookmarks = \CIBlockElement::GetList(false,
            [
                'CREATED_BY' => $this->arParams['USER_ID'],
                'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            ]
        );
        while ($bookmark = $bookmarks->GetNext()){
            $this->arResult['BOOKMARKS'][] = $bookmark;
        }
        $this->includeComponentTemplate();
    }
}