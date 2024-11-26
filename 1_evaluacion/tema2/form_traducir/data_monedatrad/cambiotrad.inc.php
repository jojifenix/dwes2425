
<?php
DEFINE("BR","<br/>\n");
DEFINE("MAX_CANT",50000);
DEFINE("VALS",[
               "dolar"=>["literal"=>"dolares","tipo"=>1.03],
               "yen"=>["literal"=>"yenes","tipo"=>1.28],
               "yuan"=>["literal"=>"yuanes","tipo"=>0.96],
               "pesos"=>["literal"=>"pesos argentinos","tipo"=>223.98],
               "lirat"=>["literal"=>"liras turcas","tipo"=>223.98],
               "pesom"=>["literal"=>"pesos mexicanos","tipo"=>223.98]]);
               
DEFINE("LANGS",["es"=>["name"=>"Espa&ntilde;ol",
                       "translate"=>"traducir",
                       "choose_lang"=>"Elige tu idioma:",
                       "quantity"=>"Cantidad",
                       "dest_currency"=>"Moneda destino",
                       "submit"=>"enviar",
                       "equivalence"=>"equivale a",
                       "next"=>"continuar",
                       "noaccess"=>"acceso denegado",
                       "gtzero"=>"La cantidad debe ser mayor que 0",
                       "exit"=>"Salir"],

                "en"=>["name"=>"English",
                       "translate"=>"translate",
                       "choose_lang"=>"Choose your language:",
                       "quantity"=>"Amount" ,
                       "dest_currency"=>"Currency destination",
                       "submit"=>"submit",
                       "equivalence"=>"are equal to",
                       "next"=>"go on",
                       "noaccess"=>"access denied",
                       "gtzero"=>"The amount must be greater than 0",
                       "exit"=>"Exit"],
               
                "fr"=>["name"=>"Français",
                       "translate"=>"traduire",
                        "choose_lang"=>"Choisiz vôtre lange:",
                        "quantity"=>"Quantité",
                        "dest_currency"=>"Device de destination: ",
                        "submit"=>"envoyer",
                        "equivalence"=>"sont équivalents à",//mirar con 
                        "next"=>"continuer",
                        "noaccess"=>"accès refusé",
                        "gtzero"=>"la montant doit être supérieur à 0",
                        "exit"=>"sortir"
               ]]);

               ?>