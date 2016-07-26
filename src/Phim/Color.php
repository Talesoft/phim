<?php

namespace Phim;

use Exception;
use Phim\Color\AlphaColorInterface;
use Phim\Color\AlphaInterface;
use Phim\Color\HslaColor;
use Phim\Color\HslColor;
use Phim\Color\HsvaColor;
use Phim\Color\HsvColor;
use Phim\Color\LabColor;
use Phim\Color\RgbaColor;
use Phim\Color\RgbColor;
use Phim\Color\XyzColor;
use Phim\Exception\Runtime\NonExistentFunctionNameException;
use Phim\Exception\RuntimeException;
use Phim\Util\MathUtil;

class Color
{

    const FUNCTION_REGEX = '/(\w+)\(([^\)]+)\)/';

    const HUE_RANGE_RED = 'red';
    const HUE_RANGE_YELLOW = 'yellow';
    const HUE_RANGE_GREEN = 'green';
    const HUE_RANGE_CYAN = 'cyan';
    const HUE_RANGE_BLUE = 'blue';
    const HUE_RANGE_MAGENTA = 'magenta';

    const ABBIEXXXX = 0x4c2f27;
    const ABSOLUTEZERO = 0x0048ba;
    const ACIDGREEN = 0xb0bf1a;
    const AERO = 0x7cb9e8;
    const AEROBLUE = 0xc9ffe5;
    const AFRICANVIOLET = 0xb284be;
    const AIRFORCEBLUERAF = 0x5d8aa8;
    const AIRFORCEBLUEUSAF = 0x00308f;
    const AIRSUPERIORITYBLUE = 0x72a0c1;
    const ALABAMACRIMSON = 0xaf002a;
    const ALABASTER = 0xf2f0e6;
    const ALICEBLUE = 0xf0f8ff;
    const ALIENARMPIT = 0x84de02;
    const ALIZARINCRIMSON = 0xe32636;
    const ALLOYORANGE = 0xc46210;
    const ALMOND = 0xefdecd;
    const AMARANTH = 0xe52b50;
    const AMARANTHDEEPPURPLE = 0x9f2b68;
    const AMARANTHPINK = 0xf19cbb;
    const AMARANTHPURPLE = 0xab274f;
    const AMARANTHRED = 0xd3212d;
    const AMAZON = 0x3b7a57;
    const AMAZONITE = 0x00c4b0;
    const AMBER = 0xffbf00;
    const AMBERSAEECE = 0xff7e00;
    const AMERICANROSE = 0xff033e;
    const AMETHYST = 0x9966cc;
    const ANDROIDGREEN = 0xa4c639;
    const ANTIFLASHWHITE = 0xf2f3f4;
    const ANTIQUEBRASS = 0xcd9575;
    const ANTIQUEBRONZE = 0x665d1e;
    const ANTIQUEFUCHSIA = 0x915c83;
    const ANTIQUERUBY = 0x841b2d;
    const ANTIQUEWHITE = 0xfaebd7;
    const AOENGLISH = 0x008000;
    const APPLEGREEN = 0x8db600;
    const APRICOT = 0xfbceb1;
    const AQUA = 0x00ffff;
    const AQUAMARINE = 0x7fffd4;
    const ARCTICLIME = 0xd0ff14;
    const ARMYGREEN = 0x4b5320;
    const ARSENIC = 0x3b444b;
    const ARTICHOKE = 0x8f9779;
    const ARYLIDEYELLOW = 0xe9d66b;
    const ASHGREY = 0xb2beb5;
    const ASPARAGUS = 0x87a96b;
    const ATOMICTANGERINE = 0xff9966;
    const AUBURN = 0xa52a2a;
    const AUREOLIN = 0xfdee00;
    const AUROMETALSAURUS = 0x6e7f80;
    const AVOCADO = 0x568203;
    const AWESOME = 0xff2052;
    const AZTECGOLD = 0xc39953;
    const AZURE = 0x007fff;
    const AZUREISHWHITE = 0xdbe9f4;
    const AZUREMIST = 0xf0ffff;
    const AZUREWEBCOLOR = 0xf0ffff;
    const BABYBLUE = 0x89cff0;
    const BABYBLUEEYES = 0xa1caf1;
    const BABYPINK = 0xf4c2c2;
    const BABYPOWDER = 0xfefefa;
    const BAKERMILLERPINK = 0xff91af;
    const BALLBLUE = 0x21abcd;
    const BANANAMANIA = 0xfae7b5;
    const BANANAYELLOW = 0xffe135;
    const BANGLADESHGREEN = 0x006a4e;
    const BARBIEPINK = 0xe0218a;
    const BARNRED = 0x7c0a02;
    const BATTERYCHARGEDBLUE = 0x1dacd6;
    const BATTLESHIPGREY = 0x848482;
    const BAZAAR = 0x98777b;
    const BDAZZLEDBLUE = 0x2e5894;
    const BEAUBLUE = 0xbcd4e6;
    const BEAVER = 0x9f8170;
    const BEGONIA = 0xfa6e79;
    const BEIGE = 0xf5f5dc;
    const BIGDIPORUBY = 0x9c2542;
    const BIGFOOTFEET = 0xe88e5a;
    const BISQUE = 0xffe4c4;
    const BISTRE = 0x3d2b1f;
    const BISTREBROWN = 0x967117;
    const BITTERLEMON = 0xcae00d;
    const BITTERLIME = 0xbfff00;
    const BITTERSWEET = 0xfe6f5e;
    const BITTERSWEETSHIMMER = 0xbf4f51;
    const BLACK = 0x000000;
    const BLACKBEAN = 0x3d0c02;
    const BLACKCORAL = 0x54626f;
    const BLACKLEATHERJACKET = 0x253529;
    const BLACKOLIVE = 0x3b3c36;
    const BLACKSHADOWS = 0xbfafb2;
    const BLANCHEDALMOND = 0xffebcd;
    const BLASTOFFBRONZE = 0xa57164;
    const BLEUDEFRANCE = 0x318ce7;
    const BLIZZARDBLUE = 0xace5ee;
    const BLOND = 0xfaf0be;
    const BLUE = 0x0000ff;
    const BLUEBELL = 0xa2a2d0;
    const BLUEBERRY = 0x4f86f7;
    const BLUEBOLT = 0x00b9fb;
    const BLUEBONNET = 0x1c1cf0;
    const BLUECRAYOLA = 0x1f75fe;
    const BLUEGRAY = 0x6699cc;
    const BLUEGREEN = 0x0d98ba;
    const BLUEJEANS = 0x5dadec;
    const BLUELAGOON = 0xace5ee;
    const BLUEMAGENTAVIOLET = 0x553592;
    const BLUEMUNSELL = 0x0093af;
    const BLUENCS = 0x0087bd;
    const BLUEPANTONE = 0x0018a8;
    const BLUEPIGMENT = 0x333399;
    const BLUERYB = 0x0247fe;
    const BLUESAPPHIRE = 0x126180;
    const BLUEVIOLET = 0x8a2be2;
    const BLUEYONDER = 0x5072a7;
    const BLUSH = 0xde5d83;
    const BOLE = 0x79443b;
    const BONDIBLUE = 0x0095b6;
    const BONE = 0xe3dac9;
    const BOOGERBUSTER = 0xdde26a;
    const BOSTONUNIVERSITYRED = 0xcc0000;
    const BOTTLEGREEN = 0x006a4e;
    const BOYSENBERRY = 0x873260;
    const BRANDEISBLUE = 0x0070ff;
    const BRASS = 0xb5a642;
    const BRICKRED = 0xcb4154;
    const BRIGHTCERULEAN = 0x1dacd6;
    const BRIGHTGREEN = 0x66ff00;
    const BRIGHTLAVENDER = 0xbf94e4;
    const BRIGHTLILAC = 0xd891ef;
    const BRIGHTMAROON = 0xc32148;
    const BRIGHTNAVYBLUE = 0x1974d2;
    const BRIGHTPINK = 0xff007f;
    const BRIGHTTURQUOISE = 0x08e8de;
    const BRIGHTUBE = 0xd19fe8;
    const BRIGHTYELLOWCRAYOLA = 0xffaa1d;
    const BRILLIANTAZURE = 0x3399ff;
    const BRILLIANTLAVENDER = 0xf4bbff;
    const BRILLIANTROSE = 0xff55a3;
    const BRINKPINK = 0xfb607f;
    const BRITISHRACINGGREEN = 0x004225;
    const BRONZE = 0xcd7f32;
    const BRONZEYELLOW = 0x737000;
    const BROWN = 0xa52a2a;
    const BROWNNOSE = 0x6b4423;
    const BROWNSUGAR = 0xaf6e4d;
    const BROWNTRADITIONAL = 0x964b00;
    const BROWNWEB = 0xa52a2a;
    const BROWNYELLOW = 0xcc9966;
    const BRUNSWICKGREEN = 0x1b4d3e;
    const BUBBLEGUM = 0xffc1cc;
    const BUBBLES = 0xe7feff;
    const BUDGREEN = 0x7bb661;
    const BUFF = 0xf0dc82;
    const BULGARIANROSE = 0x480607;
    const BURGUNDY = 0x800020;
    const BURLYWOOD = 0xdeb887;
    const BURNISHEDBROWN = 0xa17a74;
    const BURNTORANGE = 0xcc5500;
    const BURNTSIENNA = 0xe97451;
    const BURNTUMBER = 0x8a3324;
    const BYZANTINE = 0xbd33a4;
    const BYZANTIUM = 0x702963;
    const CADET = 0x536872;
    const CADETBLUE = 0x5f9ea0;
    const CADETGREY = 0x91a3b0;
    const CADMIUMGREEN = 0x006b3c;
    const CADMIUMORANGE = 0xed872d;
    const CADMIUMRED = 0xe30022;
    const CADMIUMYELLOW = 0xfff600;
    const CAFAULAIT = 0xa67b5b;
    const CAFNOIR = 0x4b3621;
    const CALPOLYPOMONAGREEN = 0x1e4d2b;
    const CAMBRIDGEBLUE = 0xa3c1ad;
    const CAMEL = 0xc19a6b;
    const CAMEOPINK = 0xefbbcc;
    const CAMOUFLAGEGREEN = 0x78866b;
    const CANARY = 0xffff99;
    const CANARYYELLOW = 0xffef00;
    const CANDYAPPLERED = 0xff0800;
    const CANDYPINK = 0xe4717a;
    const CAPRI = 0x00bfff;
    const CAPUTMORTUUM = 0x592720;
    const CARDINAL = 0xc41e3a;
    const CARIBBEANGREEN = 0x00cc99;
    const CARMINE = 0x960018;
    const CARMINEMP = 0xd70040;
    const CARMINEPINK = 0xeb4c42;
    const CARMINERED = 0xff0038;
    const CARNATIONPINK = 0xffa6c9;
    const CARNELIAN = 0xb31b1b;
    const CAROLINABLUE = 0x56a0d3;
    const CARROTORANGE = 0xed9121;
    const CASTLETONGREEN = 0x00563f;
    const CATALINABLUE = 0x062a78;
    const CATAWBA = 0x703642;
    const CEDARCHEST = 0xc95a49;
    const CEIL = 0x92a1cf;
    const CELADON = 0xace1af;
    const CELADONBLUE = 0x007ba7;
    const CELADONGREEN = 0x2f847c;
    const CELESTE = 0xb2ffff;
    const CELESTIALBLUE = 0x4997d0;
    const CERISE = 0xde3163;
    const CERISEPINK = 0xec3b83;
    const CERULEAN = 0x007ba7;
    const CERULEANBLUE = 0x2a52be;
    const CERULEANFROST = 0x6d9bc3;
    const CGBLUE = 0x007aa5;
    const CGRED = 0xe03c31;
    const CHAMOISEE = 0xa0785a;
    const CHAMPAGNE = 0xf7e7ce;
    const CHAMPAGNEPINK = 0xf1ddcf;
    const CHARCOAL = 0x36454f;
    const CHARLESTONGREEN = 0x232b2b;
    const CHARMPINK = 0xe68fac;
    const CHARTREUSE = 0x7fff00;
    const CHARTREUSETRADITIONAL = 0xdfff00;
    const CHARTREUSEWEB = 0x7fff00;
    const CHERRY = 0xde3163;
    const CHERRYBLOSSOMPINK = 0xffb7c5;
    const CHESTNUT = 0x954535;
    const CHINAPINK = 0xde6fa1;
    const CHINAROSE = 0xa8516e;
    const CHINESERED = 0xaa381e;
    const CHINESEVIOLET = 0x856088;
    const CHLOROPHYLLGREEN = 0x4aff00;
    const CHOCOLATE = 0xd2691e;
    const CHOCOLATETRADITIONAL = 0x7b3f00;
    const CHOCOLATEWEB = 0xd2691e;
    const CHROMEYELLOW = 0xffa700;
    const CINEREOUS = 0x98817b;
    const CINNABAR = 0xe34234;
    const CINNAMONCITATIONNEEDED = 0xd2691e;
    const CINNAMONSATIN = 0xcd607e;
    const CITRINE = 0xe4d00a;
    const CITRON = 0x9fa91f;
    const CLARET = 0x7f1734;
    const CLASSICROSE = 0xfbcce7;
    const COBALTBLUE = 0x0047ab;
    const COCOABROWN = 0xd2691e;
    const COCONUT = 0x965a3e;
    const COFFEE = 0x6f4e37;
    const COLUMBIABLUE = 0xc4d8e2;
    const CONGOPINK = 0xf88379;
    const COOLBLACK = 0x002e63;
    const COOLGREY = 0x8c92ac;
    const COPPER = 0xb87333;
    const COPPERCRAYOLA = 0xda8a67;
    const COPPERPENNY = 0xad6f69;
    const COPPERRED = 0xcb6d51;
    const COPPERROSE = 0x996666;
    const COQUELICOT = 0xff3800;
    const CORAL = 0xff7f50;
    const CORALPINK = 0xf88379;
    const CORALRED = 0xff4040;
    const CORALREEF = 0xfd7c6e;
    const CORDOVAN = 0x893f45;
    const CORN = 0xfbec5d;
    const CORNELLRED = 0xb31b1b;
    const CORNFLOWERBLUE = 0x6495ed;
    const CORNSILK = 0xfff8dc;
    const COSMICCOBALT = 0x2e2d88;
    const COSMICLATTE = 0xfff8e7;
    const COTTONCANDY = 0xffbcd9;
    const COYOTEBROWN = 0x81613c;
    const CREAM = 0xfffdd0;
    const CRIMSON = 0xdc143c;
    const CRIMSONGLORY = 0xbe0032;
    const CRIMSONRED = 0x990000;
    const CULTURED = 0xf5f5f5;
    const CYAN = 0x00ffff;
    const CYANAZURE = 0x4e82b4;
    const CYANBLUEAZURE = 0x4682bf;
    const CYANCOBALTBLUE = 0x28589c;
    const CYANCORNFLOWERBLUE = 0x188bc2;
    const CYANPROCESS = 0x00b7eb;
    const CYBERGRAPE = 0x58427c;
    const CYBERYELLOW = 0xffd300;
    const CYCLAMEN = 0xf56fa1;
    const DAFFODIL = 0xffff31;
    const DANDELION = 0xf0e130;
    const DARKBLUE = 0x00008b;
    const DARKBLUEGRAY = 0x666699;
    const DARKBROWN = 0x654321;
    const DARKBROWNTANGELO = 0x88654e;
    const DARKBYZANTIUM = 0x5d3954;
    const DARKCANDYAPPLERED = 0xa40000;
    const DARKCERULEAN = 0x08457e;
    const DARKCHESTNUT = 0x986960;
    const DARKCORAL = 0xcd5b45;
    const DARKCYAN = 0x008b8b;
    const DARKELECTRICBLUE = 0x536878;
    const DARKGOLDENROD = 0xb8860b;
    const DARKGRAY = 0xa9a9a9;
    const DARKGRAYX11 = 0xa9a9a9;
    const DARKGREEN = 0x013220;
    const DARKGREENX11 = 0x006400;
    const DARKGREY = 0xa9a9a9;
    const DARKGUNMETAL = 0x1f262a;
    const DARKIMPERIALBLUE = 0x00416a;
    const DARKJUNGLEGREEN = 0x1a2421;
    const DARKKHAKI = 0xbdb76b;
    const DARKLAVA = 0x483c32;
    const DARKLAVENDER = 0x734f96;
    const DARKLIVER = 0x534b4f;
    const DARKLIVERHORSES = 0x543d37;
    const DARKMAGENTA = 0x8b008b;
    const DARKMEDIUMGRAY = 0xa9a9a9;
    const DARKMIDNIGHTBLUE = 0x003366;
    const DARKMOSSGREEN = 0x4a5d23;
    const DARKOLIVEGREEN = 0x556b2f;
    const DARKORANGE = 0xff8c00;
    const DARKORCHID = 0x9932cc;
    const DARKPASTELBLUE = 0x779ecb;
    const DARKPASTELGREEN = 0x03c03c;
    const DARKPASTELPURPLE = 0x966fd6;
    const DARKPASTELRED = 0xc23b22;
    const DARKPINK = 0xe75480;
    const DARKPOWDERBLUE = 0x003399;
    const DARKPUCE = 0x4f3a3c;
    const DARKPURPLE = 0x301934;
    const DARKRASPBERRY = 0x872657;
    const DARKRED = 0x8b0000;
    const DARKSALMON = 0xe9967a;
    const DARKSCARLET = 0x560319;
    const DARKSEAGREEN = 0x8fbc8f;
    const DARKSIENNA = 0x3c1414;
    const DARKSKYBLUE = 0x8cbed6;
    const DARKSLATEBLUE = 0x483d8b;
    const DARKSLATEGRAY = 0x2f4f4f;
    const DARKSLATEGREY = 0x2f4f4f;
    const DARKSPRINGGREEN = 0x177245;
    const DARKTAN = 0x918151;
    const DARKTANGERINE = 0xffa812;
    const DARKTAUPE = 0x483c32;
    const DARKTERRACOTTA = 0xcc4e5c;
    const DARKTURQUOISE = 0x00ced1;
    const DARKVANILLA = 0xd1bea8;
    const DARKVIOLET = 0x9400d3;
    const DARKYELLOW = 0x9b870c;
    const DARTMOUTHGREEN = 0x00703c;
    const DAVYSGREY = 0x555555;
    const DEBIANRED = 0xd70a53;
    const DEEPAQUAMARINE = 0x40826d;
    const DEEPCARMINE = 0xa9203e;
    const DEEPCARMINEPINK = 0xef3038;
    const DEEPCARROTORANGE = 0xe9692c;
    const DEEPCERISE = 0xda3287;
    const DEEPCHAMPAGNE = 0xfad6a5;
    const DEEPCHESTNUT = 0xb94e48;
    const DEEPCOFFEE = 0x704241;
    const DEEPFUCHSIA = 0xc154c1;
    const DEEPGREEN = 0x056608;
    const DEEPGREENCYANTURQUOISE = 0x0e7c61;
    const DEEPJUNGLEGREEN = 0x004b49;
    const DEEPKOAMARU = 0x333366;
    const DEEPLEMON = 0xf5c71a;
    const DEEPLILAC = 0x9955bb;
    const DEEPMAGENTA = 0xcc00cc;
    const DEEPMAROON = 0x820000;
    const DEEPMAUVE = 0xd473d4;
    const DEEPMOSSGREEN = 0x355e3b;
    const DEEPPEACH = 0xffcba4;
    const DEEPPINK = 0xff1493;
    const DEEPPUCE = 0xa95c68;
    const DEEPRED = 0x850101;
    const DEEPRUBY = 0x843f5b;
    const DEEPSAFFRON = 0xff9933;
    const DEEPSKYBLUE = 0x00bfff;
    const DEEPSPACESPARKLE = 0x4a646c;
    const DEEPSPRINGBUD = 0x556b2f;
    const DEEPTAUPE = 0x7e5e60;
    const DEEPTUSCANRED = 0x66424d;
    const DEEPVIOLET = 0x330066;
    const DEER = 0xba8759;
    const DENIM = 0x1560bd;
    const DENIMBLUE = 0x2243b6;
    const DESATURATEDCYAN = 0x669999;
    const DESERT = 0xc19a6b;
    const DESERTSAND = 0xedc9af;
    const DESIRE = 0xea3c53;
    const DIAMOND = 0xb9f2ff;
    const DIMGRAY = 0x696969;
    const DIMGREY = 0x696969;
    const DINGYDUNGEON = 0xc53151;
    const DIRT = 0x9b7653;
    const DODGERBLUE = 0x1e90ff;
    const DOGWOODROSE = 0xd71868;
    const DOLLARBILL = 0x85bb65;
    const DOLPHINGRAY = 0x828e84;
    const DONKEYBROWN = 0x664c28;
    const DRAB = 0x967117;
    const DUKEBLUE = 0x00009c;
    const DUSTSTORM = 0xe5ccc9;
    const DUTCHWHITE = 0xefdfbb;
    const EARTHYELLOW = 0xe1a95f;
    const EBONY = 0x555d50;
    const ECRU = 0xc2b280;
    const EERIEBLACK = 0x1b1b1b;
    const EGGPLANT = 0x614051;
    const EGGSHELL = 0xf0ead6;
    const EGYPTIANBLUE = 0x1034a6;
    const ELECTRICBLUE = 0x7df9ff;
    const ELECTRICCRIMSON = 0xff003f;
    const ELECTRICCYAN = 0x00ffff;
    const ELECTRICGREEN = 0x00ff00;
    const ELECTRICINDIGO = 0x6f00ff;
    const ELECTRICLAVENDER = 0xf4bbff;
    const ELECTRICLIME = 0xccff00;
    const ELECTRICPURPLE = 0xbf00ff;
    const ELECTRICULTRAMARINE = 0x3f00ff;
    const ELECTRICVIOLET = 0x8f00ff;
    const ELECTRICYELLOW = 0xffff33;
    const EMERALD = 0x50c878;
    const EMINENCE = 0x6c3082;
    const ENGLISHGREEN = 0x1b4d3e;
    const ENGLISHLAVENDER = 0xb48395;
    const ENGLISHRED = 0xab4b52;
    const ENGLISHVERMILLION = 0xcc474b;
    const ENGLISHVIOLET = 0x563c5c;
    const ETONBLUE = 0x96c8a2;
    const EUCALYPTUS = 0x44d7a8;
    const FALLOW = 0xc19a6b;
    const FALURED = 0x801818;
    const FANDANGO = 0xb53389;
    const FANDANGOPINK = 0xde5285;
    const FASHIONFUCHSIA = 0xf400a1;
    const FAWN = 0xe5aa70;
    const FELDGRAU = 0x4d5d53;
    const FELDSPAR = 0xfdd5b1;
    const FERNGREEN = 0x4f7942;
    const FERRARIRED = 0xff2800;
    const FIELDDRAB = 0x6c541e;
    const FIERYROSE = 0xff5470;
    const FIREBRICK = 0xb22222;
    const FIREENGINERED = 0xce2029;
    const FLAME = 0xe25822;
    const FLAMINGOPINK = 0xfc8eac;
    const FLATTERY = 0x6b4423;
    const FLAVESCENT = 0xf7e98e;
    const FLAX = 0xeedc82;
    const FLIRT = 0xa2006d;
    const FLORALWHITE = 0xfffaf0;
    const FLUORESCENTORANGE = 0xffbf00;
    const FLUORESCENTPINK = 0xff1493;
    const FLUORESCENTYELLOW = 0xccff00;
    const FOLLY = 0xff004f;
    const FORESTGREEN = 0x228b22;
    const FORESTGREENTRADITIONAL = 0x014421;
    const FORESTGREENWEB = 0x228b22;
    const FRENCHBEIGE = 0xa67b5b;
    const FRENCHBISTRE = 0x856d4d;
    const FRENCHBLUE = 0x0072bb;
    const FRENCHFUCHSIA = 0xfd3f92;
    const FRENCHLILAC = 0x86608e;
    const FRENCHLIME = 0x9efd38;
    const FRENCHMAUVE = 0xd473d4;
    const FRENCHPINK = 0xfd6c9e;
    const FRENCHPLUM = 0x811453;
    const FRENCHPUCE = 0x4e1609;
    const FRENCHRASPBERRY = 0xc72c48;
    const FRENCHROSE = 0xf64a8a;
    const FRENCHSKYBLUE = 0x77b5fe;
    const FRENCHVIOLET = 0x8806ce;
    const FRENCHWINE = 0xac1e44;
    const FRESHAIR = 0xa6e7ff;
    const FROSTBITE = 0xe936a7;
    const FUCHSIA = 0xff00ff;
    const FUCHSIACRAYOLA = 0xc154c1;
    const FUCHSIAPINK = 0xff77ff;
    const FUCHSIAPURPLE = 0xcc397b;
    const FUCHSIAROSE = 0xc74375;
    const FULVOUS = 0xe48400;
    const FUZZYWUZZY = 0xcc6666;
    const GAINSBORO = 0xdcdcdc;
    const GHOSTWHITE = 0xf8f8ff;
    const GOLD = 0xffd700;
    const GOLDENROD = 0xdaa520;
    const GRAY = 0x808080;
    const GREEN = 0x008000;
    const GREENYELLOW = 0xadff2f;
    const GREY = 0x808080;
    const HONEYDEW = 0xf0fff0;
    const HOTPINK = 0xff69b4;
    const INDIANRED = 0xcd5c5c;
    const INDIGO = 0x4b0082;
    const IVORY = 0xfffff0;
    const KHAKI = 0xf0e68c;
    const LAVENDER = 0xe6e6fa;
    const LAVENDERBLUSH = 0xfff0f5;
    const LAWNGREEN = 0x7cfc00;
    const LEMONCHIFFON = 0xfffacd;
    const LIGHTBLUE = 0xadd8e6;
    const LIGHTCORAL = 0xf08080;
    const LIGHTCYAN = 0xe0ffff;
    const LIGHTGOLDENRODYELLOW = 0xfafad2;
    const LIGHTGRAY = 0xd3d3d3;
    const LIGHTGREEN = 0x90ee90;
    const LIGHTGREY = 0xd3d3d3;
    const LIGHTPINK = 0xffb6c1;
    const LIGHTSALMON = 0xffa07a;
    const LIGHTSEAGREEN = 0x20b2aa;
    const LIGHTSKYBLUE = 0x87cefa;
    const LIGHTSLATEGRAY = 0x778899;
    const LIGHTSLATEGREY = 0x778899;
    const LIGHTSTEELBLUE = 0xb0c4de;
    const LIGHTYELLOW = 0xffffe0;
    const LIME = 0x00ff00;
    const LIMEGREEN = 0x32cd32;
    const LINEN = 0xfaf0e6;
    const MAGENTA = 0xff00ff;
    const MAROON = 0x800000;
    const MEDIUMAQUAMARINE = 0x66cdaa;
    const MEDIUMBLUE = 0x0000cd;
    const MEDIUMORCHID = 0xba55d3;
    const MEDIUMPURPLE = 0x9370db;
    const MEDIUMSEAGREEN = 0x3cb371;
    const MEDIUMSLATEBLUE = 0x7b68ee;
    const MEDIUMSPRINGGREEN = 0x00fa9a;
    const MEDIUMTURQUOISE = 0x48d1cc;
    const MEDIUMVIOLETRED = 0xc71585;
    const MIDNIGHTBLUE = 0x191970;
    const MINTCREAM = 0xf5fffa;
    const MISTYROSE = 0xffe4e1;
    const MOCCASIN = 0xffe4b5;
    const NAVAJOWHITE = 0xffdead;
    const NAVY = 0x000080;
    const OLDLACE = 0xfdf5e6;
    const OLIVE = 0x808000;
    const OLIVEDRAB = 0x6b8e23;
    const ORANGE = 0xffa500;
    const ORANGERED = 0xff4500;
    const ORCHID = 0xda70d6;
    const PALEGOLDENROD = 0xeee8aa;
    const PALEGREEN = 0x98fb98;
    const PALETURQUOISE = 0xafeeee;
    const PALEVIOLETRED = 0xdb7093;
    const PAPAYAWHIP = 0xffefd5;
    const PEACHPUFF = 0xffdab9;
    const PERU = 0xcd853f;
    const PINK = 0xffc0cb;
    const PLUM = 0xdda0dd;
    const POWDERBLUE = 0xb0e0e6;
    const PURPLE = 0x800080;
    const REBECCAPURPLE = 0x663399;
    const RED = 0xff0000;
    const ROSYBROWN = 0xbc8f8f;
    const ROYALBLUE = 0x4169e1;
    const SADDLEBROWN = 0x8b4513;
    const SALMON = 0xfa8072;
    const SANDYBROWN = 0xf4a460;
    const SEAGREEN = 0x2e8b57;
    const SEASHELL = 0xfff5ee;
    const SIENNA = 0xa0522d;
    const SILVER = 0xc0c0c0;
    const SKYBLUE = 0x87ceeb;
    const SLATEBLUE = 0x6a5acd;
    const SLATEGRAY = 0x708090;
    const SLATEGREY = 0x708090;
    const SNOW = 0xfffafa;
    const SPRINGGREEN = 0x00ff7f;
    const STEELBLUE = 0x4682b4;
    const TAN = 0xd2b48c;
    const TEAL = 0x008080;
    const THISTLE = 0xd8bfd8;
    const TOMATO = 0xff6347;
    const TURQUOISE = 0x40e0d0;
    const VIOLET = 0xee82ee;
    const WHEAT = 0xf5deb3;
    const WHITE = 0xffffff;
    const WHITESMOKE = 0xf5f5f5;
    const YELLOW = 0xffff00;
    const YELLOWGREEN = 0x9acd32;

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

    private static $functions = [
        'rgb' => ['className' => RgbColor::class, 'args' => [
            ['type' => 'int', 'base' => 255],
            ['type' => 'int', 'base' => 255],
            ['type' => 'int', 'base' => 255]
        ]],
        'rgba' => ['className' => RgbaColor::class, 'args' => [
            ['type' => 'int', 'base' => 255],
            ['type' => 'int', 'base' => 255],
            ['type' => 'int', 'base' => 255],
            ['type' => 'float', 'base' => 1]
        ]],
        'hsl' => ['className' => HslColor::class, 'args' => [
            ['type' => 'float', 'base' => 360, 'rotate' => true],
            ['type' => 'float', 'base' => 1],
            ['type' => 'float', 'base' => 1]
        ]],
        'hsla' => ['className' => HslaColor::class, 'args' => [
            ['type' => 'float', 'base' => 360, 'rotate' => true],
            ['type' => 'float', 'base' => 1],
            ['type' => 'float', 'base' => 1],
            ['type' => 'float', 'base' => 1]
        ]],
        'hsv' => ['className' => HsvColor::class, 'args' => [
            ['type' => 'float', 'base' => 360, 'rotate' => true],
            ['type' => 'float', 'base' => 1],
            ['type' => 'float', 'base' => 1]
        ]],
        'hsva' => ['className' => HsvaColor::class, 'args' => [
            ['type' => 'float', 'base' => 360, 'rotate' => true],
            ['type' => 'float', 'base' => 1],
            ['type' => 'float', 'base' => 1],
            ['type' => 'float', 'base' => 1]
        ]],
        'xyz' => ['className' => XyzColor::class, 'args' => [
            ['type' => 'float', 'base' => 100],
            ['type' => 'float', 'base' => 100],
            ['type' => 'float', 'base' => 100]
        ]],
        'lab' => ['className' => LabColor::class, 'args' => [
            ['type' => 'float', 'base' => 100],
            ['type' => 'float', 'base' => 1],
            ['type' => 'float', 'base' => 1]
        ]]
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

        $int = self::getInt($color);
        $name = array_search($int, self::$names, true);

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

        return self::parseInt(self::$names[$name]);
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
        }

        return self::parseInt(hexdec($string));
    }

    public static function parseInt($int)
    {

        if ($int > 0xffffff)
            return new RgbaColor(
                (int)((255 & ($int >> 32)) / 255),
                (int)(255 & ($int >> 16)),
                (int)(255 & ($int >> 8)),
                (int)(255 & ($int))
            );

        return new RgbColor(
            (int)(255 & ($int >> 16)),
            (int)(255 & ($int >> 8)),
            (int)(255 & ($int))
        );
    }

    public static function getInt(ColorInterface $color)
    {

        if ($color instanceof AlphaColorInterface) {

            $color = $color->getRgba();

            return (int)(
                ((int)($color->getAlpha() * 255) << 32)
              + ($color->getRed() << 16)
              + ($color->getGreen() << 8)
              + $color->getBlue()
            );
        }

        $color = $color->getRgb();
        return (int)(
            + ($color->getRed() << 16)
            + ($color->getGreen() << 8)
            + $color->getBlue()
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

        $className = self::$functions[$function]['className'];
        $argDefs = self::$functions[$function]['args'];

        if (count($args) !== count($argDefs))
            throw new RuntimeException(sprintf(
                "Invalid argument count for $function: Expected %d values, got %d values",
                count($argDefs),
                count($args)
            ));

        $args = array_map(function($value, $arg) {

            return MathUtil::convertValue($value, $arg['type'], $arg['base'], isset($arg['rotate']) && $arg['rotate']);
        }, $args, $argDefs);

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

    /**
     * @param $value
     *
     * @return ColorInterface
     */
    public static function get($value)
    {

        if ($value instanceof ColorInterface)
            return $value;

        if (empty($value))
            return new RgbColor(0,0,0);

        if (is_int($value))
            return self::parseInt($value);

        if ($color = self::parseName($value))
            return $color;

        if ($color = self::parseHexString($value))
            return $color;

        if ($color = self::parseFunctionString($value))
            return $color;

        return null;
    }

    public function create($type, array $args)
    {

        if (!isset(self::$functions[$type]))
            throw new \InvalidArgumentException(
                "Passed color type $type is not registered. Please register it with ::registerFunction first"
            );
        
        $type = self::$functions[$type];
        
        foreach ($type['args'] as $arg) {
            
            $argType = $arg['type'];
            $argBase = $arg['base'];
        }
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

    //https://github.com/supplyhog/phpOptics/blob/master/OpticsColorPoint.php
    public static function getDifference(ColorInterface $color, ColorInterface $compareColor)
    {

        $color = $color->getLab();
        $compareColor = $color->getLab();

        $kl = $kc = $kh = 1.0;
        $barL = ($color->getL() + $compareColor->getL()) / 2.0;
        //(Numbers corrispond to http://www.ece.rochester.edu/~gsharma/ciede2000/ciede2000noteCRNA.pdf eq)
        //2
        $helperB1Sq = pow($color->getB(), 2);
        $helperB2Sq = pow($compareColor->getB(), 2);
        $c1 = sqrt(pow($color->getA(), 2) + $helperB1Sq);
        $c2 = sqrt(pow($compareColor->getA(), 2) + $helperB2Sq);
        //3
        $barC = ($c1 + $c2) / 2.0;
        //4
        $helperPow7 = sqrt(pow($barC, 7) / (pow($barC, 7) + 6103515625));
        $g = 0.5 * (1 - $helperPow7);
        //5
        $primeA1 = (1 + $g) * $color->getA();
        $primeA2 = (1 + $g) * $compareColor->getA();
        //6
        $primeC1 = sqrt(pow($primeA1, 2) + $helperB1Sq);
        $primeC2 = sqrt(pow($primeA2, 2) + $helperB2Sq);
        //7
        if ($color->getB() === 0 && $primeA1 === 0) {
            $primeH1 = 0;
        } else {
            $primeH1 = (atan2($color->getB(), $primeA1) + 2 * M_PI) * (180 / M_PI);
        }
        if ($compareColor->getB() === 0 && $primeA2 === 0) {
            $primeH2 = 0;
        } else {
            $primeH2 = (atan2($compareColor->getB(), $primeA2) + 2 * M_PI) * (180 / M_PI);
        }
        //8
        $deltaLPrime = $compareColor->getL() - $color->getL();
        //9
        $deltaCPrime = $primeC2 - $primeC1;
        //10
        $helperH = $primeH2 - $primeH1;
        if ($primeC1 * $primeC2 === 0) {
            $deltahPrime = 0;
        } else if (abs($helperH) <= 180) {
            $deltahPrime = $helperH;
        } else if ($helperH > 180) {
            $deltahPrime = $helperH - 360.0;
        } else if ($helperH < -180) {
            $deltahPrime = $helperH + 360.0;
        } else {
            throw new Exception('Invalid delta h\'');
        }
        //11
        $deltaHPrime = 2 * sqrt($primeC1 * $primeC2) * sin(($deltahPrime / 2.0) * (M_PI / 180));
        //12
        $barLPrime = ($color->getL() + $compareColor->getL()) / 2.0;
        //13
        $barCPrime = ($primeC1 + $primeC2) / 2.0;
        //14
        $helperH = abs($primeH1 - $primeH2);
        if ($primeC1 * $primeC2 === 0) {
            $barHPrime = $primeH1 + $primeH2;
        } else if ($helperH <= 180) {
            $barHPrime = ($primeH1 + $primeH2) / 2.0;
        } else if ($helperH > 180 && ($primeH1 + $primeH2) < 360) {
            $barHPrime = ($primeH1 + $primeH2 + 360) / 2.0;
        } else if ($helperH > 180 && ($primeH1 + $primeH2) >= 360) {
            $barHPrime = ($primeH1 + $primeH2 - 360) / 2.0;
        } else {
            throw new Exception('Invalid bar h\'');
        }
        //15
        $t = 1 - .17 * cos(($barHPrime - 30) * (M_PI / 180)) + .24 * cos((2 * $barHPrime) * (M_PI / 180)) + .32 * cos((3 * $barHPrime + 6) * (M_PI / 180)) - .2 * cos((4 * $barHPrime - 63) * (M_PI / 180));
        //16
        $deltaTheta = 30 * exp(-1 * pow((($barHPrime - 275) / 25), 2));
        //17
        $rc = 2 * $helperPow7;
        //18
        $slHelper = pow($barLPrime - 50, 2);
        $sl = 1 + ((0.015 * $slHelper) / sqrt(20 + $slHelper));
        //19
        $sc = 1 + 0.046 * $barCPrime;
        //20
        $sh = 1 + 0.015 * $barCPrime * $t;
        //21
        $rt = -1 * sin((2 * $deltaTheta) * (M_PI / 180)) * $rc;
        //22
        $deltaESquared = pow($deltaLPrime / ($kl * $sl), 2) +
            pow($deltaCPrime / ($kc * $sc), 2) +
            pow($deltaHPrime / ($kh * $sh), 2) +
            ($rt * ($deltaCPrime / ($kc * $sc)) * ($deltaHPrime / ($kh * $sh)));
        $deltaE = sqrt($deltaESquared);

        return $deltaE;
    }

    public static function equals(ColorInterface $color, ColorInterface $compareColor, $tolerance = null, $ignoreAlpha = false)
    {



        return true;
    }

    public static function getHtml(ColorInterface $color, $width = null, $height = null)
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
            $color,
            $inversed,
            intval($height / 4),
            $color->getLab()->getRgb(),
            Color::getHexString($color->getRgb()),
            self::getHueRange($hue)."->".round($hue, 2),
            $name ? "<br>$name" : ''
        );
    }
}