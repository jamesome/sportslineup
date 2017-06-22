<?
$root_path = $_SERVER['DOCUMENT_ROOT'];

    $lib_root_path = $root_path.'/lib/SE2.8.2/sample/viewer/';
    $lib_path = '/lib/SE2.8.2/sample/viewer';

//https://gist.github.com/kijin/5829736
// 웹사이트에서 다운받아 적당한 곳에 압축 푸세요.
require_once $lib_root_path.'htmlpurifier/HTMLPurifier.standalone.php';

// 기본 설정을 불러온 후 적당히 커스터마이징을 해줍니다.
$config = HTMLPurifier_Config::createDefault();
$config->set('Attr.EnableID', false);
$config->set('Attr.DefaultImageAlt', '');

// 인터넷 주소를 자동으로 링크로 바꿔주는 기능
$config->set('AutoFormat.Linkify', true);

// 이미지 크기 제한 해제 (한국에서 많이 쓰는 웹툰이나 짤방과 호환성 유지를 위해)
$config->set('HTML.MaxImgLength', null);
$config->set('CSS.MaxImgLength', null);

// 다른 인코딩 지원 여부는 확인하지 않았습니다. EUC-KR인 경우 iconv로 UTF-8 변환후 사용하시는 게 좋습니다.
$config->set('Core.Encoding', 'UTF-8');

// 필요에 따라 DOCTYPE 바꿔쓰세요.
$config->set('HTML.Doctype', 'XHTML 1.0 Transitional');

// 플래시 삽입 허용
$config->set('HTML.FlashAllowFullScreen', true);
$config->set('HTML.SafeEmbed', true);
$config->set('HTML.SafeIframe', true);
$config->set('HTML.SafeObject', true);
$config->set('Output.FlashCompat', true);

// 최근 많이 사용하는 iframe 동영상 삽입 허용
$config->set('URI.SafeIframeRegexp', '#^(?:https?:)?//(?:'.implode('|', array(
    'www\\.youtube(?:-nocookie)?\\.com/',
    'maps\\.google\\.com/',
    'player\\.vimeo\\.com/video/',
    'www\\.microsoft\\.com/showcase/video\\.aspx',
    '(?:serviceapi\\.nmv|player\\.music)\\.naver\\.com/',
    '(?:api\\.v|flvs|tvpot|videofarm)\\.daum\\.net/',
    'v\\.nate\\.com/',
    'play\\.mgoon\\.com/',
    'channel\\.pandora\\.tv/',
    'www\\.tagstory\\.com/',
    'play\\.pullbbang\\.com/',
    'tv\\.seoul\\.go\\.kr/',
    'ucc\\.tlatlago\\.com/',
    'vodmall\\.imbc\\.com/',
    'www\\.musicshake\\.com/',
    'www\\.afreeca\\.com/player/Player\\.swf',
    'static\\.plaync\\.co\\.kr/',
    'video\\.interest\\.me/',
    'player\\.mnet\\.com/',
    'sbsplayer\\.sbs\\.co\\.kr/',
    'img\\.lifestyler\\.co\\.kr/',
    'c\\.brightcove\\.com/',
    'www\\.slideshare\\.net/',
)).')#');

// 설정을 저장하고 필터링 라이브러리 초기화
$purifier = new HTMLPurifier($config);

// HTML 필터링 실행
$html = $purifier->purify($html);
?>