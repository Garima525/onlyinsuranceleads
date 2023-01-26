<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rating extends CI_Controller {

    public $data = [];

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['url', 'language']);
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user = $this->ion_auth->user()->row();
        $user_group = $this->ion_auth->get_users_groups($user->id)->row();
        if ($user_group->name != 'client') {
            redirect(site_url(), 'refresh');
        }
        $this->load->model('Rating_model');
    }

    /**
     * Redirect if needed, otherwise display the user list
     */
    public function index() {
        $this->data['title'] = "Rating";
        $this->data['message'] = null;
        if ($this->input->post()) {
            //$this->form_validation->set_rules('rating_id', '', 'trim|required|numeric');
            $this->form_validation->set_rules('deductible', '', 'trim|required|numeric');
            $this->form_validation->set_rules('dwelling_cost', '', 'trim|required|numeric');
            $this->form_validation->set_rules('separate_structure_per', '', 'trim|required|numeric');
            $this->form_validation->set_rules('personal_property_per', '', 'trim|required|numeric');
            $this->form_validation->set_rules('loss_of_use', '', 'trim');
            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'client_id' => $this->ion_auth->user()->row()->id,
                    'deductible' => $this->input->post('deductible'),
                    'dwelling_cost' => $this->input->post('dwelling_cost'),
                    'separate_structure_per' => $this->input->post('separate_structure_per'),
                    'personal_property_per' => $this->input->post('personal_property_per'),
                    'loss_of_use' => $this->input->post('loss_of_use')
                ];
                if ($this->input->post('rating_id')) {
                    $data['updated_at'] = time();
                    if ($this->Rating_model->updateRating($data, $this->input->post('rating_id'))) {
                        $this->data['message'] = 'Rating values has been updated.';
                    }
                } else {
                    $data['created_at'] = time();
                    if ($this->Rating_model->saveRating($data)) {
                        $this->data['message'] = 'Rating values has been saved.';
                    }
                }
            } else {
                $this->data['message'] = (validation_errors() ? validation_errors() : 'Rating could not be saved, Please try again.');
                $this->data['rating_id'] = $this->form_validation->set_value('rating_id');
                $this->data['deductible'] = $this->form_validation->set_value('deductible');
                $this->data['dwelling_cost'] = $this->form_validation->set_value('dwelling_cost');
                $this->data['separate_structure_per'] = $this->form_validation->set_value('separate_structure_per');
                $this->data['personal_property_per'] = $this->form_validation->set_value('personal_property_per');
                $this->data['loss_of_use'] = $this->form_validation->set_value('loss_of_use');
                $this->_render_page('rating' . DIRECTORY_SEPARATOR . 'index', $this->data);
            }
        }
        $ratingRecord = $this->Rating_model->getRatingRecord($this->ion_auth->user()->row()->id);
        if ($ratingRecord) {
            $this->data['rating_id'] = $ratingRecord->id;
            $this->data['deductible'] = $ratingRecord->deductible;
            $this->data['dwelling_cost'] = $ratingRecord->dwelling_cost;
            $this->data['separate_structure_per'] = $ratingRecord->separate_structure_per;
            $this->data['personal_property_per'] = $ratingRecord->personal_property_per;
            $this->data['loss_of_use'] = $ratingRecord->loss_of_use;
        }
        $this->_render_page('rating' . DIRECTORY_SEPARATOR . 'index', $this->data);
    }

    public function premium() {
        $client_id = $this->ion_auth->user()->row()->id;
        $data = $this->Rating_model->getPremiumsRecords($client_id);
        if ($data) {
            foreach ($data as $key => $value) {
                $data[$value->year] = $data[$key];
                $this->data['years'][] = $value->year;
                unset($data[$key]);
            }
            $this->data['update'] = true;
        } else {
            $this->data['years'][] = date('Y', strtotime('-1 years'));
            $this->data['years'][] = '2010';
            $this->data['years'][] = '2000';
            $this->data['years'][] = '1990';
            $this->data['years'][] = '1975';
            $this->data['years'][] = '1945';
            // $this->data['years'][] = date('Y', strtotime('-10 years'));
            // $this->data['years'][] = date('Y', strtotime('-20 years'));
            // $this->data['years'][] = date('Y', strtotime('-30 years'));
            // $this->data['years'][] = date('Y', strtotime('-45 years'));
            // $this->data['years'][] = date('Y', strtotime('-75 years'));
        }
        $this->data['title'] = "Estimated Premiums Per Year";
        $this->data['lengths'] = array(
            'sq_ft_1000' => '1000 sq ft',
            'sq_ft_1500' => '1,500 sq ft',
            'sq_ft_1750' => '1,750 sq ft',
            'sq_ft_2000' => '2,000 sq ft',
            'sq_ft_2250' => '2,250 sq ft',
            'sq_ft_2500' => '2,500 sq ft',
            'sq_ft_3500' => '3,500 sq ft',
            'sq_ft_5500' => '5,500 sq ft',
            'sq_ft_7500' => '7,500 sq ft',
            'sq_ft_8500' => '8,500 sq ft',
            'sq_ft_10000' => '10,000 sq ft'
            );
        $this->data['records'] = $data;
        $this->_render_page('rating' . DIRECTORY_SEPARATOR . 'premium', $this->data);
    }

    public function save_premium() {
        $client_id = $this->ion_auth->user()->row()->id;
        foreach ($this->input->post() as $key => $value) {
            $data = array(
                'client_id' => $client_id,
                'year' => explode('-', $key)[1],
                'sq_ft_1000' => $value[0],
                'sq_ft_1500' => $value[1],
                'sq_ft_1750' => $value[2],
                'sq_ft_2000' => $value[3],
                'sq_ft_2250' => $value[4],
                'sq_ft_2500' => $value[5],
                'sq_ft_3500' => $value[6],
                'sq_ft_5500' => $value[7],
                'sq_ft_7500' => $value[8],
                'sq_ft_8500' => $value[9],
                'sq_ft_10000' => $value[10],
            );
            $this->Rating_model->savePremiumEntry($data);
        }
        redirect('rating/premium', 'refresh');
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
