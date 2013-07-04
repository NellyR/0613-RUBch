<?php
$url = ((!empty($_SERVER['HTTPS'])) ? "https://": "http://" ) . $_SERVER['SERVER_NAME'];
$dir = explode("/", $_SERVER["PHP_SELF"]); 
array_shift($dir);
array_pop($dir);
$dir = "/".implode("/", $dir)."/";

// CONFIG
define(K_URL, $url);
define(K_URL_DIR, K_URL);
define(K_URL_DIR_CURRENT, K_URL.$dir);
define(K_URL_FILE, K_URL.$_SERVER['REQUEST_URI']);
define(K_URL_IMG, "assets/img/");
define(K_URL_CSS, "assets/css/");
define(K_URL_ICONS, "assets/icons/");
define(K_URL_JS, "assets/js/");
define(K_URL_AJAX, "assets/ajax/");
define(K_URL_SLIDER, "assets/slider/");

define(K_URL_HOME, K_URL_DIR);
define(K_URL_CAMPAGNE, K_URL_DIR."campagne.php");
define(K_URL_MESSAGE, K_URL_DIR."message.php");

define(K_LOGO, "logo.png");
define(K_TITLE, "Rencontreunebete.ch");
define(K_DESC, "Les plus belles rencontres se font sur rencontreunebete.ch. Que vous les aimiez poilus, joueurs ou bien dress&eacute;s, trouvez votre compagnon en un clic.");
define(K_KEYWORDS, "SPA, animaux");
define(K_HUMANS, "humans.txt");

define(K_SITE_NAME, "Rencontreunebete.ch");
define(K_SITE_URL, K_URL);

define(K_OG_TITLE, "Je les aime tr&egrave;s poilus.");
define(K_OG_URL, K_URL_HOME);
define(K_OG_IMG, "logo_mini4.jpg");
define(K_OG_DESC, K_DESC);
define(K_OG_SITENAME, K_TITLE);

// EXT
define(K_URL_EXT_SPA_GENEVE, "http://www.sgpa.ch/");
define(K_URL_EXT_SHORT, "http://goo.gl/8Lxp8");
define(K_URL_EXT_FB_COUNT_SHARE, "http://graph.facebook.com/");
define(K_URL_EXT_TW_COUNT_SHARE, "http://urls.api.twitter.com/1/urls/count.json");
define(K_URL_EXT_FB_SHARE, "https://www.facebook.com/sharer/sharer.php");
define(K_URL_EXT_TW_SHARE, "https://twitter.com/share");
define(K_URL_EXT_SEO_CANDY_SHARE, "http://api.seocandy.co.uk/socialsignal/");
?>