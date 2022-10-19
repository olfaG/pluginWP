<?php

/*
Plugin Name: Suiv_Stagiaires
Plugin URI: https://classroomsdev.doranco.fr/wp-admin
version:1.0 
author:olfa stagiaire
description:c'est la première version de mon nouveau plugin qui trace l'activité des stagiaires.
author URI:https://classroomsdev.doranco.fr/wp-admin
*/

   //configuration de la base de donnée
   $dbHost     = "localhost"; 
   $dbUsername = "root"; 
   $dbPassword = ""; 
   $dbName     = "stage"; 

   // création de la connexion
   $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
   add_filter('default_content', 'rechercher');
function rechercher(){
    $articles = $bdd->query('SELECT titre FROM articles ORDER BY id DESC');
    if(isset($_GET['q']) AND !empty($_GET['q'])) {
       $q = htmlspecialchars($_GET['q']);
       $articles = $bdd->query('SELECT titre FROM articles WHERE titre LIKE "%'.$q.'%" ORDER BY id DESC');
       if($articles->rowCount() == 0) {
          $articles = $bdd->query('SELECT titre FROM articles WHERE CONCAT(titre, contenu) LIKE "%'.$q.'%" ORDER BY id DESC');
       }
    }




function afficher(){
    
    $result = $db->query("SELECT * FROM ajout_stag ORDER BY id DESC");
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){


}
}
apply_filters('the_content', string $content);
function insererApresContenu($content){
    $content.= 
    "<tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nom']; ?></td>
        <td><?php echo $row['prenom']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['inscription']; ?></td>
        <td><?php echo $row['leçons']; ?></td>
        <td><?php echo $row['chapitres']; ?></td>
        <td><?php echo $row['modules']; ?></td>
        <td><?php echo $row['quizz']; ?></td>
        <td><?php echo $row['points']; ?></td>
        <td><?php echo $row['dercon']; ?></td>
    </tr>";
    return $content
}

add_action('wp_head','csv');
function csv(){

    $result = $db->query("SELECT * FROM ajout_stag ORDER BY id DESC");
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
    
        "<tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nom']; ?></td>
            <td><?php echo $row['prenom']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['inscription']; ?></td>
            <td><?php echo $row['leçons']; ?></td>
            <td><?php echo $row['chapitres']; ?></td>
            <td><?php echo $row['modules']; ?></td>
            <td><?php echo $row['quizz']; ?></td>
            <td><?php echo $row['points']; ?></td>
            <td><?php echo $row['dercon']; ?></td>
        </tr>"
}
do_action('wp_head','exporter' )
function exporter(){
    // Récupérer les éléments de la base de données 
$query = $db->query("SELECT * FROM ajout_stag ORDER BY id ASC"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "stag_" . date('Y-m-d') . ".csv"; 
     
    // créer un dossier
    $f = fopen('php://memory', 'w'); 
     
    // Définir les en-têtes de colonne 
    $fields = array('NOM','PRENOM', 'adresse mail', 'DATE D\'inscription', 'Nombre de leçons', 'Nombre de chapitres', 'Nombre de modules', 'nombre de quizz', 'nombre de points','dernière connexion'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Sortie de chaque ligne de données, conversion de la ligne en csv et écriture dans le dossier du fichier. 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['inscription'], $row['leçcons'], $row['chapitres'], $row['modules'],$row['quizz'],$row['points'],$row['dercon']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Retourner au début du fichier 
    fseek($f, 0); 
     
    // Définir les en-têtes pour télécharger le fichier plutôt que de les afficher 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //sortie de toutes les données restantes sur le dossier du fichier 
    fpassthru($f); 
} 
exit;

}
?>








