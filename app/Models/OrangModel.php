<?php

namespace App\Models;

use CodeIgniter\Model;

class OrangModel extends Model
{
    protected $table      = 'orang';        # nama tabel
    protected $primaryKey = 'id';           # nama primary key dari tabel
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'alamat'];      # kolom-kolom yg bisa diisi

    public function search($keyword) {
        // Memberi tau ke builder untuk tabelnya
        // $builder = $this->table('orang');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('orang')->like('nama', $keyword)->orLike('alamat', $keyword);
    }
    
}