<?php
class Contacts extends CI_Controller
{
    public function index()
    {
        $data['contacts'] = $this->contact_model->get_contacts(FALSE);
        $data['favorite'] = 'no';

        $this->load->view('contacts/index', $data);
    }

    public function add_edit($id = false)
    {       
        if (!$id) {
            $data['contact'] = new $this->contact_model();
            $data['function'] = 'create';
        } else {
            $data['contact'] = $this->contact_model->get_contacts($id);
            $data['function'] = 'edit';
        }
        $this->load->view('contacts/create', $data);
    }

    public function edit()
    {
        $image = '';
        $this->form_validation->set_rules('fullname', 'Full name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() === FALSE) {
            $data['contact'] = new $this->contact_model();
            $this->load->view('contacts/create', $data);
        } else {
            if ($_FILES['userfile']['name'] != "") {
                $image = $this->upload_picture();
            }
            $this->contact_model->update_contact($image);

            redirect('/contacts/index');
        }
    }

    public function create()
    {
        $this->form_validation->set_rules('fullname', 'Full name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() === FALSE) {
            $data['contact'] = new $this->contact_model();
            $data['function'] = 'create';
            $this->load->view('contacts/create', $data);
        } else {
            $image = $this->upload_picture();
            $this->contact_model->create_contact($image);
            redirect('/contacts/index');
        }
    }

    public function favorites()
    {
        $data['contacts'] = $this->contact_model->get_contacts(FALSE, 'yes');
        $data['favorite'] = 'yes';

        $this->load->view('contacts/index', $data);
    }

    public function find()
    {
        $input = $this->input->post('input');
        $favorite = $this->input->post('favorite');

        $contacts = $this->contact_model->find_by_input($input, $favorite);

        echo json_encode($contacts);
    }

    public function delete($id)
    {
        $this->contact_model->delete_contact($id);

        redirect('/contacts/index');
    }

    public function upload_picture()
    {
        // Upload Image
        $config['upload_path'] = './assets/images';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $errors = array('error' => $this->upload->display_errors());
            $image = 'noimage.jpg';
        } else {
            $data = array('upload_data' => $this->upload->data());
            $image = $data['upload_data']['file_name'];
        }
        return $image;
    }
}
