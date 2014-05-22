'use strict';


// Declare app level module which depends on filters, and services
angular.module('usvit', [
    'ngRoute',
    'ngResource',
    'ngSanitize',
    'usvit.controllers',
    'usvit.directives',
    'usvit.services',
    'usvit.filters'
])
    .config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
        $routeProvider
        .when("/ucastnici",{templateUrl: 'partials/articles.html',controller:"mainUcaCtrl"})
        .when("/ucastnici/:race",{templateUrl: 'partials/articles.html',controller:"mainUcaCtrl"})
        .when("/ucastnici/:race/:ucaID",{templateUrl: 'partials/articles.html',controller:"mainUcaCtrl"})
        .when("/:categ",{templateUrl: 'partials/articles.html',controller:"mainCtrl"})
        .when("/:categ/:artID",{templateUrl: 'partials/articles.html',controller:"mainCtrl",slide:true})
//        .when("/ucast/:fraction",{action:"ucast.none"})
//        .when("/ucast/:fraction/:ucasID",{action:"ucast.ucas"})
//        .when("/ucast/new",{action:"ucast.new"})
//        .when("/ucast/update",{action:"ucast.update"})
        .otherwise({redirectTo: '/home'});
}])
//    .config(['$resourceProvider', function ($resourceProvider) {
//       // Don't strip trailing slashes from calculated URLs
//       $resourceProvider.defaults.stripTrailingSlashes = false;
//     }])
 ;
window.data={};
window.data.filters={art:[
        {id:"all",title:"Vše",art:true},
        {id:"actual",title:"Aktuality",art:true},
        {id:"important",title:"Důležité",art:true},
        {id:"noviny",title:"Noviny",art:true},
        {id:"forum",title:"Fórum",art:true}
    ],
    uca:[
        {id:"all",title:"Vše"},
        {id:"upiri",title:"Upíři"},
        {id:"vlkodlaci",title:"Vlkodlaci"},
        {id:"lovci",title:"Lovci"},
        {id:"rodina",title:"Rodina"},
        {id:"novinari",title:"Novináři"},
        {id:"cp",title:"CP a bestie"}
    ]
},
window.data.false_articles=[
        {   
            id:"art1",
            title:"Info 1",
            short:"Místo, Dokumenty, S sebou",
            long:"<h3>Místo sídel</h3>Sokolovna<ul><li>Lovci + Rodina</li><li>49°52'59.988\"N,16°51'59.355\"E</li></ul>Dvojka<ul><li>Upíři + Vlkodlaci</li><li>49°53'3.561\"N,16°52'10.493\"E</li></ul><h3>Dokumenty:</h3><a href='doc/prihlaska_2013.pdf'>Přihláška</a> a pro hráče mladší 18 let <a href='doc/povoleni_2013.pdf'>potvrzení od rodičů</a><br />         <hr />         <h3>Co s sebou:</h3>         Pokud možno dovézt následující věci:             <ul style='font-weight:normal'>             <li><b>Spacák</b> - spaní zajištěno v nevytápěných prostorách</li>             <li><b>Baterku</b> - hraje se v noci :-)</li><li><b>Mobil</b> - v současnosti jsou mobily nutností</li>             <li><b>CD marker</b> - budete psát na laminované kartičky</li>             <!--<li><b>Peníze</b> - na útratu v baru</li>-->             <li><b>Dobrou náladu</b> :-)</li>             </ul> <hr><h2>Herní doba</h2><ul>             <li>Pátek 20:00 až sobota 4:00</li>             <li>Sobota 10:00 až sobota 20:00 - meziherní doba</li>             <li>Sobota 20:00 až neděle 4:00</li>             <p>Meziherní doba - pro zájemce, je zakázáno nosit zbraně, natož bojovat. Pohyb venku je omezen.</p>         </ul>         <hr />         <br>         <p>Přespání zajištěno v tělocvičně, kde si také můžete nechat věci nepotřebné pro vlastní hru. </p>",
            categ:"home"
        },
        {   
            id:"art2",
            title:"Organizátoři",
            short:"Seznam",
            long:"<h3><u>Organizátoři:</u></h3> <h4>Petr Cesťák Hošek</h4> e-mail: ringael@seznam.cz<br /> tel: 603312653   <h4>Pavel Jezevec Herman</h4> e-mail: Jezevec1@centrum.cz<br /> tel: 733347824   <h3><u>Vývojový tým:</u></h3> <h4>Milan Sam Pěkný</h4> e-mail: magytak@seznam.cz   <h4>Ivo Bonhart Nepeřil</h4> e-mail: bonhart@centrum.cz   <h4>Zděněk Tarzan Mlčoch</h4> e-mail: mlcoch.zdenek@seznam.cz",
            categ:"home"
        },
        {   
            id:"art3",
            title:"Pravidla",
            short:"povídání o psech",
            long:"fosdh jkgnsdjk n gbjkas ndbkjs",
            categ:"important"
        },
        {   
            id:"art4",
            title:"Bubla nejede",
            short:"povídání o kočkách",
            long:"fosdh jkgnsdjk n gbjkas ndbkjs",
            categ:"noviny"
        },
        {   
            id:"art6",
            title:"Bubla se ožere",
            short:"povídání o plazechh",
            long:"fosdh jkgnsdjk n gbjkas ndbkjs",
            categ:"noviny"
        }
];
window.data.ucastnici=[
    {
        "id": 6,
        "name": "Evgeny",
        "surname": "Patlasov",
        "nick": "Spike",
        "email": "kresder.l@gmail.com",
        "gamenick": "Spike",
        "frac": "upiri",
        "title": 0,
        "photo": 1,
        "appr": true,
        "zapl": 0,
        "text": ""
    },
    {
        "id": 12,
        "name": "Marek",
        "surname": "Stojan",
        "nick": "Eskel",
        "email": "amil96cz@seznam.cz",
        "gamenick": "",
        "frac": "upiri",
        "title": 0,
        "photo": 1,
        "appr": true,
        "zapl": 0,
        "text": "<p></p>"
    },
    {
        "id": 27,
        "name": "Ivo",
        "surname": "Nepeřil",
        "nick": "Bonhart",
        "email": "bonhart@centrum.cz",
        "gamenick": "Markus von Raven",
        "frac": "upiri",
        "title": 2,
        "photo": 1,
        "appr": true,
        "zapl": 0,
        "text": "<br>\nRumunský diplomat anglického původu. Ve sboru ministerstva zahraničí působí už čtyři roky, přežil dva ministry a velmi pravděpodobně přežije i třetího. Oficiálně je velvyslancem se zvláštním posláním, pověřeným spoluprací s ministerstvem kultury na projektu restaurace rumunského národního dědictví.<br>\nNechybí při žádné oficiální příležitosti a většinou ani při těch neoficiálních. Má se za to, že jeho skutečný vliv sahá až do vysoké politiky a dost možná nejen té. Velvyslanec navíc platí za bohatého člověka, avšak samotný diplomatický plat, ač nezanedbatelný, toho příčinou může být jen stěží. Pakliže se však podílí na čemkoliv nezákonném, nenašel se o tom doposud žádný spolehlivý důkaz. Udržuje veřejně přátelské vztahy s dalším angličanem, ve vlasti bývalým politikem, dnes úspěšným rumunským průmyslníkem, Urielem van Wrightem a jeho ženou.<br>\nVon Ravena je poměrně těžké přehlédnout. Vděčí za to poněkud nevšednímu stylu oblékání, kdy nejde právě s poslední módou. Mimo to ještě před nástupem do úřadu absolvoval v Rumunsku jakousi náročnou lékařskou proceduru, jež mu zanechala poněkud nezdravě barvu bledou barvu kůže a zbělané vlasy."
    }
];
