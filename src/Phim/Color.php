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
use Phim\Color\XyzColorInterface;
use Phim\Exception\Color\NonExistentFunctionNameException;
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

    const ABBIEXXXX = 0x4c2f27ff;
    const ABSOLUTEZERO = 0x0048baff;
    const ACIDGREEN = 0xb0bf1aff;
    const AERO = 0x7cb9e8ff;
    const AEROBLUE = 0xc9ffe5ff;
    const AFRICANVIOLET = 0xb284beff;
    const AIRFORCEBLUERAF = 0x5d8aa8ff;
    const AIRFORCEBLUEUSAF = 0x00308fff;
    const AIRSUPERIORITYBLUE = 0x72a0c1ff;
    const ALABAMACRIMSON = 0xaf002aff;
    const ALABASTER = 0xf2f0e6ff;
    const ALICEBLUE = 0xf0f8ffff;
    const ALIENARMPIT = 0x84de02ff;
    const ALIZARINCRIMSON = 0xe32636ff;
    const ALLOYORANGE = 0xc46210ff;
    const ALMOND = 0xefdecdff;
    const AMARANTH = 0xe52b50ff;
    const AMARANTHDEEPPURPLE = 0x9f2b68ff;
    const AMARANTHPINK = 0xf19cbbff;
    const AMARANTHPURPLE = 0xab274fff;
    const AMARANTHRED = 0xd3212dff;
    const AMAZON = 0x3b7a57ff;
    const AMAZONITE = 0x00c4b0ff;
    const AMBER = 0xffbf00ff;
    const AMBERSAEECE = 0xff7e00ff;
    const AMERICANROSE = 0xff033eff;
    const AMETHYST = 0x9966ccff;
    const ANDROIDGREEN = 0xa4c639ff;
    const ANTIFLASHWHITE = 0xf2f3f4ff;
    const ANTIQUEBRASS = 0xcd9575ff;
    const ANTIQUEBRONZE = 0x665d1eff;
    const ANTIQUEFUCHSIA = 0x915c83ff;
    const ANTIQUERUBY = 0x841b2dff;
    const ANTIQUEWHITE = 0xfaebd7ff;
    const AOENGLISH = 0x008000ff;
    const APPLEGREEN = 0x8db600ff;
    const APRICOT = 0xfbceb1ff;
    const AQUA = 0x00ffffff;
    const AQUAMARINE = 0x7fffd4ff;
    const ARCTICLIME = 0xd0ff14ff;
    const ARMYGREEN = 0x4b5320ff;
    const ARSENIC = 0x3b444bff;
    const ARTICHOKE = 0x8f9779ff;
    const ARYLIDEYELLOW = 0xe9d66bff;
    const ASHGREY = 0xb2beb5ff;
    const ASPARAGUS = 0x87a96bff;
    const ATOMICTANGERINE = 0xff9966ff;
    const AUBURN = 0xa52a2aff;
    const AUREOLIN = 0xfdee00ff;
    const AUROMETALSAURUS = 0x6e7f80ff;
    const AVOCADO = 0x568203ff;
    const AWESOME = 0xff2052ff;
    const AZTECGOLD = 0xc39953ff;
    const AZURE = 0x007fffff;
    const AZUREISHWHITE = 0xdbe9f4ff;
    const AZUREMIST = 0xf0ffffff;
    const AZUREWEBCOLOR = 0xf0ffffff;
    const BABYBLUE = 0x89cff0ff;
    const BABYBLUEEYES = 0xa1caf1ff;
    const BABYPINK = 0xf4c2c2ff;
    const BABYPOWDER = 0xfefefaff;
    const BAKERMILLERPINK = 0xff91afff;
    const BALLBLUE = 0x21abcdff;
    const BANANAMANIA = 0xfae7b5ff;
    const BANANAYELLOW = 0xffe135ff;
    const BANGLADESHGREEN = 0x006a4eff;
    const BARBIEPINK = 0xe0218aff;
    const BARNRED = 0x7c0a02ff;
    const BATTERYCHARGEDBLUE = 0x1dacd6ff;
    const BATTLESHIPGREY = 0x848482ff;
    const BAZAAR = 0x98777bff;
    const BDAZZLEDBLUE = 0x2e5894ff;
    const BEAUBLUE = 0xbcd4e6ff;
    const BEAVER = 0x9f8170ff;
    const BEGONIA = 0xfa6e79ff;
    const BEIGE = 0xf5f5dcff;
    const BIGDIPORUBY = 0x9c2542ff;
    const BIGFOOTFEET = 0xe88e5aff;
    const BISQUE = 0xffe4c4ff;
    const BISTRE = 0x3d2b1fff;
    const BISTREBROWN = 0x967117ff;
    const BITTERLEMON = 0xcae00dff;
    const BITTERLIME = 0xbfff00ff;
    const BITTERSWEET = 0xfe6f5eff;
    const BITTERSWEETSHIMMER = 0xbf4f51ff;
    const BLACK = 0x000000ff;
    const BLACKBEAN = 0x3d0c02ff;
    const BLACKCORAL = 0x54626fff;
    const BLACKLEATHERJACKET = 0x253529ff;
    const BLACKOLIVE = 0x3b3c36ff;
    const BLACKSHADOWS = 0xbfafb2ff;
    const BLANCHEDALMOND = 0xffebcdff;
    const BLASTOFFBRONZE = 0xa57164ff;
    const BLEUDEFRANCE = 0x318ce7ff;
    const BLIZZARDBLUE = 0xace5eeff;
    const BLOND = 0xfaf0beff;
    const BLUE = 0x0000ffff;
    const BLUEBELL = 0xa2a2d0ff;
    const BLUEBERRY = 0x4f86f7ff;
    const BLUEBOLT = 0x00b9fbff;
    const BLUEBONNET = 0x1c1cf0ff;
    const BLUECRAYOLA = 0x1f75feff;
    const BLUEGRAY = 0x6699ccff;
    const BLUEGREEN = 0x0d98baff;
    const BLUEJEANS = 0x5dadecff;
    const BLUELAGOON = 0xace5eeff;
    const BLUEMAGENTAVIOLET = 0x553592ff;
    const BLUEMUNSELL = 0x0093afff;
    const BLUENCS = 0x0087bdff;
    const BLUEPANTONE = 0x0018a8ff;
    const BLUEPIGMENT = 0x333399ff;
    const BLUERYB = 0x0247feff;
    const BLUESAPPHIRE = 0x126180ff;
    const BLUEVIOLET = 0x8a2be2ff;
    const BLUEYONDER = 0x5072a7ff;
    const BLUSH = 0xde5d83ff;
    const BOLE = 0x79443bff;
    const BONDIBLUE = 0x0095b6ff;
    const BONE = 0xe3dac9ff;
    const BOOGERBUSTER = 0xdde26aff;
    const BOSTONUNIVERSITYRED = 0xcc0000ff;
    const BOTTLEGREEN = 0x006a4eff;
    const BOYSENBERRY = 0x873260ff;
    const BRANDEISBLUE = 0x0070ffff;
    const BRASS = 0xb5a642ff;
    const BRICKRED = 0xcb4154ff;
    const BRIGHTCERULEAN = 0x1dacd6ff;
    const BRIGHTGREEN = 0x66ff00ff;
    const BRIGHTLAVENDER = 0xbf94e4ff;
    const BRIGHTLILAC = 0xd891efff;
    const BRIGHTMAROON = 0xc32148ff;
    const BRIGHTNAVYBLUE = 0x1974d2ff;
    const BRIGHTPINK = 0xff007fff;
    const BRIGHTTURQUOISE = 0x08e8deff;
    const BRIGHTUBE = 0xd19fe8ff;
    const BRIGHTYELLOWCRAYOLA = 0xffaa1dff;
    const BRILLIANTAZURE = 0x3399ffff;
    const BRILLIANTLAVENDER = 0xf4bbffff;
    const BRILLIANTROSE = 0xff55a3ff;
    const BRINKPINK = 0xfb607fff;
    const BRITISHRACINGGREEN = 0x004225ff;
    const BRONZE = 0xcd7f32ff;
    const BRONZEYELLOW = 0x737000ff;
    const BROWN = 0xa52a2aff;
    const BROWNNOSE = 0x6b4423ff;
    const BROWNSUGAR = 0xaf6e4dff;
    const BROWNTRADITIONAL = 0x964b00ff;
    const BROWNWEB = 0xa52a2aff;
    const BROWNYELLOW = 0xcc9966ff;
    const BRUNSWICKGREEN = 0x1b4d3eff;
    const BUBBLEGUM = 0xffc1ccff;
    const BUBBLES = 0xe7feffff;
    const BUDGREEN = 0x7bb661ff;
    const BUFF = 0xf0dc82ff;
    const BULGARIANROSE = 0x480607ff;
    const BURGUNDY = 0x800020ff;
    const BURLYWOOD = 0xdeb887ff;
    const BURNISHEDBROWN = 0xa17a74ff;
    const BURNTORANGE = 0xcc5500ff;
    const BURNTSIENNA = 0xe97451ff;
    const BURNTUMBER = 0x8a3324ff;
    const BYZANTINE = 0xbd33a4ff;
    const BYZANTIUM = 0x702963ff;
    const CADET = 0x536872ff;
    const CADETBLUE = 0x5f9ea0ff;
    const CADETGREY = 0x91a3b0ff;
    const CADMIUMGREEN = 0x006b3cff;
    const CADMIUMORANGE = 0xed872dff;
    const CADMIUMRED = 0xe30022ff;
    const CADMIUMYELLOW = 0xfff600ff;
    const CAFAULAIT = 0xa67b5bff;
    const CAFNOIR = 0x4b3621ff;
    const CALPOLYPOMONAGREEN = 0x1e4d2bff;
    const CAMBRIDGEBLUE = 0xa3c1adff;
    const CAMEL = 0xc19a6bff;
    const CAMEOPINK = 0xefbbccff;
    const CAMOUFLAGEGREEN = 0x78866bff;
    const CANARY = 0xffff99ff;
    const CANARYYELLOW = 0xffef00ff;
    const CANDYAPPLERED = 0xff0800ff;
    const CANDYPINK = 0xe4717aff;
    const CAPRI = 0x00bfffff;
    const CAPUTMORTUUM = 0x592720ff;
    const CARDINAL = 0xc41e3aff;
    const CARIBBEANGREEN = 0x00cc99ff;
    const CARMINE = 0x960018ff;
    const CARMINEMP = 0xd70040ff;
    const CARMINEPINK = 0xeb4c42ff;
    const CARMINERED = 0xff0038ff;
    const CARNATIONPINK = 0xffa6c9ff;
    const CARNELIAN = 0xb31b1bff;
    const CAROLINABLUE = 0x56a0d3ff;
    const CARROTORANGE = 0xed9121ff;
    const CASTLETONGREEN = 0x00563fff;
    const CATALINABLUE = 0x062a78ff;
    const CATAWBA = 0x703642ff;
    const CEDARCHEST = 0xc95a49ff;
    const CEIL = 0x92a1cfff;
    const CELADON = 0xace1afff;
    const CELADONBLUE = 0x007ba7ff;
    const CELADONGREEN = 0x2f847cff;
    const CELESTE = 0xb2ffffff;
    const CELESTIALBLUE = 0x4997d0ff;
    const CERISE = 0xde3163ff;
    const CERISEPINK = 0xec3b83ff;
    const CERULEAN = 0x007ba7ff;
    const CERULEANBLUE = 0x2a52beff;
    const CERULEANFROST = 0x6d9bc3ff;
    const CGBLUE = 0x007aa5ff;
    const CGRED = 0xe03c31ff;
    const CHAMOISEE = 0xa0785aff;
    const CHAMPAGNE = 0xf7e7ceff;
    const CHAMPAGNEPINK = 0xf1ddcfff;
    const CHARCOAL = 0x36454fff;
    const CHARLESTONGREEN = 0x232b2bff;
    const CHARMPINK = 0xe68facff;
    const CHARTREUSE = 0x7fff00ff;
    const CHARTREUSETRADITIONAL = 0xdfff00ff;
    const CHARTREUSEWEB = 0x7fff00ff;
    const CHERRY = 0xde3163ff;
    const CHERRYBLOSSOMPINK = 0xffb7c5ff;
    const CHESTNUT = 0x954535ff;
    const CHINAPINK = 0xde6fa1ff;
    const CHINAROSE = 0xa8516eff;
    const CHINESERED = 0xaa381eff;
    const CHINESEVIOLET = 0x856088ff;
    const CHLOROPHYLLGREEN = 0x4aff00ff;
    const CHOCOLATE = 0xd2691eff;
    const CHOCOLATETRADITIONAL = 0x7b3f00ff;
    const CHOCOLATEWEB = 0xd2691eff;
    const CHROMEYELLOW = 0xffa700ff;
    const CINEREOUS = 0x98817bff;
    const CINNABAR = 0xe34234ff;
    const CINNAMONCITATIONNEEDED = 0xd2691eff;
    const CINNAMONSATIN = 0xcd607eff;
    const CITRINE = 0xe4d00aff;
    const CITRON = 0x9fa91fff;
    const CLARET = 0x7f1734ff;
    const CLASSICROSE = 0xfbcce7ff;
    const COBALTBLUE = 0x0047abff;
    const COCOABROWN = 0xd2691eff;
    const COCONUT = 0x965a3eff;
    const COFFEE = 0x6f4e37ff;
    const COLUMBIABLUE = 0xc4d8e2ff;
    const CONGOPINK = 0xf88379ff;
    const COOLBLACK = 0x002e63ff;
    const COOLGREY = 0x8c92acff;
    const COPPER = 0xb87333ff;
    const COPPERCRAYOLA = 0xda8a67ff;
    const COPPERPENNY = 0xad6f69ff;
    const COPPERRED = 0xcb6d51ff;
    const COPPERROSE = 0x996666ff;
    const COQUELICOT = 0xff3800ff;
    const CORAL = 0xff7f50ff;
    const CORALPINK = 0xf88379ff;
    const CORALRED = 0xff4040ff;
    const CORALREEF = 0xfd7c6eff;
    const CORDOVAN = 0x893f45ff;
    const CORN = 0xfbec5dff;
    const CORNELLRED = 0xb31b1bff;
    const CORNFLOWERBLUE = 0x6495edff;
    const CORNSILK = 0xfff8dcff;
    const COSMICCOBALT = 0x2e2d88ff;
    const COSMICLATTE = 0xfff8e7ff;
    const COTTONCANDY = 0xffbcd9ff;
    const COYOTEBROWN = 0x81613cff;
    const CREAM = 0xfffdd0ff;
    const CRIMSON = 0xdc143cff;
    const CRIMSONGLORY = 0xbe0032ff;
    const CRIMSONRED = 0x990000ff;
    const CULTURED = 0xf5f5f5ff;
    const CYAN = 0x00ffffff;
    const CYANAZURE = 0x4e82b4ff;
    const CYANBLUEAZURE = 0x4682bfff;
    const CYANCOBALTBLUE = 0x28589cff;
    const CYANCORNFLOWERBLUE = 0x188bc2ff;
    const CYANPROCESS = 0x00b7ebff;
    const CYBERGRAPE = 0x58427cff;
    const CYBERYELLOW = 0xffd300ff;
    const CYCLAMEN = 0xf56fa1ff;
    const DAFFODIL = 0xffff31ff;
    const DANDELION = 0xf0e130ff;
    const DARKBLUE = 0x00008bff;
    const DARKBLUEGRAY = 0x666699ff;
    const DARKBROWN = 0x654321ff;
    const DARKBROWNTANGELO = 0x88654eff;
    const DARKBYZANTIUM = 0x5d3954ff;
    const DARKCANDYAPPLERED = 0xa40000ff;
    const DARKCERULEAN = 0x08457eff;
    const DARKCHESTNUT = 0x986960ff;
    const DARKCORAL = 0xcd5b45ff;
    const DARKCYAN = 0x008b8bff;
    const DARKELECTRICBLUE = 0x536878ff;
    const DARKGOLDENROD = 0xb8860bff;
    const DARKGRAY = 0xa9a9a9ff;
    const DARKGRAYX11 = 0xa9a9a9ff;
    const DARKGREEN = 0x013220ff;
    const DARKGREENX11 = 0x006400ff;
    const DARKGREY = 0xa9a9a9ff;
    const DARKGUNMETAL = 0x1f262aff;
    const DARKIMPERIALBLUE = 0x00416aff;
    const DARKJUNGLEGREEN = 0x1a2421ff;
    const DARKKHAKI = 0xbdb76bff;
    const DARKLAVA = 0x483c32ff;
    const DARKLAVENDER = 0x734f96ff;
    const DARKLIVER = 0x534b4fff;
    const DARKLIVERHORSES = 0x543d37ff;
    const DARKMAGENTA = 0x8b008bff;
    const DARKMEDIUMGRAY = 0xa9a9a9ff;
    const DARKMIDNIGHTBLUE = 0x003366ff;
    const DARKMOSSGREEN = 0x4a5d23ff;
    const DARKOLIVEGREEN = 0x556b2fff;
    const DARKORANGE = 0xff8c00ff;
    const DARKORCHID = 0x9932ccff;
    const DARKPASTELBLUE = 0x779ecbff;
    const DARKPASTELGREEN = 0x03c03cff;
    const DARKPASTELPURPLE = 0x966fd6ff;
    const DARKPASTELRED = 0xc23b22ff;
    const DARKPINK = 0xe75480ff;
    const DARKPOWDERBLUE = 0x003399ff;
    const DARKPUCE = 0x4f3a3cff;
    const DARKPURPLE = 0x301934ff;
    const DARKRASPBERRY = 0x872657ff;
    const DARKRED = 0x8b0000ff;
    const DARKSALMON = 0xe9967aff;
    const DARKSCARLET = 0x560319ff;
    const DARKSEAGREEN = 0x8fbc8fff;
    const DARKSIENNA = 0x3c1414ff;
    const DARKSKYBLUE = 0x8cbed6ff;
    const DARKSLATEBLUE = 0x483d8bff;
    const DARKSLATEGRAY = 0x2f4f4fff;
    const DARKSLATEGREY = 0x2f4f4fff;
    const DARKSPRINGGREEN = 0x177245ff;
    const DARKTAN = 0x918151ff;
    const DARKTANGERINE = 0xffa812ff;
    const DARKTAUPE = 0x483c32ff;
    const DARKTERRACOTTA = 0xcc4e5cff;
    const DARKTURQUOISE = 0x00ced1ff;
    const DARKVANILLA = 0xd1bea8ff;
    const DARKVIOLET = 0x9400d3ff;
    const DARKYELLOW = 0x9b870cff;
    const DARTMOUTHGREEN = 0x00703cff;
    const DAVYSGREY = 0x555555ff;
    const DEBIANRED = 0xd70a53ff;
    const DEEPAQUAMARINE = 0x40826dff;
    const DEEPCARMINE = 0xa9203eff;
    const DEEPCARMINEPINK = 0xef3038ff;
    const DEEPCARROTORANGE = 0xe9692cff;
    const DEEPCERISE = 0xda3287ff;
    const DEEPCHAMPAGNE = 0xfad6a5ff;
    const DEEPCHESTNUT = 0xb94e48ff;
    const DEEPCOFFEE = 0x704241ff;
    const DEEPFUCHSIA = 0xc154c1ff;
    const DEEPGREEN = 0x056608ff;
    const DEEPGREENCYANTURQUOISE = 0x0e7c61ff;
    const DEEPJUNGLEGREEN = 0x004b49ff;
    const DEEPKOAMARU = 0x333366ff;
    const DEEPLEMON = 0xf5c71aff;
    const DEEPLILAC = 0x9955bbff;
    const DEEPMAGENTA = 0xcc00ccff;
    const DEEPMAROON = 0x820000ff;
    const DEEPMAUVE = 0xd473d4ff;
    const DEEPMOSSGREEN = 0x355e3bff;
    const DEEPPEACH = 0xffcba4ff;
    const DEEPPINK = 0xff1493ff;
    const DEEPPUCE = 0xa95c68ff;
    const DEEPRED = 0x850101ff;
    const DEEPRUBY = 0x843f5bff;
    const DEEPSAFFRON = 0xff9933ff;
    const DEEPSKYBLUE = 0x00bfffff;
    const DEEPSPACESPARKLE = 0x4a646cff;
    const DEEPSPRINGBUD = 0x556b2fff;
    const DEEPTAUPE = 0x7e5e60ff;
    const DEEPTUSCANRED = 0x66424dff;
    const DEEPVIOLET = 0x330066ff;
    const DEER = 0xba8759ff;
    const DENIM = 0x1560bdff;
    const DENIMBLUE = 0x2243b6ff;
    const DESATURATEDCYAN = 0x669999ff;
    const DESERT = 0xc19a6bff;
    const DESERTSAND = 0xedc9afff;
    const DESIRE = 0xea3c53ff;
    const DIAMOND = 0xb9f2ffff;
    const DIMGRAY = 0x696969ff;
    const DIMGREY = 0x696969ff;
    const DINGYDUNGEON = 0xc53151ff;
    const DIRT = 0x9b7653ff;
    const DODGERBLUE = 0x1e90ffff;
    const DOGWOODROSE = 0xd71868ff;
    const DOLLARBILL = 0x85bb65ff;
    const DOLPHINGRAY = 0x828e84ff;
    const DONKEYBROWN = 0x664c28ff;
    const DRAB = 0x967117ff;
    const DUKEBLUE = 0x00009cff;
    const DUSTSTORM = 0xe5ccc9ff;
    const DUTCHWHITE = 0xefdfbbff;
    const EARTHYELLOW = 0xe1a95fff;
    const EBONY = 0x555d50ff;
    const ECRU = 0xc2b280ff;
    const EERIEBLACK = 0x1b1b1bff;
    const EGGPLANT = 0x614051ff;
    const EGGSHELL = 0xf0ead6ff;
    const EGYPTIANBLUE = 0x1034a6ff;
    const ELECTRICBLUE = 0x7df9ffff;
    const ELECTRICCRIMSON = 0xff003fff;
    const ELECTRICCYAN = 0x00ffffff;
    const ELECTRICGREEN = 0x00ff00ff;
    const ELECTRICINDIGO = 0x6f00ffff;
    const ELECTRICLAVENDER = 0xf4bbffff;
    const ELECTRICLIME = 0xccff00ff;
    const ELECTRICPURPLE = 0xbf00ffff;
    const ELECTRICULTRAMARINE = 0x3f00ffff;
    const ELECTRICVIOLET = 0x8f00ffff;
    const ELECTRICYELLOW = 0xffff33ff;
    const EMERALD = 0x50c878ff;
    const EMINENCE = 0x6c3082ff;
    const ENGLISHGREEN = 0x1b4d3eff;
    const ENGLISHLAVENDER = 0xb48395ff;
    const ENGLISHRED = 0xab4b52ff;
    const ENGLISHVERMILLION = 0xcc474bff;
    const ENGLISHVIOLET = 0x563c5cff;
    const ETONBLUE = 0x96c8a2ff;
    const EUCALYPTUS = 0x44d7a8ff;
    const FALLOW = 0xc19a6bff;
    const FALURED = 0x801818ff;
    const FANDANGO = 0xb53389ff;
    const FANDANGOPINK = 0xde5285ff;
    const FASHIONFUCHSIA = 0xf400a1ff;
    const FAWN = 0xe5aa70ff;
    const FELDGRAU = 0x4d5d53ff;
    const FELDSPAR = 0xfdd5b1ff;
    const FERNGREEN = 0x4f7942ff;
    const FERRARIRED = 0xff2800ff;
    const FIELDDRAB = 0x6c541eff;
    const FIERYROSE = 0xff5470ff;
    const FIREBRICK = 0xb22222ff;
    const FIREENGINERED = 0xce2029ff;
    const FLAME = 0xe25822ff;
    const FLAMINGOPINK = 0xfc8eacff;
    const FLATTERY = 0x6b4423ff;
    const FLAVESCENT = 0xf7e98eff;
    const FLAX = 0xeedc82ff;
    const FLIRT = 0xa2006dff;
    const FLORALWHITE = 0xfffaf0ff;
    const FLUORESCENTORANGE = 0xffbf00ff;
    const FLUORESCENTPINK = 0xff1493ff;
    const FLUORESCENTYELLOW = 0xccff00ff;
    const FOLLY = 0xff004fff;
    const FORESTGREEN = 0x228b22ff;
    const FORESTGREENTRADITIONAL = 0x014421ff;
    const FORESTGREENWEB = 0x228b22ff;
    const FRENCHBEIGE = 0xa67b5bff;
    const FRENCHBISTRE = 0x856d4dff;
    const FRENCHBLUE = 0x0072bbff;
    const FRENCHFUCHSIA = 0xfd3f92ff;
    const FRENCHLILAC = 0x86608eff;
    const FRENCHLIME = 0x9efd38ff;
    const FRENCHMAUVE = 0xd473d4ff;
    const FRENCHPINK = 0xfd6c9eff;
    const FRENCHPLUM = 0x811453ff;
    const FRENCHPUCE = 0x4e1609ff;
    const FRENCHRASPBERRY = 0xc72c48ff;
    const FRENCHROSE = 0xf64a8aff;
    const FRENCHSKYBLUE = 0x77b5feff;
    const FRENCHVIOLET = 0x8806ceff;
    const FRENCHWINE = 0xac1e44ff;
    const FRESHAIR = 0xa6e7ffff;
    const FROSTBITE = 0xe936a7ff;
    const FUCHSIA = 0xff00ffff;
    const FUCHSIACRAYOLA = 0xc154c1ff;
    const FUCHSIAPINK = 0xff77ffff;
    const FUCHSIAPURPLE = 0xcc397bff;
    const FUCHSIAROSE = 0xc74375ff;
    const FULVOUS = 0xe48400ff;
    const FUZZYWUZZY = 0xcc6666ff;
    const GAINSBORO = 0xdcdcdcff;
    const GHOSTWHITE = 0xf8f8ffff;
    const GOLD = 0xffd700ff;
    const GOLDENROD = 0xdaa520ff;
    const GRAY = 0x808080ff;
    const GREEN = 0x008000ff;
    const GREENYELLOW = 0xadff2fff;
    const GREY = 0x808080ff;
    const HONEYDEW = 0xf0fff0ff;
    const HOTPINK = 0xff69b4ff;
    const INDIANRED = 0xcd5c5cff;
    const INDIGO = 0x4b0082ff;
    const IVORY = 0xfffff0ff;
    const KHAKI = 0xf0e68cff;
    const LAVENDER = 0xe6e6faff;
    const LAVENDERBLUSH = 0xfff0f5ff;
    const LAWNGREEN = 0x7cfc00ff;
    const LEMONCHIFFON = 0xfffacdff;
    const LIGHTBLUE = 0xadd8e6ff;
    const LIGHTCORAL = 0xf08080ff;
    const LIGHTCYAN = 0xe0ffffff;
    const LIGHTGOLDENRODYELLOW = 0xfafad2ff;
    const LIGHTGRAY = 0xd3d3d3ff;
    const LIGHTGREEN = 0x90ee90ff;
    const LIGHTGREY = 0xd3d3d3ff;
    const LIGHTPINK = 0xffb6c1ff;
    const LIGHTSALMON = 0xffa07aff;
    const LIGHTSEAGREEN = 0x20b2aaff;
    const LIGHTSKYBLUE = 0x87cefaff;
    const LIGHTSLATEGRAY = 0x778899ff;
    const LIGHTSLATEGREY = 0x778899ff;
    const LIGHTSTEELBLUE = 0xb0c4deff;
    const LIGHTYELLOW = 0xffffe0ff;
    const LIME = 0x00ff00ff;
    const LIMEGREEN = 0x32cd32ff;
    const LINEN = 0xfaf0e6ff;
    const MAGENTA = 0xff00ffff;
    const MAROON = 0x800000ff;
    const MEDIUMAQUAMARINE = 0x66cdaaff;
    const MEDIUMBLUE = 0x0000cdff;
    const MEDIUMORCHID = 0xba55d3ff;
    const MEDIUMPURPLE = 0x9370dbff;
    const MEDIUMSEAGREEN = 0x3cb371ff;
    const MEDIUMSLATEBLUE = 0x7b68eeff;
    const MEDIUMSPRINGGREEN = 0x00fa9aff;
    const MEDIUMTURQUOISE = 0x48d1ccff;
    const MEDIUMVIOLETRED = 0xc71585ff;
    const MIDNIGHTBLUE = 0x191970ff;
    const MINTCREAM = 0xf5fffaff;
    const MISTYROSE = 0xffe4e1ff;
    const MOCCASIN = 0xffe4b5ff;
    const NAVAJOWHITE = 0xffdeadff;
    const NAVY = 0x000080ff;
    const OLDLACE = 0xfdf5e6ff;
    const OLIVE = 0x808000ff;
    const OLIVEDRAB = 0x6b8e23ff;
    const ORANGE = 0xffa500ff;
    const ORANGERED = 0xff4500ff;
    const ORCHID = 0xda70d6ff;
    const PALEGOLDENROD = 0xeee8aaff;
    const PALEGREEN = 0x98fb98ff;
    const PALETURQUOISE = 0xafeeeeff;
    const PALEVIOLETRED = 0xdb7093ff;
    const PAPAYAWHIP = 0xffefd5ff;
    const PEACHPUFF = 0xffdab9ff;
    const PERU = 0xcd853fff;
    const PINK = 0xffc0cbff;
    const PLUM = 0xdda0ddff;
    const POWDERBLUE = 0xb0e0e6ff;
    const PURPLE = 0x800080ff;
    const REBECCAPURPLE = 0x663399ff;
    const RED = 0xff0000ff;
    const ROSYBROWN = 0xbc8f8fff;
    const ROYALBLUE = 0x4169e1ff;
    const SADDLEBROWN = 0x8b4513ff;
    const SALMON = 0xfa8072ff;
    const SANDYBROWN = 0xf4a460ff;
    const SEAGREEN = 0x2e8b57ff;
    const SEASHELL = 0xfff5eeff;
    const SIENNA = 0xa0522dff;
    const SILVER = 0xc0c0c0ff;
    const SKYBLUE = 0x87ceebff;
    const SLATEBLUE = 0x6a5acdff;
    const SLATEGRAY = 0x708090ff;
    const SLATEGREY = 0x708090ff;
    const SNOW = 0xfffafaff;
    const SPRINGGREEN = 0x00ff7fff;
    const STEELBLUE = 0x4682b4ff;
    const TAN = 0xd2b48cff;
    const TEAL = 0x008080ff;
    const THISTLE = 0xd8bfd8ff;
    const TOMATO = 0xff6347ff;
    const TURQUOISE = 0x40e0d0ff;
    const VIOLET = 0xee82eeff;
    const WHEAT = 0xf5deb3ff;
    const WHITE = 0xffffffff;
    const WHITESMOKE = 0xf5f5f5ff;
    const YELLOW = 0xffff00ff;
    const YELLOWGREEN = 0x9acd32ff;

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
            ['type' => 'float', 'base' => XyzColorInterface::REF_X],
            ['type' => 'float', 'base' => XyzColorInterface::REF_Y],
            ['type' => 'float', 'base' => XyzColorInterface::REF_Z]
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
    public static function getNames()
    {

        return self::$names;
    }

    public static function toName(ColorInterface $color)
    {

        $int = self::toInt($color->toRgb());
        $name = array_search($int, self::$names, true);

        if ($name)
            return $name;

        return '0x'.dechex($int);
    }

    public static function parseName($string)
    {

        $name = strtolower($string);

        if (!isset(self::$names[$name]))
            return null;

        return self::parseInt(self::$names[$name]);
    }

    public static function registerName($name, ColorInterface $color)
    {

        self::$names[$name] = self::toInt($color->toRgb());
    }

    public static function toHexString(ColorInterface $color, $expand = false)
    {

        /** @var RgbaColor $rgb */
        $rgb = $color instanceof AlphaColorInterface
            ? $color->toRgba()
            : $color->toRgb();

        $hex = '#';
        $hex .= str_pad(dechex($rgb->getRed()), 2, '0', STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb->getGreen()), 2, '0', STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb->getBlue()), 2, '0', STR_PAD_LEFT);

        if ($rgb instanceof AlphaColorInterface)
            $hex .= str_pad(dechex($rgb->getAlpha() * 255), 2, '0', STR_PAD_LEFT);
        else if (!$expand && $hex[1] === $hex[2] && $hex[3] === $hex[4] && $hex[5] === $hex[6])
            $hex = '#'.$hex[1].$hex[3].$hex[5];

        return $hex;
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
                    hexdec($string[0].$string[0]),
                    hexdec($string[1].$string[1]),
                    hexdec($string[2].$string[2])
                );
            case 4:
                return new RgbaColor(
                    hexdec($string[0].$string[0]),
                    hexdec($string[1].$string[1]),
                    hexdec($string[2].$string[2]),
                    hexdec($string[3].$string[3]) / 255
                );
            case 6:
                return new RgbColor(
                    hexdec($string[0].$string[1]),
                    hexdec($string[2].$string[3]),
                    hexdec($string[4].$string[5])
                );
        }

        return self::parseInt(hexdec($string));
    }

    public static function toInt(ColorInterface $color)
    {

        $color = $color->toRgba();
        return unpack('N', pack('C*', 
            $color->getRed(), 
            $color->getGreen(), 
            $color->getBlue(),
            (int)($color->getAlpha() * 255)
        ))[1];
    }

    public static function parseInt($int)
    {

        list(, $r, $g, $b, $a) = unpack('C*', pack('N', $int));
        return new RgbaColor($r, $g, $b, $a / 255);
    }

    /**
     * @return array
     */
    public static function getFunctions()
    {

        return self::$functions;
    }

    public static function parseFunctionString($string)
    {

        if (!preg_match(self::FUNCTION_REGEX, $string, $matches))
            return null;

        $function = $matches[1];
        $args = array_map('trim', explode(',', $matches[2]));

        if (!isset(self::$functions[$function]))
            throw new NonExistentFunctionNameException(
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

    /**
     * @param mixed $value
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

    public static function getMax(ColorInterface $color)
    {

        $rgb = $color->toRgb();
        return max($rgb->getRed(), $rgb->getGreen(), $rgb->getBlue());
    }

    public static function getMin(ColorInterface $color)
    {

        $rgb = $color->toRgb();
        return min($rgb->getRed(), $rgb->getGreen(), $rgb->getBlue());
    }

    public static function getAverage(ColorInterface $color)
    {

        $rgb = $color->toRgb();
        return (int)($rgb->getRed() + $rgb->getGreen() + $rgb->getBlue()) / 3;
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

        return self::getHueRange($color->toHsl()->getHue());
    }

    public static function isColorHueRange(ColorInterface $color, $range)
    {

        return self::isHueRange($color->toHsl()->getHue(), $range);
    }

    public static function mix(ColorInterface $color, ColorInterface $mixColor)
    {

        if ($color instanceof AlphaColorInterface) {

            $color = $color->toRgba();
            $mixColor = $mixColor->toRgba();

            return new RgbaColor(
                ($color->getRed() + $mixColor->getRed()) / 2,
                ($color->getGreen() + $mixColor->getGreen()) / 2,
                ($color->getBlue() + $mixColor->getBlue()) / 2,
                ($color->getAlpha() + $mixColor->getAlpha()) / 2
            );
        }

        $color = $color->toRgb();
        $mixColor = $mixColor->toRgb();

        return new RgbColor(
            ($color->getRed() + $mixColor->getRed()) / 2,
            ($color->getGreen() + $mixColor->getGreen()) / 2,
            ($color->getBlue() + $mixColor->getBlue()) / 2
        );
    }

    public static function inverse(ColorInterface $color)
    {

        if ($color instanceof AlphaColorInterface) {

            $color = $color->toRgba();

            return new RgbaColor(
                255 - $color->getRed(),
                255 - $color->getGreen(),
                255 - $color->getBlue(),
                $color->getAlpha()
            );
        }

        $color = $color->toRgb();

        return new RgbColor(
            255 - $color->getRed(),
            255 - $color->getGreen(),
            255 - $color->getBlue()
        );
    }

    public static function lighten(ColorInterface $color, $ratio)
    {

        if ($color instanceof AlphaColorInterface) {

            $hsla = $color->toHsla();
            return $hsla->setLightness($hsla->getLightness() + $ratio);
        }

        $hsl = $color->toHsl();
        return $hsl->setLightness($hsl->getLightness() + $ratio);
    }

    public static function darken(ColorInterface $color, $ratio)
    {

        if ($color instanceof AlphaColorInterface) {

            $hsla = $color->toHsla();
            return $hsla->setLightness($hsla->getLightness() - $ratio);
        }

        $hsl = $color->toHsl();
        return $hsl->setLightness($hsl->getLightness() - $ratio);
    }

    public static function saturate(ColorInterface $color, $ratio)
    {

        if ($color instanceof AlphaColorInterface) {

            $hsla = $color->toHsla();
            return $hsla->setSaturation($hsla->getSaturation() + $ratio);
        }

        $hsl = $color->toHsl();
        return $hsl->setSaturation($hsl->getSaturation() + $ratio);
    }

    public static function desaturate(ColorInterface $color, $ratio)
    {

        if ($color instanceof AlphaColorInterface) {

            $hsla = $color->toHsla();
            return $hsla->setSaturation($hsla->getSaturation() - $ratio);
        }

        $hsl = $color->toHsl();
        return $hsl->setSaturation($hsl->getSaturation() - $ratio);
    }

    public static function greyscale(ColorInterface $color)
    {

        if ($color instanceof AlphaColorInterface)
            return $color->toHsla()->setSaturation(0);

        return $color->toHsl()->setSaturation(0);
    }

    public static function complement(ColorInterface $color, $degrees = null)
    {

        $degrees = $degrees !== null ? $degrees : 180;

        if ($color instanceof AlphaColorInterface) {

            $hsla = $color->toHsla();
            return $hsla->setHue($hsla->getHue() + $degrees);
        }

        $hsl = $color->toHsl();
        return $hsl->setHue($hsl->getHue() + $degrees);
    }

    public static function fade(ColorInterface $color, $ratio)
    {

        $color = $color->toAlpha();
        return $color->setAlpha($color->getAlpha() - $ratio);
    }

    //http://www.easyrgb.com/index.php?X=DELT&H=05#text5
    public static function getDifference(ColorInterface $color, ColorInterface $compareColor, array $weights = [1,1,1])
    {

        $color = $color->toLab();
        $compareColor = $compareColor->toLab();

        $weights = array_pad($weights, 3, 1);
        
        $kl = $weights[0];
        $kc = $weights[1];
        $kh = $weights[2];

        $l1 = $color->getL();
        $a1 = $color->getA();
        $b1 = $color->getB();
        $l2 = $compareColor->getL();
        $a2 = $compareColor->getA();
        $b2 = $compareColor->getB();

        $c1 = sqrt($a1 * $a1 + $b1 * $b1);
        $c2 = sqrt($a2 * $a2 + $b2 * $b2);
        $cx = ($c1 + $c2) / 2;
        $gx = 0.5 * (1 - sqrt(($cx ** 7) / (($cx ** 7) + (25 ** 7))));
        $nn = (1 + $gx) * $a1;
        $c1 = sqrt($nn * $nn + $b1 * $b1);
        $h1 = self::cieLabToHue($nn, $b1);
        $nn = (1 + $gx) * $a2;
        $c2 = sqrt($nn * $nn + $b2 * $b2);
        $h2 = self::cieLabToHue($nn, $b2);
        $dl = $l2 - $l1;
        $dc = $c2 - $c1;

        $dh = 0;
        if (($c1 * $c2) !== 0) {

            $nn = round($h1 - $h2, 12);
            if (abs($nn) <= 180) {
                $dh = $h2 - $h1;
            } else {
                if ($nn > 180)
                    $dh = $h2 - $h1 - 360;
                else
                    $dh = $h2 - $h1 + 360;
           }
        }

        $dh = 2 * sqrt($c1 * $c2) * sin(deg2rad($dh / 2));
        $lx = ($l1 + $l2) / 2;
        $cy = ($c1 + $c2) / 2;

        $hx = $h1 + $h2;
        if (($c1 * $c2) !== 0) {

            $nn = abs(round($h1 - $h2, 12));
            if ($nn > 180) {
                if (($h2 + $h1) < 360)
                    $hx = $h1 + $h2 + 360;
                else
                    $hx = $h1 + $h2 - 360;
            } else {
                $hx = $h1 + $h2;
            }
            $hx /= 2;
        }

        $tx = 1 - 0.17 * cos(deg2rad($hx - 30)) + 0.24 * cos(deg2rad(2 * $hx)) + 0.32
            * cos(deg2rad(3 * $hx + 6)) - 0.20 * cos(deg2rad(4 * $hx - 63));
        $ph = 30 * exp(-(($hx - 275) / 25) * (($hx - 275) / 25));
        $rc = 2 * sqrt(($cy ** 7) / (($cy ** 7) + (25 ** 7)));
        $sl = 1 + ((0.015 * (($lx - 50) * ($lx - 50))) / sqrt(20 + (($lx - 50) * ($lx - 50))));
        $sc = 1 + 0.045 * $cy;
        $sh = 1 + 0.015 * $cy * $tx;
        $rt = -sin(deg2rad(2 * $ph)) * $rc;
        $dl /= ($kl * $sl);
        $dc /= ($kc * $sc);
        $dh /= ($kh * $sh);

        return sqrt(($dl ** 2) + ($dc ** 2) + ($dh ** 2) + $rt * $dc * $dh);
    }

    private static function cieLabToHue(float $a, float $b)
    {
        
        $bias = 0;
        if ($a >= 0 && $b === 0.0)
            return 0;

        if ($a < 0 && $b === 0.0)
            return 180;

        if ($a === 0.0 && $b >= 0)
            return 90;

        if ($a === 0.0 && $b < 0)
            return 270;

        if ($a > 0 && $b > 0)
            $bias = 0;

        if ($a < 0)
            $bias = 180;

        if ($a > 0 && $b < 0)
            $bias = 360;

        return rad2deg(atan($b / $a)) + $bias;
    }

    public static function equals(ColorInterface $color, ColorInterface $compareColor, $tolerance = null)
    {

        $tolerance = $tolerance ?: 0;
        $deltaE = self::getDifference($color, $compareColor);

        return $deltaE <= $tolerance;
    }

    public static function toHtml(ColorInterface $color, $width = null, $height = null)
    {

        $width = $width ?: 120;
        $height = $height ?: 120;
        $color = $color->toRgba();
        $inversed = self::inverse($color)->toRgba();
        $name = self::toName($color);

        $hue = $color->toHsl()->getHue();
        return sprintf(
            '<div style="display: inline-block; vertical-align: middle; width: %dpx; height: %dpx; '.
            'background: %s; color: %s; font-size: 12px; font-family: Arial, sans-serif; '.
            'text-align: center; line-height: %dpx;">%s<br>%s<br>%s%s</div>',
            $width,
            $height,
            $color,
            $inversed,
            (int)($height / 4),
            $color->toLab()->toRgb(),
            Color::toHexString($color->toRgb()),
            self::getHueRange($hue).'->'.round($hue, 2),
            $name ? "<br>$name" : ''
        );
    }
}
