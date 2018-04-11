<?php

/**
 * @package   blocks_contacts
 * @copyright 2017 onwards SC Elearning & Software SRL  {@link http://elearningsoftware.ro/}
 */

require_once $CFG->dirroot.'/config.php';
require_once $CFG->dirroot.'/blocks/contacts/lib.php';
require_once($CFG->libdir.'/formslib.php');
require_once($CFG->dirroot.'/repository/lib.php');


class contacts_form extends moodleform {

    /**
     * Defines the form
     */
    public function definition() {
        global $USER, $CFG, $DB;

        $mform = $this->_form;

        $mform->addElement('text', 'nume',  get_string('nume', 'block_contacts'));
        $mform->setType('nume', PARAM_NOTAGS);
        $mform->addRule('nume', get_string('required'), 'required');

        $mform->addElement('text', 'prenume',  get_string('prenume', 'block_contacts'));
        $mform->setType('prenume', PARAM_NOTAGS);
        $mform->addRule('prenume', get_string('required'), 'required');

        $mform->addElement('text', 'adresa',  get_string('adresa', 'block_contacts'));
        $mform->setType('adresa', PARAM_NOTAGS);
        $mform->addRule('adresa', get_string('required'), 'required');

        $mform->addElement('text', 'email',  get_string('email', 'block_contacts'));
        $mform->setType('email', PARAM_NOTAGS);
    $mform->addRule('email', get_string('required'), 'required'/*, '', 'client'*/);





        $buttonarray = array();
        $buttonarray[] = $mform->createElement('submit', 'submit' , get_string('send', 'block_contacts'));
        $buttonarray[] = $mform->createElement('cancel');

        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
    }


    public function validation($data, $files) {
        $errors = parent::validation($data, $files);
        //var_dump($data);die();
      /*  foreach($data as $key => $value) {
           if(empty($value) && $value== "email") {
             $errors["email"] = 'required';
           }
         }*/
        //var_dump($data);die();
        return $errors;
    }
}
