<?php

declare(strict_types = 1);

/**
 * Nameless utilities
 *
 * @package   Nameless utilities
 * @copyright Copyright 2015, Corpsee.
 * @license   https://github.com/corpsee/nameless-utilities/blob/master/LICENSE
 * @link      https://github.com/corpsee/nameles-utilities
 */

namespace Nameless\Utilities;

/**
 * Class StringHelper
 *
 * @author Corpsee <poisoncorpsee@gmail.com>
 */
class StringHelper
{
    /**
     * @param string $haystack
     * @param string $needle
     *
     * @return boolean
     */
    public static function startWith(string $haystack, string $needle): bool
    {
        return ($needle === mb_substr($haystack, 0, mb_strlen($needle, 'UTF-8'), 'UTF-8'));
    }

    /**
     * @param string $haystack
     * @param string $needle
     *
     * @return boolean
     */
    public static function endWith(string $haystack, string $needle): bool
    {
        return ($needle === mb_substr($haystack, -mb_strlen($needle, 'UTF-8'), null, 'UTF-8'));
    }

    /**
     * @param string $haystack
     * @param string $needle
     *
     * @return boolean
     */
    public static function contains(string $haystack, string $needle): bool
    {
        return mb_strpos($haystack, $needle, 0, 'UTF-8') !== false;
    }

    /**
     * @param string  $string
     * @param integer $limit
     * @param string  $append
     *
     * @return string
     */
    public static function cut(string $string, int $limit = 25, string $append = '...'): string
    {
        if (mb_strlen($string, 'UTF-8') <= $limit) {
            return $string;
        }

        return rtrim(mb_substr($string, 0, $limit, 'UTF-8')) . $append;
    }

    /**
     * @param string  $string
     * @param integer $limit
     * @param string  $append
     *
     * @return string
     */
    public static function cutWords(string $string, int $limit = 25, string $append = '...'): string
    {
        preg_match('/^\s*+(?:\S++\s*+){1,' . $limit . '}/u', $string, $matches);
        if (!isset($matches[0]) || mb_strlen($string, 'UTF-8') === mb_strlen($matches[0], 'UTF-8')) {
            return $string;
        }

        return rtrim($matches[0]) . $append;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function transliterate(string $string): string
    {
        $transliterate_table = [
            // Lower accents
            'à' => 'a', 'ô' => 'o', 'ď' => 'd', 'ḟ' => 'f', 'ë' => 'e', 'š' => 's', 'ơ' => 'o', 'ß' => 'ss', 'ă' => 'a',
            'ř' => 'r', 'ț' => 't', 'ň' => 'n', 'ā' => 'a', 'ķ' => 'k', 'ŝ' => 's', 'ỳ' => 'y', 'ņ' => 'n', 'ĺ' => 'l',
            'ħ' => 'h', 'ṗ' => 'p', 'ó' => 'o', 'ú' => 'u', 'ě' => 'e', 'é' => 'e', 'ç' => 'c', 'ẁ' => 'w', 'ċ' => 'c',
            'õ' => 'o', 'ṡ' => 's', 'ø' => 'o', 'ģ' => 'g', 'ŧ' => 't', 'ș' => 's', 'ė' => 'e', 'ĉ' => 'c', 'ś' => 's',
            'î' => 'i', 'ű' => 'u', 'ć' => 'c', 'ę' => 'e', 'ŵ' => 'w', 'ṫ' => 't', 'ū' => 'u', 'č' => 'c', 'ö' => 'oe',
            'è' => 'e', 'ŷ' => 'y', 'ą' => 'a', 'ł' => 'l', 'ų' => 'u', 'ů' => 'u', 'ş' => 's', 'ğ' => 'g', 'ļ' => 'l',
            'ƒ' => 'f', 'ž' => 'z', 'ẃ' => 'w', 'ḃ' => 'b', 'å' => 'a', 'ì' => 'i', 'ï' => 'i', 'ḋ' => 'd', 'ť' => 't',
            'ŗ' => 'r', 'ä' => 'ae', 'í' => 'i', 'ŕ' => 'r', 'ê' => 'e', 'ü' => 'ue', 'ò' => 'o', 'ē' => 'e',
            'ñ' => 'n', 'ń' => 'n', 'ĥ' => 'h', 'ĝ' => 'g', 'đ' => 'd', 'ĵ' => 'j', 'ÿ' => 'y', 'ũ' => 'u', 'ŭ' => 'u',
            'ư' => 'u', 'ţ' => 't', 'ý' => 'y', 'ő' => 'o', 'â' => 'a', 'ľ' => 'l', 'ẅ' => 'w', 'ż' => 'z', 'ī' => 'i',
            'ã' => 'a', 'ġ' => 'g', 'ṁ' => 'm', 'ō' => 'o', 'ĩ' => 'i', 'ù' => 'u', 'į' => 'i', 'ź' => 'z', 'á' => 'a',
            'û' => 'u', 'þ' => 'th', 'ð' => 'dh', 'æ' => 'ae', 'µ' => 'u', 'ĕ' => 'e',

            // Upper accents
            'À' => 'A', 'Ô' => 'O', 'Ď' => 'D', 'Ḟ' => 'F', 'Ë' => 'E', 'Š' => 'S', 'Ơ' => 'O', 'Ă' => 'A', 'Ř' => 'R',
            'Ț' => 'T', 'Ň' => 'N', 'Ā' => 'A', 'Ķ' => 'K', 'Ŝ' => 'S', 'Ỳ' => 'Y', 'Ņ' => 'N', 'Ĺ' => 'L', 'Ħ' => 'H',
            'Ṗ' => 'P', 'Ó' => 'O', 'Ú' => 'U', 'Ě' => 'E', 'É' => 'E', 'Ç' => 'C', 'Ẁ' => 'W', 'Ċ' => 'C', 'Õ' => 'O',
            'Ṡ' => 'S', 'Ø' => 'O', 'Ģ' => 'G', 'Ŧ' => 'T', 'Ș' => 'S', 'Ė' => 'E', 'Ĉ' => 'C', 'Ś' => 'S', 'Î' => 'I',
            'Ű' => 'U', 'Ć' => 'C', 'Ę' => 'E', 'Ŵ' => 'W', 'Ṫ' => 'T', 'Ū' => 'U', 'Č' => 'C', 'Ö' => 'Oe', 'È' => 'E',
            'Ŷ' => 'Y', 'Ą' => 'A', 'Ł' => 'L', 'Ų' => 'U', 'Ů' => 'U', 'Ş' => 'S', 'Ğ' => 'G', 'Ļ' => 'L', 'Ƒ' => 'F',
            'Ž' => 'Z', 'Ẃ' => 'W', 'Ḃ' => 'B', 'Å' => 'A', 'Ì' => 'I', 'Ï' => 'I', 'Ḋ' => 'D', 'Ť' => 'T', 'Ŗ' => 'R',
            'Ä' => 'Ae', 'Í' => 'I', 'Ŕ' => 'R', 'Ê' => 'E', 'Ü' => 'Ue', 'Ò' => 'O', 'Ē' => 'E', 'Ñ' => 'N',
            'Ń' => 'N', 'Ĥ' => 'H', 'Ĝ' => 'G', 'Đ' => 'D', 'Ĵ' => 'J', 'Ÿ' => 'Y', 'Ũ' => 'U', 'Ŭ' => 'U', 'Ư' => 'U',
            'Ţ' => 'T', 'Ý' => 'Y', 'Ő' => 'O', 'Â' => 'A', 'Ľ' => 'L', 'Ẅ' => 'W', 'Ż' => 'Z', 'Ī' => 'I', 'Ã' => 'A',
            'Ġ' => 'G', 'Ṁ' => 'M', 'Ō' => 'O', 'Ĩ' => 'I', 'Ù' => 'U', 'Į' => 'I', 'Ź' => 'Z', 'Á' => 'A', 'Û' => 'U',
            'Þ' => 'Th', 'Ð' => 'Dh', 'Æ' => 'Ae', 'Ĕ' => 'E',

            // Russian cyrillic
            'а' => 'a', 'А' => 'A', 'б' => 'b', 'Б' => 'B', 'в' => 'v', 'В' => 'V', 'г' => 'g', 'Г' => 'G', 'д' => 'd',
            'Д' => 'D', 'е' => 'e', 'Е' => 'E', 'ё' => 'jo', 'Ё' => 'Jo', 'ж' => 'zh', 'Ж' => 'Zh', 'з' => 'z',
            'З' => 'Z', 'и' => 'i', 'И' => 'I', 'й' => 'j', 'Й' => 'J', 'к' => 'k', 'К' => 'K', 'л' => 'l', 'Л' => 'L',
            'м' => 'm', 'М' => 'M', 'н' => 'n', 'Н' => 'N', 'о' => 'o', 'О' => 'O', 'п' => 'p', 'П' => 'P', 'р' => 'r',
            'Р' => 'R', 'с' => 's', 'С' => 'S', 'т' => 't', 'Т' => 'T', 'у' => 'u', 'У' => 'U', 'ф' => 'f', 'Ф' => 'F',
            'х' => 'x', 'Х' => 'X', 'ц' => 'c', 'Ц' => 'C', 'ч' => 'ch', 'Ч' => 'Ch', 'ш' => 'sh', 'Ш' => 'Sh',
            'щ' => 'sch', 'Щ' => 'Sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'Y', 'ь' => '', 'Ь' => '', 'э' => 'eh',
            'Э' => 'Eh', 'ю' => 'ju', 'Ю' => 'Ju', 'я' => 'ja', 'Я' => 'Ja',

            // Ukrainian cyrillic
            'Ґ' => 'Gh', 'ґ' => 'gh', 'Є' => 'Je', 'є' => 'je', 'І' => 'I', 'і' => 'i', 'Ї' => 'Ji', 'ї' => 'ji',

            // Georgian
            'ა' => 'a', 'ბ' => 'b', 'გ' => 'g', 'დ' => 'd', 'ე' => 'e', 'ვ' => 'v', 'ზ' => 'z', 'თ' => 'th', 'ი' => 'i',
            'კ' => 'p', 'ლ' => 'l', 'მ' => 'm', 'ნ' => 'n', 'ო' => 'o', 'პ' => 'p', 'ჟ' => 'zh', 'რ' => 'r', 'ს' => 's',
            'ტ' => 't', 'უ' => 'u', 'ფ' => 'ph', 'ქ' => 'kh', 'ღ' => 'gh', 'ყ' => 'q', 'შ' => 'sh', 'ჩ' => 'ch',
            'ც' => 'c', 'ძ' => 'dh', 'წ' => 'w', 'ჭ' => 'j', 'ხ' => 'x', 'ჯ' => 'jh', 'ჰ' => 'xh',

            // Sanskrit
            'अ' => 'a', 'आ' => 'ah', 'इ' => 'i', 'ई' => 'ih', 'उ' => 'u', 'ऊ' => 'uh', 'ऋ' => 'ry', 'ॠ' => 'ryh',
            'ऌ' => 'ly', 'ॡ' => 'lyh', 'ए' => 'e', 'ऐ' => 'ay', 'ओ' => 'o', 'औ' => 'aw', 'अं' => 'amh', 'अः' => 'aq',
            'क' => 'k', 'ख' => 'kh', 'ग' => 'g', 'घ' => 'gh', 'ङ' => 'nh', 'च' => 'c', 'छ' => 'ch', 'ज' => 'j',
            'झ' => 'jh', 'ञ' => 'ny', 'ट' => 'tq', 'ठ' => 'tqh', 'ड' => 'dq', 'ढ' => 'dqh', 'ण' => 'nq', 'त' => 't',
            'थ' => 'th', 'द' => 'd', 'ध' => 'dh', 'न' => 'n', 'प' => 'p', 'फ' => 'ph', 'ब' => 'b', 'भ' => 'bh',
            'म' => 'm', 'य' => 'z', 'र' => 'r', 'ल' => 'l', 'व' => 'v', 'श' => 'sh', 'ष' => 'sqh', 'स' => 's',
            'ह' => 'x',

            // Hebrew
            'א' => 'a', 'ב' => 'b', 'ג' => 'g', 'ד' => 'd', 'ה' => 'h', 'ו' => 'v', 'ז' => 'z', 'ח' => 'kh',
            'ט' => 'th', 'י' => 'y', 'ך' => 'h', 'כ' => 'k', 'ל' => 'l', 'ם' => 'm', 'מ' => 'm', 'ן' => 'n', 'נ' => 'n',
            'ס' => 's', 'ע' => 'ah', 'ף' => 'f', 'פ' => 'p', 'ץ' => 'c', 'צ' => 'c', 'ק' => 'q', 'ר' => 'r',
            'ש' => 'sh', 'ת' => 't',

            // Arabic
            'ا' => 'a', 'ب' => 'b', 'ت' => 't', 'ث' => 'th', 'ج' => 'g', 'ح' => 'xh', 'خ' => 'x', 'د' => 'd',
            'ذ' => 'dh', 'ر' => 'r', 'ز' => 'z', 'س' => 's', 'ش' => 'sh', 'ص' => 's\'', 'ض' => 'd\'', 'ط' => 't\'',
            'ظ' => 'z\'', 'ع' => 'y', 'غ' => 'gh', 'ف' => 'f', 'ق' => 'q', 'ك' => 'k', 'ل' => 'l', 'م' => 'm',
            'ن' => 'n', 'ه' => 'x\'', 'و' => 'u', 'ي' => 'i',

            // Persian
            'ک' => 'k', 'گ' => 'g', 'پ' => 'p', 'ژ' => 'zh', 'ی' => 'i', 'چ' => 'ch',

            // Japanese hiragana
            'あ' => 'a', 'え' => 'e', 'い' => 'i', 'お' => 'o', 'う' => 'u', 'ば' => 'ba', 'べ' => 'be', 'び' => 'bi',
            'ぼ' => 'bo', 'ぶ' => 'bu', 'し' => 'ci', 'だ' => 'da', 'で' => 'de', 'ぢ' => 'di', 'ど' => 'do', 'づ' => 'du',
            'ふぁ' => 'fa', 'ふぇ' => 'fe', 'ふぃ' => 'fi', 'ふぉ' => 'fo', 'ふ' => 'fu', 'が' => 'ga', 'げ' => 'ge',
            'ぎ' => 'gi', 'ご' => 'go', 'ぐ' => 'gu', 'は' => 'ha', 'へ' => 'he', 'ひ' => 'hi', 'ほ' => 'ho', 'ふ' => 'hu',
            'じゃ' => 'ja', 'じぇ' => 'je', 'じ' => 'ji', 'じょ' => 'jo', 'じゅ' => 'ju', 'か' => 'ka', 'け' => 'ke',
            'き' => 'ki', 'こ' => 'ko', 'く' => 'ku', 'ら' => 'la', 'れ' => 'le', 'り' => 'li', 'ろ' => 'lo', 'る' => 'lu',
            'ま' => 'ma', 'め' => 'me', 'み' => 'mi', 'も' => 'mo', 'む' => 'mu', 'な' => 'na', 'ね' => 'ne', 'に' => 'ni',
            'の' => 'no', 'ぬ' => 'nu', 'ぱ' => 'pa', 'ぺ' => 'pe', 'ぴ' => 'pi', 'ぽ' => 'po', 'ぷ' => 'pu', 'ら' => 'ra',
            'れ' => 're', 'り' => 'ri', 'ろ' => 'ro', 'る' => 'ru', 'さ' => 'sa', 'せ' => 'se', 'し' => 'si', 'そ' => 'so',
            'す' => 'su', 'た' => 'ta', 'て' => 'te', 'ち' => 'ti', 'と' => 'to', 'つ' => 'tu', 'ヴぁ' => 'va',
            'ヴぇ' => 've', 'ヴぃ' => 'vi', 'ヴぉ' => 'vo', 'ヴ' => 'vu', 'わ' => 'wa', 'うぇ' => 'we', 'うぃ' => 'wi',
            'を' => 'wo', 'や' => 'ya', 'いぇ' => 'ye', 'い' => 'yi', 'よ' => 'yo', 'ゆ' => 'yu', 'ざ' => 'za',
            'ぜ' => 'ze', 'じ' => 'zi', 'ぞ' => 'zo', 'ず' => 'zu', 'びゃ' => 'bya', 'びぇ' => 'bye', 'びぃ' => 'byi',
            'びょ' => 'byo', 'びゅ' => 'byu', 'ちゃ' => 'cha', 'ちぇ' => 'che', 'ち' => 'chi', 'ちょ' => 'cho',
            'ちゅ' => 'chu', 'ちゃ' => 'cya', 'ちぇ' => 'cye', 'ちぃ' => 'cyi', 'ちょ' => 'cyo', 'ちゅ' => 'cyu',
            'でゃ' => 'dha', 'でぇ' => 'dhe', 'でぃ' => 'dhi', 'でょ' => 'dho', 'でゅ' => 'dhu', 'どぁ' => 'dwa',
            'どぇ' => 'dwe', 'どぃ' => 'dwi', 'どぉ' => 'dwo', 'どぅ' => 'dwu', 'ぢゃ' => 'dya', 'ぢぇ' => 'dye',
            'ぢぃ' => 'dyi', 'ぢょ' => 'dyo', 'ぢゅ' => 'dyu', 'ぢ' => 'dzi', 'ふぁ' => 'fwa', 'ふぇ' => 'fwe',
            'ふぃ' => 'fwi', 'ふぉ' => 'fwo', 'ふぅ' => 'fwu', 'ふゃ' => 'fya', 'ふぇ' => 'fye', 'ふぃ' => 'fyi',
            'ふょ' => 'fyo', 'ふゅ' => 'fyu', 'ぎゃ' => 'gya', 'ぎぇ' => 'gye', 'ぎぃ' => 'gyi', 'ぎょ' => 'gyo',
            'ぎゅ' => 'gyu', 'ひゃ' => 'hya', 'ひぇ' => 'hye', 'ひぃ' => 'hyi', 'ひょ' => 'hyo', 'ひゅ' => 'hyu',
            'じゃ' => 'jya', 'じぇ' => 'jye', 'じぃ' => 'jyi', 'じょ' => 'jyo', 'じゅ' => 'jyu', 'きゃ' => 'kya',
            'きぇ' => 'kye', 'きぃ' => 'kyi', 'きょ' => 'kyo', 'きゅ' => 'kyu', 'りゃ' => 'lya', 'りぇ' => 'lye',
            'りぃ' => 'lyi', 'りょ' => 'lyo', 'りゅ' => 'lyu', 'みゃ' => 'mya', 'みぇ' => 'mye', 'みぃ' => 'myi',
            'みょ' => 'myo', 'みゅ' => 'myu', 'ん' => 'n', 'にゃ' => 'nya', 'にぇ' => 'nye', 'にぃ' => 'nyi',
            'にょ' => 'nyo', 'にゅ' => 'nyu', 'ぴゃ' => 'pya', 'ぴぇ' => 'pye', 'ぴぃ' => 'pyi', 'ぴょ' => 'pyo',
            'ぴゅ' => 'pyu', 'りゃ' => 'rya', 'りぇ' => 'rye', 'りぃ' => 'ryi', 'りょ' => 'ryo', 'りゅ' => 'ryu',
            'しゃ' => 'sha', 'しぇ' => 'she', 'し' => 'shi', 'しょ' => 'sho', 'しゅ' => 'shu', 'すぁ' => 'swa',
            'すぇ' => 'swe', 'すぃ' => 'swi', 'すぉ' => 'swo', 'すぅ' => 'swu', 'しゃ' => 'sya', 'しぇ' => 'sye',
            'しぃ' => 'syi', 'しょ' => 'syo', 'しゅ' => 'syu', 'てゃ' => 'tha', 'てぇ' => 'the', 'てぃ' => 'thi',
            'てょ' => 'tho', 'てゅ' => 'thu', 'つゃ' => 'tsa', 'つぇ' => 'tse', 'つぃ' => 'tsi', 'つょ' => 'tso',
            'つ' => 'tsu', 'とぁ' => 'twa', 'とぇ' => 'twe', 'とぃ' => 'twi', 'とぉ' => 'two', 'とぅ' => 'twu',
            'ちゃ' => 'tya', 'ちぇ' => 'tye', 'ちぃ' => 'tyi', 'ちょ' => 'tyo', 'ちゅ' => 'tyu', 'ヴゃ' => 'vya',
            'ヴぇ' => 'vye', 'ヴぃ' => 'vyi', 'ヴょ' => 'vyo', 'ヴゅ' => 'vyu', 'うぁ' => 'wha', 'うぇ' => 'whe',
            'うぃ' => 'whi', 'うぉ' => 'who', 'うぅ' => 'whu', 'ゑ' => 'wye', 'ゐ' => 'wyi', 'じゃ' => 'zha',
            'じぇ' => 'zhe', 'じぃ' => 'zhi', 'じょ' => 'zho', 'じゅ' => 'zhu', 'じゃ' => 'zya', 'じぇ' => 'zye',
            'じぃ' => 'zyi', 'じょ' => 'zyo', 'じゅ' => 'zyu',

            // Japanese katakana
            'ア' => 'a', 'エ' => 'e', 'イ' => 'i', 'オ' => 'o', 'ウ' => 'u', 'バ' => 'ba', 'ベ' => 'be', 'ビ' => 'bi',
            'ボ' => 'bo', 'ブ' => 'bu', 'シ' => 'ci', 'ダ' => 'da', 'デ' => 'de', 'ヂ' => 'di', 'ド' => 'do', 'ヅ' => 'du',
            'ファ' => 'fa', 'フェ' => 'fe', 'フィ' => 'fi', 'フォ' => 'fo', 'フ' => 'fu', 'ガ' => 'ga', 'ゲ' => 'ge',
            'ギ' => 'gi', 'ゴ' => 'go', 'グ' => 'gu', 'ハ' => 'ha', 'ヘ' => 'he', 'ヒ' => 'hi', 'ホ' => 'ho', 'フ' => 'hu',
            'ジャ' => 'ja', 'ジェ' => 'je', 'ジ' => 'ji', 'ジョ' => 'jo', 'ジュ' => 'ju', 'カ' => 'ka', 'ケ' => 'ke',
            'キ' => 'ki', 'コ' => 'ko', 'ク' => 'ku', 'ラ' => 'la', 'レ' => 'le', 'リ' => 'li', 'ロ' => 'lo', 'ル' => 'lu',
            'マ' => 'ma', 'メ' => 'me', 'ミ' => 'mi', 'モ' => 'mo', 'ム' => 'mu', 'ナ' => 'na', 'ネ' => 'ne', 'ニ' => 'ni',
            'ノ' => 'no', 'ヌ' => 'nu', 'パ' => 'pa', 'ペ' => 'pe', 'ピ' => 'pi', 'ポ' => 'po', 'プ' => 'pu', 'ラ' => 'ra',
            'レ' => 're', 'リ' => 'ri', 'ロ' => 'ro', 'ル' => 'ru', 'サ' => 'sa', 'セ' => 'se', 'シ' => 'si', 'ソ' => 'so',
            'ス' => 'su', 'タ' => 'ta', 'テ' => 'te', 'チ' => 'ti', 'ト' => 'to', 'ツ' => 'tu', 'ヴァ' => 'va',
            'ヴェ' => 've', 'ヴィ' => 'vi', 'ヴォ' => 'vo', 'ヴ' => 'vu', 'ワ' => 'wa', 'ウェ' => 'we', 'ウィ' => 'wi',
            'ヲ' => 'wo', 'ヤ' => 'ya', 'イェ' => 'ye', 'イ' => 'yi', 'ヨ' => 'yo', 'ユ' => 'yu', 'ザ' => 'za',
            'ゼ' => 'ze', 'ジ' => 'zi', 'ゾ' => 'zo', 'ズ' => 'zu', 'ビャ' => 'bya', 'ビェ' => 'bye', 'ビィ' => 'byi',
            'ビョ' => 'byo', 'ビュ' => 'byu', 'チャ' => 'cha', 'チェ' => 'che', 'チ' => 'chi', 'チョ' => 'cho',
            'チュ' => 'chu', 'チャ' => 'cya', 'チェ' => 'cye', 'チィ' => 'cyi', 'チョ' => 'cyo', 'チュ' => 'cyu',
            'デャ' => 'dha', 'デェ' => 'dhe', 'ディ' => 'dhi', 'デョ' => 'dho', 'デュ' => 'dhu', 'ドァ' => 'dwa',
            'ドェ' => 'dwe', 'ドィ' => 'dwi', 'ドォ' => 'dwo', 'ドゥ' => 'dwu', 'ヂャ' => 'dya', 'ヂェ' => 'dye',
            'ヂィ' => 'dyi', 'ヂョ' => 'dyo', 'ヂュ' => 'dyu', 'ヂ' => 'dzi', 'ファ' => 'fwa', 'フェ' => 'fwe',
            'フィ' => 'fwi', 'フォ' => 'fwo', 'フゥ' => 'fwu', 'フャ' => 'fya', 'フェ' => 'fye', 'フィ' => 'fyi',
            'フョ' => 'fyo', 'フュ' => 'fyu', 'ギャ' => 'gya', 'ギェ' => 'gye', 'ギィ' => 'gyi', 'ギョ' => 'gyo',
            'ギュ' => 'gyu', 'ヒャ' => 'hya', 'ヒェ' => 'hye', 'ヒィ' => 'hyi', 'ヒョ' => 'hyo', 'ヒュ' => 'hyu',
            'ジャ' => 'jya', 'ジェ' => 'jye', 'ジィ' => 'jyi', 'ジョ' => 'jyo', 'ジュ' => 'jyu', 'キャ' => 'kya',
            'キェ' => 'kye', 'キィ' => 'kyi', 'キョ' => 'kyo', 'キュ' => 'kyu', 'リャ' => 'lya', 'リェ' => 'lye',
            'リィ' => 'lyi', 'リョ' => 'lyo', 'リュ' => 'lyu', 'ミャ' => 'mya', 'ミェ' => 'mye', 'ミィ' => 'myi',
            'ミョ' => 'myo', 'ミュ' => 'myu', 'ン' => 'n', 'ニャ' => 'nya', 'ニェ' => 'nye', 'ニィ' => 'nyi',
            'ニョ' => 'nyo', 'ニュ' => 'nyu', 'ピャ' => 'pya', 'ピェ' => 'pye', 'ピィ' => 'pyi', 'ピョ' => 'pyo',
            'ピュ' => 'pyu', 'リャ' => 'rya', 'リェ' => 'rye', 'リィ' => 'ryi', 'リョ' => 'ryo', 'リュ' => 'ryu',
            'シャ' => 'sha', 'シェ' => 'she', 'シ' => 'shi', 'ショ' => 'sho', 'シュ' => 'shu', 'スァ' => 'swa',
            'スェ' => 'swe', 'スィ' => 'swi', 'スォ' => 'swo', 'スゥ' => 'swu', 'シャ' => 'sya', 'シェ' => 'sye',
            'シィ' => 'syi', 'ショ' => 'syo', 'シュ' => 'syu', 'テャ' => 'tha', 'テェ' => 'the', 'ティ' => 'thi',
            'テョ' => 'tho', 'テュ' => 'thu', 'ツャ' => 'tsa', 'ツェ' => 'tse', 'ツィ' => 'tsi', 'ツョ' => 'tso',
            'ツ' => 'tsu', 'トァ' => 'twa', 'トェ' => 'twe', 'トィ' => 'twi', 'トォ' => 'two', 'トゥ' => 'twu',
            'チャ' => 'tya', 'チェ' => 'tye', 'チィ' => 'tyi', 'チョ' => 'tyo', 'チュ' => 'tyu', 'ヴャ' => 'vya',
            'ヴェ' => 'vye', 'ヴィ' => 'vyi', 'ヴョ' => 'vyo', 'ヴュ' => 'vyu', 'ウァ' => 'wha', 'ウェ' => 'whe',
            'ウィ' => 'whi', 'ウォ' => 'who', 'ウゥ' => 'whu', 'ヱ' => 'wye', 'ヰ' => 'wyi', 'ジャ' => 'zha',
            'ジェ' => 'zhe', 'ジィ' => 'zhi', 'ジョ' => 'zho', 'ジュ' => 'zhu', 'ジャ' => 'zya', 'ジェ' => 'zye',
            'ジィ' => 'zyi', 'ジョ' => 'zyo', 'ジュ' => 'zyu',

            // Greek
            'Γ' => 'G', 'Δ' => 'E', 'Θ' => 'Th', 'Λ' => 'L', 'Ξ' => 'X', 'Π' => 'P', 'Σ' => 'S', 'Φ' => 'F',
            'Ψ' => 'Ps', 'γ' => 'g', 'δ' => 'e', 'θ' => 'th', 'λ' => 'l', 'ξ' => 'x', 'π' => 'p', 'σ' => 's',
            'φ' => 'f', 'ψ' => 'ps',

            // Thai
            'ก' => 'k', 'ข' => 'kh', 'ฃ' => 'kh', 'ค' => 'kh', 'ฅ' => 'kh', 'ฆ' => 'kh', 'ง' => 'ng', 'จ' => 'ch',
            'ฉ' => 'ch', 'ช' => 'ch', 'ซ' => 's', 'ฌ' => 'ch', 'ญ' => 'y', 'ฎ' => 'd', 'ฏ' => 't', 'ฐ' => 'th',
            'ฑ' => 'd', 'ฒ' => 'th', 'ณ' => 'n', 'ด' => 'd', 'ต' => 't', 'ถ' => 'th', 'ท' => 'th', 'ธ' => 'th',
            'น' => 'n', 'บ' => 'b', 'ป' => 'p', 'ผ' => 'ph', 'ฝ' => 'f', 'พ' => 'ph', 'ฟ' => 'f', 'ภ' => 'ph',
            'ม' => 'm', 'ย' => 'y', 'ร' => 'r', 'ฤ' => 'rue', 'ฤๅ' => 'rue', 'ล' => 'l', 'ฦ' => 'lue', 'ฦๅ' => 'lue',
            'ว' => 'w', 'ศ' => 's', 'ษ' => 's', 'ส' => 's', 'ห' => 'h', 'ฬ' => 'l', 'ฮ' => 'h', 'ะ' => 'a', '–ั' => 'a',
            'รร' => 'a', 'า' => 'a', 'รร' => 'an', 'ำ' => 'am', '–ิ' => 'i', '–ี' => 'i', '–ึ' => 'ue', '–ื' => 'ue',
            '–ุ' => 'u', '–ู' => 'u', 'เะ' => 'e', 'เ–็' => 'e', 'เ' => 'e', 'แะ' => 'ae', 'แ' => 'ae', 'โะ' => 'o',
            'โ' => 'o', 'เาะ' => 'o', 'อ' => 'o', 'เอะ' => 'oe', 'เ–ิ' => 'oe', 'เอ' => 'oe', 'เ–ียะ' => 'ia',
            'เ–ีย' => 'ia', 'เ–ือะ' => 'uea', 'เ–ือ' => 'uea', '–ัวะ' => 'ua', '–ัว' => 'ua', 'ว' => 'ua', 'ใ' => 'ai',
            'ไ' => 'ai', '–ัย' => 'ai', 'ไย' => 'ai', 'าย' => 'ai', 'เา' => 'ao', 'าว' => 'ao', '–ุย' => 'ui',
            'โย' => 'oi', 'อย' => 'oi', 'เย' => 'oei', 'เ–ือย' => 'ueai', 'วย' => 'uai', '–ิว' => 'io', 'เ–็ว' => 'eo',
            'เว' => 'eo', 'แ–็ว' => 'aeo', 'แว' => 'aeo', 'เ–ียว' => 'iao',

            // Korean
            'ㄱ' => 'k', 'ㅋ' => 'kh', 'ㄲ' => 'kk', 'ㄷ' => 't', 'ㅌ' => 'th', 'ㄸ' => 'tt', 'ㅂ' => 'p', 'ㅍ' => 'ph',
            'ㅃ' => 'pp', 'ㅈ' => 'c', 'ㅊ' => 'ch', 'ㅉ' => 'cc', 'ㅅ' => 's', 'ㅆ' => 'ss', 'ㅎ' => 'h', 'ㅇ' => 'ng',
            'ㄴ' => 'n', 'ㄹ' => 'l', 'ㅁ' => 'm', 'ㅏ' => 'a', 'ㅓ' => 'e', 'ㅗ' => 'o', 'ㅜ' => 'wu', 'ㅡ' => 'u',
            'ㅣ' => 'i', 'ㅐ' => 'ay', 'ㅔ' => 'ey', 'ㅚ' => 'oy', 'ㅘ' => 'wa', 'ㅝ' => 'we', 'ㅟ' => 'wi', 'ㅙ' => 'way',
            'ㅞ' => 'wey', 'ㅢ' => 'uy', 'ㅑ' => 'ya', 'ㅕ' => 'ye', 'ㅛ' => 'oy', 'ㅠ' => 'yu', 'ㅒ' => 'yay',
            'ㅖ' => 'yey',

            // Vietnamese
            'ả' => 'a', 'Ả' => 'a', 'ạ' => 'a', 'Ạ' => 'a', 'ằ' => 'a', 'Ằ' => 'a', 'ẳ' => 'a', 'Ẳ' => 'a', 'ẵ' => 'a',
            'Ẵ' => 'a', 'ắ' => 'a', 'Ắ' => 'a', 'ặ' => 'a', 'Ặ' => 'a', 'ầ' => 'a', 'Ầ' => 'a', 'ẩ' => 'a', 'Ẩ' => 'a',
            'ẫ' => 'a', 'Ẫ' => 'a', 'ấ' => 'a', 'Ấ' => 'a', 'ậ' => 'a', 'Ậ' => 'a', 'ẻ' => 'e', 'Ẻ' => 'e', 'ẽ' => 'e',
            'Ẽ' => 'e', 'ẹ' => 'e', 'Ẹ' => 'e', 'ề' => 'e', 'Ề' => 'e', 'ể' => 'e', 'Ể' => 'e', 'ễ' => 'e', 'Ễ' => 'e',
            'ế' => 'e', 'Ế' => 'e', 'ệ' => 'e', 'Ệ' => 'e', 'ỉ' => 'i', 'Ỉ' => 'i', 'ị' => 'i', 'Ị' => 'i', 'ỏ' => 'o',
            'Ỏ' => 'o', 'ọ' => 'o', 'Ọ' => 'o', 'ồ' => 'o', 'Ồ' => 'o', 'ổ' => 'o', 'Ổ' => 'o', 'ỗ' => 'o', 'Ỗ' => 'o',
            'ố' => 'o', 'Ố' => 'o', 'ộ' => 'o', 'Ộ' => 'o', 'ờ' => 'o', 'Ờ' => 'o', 'ở' => 'o', 'Ở' => 'o', 'ỡ' => 'o',
            'Ỡ' => 'o', 'ớ' => 'o', 'Ớ' => 'o', 'ợ' => 'o', 'Ợ' => 'o', 'ủ' => 'u', 'Ủ' => 'u', 'ụ' => 'u', 'Ụ' => 'u',
            'ừ' => 'u', 'Ừ' => 'u', 'ử' => 'u', 'Ử' => 'u', 'ữ' => 'u', 'Ữ' => 'u', 'ứ' => 'u', 'Ứ' => 'u', 'ự' => 'u',
            'Ự' => 'u', 'ỷ' => 'y', 'Ỷ' => 'y', 'ỹ' => 'y', 'Ỹ' => 'y', 'ỵ' => 'y', 'Ỵ' => 'y',
        ];

        return strtr($string, $transliterate_table);
    }

    /**
     * @param string $string
     * @param string $separator
     *
     * @return string
     */
    public static function standardize(string $string, string $separator = '_'): string
    {
        $string = self::transliterate($string);
        $string = trim($string);
        $string = strtolower($string);

        return preg_replace(['#[-_\s]+#', '#[^' . $separator . '\w\d]+#i'], [$separator, ''], $string);
    }

    /**
     * @param string $string
     * @param string $delimiter
     *
     * @return array
     */
    public static function toArray(string $string, string $delimiter = ','): array
    {
        $array_temp = explode($delimiter, $string);
        $array = [];
        foreach ($array_temp as $item) {
            $item_clear = trim($item);
            if ($item_clear) {
                $array[] = $item_clear;
            }
        }

        return $array;
    }

    /**
     * @param string $string
     * @param bool   $lower
     *
     * @return string
     */
    public static function snakecaseToCamelcase(string $string, bool $lower = false): string
    {
        $words = explode('_', $string);

        array_walk($words, function (&$word, $index) {
            $word = ucfirst($word);
        });

        if ($lower) {
            return lcfirst(implode($words));
        }

        return implode($words);
    }

    /**
     * @param $string
     *
     * @return string
     */
    public static function camelcaseToSnakecase(string $string): string
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $string, $matches);

        $words = $matches[0];
        foreach ($words as &$word) {
            $word = ($word == strtoupper($word))
                ? strtolower($word)
                : lcfirst($word);
        }

        return implode('_', $words);
    }
}
