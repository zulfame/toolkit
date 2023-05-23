<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('user/profile');
		}

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			// validasi success
			$this->_login();
		}
	}

	private function _login()
	{
		$email		= $this->input->post('email');
		$password	= $this->input->post('password');

		//$user = $this->db->get_where('user', ['email' => $email])->row_array();
		$user = $this->db->query("select * from user join region on region.`id`=user.`region_id` where email='$email'")->row_array();

		// jika usernya ada
		if ($user) {
			if ($user['is_active'] == 1) {
				// cek password
				if (password_verify($password, $user['password'])) {
					$data = [
						'email'		=> $user['email'],
						'role_id'	=> $user['role_id'],
						'region'	=> $user['region'],
						'user_code'	=> $user['user_code'],
						'alias'		=> $user['alias'],
						'name'		=> $user['name']
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 4) {
						$online = 1;
						$ip = $this->input->ip_address();
						$location = json_decode(file_get_contents("http://ipinfo.io/"));
						$getloc = $location->city;

						$this->db->set('is_online', $online);
						$this->db->set('ip_address', $ip);
						$this->db->set('getloc', $getloc);
						$this->db->where('email', $email);
						$this->db->update('user');

						$this->session->set_flashdata('message', 'Login');
						redirect('dashboard/analytic');
					} elseif ($user['role_id'] == 5 || $user['role_id'] == 6) {
						$online = 1;
						$ip = $this->input->ip_address();
						$location = json_decode(file_get_contents("http://ipinfo.io/"));
						$getloc = $location->city;

						$this->db->set('is_online', $online);
						$this->db->set('ip_address', $ip);
						$this->db->set('getloc', $getloc);
						$this->db->where('email', $email);
						$this->db->update('user');

						$this->session->set_flashdata('message', 'Login');
						redirect('dashboard/officer');
					} elseif ($user['role_id'] == 7) {
						$online = 1;
						$ip = $this->input->ip_address();
						$location = json_decode(file_get_contents("http://ipinfo.io/"));
						$getloc = $location->city;

						$this->db->set('is_online', $online);
						$this->db->set('ip_address', $ip);
						$this->db->set('getloc', $getloc);
						$this->db->where('email', $email);
						$this->db->update('user');

						$this->session->set_flashdata('message', 'Login');
						redirect('dashboard/welcome');
					} elseif ($user['role_id'] == 8) {
						$online = 1;
						$ip = $this->input->ip_address();
						$location = json_decode(file_get_contents("http://ipinfo.io/"));
						$getloc = $location->city;

						$this->db->set('is_online', $online);
						$this->db->set('ip_address', $ip);
						$this->db->set('getloc', $getloc);
						$this->db->where('email', $email);
						$this->db->update('user');

						$this->session->set_flashdata('message', 'Login');
						redirect('dashboard/welcome');
					} else {
						$online = 1;
						$ip = $this->input->ip_address();
						$location = json_decode(file_get_contents("http://ipinfo.io/"));
						$getloc = $location->city;

						$this->db->set('is_online', $online);
						$this->db->set('ip_address', $ip);
						$this->db->set('getloc', $getloc);
						$this->db->where('email', $email);
						$this->db->update('user');

						$this->session->set_flashdata('message', 'Login');
						redirect('dashboard');
					}
				} else {
					log_auth("failed_pass", "Login Failed Worng Password!");

					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Worng strong>password</strong>!
						<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					This email has <strong>not been</strong> activated!
					<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>');
				redirect('auth');
			}
		} else {
			log_auth("failed_login", "Login Failed Email not Registered!");

			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Email is <strong>not registered!</strong>
				<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
			redirect('auth');
		}
	}

	public function registration()
	{
		if ($this->session->userdata('email')) {
			redirect('user/profile');
		}

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' 	=> 'This email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' 		=> 'Passcode dont match!',
			'min_length'	=> 'Passcode too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
			'matches' 		=> 'Passcode dont match!',
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Registration';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$email = $this->input->post('email', true);
			$data = [
				'name' 			=> htmlspecialchars($this->input->post('name', true)),
				'email' 		=> htmlspecialchars($email),
				'image' 		=> 'default.jpg',
				'password' 		=> password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'region_id'		=> 9,
				'role_id' 		=> 8,
				'is_active' 	=> 0,
				'm_access' 		=> 0,
				'date_created'	=> time()
			];

			// siapkan token
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];

			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);

			$this->_sendEmail($token, 'verify');

			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Your account has been created. Please <strong>activate</strong> your account.
				<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
			redirect('auth');
		}
	}


	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol'  => 'smtp',

			'smtp_host' => 'ssl://mail.bprbangunarta.co.id',
			'smtp_user' => 'info@bprbangunarta.co.id',
			'smtp_pass' => '@Pusat09011992',

			// 'smtp_host' => 'ssl://smtp.googlemail.com',
			// 'smtp_user' => 'zulfadlirizal@gmail.com',
			// 'smtp_pass' => 'jksydzvwmmcfwpft',

			'smtp_port' => 465,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		];

		$this->email->initialize($config);

		$this->email->from('info@bprbangunarta.co.id', 'BPR Bangunarta');
		$this->email->to($this->input->post('email'));

		if ($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Click this link to verify you account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
		} else if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}


	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');

					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
					redirect('auth');
				} else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong token.</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
			redirect('auth');
		}
	}


	// public function logout()
	// {
	// 	$this->session->unset_userdata('email');
	// 	$this->session->unset_userdata('role_id');

	// 	$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
	// 	You have been <strong>logged</strong> out!.
	// 	<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
	// 	</div>');
	// 	redirect('auth');
	// }

	public function logout()
	{

		$email	= $this->session->userdata('email');
		$date	= date('Y-m-d H:i:s');
		$online = 0;
		$ip = $this->input->ip_address();

		$this->db->set('last_seen', $date);
		$this->db->set('is_online', $online);
		$this->db->set('ip_address', $ip);
		$this->db->where('email', $email);
		$this->db->update('user');

		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			You have been <strong>logged</strong> out!.
			<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
		redirect('auth');
	}


	public function blocked()
	{
		$this->load->view('auth/blocked');
	}


	public function forgotPassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Forgot Password';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/forgot-password');
			$this->load->view('templates/auth_footer');
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
					Please check your email to <strong>reset</strong> your password.
					<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>');
				redirect('auth/forgotpassword');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Email is <strong>not registered</strong> or <strong>activated</strong>.
					<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>');
				redirect('auth/forgotpassword');
			}
		}
	}


	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Reset password <strong>failed!</strong> Wrong token.
					<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Reset password <strong>failed!</strong> Wrong email.
				<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
			redirect('auth');
		}
	}


	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}

		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' 		=> 'Passcode dont match!',
			'min_length'	=> 'Passcode too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
			'matches' 		=> 'Passcode dont match!',
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Change Password';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/change-password');
			$this->load->view('templates/auth_footer');
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');

			$this->db->delete('user_token', ['email' => $email]);

			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Password has been <strong>changed!</strong> Please login.
				<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
			redirect('auth');
		}
	}
}
