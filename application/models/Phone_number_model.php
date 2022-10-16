<?php
class Phone_number_model extends CI_Model
{
    public $id;
    public $contact_id;
    public $phone;
    public $label;
    public function __construct()
    {
        $this->load->database();
    }

    public function insert_phone_numbers($contact_id)
    {
        foreach ($this->input->post('phone_label') as $phone) {
            $data = array(
                'contact_id' => $contact_id,
                'phone' => $phone['phone'],
                'label' => $phone['label']
            );

            $this->db->insert('phone_number', $data);
        }
        return true;
    }

    public function get_phones_for_contacts($id)
    {
        $phone_numbers = $this->db->where('phone_number.contact_id', $id)
            ->get('phone_number')
            ->result();

        return $phone_numbers;
    }

    public function delete_batch_phone_numbers($ids, $contact_id)
    {
        $this->db->where_not_in('id', $ids)
            ->where('contact_id', $contact_id)
            ->delete('phone_number');
        return true;
    }

    public function update_and_add_phone_numbers()
    {
        $phone_numbers = $this->input->post('phone_label');
        $contact_id = $this->input->post('id');
        foreach ($phone_numbers as $phone) {
            if (!empty($phone['phone']) && !empty($phone['label'])) {
                $data = array(
                    'phone' => $phone['phone'],
                    'label' => $phone['label'],
                    'contact_id' => $contact_id
                );
                if (isset($phone['id'])) {
                    $this->db->where('id', $phone['id'])
                        ->update('phone_number', $data);
                } else {
                    $this->db->insert('phone_number', $data);
                }
            }
        }
        return true;
    }
}
