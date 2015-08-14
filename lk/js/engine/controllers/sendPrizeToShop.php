<?// подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>
<?
//print_r($_FILES);
//print_r($_POST);
global $USER;
$arUser=CUser::GetByID($USER->GetID())->GetNext();

if(CModule::IncludeModule("iblock"))
{
    //Сохранение акции
    $el = new CIBlockElement;
    $PROP = array();
    $PROP["PAGE_ID"] = $_POST["activePage"];
    $PROP["COST"] = $_POST["cost"];
    $PROP["COUNT"] = $_POST["count"];

    $arLoadProductArray = Array(
      "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
      "IBLOCK_ID"      => 6,
      "PROPERTY_VALUES"=> $PROP,
      "NAME" => iconv("UTF8","CP1251",$_POST["name"]),
      "PREVIEW_TEXT"   => iconv("UTF8","CP1251",strip_tags($_POST["description"])),
      "PREVIEW_PICTURE"   => $_FILES["image"],
      );
    if (!$_POST["id"]){//Добавление элемента
        if($productID = $el->Add($arLoadProductArray)){
            $arIBlockElement = GetIBlockElement($productID, 'pages');

            $message = array(
                "success" =>"true",
                "id" => $arIBlockElement["ID"],
                "name" => iconv("CP1251","UTF8",$arIBlockElement["NAME"]),
                "description" => iconv("CP1251","UTF8",$arIBlockElement["PREVIEW_TEXT"]),
                "cost" => iconv("CP1251","UTF8",$arIBlockElement["PROPERTIES"]["COST"]["VALUE"]),
                "count" => iconv("CP1251","UTF8",$arIBlockElement["PROPERTIES"]["COUNT"]["VALUE"]),
                "image" => CFILE::GetPath($arIBlockElement["PREVIEW_PICTURE"]),
            );
        }
        else
          $message = array("success"=>"fail", "Error"=> $el->LAST_ERROR, "Place"=>"Произошла ошибка в контроллере savePageSettings.php");
    } else {//Обновление элемента
        if($productID = $el->Update($_POST["id"], $arLoadProductArray)){
            $arIBlockElement = GetIBlockElement($_POST["id"], 'pages');

            $message = array(
                "success" =>"true",
                "id" => $arIBlockElement["ID"],
                "name" => iconv("CP1251","UTF8",$arIBlockElement["NAME"]),
                "description" => iconv("CP1251","UTF8",$arIBlockElement["PREVIEW_TEXT"]),
                "cost" => iconv("CP1251","UTF8",$arIBlockElement["PROPERTIES"]["COST"]["VALUE"]),
                "count" => iconv("CP1251","UTF8",$arIBlockElement["PROPERTIES"]["COUNT"]["VALUE"]),
                "image" => CFILE::GetPath($arIBlockElement["PREVIEW_PICTURE"]),
            );
        }
        else
          $message = array("success"=>"fail", "Error"=> $el->LAST_ERROR, "Place"=>"Произошла ошибка в контроллере savePageSettings.php");
    }
}
echo json_encode($message);
?>
<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>