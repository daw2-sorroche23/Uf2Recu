<?php
require_once('class.collection.php');
require_once("observable.php");
require_once("abstract_widget.php");
require_once('class.collectionData.php');
require_once('class.collectionWidget.php');
require_once('CompositePatternDemo.php');
require_once('class.collectionHabitaciones.php');
require_once('class.collectionPuerta.php');
require_once('class.collectionVentana.php');

class Foo{

  private $_name;
  private $_number;

  public function __construct($name, $number){
    $this->_name = $name;
    $this->_number = $number;
  }

  public function __toString() {
    return $this->_name . ' is number ' . $this->_number;
  }

}

$colFoo = new Collection();
$colFoo->addItem(new Foo("Steve", 14), "steve");
$colFoo->addItem(new Foo("Ed", 37), "ed");
$colFoo->addItem(new Foo("Bob", 49));

$objSteve = $colFoo->getItem("steve");

print $objSteve; //prints "Steve is number 14"
$colFoo->removeItem("steve"); //deletes the "steve" object

try {
  $objSteve = $colFoo->getItem("steve"); //throws KeyInvalidException
} catch (KeyInvalidException $kie) {
  print "<br> Thec collection doesn't contain anything called 'steve'";
}

//Ejercicio 2

$dat = new DataSource();

$dat2 = new DataSource();

$widgetA = new BasicWidget();

$widgetB = new FancyWidget();

$colData = new DataCollection();

$colWidget = new WidgetCollection();

$colData->addItem($dat,1);

$colData->addItem($dat2,2);

$objData = $colData->getItem(1);

$objData2 = $colData->getItem(2);

$colWidget->addItem($widgetA,1);

$colWidget->addItem($widgetB,2);

$objWidget = $colWidget->getItem(1);

$objWidget2 = $colWidget->getItem(2);

$objData->addObserver($objWidget);

$objData2->addObserver($objWidget2);

$objData->addRecord("drum", "$12.95", 1955);

$objData2->addRecord("banjo", "$100.95", 1945);
$objData2->addRecord("piano", "$120.95", 1999);

$objWidget->draw();

$objWidget2->draw();


//Ejercicio 3

$comedor = new Habitacion("Comedor",20);
$habitacion = new Habitacion("Habitacion",10);
$pasillo = new Habitacion("Pasillo",5);

$colHabitacion = new HabitacionCollection();
$colHabitacion->addItem($comedor,1);
$colHabitacion->addItem($habitacion,2);
$colHabitacion->addItem($pasillo,3);

$puertaEntrada = new Puerta("Puerta entada",4);
$puertaEntradaPasillo = new Puerta("Puerta pasillo",4);
$puertaEntadaHabitacion = new Puerta("Puerta habitacion",4);

$colPuerta = new PuertaCollection();
$colPuerta->addItem($puertaEntrada,1);
$colPuerta->addItem($puertaEntradaPasillo,2);
$colPuerta->addItem($puertaEntadaHabitacion,3);


$ventanaComedor = new Ventana("Ventana del Comedor",20);
$ventanaHabitacion = new Ventana("Ventana de la habitacion",20);

$colVentana = new VentanaCollection();
$colVentana->addItem($ventanaComedor,1);
$colVentana->addItem($ventanaHabitacion,2);


$ColComedor = $colHabitacion->getItem(1);
$ColHabitacion = $colHabitacion->getItem(2);
$ColPasillo = $colHabitacion->getItem(3);

$ColPuertaEntrada = $colPuerta->getItem(1);
$ColPuertaEntadaPasillo = $colPuerta->getItem(2);
$ColPuertaEntradaHabitacion = $colPuerta->getItem(3);

$ColVentanaComedor = $colVentana->getItem(1);
$ColVentanaHabitacion = $colVentana->getItem(2);

//Empezamos a crear el arbol


$ColPuertaEntrada->add($ColComedor);
$ColComedor->add($ColVentanaComedor);
$ColComedor->add($ColPuertaEntadaPasillo);
$ColPuertaEntadaPasillo->add($ColPasillo);
$ColPasillo->add($ColPuertaEntradaHabitacion);
$ColPuertaEntradaHabitacion->add($ColHabitacion);
$ColHabitacion->add($ColVentanaHabitacion);

$totalSuperficie = $ColPuertaEntrada->sumar();

