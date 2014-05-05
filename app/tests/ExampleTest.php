<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	// **** login tests ****
// Check the title in the HTML on login page.
public function testLogin() {
    $response = $this->client->request('GET', 'users/login');
    $this->assertTrue($this->client->getResponse()->isOk());
    $this->assertCount(1, $response->filter('a:contains("Login")'));
    $this->assertCount(1, $response->filter('a:contains("Register")'));
}
// Check an invalid login request.
public function testInValidLogin() {
    $response = $this->action('POST', 'UsersController@post_login',
        array('email' => 'jbrown@home.com', 'password'=>'$passwordA'));
    $this->assertRedirectedToAction('UsersController@get_login');

}
// Secure access with proper role.
public function testValidout() {
    $this->be(User::find(1));  // Simulate logged in user with id = 1
    $response = $this->client->request('GET', 'users/secure');
    $this->assertCount(1, $response->filter('a:contains("Logout")'));
   
}

public function testValidregister() {
    $response = $this->action('POST', 'UsersController@post_register',
                                array('firstname'=>'steve', 'lastname'=>'Mcqueen',
                                	'email' => 'sMcq@home.com', 'password'=>'password',
                                	 'password_confirmation'=>'password'));
    
}
public function testInRegLogin() {
    $response = $this->action('POST', 'UsersController@post_login',
        array('email' => 'sMcq@home.com', 'password'=>'password'));
    $this->assertRedirectedToAction('UsersController@get_login');
}
public function testInValidViewAll() {
    $this->be(User::find(1));  // Simulate logged in user with id = 2
    $response = $this->client->request('GET', 'users/secure');
    $this->assertCount(1, $response->filter('a:contains("View Registrants")'));

}

public function testNonAuthenticated() {
	$this->be(User::find(3));
    $response = $this->client->request('GET', 'users/manage');
    $this->assertRedirectedToAction('UsersController@get_login');
}
public function testAdminManage() {
    $this->be(User::find(1));  // Simulate logged in user with id = 2
    $response = $this->client->request('GET', 'users/secure');
    $this->assertCount(1, $response->filter('a:contains("Manage Registrants")'));

}
public function testAdminChangeRole() {
	 $this->be(User::find(1)); 
    $response = $this->action('POST', 'UsersController@post_registrants',
        array('roles'=>'3','id' => '2'));
    $this->assertRedirectedToAction('UsersController@get_registrants');
}
public function testInValidView() {
    $this->be(User::find(3));  // Simulate logged in user with id = 2
    $response = $this->client->request('GET', 'users/secure');
    $this->assertCount(0, $response->filter('a:contains("Manage Registrants")'));

}
public function testManagerChanged() {
    $this->be(User::find(3));  // Simulate logged in user with id = 2
    $response = $this->client->request('GET', 'users/secure');
    $this->assertCount(1, $response->filter('a:contains("Manage Registrants")'));

}
public function testAdmindelete() {
	 $this->be(User::find(1)); 
    $response = $this->action('GET', 'UsersController@get_destroy',
        array('id' => '2'));
    $this->assertRedirectedToAction('UsersController@get_registrants');
}
}