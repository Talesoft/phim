<?php

namespace Phim;

use Phim\Color\AlphaColorInterface;
use Phim\Color\AlphaInterface;
use Phim\Color\HslaColor;
use Phim\Color\HslColor;
use Phim\Color\HsvaColor;
use Phim\Color\HsvColor;
use Phim\Color\RgbaColor;
use Phim\Color\RgbColor;
use Phim\Exception\Runtime\NonExistentFunctionNameException;

class Color
{

    const FUNCTION_REGEX = '/(\w+)\(([^\)]+)\)/';

    const HUE_RANGE_RED = 'red';
    const HUE_RANGE_YELLOW = 'yellow';
    const HUE_RANGE_GREEN = 'green';
    const HUE_RANGE_CYAN = 'cyan';
    const HUE_RANGE_BLUE = 'blue';
    const HUE_RANGE_MAGENTA = 'magenta';

    const ABBIEXXXX = '#4c2f27';
    const ABSOLUTEZERO = '#0048ba';
    const ACIDGREEN = '#b0bf1a';
    const AERO = '#7cb9e8';
    const AEROBLUE = '#c9ffe5';
    const AFRICANVIOLET = '#b284be';
    const AIRFORCEBLUERAF = '#5d8aa8';
    const AIRFORCEBLUEUSAF = '#00308f';
    const AIRSUPERIORITYBLUE = '#72a0c1';
    const ALABAMACRIMSON = '#af002a';
    const ALABASTER = '#f2f0e6';
    const ALICEBLUE = '#f0f8ff';
    const ALIENARMPIT = '#84de02';
    const ALIZARINCRIMSON = '#e32636';
    const ALLOYORANGE = '#c46210';
    const ALMOND = '#efdecd';
    const AMARANTH = '#e52b50';
    const AMARANTHDEEPPURPLE = '#9f2b68';
    const AMARANTHPINK = '#f19cbb';
    const AMARANTHPURPLE = '#ab274f';
    const AMARANTHRED = '#d3212d';
    const AMAZON = '#3b7a57';
    const AMAZONITE = '#00c4b0';
    const AMBER = '#ffbf00';
    const AMBERSAEECE = '#ff7e00';
    const AMERICANROSE = '#ff033e';
    const AMETHYST = '#9966cc';
    const ANDROIDGREEN = '#a4c639';
    const ANTIFLASHWHITE = '#f2f3f4';
    const ANTIQUEBRASS = '#cd9575';
    const ANTIQUEBRONZE = '#665d1e';
    const ANTIQUEFUCHSIA = '#915c83';
    const ANTIQUERUBY = '#841b2d';
    const ANTIQUEWHITE = '#faebd7';
    const AOENGLISH = '#008000';
    const APPLEGREEN = '#8db600';
    const APRICOT = '#fbceb1';
    const AQUA = '#00ffff';
    const AQUAMARINE = '#7fffd4';
    const ARCTICLIME = '#d0ff14';
    const ARMYGREEN = '#4b5320';
    const ARSENIC = '#3b444b';
    const ARTICHOKE = '#8f9779';
    const ARYLIDEYELLOW = '#e9d66b';
    const ASHGREY = '#b2beb5';
    const ASPARAGUS = '#87a96b';
    const ATOMICTANGERINE = '#ff9966';
    const AUBURN = '#a52a2a';
    const AUREOLIN = '#fdee00';
    const AUROMETALSAURUS = '#6e7f80';
    const AVOCADO = '#568203';
    const AWESOME = '#ff2052';
    const AZTECGOLD = '#c39953';
    const AZURE = '#007fff';
    const AZUREISHWHITE = '#dbe9f4';
    const AZUREMIST = '#f0ffff';
    const AZUREWEBCOLOR = '#f0ffff';
    const BABYBLUE = '#89cff0';
    const BABYBLUEEYES = '#a1caf1';
    const BABYPINK = '#f4c2c2';
    const BABYPOWDER = '#fefefa';
    const BAKERMILLERPINK = '#ff91af';
    const BALLBLUE = '#21abcd';
    const BANANAMANIA = '#fae7b5';
    const BANANAYELLOW = '#ffe135';
    const BANGLADESHGREEN = '#006a4e';
    const BARBIEPINK = '#e0218a';
    const BARNRED = '#7c0a02';
    const BATTERYCHARGEDBLUE = '#1dacd6';
    const BATTLESHIPGREY = '#848482';
    const BAZAAR = '#98777b';
    const BDAZZLEDBLUE = '#2e5894';
    const BEAUBLUE = '#bcd4e6';
    const BEAVER = '#9f8170';
    const BEGONIA = '#fa6e79';
    const BEIGE = '#f5f5dc';
    const BIGDIPORUBY = '#9c2542';
    const BIGFOOTFEET = '#e88e5a';
    const BISQUE = '#ffe4c4';
    const BISTRE = '#3d2b1f';
    const BISTREBROWN = '#967117';
    const BITTERLEMON = '#cae00d';
    const BITTERLIME = '#bfff00';
    const BITTERSWEET = '#fe6f5e';
    const BITTERSWEETSHIMMER = '#bf4f51';
    const BLACK = '#000000';
    const BLACKBEAN = '#3d0c02';
    const BLACKCORAL = '#54626f';
    const BLACKLEATHERJACKET = '#253529';
    const BLACKOLIVE = '#3b3c36';
    const BLACKSHADOWS = '#bfafb2';
    const BLANCHEDALMOND = '#ffebcd';
    const BLASTOFFBRONZE = '#a57164';
    const BLEUDEFRANCE = '#318ce7';
    const BLIZZARDBLUE = '#ace5ee';
    const BLOND = '#faf0be';
    const BLUE = '#0000ff';
    const BLUEBELL = '#a2a2d0';
    const BLUEBERRY = '#4f86f7';
    const BLUEBOLT = '#00b9fb';
    const BLUEBONNET = '#1c1cf0';
    const BLUECRAYOLA = '#1f75fe';
    const BLUEGRAY = '#6699cc';
    const BLUEGREEN = '#0d98ba';
    const BLUEJEANS = '#5dadec';
    const BLUELAGOON = '#ace5ee';
    const BLUEMAGENTAVIOLET = '#553592';
    const BLUEMUNSELL = '#0093af';
    const BLUENCS = '#0087bd';
    const BLUEPANTONE = '#0018a8';
    const BLUEPIGMENT = '#333399';
    const BLUERYB = '#0247fe';
    const BLUESAPPHIRE = '#126180';
    const BLUEVIOLET = '#8a2be2';
    const BLUEYONDER = '#5072a7';
    const BLUSH = '#de5d83';
    const BOLE = '#79443b';
    const BONDIBLUE = '#0095b6';
    const BONE = '#e3dac9';
    const BOOGERBUSTER = '#dde26a';
    const BOSTONUNIVERSITYRED = '#cc0000';
    const BOTTLEGREEN = '#006a4e';
    const BOYSENBERRY = '#873260';
    const BRANDEISBLUE = '#0070ff';
    const BRASS = '#b5a642';
    const BRICKRED = '#cb4154';
    const BRIGHTCERULEAN = '#1dacd6';
    const BRIGHTGREEN = '#66ff00';
    const BRIGHTLAVENDER = '#bf94e4';
    const BRIGHTLILAC = '#d891ef';
    const BRIGHTMAROON = '#c32148';
    const BRIGHTNAVYBLUE = '#1974d2';
    const BRIGHTPINK = '#ff007f';
    const BRIGHTTURQUOISE = '#08e8de';
    const BRIGHTUBE = '#d19fe8';
    const BRIGHTYELLOWCRAYOLA = '#ffaa1d';
    const BRILLIANTAZURE = '#3399ff';
    const BRILLIANTLAVENDER = '#f4bbff';
    const BRILLIANTROSE = '#ff55a3';
    const BRINKPINK = '#fb607f';
    const BRITISHRACINGGREEN = '#004225';
    const BRONZE = '#cd7f32';
    const BRONZEYELLOW = '#737000';
    const BROWN = '#a52a2a';
    const BROWNNOSE = '#6b4423';
    const BROWNSUGAR = '#af6e4d';
    const BROWNTRADITIONAL = '#964b00';
    const BROWNWEB = '#a52a2a';
    const BROWNYELLOW = '#cc9966';
    const BRUNSWICKGREEN = '#1b4d3e';
    const BUBBLEGUM = '#ffc1cc';
    const BUBBLES = '#e7feff';
    const BUDGREEN = '#7bb661';
    const BUFF = '#f0dc82';
    const BULGARIANROSE = '#480607';
    const BURGUNDY = '#800020';
    const BURLYWOOD = '#deb887';
    const BURNISHEDBROWN = '#a17a74';
    const BURNTORANGE = '#cc5500';
    const BURNTSIENNA = '#e97451';
    const BURNTUMBER = '#8a3324';
    const BYZANTINE = '#bd33a4';
    const BYZANTIUM = '#702963';
    const CADET = '#536872';
    const CADETBLUE = '#5f9ea0';
    const CADETGREY = '#91a3b0';
    const CADMIUMGREEN = '#006b3c';
    const CADMIUMORANGE = '#ed872d';
    const CADMIUMRED = '#e30022';
    const CADMIUMYELLOW = '#fff600';
    const CAFAULAIT = '#a67b5b';
    const CAFNOIR = '#4b3621';
    const CALPOLYPOMONAGREEN = '#1e4d2b';
    const CAMBRIDGEBLUE = '#a3c1ad';
    const CAMEL = '#c19a6b';
    const CAMEOPINK = '#efbbcc';
    const CAMOUFLAGEGREEN = '#78866b';
    const CANARY = '#ffff99';
    const CANARYYELLOW = '#ffef00';
    const CANDYAPPLERED = '#ff0800';
    const CANDYPINK = '#e4717a';
    const CAPRI = '#00bfff';
    const CAPUTMORTUUM = '#592720';
    const CARDINAL = '#c41e3a';
    const CARIBBEANGREEN = '#00cc99';
    const CARMINE = '#960018';
    const CARMINEMP = '#d70040';
    const CARMINEPINK = '#eb4c42';
    const CARMINERED = '#ff0038';
    const CARNATIONPINK = '#ffa6c9';
    const CARNELIAN = '#b31b1b';
    const CAROLINABLUE = '#56a0d3';
    const CARROTORANGE = '#ed9121';
    const CASTLETONGREEN = '#00563f';
    const CATALINABLUE = '#062a78';
    const CATAWBA = '#703642';
    const CEDARCHEST = '#c95a49';
    const CEIL = '#92a1cf';
    const CELADON = '#ace1af';
    const CELADONBLUE = '#007ba7';
    const CELADONGREEN = '#2f847c';
    const CELESTE = '#b2ffff';
    const CELESTIALBLUE = '#4997d0';
    const CERISE = '#de3163';
    const CERISEPINK = '#ec3b83';
    const CERULEAN = '#007ba7';
    const CERULEANBLUE = '#2a52be';
    const CERULEANFROST = '#6d9bc3';
    const CGBLUE = '#007aa5';
    const CGRED = '#e03c31';
    const CHAMOISEE = '#a0785a';
    const CHAMPAGNE = '#f7e7ce';
    const CHAMPAGNEPINK = '#f1ddcf';
    const CHARCOAL = '#36454f';
    const CHARLESTONGREEN = '#232b2b';
    const CHARMPINK = '#e68fac';
    const CHARTREUSE = '#7fff00';
    const CHARTREUSETRADITIONAL = '#dfff00';
    const CHARTREUSEWEB = '#7fff00';
    const CHERRY = '#de3163';
    const CHERRYBLOSSOMPINK = '#ffb7c5';
    const CHESTNUT = '#954535';
    const CHINAPINK = '#de6fa1';
    const CHINAROSE = '#a8516e';
    const CHINESERED = '#aa381e';
    const CHINESEVIOLET = '#856088';
    const CHLOROPHYLLGREEN = '#4aff00';
    const CHOCOLATE = '#d2691e';
    const CHOCOLATETRADITIONAL = '#7b3f00';
    const CHOCOLATEWEB = '#d2691e';
    const CHROMEYELLOW = '#ffa700';
    const CINEREOUS = '#98817b';
    const CINNABAR = '#e34234';
    const CINNAMONCITATIONNEEDED = '#d2691e';
    const CINNAMONSATIN = '#cd607e';
    const CITRINE = '#e4d00a';
    const CITRON = '#9fa91f';
    const CLARET = '#7f1734';
    const CLASSICROSE = '#fbcce7';
    const COBALTBLUE = '#0047ab';
    const COCOABROWN = '#d2691e';
    const COCONUT = '#965a3e';
    const COFFEE = '#6f4e37';
    const COLUMBIABLUE = '#c4d8e2';
    const CONGOPINK = '#f88379';
    const COOLBLACK = '#002e63';
    const COOLGREY = '#8c92ac';
    const COPPER = '#b87333';
    const COPPERCRAYOLA = '#da8a67';
    const COPPERPENNY = '#ad6f69';
    const COPPERRED = '#cb6d51';
    const COPPERROSE = '#996666';
    const COQUELICOT = '#ff3800';
    const CORAL = '#ff7f50';
    const CORALPINK = '#f88379';
    const CORALRED = '#ff4040';
    const CORALREEF = '#fd7c6e';
    const CORDOVAN = '#893f45';
    const CORN = '#fbec5d';
    const CORNELLRED = '#b31b1b';
    const CORNFLOWERBLUE = '#6495ed';
    const CORNSILK = '#fff8dc';
    const COSMICCOBALT = '#2e2d88';
    const COSMICLATTE = '#fff8e7';
    const COTTONCANDY = '#ffbcd9';
    const COYOTEBROWN = '#81613c';
    const CREAM = '#fffdd0';
    const CRIMSON = '#dc143c';
    const CRIMSONGLORY = '#be0032';
    const CRIMSONRED = '#990000';
    const CULTURED = '#f5f5f5';
    const CYAN = '#00ffff';
    const CYANAZURE = '#4e82b4';
    const CYANBLUEAZURE = '#4682bf';
    const CYANCOBALTBLUE = '#28589c';
    const CYANCORNFLOWERBLUE = '#188bc2';
    const CYANPROCESS = '#00b7eb';
    const CYBERGRAPE = '#58427c';
    const CYBERYELLOW = '#ffd300';
    const CYCLAMEN = '#f56fa1';
    const DAFFODIL = '#ffff31';
    const DANDELION = '#f0e130';
    const DARKBLUE = '#00008b';
    const DARKBLUEGRAY = '#666699';
    const DARKBROWN = '#654321';
    const DARKBROWNTANGELO = '#88654e';
    const DARKBYZANTIUM = '#5d3954';
    const DARKCANDYAPPLERED = '#a40000';
    const DARKCERULEAN = '#08457e';
    const DARKCHESTNUT = '#986960';
    const DARKCORAL = '#cd5b45';
    const DARKCYAN = '#008b8b';
    const DARKELECTRICBLUE = '#536878';
    const DARKGOLDENROD = '#b8860b';
    const DARKGRAY = '#a9a9a9';
    const DARKGRAYX11 = '#a9a9a9';
    const DARKGREEN = '#013220';
    const DARKGREENX11 = '#006400';
    const DARKGREY = '#a9a9a9';
    const DARKGUNMETAL = '#1f262a';
    const DARKIMPERIALBLUE = '#00416a';
    const DARKJUNGLEGREEN = '#1a2421';
    const DARKKHAKI = '#bdb76b';
    const DARKLAVA = '#483c32';
    const DARKLAVENDER = '#734f96';
    const DARKLIVER = '#534b4f';
    const DARKLIVERHORSES = '#543d37';
    const DARKMAGENTA = '#8b008b';
    const DARKMEDIUMGRAY = '#a9a9a9';
    const DARKMIDNIGHTBLUE = '#003366';
    const DARKMOSSGREEN = '#4a5d23';
    const DARKOLIVEGREEN = '#556b2f';
    const DARKORANGE = '#ff8c00';
    const DARKORCHID = '#9932cc';
    const DARKPASTELBLUE = '#779ecb';
    const DARKPASTELGREEN = '#03c03c';
    const DARKPASTELPURPLE = '#966fd6';
    const DARKPASTELRED = '#c23b22';
    const DARKPINK = '#e75480';
    const DARKPOWDERBLUE = '#003399';
    const DARKPUCE = '#4f3a3c';
    const DARKPURPLE = '#301934';
    const DARKRASPBERRY = '#872657';
    const DARKRED = '#8b0000';
    const DARKSALMON = '#e9967a';
    const DARKSCARLET = '#560319';
    const DARKSEAGREEN = '#8fbc8f';
    const DARKSIENNA = '#3c1414';
    const DARKSKYBLUE = '#8cbed6';
    const DARKSLATEBLUE = '#483d8b';
    const DARKSLATEGRAY = '#2f4f4f';
    const DARKSLATEGREY = '#2f4f4f';
    const DARKSPRINGGREEN = '#177245';
    const DARKTAN = '#918151';
    const DARKTANGERINE = '#ffa812';
    const DARKTAUPE = '#483c32';
    const DARKTERRACOTTA = '#cc4e5c';
    const DARKTURQUOISE = '#00ced1';
    const DARKVANILLA = '#d1bea8';
    const DARKVIOLET = '#9400d3';
    const DARKYELLOW = '#9b870c';
    const DARTMOUTHGREEN = '#00703c';
    const DAVYSGREY = '#555555';
    const DEBIANRED = '#d70a53';
    const DEEPAQUAMARINE = '#40826d';
    const DEEPCARMINE = '#a9203e';
    const DEEPCARMINEPINK = '#ef3038';
    const DEEPCARROTORANGE = '#e9692c';
    const DEEPCERISE = '#da3287';
    const DEEPCHAMPAGNE = '#fad6a5';
    const DEEPCHESTNUT = '#b94e48';
    const DEEPCOFFEE = '#704241';
    const DEEPFUCHSIA = '#c154c1';
    const DEEPGREEN = '#056608';
    const DEEPGREENCYANTURQUOISE = '#0e7c61';
    const DEEPJUNGLEGREEN = '#004b49';
    const DEEPKOAMARU = '#333366';
    const DEEPLEMON = '#f5c71a';
    const DEEPLILAC = '#9955bb';
    const DEEPMAGENTA = '#cc00cc';
    const DEEPMAROON = '#820000';
    const DEEPMAUVE = '#d473d4';
    const DEEPMOSSGREEN = '#355e3b';
    const DEEPPEACH = '#ffcba4';
    const DEEPPINK = '#ff1493';
    const DEEPPUCE = '#a95c68';
    const DEEPRED = '#850101';
    const DEEPRUBY = '#843f5b';
    const DEEPSAFFRON = '#ff9933';
    const DEEPSKYBLUE = '#00bfff';
    const DEEPSPACESPARKLE = '#4a646c';
    const DEEPSPRINGBUD = '#556b2f';
    const DEEPTAUPE = '#7e5e60';
    const DEEPTUSCANRED = '#66424d';
    const DEEPVIOLET = '#330066';
    const DEER = '#ba8759';
    const DENIM = '#1560bd';
    const DENIMBLUE = '#2243b6';
    const DESATURATEDCYAN = '#669999';
    const DESERT = '#c19a6b';
    const DESERTSAND = '#edc9af';
    const DESIRE = '#ea3c53';
    const DIAMOND = '#b9f2ff';
    const DIMGRAY = '#696969';
    const DIMGREY = '#696969';
    const DINGYDUNGEON = '#c53151';
    const DIRT = '#9b7653';
    const DODGERBLUE = '#1e90ff';
    const DOGWOODROSE = '#d71868';
    const DOLLARBILL = '#85bb65';
    const DOLPHINGRAY = '#828e84';
    const DONKEYBROWN = '#664c28';
    const DRAB = '#967117';
    const DUKEBLUE = '#00009c';
    const DUSTSTORM = '#e5ccc9';
    const DUTCHWHITE = '#efdfbb';
    const EARTHYELLOW = '#e1a95f';
    const EBONY = '#555d50';
    const ECRU = '#c2b280';
    const EERIEBLACK = '#1b1b1b';
    const EGGPLANT = '#614051';
    const EGGSHELL = '#f0ead6';
    const EGYPTIANBLUE = '#1034a6';
    const ELECTRICBLUE = '#7df9ff';
    const ELECTRICCRIMSON = '#ff003f';
    const ELECTRICCYAN = '#00ffff';
    const ELECTRICGREEN = '#00ff00';
    const ELECTRICINDIGO = '#6f00ff';
    const ELECTRICLAVENDER = '#f4bbff';
    const ELECTRICLIME = '#ccff00';
    const ELECTRICPURPLE = '#bf00ff';
    const ELECTRICULTRAMARINE = '#3f00ff';
    const ELECTRICVIOLET = '#8f00ff';
    const ELECTRICYELLOW = '#ffff33';
    const EMERALD = '#50c878';
    const EMINENCE = '#6c3082';
    const ENGLISHGREEN = '#1b4d3e';
    const ENGLISHLAVENDER = '#b48395';
    const ENGLISHRED = '#ab4b52';
    const ENGLISHVERMILLION = '#cc474b';
    const ENGLISHVIOLET = '#563c5c';
    const ETONBLUE = '#96c8a2';
    const EUCALYPTUS = '#44d7a8';
    const FALLOW = '#c19a6b';
    const FALURED = '#801818';
    const FANDANGO = '#b53389';
    const FANDANGOPINK = '#de5285';
    const FASHIONFUCHSIA = '#f400a1';
    const FAWN = '#e5aa70';
    const FELDGRAU = '#4d5d53';
    const FELDSPAR = '#fdd5b1';
    const FERNGREEN = '#4f7942';
    const FERRARIRED = '#ff2800';
    const FIELDDRAB = '#6c541e';
    const FIERYROSE = '#ff5470';
    const FIREBRICK = '#b22222';
    const FIREENGINERED = '#ce2029';
    const FLAME = '#e25822';
    const FLAMINGOPINK = '#fc8eac';
    const FLATTERY = '#6b4423';
    const FLAVESCENT = '#f7e98e';
    const FLAX = '#eedc82';
    const FLIRT = '#a2006d';
    const FLORALWHITE = '#fffaf0';
    const FLUORESCENTORANGE = '#ffbf00';
    const FLUORESCENTPINK = '#ff1493';
    const FLUORESCENTYELLOW = '#ccff00';
    const FOLLY = '#ff004f';
    const FORESTGREEN = '#228b22';
    const FORESTGREENTRADITIONAL = '#014421';
    const FORESTGREENWEB = '#228b22';
    const FRENCHBEIGE = '#a67b5b';
    const FRENCHBISTRE = '#856d4d';
    const FRENCHBLUE = '#0072bb';
    const FRENCHFUCHSIA = '#fd3f92';
    const FRENCHLILAC = '#86608e';
    const FRENCHLIME = '#9efd38';
    const FRENCHMAUVE = '#d473d4';
    const FRENCHPINK = '#fd6c9e';
    const FRENCHPLUM = '#811453';
    const FRENCHPUCE = '#4e1609';
    const FRENCHRASPBERRY = '#c72c48';
    const FRENCHROSE = '#f64a8a';
    const FRENCHSKYBLUE = '#77b5fe';
    const FRENCHVIOLET = '#8806ce';
    const FRENCHWINE = '#ac1e44';
    const FRESHAIR = '#a6e7ff';
    const FROSTBITE = '#e936a7';
    const FUCHSIA = '#ff00ff';
    const FUCHSIACRAYOLA = '#c154c1';
    const FUCHSIAPINK = '#ff77ff';
    const FUCHSIAPURPLE = '#cc397b';
    const FUCHSIAROSE = '#c74375';
    const FULVOUS = '#e48400';
    const FUZZYWUZZY = '#cc6666';
    const GAINSBORO = '#dcdcdc';
    const GHOSTWHITE = '#f8f8ff';
    const GOLD = '#ffd700';
    const GOLDENROD = '#daa520';
    const GRAY = '#808080';
    const GREEN = '#008000';
    const GREENYELLOW = '#adff2f';
    const GREY = '#808080';
    const HONEYDEW = '#f0fff0';
    const HOTPINK = '#ff69b4';
    const INDIANRED = '#cd5c5c';
    const INDIGO = '#4b0082';
    const IVORY = '#fffff0';
    const KHAKI = '#f0e68c';
    const LAVENDER = '#e6e6fa';
    const LAVENDERBLUSH = '#fff0f5';
    const LAWNGREEN = '#7cfc00';
    const LEMONCHIFFON = '#fffacd';
    const LIGHTBLUE = '#add8e6';
    const LIGHTCORAL = '#f08080';
    const LIGHTCYAN = '#e0ffff';
    const LIGHTGOLDENRODYELLOW = '#fafad2';
    const LIGHTGRAY = '#d3d3d3';
    const LIGHTGREEN = '#90ee90';
    const LIGHTGREY = '#d3d3d3';
    const LIGHTPINK = '#ffb6c1';
    const LIGHTSALMON = '#ffa07a';
    const LIGHTSEAGREEN = '#20b2aa';
    const LIGHTSKYBLUE = '#87cefa';
    const LIGHTSLATEGRAY = '#778899';
    const LIGHTSLATEGREY = '#778899';
    const LIGHTSTEELBLUE = '#b0c4de';
    const LIGHTYELLOW = '#ffffe0';
    const LIME = '#00ff00';
    const LIMEGREEN = '#32cd32';
    const LINEN = '#faf0e6';
    const MAGENTA = '#ff00ff';
    const MAROON = '#800000';
    const MEDIUMAQUAMARINE = '#66cdaa';
    const MEDIUMBLUE = '#0000cd';
    const MEDIUMORCHID = '#ba55d3';
    const MEDIUMPURPLE = '#9370db';
    const MEDIUMSEAGREEN = '#3cb371';
    const MEDIUMSLATEBLUE = '#7b68ee';
    const MEDIUMSPRINGGREEN = '#00fa9a';
    const MEDIUMTURQUOISE = '#48d1cc';
    const MEDIUMVIOLETRED = '#c71585';
    const MIDNIGHTBLUE = '#191970';
    const MINTCREAM = '#f5fffa';
    const MISTYROSE = '#ffe4e1';
    const MOCCASIN = '#ffe4b5';
    const NAVAJOWHITE = '#ffdead';
    const NAVY = '#000080';
    const OLDLACE = '#fdf5e6';
    const OLIVE = '#808000';
    const OLIVEDRAB = '#6b8e23';
    const ORANGE = '#ffa500';
    const ORANGERED = '#ff4500';
    const ORCHID = '#da70d6';
    const PALEGOLDENROD = '#eee8aa';
    const PALEGREEN = '#98fb98';
    const PALETURQUOISE = '#afeeee';
    const PALEVIOLETRED = '#db7093';
    const PAPAYAWHIP = '#ffefd5';
    const PEACHPUFF = '#ffdab9';
    const PERU = '#cd853f';
    const PINK = '#ffc0cb';
    const PLUM = '#dda0dd';
    const POWDERBLUE = '#b0e0e6';
    const PURPLE = '#800080';
    const REBECCAPURPLE = '#663399';
    const RED = '#ff0000';
    const ROSYBROWN = '#bc8f8f';
    const ROYALBLUE = '#4169e1';
    const SADDLEBROWN = '#8b4513';
    const SALMON = '#fa8072';
    const SANDYBROWN = '#f4a460';
    const SEAGREEN = '#2e8b57';
    const SEASHELL = '#fff5ee';
    const SIENNA = '#a0522d';
    const SILVER = '#c0c0c0';
    const SKYBLUE = '#87ceeb';
    const SLATEBLUE = '#6a5acd';
    const SLATEGRAY = '#708090';
    const SLATEGREY = '#708090';
    const SNOW = '#fffafa';
    const SPRINGGREEN = '#00ff7f';
    const STEELBLUE = '#4682b4';
    const TAN = '#d2b48c';
    const TEAL = '#008080';
    const THISTLE = '#d8bfd8';
    const TOMATO = '#ff6347';
    const TURQUOISE = '#40e0d0';
    const VIOLET = '#ee82ee';
    const WHEAT = '#f5deb3';
    const WHITE = '#ffffff';
    const WHITESMOKE = '#f5f5f5';
    const YELLOW = '#ffff00';
    const YELLOWGREEN = '#9acd32';

    private static $functions = [
        'rgb' => RgbColor::class,
        'rgba' => RgbaColor::class,
        'hsl' => HslColor::class,
        'hsla' => HslaColor::class,
        'hsv' => HsvColor::class,
        'hsva' => HsvaColor::class
    ];

    private static $names = [
        'abbiexxxx' => self::ABBIEXXXX,
        'absolutezero' => self::ABSOLUTEZERO,
        'acidgreen' => self::ACIDGREEN,
        'aero' => self::AERO,
        'aeroblue' => self::AEROBLUE,
        'africanviolet' => self::AFRICANVIOLET,
        'airforceblueraf' => self::AIRFORCEBLUERAF,
        'airforceblueusaf' => self::AIRFORCEBLUEUSAF,
        'airsuperiorityblue' => self::AIRSUPERIORITYBLUE,
        'alabamacrimson' => self::ALABAMACRIMSON,
        'alabaster' => self::ALABASTER,
        'aliceblue' => self::ALICEBLUE,
        'alienarmpit' => self::ALIENARMPIT,
        'alizarincrimson' => self::ALIZARINCRIMSON,
        'alloyorange' => self::ALLOYORANGE,
        'almond' => self::ALMOND,
        'amaranth' => self::AMARANTH,
        'amaranthdeeppurple' => self::AMARANTHDEEPPURPLE,
        'amaranthpink' => self::AMARANTHPINK,
        'amaranthpurple' => self::AMARANTHPURPLE,
        'amaranthred' => self::AMARANTHRED,
        'amazon' => self::AMAZON,
        'amazonite' => self::AMAZONITE,
        'amber' => self::AMBER,
        'ambersaeece' => self::AMBERSAEECE,
        'americanrose' => self::AMERICANROSE,
        'amethyst' => self::AMETHYST,
        'androidgreen' => self::ANDROIDGREEN,
        'antiflashwhite' => self::ANTIFLASHWHITE,
        'antiquebrass' => self::ANTIQUEBRASS,
        'antiquebronze' => self::ANTIQUEBRONZE,
        'antiquefuchsia' => self::ANTIQUEFUCHSIA,
        'antiqueruby' => self::ANTIQUERUBY,
        'antiquewhite' => self::ANTIQUEWHITE,
        'aoenglish' => self::AOENGLISH,
        'applegreen' => self::APPLEGREEN,
        'apricot' => self::APRICOT,
        'aqua' => self::AQUA,
        'aquamarine' => self::AQUAMARINE,
        'arcticlime' => self::ARCTICLIME,
        'armygreen' => self::ARMYGREEN,
        'arsenic' => self::ARSENIC,
        'artichoke' => self::ARTICHOKE,
        'arylideyellow' => self::ARYLIDEYELLOW,
        'ashgrey' => self::ASHGREY,
        'asparagus' => self::ASPARAGUS,
        'atomictangerine' => self::ATOMICTANGERINE,
        'auburn' => self::AUBURN,
        'aureolin' => self::AUREOLIN,
        'aurometalsaurus' => self::AUROMETALSAURUS,
        'avocado' => self::AVOCADO,
        'awesome' => self::AWESOME,
        'aztecgold' => self::AZTECGOLD,
        'azure' => self::AZURE,
        'azureishwhite' => self::AZUREISHWHITE,
        'azuremist' => self::AZUREMIST,
        'azurewebcolor' => self::AZUREWEBCOLOR,
        'babyblue' => self::BABYBLUE,
        'babyblueeyes' => self::BABYBLUEEYES,
        'babypink' => self::BABYPINK,
        'babypowder' => self::BABYPOWDER,
        'bakermillerpink' => self::BAKERMILLERPINK,
        'ballblue' => self::BALLBLUE,
        'bananamania' => self::BANANAMANIA,
        'bananayellow' => self::BANANAYELLOW,
        'bangladeshgreen' => self::BANGLADESHGREEN,
        'barbiepink' => self::BARBIEPINK,
        'barnred' => self::BARNRED,
        'batterychargedblue' => self::BATTERYCHARGEDBLUE,
        'battleshipgrey' => self::BATTLESHIPGREY,
        'bazaar' => self::BAZAAR,
        'bdazzledblue' => self::BDAZZLEDBLUE,
        'beaublue' => self::BEAUBLUE,
        'beaver' => self::BEAVER,
        'begonia' => self::BEGONIA,
        'beige' => self::BEIGE,
        'bigdiporuby' => self::BIGDIPORUBY,
        'bigfootfeet' => self::BIGFOOTFEET,
        'bisque' => self::BISQUE,
        'bistre' => self::BISTRE,
        'bistrebrown' => self::BISTREBROWN,
        'bitterlemon' => self::BITTERLEMON,
        'bitterlime' => self::BITTERLIME,
        'bittersweet' => self::BITTERSWEET,
        'bittersweetshimmer' => self::BITTERSWEETSHIMMER,
        'black' => self::BLACK,
        'blackbean' => self::BLACKBEAN,
        'blackcoral' => self::BLACKCORAL,
        'blackleatherjacket' => self::BLACKLEATHERJACKET,
        'blackolive' => self::BLACKOLIVE,
        'blackshadows' => self::BLACKSHADOWS,
        'blanchedalmond' => self::BLANCHEDALMOND,
        'blastoffbronze' => self::BLASTOFFBRONZE,
        'bleudefrance' => self::BLEUDEFRANCE,
        'blizzardblue' => self::BLIZZARDBLUE,
        'blond' => self::BLOND,
        'blue' => self::BLUE,
        'bluebell' => self::BLUEBELL,
        'blueberry' => self::BLUEBERRY,
        'bluebolt' => self::BLUEBOLT,
        'bluebonnet' => self::BLUEBONNET,
        'bluecrayola' => self::BLUECRAYOLA,
        'bluegray' => self::BLUEGRAY,
        'bluegreen' => self::BLUEGREEN,
        'bluejeans' => self::BLUEJEANS,
        'bluelagoon' => self::BLUELAGOON,
        'bluemagentaviolet' => self::BLUEMAGENTAVIOLET,
        'bluemunsell' => self::BLUEMUNSELL,
        'bluencs' => self::BLUENCS,
        'bluepantone' => self::BLUEPANTONE,
        'bluepigment' => self::BLUEPIGMENT,
        'blueryb' => self::BLUERYB,
        'bluesapphire' => self::BLUESAPPHIRE,
        'blueviolet' => self::BLUEVIOLET,
        'blueyonder' => self::BLUEYONDER,
        'blush' => self::BLUSH,
        'bole' => self::BOLE,
        'bondiblue' => self::BONDIBLUE,
        'bone' => self::BONE,
        'boogerbuster' => self::BOOGERBUSTER,
        'bostonuniversityred' => self::BOSTONUNIVERSITYRED,
        'bottlegreen' => self::BOTTLEGREEN,
        'boysenberry' => self::BOYSENBERRY,
        'brandeisblue' => self::BRANDEISBLUE,
        'brass' => self::BRASS,
        'brickred' => self::BRICKRED,
        'brightcerulean' => self::BRIGHTCERULEAN,
        'brightgreen' => self::BRIGHTGREEN,
        'brightlavender' => self::BRIGHTLAVENDER,
        'brightlilac' => self::BRIGHTLILAC,
        'brightmaroon' => self::BRIGHTMAROON,
        'brightnavyblue' => self::BRIGHTNAVYBLUE,
        'brightpink' => self::BRIGHTPINK,
        'brightturquoise' => self::BRIGHTTURQUOISE,
        'brightube' => self::BRIGHTUBE,
        'brightyellowcrayola' => self::BRIGHTYELLOWCRAYOLA,
        'brilliantazure' => self::BRILLIANTAZURE,
        'brilliantlavender' => self::BRILLIANTLAVENDER,
        'brilliantrose' => self::BRILLIANTROSE,
        'brinkpink' => self::BRINKPINK,
        'britishracinggreen' => self::BRITISHRACINGGREEN,
        'bronze' => self::BRONZE,
        'bronzeyellow' => self::BRONZEYELLOW,
        'brown' => self::BROWN,
        'brownnose' => self::BROWNNOSE,
        'brownsugar' => self::BROWNSUGAR,
        'browntraditional' => self::BROWNTRADITIONAL,
        'brownweb' => self::BROWNWEB,
        'brownyellow' => self::BROWNYELLOW,
        'brunswickgreen' => self::BRUNSWICKGREEN,
        'bubblegum' => self::BUBBLEGUM,
        'bubbles' => self::BUBBLES,
        'budgreen' => self::BUDGREEN,
        'buff' => self::BUFF,
        'bulgarianrose' => self::BULGARIANROSE,
        'burgundy' => self::BURGUNDY,
        'burlywood' => self::BURLYWOOD,
        'burnishedbrown' => self::BURNISHEDBROWN,
        'burntorange' => self::BURNTORANGE,
        'burntsienna' => self::BURNTSIENNA,
        'burntumber' => self::BURNTUMBER,
        'byzantine' => self::BYZANTINE,
        'byzantium' => self::BYZANTIUM,
        'cadet' => self::CADET,
        'cadetblue' => self::CADETBLUE,
        'cadetgrey' => self::CADETGREY,
        'cadmiumgreen' => self::CADMIUMGREEN,
        'cadmiumorange' => self::CADMIUMORANGE,
        'cadmiumred' => self::CADMIUMRED,
        'cadmiumyellow' => self::CADMIUMYELLOW,
        'cafaulait' => self::CAFAULAIT,
        'cafnoir' => self::CAFNOIR,
        'calpolypomonagreen' => self::CALPOLYPOMONAGREEN,
        'cambridgeblue' => self::CAMBRIDGEBLUE,
        'camel' => self::CAMEL,
        'cameopink' => self::CAMEOPINK,
        'camouflagegreen' => self::CAMOUFLAGEGREEN,
        'canary' => self::CANARY,
        'canaryyellow' => self::CANARYYELLOW,
        'candyapplered' => self::CANDYAPPLERED,
        'candypink' => self::CANDYPINK,
        'capri' => self::CAPRI,
        'caputmortuum' => self::CAPUTMORTUUM,
        'cardinal' => self::CARDINAL,
        'caribbeangreen' => self::CARIBBEANGREEN,
        'carmine' => self::CARMINE,
        'carminemp' => self::CARMINEMP,
        'carminepink' => self::CARMINEPINK,
        'carminered' => self::CARMINERED,
        'carnationpink' => self::CARNATIONPINK,
        'carnelian' => self::CARNELIAN,
        'carolinablue' => self::CAROLINABLUE,
        'carrotorange' => self::CARROTORANGE,
        'castletongreen' => self::CASTLETONGREEN,
        'catalinablue' => self::CATALINABLUE,
        'catawba' => self::CATAWBA,
        'cedarchest' => self::CEDARCHEST,
        'ceil' => self::CEIL,
        'celadon' => self::CELADON,
        'celadonblue' => self::CELADONBLUE,
        'celadongreen' => self::CELADONGREEN,
        'celeste' => self::CELESTE,
        'celestialblue' => self::CELESTIALBLUE,
        'cerise' => self::CERISE,
        'cerisepink' => self::CERISEPINK,
        'cerulean' => self::CERULEAN,
        'ceruleanblue' => self::CERULEANBLUE,
        'ceruleanfrost' => self::CERULEANFROST,
        'cgblue' => self::CGBLUE,
        'cgred' => self::CGRED,
        'chamoisee' => self::CHAMOISEE,
        'champagne' => self::CHAMPAGNE,
        'champagnepink' => self::CHAMPAGNEPINK,
        'charcoal' => self::CHARCOAL,
        'charlestongreen' => self::CHARLESTONGREEN,
        'charmpink' => self::CHARMPINK,
        'chartreuse' => self::CHARTREUSE,
        'chartreusetraditional' => self::CHARTREUSETRADITIONAL,
        'chartreuseweb' => self::CHARTREUSEWEB,
        'cherry' => self::CHERRY,
        'cherryblossompink' => self::CHERRYBLOSSOMPINK,
        'chestnut' => self::CHESTNUT,
        'chinapink' => self::CHINAPINK,
        'chinarose' => self::CHINAROSE,
        'chinesered' => self::CHINESERED,
        'chineseviolet' => self::CHINESEVIOLET,
        'chlorophyllgreen' => self::CHLOROPHYLLGREEN,
        'chocolate' => self::CHOCOLATE,
        'chocolatetraditional' => self::CHOCOLATETRADITIONAL,
        'chocolateweb' => self::CHOCOLATEWEB,
        'chromeyellow' => self::CHROMEYELLOW,
        'cinereous' => self::CINEREOUS,
        'cinnabar' => self::CINNABAR,
        'cinnamoncitationneeded' => self::CINNAMONCITATIONNEEDED,
        'cinnamonsatin' => self::CINNAMONSATIN,
        'citrine' => self::CITRINE,
        'citron' => self::CITRON,
        'claret' => self::CLARET,
        'classicrose' => self::CLASSICROSE,
        'cobaltblue' => self::COBALTBLUE,
        'cocoabrown' => self::COCOABROWN,
        'coconut' => self::COCONUT,
        'coffee' => self::COFFEE,
        'columbiablue' => self::COLUMBIABLUE,
        'congopink' => self::CONGOPINK,
        'coolblack' => self::COOLBLACK,
        'coolgrey' => self::COOLGREY,
        'copper' => self::COPPER,
        'coppercrayola' => self::COPPERCRAYOLA,
        'copperpenny' => self::COPPERPENNY,
        'copperred' => self::COPPERRED,
        'copperrose' => self::COPPERROSE,
        'coquelicot' => self::COQUELICOT,
        'coral' => self::CORAL,
        'coralpink' => self::CORALPINK,
        'coralred' => self::CORALRED,
        'coralreef' => self::CORALREEF,
        'cordovan' => self::CORDOVAN,
        'corn' => self::CORN,
        'cornellred' => self::CORNELLRED,
        'cornflowerblue' => self::CORNFLOWERBLUE,
        'cornsilk' => self::CORNSILK,
        'cosmiccobalt' => self::COSMICCOBALT,
        'cosmiclatte' => self::COSMICLATTE,
        'cottoncandy' => self::COTTONCANDY,
        'coyotebrown' => self::COYOTEBROWN,
        'cream' => self::CREAM,
        'crimson' => self::CRIMSON,
        'crimsonglory' => self::CRIMSONGLORY,
        'crimsonred' => self::CRIMSONRED,
        'cultured' => self::CULTURED,
        'cyan' => self::CYAN,
        'cyanazure' => self::CYANAZURE,
        'cyanblueazure' => self::CYANBLUEAZURE,
        'cyancobaltblue' => self::CYANCOBALTBLUE,
        'cyancornflowerblue' => self::CYANCORNFLOWERBLUE,
        'cyanprocess' => self::CYANPROCESS,
        'cybergrape' => self::CYBERGRAPE,
        'cyberyellow' => self::CYBERYELLOW,
        'cyclamen' => self::CYCLAMEN,
        'daffodil' => self::DAFFODIL,
        'dandelion' => self::DANDELION,
        'darkblue' => self::DARKBLUE,
        'darkbluegray' => self::DARKBLUEGRAY,
        'darkbrown' => self::DARKBROWN,
        'darkbrowntangelo' => self::DARKBROWNTANGELO,
        'darkbyzantium' => self::DARKBYZANTIUM,
        'darkcandyapplered' => self::DARKCANDYAPPLERED,
        'darkcerulean' => self::DARKCERULEAN,
        'darkchestnut' => self::DARKCHESTNUT,
        'darkcoral' => self::DARKCORAL,
        'darkcyan' => self::DARKCYAN,
        'darkelectricblue' => self::DARKELECTRICBLUE,
        'darkgoldenrod' => self::DARKGOLDENROD,
        'darkgray' => self::DARKGRAY,
        'darkgrayx11' => self::DARKGRAYX11,
        'darkgreen' => self::DARKGREEN,
        'darkgreenx11' => self::DARKGREENX11,
        'darkgrey' => self::DARKGREY,
        'darkgunmetal' => self::DARKGUNMETAL,
        'darkimperialblue' => self::DARKIMPERIALBLUE,
        'darkjunglegreen' => self::DARKJUNGLEGREEN,
        'darkkhaki' => self::DARKKHAKI,
        'darklava' => self::DARKLAVA,
        'darklavender' => self::DARKLAVENDER,
        'darkliver' => self::DARKLIVER,
        'darkliverhorses' => self::DARKLIVERHORSES,
        'darkmagenta' => self::DARKMAGENTA,
        'darkmediumgray' => self::DARKMEDIUMGRAY,
        'darkmidnightblue' => self::DARKMIDNIGHTBLUE,
        'darkmossgreen' => self::DARKMOSSGREEN,
        'darkolivegreen' => self::DARKOLIVEGREEN,
        'darkorange' => self::DARKORANGE,
        'darkorchid' => self::DARKORCHID,
        'darkpastelblue' => self::DARKPASTELBLUE,
        'darkpastelgreen' => self::DARKPASTELGREEN,
        'darkpastelpurple' => self::DARKPASTELPURPLE,
        'darkpastelred' => self::DARKPASTELRED,
        'darkpink' => self::DARKPINK,
        'darkpowderblue' => self::DARKPOWDERBLUE,
        'darkpuce' => self::DARKPUCE,
        'darkpurple' => self::DARKPURPLE,
        'darkraspberry' => self::DARKRASPBERRY,
        'darkred' => self::DARKRED,
        'darksalmon' => self::DARKSALMON,
        'darkscarlet' => self::DARKSCARLET,
        'darkseagreen' => self::DARKSEAGREEN,
        'darksienna' => self::DARKSIENNA,
        'darkskyblue' => self::DARKSKYBLUE,
        'darkslateblue' => self::DARKSLATEBLUE,
        'darkslategray' => self::DARKSLATEGRAY,
        'darkslategrey' => self::DARKSLATEGREY,
        'darkspringgreen' => self::DARKSPRINGGREEN,
        'darktan' => self::DARKTAN,
        'darktangerine' => self::DARKTANGERINE,
        'darktaupe' => self::DARKTAUPE,
        'darkterracotta' => self::DARKTERRACOTTA,
        'darkturquoise' => self::DARKTURQUOISE,
        'darkvanilla' => self::DARKVANILLA,
        'darkviolet' => self::DARKVIOLET,
        'darkyellow' => self::DARKYELLOW,
        'dartmouthgreen' => self::DARTMOUTHGREEN,
        'davysgrey' => self::DAVYSGREY,
        'debianred' => self::DEBIANRED,
        'deepaquamarine' => self::DEEPAQUAMARINE,
        'deepcarmine' => self::DEEPCARMINE,
        'deepcarminepink' => self::DEEPCARMINEPINK,
        'deepcarrotorange' => self::DEEPCARROTORANGE,
        'deepcerise' => self::DEEPCERISE,
        'deepchampagne' => self::DEEPCHAMPAGNE,
        'deepchestnut' => self::DEEPCHESTNUT,
        'deepcoffee' => self::DEEPCOFFEE,
        'deepfuchsia' => self::DEEPFUCHSIA,
        'deepgreen' => self::DEEPGREEN,
        'deepgreencyanturquoise' => self::DEEPGREENCYANTURQUOISE,
        'deepjunglegreen' => self::DEEPJUNGLEGREEN,
        'deepkoamaru' => self::DEEPKOAMARU,
        'deeplemon' => self::DEEPLEMON,
        'deeplilac' => self::DEEPLILAC,
        'deepmagenta' => self::DEEPMAGENTA,
        'deepmaroon' => self::DEEPMAROON,
        'deepmauve' => self::DEEPMAUVE,
        'deepmossgreen' => self::DEEPMOSSGREEN,
        'deeppeach' => self::DEEPPEACH,
        'deeppink' => self::DEEPPINK,
        'deeppuce' => self::DEEPPUCE,
        'deepred' => self::DEEPRED,
        'deepruby' => self::DEEPRUBY,
        'deepsaffron' => self::DEEPSAFFRON,
        'deepskyblue' => self::DEEPSKYBLUE,
        'deepspacesparkle' => self::DEEPSPACESPARKLE,
        'deepspringbud' => self::DEEPSPRINGBUD,
        'deeptaupe' => self::DEEPTAUPE,
        'deeptuscanred' => self::DEEPTUSCANRED,
        'deepviolet' => self::DEEPVIOLET,
        'deer' => self::DEER,
        'denim' => self::DENIM,
        'denimblue' => self::DENIMBLUE,
        'desaturatedcyan' => self::DESATURATEDCYAN,
        'desert' => self::DESERT,
        'desertsand' => self::DESERTSAND,
        'desire' => self::DESIRE,
        'diamond' => self::DIAMOND,
        'dimgray' => self::DIMGRAY,
        'dimgrey' => self::DIMGREY,
        'dingydungeon' => self::DINGYDUNGEON,
        'dirt' => self::DIRT,
        'dodgerblue' => self::DODGERBLUE,
        'dogwoodrose' => self::DOGWOODROSE,
        'dollarbill' => self::DOLLARBILL,
        'dolphingray' => self::DOLPHINGRAY,
        'donkeybrown' => self::DONKEYBROWN,
        'drab' => self::DRAB,
        'dukeblue' => self::DUKEBLUE,
        'duststorm' => self::DUSTSTORM,
        'dutchwhite' => self::DUTCHWHITE,
        'earthyellow' => self::EARTHYELLOW,
        'ebony' => self::EBONY,
        'ecru' => self::ECRU,
        'eerieblack' => self::EERIEBLACK,
        'eggplant' => self::EGGPLANT,
        'eggshell' => self::EGGSHELL,
        'egyptianblue' => self::EGYPTIANBLUE,
        'electricblue' => self::ELECTRICBLUE,
        'electriccrimson' => self::ELECTRICCRIMSON,
        'electriccyan' => self::ELECTRICCYAN,
        'electricgreen' => self::ELECTRICGREEN,
        'electricindigo' => self::ELECTRICINDIGO,
        'electriclavender' => self::ELECTRICLAVENDER,
        'electriclime' => self::ELECTRICLIME,
        'electricpurple' => self::ELECTRICPURPLE,
        'electricultramarine' => self::ELECTRICULTRAMARINE,
        'electricviolet' => self::ELECTRICVIOLET,
        'electricyellow' => self::ELECTRICYELLOW,
        'emerald' => self::EMERALD,
        'eminence' => self::EMINENCE,
        'englishgreen' => self::ENGLISHGREEN,
        'englishlavender' => self::ENGLISHLAVENDER,
        'englishred' => self::ENGLISHRED,
        'englishvermillion' => self::ENGLISHVERMILLION,
        'englishviolet' => self::ENGLISHVIOLET,
        'etonblue' => self::ETONBLUE,
        'eucalyptus' => self::EUCALYPTUS,
        'fallow' => self::FALLOW,
        'falured' => self::FALURED,
        'fandango' => self::FANDANGO,
        'fandangopink' => self::FANDANGOPINK,
        'fashionfuchsia' => self::FASHIONFUCHSIA,
        'fawn' => self::FAWN,
        'feldgrau' => self::FELDGRAU,
        'feldspar' => self::FELDSPAR,
        'ferngreen' => self::FERNGREEN,
        'ferrarired' => self::FERRARIRED,
        'fielddrab' => self::FIELDDRAB,
        'fieryrose' => self::FIERYROSE,
        'firebrick' => self::FIREBRICK,
        'fireenginered' => self::FIREENGINERED,
        'flame' => self::FLAME,
        'flamingopink' => self::FLAMINGOPINK,
        'flattery' => self::FLATTERY,
        'flavescent' => self::FLAVESCENT,
        'flax' => self::FLAX,
        'flirt' => self::FLIRT,
        'floralwhite' => self::FLORALWHITE,
        'fluorescentorange' => self::FLUORESCENTORANGE,
        'fluorescentpink' => self::FLUORESCENTPINK,
        'fluorescentyellow' => self::FLUORESCENTYELLOW,
        'folly' => self::FOLLY,
        'forestgreen' => self::FORESTGREEN,
        'forestgreentraditional' => self::FORESTGREENTRADITIONAL,
        'forestgreenweb' => self::FORESTGREENWEB,
        'frenchbeige' => self::FRENCHBEIGE,
        'frenchbistre' => self::FRENCHBISTRE,
        'frenchblue' => self::FRENCHBLUE,
        'frenchfuchsia' => self::FRENCHFUCHSIA,
        'frenchlilac' => self::FRENCHLILAC,
        'frenchlime' => self::FRENCHLIME,
        'frenchmauve' => self::FRENCHMAUVE,
        'frenchpink' => self::FRENCHPINK,
        'frenchplum' => self::FRENCHPLUM,
        'frenchpuce' => self::FRENCHPUCE,
        'frenchraspberry' => self::FRENCHRASPBERRY,
        'frenchrose' => self::FRENCHROSE,
        'frenchskyblue' => self::FRENCHSKYBLUE,
        'frenchviolet' => self::FRENCHVIOLET,
        'frenchwine' => self::FRENCHWINE,
        'freshair' => self::FRESHAIR,
        'frostbite' => self::FROSTBITE,
        'fuchsia' => self::FUCHSIA,
        'fuchsiacrayola' => self::FUCHSIACRAYOLA,
        'fuchsiapink' => self::FUCHSIAPINK,
        'fuchsiapurple' => self::FUCHSIAPURPLE,
        'fuchsiarose' => self::FUCHSIAROSE,
        'fulvous' => self::FULVOUS,
        'fuzzywuzzy' => self::FUZZYWUZZY,
        'gainsboro' => self::GAINSBORO,
        'ghostwhite' => self::GHOSTWHITE,
        'gold' => self::GOLD,
        'goldenrod' => self::GOLDENROD,
        'gray' => self::GRAY,
        'green' => self::GREEN,
        'greenyellow' => self::GREENYELLOW,
        'grey' => self::GREY,
        'honeydew' => self::HONEYDEW,
        'hotpink' => self::HOTPINK,
        'indianred' => self::INDIANRED,
        'indigo' => self::INDIGO,
        'ivory' => self::IVORY,
        'khaki' => self::KHAKI,
        'lavender' => self::LAVENDER,
        'lavenderblush' => self::LAVENDERBLUSH,
        'lawngreen' => self::LAWNGREEN,
        'lemonchiffon' => self::LEMONCHIFFON,
        'lightblue' => self::LIGHTBLUE,
        'lightcoral' => self::LIGHTCORAL,
        'lightcyan' => self::LIGHTCYAN,
        'lightgoldenrodyellow' => self::LIGHTGOLDENRODYELLOW,
        'lightgray' => self::LIGHTGRAY,
        'lightgreen' => self::LIGHTGREEN,
        'lightgrey' => self::LIGHTGREY,
        'lightpink' => self::LIGHTPINK,
        'lightsalmon' => self::LIGHTSALMON,
        'lightseagreen' => self::LIGHTSEAGREEN,
        'lightskyblue' => self::LIGHTSKYBLUE,
        'lightslategray' => self::LIGHTSLATEGRAY,
        'lightslategrey' => self::LIGHTSLATEGREY,
        'lightsteelblue' => self::LIGHTSTEELBLUE,
        'lightyellow' => self::LIGHTYELLOW,
        'lime' => self::LIME,
        'limegreen' => self::LIMEGREEN,
        'linen' => self::LINEN,
        'magenta' => self::MAGENTA,
        'maroon' => self::MAROON,
        'mediumaquamarine' => self::MEDIUMAQUAMARINE,
        'mediumblue' => self::MEDIUMBLUE,
        'mediumorchid' => self::MEDIUMORCHID,
        'mediumpurple' => self::MEDIUMPURPLE,
        'mediumseagreen' => self::MEDIUMSEAGREEN,
        'mediumslateblue' => self::MEDIUMSLATEBLUE,
        'mediumspringgreen' => self::MEDIUMSPRINGGREEN,
        'mediumturquoise' => self::MEDIUMTURQUOISE,
        'mediumvioletred' => self::MEDIUMVIOLETRED,
        'midnightblue' => self::MIDNIGHTBLUE,
        'mintcream' => self::MINTCREAM,
        'mistyrose' => self::MISTYROSE,
        'moccasin' => self::MOCCASIN,
        'navajowhite' => self::NAVAJOWHITE,
        'navy' => self::NAVY,
        'oldlace' => self::OLDLACE,
        'olive' => self::OLIVE,
        'olivedrab' => self::OLIVEDRAB,
        'orange' => self::ORANGE,
        'orangered' => self::ORANGERED,
        'orchid' => self::ORCHID,
        'palegoldenrod' => self::PALEGOLDENROD,
        'palegreen' => self::PALEGREEN,
        'paleturquoise' => self::PALETURQUOISE,
        'palevioletred' => self::PALEVIOLETRED,
        'papayawhip' => self::PAPAYAWHIP,
        'peachpuff' => self::PEACHPUFF,
        'peru' => self::PERU,
        'pink' => self::PINK,
        'plum' => self::PLUM,
        'powderblue' => self::POWDERBLUE,
        'purple' => self::PURPLE,
        'rebeccapurple' => self::REBECCAPURPLE,
        'red' => self::RED,
        'rosybrown' => self::ROSYBROWN,
        'royalblue' => self::ROYALBLUE,
        'saddlebrown' => self::SADDLEBROWN,
        'salmon' => self::SALMON,
        'sandybrown' => self::SANDYBROWN,
        'seagreen' => self::SEAGREEN,
        'seashell' => self::SEASHELL,
        'sienna' => self::SIENNA,
        'silver' => self::SILVER,
        'skyblue' => self::SKYBLUE,
        'slateblue' => self::SLATEBLUE,
        'slategray' => self::SLATEGRAY,
        'slategrey' => self::SLATEGREY,
        'snow' => self::SNOW,
        'springgreen' => self::SPRINGGREEN,
        'steelblue' => self::STEELBLUE,
        'tan' => self::TAN,
        'teal' => self::TEAL,
        'thistle' => self::THISTLE,
        'tomato' => self::TOMATO,
        'turquoise' => self::TURQUOISE,
        'violet' => self::VIOLET,
        'wheat' => self::WHEAT,
        'white' => self::WHITE,
        'whitesmoke' => self::WHITESMOKE,
        'yellow' => self::YELLOW,
        'yellowgreen' => self::YELLOWGREEN
    ];

    private function __construct() {}

    /**
     * @return array
     */
    public static function getFunctions()
    {

        return self::$functions;
    }

    /**
     * @return array
     */
    public static function getNames()
    {

        return self::$names;
    }

    public static function getName(ColorInterface $color)
    {

        $hex = self::getHexString($color->withoutAlphaSupport(), true);

        $name = array_search($hex, self::$names, true);

        if ($name)
            return $name;

        return null;
    }

    public static function getHueRanges()
    {

        return [
            self::HUE_RANGE_RED,
            self::HUE_RANGE_YELLOW,
            self::HUE_RANGE_GREEN,
            self::HUE_RANGE_CYAN,
            self::HUE_RANGE_BLUE,
            self::HUE_RANGE_MAGENTA
        ];
    }

    public static function parseName($string)
    {

        $name = strtolower($string);

        if (!isset(self::$names[$name]))
            return null;

        return self::parseHexString(self::$names[$name]);
    }

    public static function registerName($name, $hexString)
    {

        self::$names[$name] = $hexString;
    }

    public static function parseHexString($string)
    {

        if (empty($string) || $string[0] !== '#')
            return null;

        $string = ltrim($string, '#');
        $len = strlen($string);
        switch ($len) {
            case 3:
                return new RgbColor(
                    hexdec(substr($string,0,1).substr($string,0,1)),
                    hexdec(substr($string,1,1).substr($string,1,1)),
                    hexdec(substr($string,2,1).substr($string,2,1))
                );
            case 4:
                return new RgbaColor(
                    hexdec(substr($string,0,1).substr($string,0,1)),
                    hexdec(substr($string,1,1).substr($string,1,1)),
                    hexdec(substr($string,2,1).substr($string,2,1)),
                    hexdec(substr($string,3,1).substr($string,3,1)) / 255
                );
            case 6:
                return new RgbColor(
                    hexdec(substr($string,0,2)),
                    hexdec(substr($string,2,2)),
                    hexdec(substr($string,4,2))
                );
            case 8:
                return new RgbColor(
                    hexdec(substr($string,0,2)),
                    hexdec(substr($string,2,2)),
                    hexdec(substr($string,4,2)),
                    hexdec(substr($string,6,2)) / 255
                );
        }

        throw new \InvalidArgumentException(
            "The color passed seems to be a hex string, but has neither 3-4 nor 6-8 characters"
        );
    }

    public static function parseFunctionString($string)
    {

        if (!preg_match(self::FUNCTION_REGEX, $string, $matches))
            return null;

        $function = $matches[1];
        $args = array_map('trim', explode(',', $matches[2]));

        if (!isset(self::$functions[$function]))
            return new NonExistentFunctionNameException(
                "Color function $function is not registered"
            );

        $className = self::$functions[$function];
        return new $className(...$args);
    }

    public static function getHexString(ColorInterface $color, $expand = false)
    {

        /** @var RgbaColor $rgb */
        $rgb = $color instanceof AlphaColorInterface
            ? $color->getRgba()
            : $color->getRgb();

        $hex = '#';
        $hex .= str_pad(dechex($rgb->getRed()), 2, '0', STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb->getGreen()), 2, '0', STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb->getBlue()), 2, '0', STR_PAD_LEFT);

        if ($rgb instanceof AlphaColorInterface)
            $hex .= str_pad(dechex($rgb->getAlpha() * 255), 2, '0', STR_PAD_LEFT);
        else if ($hex[1] === $hex[2] && $hex[3] === $hex[4] && $hex[5] === $hex[6] && !$expand)
            $hex = '#'.$hex[1].$hex[3].$hex[5];

        return $hex;
    }

    public static function fromString($string)
    {

        if (empty($string))
            return new RgbColor(0,0,0);

        if ($color = self::parseName($string))
            return $color;

        if ($color = self::parseHexString($string))
            return $color;

        if ($color = self::parseFunctionString($string))
            return $color;

        return null;
    }

    public static function get($color)
    {

        return $color instanceof ColorInterface
            ? $color
            : Color::fromString((string)$color);
    }

    public static function getMax(ColorInterface $color)
    {

        $rgb = $color->getRgb();
        return max($rgb->getRed(), $rgb->getGreen(), $rgb->getBlue());
    }

    public static function getMin(ColorInterface $color)
    {

        $rgb = $color->getRgb();
        return min($rgb->getRed(), $rgb->getGreen(), $rgb->getBlue());
    }

    public static function getAverage(ColorInterface $color)
    {

        $rgb = $color->getRgb();
        return (int)($rgb->getRed() + $rgb->getGreen() + $rgb->getBlue()) / 3;
    }

    public static function getHueRange($hue)
    {

        if ($hue >= 30 && $hue < 90)
            return self::HUE_RANGE_YELLOW;

        if ($hue >= 90 && $hue < 150)
            return self::HUE_RANGE_GREEN;

        if ($hue >= 150 && $hue < 210)
            return self::HUE_RANGE_CYAN;

        if ($hue >= 210 && $hue < 270)
            return self::HUE_RANGE_BLUE;

        if ($hue >= 270 && $hue < 330)
            return self::HUE_RANGE_MAGENTA;

        return self::HUE_RANGE_RED;
    }

    public static function isHueRange($hue, $range)
    {

        return self::getHueRange($hue) === $range;
    }

    public static function getColorHueRange(ColorInterface $color)
    {

        return self::getHueRange($color->getHsl()->getHue());
    }

    public static function isColorHueRange(ColorInterface $color, $range)
    {

        return self::isHueRange($color->getHsl()->getHue(), $range);
    }

    public static function mix(ColorInterface $color, ColorInterface $mixColor)
    {

        if ($color instanceof AlphaColorInterface) {

            $color = $color->getRgba();
            $mixColor = $mixColor->getRgba();

            return new RgbaColor(
                ($color->getRed() + $mixColor->getRed()) / 2,
                ($color->getGreen() + $mixColor->getGreen()) / 2,
                ($color->getBlue() + $mixColor->getBlue()) / 2,
                ($color->getAlpha() + $mixColor->getAlpha()) / 2
            );
        }

        $color = $color->getRgb();
        $mixColor = $mixColor->getRgb();

        return new RgbColor(
            ($color->getRed() + $mixColor->getRed()) / 2,
            ($color->getGreen() + $mixColor->getGreen()) / 2,
            ($color->getBlue() + $mixColor->getBlue()) / 2
        );
    }

    public static function inverse(ColorInterface $color)
    {

        if ($color instanceof AlphaColorInterface) {

            $color = $color->getRgba();

            return new RgbaColor(
                255 - $color->getRed(),
                255 - $color->getGreen(),
                255 - $color->getBlue(),
                $color->getAlpha()
            );
        }

        $color = $color->getRgb();

        return new RgbColor(
            255 - $color->getRed(),
            255 - $color->getGreen(),
            255 - $color->getBlue()
        );
    }

    public static function lighten(ColorInterface $color, $ratio)
    {

        if ($color instanceof AlphaColorInterface) {

            $hsla = $color->getHsla();
            return $hsla->withLightness($hsla->getLightness() + $ratio);
        }

        $hsl = $color->getHsl();
        return $hsl->withLightness($hsl->getLightness() + $ratio);
    }

    public static function darken(ColorInterface $color, $ratio)
    {

        if ($color instanceof AlphaColorInterface) {

            $hsla = $color->getHsla();
            return $hsla->withLightness($hsla->getLightness() - $ratio);
        }

        $hsl = $color->getHsl();
        return $hsl->withLightness($hsl->getLightness() - $ratio);
    }

    public static function saturate(ColorInterface $color, $ratio)
    {

        if ($color instanceof AlphaColorInterface) {

            $hsla = $color->getHsla();
            return $hsla->withSaturation($hsla->getSaturation() + $ratio);
        }

        $hsl = $color->getHsl();
        return $hsl->withSaturation($hsl->getSaturation() + $ratio);
    }

    public static function desaturate(ColorInterface $color, $ratio)
    {

        if ($color instanceof AlphaColorInterface) {

            $hsla = $color->getHsla();
            return $hsla->withSaturation($hsla->getSaturation() - $ratio);
        }

        $hsl = $color->getHsl();
        return $hsl->withSaturation($hsl->getSaturation() - $ratio);
    }

    public static function greyscale(ColorInterface $color)
    {

        if ($color instanceof AlphaColorInterface)
            return $color->getHsla()->withSaturation(0);

        return $color->getHsl()->withSaturation(0);
    }

    public static function complement(ColorInterface $color, $degrees = null)
    {

        $degrees = $degrees !== null ? $degrees : 180;

        if ($color instanceof AlphaColorInterface) {

            $hsla = $color->getHsla();
            return $hsla->withHue($hsla->getHue() + $degrees);
        }

        $hsl = $color->getHsl();
        return $hsl->withHue($hsl->getHue() + $degrees);
    }

    public static function fade(ColorInterface $color, $ratio)
    {

        $color = $color->withAlphaSupport();
        return $color->withAlpha($color->getAlpha() - $ratio);
    }

    public static function equals(ColorInterface $color, ColorInterface $compareColor, $tolerance = null, $ignoreAlpha = false)
    {

        $tolerance = $tolerance ?: 0;
        $color = $ignoreAlpha
            ? $color->getRgb()
            : $color->getRgba();

        $compareColor = $ignoreAlpha
            ? $compareColor->getRgb()
            : $compareColor->getRgba();

        if (abs($color->getRed() - $compareColor->getRed()) > $tolerance)
            return false;

        if (abs($color->getGreen() - $compareColor->getGreen()) > $tolerance)
            return false;

        if (abs($color->getBlue() - $compareColor->getBlue()) > $tolerance)
            return false;

        if (!$ignoreAlpha && abs($color->getAlpha() - $compareColor->getAlpha()) > ($tolerance / 255))
            return false;

        return true;
    }

    public static function getHtml(ColorInterface $color, int $width = null, int $height = null)
    {

        $width = $width ?: 120;
        $height = $height ?: 120;
        $color = $color->getRgba();
        $inversed = self::inverse($color)->getRgba();
        $name = self::getName($color);

        $hue = $color->getHsl()->getHue();
        return sprintf(
            '<div style="display: inline-block; vertical-align: middle; width: %dpx; height: %dpx; '.
            'background: %s; color: %s; font-size: 12px; font-family: Arial, sans-serif; '.
            'text-align: center; line-height: %dpx;">%s<br>%s<br>%s%s</div>',
            $width,
            $height,
            $color->getCssString(),
            $inversed->getCssString(),
            intval($height / 4),
            $color->getCssString(),
            Color::getHexString($color->getRgb()),
            self::getHueRange($hue)."->".round($hue, 2),
            $name ? "<br>$name" : ''
        );
    }
}