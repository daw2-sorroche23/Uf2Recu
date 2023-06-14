<html>
<body>
<head>
<style>
body {font : 12px verdana; font-weight:bold}
td {font : 11px verdana;}
</style>
</head>

<?php

abstract class Construccion {
  
  private $name;
  private $superficie;
  private $casa = array();
  
  public function add(Construccion $casa) {
     array_push($this->casa, $casa);
  }
  
  public function remove(Construccion $casa) {
     array_pop($this->casa);
  }
        
  public function hasChildren() {
    return (bool)(count($this->casa) > 0);
  }
    
  public function getChild($i) {
    return $this->casa[i];
  }
    
  public function sumar() {
    $superficieTotal=0;
    echo "- one " . $this->getName();
    if ($this->hasChildren()) {
      echo " incluye:<br>";
      foreach($this->casa as $casa) {
        echo "<table cellspacing=5 border=0><tr><td>&nbsp;&nbsp;&nbsp;</td><td>-";
         $superficieHijo = $casa->sumar();
         $superficieTotal= $superficieTotal + $superficieHijo;
         echo "</td></tr></table>";
      }        
    }
    return $superficieTotal + $this->superficie;
  }
  
 public function setName($name) {
   $this->name = $name;
 }
  
 public function getName() {
   return $this->name;
 }
         
 public function setSuperficie($superficie) {
    $this->superficie = $superficie;
 }

 public function getSuperficie() {
   return $this->superficie;
  }
}

class Habitacion extends Construccion {
  function __construct($name, $superficie) {
    parent::setName($name);
    parent::setSuperficie($superficie);
  }
}

class Puerta extends Construccion {
  function __construct($name, $superficie) {
    parent::setName($name);
    parent::setSuperficie($superficie);
  }
}

class Ventana extends Construccion {
  function __construct($name, $superficie) {
    parent::setName($name);
    parent::setSuperficie($superficie);
  }
}


$puertaPrincipal = new Puerta("Puerta Principal",4);
$pasillo1 = new Habitacion("Pasillo entrada",10);

//Parte izquierda del arbol
$puertaInicioCocina = new Puerta("Puerta entrada de la cocina",4);
$cocina = new Habitacion("Cocina",30);
$puertaFinalCocina = new Puerta("Puerta salida de la cocina",4);
$lavadero = new Habitacion("Lavadero",30);

$lavadero->add(new Ventana("Ventana del Lavadero",10));
$puertaFinalCocina->add($lavadero);
$cocina->add($puertaFinalCocina);
$puertaInicioCocina->add($cocina);


$pasillo1->add($puertaInicioCocina);

//FIN parte izquierda del arbol

//Parte derecha del arbol

$puertaInicioComedor = new Puerta("Puerta inicio del comedor",4);
$comedor = new Habitacion("Comedor",100);
$puertaFinComedor = new Puerta("Puerta final del comedor",4);
$pasillo2 = new Habitacion("Pasillo 2",30);
$puertaMiHabitacion = new Puerta("Puerta de mi habitacion",4);
$puertaHabitacionDeMisPadres = new Puerta("Puerta de la habitacion de mis padres",4);
$puertaBanyo = new Puerta("Puerta del banyo",4);
$miHabitacion = new Habitacion("Mi Habitacion",40);
$habitacionDeMisPadres = new Habitacion("Habitacion de mis padres",60);
$Banyo =  new Habitacion("Banyo",25);


$Banyo->add(new Ventana("Ventana del banyo",5));
$habitacionDeMisPadres->add(new Ventana("Ventana de la habitacion de mis padres",30));
$miHabitacion->add(new Ventana("Ventana de mi habitacion",25));
$puertaBanyo->add($Banyo);
$puertaHabitacionDeMisPadres->add($habitacionDeMisPadres);
$puertaMiHabitacion->add($miHabitacion);

$pasillo2->add($puertaBanyo);
$pasillo2->add($puertaHabitacionDeMisPadres);
$pasillo2->add($puertaMiHabitacion);

$puertaFinComedor->add($pasillo2);
$comedor->add($puertaFinComedor);
$comedor->add(new Ventana("Ventana del Comedor",20));
$puertaInicioComedor->add($comedor);

$pasillo1->add($puertaInicioComedor);
$puertaPrincipal->add($pasillo1);

//FIN parte derecha del arbol

$totalSuperficie = $puertaPrincipal->sumar();

echo "La superficie total es ";
echo $totalSuperficie;
echo " m ";

?>

</body>
</html>
