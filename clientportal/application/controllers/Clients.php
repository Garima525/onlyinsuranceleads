<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Clegginabox\PDFMerger\PDFMerger;

class Clients extends CI_Controller {

    public $data = [];

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation','session']);
        $this->load->helper(['url', 'language']);
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->model('Clients_model');
    }

    /**
     * Redirect if needed, otherwise display the user list
     */
    public function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } else {
            $this->data['title'] = "Clients List";
            $user = $this->ion_auth->user()->row();
            $user_group = $this->ion_auth->get_users_groups($user->id)->row();
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->load->library('pagination');
            $config = $this->config->item('pagination');
            $config["base_url"] = site_url('clients/index');

            if ($this->ion_auth->is_admin()) {
                $this->data['create_client'] = true;
                $config["total_rows"] = $this->Clients_model->getAgreementsCount('admin', $user->id);
                $this->pagination->initialize($config);
                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $this->data["links"] = $this->pagination->create_links();
                $this->data['agreements'] = $this->Clients_model->getAgreements('admin', $user->id, $config['per_page'], $page);
            } elseif ($user_group->name == 'sales') {
                $this->data['create_client'] = true;
                $config["total_rows"] = $this->Clients_model->getAgreementsCount('sales', $user->id);
                $this->pagination->initialize($config);
                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $this->data["links"] = $this->pagination->create_links();
                $this->data['agreements'] = $this->Clients_model->getAgreements('sales', $user->id, $config['per_page'], $page);
            } else {
                $this->data['create_client'] = false;
                $this->data['agreements'] = $this->Clients_model->getAgreements('client', $user->id, 1, 1);
                if ($this->data['agreements']->status == 'pending') {
                    redirect("clients/open_agreement/" . $this->data['agreements']->id, 'refresh');
                } else {
                    redirect("clients/view_agreement/" . $this->data['agreements']->id, 'refresh');
                }
            }
            if($this->session->userdata('payment_message')){
                $this->data['message'] = $this->session->userdata('payment_message');
                $this->session->unset_userdata('payment_message');
            }
            $this->_render_page('clients' . DIRECTORY_SEPARATOR . 'list', $this->data);
        }
    }

    public function home() {

        $user = $this->ion_auth->user()->row();
        $user_group = $this->ion_auth->get_users_groups($user->id)->row();
        if ($user_group->name == 'client') {
            $this->load->model('Rating_model');
            $this->data = [];
            $this->data['agreement'] ='success';
            $this->data['rating'] ='danger';
            $this->data['premium'] ='danger';
            $this->data['ach_payment'] ='danger';
            $this->data['credit_card'] ='danger';
            $permissions = $this->ion_auth->get_client_permissions();
            if($permissions){
                $this->data['permissions'] = $permissions[0];
            }

            ////////////////////////
            //Agreement Code Start//
            ////////////////////////
            $agreement = $this->Clients_model->getAgreementByClientId($user->id);
            if($agreement->status=='pending'){
                $this->data['agreement'] ='danger';
            }
            //////////////////////
            //Agreement Code End//
            //////////////////////

            /////////////////////
            //Rating Code Start//
            /////////////////////
            $ratingRecord = $this->Rating_model->getRatingRecord($this->ion_auth->user()->row()->id);
            if ($ratingRecord) {
                $this->data['rating'] ='success';
            }
            ///////////////////
            //Rating Code End//
            ///////////////////

            /////////////////////
            //Rating Code Start//
            /////////////////////
            $data = $this->Rating_model->getPremiumsRecords($user->id);
            if ($data) {
                $this->data['premium'] ='success';
            }
            ///////////////////
            //Rating Code End//
            ///////////////////

            ///////////////////////////
            //Payment Info Code Start//
            ///////////////////////////
            $payment_info = $this->Clients_model->getPaymentRecord($user->id);
            if($payment_info){
                foreach ($payment_info as $rec) {
                    if($rec->payment_type=='cc'){
                        $this->data['credit_card'] ='success';
                    }else{
                        $this->data['ach_payment'] ='success';
                    }
                }
            }
            /////////////////////////
            //Payment Info Code End//
            /////////////////////////

            $this->data['title'] = "Client Home";
            $this->_render_page('clients' . DIRECTORY_SEPARATOR . 'home', $this->data);
        } else {
            show_error('You are not authorize to view this page.');
        }
    }

    /**
     * Create a new user
     */
    public function create_client() {
        $user = $this->ion_auth->user()->row();
        $user_group = $this->ion_auth->get_users_groups($user->id)->row();
        if ($user_group->name == 'client') {
            show_error('You are not authorize to view this page.');
        }
        $this->data['title'] = "Create New Client";

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;
        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'trim|required');
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

//		if ($this->form_validation->run() === TRUE) {
//			$data = [
//				'first_name' => $this->input->post('first_name'),
//				'last_name' => $this->input->post('last_name'),
//				'agreement' => $this->input->post('agreement'),
//				'custom_agreement' => $this->input->post('custom_agreement'),
//				'created_by' => $this->ion_auth->user()->row()->id,
//			];
//		}
//		if ($this->form_validation->run() === TRUE && $this->Clients_model->create_task($data)) {
//			$this->session->set_flashdata('message', 'Agreement has been saved');
//			redirect("clients", 'refresh');
        if ($this->form_validation->run() === TRUE) {
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');
            $additional_data = [
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'created_by' => $this->ion_auth->user()->row()->id,
            ];
            $groups = array(4);
            $user = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);
            if ($user) {
                $image_name = null;
                if ($_FILES['art_work']['name']) {
                    $config['upload_path'] = './assets/artwork/';
                    $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                    $art_work_name = explode(".", $_FILES['art_work']['name']);
                    $ext = end($art_work_name);
                    $image_name = time() . '-' . $user . '-' . $this->ion_auth->user()->row()->id . '-' . 'artwork.' . $ext;
                    $config['file_name'] = $image_name;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    $this->upload->do_upload('art_work');
                }
//                if ($this->upload->do_upload('art_work')) {
                $agreement = [
                    'client_id' => $user,
                    'agreement' => $this->input->post('agreement'),
                    'custom_agreement' => $this->input->post('custom_agreement'),
                    'art_work' => $image_name,
                    'reservation_form' => $this->input->post('reservation_form') ? 1 : 0,
                    'created_by' => $this->ion_auth->user()->row()->id,
                ];
                if ($this->Clients_model->create_agreement($agreement)) {
                    $permissions = [];
                    $permissions['user_id'] = $user;
                    $permissions['rating'] = $permissions['premium'] = $permissions['ach_bank'] = $permissions['credit_card'] = 0;
                    if($this->input->post('rating_form')){
                        $permissions['rating'] = 1;
                    }
                    if($this->input->post('premium_form')){
                        $permissions['premium'] = 1;
                    }
                    if($this->input->post('ach_form')){
                        $permissions['ach_bank'] = 1;
                    }
                    if($this->input->post('cc_form')){
                        $permissions['credit_card'] = 1;
                    }
                    $this->Clients_model->add_client_permissions($permissions);
                    $this->load->library('email');
                    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = SMTP_HOST;
                    $config['smtp_port'] = SMTP_PORT;
                    $config['smtp_timeout'] = '7';
                    $config['smtp_user'] = SMTP_USER;
                    $config['smtp_pass'] = SMTP_PASS;
                    $config['charset'] = 'utf-8';
                    $config['newline'] = "\r\n";
                    $config['mailtype'] = 'html'; // or html
                    $config['validation'] = TRUE; // bool whether to validate email or not
                    $this->email->initialize($config);
                    $this->email->from(SMTP_FROM, ORGANIZATION_NAME);
                    $this->email->to($email);
                    $this->email->subject('Agreement from ' . ORGANIZATION_NAME);
                    $data = array(
                        'full_name' => $additional_data['first_name'] . ' ' . $additional_data['last_name'],
                        'email' => $email,
                        'password' => $password
                    );
                    $this->email->message($this->load->view('auth/email/client_agreement', $data, true));
                    $this->email->send();
                    $this->session->set_flashdata('message', 'Client created successfully');
                    redirect("clients", 'refresh');
                } else {
                    $this->ion_auth->delete_user($user);
                    $file = $_SERVER['DOCUMENT_ROOT'] . "/clientportal/assets/artwork/" . $image_name;
                    if (file_exists($file)) {
                        unlink($file);
                    }
                    $this->session->set_flashdata('message', 'An error occurred on agreement creation');
                    redirect("clients/create_client", 'refresh');
                }
//                } else {
//                    $this->ion_auth->delete_user($user);
//                    $this->session->set_flashdata('message', 'An error occurred on art work uploading');
//                    redirect("clients/create_client", 'refresh');
//                }
            } else {
                $this->ion_auth->delete_user($user);
                $this->session->set_flashdata('message', 'An error occurred on client creation');
                redirect("clients/create_client", 'refresh');
            }
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $this->data['first_name'] = [
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('first_name'),
            ];
            $this->data['last_name'] = [
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('last_name'),
            ];
            $this->data['identity'] = [
                'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('identity'),
            ];
            $this->data['email'] = [
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('email'),
            ];
            $this->data['password'] = [
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('password'),
            ];
            $this->data['password_confirm'] = [
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('password_confirm'),
            ];
            $this->data['agreement'] = [
                'name' => 'agreement',
                'id' => 'agreement',
                'class' => 'form-control',
                'type' => 'hidden',
                'readonly' => true,
                'value' => $this->form_validation->set_value('agreement')
            ];
            $this->data['custom_agreement'] = [
                'name' => 'custom_agreement',
                'id' => 'custom_agreement',
                'class' => 'form-control',
                'type' => 'textarea',
                'value' => $this->form_validation->set_value('custom_agreement')
            ];
            $this->data['art_work'] = [
                'name' => 'art_work',
                'id' => 'art_work',
                'class' => 'form-control',
                'type' => 'file',
                'value' => $this->form_validation->set_value('art_work')
            ];
            $this->_render_page('clients' . DIRECTORY_SEPARATOR . 'create_client', $this->data);
        }
    }

    public function open_agreement($id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } else {
            $this->data['title'] = "Agreement";
            $user = $this->ion_auth->user()->row();
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $agreement = $this->Clients_model->getAgreement($id);
            if ($agreement) {
                if ($user->id == $agreement->client_id) {
                    $this->data['agreement'] = $agreement;
                    $this->_render_page('clients' . DIRECTORY_SEPARATOR . 'open_agreement', $this->data);
                } else {
                    redirect("clients", 'refresh');
                }
            } else {
                redirect("clients", 'refresh');
            }
        }
    }

    public function view_agreement($id) {
        $this->data['title'] = "Agreement";
        $agreement = $this->Clients_model->getAgreement($id);
        $this->data['message'] = '';
        if ($agreement) {
            $client_info = $this->Clients_model->getClientinfo($agreement->client_id);
            $this->data['agreement'] = $agreement;
            $this->data['client_info'] = $client_info;
            $this->_render_page('clients' . DIRECTORY_SEPARATOR . 'open_agreement', $this->data);
        } else {
            redirect("clients", 'refresh');
        }
    }

    public function view_rating($id) {
        $this->load->model('Rating_model');
        $this->data['title'] = "Client Rating";
        $data = $this->Rating_model->getRating($id);
        if ($data) {
            $data['hsf'] = [1000, 1500, 1750, 2000, 2250, 2500, 3500, 5500, 7500, 8500, 10000];
            if ($data['rating']) {
                $dwelling_cost_array = ['Dwelling ($ x per sq)', $data['rating']->dwelling_cost];
                $separate_structure_per_array = ['Separate Structure', $data['rating']->separate_structure_per . '%'];
                $personal_property_per_array = ['Personal Property', $data['rating']->personal_property_per . '%'];
                $loss_of_use_per_array = ['Loss of Use', $data['rating']->loss_of_use . '%'];
                foreach ($data['hsf'] as $key => $value) {
                    $dwelling_cost_array[$key + 2] = $data['rating']->dwelling_cost * $value;
                    $separate_structure_per_array[$key + 2] = ($data['rating']->separate_structure_per * $dwelling_cost_array[$key + 2]) / 100;
                    $personal_property_per_array[$key + 2] = ($data['rating']->personal_property_per * $dwelling_cost_array[$key + 2]) / 100;
                    $loss_of_use_per_array[$key + 2] = ($data['rating']->loss_of_use * $dwelling_cost_array[$key + 2]) / 100;

                }
                $data['rating']->dwelling_cost = $dwelling_cost_array;
                $data['rating']->separate_structure_per = $separate_structure_per_array;
                $data['rating']->personal_property_per = $personal_property_per_array;
                $data['rating']->loss_of_use = $loss_of_use_per_array;

            }
            if ($data['premiums']) {
                foreach ($data['premiums'] as $key => $value) {
                    $data['premiums'][$value->year] = $data['premiums'][$key];
                    unset($data['premiums'][$key]);
                }
            }
            $this->data['message'] = '';
            $this->data['rating'] = $data;
            $this->data['client'] = $this->ion_auth->user($id)->row();
            $this->_render_page('clients' . DIRECTORY_SEPARATOR . 'open_rating', $this->data);
        } else {
            redirect("clients", 'refresh');
        }
    }

    public function view_payment_info($client_id) {
        $this->data['title'] = "Payment Info";
        $payment_info = $this->Clients_model->getPaymentRecord($client_id);
        $this->data['message'] = '';
        if ($payment_info) {
            $this->data['payment_info'] = $payment_info;
            $this->_render_page('clients' . DIRECTORY_SEPARATOR . 'payment_info', $this->data);
        } else {
            $this->data['message'] = 'Have not added any Payment Info yet';
            $this->session->set_userdata(['payment_message'=>'Have not added any Info yet']);
            redirect("clients", 'refresh');
        }
    }

    public function export_paymentInfo($client_id) {
        $client = $this->ion_auth->user($client_id)->row();
        $payment_info = $this->Clients_model->getPaymentRecord($client_id);
        $this->data['message'] = '';
        $html = '';
        if ($payment_info) {
            $this->data['payment_info'] = $payment_info;
            $html = $this->load->view('clients/export_payment_info', $this->data, true);
        } else {
            redirect("clients", 'refresh');
        }
        $this->load->library('pdfgenerator');
        $this->pdfgenerator->generate($html, $client->email . '-payment-info.pdf', true);
    }

    public function export_agreement($client_id) {
        $client = $this->ion_auth->user($client_id)->row();
        $html = '';
        $agreement = $this->Clients_model->getAgreementByClientId($client_id);
        if ($agreement) {
            $this->data['agreement'] = $agreement;
            $this->data['client'] = $client;
            $this->data['client_info'] = $this->Clients_model->getClientinfo($agreement->client_id);
            $html = $this->load->view('clients/export_agreement', $this->data, true);
        } else {
            redirect("clients", 'refresh');
        }
        $this->load->library('pdfgenerator');
        $temp_path = getcwd() . '/assets/temp/';
        $artwork_path = getcwd() . '/assets/artwork/';
//        $this->pdfgenerator->generate($html, $client->email . '-agreement', true);
        $temp_pdf = $this->pdfgenerator->generate($html, $client->email . '-agreement', false);
        $temp_file_name = time() . '-' . $agreement->client_id . '.pdf';
//        file_put_contents('/home/algolix/projects/insuranceleads/admin/assets/temp/' . $temp_file_name, $temp_pdf);
        file_put_contents($temp_path . $temp_file_name, $temp_pdf);
        $pdf = new PDFMerger();
        $pdf->addPDF($temp_path . $temp_file_name, 'all');
//        $pdf->addPDF('/home/algolix/projects/insuranceleads/admin/assets/temp/' . $temp_file_name, 'all');
        $artwork_file_name_array = explode('.', $agreement->art_work);
        if (strtolower(end($artwork_file_name_array)) == 'pdf'){
//            $pdf->addPDF('/home/algolix/projects/insuranceleads/admin/assets/artwork/' . $agreement->art_work, 'all');
            $pdf->addPDF($artwork_path . $agreement->art_work, 'all');
        }
        $pdf->merge('download', $client->email . '-agreement.pdf');
        unlink($temp_path . $temp_file_name);
    }

    public function export_rating($client_id) {
        $this->load->model('Rating_model');
        $data = $this->Rating_model->getRating($client_id);
        $client = $this->ion_auth->user($client_id)->row();
        header('Content-type: text/csv');
        header('Content-Disposition: attachment; filename="' . $client->first_name . '-rating.csv"');
        // do not cache the file
        header('Pragma: no-cache');
        header('Expires: 0');
        // create a file pointer connected to the output stream
        $file = fopen('php://output', 'w');
        $exportData[0] = ['Client Rating'];
        $exportData[1] = ['name', "'" . $client->first_name . " " . $client->last_name . "'"];
        $exportData[2] = ['email', "'" . $client->email . "'"];
        $exportData[3] = ['Foundation Matrix'];
        $exportData[4] = ['Step 1'];
        if ($data) {
            $data['hsf'] = [1000, 1500, 1750, 2000, 2250, 2500, 3500, 5500, 7500, 8500, 10000];
            if ($data['rating']) {
                $dwelling_cost_array = ['Dwelling ($ x per sq)', $data['rating']->dwelling_cost];
                $separate_structure_per_array = ['Separate Structure', $data['rating']->separate_structure_per . '%'];
                $personal_property_per_array = ['Personal Property', $data['rating']->personal_property_per . '%'];
                $loss_of_use_per_array = ['Loss 0f Use', $data['rating']->loss_of_use . '%'];

                foreach ($data['hsf'] as $key => $value) {
                    $dwelling_cost_array[$key + 2] = $data['rating']->dwelling_cost * $value;
                    $separate_structure_per_array[$key + 2] = ($data['rating']->separate_structure_per * $dwelling_cost_array[$key + 2]) / 100;
                    $personal_property_per_array[$key + 2] = ($data['rating']->personal_property_per * $dwelling_cost_array[$key + 2]) / 100;
                    $loss_of_use_per_array[$key + 2] = ($data['rating']->loss_of_use * $dwelling_cost_array[$key + 2]) / 100;

                }
                $data['rating']->dwelling_cost = $dwelling_cost_array;
                $data['rating']->separate_structure_per = $separate_structure_per_array;
                $data['rating']->personal_property_per = $personal_property_per_array;
                $data['rating']->loss_of_use = $loss_of_use_per_array;

                $exportData[5] = $data['rating']->dwelling_cost;
                $exportData[6] = $data['rating']->separate_structure_per;
                $exportData[7] = $data['rating']->personal_property_per;
                $exportData[8] = $data['rating']->loss_of_use;
            }
            $exportData[9] = ['Liability', '', '$ 300,000', '$ 300,000', '$ 300,000', '$ 300,000', '$ 300,000', '$ 300,000', '$ 300,000', '$ 300,000', '$ 300,000', '$ 300,000', '$ 300,000'];
            $exportData[10] = ["Home's Square Feet", '', 1000, 1500, 1750, 2000, 2250, 2500, 3500, 5500, 7500, 8500, 10000];
            $exportData[11] = ["STEP 2", ' Enter Estimated Premiums Per Year Built Below'];
            $indexKey = 12;
            if ($data['premiums']) {
                foreach ($data['premiums'] as $key => $value) {
                    $exportData[$indexKey] = ['Built in ' . $value->year, '', $value->sq_ft_1000, $value->sq_ft_1500, $value->sq_ft_1750, $value->sq_ft_2000, $value->sq_ft_2250, $value->sq_ft_2500, $value->sq_ft_3500, $value->sq_ft_5500, $value->sq_ft_7500, $value->sq_ft_8500, $value->sq_ft_10000];
                    //$data['premiums'][$value->year] = $data['premiums'][$key];
                    //unset($data['premiums'][$key]);
                    $indexKey++;
                }
            }
            foreach ($exportData as $key => $value) {
                fputcsv($file, $value);
            }
        }
        exit;
    }

    public function update_agreement() {
        $agreement_id = $this->input->post('agreement_id');
        $agreement_record = $this->Clients_model->getAgreement($agreement_id);
        $agreement_creator = $this->ion_auth->user($agreement_record->created_by)->row();
        $data = array();
        if ($this->input->post('Decline')) {
            $data['status'] = 'decline';
        } else {
            $data['signature'] = $this->input->post('signatureImage');
            $data['status'] = 'approve';
        }
        $client_info['client_id'] = $this->input->post('client_id');
        $client_info['address'] = $this->input->post('address');
        $client_info['city'] = $this->input->post('city');
        $client_info['state'] = $this->input->post('state');
        $client_info['zip_code'] = implode(',', $this->input->post('zip_code'));
        $client_info['created_at'] = time();
        $this->Clients_model->addClientInfo($client_info);
        $agreement = $this->Clients_model->updateAgreementStatus($agreement_id, $data);
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = SMTP_USER;
        $config['smtp_pass'] = SMTP_PASS;
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not
        $this->email->initialize($config);
        $this->email->from(SMTP_FROM, ORGANIZATION_NAME);
        $this->email->to($agreement_creator->email);
       // $this->email->to('hafiz.bilalahmadgondal@gmail.com');
        $this->email->subject('Agreement from ' . ORGANIZATION_NAME);
        $email_data = [];
        $email_data['status'] = $data['status'];
        $email_data['client_name'] = trim($agreement_record->first_name).' '.trim($agreement_record->last_name);

        $this->email->message($this->load->view('auth/email/agreement_update', $email_data, true));
        $this->email->send();
        if ($agreement) {
            $this->session->set_flashdata('message', 'Agreements has been ' . $data['status']);
            redirect("clients/view_agreement/" . $agreement_id, 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Agreements has been ' . $data['status']);
            redirect("clients/open_agreement/" . $agreement_id, 'refresh');
        }
    }

    public function credit_card_payment() {
        $user = $this->ion_auth->user()->row();
        $user_group = $this->ion_auth->get_users_groups($user->id)->row();
        if ($user_group->name != 'client') {
            show_error('You are not authorize to view this page.');
        }
        $this->data['title'] = "Credit Card Payment";
        $this->data['message'] = null;
        if ($this->input->post()) {
            $this->form_validation->set_rules('name_on_card', '', 'trim|required');
            $this->form_validation->set_rules('credit_card_number', '', 'trim|required|numeric');
            $this->form_validation->set_rules('expiry_date', '', 'trim|required');
            $this->form_validation->set_rules('cvv_code', '', 'trim|required');
            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'client_id' => $user->id,
                    'payment_type' => 'cc',
                    'name_on_card' => $this->input->post('name_on_card'),
                    'card_number' => $this->input->post('credit_card_number'),
                    'card_expiry' => $this->input->post('expiry_date'),
                    'card_cvv' => $this->input->post('cvv_code'),
                    'email_for_accout' => $this->input->post('account_email'),
                    'signature ' => $this->input->post('signatureImage')
                ];
                if ($this->input->post('account_detail_id')) {
                    $data['updated_at'] = time();
                    if ($this->Clients_model->updateClientDetail($data, $this->input->post('account_detail_id'))) {
                        $this->data['message'] = 'Detail has been updated.';
                    }
                } else {
                    $data['created_at'] = time();
                    if ($this->Clients_model->saveClientDetail($data)) {
                        $this->data['message'] = 'Detail has been saved.';
                    }
                }
            } else {
                $this->data['message'] = (validation_errors() ? validation_errors() : 'Credit Card Payment information could not be saved, Please try again.');
                $this->data['name_on_card'] = $this->form_validation->set_value('name_on_card');
                $this->data['credit_card_number'] = $this->form_validation->set_value('credit_card_number');
                $this->data['expiry_date'] = $this->form_validation->set_value('expiry_date');
                $this->data['cvv_code'] = $this->form_validation->set_value('cvv_code');
                $this->data['account_email'] = $this->form_validation->set_value('account_email');
                $this->_render_page('clients' . DIRECTORY_SEPARATOR . 'credit_card_payment', $this->data);
            }
        }
        $accountDeatil = $this->Clients_model->getAccountRecord($user->id, 'cc');
        if ($accountDeatil) {
            $this->data['account_detail_id'] = $accountDeatil->id;
            $this->data['name_on_card'] = $accountDeatil->name_on_card;
            $this->data['credit_card_number'] = $accountDeatil->card_number;
            $this->data['expiry_date'] = $accountDeatil->card_expiry;
            $this->data['cvv_code'] = $accountDeatil->card_cvv;
            $this->data['account_email'] = $accountDeatil->email_for_accout;
            $this->data['signature'] = $accountDeatil->signature;
        }
        $this->_render_page('clients' . DIRECTORY_SEPARATOR . 'credit_card_payment', $this->data);
    }

    public function ach_payment() {
        $user = $this->ion_auth->user()->row();
        $user_group = $this->ion_auth->get_users_groups($user->id)->row();
        if ($user_group->name != 'client') {
            show_error('You are not authorize to view this page.');
        }
        $this->data['title'] = "ACH Payment";
        $this->data['message'] = null;
        if ($this->input->post()) {
            $this->form_validation->set_rules('financial_institution', '', 'trim|required');
            $this->form_validation->set_rules('routing_number', '', 'trim|required');
            $this->form_validation->set_rules('account_number', '', 'trim|required');
            if ($this->form_validation->run() === TRUE) {

                $image_name = null;
                if ($_FILES['cheque_file']['name']) {
                    $config['upload_path'] = './assets/payment/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $cheque_file_name = explode(".", $_FILES['cheque_file']['name']);
                    $ext = end($cheque_file_name);
                    $image_name = time() . '-' . $user->first_name . '-' . $user->last_name . '-' . $user->id . '-' . 'ach-payment.' . $ext;
                    $config['file_name'] = $image_name;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    $this->upload->do_upload('cheque_file');
                }

                $data = [
                    'client_id' => $user->id,
                    'payment_type' => 'ach',
                    'financial_institution' => $this->input->post('financial_institution'),
                    'routing_number' => $this->input->post('routing_number'),
                    'account_number' => $this->input->post('account_number'),
                    'cheque_image' => $image_name,
                    'signature ' => $this->input->post('signatureImage')
                ];
                if ($this->input->post('account_detail_id')) {
                    $data['updated_at'] = time();
                    if ($this->Clients_model->updateClientDetail($data, $this->input->post('account_detail_id'))) {
                        $this->data['message'] = 'Detail has been updated.';
                    }
                } else {
                    $data['created_at'] = time();
                    if ($this->Clients_model->saveClientDetail($data)) {
                        $this->data['message'] = 'Detail has been saved.';
                    }
                }
            } else {
                $this->data['message'] = (validation_errors() ? validation_errors() : 'Rating could not be saved, Please try again.');
                $this->data['financial_institution'] = $this->form_validation->set_value('financial_institution');
                $this->data['routing_number'] = $this->form_validation->set_value('routing_number');
                $this->data['account_number'] = $this->form_validation->set_value('account_number');
                $this->_render_page('clients' . DIRECTORY_SEPARATOR . 'ach_payment', $this->data);
            }
        }
        $accountDeatil = $this->Clients_model->getAccountRecord($user->id, 'ach');
        if ($accountDeatil) {
            $this->data['account_detail_id'] = $accountDeatil->id;
            $this->data['financial_institution'] = $accountDeatil->financial_institution;
            $this->data['routing_number'] = $accountDeatil->routing_number;
            $this->data['account_number'] = $accountDeatil->account_number;
            $this->data['cheque_image'] = $accountDeatil->cheque_image;
            $this->data['signature'] = $accountDeatil->signature;
        }
        $this->_render_page('clients' . DIRECTORY_SEPARATOR . 'ach_payment', $this->data);
    }

    public function getClientLogOutPermission($client_id) {
        $this->load->model('Clients_model');
        $this->load->model('Rating_model');
        $check = true;
        $data = array();
        $agreement = $this->Clients_model->getAgreementByClientId($client_id);
        if ($agreement->status == 'pending') {
            $check = false;
            $data = array(
                'modal' => true,
                'msg' => 'Agreement is not signed yet. Are you sure to want to logout?',
                'url' => site_url(),
                'btnTxt' => 'Agreement Form'
            );
        }
        if (!$this->Clients_model->getAccountRecord($client_id) && $check) {
            $check = false;
            $data = array(
                'modal' => true,
                'msg' => 'Account Detail is missing. Are you sure to want to logout?',
                'url' => site_url('clients/account'),
                'btnTxt' => 'Account Details Form'
            );
        }
        if (!$this->Rating_model->getRatingRecord($client_id) && $check) {
            $check = false;
            $data = array(
                'modal' => true,
                'msg' => 'Rating form is missing. Are you sure to want to logout?',
                'url' => site_url('rating'),
                'btnTxt' => 'Rating Form'
            );
        }
        if ($check) {
            $data = array(
                'modal' => false
            );
        }
        echo json_encode($data);
    }

    public function delete_client($client_id) {
        $user = $this->ion_auth->user()->row();
        $user_group = $this->ion_auth->get_users_groups($user->id)->row();
        if ($user_group->name == 'client') {
            $this->session->set_flashdata('message', 'You are not authorize to perform this action');
            redirect(site_url(), 'refresh');
        }
        $client = $this->ion_auth->user($client_id)->row();
        if ($client) {
            if ($user_group->name == 'admin' || $user->id == $client->created_by) {
                $is_deleted = $this->Clients_model->delete_client($client);
                if ($is_deleted) {
                    $this->session->set_flashdata('message', "Requested client has been deleted.");
                    redirect("clients", 'refresh');
                } else {
                    $this->session->set_flashdata('message', "Requested client can't deleted. Please try again");
                    redirect("clients", 'refresh');
                }
            } else {
                $this->session->set_flashdata('message', 'You are not authorize to perform this action');
                redirect("clients", 'refresh');
            }
        } else {
            $this->session->set_flashdata('message', "Requested client doesn't exist.");
            redirect("clients", 'refresh');
        }
    }

    /**
     * @return array A CSRF key-value pair
     */
    public function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return [$key => $value];
    }

    /**
     * @return bool Whether the posted CSRF token matches
     */
    public function _valid_csrf_nonce() {
        $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
        if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @param string $view
     * @param array|null $data
     * @param bool $returnhtml
     *
     * @return mixed
     */
    public function _render_page($view, $data = NULL, $returnhtml = FALSE) {//I think this makes more sense
        $viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $viewdata, $returnhtml);

        // This will return html on 3rd argument being true
        if ($returnhtml) {
            return $view_html;
        }
    }
}
