-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 17, 2023 at 02:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ostende`
--

-- --------------------------------------------------------

--
-- Table structure for table `animes`
--

CREATE TABLE `animes` (
  `animes_id` int(11) NOT NULL,
  `animes_name` varchar(200) NOT NULL,
  `animes_author` varchar(200) NOT NULL,
  `animes_date` int(11) NOT NULL,
  `animes_spoiler` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animes`
--

INSERT INTO `animes` (`animes_id`, `animes_name`, `animes_author`, `animes_date`, `animes_spoiler`) VALUES
(15, 'Another', 'Tsutomu Mizushima', 2012, 'ÜRES'),
(17, 'Fairy Tail', 'Hiro Mashima', 2009, 'A történet Fiore Királyságában játszódik, egy semleges országban, melyet 17 millióan laknak. Ez a mágia világa, a mágiát veszik és adják mindennap, az emberek életének szerves része és vannak, akiknek a mágia használata a foglalkozása. Ezeket az embereket nevezik varázslóknak. A varázslók különböző céhekbe tartoznak, és megbízások alapján végzik a munkájukat. Az országon belül több céh is létezik. Egy bizonyos városban, van egy bizonyos céh, egy céh, melyben már számos legenda született és továbbra is születni fog, ez a Fairy Tail.'),
(18, 'Bleach', 'Tite Kubo', 2004, 'A történet azzal kezdődik, hogy Kuchiki Rukia, egy sinigami (halálisten) megjelenik Kurosaki Ichigo szobájában. Meglepődik rajta, hogy Ichigo képes látni őt, mert a halálistenek és általában a szellemi lények a közönséges emberek számára láthatatlanok, csak a nagyon nagy vagy a nagyon kis szellemi energiával rendelkezők (értsd: haldoklók) képesek erre. Azonban nincs sok ideje meglepődni, mert egy lidérc (egy elkárhozott lélek) megtámadja Ichigo családját és meg kellene védenie őket. Azonban – egyéb okokból – alulmarad, és erejét Ichigonak adja, aki megvédi a testvéreit. Rukia szellemi energiája egyszerre felébreszti a saját belső erejét is, amit az édesapjától örökölt, mivel ő is halálisten, ami eddig rejtőzködött és képességeiben messze felülmúlja a legtöbb közönséges halálistenét is.'),
(20, 'Haikyuu', 'Haruichi Furudate', 2014, 'Az alsó-középiskolás Hinata Shouyo nagy álma, hogy kiemelkedő röplabdajátékos legyen. Azonban a fiú középiskolájában érdeklődés hiányában nem alakul röplabda szakkör, ahol tehetségét és ugróképességét fejleszteni tudná. Osztálytársai, akik kosárlabda, illetve futball szakkörre járnak, segítik őt a gyakorlásban. A gyakorlás során barátja egy igen magas feladása után mutatkozik meg kiemelkedő ugróképessége, melynek hatására sikerül meggyőznie a szakkörök tagjait, hogy nevezzenek be az alsó-középiskolás csapatok Miyagi prefektúrai röplabda bajnokságra, a Jukigaoka (雪ヶ丘) középiskola színeiben.'),
(21, 'Inuyasha', 'Takahasi Rumiko', 2000, 'A történet Tokióban kezdődik. Egy középiskolás lány: Higurashi Kagome elszökött macskáját keresi, miközben betéved a családja tulajdonában lévő shinto szentélybe. A szentély lefedett kútja megnyílik és Kagome tovább zuhan egy portálon keresztül a múltba, eközben életre kelti Mukade Jourót, a százlábú szörnyet, a benne levő ékkő segítségével. Mikor Kagome magához tér, a feudális Japán Sengoku korszakában találja magát. Egy közeli faluban találkozik egy papnővel Kaedével. A papnőnek azonnal feltűnik, hogy Kagome szinte megszólalásig hasonlít halott nővérére, Kikyou-ra (Kikyou jelentése \"harangvirág\").');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `books_id` int(11) NOT NULL,
  `books_name` varchar(200) NOT NULL,
  `books_author` varchar(200) NOT NULL,
  `books_date` int(11) NOT NULL,
  `books_spoiler` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`books_id`, `books_name`, `books_author`, `books_date`, `books_spoiler`) VALUES
(132, 'Nem a skarlát', 'Nathaniel Hawthorne', 1850, 'NINCS SPOILER'),
(133, 'Drakula', 'Bram Stoker', 1897, '120 évvel ezelőtt, 1897-ben jelent meg angolul a vámpírtörténetek klasszikusa. A dublini születésű Bram Stoker (1847-1912) Vámbéry Ármintól hallott Drakuláról. Hosszas könyvtári kutatómunka eredményeképpen írta meg ezt a fojtottan erotikus horrort, amelyből az idők során számos színpadi és filmfeldolgozás született. A vámpír gróf talán legemlékezetesebb megszemélyesítője mindmáig a „halhatatlan” Lugosi Béla.'),
(134, 'Üvöltő szelek', 'Emily Bronte', 1847, 'A gyermek Heathcliffet a skót felföld lápos vidékén találják. Mr. Earnshaw szíve megegesik az elhagyott fiún, és hazaviszi házába, ahol lányával, Cathyvel és fiával, Hindleyvel él együtt. Heathcliff az évek múltával beleszeret Cathybe. Ám a féltékeny Hindley mindenáron tönkre akarja tenni, ezért azon a napon, amikor Mr. Earnshaw meghal, az istállóba száműzi Heathcliffet. Nem sokkal később Cathy is elhagyja a házat, feleségül megy a szomszéd birtokos fiához, Edgar Lintonhoz. Heathcliff pedig szépen, lassan kiterveli rettenetes bosszúját…'),
(135, 'Hosszú az út lefelé', 'Jason Reynolds', 2017, 'Ha ​egy szerettedet megölik, találd meg a tettest és öld meg!  Tilos sírni!  Tilos besúgni!  Állj bosszút!'),
(136, 'Elizabeth', 'Kertész Erzsébet', 1948, '„Elizabethnek gyermekkori lovaglásai villantak fel emlékezetében, a boldog száguldások, majd a végzetes reggel, amikor a baleset érte. Azóta nem ült lovon, azóta nem érezte a hajnalok csípős ízét, azóta nem fogta el az a könnyű, boldog mámor, amit a mozgás öröme nyújt. Akkor kezdődött el fogolyélete…” A sápadt, sötét hajú lány, akit betegsége az ágyhoz köt, valóban a Wimpole Street foglya – s ahogy telnek-múlnak az évek, egyre kevesebb a reménye arra, hogy valaha is kiszabaduljon a komor falak közül. Nemcsak lehetősége, de ereje sincs a szökéshez. Nem tud, vagy nem akar megküzdeni apja zsarnoki hatalmával. Egy napon mégis megtörténik a csoda…'),
(137, 'Tóték', 'Örkény István', 1964, 'A ​Tóték című kisregény – az Egyperces novellák mellett – Örkény István (1912-1979) legismertebb és legjellegzetesebb műve. A könyv alakban először 1967-ben megjelent rövid, alig százoldalas írásban a szerző az abszurd és a groteszk csúcsait ostromolja – nem véletlen, hogy a kisregény, illetve az abból készült színpadi adaptáció nem egy mondata szállóigévé vált.'),
(138, 'Szentivánéji álom', 'William Shakespeare', 1600, 'Valószínűleg egy főúri esküvő alkalmára készült, s – korabeli szokás szerint – a lakodalmi ünnepség során mutatták be, a darab előadása a mulatság része volt. Témája és cselekménye ehhez az alkalomhoz igazodik: szerelemről és házasságról szól, a szerelem útjában álló akadályok legyőzéséről, a viszálykodó szerelmesek megbékéléséről, a szerelmet korlátozó tilalmak és a beteljesülésre fenekedő veszélyek elhárításáról. De a daraba kerete is első előadásának a körülményeit jeleníti meg, mégpedig játékosan és önirónikusan: miközben Shakespeare társulata eljátssza a Szentivánéji álom című darabot az alkalmul szolgáló főúru esküvőn, a szentivánéji álomban zajló királyi mennyegzőn Theseus, Hippolyta és a többiek mulattatására az athéni mesteremberek alkalmi színésztruppja is színre visz egy színdarabot,a Pyramus és Thisbe című – Vackor, az egiyk műkedvelő szereplő szavával – „igen siralma skomédiát”, amely egyébként szintén a szerelemről és annak veszélyeiről szól.');

--
-- Triggers `books`
--
DELIMITER $$
CREATE TRIGGER `finished_books_books_id` AFTER INSERT ON `books` FOR EACH ROW BEGIN
   INSERT INTO finished_books (finished_books_books_id)
   VALUES (NEW.books_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dramas`
--

CREATE TABLE `dramas` (
  `dramas_id` int(11) NOT NULL,
  `dramas_name` varchar(200) NOT NULL,
  `dramas_director` varchar(200) NOT NULL,
  `dramas_date` int(11) NOT NULL,
  `dramas_spoiler` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dramas`
--

INSERT INTO `dramas` (`dramas_id`, `dramas_name`, `dramas_director`, `dramas_date`, `dramas_spoiler`) VALUES
(25, 'Tóték', 'Örkény István', 1995, 'A második világháború idején, egy kis észak-magyarországi hegyvidéki községben él a Tót család, akinek (a lakosság többi tagjához hasonlóan) a fronton van a fiúk: Gyula. A darab a Postás monológjával nyit, melyben beszámol fogyatékosságáról és a Tót családhoz fűződő mély rajongásáról. A Postás különösen vonzódik a szimmetrikus dolgokhoz, Tótékat például azért szereti, mert négyen vannak. Bevallja továbbá, hogy manipulálja a leveleket. Bizonyos információkat nem ad át a címzetteknek, például Tótéknak a rossz híreket tartalmazó leveleket nem továbbítja.'),
(26, 'Rómeó és Júlia', 'William Shakespeare', 1597, 'A történet Verona olasz városban játszódik, ahol a két módos család élt, a Montague-k és a Capuletek, akik, bár már maguk sem tudják miért, de régi ellenségek voltak.'),
(27, 'Sok hűhó semmiért', 'William Shakespeare', 1612, 'A mű címében a \"semmi\" szó angol megfelelője (\"nothing\") többértelmű. Jelentései közül az egyik az \"észrevevés\"re utal, ugyanis a kora modern angol nyelvben a \"nothing\" szót hasonlóan ejtették ki a \"noting\" szóhoz. Ez alapján a művet lehet úgy is olvasni, mint az észrevevés komédiáját, hiszen a mű tele van kihallgatásokkal, hallomáson alapuló félreértésekkel, hazugságokkal és hiszékenységgel. Dogberry (Lasponya) Henry Stacy Marks festményén (1853.) ');

-- --------------------------------------------------------

--
-- Table structure for table `finished_animes`
--

CREATE TABLE `finished_animes` (
  `finished_animes_id` int(11) NOT NULL,
  `finished_animes_user_id` int(11) NOT NULL,
  `finished_animes_animes_id` int(11) NOT NULL,
  `finished_animes_rating` int(10) NOT NULL,
  `finished_animes_opinion` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finished_animes`
--

INSERT INTO `finished_animes` (`finished_animes_id`, `finished_animes_user_id`, `finished_animes_animes_id`, `finished_animes_rating`, `finished_animes_opinion`) VALUES
(30, 5, 21, 10, 'Örök klasszikus. Imádtam.'),
(31, 5, 18, 7, 'Hihetetlenül jó történettel rendelkezik! Bár ne tartana 3-4 részen át egy harcjelenet. Emellett sokszor érzem azt, hogy csak húzzák az időt :(');

-- --------------------------------------------------------

--
-- Table structure for table `finished_books`
--

CREATE TABLE `finished_books` (
  `finished_books_id` int(11) NOT NULL,
  `finished_books_user_id` int(11) DEFAULT NULL,
  `finished_books_books_id` int(11) DEFAULT NULL,
  `finished_books_rating` int(10) DEFAULT NULL,
  `finished_books_opinion` varchar(3000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finished_books`
--

INSERT INTO `finished_books` (`finished_books_id`, `finished_books_user_id`, `finished_books_books_id`, `finished_books_rating`, `finished_books_opinion`) VALUES
(157, 5, 132, 2, 'Nem volt jó'),
(164, 9, 134, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `finished_dramas`
--

CREATE TABLE `finished_dramas` (
  `finished_dramas_id` int(11) NOT NULL,
  `finished_dramas_user_id` int(11) NOT NULL,
  `finished_dramas_dramas_id` int(11) NOT NULL,
  `finished_dramas_rating` int(10) NOT NULL,
  `finished_dramas_opinion` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finished_dramas`
--

INSERT INTO `finished_dramas` (`finished_dramas_id`, `finished_dramas_user_id`, `finished_dramas_dramas_id`, `finished_dramas_rating`, `finished_dramas_opinion`) VALUES
(5, 5, 25, 8, 'Számomra lassan indult be a történet. Ettől eltekintve fantasztikus volt!');

-- --------------------------------------------------------

--
-- Table structure for table `finished_movies`
--

CREATE TABLE `finished_movies` (
  `finished_movies_id` int(11) NOT NULL,
  `finished_movies_user_id` int(11) NOT NULL,
  `finished_movies_movies_id` int(11) NOT NULL,
  `finished_movies_rating` int(10) NOT NULL,
  `finished_movies_opinion` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finished_movies`
--

INSERT INTO `finished_movies` (`finished_movies_id`, `finished_movies_user_id`, `finished_movies_movies_id`, `finished_movies_rating`, `finished_movies_opinion`) VALUES
(9, 9, 34, 10, 'Nekem nagyon tetszett, tökéletes bemutatása annak, hogy bárki építhet a semmiből egy piacvezető céget, viszont azt is, hogy mibe kerülhet ez a magánéletünkből.');

-- --------------------------------------------------------

--
-- Table structure for table `finished_tvshows`
--

CREATE TABLE `finished_tvshows` (
  `finished_tvshows_id` int(11) NOT NULL,
  `finished_tvshows_user_id` int(11) NOT NULL,
  `finished_tvshows_tvshows_id` int(11) NOT NULL,
  `finished_tvshows_rating` int(10) NOT NULL,
  `finished_tvshows_opinion` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finished_tvshows`
--

INSERT INTO `finished_tvshows` (`finished_tvshows_id`, `finished_tvshows_user_id`, `finished_tvshows_tvshows_id`, `finished_tvshows_rating`, `finished_tvshows_opinion`) VALUES
(2, 9, 14, 9, 'Abszolút kasszasiker sorozat, alig bírtam felállni a TV elöl. Hatalmasat alkottak a színészek is. Bár az évadok között lehetett volna kevesebb szünet, meg hosszabb epizódok, de így is jó.');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movies_id` int(11) NOT NULL,
  `movies_name` varchar(200) NOT NULL,
  `movies_director` varchar(200) NOT NULL,
  `movies_date` int(11) NOT NULL,
  `movies_spoiler` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movies_id`, `movies_name`, `movies_director`, `movies_date`, `movies_spoiler`) VALUES
(34, 'A Wall Street farkasa', 'Martin Scorsese', 2013, 'A Wall Street farkasa egy 2013-ban bemutatott amerikai önéletrajzi filmdráma, melyet az Oscar-díjas Martin Scorsese rendezett. A címszereplőt Leonardo DiCaprio személyesíti meg.'),
(35, 'Beavatott', 'Neil Burger', 2014, 'Beatrice Prior a disztopikus Chicagóban él, ahol a társadalom öt csoportra tagolódik, ezeknek mindegyike egy-egy erény kiművelését írja elő a tagjai számára. Az év egy bizonyos napján a 16 éveseknek el kell dönteniük, hova akarnak tartozni: a Bátrakhoz, az Őszintékhez, az Önfeláldozókhoz, a Barátságosakhoz, vagy a Műveltekhez. Ennek kell szentelniük életük hátralevő részét. Beatrice azonban egyikbe sem illik bele, ő ugyanis Elfajzott, és mivel kilóg a sorból, veszélyesnek számít. Ingadozik aközött, hogy a családjával maradjon-e, vagy önmagává váljon. Olyan döntést hoz, amely mindenki számára meglepetést jelent, még önmagának is.'),
(36, 'Útvesztő', 'Wes Ball', 2014, 'Egy fiú (Thomas) felébred egy elrozsdásodott szolgálati lift belsejében, nem emlékezve semmire. Ahogy a föld alól felér a felszínre, egy csapat hujjogó srác közt találja magát egy nagy füves területen, az úgynevezett „Tisztáson”. Ez egy nagy zárt négyzet, melyet magas kőfalak kerítenek el. A fiúk ezen a területen élnek, jól szervezett, összetartó csapatként, de kiderül, hogy mindannyian elveszítették az emlékeiket, és Thomas-hoz hasonlóan, rémülten, egyesével, a lifttel („doboz”) jutottak ide. Az ismeretlenek („Alkotók”) már több mint 3 éve minden hónapban új fiút küldenek fel a felvonóval. Bár a felvonóval élelem és felszerelés is rendszeresen érkezik, a srácok egy önellátásra törekvő minitársadalmat alakítottak ki, vezetőkkel, szabályokkal, feladatmegosztással és büntetési rendszerrel.'),
(37, 'Gladiátor', 'Ridley Scott', 2000, 'A történet – amely csak néhány ponton követi a római birodalom ismert történetét – Kr.u. 180-ban kezdődik, Marcus Aurelius utolsó hódító hadjáratán: a rómaiak megnyerik az utolsó csatát is a barbár germánok ellen. A csata után Maximusnak, a hadvezérnek egyetlen vágya, hogy hazatérhessen a családjához.'),
(38, 'Alkonyat', 'Catherine Hardwicke', 2008, 'Isabella Marie Swan az apjához költözik a Washington állambeli Forks nevű városkába. Érkezését mindenki szívesen fogadja, mindenki barátságos a visszahúzódó természetű lánnyal. Egy család van, akik nem vesznek tudomást az érkezéséről: a Cullenek. Bellának feltűnik, hogy Edward Antony Cullen kerüli első közös órájuk óta. Bella észreveszi, hogy a Culleneknek van valami közös titkuk, amit Bella egy kirándulás során a La Push parton egy gyerekkori barátjától, Jacob Black-től tud meg, miszerint egy ősi legenda szerint Cullenék az indiánok ősi ellenségei, „mások”. Bella nyomozni kezd és rádöbben, hogy Edward vámpír, azonban ez Bellát nem riasztja vissza.'),
(39, 'Más ritmusra', 'Laura Terruso', 2020, 'Egy fiatal lány, Quinn Ackerman jelentkezik a Duke Egyetemre, amiről mindig is álmodott. Az odavaló felvétele, az általa hazudott táncversenyétől függ. Ezért szedett-vetett táncos csapatot toboroz, hogy legyőzze az iskola legjobb csoportját. Felkeresi a profi tánckoreográfus Jake Taylort, aki megtanítja őket a tánc egyes fortélyaira.  Az idő múlásával Quinn és Jake szerelmesek lesznek egymásba.'),
(40, 'Táncra fel', 'Elissa Down', 2020, 'Miután April Dibrinának félresikerül egy táncos meghallgatása egy Broadway-darabra, az egocentrikus lány hazatér, és elvállalja egy csapat gyerek felkészítését az ottani tánciskolában.');

-- --------------------------------------------------------

--
-- Table structure for table `tvshows`
--

CREATE TABLE `tvshows` (
  `tvshows_id` int(11) NOT NULL,
  `tvshows_name` varchar(200) NOT NULL,
  `tvshows_director` varchar(200) NOT NULL,
  `tvshows_date` int(11) NOT NULL,
  `tvshows_spoiler` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tvshows`
--

INSERT INTO `tvshows` (`tvshows_id`, `tvshows_name`, `tvshows_director`, `tvshows_date`, `tvshows_spoiler`) VALUES
(14, 'Peaky Blinders', 'Otto Bathurst, Tom Harper, Colm McCarthy, Tim Mielants, David Caffrey, Anthony Byrne', 2013, 'A Birmingham bandája brit történelmi bűnügyi drámasorozat, melyet Steven Knight alkotott meg. Az angliai Birminghamben játszódó történet a Peaky Blinders néven hírhedt Shelby bűnözőcsalád történetét dolgozza fel a 20. század első évtizedeiben, az első világháború befejeződésével kezdődően.'),
(15, 'Ginny és Georgia', ' Sarah Lampert, Debra J. Fisher, Ali Laventhol, Briana Belser, Mike Gauyo, Danielle Hoover', 2021, 'A 15 éves Ginny Miller érettebb, mint 30 éves anyja, Georgia. A nő úgy dönt, letelepedik lányával, Ginnyvel és fiával, Austinnal egy New England-i városban, hogy jobb életet biztosítson nekik, mint amilyen neki volt.'),
(16, 'Riverdale', 'Roberto Aguirre-Sacasa', 2017, 'A sorozat a Riverdale nevű kisváros életébe enged bepillantást egy egész várost megrázó, tragikus esemény után. A közelmúltban rejtélyes módon elhunyt Jason Blossom, az iskola egyik népszerű diákja. Az idillinek tűnő kisváros sötét oldalával ismerkedhetünk meg, ahol mindennaposak a hazugságok és a rejtélyek. A középpontban Jughead Jones (Cole Sprouse), Betty Cooper (Lili Reinhart), Archie Andrews (K.J. Apa), Veronica Lodge (Camila Mendes) és barátaik állnak. Sok titokra fény derül és ettől lesz a sorozat még izgalmasabb.'),
(17, 'Vámpírnaplók', ' Chris Grismer, John Behring, John Dahl, J. Miller Tobin', 2009, 'A sorozat egy 162 éves vámpír, Stefan Salvatore(Paul Wesley) életét követi, aki szerelmes lesz egy 17 éves lányba, Elena Gilbertbe (Nina Dobrev). A kapcsolatuk egyre inkább bonyolulttá válik, amikor visszatér Mystic Fallsba Stefan gonosz és rosszakaratú bátyja, Damon (Ian Somerhalder), aki azt tervezi, hogy elpusztítja a várost, és vérbosszút áll az öccsén. Mindkét testvér érdeklődni kezd Elena iránt, főként a múltbéli szerelmükkel, Katherine-nel (Nina Dobrev) való hasonlósága miatt. Kiderül, hogy Elena, aki Katherine távoli rokona, Katherine hasonmása is egyben. Katherine végül visszatér a városba a testvérek és a lány elleni tervekkel.'),
(18, 'Bridgerton', 'Shonda Rhimes, Sarah Dollard', 2020, 'A Bridgerton krónikája ( Bridgerton ) egy Chris Van Dusen (in) által létrehozott amerikai televíziós sorozat , Julia Quinn azonos című könyvsorozat alapján , amelyet az  2020. december 25a Netflix-en .  Shonda Rhimes által gyártott sorozat az angol regency idején a magas londoni társadalomban játszódik .'),
(19, 'Emily Párizsban', 'Stephen Brown, Jake Fuller', 2020, 'Az Emily Párizsban egy amerikai romantikus komédiasorozat, amelyet Darren Star hozott létre és a Netflix mutatta be. A főszerepben Lily Collins látható, aki Emily Coopert, a feltörekvő marketingest alakítja. Emily a felettese helyett kell hogy elutazzon Párizsba, hogy egy ottani cégnél képviselje az amerikai nézőpontot. Eleinte nagyon nehezen illeszkedik be a kulturális és nyelvi különbségek miatt, és a szerelmi élete is hullámvölgyekkel tarkított, később azonban megtalálja a számítását.'),
(20, 'Lucifer', 'Len Wiseman Kevin Alejandro', 2016, 'Lucifer Morningstar ténylegesen maga az ördög, a pokol ura, de már öt éve a halandók között, a földön él. A lázadó természetű Lucifer atyja, az őt a mennyből a pokolba száműző Isten akaratával dacolva hagyta el a poklot. A földre magával hozta a pokol egyik démonát és kínzómesterét, az emberi alakjában nő Mazikeent, becenevén Maze-t. Miután Lucifer maga is angyal, érkezésüket követően kérésére Maze levágja az angyalszárnyait. Ironikus módon az „Angyalok városában”, azaz Los Angeles-ben telepszenek le, ahol Lucifer beindítja a jól menő, exkluzív Lux bárt.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_password` varchar(60) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_email`, `user_type`) VALUES
(1, 'felh', '39946435bc996564e35fa7d147d751e1', 'tesztes@emailcim.hu', 0),
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@ostende.hu', 1),
(8, 'attila', '924aa6d6b41b64dbe31461d1cea1d803', 'attila@molnar.work', 0),
(9, 'Attila', '29a1fb8b74acddd3583067ab141e1f89', 'szele@gmail.com', 1),
(10, 'Krisz', '7f39688dd567e7bb9c124e20400f23b3', 'krisz@gmail.com', 1),
(11, 'Norbi', '20d134a1c17523653c4cc16321cd853e', 'norbi@gmail.com', 1),
(12, 'Zsolti', 'fa1ac7ff47a4e162bdfbc778cf2f90d6', 'zsolti@gmail.com', 1),
(13, 'Brub', 'd7a83e50d25f3c00e78ae376b78618b4', 'brub@gmail.com', 1),
(14, 'Riickyii', 'd4ba767d7db4b31cc331f1c0448a43a7', 'krausz.miron@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animes`
--
ALTER TABLE `animes`
  ADD PRIMARY KEY (`animes_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`books_id`);

--
-- Indexes for table `dramas`
--
ALTER TABLE `dramas`
  ADD PRIMARY KEY (`dramas_id`);

--
-- Indexes for table `finished_animes`
--
ALTER TABLE `finished_animes`
  ADD PRIMARY KEY (`finished_animes_id`),
  ADD KEY `finished_animes_user_id` (`finished_animes_user_id`,`finished_animes_animes_id`),
  ADD KEY `finished_animes_animes_id` (`finished_animes_animes_id`);

--
-- Indexes for table `finished_books`
--
ALTER TABLE `finished_books`
  ADD PRIMARY KEY (`finished_books_id`),
  ADD KEY `finished_books_books_id` (`finished_books_books_id`),
  ADD KEY `finished_books_user_id` (`finished_books_user_id`);

--
-- Indexes for table `finished_dramas`
--
ALTER TABLE `finished_dramas`
  ADD PRIMARY KEY (`finished_dramas_id`),
  ADD KEY `finished_dramas_user_id` (`finished_dramas_user_id`,`finished_dramas_dramas_id`),
  ADD KEY `finished_dramas_dramas_id` (`finished_dramas_dramas_id`);

--
-- Indexes for table `finished_movies`
--
ALTER TABLE `finished_movies`
  ADD PRIMARY KEY (`finished_movies_id`),
  ADD KEY `finished_movies_user_id` (`finished_movies_user_id`,`finished_movies_movies_id`),
  ADD KEY `finished_movies_movies_id` (`finished_movies_movies_id`);

--
-- Indexes for table `finished_tvshows`
--
ALTER TABLE `finished_tvshows`
  ADD PRIMARY KEY (`finished_tvshows_id`),
  ADD KEY `finished_tvshows_user_id` (`finished_tvshows_user_id`,`finished_tvshows_tvshows_id`),
  ADD KEY `finished_tvshows_tvshows_id` (`finished_tvshows_tvshows_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movies_id`);

--
-- Indexes for table `tvshows`
--
ALTER TABLE `tvshows`
  ADD PRIMARY KEY (`tvshows_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animes`
--
ALTER TABLE `animes`
  MODIFY `animes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `books_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `dramas`
--
ALTER TABLE `dramas`
  MODIFY `dramas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `finished_animes`
--
ALTER TABLE `finished_animes`
  MODIFY `finished_animes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `finished_books`
--
ALTER TABLE `finished_books`
  MODIFY `finished_books_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `finished_dramas`
--
ALTER TABLE `finished_dramas`
  MODIFY `finished_dramas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `finished_movies`
--
ALTER TABLE `finished_movies`
  MODIFY `finished_movies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `finished_tvshows`
--
ALTER TABLE `finished_tvshows`
  MODIFY `finished_tvshows_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tvshows`
--
ALTER TABLE `tvshows`
  MODIFY `tvshows_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `finished_animes`
--
ALTER TABLE `finished_animes`
  ADD CONSTRAINT `finished_animes_ibfk_1` FOREIGN KEY (`finished_animes_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `finished_animes_ibfk_2` FOREIGN KEY (`finished_animes_animes_id`) REFERENCES `animes` (`animes_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `finished_books`
--
ALTER TABLE `finished_books`
  ADD CONSTRAINT `finished_books_ibfk_1` FOREIGN KEY (`finished_books_books_id`) REFERENCES `books` (`books_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `finished_books_ibfk_2` FOREIGN KEY (`finished_books_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `finished_dramas`
--
ALTER TABLE `finished_dramas`
  ADD CONSTRAINT `finished_dramas_ibfk_1` FOREIGN KEY (`finished_dramas_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `finished_dramas_ibfk_2` FOREIGN KEY (`finished_dramas_dramas_id`) REFERENCES `dramas` (`dramas_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `finished_movies`
--
ALTER TABLE `finished_movies`
  ADD CONSTRAINT `finished_movies_ibfk_1` FOREIGN KEY (`finished_movies_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `finished_movies_ibfk_2` FOREIGN KEY (`finished_movies_movies_id`) REFERENCES `movies` (`movies_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `finished_tvshows`
--
ALTER TABLE `finished_tvshows`
  ADD CONSTRAINT `finished_tvshows_ibfk_1` FOREIGN KEY (`finished_tvshows_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `finished_tvshows_ibfk_2` FOREIGN KEY (`finished_tvshows_tvshows_id`) REFERENCES `tvshows` (`tvshows_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
