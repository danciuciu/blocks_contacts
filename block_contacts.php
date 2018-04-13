<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Form for editing contacts block instances.
 *
 * @package   block_contacts
 * @copyright 1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license   http://www.gnu.org/copyleft/gpl.contacts GNU GPL v3 or later
 */

class block_contacts extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_contacts');
    }

    function has_config() {
        return true;
    }

    function applicable_formats() {
        return array('all' => true);
    }

    function specialization() {
        $this->title = isset($this->config->title) ? format_string($this->config->title) : format_string(get_string('newcontactsblock', 'block_contacts'));
    }

    function instance_allow_multiple() {
        return true;
    }

    function get_content() {
        global $CFG, $USER, $DB;

        require_once($CFG->libdir . '/filelib.php');
        require_once($CFG->dirroot . '/blocks/contacts/contacts_form.php');
      //  var_dump($CFG->dirroot);die();


      //$formular = new \contacts_form();

      $this->content = new \stdClass;

     $this->content->text = "<script src='https://www.google.com/recaptcha/api.js'></script>";
//var_dump($CFG->wwwroot);die();

     /*  if ($formular->is_cancelled()) {
          redirect($CFG->wwwroot.'');

      } else if ($data = $formular->get_data()) {
          var_dump($data);die();
          $dataobject = new \stdClass();
          $dataobject->nume = $data->nume;
          $dataobject->prenume = $data->prenume;
          $dataobject->adresa = $data->adresa;
          $dataobject->email = $data->email;

         $DB->insert_record('blocks_contacts', $dataobject);
         redirect($CFG->wwwroot);
         */
    /*$this->content->text.=' div class="alert alert-success">
  <strong>Success!</strong> Indicates a successful or positive action.
</div>';*/
        //}
        //$this->content->text .= $formular->render();
        $this->content->text .= '
        <form method="POST">
            <div class="form-group">
             <div>
             <label>Nume:</label>
             <input type="text" name="nume" class="form-control" >
             </div>
             <div>
             <label>Prenume:</label>
             <input type="text" name="prenume" class="form-control" >
             </div>
             <div>
             <label>Adresa:</label>
             <input type="text" name="adresa" class="form-control" >
             </div>
             <div>
             <label>Email:</label>
             <input type="text" name="email"  class="form-control" >
             </div>
            </div>
            <div class="g-recaptcha" data-sitekey="6LczgVIUAAAAAOqCHW2lEPDY41SEc5q1QIhHc6-Z"></div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        ';
        if(!empty($_POST)) {
            //var_dump($_POST);die();
            if(!empty($_POST['g-recaptcha-response'])) {
                $captcha=$_POST['g-recaptcha-response'];

                $secretKey = "6LczgVIUAAAAAH1Tz4nqBPIaX1PmT_8VOBQR4tmB";
                $ip = $_SERVER['REMOTE_ADDR'];
                $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
                $responseKeys = json_decode($response,true);

                if(intval($responseKeys["success"]) !== 1 && !empty($_POST['nume']) && !empty($_POST['prenume'])&& !empty($_POST['adresa'])&& !empty($_POST['email'])){
                    $dataobject = new \stdClass;
                    $dataobject->nume = $_POST['nume'];
                    $dataobject->prenume = $_POST['prenume'];
                    $dataobject->adresa = $_POST['adresa'];
                    $dataobject->email = $_POST['email'];
                    $DB->insert_record('blocks_contacts', $dataobject);

                    $this->content->text .= '<div class="alert alert-success">
                <strong>Success!</strong> Contactul a fost salvat.</div>';
                } else {
                    $this->content->text .= '<div class="alert alert-danger">
                    <strong>Danger!</strong> You need to complete all fields ! </div>';
                }
            } else {
                 $this->content->text .='<div class="alert alert-warning">
             <strong>Warning!</strong> Please check the the captcha form. </div>';
            }
         }







        if ($this->content !== NULL) {
            return $this->content;
        }

        $filteropt = new stdClass;
        $filteropt->overflowdiv = true;
        if ($this->content_is_trusted()) {
            // fancy contacts allowed only on course, category and system blocks.
            $filteropt->noclean = true;
        }

        $this->content = new stdClass;
        $this->content->footer = '';
        /*if (isset($this->config->text)) {
            // rewrite url
            $this->config->text = file_rewrite_pluginfile_urls($this->config->text, 'pluginfile.php', $this->context->id, 'block_contacts', 'content', NULL);
            // Default to FORMAT_contacts which is what will have been used before the
            // editor was properly implemented for the block.
            $format = FORMAT_HTML;
            // Check to see if the format has been properly set on the config
            if (isset($this->config->format)) {
                $format = $this->config->format;
            }
            $this->content->text = format_text($this->config->text, $format, $filteropt);
        } else {
            $this->content->text = '';
        }*/
        //$student = $DB->get_record_sql('SELECT * FROM {user} WHERE id = ?', array($userid));
        //$username = $DB->get_field_sql('SELECT username FROM {user} WHERE id=?', array(3));*/
        /*$this->content->text = '';
        $users = $DB->get_records_sql('SELECT * FROM {user} WHERE id = 5 OR id =6');
        foreach($users as $user) {
            $this->content->text .= '<div class="test">Ce faci '.$user->username.'?</div><br>';

        }*/
        /*$this->content->text = '
        <form action="http://reteaualocala.ro/blocks/contacts/returnform.php" method="post">
            Name: <input type="text" name="name"><br>
            E-mail: <input type="text" name="email"><br>
            <input type="submit">
        </form>
        ';*/

      //  $this->content->text = ' Date Contact ';

        unset($filteropt); // memory footprint

        return $this->content;
    }


    /**
     * Serialize and store config data
     */
    function instance_config_save($data, $nolongerused = false) {
        global $DB;

        $config = clone($data);
        // Move embedded files into a proper filearea and adjust contacts links to match
        $config->text = file_save_draft_area_files($data->text['itemid'], $this->context->id, 'block_contacts', 'content', 0, array('subdirs'=>true), $data->text['text']);
        $config->format = $data->text['format'];

        parent::instance_config_save($config, $nolongerused);
    }

    function instance_delete() {
        global $DB;
        $fs = get_file_storage();
        $fs->delete_area_files($this->context->id, 'block_contacts');
        return true;
    }

    /**
     * Copy any block-specific data when copying to a new block instance.
     * @param int $fromid the id number of the block instance to copy from
     * @return boolean
     */
    public function instance_copy($fromid) {
        $fromcontext = context_block::instance($fromid);
        $fs = get_file_storage();
        // This extra check if file area is empty adds one query if it is not empty but saves several if it is.
        if (!$fs->is_area_empty($fromcontext->id, 'block_contacts', 'content', 0, false)) {
            $draftitemid = 0;
            file_prepare_draft_area($draftitemid, $fromcontext->id, 'block_contacts', 'content', 0, array('subdirs' => true));
            file_save_draft_area_files($draftitemid, $this->context->id, 'block_contacts', 'content', 0, array('subdirs' => true));
        }
        return true;
    }

    function content_is_trusted() {
        global $SCRIPT;

        if (!$context = context::instance_by_id($this->instance->parentcontextid, IGNORE_MISSING)) {
            return false;
        }
        //find out if this block is on the profile page
        if ($context->contextlevel == CONTEXT_USER) {
            if ($SCRIPT === '/my/index.php') {
                // this is exception - page is completely private, nobody else may see content there
                // that is why we allow JS here
                return true;
            } else {
                // no JS on public personal pages, it would be a big security issue
                return false;
            }
        }

        return true;
    }

    /**
     * The block should only be dockable when the title of the block is not empty
     * and when parent allows docking.
     *
     * @return bool
     */
    public function instance_can_be_docked() {
        return (!empty($this->config->title) && parent::instance_can_be_docked());
    }

    /*
     * Add custom contacts attributes to aid with theming and styling
     *
     * @return array
     */
    function contacts_attributes() {
        global $CFG;

        $attributes = parent::contacts_attributes();

        if (!empty($CFG->block_contacts_allowcssclasses)) {
            if (!empty($this->config->classes)) {
                $attributes['class'] .= ' '.$this->config->classes;
            }
        }

        return $attributes;
    }
}
