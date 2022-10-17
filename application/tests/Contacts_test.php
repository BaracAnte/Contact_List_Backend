<?php

class Contacts_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'contacts/index');
		$this->assertStringContainsString('<td colspan="5">Name</td>', $output);
	}

	public function test_upload_picture()
	{
		reset_instance();
		$controller = new Contacts();
		$this->CI = &get_instance();
		$result = $controller->upload_picture();
		$this->assertStringContainsString('noimage.jpg', $result);
	}
	public function test_find()
	{
		$output = $this->request(
			'POST',
			'contacts/find',
			['input' => 'a', 'favorite' => 'no']
		);
		$this->assertIsString($output);
	}

	public function test_get_contacts(): void
	{
		$this->resetInstance();
		$this->CI->load->model('Contact_model');
		$this->obj = $this->CI->Contact_model->get_contacts();

		$this->assertIsArray($this->obj);
	}

	public function test_create(): void
	{
		$output = $this->request(
			'POST',
			'contacts/create',
			[
				'fullname' => 'test_name',
				'email' => 'example@gmail.com',
				'favorite' => 'on',
				'image' => 'noimage.jpg',
				'phone_label' => array(
					0 => array(
						'phone' => '123456',
						'label' => 'test label',
					)
				)
			]
		);
		$this->assertRedirect('contacts/index');
	}
	
	public function test_delete()
	{
		$output = $this->ajaxRequest('GET', 'contacts/delete/0');
		$this->assertRedirect('contacts/index');
	}
}
