<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/pages/([\\w\\d_-]+)#",
		"RULE" => "ELEMENT_CODE=\$1&\$2",
		"ID" => "",
		"PATH" => "/pages/detail.php",
	),
	array(
		"CONDITION" => "#^/services/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/services/index.php",
	),
	array(
		"CONDITION" => "#^/products/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/products/index.php",
	),
	array(
		"CONDITION" => "#^/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/index.php",
	),
);

?>