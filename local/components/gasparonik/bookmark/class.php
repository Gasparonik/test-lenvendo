<?php
namespace Gasparonik\Components;

class BookMark extends \CBitrixComponent{

    public function onPrepareComponentParams($params)
    {
        return $params;
    }

    function executeComponent()
    {
        global $APPLICATION;
        if($this->arParams['USER_ID'] <= 0) return;

        $arDefaultUrlTemplates404 = array(
            "list" => "",
            "element" => "#ELEMENT_ID#/",
        );

        $arVariables = array();

        $arUrlTemplates = \CComponentEngine::makeComponentUrlTemplates($arDefaultUrlTemplates404, $this->arParams["SEF_URL_TEMPLATES"]);

        $engine = new \CComponentEngine($this);
        if (\CModule::IncludeModule('iblock'))
        {
            $engine->addGreedyPart("#SECTION_CODE_PATH#");
            $engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
        }
        $componentPage = $engine->guessComponentPath(
            $this->arParams["SEF_FOLDER"],
            $arUrlTemplates,
            $arVariables
        );

        $b404 = false;
        if(!$componentPage)
        {
            $componentPage = "list";
            $b404 = true;
        }

        if($b404 && \CModule::IncludeModule('iblock'))
        {
            $folder404 = str_replace("\\", "/", $this->arParams["SEF_FOLDER"]);
            if ($folder404 != "/")
                $folder404 = "/".trim($folder404, "/ \t\n\r\0\x0B")."/";
            if (substr($folder404, -1) == "/")
                $folder404 .= "index.php";

            if ($folder404 != $APPLICATION->GetCurPage(true))
            {
                \Bitrix\Iblock\Component\Tools::process404(
                    ""
                    ,($this->arParams["SET_STATUS_404"] === "Y")
                    ,($this->arParams["SET_STATUS_404"] === "Y")
                    ,($this->arParams["SHOW_404"] === "Y")
                    ,$this->arParams["FILE_404"]
                );
            }
        }

        $this->arResult = array(
            "FOLDER" => $this->arParams["SEF_FOLDER"],
            "URL_TEMPLATES" => $arUrlTemplates,
            "VARIABLES" => $arVariables,
        );
        
        $this->includeComponentTemplate($componentPage);
    }
}