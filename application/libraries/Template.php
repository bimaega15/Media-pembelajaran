<?php
class Template
{
    protected $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
    }
    public function login($template, $data = null)
    {
        $data['content'] = $this->ci->load->view($template, $data, true);
        $this->ci->load->view('template/login/main', $data);
    }
    public function admin($template, $data = null)
    {
        $passing = [
            'topbar' => $this->ci->load->view('template/admin/partial/topbar', null, true)
        ];
        $data = array_merge($data, $passing);

        $data['sidebar'] = $this->ci->load->view('template/admin/partial/sidebar', null, true);
        $data['content'] = $this->ci->load->view($template, $data, true);
        $data['footer'] = $this->ci->load->view('template/admin/partial/footer', null, true);

        $this->ci->load->view('template/admin/main', $data);
    }
}
