<?php
$lang_default = "en";
$lang_available = array("ca", "en", "es", "it", "pt-br");
/**
     * Checking HTTP-Header for language
     * needed for various system classes
     *
     * @return    boolean    true/false
     */
    function checkClientLanguage()
    {   
        $langcode = (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '';
        $langcode = (!empty($langcode)) ? explode(";", $langcode) : $langcode;
        $langcode = (!empty($langcode[0])) ? explode(",", $langcode[0]) : $langcode;
        return $langcode[0];
    }

$result = checkClientLanguage();

if ($result == null) { // No language selected
	$lang = $lang_default;
} elseif (in_array($result, $lang_available)) { // Matches full language code, e.g., en-us, es-es, pt-br, etc.
	$lang = $result;
} else { // It does not match full language code
	$lang = (!empty($result[0])) ? explode("-", $result) : $result;
	$lang = $lang[0];
	if (! in_array($lang, $lang_available)) { // It does not match language code, e.g., en, es, pt
		$lang = $lang_default;
	}
	// else => $lang = $lang
}

header("Location: $lang/");

?>
