<?php
// Mise à jour 2024-2025 : Gestion des dates en PHP
// 1-Définir explicitement le fuseau horaire (exemple pour Owen et Eva)
date_default_timezone_set('Europe/Paris');

// 01. Afficher le timestamp actuel
echo "Timestamp actuel : " . time() . '<br>';

// 2. Afficher la date actuelle
echo "Date actuelle : " . date('Y-m-d H:i:s') . '<br>';

// 3. Afficher la date d'hier (en soustrayant 86400 secondes)
echo "Hier : " . date('Y-m-d H:i:s', time() - 86400) . '<br>';

// 4. Afficher la date dans un format personnalisé
echo "Format personnalisé : " . date('F j Y, H:i:s') . '<br>';

// 5. Conversion d'une chaîne en timestamp
echo "Timestamp ('now') : " . strtotime('now') . '<br>';
echo "Timestamp ('+1 day') : " . strtotime('+1 day') . '<br>';
echo "Timestamp ('+1 week') : " . strtotime('+1 week') . '<br>';

// 6. Analyse d'une date avec date_parse()
// Exemple avec une date mise à jour pour 2024
$dateString = '2024-02-06 12:45:35';
$parsedDate = date_parse($dateString);
echo '<pre>';
var_dump($parsedDate);
echo '</pre>';

// 7. Analyse d'une date avec un format spécifique
// Exemple avec une date en anglais pour 2024
$dateString = 'February 4 2024 12:45:35';
$parsedDate = date_parse_from_format('F j Y H:i:s', $dateString);
echo '<pre>';
var_dump($parsedDate);
echo '</pre>';