<?php
class Model_order extends CI_Model
{
    public function get_all()
    {
        return $this->db->get('sraddha_order')->result();
    }
}
