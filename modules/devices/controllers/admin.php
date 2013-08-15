<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends Admin_Controller {

    function Admin() {
        parent::Admin_Controller();
        // Check for access permission
        check('Devices');

        $this->load->helper('form');
        $this->load->library('validation');

        // Load pages model
        $this->load->model('MDevices');

        $this->catType = 0; // Devices
        $this->moduleName = 'devices';
        $this->moduleDisplayName = $this->lang->line('app_devices');

        // Set breadcrumb
        $this->bep_site->set_crumb($this->moduleDisplayName, $this->moduleName . '/admin');
    }

    function index($cat = NULL) {
        $this->bep_assets->load_asset_group('MY_TABLE');
        // we use the following variables in the view
        //$data['title'] = $this->moduleDisplayName;
        $per_page = 100;
        $cat = $_GET['per_page'];
        $data['pages'] = $this->MDevices->getAllItem($per_page, $cat);

        $this->load->library('pagination');

        $configP['base_url'] = site_url($this->moduleName . '/admin/index/');
        $configP['total_rows'] = $this->MDevices->countAllItem();
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
        $data['item'] = (is_null($id) ? NULL : $this->MDevices->getItem($id));
        $data['header'] = ($data['item'] ? "View item" : "Invalid item");

        $this->bep_site->set_crumb("View item", $this->moduleName . '/admin/item/' . $id);
        $data['page'] = $this->config->item('backendpro_template_admin') . "item";
        $data['module'] = $this->moduleName;
        $this->load->view($this->_container, $data);
    }

    function form($id = NULL) {
        $this->bep_assets->load_asset_group('MY_JQUERY_UI');
        $this->bep_assets->load_asset_group('MY_MCE');
        // VALIDATION FIELDS
        $fields['id'] = "ID";
        $fields['clientid'] = "Client ID";
        $fields['appname'] = "App name";
        $fields['appversion'] = "App version";
        $fields['deviceuid'] = "Device UDID";
        $fields['devicetoken'] = "Device token";
        $fields['devicemodel'] = "Device model";
        $fields['deviceversion'] = "Device version";
        $fields['pushbadge'] = "Push badge";
        $fields['pushalert'] = "Push alert";
        $fields['pushsound'] = "Push sound";
        $fields['development'] = "Development";
        $fields['status'] = "Status";
        $this->validation->set_fields($fields);

        // Setup validation rules
        if (is_null($id)) {
            //$rules['clientid'] = "trim|required";
            $rules['appname'] = "trim|required";
            $rules['appversion'] = "trim|required";
            $rules['deviceuid'] = "trim|required";
            $rules['devicetoken'] = "trim|required";
            $rules['devicemodel'] = "trim|required";
            $rules['deviceversion'] = "trim|required";
        } else {
            //$rules['clientid'] = "trim|required";
            $rules['appname'] = "trim|required";
            $rules['appversion'] = "trim|required";
            $rules['deviceuid'] = "trim|required";
            $rules['devicetoken'] = "trim|required";
            $rules['devicemodel'] = "trim|required";
            $rules['deviceversion'] = "trim|required";
        }

        // Setup form default values
        if (!is_null($id) AND !$this->input->post('submit')) {
            // Modify form, first load
            $item = $this->MDevices->getItem($id);

            $this->validation->set_default_value($item);
        } elseif (is_null($id) AND !$this->input->post('submit')) {
            // Create form, first load
        } elseif ($this->input->post('submit')) {
            // Form submited, check rules
            $this->validation->set_rules($rules);
        }

        // RUN
        if ($this->validation->run() === FALSE) {
            // Display form
            $this->validation->output_errors();
            $data['header'] = ( is_null($id) ? "Create item" : "Edit item");

            $this->bep_site->set_crumb($data['header'], $this->moduleName . '/admin/form/' . $id);
            $data['page'] = $this->config->item('backendpro_template_admin') . "form";
            $data['module'] = $this->moduleName;
            $this->load->view($this->_container, $data);
        } else {
            // Save form
            if (is_null($id)) {
                // CREATE->SAVE
                $this->db->trans_begin();

                $this->MDevices->addItem();

                if ($this->db->trans_status() === TRUE) {
                    $this->db->trans_commit();
                    flashMsg('success', sprintf('Item saved', $_POST['title']));
                } else {
                    $this->db->trans_rollback();
                    flashMsg('error', sprintf('Item not saved', 'Create item'));
                }

                redirect($this->moduleName . '/admin/index');
            } else {
                // EDIT->UPDATE
                $this->db->trans_begin();
                $this->MDevices->updateItem();

                if ($this->db->trans_status() === TRUE) {
                    $this->db->trans_commit();
                    flashMsg('success', sprintf('Item updated', 'Edit item'));
                } else {
                    $this->db->trans_rollback();
                    flashMsg('error', sprintf('Item not updated', 'Edit item'));
                }

                redirect($this->moduleName . '/admin/index');
            }
        }
    }

    function delete($id) {
        if ($this->MDevices->deleteItem($id)) {
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
            $this->MDevices->deleteItem($id);
        }

        flashMsg('success', 'Selected item(s) deleted');
        redirect($this->moduleName . '/admin/index', 'refresh');
    }

    function changeStatus($id) {
        if ($this->MDevices->changeStatus($id)) {
            flashMsg('success', 'Item status changed');
        } else {
            flashMsg('error', sprintf('Item status not changed', 'Change item status'));
        }

        redirect($this->moduleName . '/admin/index', 'refresh');
    }

}

//end class
?>