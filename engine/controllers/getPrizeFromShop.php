<?// подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>

<?
function utf8_encode_all($dat) // -- It returns $dat encoded to UTF8
{
  if (is_string($dat)) return iconv("CP1251","UTF8",$dat);
  if (!is_array($dat)) return $dat;
  $ret = array();
  foreach($dat as $i=>$d) $ret[$i] = utf8_encode_all($d);
  return $ret;
}
//Получение вознаграждения из БД
if(CModule::IncludeModule('iblock') && ($arIBlockElement = GetIBlockElement($_POST["id"], 'pages')))
{
    if ($arIBlockElement["PROPERTIES"]["PAGE_ID"]["VALUE"] == $_POST["activePage"]){
        $message = Array("success"=>true, utf8_encode_all($arIBlockElement), "PREVIEW_PICTURE"=>CFILE::GetPath($arIBlockElement["PREVIEW_PICTURE"]));
    } else {
        $message = Array("success"=>false);
    }
}
?>

<?echo json_encode($message);?>

<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>