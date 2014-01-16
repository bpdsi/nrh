<?
$mongoDB="lab";
/*$db=new Mongo("mongodb://158.108.181.59:27017");
$connection=$db->selectDB($mongoDB)or die("error");

$collection = $connection->database->collectionName;*/

$db = new Mongo("mongodb://158.108.181.59:27017");
$connection=$db->selectDB($mongoDB)or die("error");
$collection = $connection->lab_test;

//print_r($collection);
echo $collection->count();

//echo $collection->count();

//print_r($connection->getCollectionNames());
//$collection=$connection->selectCollection("lab_test");
?>