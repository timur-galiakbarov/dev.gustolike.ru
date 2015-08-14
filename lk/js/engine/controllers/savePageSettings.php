<?// подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>
<?
//print_r($_POST);
global $USER;
$arUser=CUser::GetByID($USER->GetID())->GetNext();

if(CModule::IncludeModule("iblock"))
{
    //Сохранение акции
    $el = new CIBlockElement;
    $PROP = array();
    if ($_POST["useVk"] == "on"){//Если ВК активен
        $PROP["IS_VK"] = 1;
        $PROP["VK_GROUP"] = $_POST["vkGroup"];
        $PROP["SCAN_DATE"] =$_POST["vkScanDate"];
    }
    else {
        $PROP["IS_VK"] = "";
        $_POST["moduleVkLike"] = "";
        $_POST["moduleVkRepost"] = "";
        $_POST["moduleVkComment"] = "";
    }
    if ($_POST["useShop"] == "on"){//Если Магазин подарков включен
        $PROP["USE_SHOP"] = 1;
    } else {
        $PROP["USE_SHOP"] = 0;
    }
    $PROP["ADMIN_ID"] = $USER->GetID();
    $arLoadProductArray = Array(
      "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
      "IBLOCK_ID"      => 5,
      "PROPERTY_VALUES"=> $PROP,
      "NAME" => iconv("UTF8","CP1251",$_POST["pageName"]),
      "CODE" => $_POST["pageCode"],
      "PREVIEW_TEXT"   => iconv("UTF8","CP1251",strip_tags($_POST["pageShortDescription"])),
      );

    if($el->Update($_POST["pageId"], $arLoadProductArray))
      $message = array("success"=>"true");
    else
      $message = array("success"=>"fail", "Error"=> $el->LAST_ERROR, "Place"=>"Произошла ошибка в контроллере savePageSettings.php");

    //Подключаем модуль подсчета лайков
    //проверяем на наличие уже подключенного модуля
    $arSelect = Array("ID", "NAME");
    $arFilter = Array("IBLOCK_ID"=>8, "PROPERTY_PAGE_ID"=>$_POST["pageId"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
    $moduleInfo = 0;
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $moduleInfo = $arFields;
        $moduleInfo["flag"] = true;
    }

    $PROP["BALL_SIZE"] = $_POST["vkBallForLike"];
    $PROP["PAGE_ID"] = $_POST["pageId"];
    $arLoadProductArray = Array(
      "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
      "IBLOCK_ID"      => 8,
      "PROPERTY_VALUES"=> $PROP,
      );
    if ($_POST["moduleVkLike"] == "on"){//Если модуль подсчета лайков активен
        if ($moduleInfo["flag"] == true){//Обновляем данные текущих параметров
            if($el->Update($moduleInfo["ID"], $arLoadProductArray))
                $message += array("successModuleVkLikeUpdate"=>"true");
            else
                $message += array("successModuleVkLikeUpdate"=>"fail", "ErrorModuleVkLike"=> $el->LAST_ERROR, "Place1"=>"Произошла ошибка в контроллере savePageSettings.php, функция обновления модуля лайков ВК");
        } else {//Создаем новый элемент инфоблока с параметрами модуля
            $arLoadProductArray["NAME"] = "Модуль подсчета лайков для акции ".iconv("UTF8","CP1251",$_POST["pageName"]);
            if($el->Add($arLoadProductArray))
                $message += array("successModuleVkLikeAdd"=>"true");
            else
                $message += array("successModuleVkLikeAdd"=>"fail", "ErrorModuleVkLike"=> $el->LAST_ERROR, "Place1"=>"Произошла ошибка в контроллере savePageSettings.php, функция обновления модуля лайков ВК");
        }
    } else {
        $DB->StartTransaction();
        if(!CIBlockElement::Delete($moduleInfo["ID"]))
        {
            $DB->Rollback();
        }
        else
            $DB->Commit();
    }

    //Подключаем модуль подсчета репостов
    //проверяем на наличие уже подключенного модуля
    $arSelect = Array("ID", "NAME");
    $arFilter = Array("IBLOCK_ID"=>9, "PROPERTY_PAGE_ID"=>$_POST["pageId"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
    $moduleInfo = 0;
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $moduleInfo = $arFields;
        $moduleInfo["flag"] = true;
    }

    $PROP["BALL_SIZE"] = $_POST["vkBallForRepost"];
    $PROP["PAGE_ID"] = $_POST["pageId"];
    $arLoadProductArray = Array(
      "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
      "IBLOCK_ID"      => 9,
      "PROPERTY_VALUES"=> $PROP,
      );
    if ($_POST["moduleVkRepost"] == "on"){//Если модуль подсчета репостов активен
        if ($moduleInfo["flag"] == true){//Обновляем данные текущих параметров
            if($el->Update($moduleInfo["ID"], $arLoadProductArray))
                $message += array("successModuleVkRepostUpdate"=>"true");
            else
                $message += array("successModuleVkRepostUpdate"=>"fail", "ErrorModuleVkRepost"=> $el->LAST_ERROR, "Place1"=>"Произошла ошибка в контроллере savePageSettings.php, функция обновления модуля репостов ВК");
        } else {//Создаем новый элемент инфоблока с параметрами модуля
            $arLoadProductArray["NAME"] = "Модуль подсчета репостов для акции ".iconv("UTF8","CP1251",$_POST["pageName"]);
            if($el->Add($arLoadProductArray))
                $message += array("successModuleVkRepostAdd"=>"true");
            else
                $message += array("successModuleVkRepostAdd"=>"fail", "ErrorModuleVkRepost"=> $el->LAST_ERROR, "Place1"=>"Произошла ошибка в контроллере savePageSettings.php, функция добавления модуля репостов ВК");
        }
    } else {
        $DB->StartTransaction();
        if(!CIBlockElement::Delete($moduleInfo["ID"]))
        {
            $DB->Rollback();
        }
        else{
            $DB->Commit();
        }
    }

    print_r(json_encode($message));


}
?>
<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>