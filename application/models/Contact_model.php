<?php
class Contact_model extends CI_Model
{
    public $id = '';
    public $fullname = '';
    public $email = '';
    public $favorite = '';
    public $image = '';
    public $phone_numbers = array();

    public function __construct()
    {
        $this->load->database();
        $this->load->model('Phone_number_model');
    }

    public function get_contacts($id = FALSE, $favorite = 'no' , $limit = FALSE, $offset = FALSE)
    {
        if($limit){
            $this->db->limit($limit, $offset);
        }
        if ($id === FALSE) {
            if ($favorite == 'yes') {
                $this->db->where('contacts.favorite', 1);
            }
            $query = $this->db->get('contacts');
            return $query->result_array();
        }

        $contact = $this->db->where('contacts.id', $id)
            ->get('contacts')
            ->row();

        $contact->phone_numbers = $this->Phone_number_model->get_phones_for_contacts($id);

        return $contact;
    }

    public function create_contact($image)
    {
        $favorite = ($this->input->post('favorite') == 'on') ? '1' : '';
        $data = array(
            'fullname' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'favorite' => $favorite,
            'image' => $image
        );
        $this->db->insert('contacts', $data);

        $inserted_id = $this->db->insert_id();
        $this->Phone_number_model->insert_phone_numbers($inserted_id);

        return $inserted_id;
    }

    public function update_contact($image)
    {
        $favorite = ($this->input->post('favorite') == 'on') ? '1' : '';
        $id = $this->input->post('id');

        $phone_ids = array_column($this->input->post('phone_label'), 'id');
        //first we remove phone numbers that are deleted in form
        if (!empty($phone_ids)) {
            $this->Phone_number_model->delete_batch_phone_numbers($phone_ids, $id);
        }

        //update contact
        $data = array(
            'fullname' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'favorite' => $favorite,
        );
        if ($image != '') {
            $data['image'] = $image;
        }
        $this->db->where('id', $id);
        $this->db->update('contacts', $data);

        //update and insert phone numbers from form
        $this->Phone_number_model->update_and_add_phone_numbers();
    }

    public function find_by_input($input, $favorite)
    {
        if ($favorite == 'yes') {
            $this->db->where('favorite', '1');
        }
        $this->db->where("(contacts.fullname LIKE '%$input%'")
            ->or_where("contacts.email LIKE '%$input%')");

        $result = $this->db->get('contacts');

        return $result->result_array();
    }

    public function delete_contact($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('contacts');

        $this->db->where('contact_id', $id);
        $this->db->delete('phone_number');

        return true;
    }
}
