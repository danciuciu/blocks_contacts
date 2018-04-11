<?php

/**
 * @package   blocks_contacts
 * @copyright 2017 onwards SC Elearning & Software SRL  {@link http://elearningsoftware.ro/}
 */

require_once '../../config.php';
require_once $CFG->dirroot.'/blocks/contacts/lib.php';
require_once($CFG->libdir.'/formslib.php');
require_once($CFG->dirroot.'/repository/lib.php');


$PAGE->set_context(context_system::instance());
$PAGE->set_url('/blocks/contacts/view_contacts.php');

$PAGE->set_title(get_string('contacts', 'block_contacts'));
$PAGE->set_heading(get_string('contacts', 'block_contacts'));
$PAGE->set_pagelayout('base');



echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('contacts', 'block_contacts'));

echo'<table style="width:100%">
    <tr>
    <th>Nume</th>
    <th>Prenume</th>
    <th>Adresa</th>
    <th>Email</th>
  </tr>
  ';

  $results = $DB->get_records_sql('SELECT * FROM {blocks_contacts} ');
  foreach($results as $result){
  //$content .= $result->nume.'<br>';
    echo '<tr>
          <td>'.$result->nume.'</td>
          <td>'.$result->prenume.'</td>
          <td>'.$result->adresa.'</td>
          <td>'.$result->email.'</td>
          </tr>';
  //var_dump($result);die();
  }
  echo '</table>';



//echo $content;
//echo $formular->render();
echo $OUTPUT->footer();
