<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends Admin_Controller {

    function Admin() {
        parent::Admin_Controller();
        // Check for access permission
        check('Messages');

        $this->load->helper('form');
        $this->load->library('validation');

        // Load pages model
        $this->load->model('MMessages');

        $this->catType = 0; // Messages
        $this->moduleName = 'messages';
        $this->moduleDisplayName = $this->lang->line('app_messages');

        // Set breadcrumb
        $this->bep_site->set_crumb($this->moduleDisplayName, $this->moduleName . '/admin');
    }

    function index($cat = NULL) {
        $this->bep_assets->load_asset_group('MY_TABLE');
        // we use the following variables in the view
        //$data['title'] = $this->moduleDisplayName;
        $per_page = 20;
        $cat = $_GET['per_page'];
        $data['pages'] = $this->MMessages->getAllItem($per_page, $cat);

        $this->load->library('pagination');

        $configP['base_url'] = site_url($this->moduleName . '/admin/index/');
        $configP['total_rows'] = $this->MMessages->countAllItem();
        $configP['per_page'] = $per_page;
        $configP['uri_segment'] = 4;
        $this->pagination->initialize($configP);

        $data['paging'] = $this->pagination->create_links();

        $data['header'] = $this->moduleDisplayName;
        // This how Bep load views
        $data['page'] = $this->config->item('backendpro_template_admin') . "view";
        $data['module'] = $this->moduleName;
        $this->load->view($this->_container, $data);
    }

    function item($id = NULL) {
        $data['item'] = (is_null($id) ? NULL : $this->MMessages->getItem($id));
        $data['header'] = ($data['item'] ? "View item" : "Invalid item");

        $this->bep_site->set_crumb("View item", $this->moduleName . '/admin/item/' . $id);
        $data['page'] = $this->config->item('backendpro_template_admin') . "item";
        $data['module'] = $this->moduleName;
        $this->load->view($this->_container, $data);
    }

    function form($id = NULL) {
        $this->bep_assets->load_asset_group('MY_JQUERY_UI');
//  		$this->bep_assets->load_asset_group('MY_MCE');
        $this->bep_assets->load_asset_group('MY_TABLE');
        // VALIDATION FIELDS
        $fields['pemdis'] = "File Dis *.pem";
        $fields['pemdev'] = "File Dev *.pem";

        $fields['id'] = "ID";
        $fields['alert'] = "Alert";
        $fields['badge'] = "Badge";
        $fields['sound'] = "Sound";
        $fields['btntext'] = "View button text";
        $fields['url'] = "Url";
        $fields['title'] = "Title";
        $fields['description'] = "Description";

        $this->validation->set_fields($fields);

        // Setup validation rules
        if (is_null($id)) {
            $rules['pemdis'] = "trim|required";
            $rules['pemdev'] = "trim|required";

            $rules['alert'] = "trim";
            $rules['badge'] = "trim|required|numeric";
            $rules['sound'] = "trim";
            $rules['btntext'] = "trim|required";
            $rules['url'] = "trim";
            $rules['title'] = "trim";
            $rules['description'] = "trim";
        } else {
            $rules['pemdis'] = "trim|required";
            $rules['pemdev'] = "trim|required";

            $rules['alert'] = "trim";
            $rules['badge'] = "trim|required|numeric";
            $rules['sound'] = "trim";
            $rules['btntext'] = "trim|required";
            $rules['url'] = "trim";
            $rules['title'] = "trim";
            $rules['description'] = "trim";
        }
        // Setup form default values
        if (!is_null($id) AND !$this->input->post('submit')) {
            // Modify form, first load
            $item = $this->MMessages->getItem($id);

            $this->validation->set_default_value($item);
        } elseif (is_null($id) AND !$this->input->post('submit')) {
            // Create form, first load
// 				$this->validation->set_default_value('badge','0');
//  			$this->validation->set_default_value('sound','file.mid');
            $this->validation->set_default_value('btntext', 'View');
            $this->validation->set_default_value('pemdis', 'Tuber_RealDL_Dis');
            $this->validation->set_default_value('pemdev', 'Tuber_RealDL_Dev');
        } elseif ($this->input->post('submit')) {
            // Form submited, check rules
            $this->validation->set_rules($rules);
        }
        
        
        // RUN
        if ($this->validation->run() === FALSE) {
            $data['pages'] = $this->MMessages->getAllAppName();

            // Display form
            $this->validation->output_errors();
            $data['header'] = ( is_null($id) ? "Create item" : "Edit item");

            $this->bep_site->set_crumb($data['header'], $this->moduleName . '/admin/form/' . $id);
            $data['page'] = $this->config->item('backendpro_template_admin') . "form";
            $data['module'] = $this->moduleName;
            $this->load->view($this->_container, $data);
        } else {
//            require_once(FCPATH . 'modules/apnscode/libraries/dbconnect.php');
//            require_once(FCPATH . 'modules/apnscode/libraries/applepushns.php');

//            $pDB = new DbConnect($this->db->hostname, $this->db->username, $this->db->password, $this->db->database);
//            $pDB->show_errors();

//            $filePemDis = FCPATH . 'modules/apnscode/' . $_POST['pemdis'] . '.pem';
//            $filePemDev = FCPATH . 'modules/apnscode/' . $_POST['pemdev'] . '.pem';

//            $apns = new ApplePushNS($pDB, NULL, $filePemDis, $filePemDev);

            if (FALSE === ($selected2 = $this->input->post('select'))) {
                $data['pages'] = $this->MMessages->getAllAppName();

                flashMsg('warning', 'Please select app(s) to send message');

                $data['header'] = (is_null($id) ? "Create item" : "Edit item");

                $this->bep_site->set_crumb($data['header'], $this->moduleName . '/admin/form/' . $id);
                $data['page'] = $this->config->item('backendpro_template_admin') . "form";
                $data['module'] = $this->moduleName;
                $this->load->view($this->_container, $data);

                return;
            }
//
//            // add message to queue
//            foreach ($selected2 as $appname) {
//                $listClient = $this->MMessages->getAllClientByApp($appname);
//
//                foreach ($listClient as $key => $row) {
//                    $apns->newMessage($row['pid']);
//                    $apns->addMessageAlert($_POST['alert'], $_POST['btntext']);
//
//                    if ($_POST['sound']) {
//                        $apns->addMessageSound($_POST['sound']);
//                    } else {
//                        $apns->addMessageSound('default');
//                    }
//
//                    $apns->addMessageBadge($_POST['badge']);
//                    $apns->addMessageCustom('url', $_POST['url']);
//                    $apns->addMessageCustom('title', $_POST['title']);
//                    $apns->addMessageCustom('description', $_POST['description']);
//                    $apns->queueMessage();
//                }
//            }
//            // SEND ALL MESSAGES NOW
//            $apns->processQueue();
//            flashMsg('success', 'Send messages');
//            redirect($this->moduleName . '/admin/index', 'refresh');
        
            $sender = FCPATH . 'modules/apnscode/libraries/sender.php' . ' ' . escapeshellarg(json_encode($_POST));
            
            exec('nohup php ' . $sender . ' > /var/log/protube.log 2>&1 &');
            
            die;
            
            redirect($this->moduleName . '/admin/index', 'refresh');

            /*
              // Save form
              if( is_null($id))
              {
              // CREATE->SAVE
              $this->db->trans_begin();

              $this->MMessages->addItem();

              if($this->db->trans_status() === TRUE)
              {
              $this->db->trans_commit();
              flashMsg('success', sprintf('Item saved', $_POST['title']));
              }
              else
              {
              $this->db->trans_rollback();
              flashMsg('error', sprintf('Item not saved','Create item'));
              }

              redirect($this->moduleName.'/admin/index');
              }
              else
              {
              // EDIT->UPDATE
              $this->db->trans_begin();
              $this->MMessages->updateItem();

              if($this->db->trans_status() === TRUE)
              {
              $this->db->trans_commit();
              flashMsg('success', sprintf('Item updated', $_POST['title']));
              }
              else
              {
              $this->db->trans_rollback();
              flashMsg('error', sprintf('Item not updated','Edit item'));
              }

              redirect($this->moduleName.'/admin/index');
              }
             */
        }
    }

    function delete($id) {
        if ($this->MMessages->deleteItem($id)) {
            flashMsg('success', 'Item deleted');
        } else {
            flashMsg('error', sprintf('Item not deleted', 'Delete item'));
        }

        redirect($this->moduleName . '/admin/index', 'refresh');
    }

    function dellist() {
        if (FALSE === ($selected = $this->input->post('select'))) {
            flashMsg('warning', 'Please select item(s) to delete');
            redirect($this->moduleName . '/admin/index', 'refresh');
        }

        foreach ($selected as $id) {
            $this->MMessages->deleteItem($id);
        }

        flashMsg('success', 'Selected item(s) deleted');
        redirect($this->moduleName . '/admin/index', 'refresh');
    }

    function changeStatus($id) {
        if ($this->MMessages->changeStatus($id)) {
            flashMsg('success', 'Item status changed');
        } else {
            flashMsg('error', sprintf('Item status not changed', 'Change item status'));
        }

        redirect($this->moduleName . '/admin/index', 'refresh');
    }

}

//end class
?>
