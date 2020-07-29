<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['kode' => $this->session->userdata('kode')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['kode' => $this->session->userdata('kode')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'jpg|png';
                $config['max_size']     = '2048';
                $config['max_width']     = '1000';
                $config['max_height']     = '1000';
                $config['upload_path'] = './assets/img/profile/';


                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('user');
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user');
        }
    }


    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['kode' => $this->session->userdata('kode')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
            } else {

                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }


    public function Materi()
    {
        $data['title'] = 'Materi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['Materi'] = $this->db->get('materi')->result_array();

        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/materi', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'judul' => $this->input->post('judul'),
                'kelas' => $this->input->post('kelas'),
                'jurusan' => $this->input->post('jurusan'),
                'isactive' => $this->input->post('isactive')
            ];

            $this->db->insert('materi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your materi has been updated!</div>');
            redirect('user/materi');
        }
    }

    public function MateriEdit($id)
    {
        $data['title'] = 'Upload Materi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = $this->materi_m->get($id);
        $data['row'] = $query->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/materi-edit', $data);
        $this->load->view('templates/footer');
    }

    public function editproses()
    {
        $post = $this->input->post(null, TRUE);
        $this->materi_m->edit($post);
        if ($this->db->affected_rows() > 0) {
            echo "<script>
                alert('Data berhasil disimpan');
            </script>";
        }
        echo "<script>
                window.location='" . site_url('User/materi') . "';
            </script>";
    }

    public function materiadd()
    {
        $data['title'] = 'Add Materi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/materi-add', $data);
            $this->load->view('templates/footer');
        }
    }

    public function prosesadd()
    {
        $post = $this->input->post(null, true);

        $config['allowed_types'] = 'pdf|jpg|png|jpeg';
        $config['max_size']     = '5120';
        $config['upload_path'] = './assets/materi/';
        $this->load->library('upload', $config);

        if (@$_FILES['namafile']['name'] != null) {
            if ($this->upload->do_upload('namafile')) {
                $post['namafile'] = $this->upload->data('file_name');
                $this->materi_m->add($post);
                if ($this->db->affected_rows() > 0) {
                    echo "<script> altert('Data berhasil disimpan');
                </script>";
                }
                echo "<script>window.location='" . site_url('user/materi') . "'</script>";
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('user/materi');
            }
        }
    }

    public function delmateri($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('materi');
        $row    = $query->row();
        unlink("./assets/materi/$row->namafile");

        $this->materi_m->deldata('materi', array('id' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your materi has been deleted!</div>');
        redirect('user/materi');
    }

    public function informasi()
    {
        $data['title'] = 'Information';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['informasi'] = $this->db->get('informasi')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/informasi', $data);
        $this->load->view('templates/footer');
    }

    public function informasiadd()
    {
        $data['title'] = 'Add Information';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/informasi-add', $data);
            $this->load->view('templates/footer');
        }
    }

    public function infoprosesadd()
    {
        $post = $this->input->post(null, true);

        $config['allowed_types'] = 'pdf|jpg|jpeg|png';
        $config['max_size']     = '5120';
        $config['upload_path'] = './assets/informasi/';
        $this->load->library('upload', $config);

        if (@$_FILES['namafile']['name'] != null) {
            if ($this->upload->do_upload('namafile')) {
                $post['namafile'] = $this->upload->data('file_name');
                $this->informasi_m->add($post);
                if ($this->db->affected_rows() > 0) {
                    echo "<script> altert('Data berhasil disimpan');
                </script>";
                }
                echo "<script>window.location='" . site_url('user/informasi') . "'</script>";
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('user/informasi');
            }
        }
    }

    public function informasidel($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('informasi');
        $row    = $query->row();
        unlink("./assets/informasi/$row->namafile");

        $this->materi_m->deldata('informasi', array('id' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your information has been deleted!</div>');
        redirect('user/informasi');
    }
}
