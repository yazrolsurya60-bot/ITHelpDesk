<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation_model extends CI_Model
{

    public function add_evaluation($tiket_id, $rating)
    {
        $this->db->insert('evaluations', [
            'tiket_id' => $tiket_id,
            'rating' => $rating
        ]);
    }

    public function get_evaluation_by_ticket($tiket_id)
    {
        return $this->db->get_where('evaluations', ['tiket_id' => $tiket_id])->row();
    }
}
