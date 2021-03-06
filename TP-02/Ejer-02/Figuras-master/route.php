<html>
  <head>

  </head>

  <body>
    <?php

      $arrayFiguras = [ "crear"  =>  [ "circulo"   => "Circulo",
                                       "cuadrado"  => "Cuadrado",
                                       "triangulo" => "Trianguo"
                                     ],
                        "buscar"  => [  ],
                        "mostrar" => [ ]
                      ];

      require_once("Figura.php");
      require_once("Cuadrado.php");
      require_once("Triangulo.php");
      require_once("Circulo.php");
      require_once("Figuras.php");
      require_once("AreaFilter.php");

      $figuras = new Figuras();

      $figuras->clear();

      $contFigura = 0;

      $figuras->insert(new Cuadrado(3.0));
      $contFigura = $contFigura + 1;
      $figuras->insert(new Cuadrado(6.3));
      $contFigura = $contFigura + 1;
      $figuras->insert(new Cuadrado(8.0));
      $contFigura = $contFigura + 1;
      $figuras->insert(new Cuadrado(9.0));
      $contFigura = $contFigura + 1;
      $figuras->insert(new Triangulo(1.1,3.5));
      $contFigura = $contFigura + 1;
      $figuras->insert(new Triangulo(9.0,0.1));
      $contFigura = $contFigura + 1;
      $figuras->insert(new Triangulo(4.0,5.0));
      $contFigura = $contFigura + 1;
      $figuras->insert(new Triangulo(5.0,5.0));
      $contFigura = $contFigura + 1;
      $figuras->insert(new Circulo(1.5));
      $contFigura = $contFigura + 1;
      $figuras->insert(new Circulo(2.1));
      $contFigura = $contFigura + 1;
      $figuras->insert(new Circulo(3.0));
      $contFigura = $contFigura + 1;
      $figuras->insert(new Circulo(4.4));
      $contFigura = $contFigura + 1;

      if( isset($_GET['figura']) ){

        $partesURL = explode ('/', $_GET['figura']);

        if ( isset($arrayFiguras[$partesURL[0]]) ){

          if ( $partesURL[0] == 'crear'){

            if ( $partesURL[1] == 'circulo'){
              $selected_object = $arrayFiguras[$partesURL[0]][$partesURL[1]];

              echo "<h1>".$selected_object."</h1>";

              $figuras->insert(new Circulo($partesURL[2]));
              $contFigura = $contFigura + 1;
              echo "La figura Elegida es: " . $figuras->get($contFigura-1)->ToString() . "<br><br>";

            }
          }
          elseif ( $partesURL[0] == 'mostrar' ){

            if ( !is_object( $figuras->get($partesURL[1]-1) ) ){
              echo "<h1>".'No existe la figura n° '.$partesURL[1]."</h1>";
            }
            else{
              echo "La figura Elegida es: " . $figuras->get($partesURL[1]-1)->ToString() . "<br><br>";
            }
          }
          elseif ( $partesURL[0] == 'buscar' ){

            if ( isset($partesURL[1] ) ){
              echo "Las figuras con area menor a ".$partesURL[1]." son:<ul>";
              foreach($figuras->getBy(new AreaFilter($partesURL[1])) as $figura)
                  echo "<li>" . $figura->ToString() . "</li>";
              echo "</ul>";
            }
            else{
              echo "Todas las figuras:<ul>";
              for ($i=0; $i < $contFigura; $i++) {
                echo "<li>" . $figuras->get($i)->ToString() . "</li>";
              }

              echo "</ul>";
            }

          }

        }

      }

    ?>
  </body>
</html>
