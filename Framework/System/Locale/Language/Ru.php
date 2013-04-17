<?php

/**
 * @codeCoverageIgnoreStart
 */
class Locale_Language_Ru extends Locale_AbstractLanguage
{
    public function getLanguageName()
    {
        return 'Russian';
    }
    public function toCase($word, $case)
    {
        using('Framework.Vendors.NameCaseLib');
        
        $nc = new NameCaseLib_Ru();
        $res = $nc->q($word);
        return $res[$case];
    }

    public function getPluralCount()
    {
        return 3;
    }

    public function getPluralExpresion()
    {
        return '((n%10==1) && (n%100!=11)) ? 0 : (( (n%10>=2) && (n%10<=4) && (n%100<10 || n%100>=20)) ? 1 : 2 )';
    }

    public function getCountries()
    {
        return self::$countries;
    }

    public function getCurrencies()
    {
        return self::$currency;
    }

    public function getLanguages()
    {
        return self::$languages;
    }

    protected static $regions = array(
        LOCALE_AFRICAN_COUNTRIES       => 'Африка',
        LOCALE_ASIAN_COUNTRIES         => 'Азия',
        LOCALE_EUROPEAN_COUNTRIES      => 'Европа',
        LOCALE_NORTHAMERICAN_COUNTRIES => 'Северная Америка',
        LOCALE_SOUTHAMERICAN_COUNTRIES => 'Южная Америка',
        LOCALE_OCEANIAN_COUNTRIES      => 'Океания'
    );

    public function getRegions()
    {
        return self::$regions;
    }

    public function getDateFormats()
    {
        return array(
            LOCALE_DATETIME_SHORT     =>  '%d/%m/%y',
            LOCALE_DATETIME_DEFAULT   =>  '%d-%b-%Y',
            LOCALE_DATETIME_MEDIUM    =>  '%d-%b-%Y',
            LOCALE_DATETIME_LONG      =>  '%d %B %Y',
            LOCALE_DATETIME_FULL      =>  '%A, %d %B %Y'
        );
    }

    public function getTimeFormats()
    {
        return array(
            LOCALE_DATETIME_SHORT     =>  '%H:%M',
            LOCALE_DATETIME_DEFAULT   =>  '%H:%M:%S',
            LOCALE_DATETIME_MEDIUM    =>  '%H:%M:%S',
            LOCALE_DATETIME_LONG      =>  '%H:%M:%S %Z',
            LOCALE_DATETIME_FULL      =>  '%H:%M часов %Z'
        );
    }

    public function translit($text)
    {
        $transArr  = array (       
            'а' => 'a', 'б' => 'b',  'в' => 'v', 'г' => 'g', 'д' => 'd',
            'е' => 'e', 'ё' => 'yo', 'ж' => 'j', 'з' => 'z', 'и' => 'i',
            'й' => 'i', 'к' => 'k',  'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p',  'р' => 'r', 'с' => 's', 'т' => 't',
            'у' => 'y', 'ф' => 'f',  'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
            'ш' => 'sh','щ' => 'sh', 'ы' => 'i', 'э' => 'e', 'ю' => 'u',
            'я' => 'ya',
            'А' => 'A',  'Б' => 'B',  'В' => 'V', 'Г' => 'G', 'Д' => 'D',
            'Е' => 'E',  'Ё' => 'Yo', 'Ж' => 'J', 'З' => 'Z', 'И' => 'I',
            'Й' => 'I',  'К' => 'K',  'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O',  'П' => 'P',  'Р' => 'R', 'С' => 'S', 'Т' => 'T',
            'У' => 'Y',  'Ф' => 'F',  'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch',
            'Ш' => 'Sh', 'Щ' => 'Sh', 'Ы' => 'I', 'Э' => 'E', 'Ю' =>'U',
            'Я' => 'Ya',
            'ь' => '',  'Ь' => '',  'ъ' => '',  'Ъ' => '',
            'ї' => 'j', 'і' => 'i', 'ґ' => 'g', 'є' => 'ye',
            'Ї' => 'J', 'І' => 'I', 'Ґ' => 'G', 'Є' => 'YE'
        );
        return strtr($text, $transArr);
    }

    protected static $countries = array(
        'AD' => 'Андорра',
        'AE' => 'Объединенные Арабские Эмираты',
        'AF' => 'Афганистан',
        'AG' => 'Антигуа и Барбуда',
        'AI' => 'Ангуилла',
        'AL' => 'Албания',
        'AM' => 'Армения',
        'AN' => 'Голландские Антильские Острова',
        'AO' => 'Ангола',
        'AQ' => 'Антарктида',
        'AR' => 'Аргентина',
        'AS' => 'Американское Самоа',
        'AT' => 'Австрия',
        'AU' => 'Австралия',
        'AW' => 'Аруба',
        'AX' => 'Аландские острова',
        'AZ' => 'Азербайджан',
        'BA' => 'Босния',
        'BB' => 'Барбадос',
        'BD' => 'Бангладеш',
        'BE' => 'Бельгия',
        'BF' => 'Буркина Фасо',
        'BG' => 'Болгария',
        'BH' => 'Бахрейн',
        'BI' => 'Бурунди',
        'BJ' => 'Бенин',
        'BM' => 'Бермудские Острова',
        'BN' => 'Бруней Даруссалам',
        'BO' => 'Боливия',
        'BQ' => 'British Antarctic Territory',
        'BR' => 'Бразилия',
        'BS' => 'Багамские острова',
        'BT' => 'Бутан',
        'BV' => 'Остров Буве',
        'BW' => 'Ботсвана',
        'BY' => 'Беларусь',
        'BZ' => 'Белиз',
        'CA' => 'Канада',
        'CC' => 'Кокосовые Острова (Киилинг)',
        'CD' => 'Конго, Демократическая Республика',
        'CF' => 'Центрально-Африканская Республика',
        'CG' => 'Конго',
        'CH' => 'Швейцария',
        'CI' => 'Кот д’Ивуар',
        'CK' => 'Острова Кука',
        'CL' => 'Чили',
        'CM' => 'Камерун',
        'CN' => 'Китай',
        'CO' => 'Колумбия',
        'CR' => 'Коста-Рика',
        'CS' => 'Сербия и Черногория',
        'CT' => 'Canton and Enderbury Islands',
        'CU' => 'Куба',
        'CV' => 'Острова Зеленого Мыса',
        'CX' => 'Остров Рождества',
        'CY' => 'Кипр',
        'CZ' => 'Чешская Республика',
        'DD' => 'East Germany',
        'DE' => 'Германия',
        'DJ' => 'Джибути',
        'DK' => 'Дания',
        'DM' => 'Остров Доминика',
        'DO' => 'Доминиканская Республика',
        'DZ' => 'Алжир',
        'EC' => 'Эквадор',
        'EE' => 'Эстония',
        'EG' => 'Египет',
        'EH' => 'Западная Сахара',
        'ER' => 'Эритрея',
        'ES' => 'Испания',
        'ET' => 'Эфиопия',
        'FI' => 'Финляндия',
        'FJ' => 'Фиджи',
        'FK' => 'Фольклендские Острова',
        'FM' => 'Федеративное Государство Микронезия',
        'FO' => 'Фарерские острова',
        'FQ' => 'French Southern and Antarctic Territories',
        'FR' => 'Франция',
        'FX' => 'Metropolitan France',
        'GA' => 'Габон',
        'GB' => 'Великобритания',
        'GD' => 'Гренада',
        'GE' => 'Грузия',
        'GF' => 'Французская Гвиана',
        'GH' => 'Гана',
        'GI' => 'Гибралтар',
        'GL' => 'Гренландия',
        'GM' => 'Гамбия',
        'GN' => 'Гвинея',
        'GP' => 'Гваделупа',
        'GQ' => 'Экваториальная Гвинея',
        'GR' => 'Греция',
        'GS' => 'Южная Джорджия и Южные Сандвичевы Острова',
        'GT' => 'Гватемала',
        'GU' => 'Гуам',
        'GW' => 'Гвинея-Биссау',
        'GY' => 'Гайана',
        'HK' => 'Гонконг (Область с Особым Административным Управлением, Китай)',
        'HM' => 'Острова Херд и Мак-Дональд',
        'HN' => 'Гондурас',
        'HR' => 'Хорватия',
        'HT' => 'Гаити',
        'HU' => 'Венгрия',
        'ID' => 'Индонезия',
        'IE' => 'Ирландия',
        'IL' => 'Израиль',
        'IN' => 'Индия',
        'IO' => 'Британские Территории в Индийском Океане',
        'IQ' => 'Ирак',
        'IR' => 'Иран',
        'IS' => 'Исландия',
        'IT' => 'Италия',
        'JM' => 'Ямайка',
        'JO' => 'Иордания',
        'JP' => 'Япония',
        'JT' => 'Johnston Island',
        'KE' => 'Кения',
        'KG' => 'Кыргызстан',
        'KH' => 'Камбоджа',
        'KI' => 'Кирибати',
        'KM' => 'Коморские Острова',
        'KN' => 'Сент-Киттс и Невис',
        'KP' => 'Северная Корея',
        'KR' => 'Южная Корея',
        'KW' => 'Кувейт',
        'KY' => 'Каймановы Острова',
        'KZ' => 'Казахстан',
        'LA' => 'Лаос',
        'LB' => 'Ливан',
        'LC' => 'Сент-Люсия',
        'LI' => 'Лихтенштейн',
        'LK' => 'Шри-Ланка',
        'LR' => 'Либерия',
        'LS' => 'Лесото',
        'LT' => 'Литва',
        'LU' => 'Люксембург',
        'LV' => 'Латвия',
        'LY' => 'Ливия',
        'MA' => 'Марокко',
        'MC' => 'Монако',
        'MD' => 'Молдова',
        'MG' => 'Мадагаскар',
        'MH' => 'Маршалловы Острова',
        'MI' => 'Midway Islands',
        'MK' => 'Македония',
        'ML' => 'Мали',
        'MM' => 'Мьянма',
        'MN' => 'Монголия',
        'MO' => 'Макао (Область с Особым Административным Управлением, Китай)',
        'MP' => 'Северные Марианские Острова',
        'MQ' => 'Мартиник',
        'MR' => 'Мавритания',
        'MS' => 'Монсеррат',
        'MT' => 'Мальта',
        'MU' => 'Маврикий',
        'MV' => 'Мальдивы',
        'MW' => 'Малави',
        'MX' => 'Мексика',
        'MY' => 'Малайзия',
        'MZ' => 'Мозамбик',
        'NA' => 'Намибия',
        'NC' => 'Новая Каледония',
        'NE' => 'Нигер',
        'NF' => 'Остров Норфолк',
        'NG' => 'Нигерия',
        'NI' => 'Никарагуа',
        'NL' => 'Нидерланды',
        'NO' => 'Норвегия',
        'NP' => 'Непал',
        'NQ' => 'Dronning Maud Land',
        'NR' => 'Науру',
        'NT' => 'Neutral Zone',
        'NU' => 'Ниуе',
        'NZ' => 'Новая Зеландия',
        'OM' => 'Оман',
        'PA' => 'Панама',
        'PC' => 'Pacific Islands Trust Territory',
        'PE' => 'Перу',
        'PF' => 'Французская Полинезия',
        'PG' => 'Папуа-Новая Гвинея',
        'PH' => 'Филиппины',
        'PK' => 'Пакистан',
        'PL' => 'Польша',
        'PM' => 'Сен-Пьер и Микелон',
        'PN' => 'Остров Питкэрн',
        'PR' => 'Пуэрто-Рико',
        'PS' => 'Палестинская автономия',
        'PT' => 'Португалия',
        'PU' => 'U.S. Miscellaneous Pacific Islands',
        'PW' => 'Палау',
        'PY' => 'Парагвай',
        'PZ' => 'Panama Canal Zone',
        'QA' => 'Катар',
        'QO' => 'Удаленная Океания',
        'RE' => 'Реюньон',
        'RO' => 'Румыния',
        'RU' => 'Россия',
        'RW' => 'Руанда',
        'SA' => 'Саудовская Аравия',
        'SB' => 'Соломоновы Острова',
        'SC' => 'Сейшельские Острова',
        'SD' => 'Судан',
        'SE' => 'Швеция',
        'SG' => 'Сингапур',
        'SH' => 'Остров Святой Елены',
        'SI' => 'Словения',
        'SJ' => 'Острова Свалбард и Жан Майен',
        'SK' => 'Словакия',
        'SL' => 'Сьерра-Леоне',
        'SM' => 'Сан-Марино',
        'SN' => 'Сенегал',
        'SO' => 'Сомали',
        'SR' => 'Суринам',
        'ST' => 'Сан-Томе и Принсипи',
        'SU' => 'Union of Soviet Socialist Republics',
        'SV' => 'Сальвадор',
        'SY' => 'Сирийская Арабская Республика',
        'SZ' => 'Свазиленд',
        'TC' => 'Острова Туркс и Кайкос',
        'TD' => 'Чад',
        'TF' => 'Французские Южные Территории',
        'TG' => 'Того',
        'TH' => 'Таиланд',
        'TJ' => 'Таджикистан',
        'TK' => 'Токелау',
        'TL' => 'Восточный Тимор',
        'TM' => 'Туркменистан',
        'TN' => 'Тунис',
        'TO' => 'Тонга',
        'TR' => 'Турция',
        'TT' => 'Тринидад и Тобаго',
        'TV' => 'Тувалу',
        'TW' => 'Тайвань',
        'TZ' => 'Танзания',
        'UA' => 'Украина',
        'UG' => 'Уганда',
        'UM' => 'Внешние малые острова (США)',
        'US' => 'Соединенные Штаты',
        'UY' => 'Уругвай',
        'UZ' => 'Узбекистан',
        'VA' => 'Государство-город Ватикан',
        'VC' => 'Сент-Винсент и Гренадины',
        'VD' => 'North Vietnam',
        'VE' => 'Венесуэла',
        'VG' => 'Британские Виргинские Острова',
        'VI' => 'Американские Виргинские Острова',
        'VN' => 'Вьетнам',
        'VU' => 'Вануату',
        'WF' => 'Эллис и Футуна',
        'WK' => 'Wake Island',
        'WS' => 'Самоа',
        'YD' => 'People\'s Democratic Republic of Yemen',
        'YE' => 'Йемен',
        'YT' => 'Майотта',
        'ZA' => 'Южная Африка',
        'ZM' => 'Замбия',
        'ZW' => 'Зимбабве',
    );

    protected static $currency = array(
        'ADP' => 'Андоррская песета',
        'AED' => 'Дирхам (ОАЭ)',
        'AFA' => 'Афгани (1927-2002)',
        'AFN' => 'Afghani',
        'ALL' => 'Албанский лек',
        'AMD' => 'Армянский драм',
        'ANG' => 'Нидерландский антильский гульден',
        'AOA' => 'Angolan Kwanza',
        'AOK' => 'Angolan Kwanza (1977-1990)',
        'AON' => 'Новая кванза',
        'AOR' => 'Angolan Kwanza Reajustado (1995-1999)',
        'ARA' => 'Argentine Austral',
        'ARP' => 'Argentine Peso (1983-1985)',
        'ARS' => 'Аргентинское песо',
        'ATS' => 'Австрийский шиллинг',
        'AUD' => 'Австралийский доллар',
        'AWG' => 'Арубанский гульден',
        'AZM' => 'Азербайджанский манат',
        'BAD' => 'Bosnia-Herzegovina Dinar',
        'BAM' => 'Bosnia-Herzegovina Convertible Mark',
        'BBD' => 'Барбадосский доллар',
        'BDT' => 'Бангладешская така',
        'BEC' => 'Belgian Franc (convertible)',
        'BEF' => 'Бельгийский франк',
        'BEL' => 'Belgian Franc (financial)',
        'BGL' => 'Лев',
        'BGN' => 'Болгарский лев',
        'BHD' => 'Бахрейнский динар',
        'BIF' => 'Бурундийский франк',
        'BMD' => 'Бермудский доллар',
        'BND' => 'Брунейский доллар',
        'BOB' => 'Боливиано',
        'BOP' => 'Bolivian Peso',
        'BOV' => 'Bolivian Mvdol',
        'BRB' => 'Brazilian Cruzeiro Novo (1967-1986)',
        'BRC' => 'Brazilian Cruzado',
        'BRE' => 'Brazilian Cruzeiro (1990-1993)',
        'BRL' => 'Бразильский реал',
        'BRN' => 'Brazilian Cruzado Novo',
        'BRR' => 'Крузейро реал',
        'BSD' => 'Багамский доллар',
        'BTN' => 'Нгултрум',
        'BUK' => 'Burmese Kyat',
        'BWP' => 'Ботсванская пула',
        'BYB' => 'Белорусский рубль (1994-1999)',
        'BYR' => 'Белорусский рубль',
        'BZD' => 'Белизский доллар',
        'CAD' => 'Канадский доллар',
        'CDF' => 'Конголезский франк',
        'CHE' => 'WIR Euro',
        'CHF' => 'Швейцарский франк',
        'CHW' => 'WIR Franc',
        'CLF' => 'Chilean Unidades de Fomento',
        'CLP' => 'Чилийское песо',
        'CNY' => 'Китайский юань',
        'COP' => 'Колумбийское песо',
        'COU' => 'Unidad de Valor Real',
        'CRC' => 'Костариканский колон',
        'CSD' => 'Serbian Dinar',
        'CSK' => 'Czechoslovak Hard Koruna',
        'CUP' => 'Кубинское песо',
        'CVE' => 'Эскудо Кабо-Верде',
        'CYP' => 'Кипрский фунт',
        'CZK' => 'Чешская крона',
        'DDM' => 'East German Ostmark',
        'DEM' => 'Немецкая марка',
        'DJF' => 'Франк Джибути',
        'DKK' => 'Датская крона',
        'DOP' => 'Доминиканское песо',
        'DZD' => 'Алжирский динар',
        'ECS' => 'Эквадорский сукре',
        'ECV' => 'Ecuador Unidad de Valor Constante (UVC)',
        'EEK' => 'Эстонская крона',
        'EGP' => 'Египетский фунт',
        'EQE' => 'Ekwele',
        'ERN' => 'Накфа',
        'ESA' => 'Spanish Peseta (A account)',
        'ESB' => 'Spanish Peseta (convertible account)',
        'ESP' => 'Spanish Peseta',
        'ETB' => 'Эфиопский быр',
        'EUR' => 'Евро',
        'FIM' => 'Финская марка',
        'FJD' => 'Доллар Фиджи',
        'FKP' => 'Фунт Фолклендских островов',
        'FRF' => 'Французский франк',
        'GBP' => 'Английский фунт стерлингов',
        'GEK' => 'Грузинский купон',
        'GEL' => 'Грузинский лари',
        'GHC' => 'Ганский седи',
        'GIP' => 'Гибралтарский фунт',
        'GMD' => 'Гамбийский даласи',
        'GNF' => 'Гвинейский франк',
        'GNS' => 'Guinea Syli',
        'GQE' => 'Equatorial Guinea Ekwele Guineana',
        'GRD' => 'Греческая драхма',
        'GTQ' => 'Гватемальский кетсаль',
        'GWE' => 'Portuguese Guinea Escudo',
        'GWP' => 'Песо Гвинеи-Бисау',
        'GYD' => 'Гайанский доллар',
        'HKD' => 'Гонконгский доллар',
        'HNL' => 'Гондурасская лемпира',
        'HRD' => 'Хорватский динар',
        'HRK' => 'Хорватская куна',
        'HTG' => 'Гаитянский гурд',
        'HUF' => 'Венгерский форинт',
        'IDR' => 'Индонезийская рупия',
        'IEP' => 'Ирландский фунт',
        'ILP' => 'Israeli Pound',
        'ILS' => 'Новый израильский шекель',
        'INR' => 'Индийская рупия',
        'IQD' => 'Иракский динар',
        'IRR' => 'Иранский риал',
        'ISK' => 'Исландская крона',
        'ITL' => 'Итальянская лира',
        'JMD' => 'Ямайский доллар',
        'JOD' => 'Иорданский динар',
        'JPY' => 'Японская иена',
        'KES' => 'Кенийский шиллинг',
        'KGS' => 'Сом (киргизский)',
        'KHR' => 'Камбоджийский риель',
        'KMF' => 'Франк Коморских островов',
        'KPW' => 'Северо-корейская вона',
        'KRW' => 'Вона Республики Кореи',
        'KWD' => 'Кувейтский динар',
        'KYD' => 'Доллар Каймановых островов',
        'KZT' => 'Тенге (казахский)',
        'LAK' => 'Кип ЛНДР',
        'LBP' => 'Ливанский фунт',
        'LKR' => 'Шри-Ланкийская рупия',
        'LRD' => 'Либерийский доллар',
        'LSL' => 'Лоти',
        'LSM' => 'Maloti',
        'LTL' => 'Литовский лит',
        'LTT' => 'Lithuanian Talonas',
        'LUC' => 'Luxembourg Convertible Franc',
        'LUF' => 'Люксембургский франк',
        'LUL' => 'Luxembourg Financial Franc',
        'LVL' => 'Латвийский лат',
        'LVR' => 'Latvian Ruble',
        'LYD' => 'Ливийский динар',
        'MAD' => 'Марокканский дирхам',
        'MAF' => 'Moroccan Franc',
        'MDL' => 'Молдавский лей',
        'MGA' => 'Madagascar Ariary',
        'MGF' => 'Малагасийский франк',
        'MKD' => 'Македонский динар',
        'MLF' => 'Mali Franc',
        'MMK' => 'Myanmar Kyat',
        'MNT' => 'Монгольский тугрик',
        'MOP' => 'Macao Pataca',
        'MRO' => 'Мавританская угия',
        'MTL' => 'Мальтийская лира',
        'MTP' => 'Maltese Pound',
        'MUR' => 'Маврикийская рупия',
        'MVR' => 'Мальдивская руфия',
        'MWK' => 'Квача (малавийская)',
        'MXN' => 'Мексиканское новое песо',
        'MXP' => 'Mexican Silver Peso (1861-1992)',
        'MXV' => 'Mexican Unidad de Inversion (UDI)',
        'MYR' => 'Малайзийский ринггит',
        'MZE' => 'Mozambique Escudo',
        'MZM' => 'Мозамбикский метикал',
        'NAD' => 'Доллар Намибии',
        'NGN' => 'Нигерийская найра',
        'NIC' => 'Nicaraguan Cordoba',
        'NIO' => 'Золотая кордоба',
        'NLG' => 'Нидерландский гульден',
        'NOK' => 'Норвежская крона',
        'NPR' => 'Непальская рупия',
        'NZD' => 'Новозеландский доллар',
        'OMR' => 'Оманский риал',
        'PAB' => 'Панамское бальбоа',
        'PEI' => 'Peruvian Inti',
        'PEN' => 'Перуанский новый соль',
        'PES' => 'Peruvian Sol',
        'PGK' => 'Кина',
        'PHP' => 'Филиппинское песо',
        'PKR' => 'Пакистанская рупия',
        'PLN' => 'Польский злотый',
        'PLZ' => 'Злотый',
        'PTE' => 'Португальское эскудо',
        'PYG' => 'Парагвайский гуарани',
        'QAR' => 'Катарский риал',
        'RHD' => 'Rhodesian Dollar',
        'ROL' => 'Румынский лей',
        'RON' => 'Romanian Leu',
        'RUB' => 'Российский рубль',
        'RUR' => 'Российский рубль (1991-1998)',
        'RWF' => 'Франк Руанды',
        'SAR' => 'Саудовский риал',
        'SBD' => 'Доллар Соломоновых островов',
        'SCR' => 'Сейшельская рупия',
        'SDD' => 'Суданский динар',
        'SDP' => 'Sudanese Pound',
        'SEK' => 'Шведская крона',
        'SGD' => 'Сингапурский доллар',
        'SHP' => 'Фунт острова Святой Елены',
        'SIT' => 'Словенский толар',
        'SKK' => 'Словацкая крона',
        'SLL' => 'Леоне',
        'SOS' => 'Сомалийский шиллинг',
        'SRD' => 'Surinam Dollar',
        'SRG' => 'Суринамский гульден',
        'STD' => 'Добра',
        'SUR' => 'Soviet Rouble',
        'SVC' => 'Сальвадорский колон',
        'SYP' => 'Сирийский фунт',
        'SZL' => 'Свазилендский лилангени',
        'THB' => 'Таиландский бат',
        'TJR' => 'Таджикский рубль',
        'TJS' => 'Таджикский сомони',
        'TMM' => 'Туркменский манат',
        'TND' => 'Тунисский динар',
        'TOP' => 'Паанга',
        'TPE' => 'Тиморское эскудо',
        'TRL' => 'Турецкая лира',
        'TRY' => 'Новая турецкая лира',
        'TTD' => 'Доллар Тринидада и Тобаго',
        'TWD' => 'Новый тайваньский доллар',
        'TZS' => 'Танзанийский шиллинг',
        'UAH' => 'Украинская гривна',
        'UAK' => 'Карбованец (украинский)',
        'UGS' => 'Угандийский шиллинг',
        'UGX' => 'Ugandan Shilling',
        'USD' => 'Доллар США',
        'USN' => 'US Dollar (Next day)',
        'USS' => 'US Dollar (Same day)',
        'UYP' => 'Уругвайское песо',
        'UYU' => 'Uruguay Peso Uruguayo',
        'UZS' => 'Узбекский сум',
        'VEB' => 'Венесуэльский боливар',
        'VND' => 'Вьетнамский донг',
        'VUV' => 'Вату',
        'WST' => 'Тала',
        'XAF' => 'Франк КФА ВЕАС',
        'XAG' => 'Silver',
        'XAU' => 'Золото',
        'XBA' => 'European Composite Unit',
        'XBB' => 'European Monetary Unit',
        'XBC' => 'European Unit of Account (XBC)',
        'XBD' => 'European Unit of Account (XBD)',
        'XCD' => 'Восточно-карибский доллар',
        'XDR' => 'СДР (специальные права заимствования)',
        'XEU' => 'ЭКЮ (единица европейской валюты)',
        'XFO' => 'French Gold Franc',
        'XFU' => 'French UIC-Franc',
        'XOF' => 'Франк КФА ВСЕАО',
        'XPD' => 'Palladium',
        'XPF' => 'Франк КФП',
        'XPT' => 'Platinum',
        'XRE' => 'RINET Funds',
        'XTS' => 'Testing Currency Code',
        'XXX' => 'No Currency',
        'YDD' => 'Yemeni Dinar',
        'YER' => 'Йеменский риал',
        'YUD' => 'Yugoslavian Hard Dinar',
        'YUM' => 'Yugoslavian Noviy Dinar',
        'YUN' => 'Югославский динар',
        'ZAL' => 'South African Rand (financial)',
        'ZAR' => 'Рэнд',
        'ZMK' => 'Квача (замбийская)',
        'ZRN' => 'Новый заир',
        'ZRZ' => 'Zairean Zaire',
        'ZWD' => 'Доллар Зимбабве',
    );

    protected static $languages = array(
        'aa' => 'Афар',
        'ab' => 'Абхазский',
        'ae' => 'Avestan',
        'af' => 'Африкаанс',
        'ak' => 'Akan',
        'am' => 'Амхарский',
        'an' => 'Aragonese',
        'ar' => 'Арабский',
        'as' => 'Ассамский',
        'av' => 'Avaric',
        'ay' => 'Аймара',
        'az' => 'Азербайджанский',
        'ba' => 'Башкирский',
        'be' => 'Белорусский',
        'bg' => 'Болгарский',
        'bh' => 'Бихари',
        'bi' => 'Бислама',
        'bm' => 'Bambara',
        'bn' => 'Бенгальский',
        'bo' => 'Тибетский',
        'br' => 'Бретонский',
        'bs' => 'Bosnian',
        'ca' => 'Каталанский',
        'ce' => 'Chechen',
        'ch' => 'Chamorro',
        'co' => 'Корсиканский',
        'cr' => 'Cree',
        'cs' => 'Чешский',
        'cu' => 'Church Slavic',
        'cv' => 'Чувашский',
        'cy' => 'Валлийский',
        'da' => 'Датский',
        'de' => 'Немецкий',
        'dv' => 'Divehi',
        'dz' => 'Дзонг-кэ',
        'ee' => 'Ewe',
        'el' => 'Греческий',
        'en' => 'Английский',
        'eo' => 'Эсперанто',
        'es' => 'Испанский',
        'et' => 'Эстонский',
        'eu' => 'Баскский',
        'fa' => 'Персидский',
        'ff' => 'Fulah',
        'fi' => 'Финский',
        'fj' => 'Фиджи',
        'fo' => 'Фарерский',
        'fr' => 'Французский',
        'fy' => 'Фризский',
        'ga' => 'Ирландский',
        'gd' => 'Гаэльский',
        'gl' => 'Галисийский',
        'gn' => 'Гуарани',
        'gu' => 'Гуджарати',
        'gv' => 'Manx',
        'ha' => 'Хауса',
        'he' => 'Иврит',
        'hi' => 'Хинди',
        'ho' => 'Hiri Motu',
        'hr' => 'Хорватский',
        'ht' => 'Haitian',
        'hu' => 'Венгерский',
        'hy' => 'Армянский',
        'hz' => 'Herero',
        'ia' => 'Интерлингва',
        'id' => 'Индонезийский',
        'ie' => 'Интерлингве',
        'ig' => 'Igbo',
        'ii' => 'Sichuan Yi',
        'ik' => 'Инупиак',
        'io' => 'Ido',
        'is' => 'Исландский',
        'it' => 'Итальянский',
        'iu' => 'Инуктитут',
        'ja' => 'Японский',
        'jv' => 'Яванский',
        'ka' => 'Грузинский',
        'kg' => 'Kongo',
        'ki' => 'Kikuyu',
        'kj' => 'Kuanyama',
        'kk' => 'Казахский',
        'kl' => 'Эскимосский (гренландский)',
        'km' => 'Кхмерский',
        'kn' => 'Каннада',
        'ko' => 'Корейский',
        'kr' => 'Kanuri',
        'ks' => 'Кашмири',
        'ku' => 'Курдский',
        'kv' => 'Komi',
        'kw' => 'Cornish',
        'ky' => 'Киргизский',
        'la' => 'Латинский',
        'lb' => 'Luxembourgish',
        'lg' => 'Ganda',
        'li' => 'Limburgish',
        'ln' => 'Лингала',
        'lo' => 'Лаосский',
        'lt' => 'Литовский',
        'lu' => 'Луба-Катанга',
        'lv' => 'Латышский',
        'mg' => 'Малагасийский',
        'mh' => 'Marshallese',
        'mi' => 'Маори',
        'mk' => 'Македонский',
        'ml' => 'Малаялам',
        'mn' => 'Монгольский',
        'mo' => 'Молдавский',
        'mr' => 'Маратхи',
        'ms' => 'Малайский',
        'mt' => 'Мальтийский',
        'my' => 'Бирманский',
        'na' => 'Науру',
        'nb' => 'Norwegian Bokmål',
        'nd' => 'North Ndebele',
        'ne' => 'Непальский',
        'ng' => 'Ndonga',
        'nl' => 'Нидерландский (голландский)',
        'nn' => 'Norwegian Nynorsk',
        'no' => 'Норвежский',
        'nr' => 'South Ndebele',
        'nv' => 'Navajo',
        'ny' => 'Nyanja; Chichewa; Chewa',
        'oc' => 'Окситанский',
        'oj' => 'Оджибва',
        'om' => 'Оромо',
        'or' => 'Ория',
        'os' => 'Осетинский',
        'pa' => 'Панджаби (пенджаби)',
        'pi' => 'Пали',
        'pl' => 'Польский',
        'ps' => 'Пашто (пушту)',
        'pt' => 'Португальский',
        'qu' => 'Кечуа',
        'rm' => 'Ретороманский',
        'rn' => 'Рунди',
        'ro' => 'Румынский',
        'ru' => 'Русский',
        'rw' => 'Киньяруанда',
        'sa' => 'Санскрит',
        'sc' => 'Sardinian',
        'sd' => 'Синдхи',
        'se' => 'Northern Sami',
        'sg' => 'Санго',
        'sh' => 'Сербскохорватский',
        'si' => 'Сингальский',
        'sk' => 'Словацкий',
        'sl' => 'Словенский',
        'sm' => 'Самоанский',
        'sn' => 'Шона',
        'so' => 'Сомали',
        'sq' => 'Албанский',
        'sr' => 'Сербский',
        'ss' => 'Свази',
        'st' => 'Сото южный',
        'su' => 'Сунданский',
        'sv' => 'Шведский',
        'sw' => 'Суахили',
        'ta' => 'Тамильский',
        'te' => 'Телугу',
        'tg' => 'Таджикский',
        'th' => 'Тайский',
        'ti' => 'Тигринья',
        'tk' => 'Туркменский',
        'tl' => 'Тагалог',
        'tn' => 'Тсвана',
        'to' => 'Тонга',
        'tr' => 'Турецкий',
        'ts' => 'Тсонга',
        'tt' => 'Татарский',
        'tw' => 'Тви',
        'ty' => 'Tahitian',
        'ug' => 'Уйгурский',
        'uk' => 'Украинский',
        'ur' => 'Урду',
        'uz' => 'Узбекский',
        've' => 'Venda',
        'vi' => 'Вьетнамский',
        'vo' => 'Волапюк',
        'wa' => 'Walloon',
        'wo' => 'Волоф',
        'xh' => 'Коса',
        'yi' => 'Идиш',
        'yo' => 'Йоруба',
        'za' => 'Чжуань',
        'zh' => 'Китайский',
        'zu' => 'Зулу',
    );
}
// @codeCoverageIgnoreEnd