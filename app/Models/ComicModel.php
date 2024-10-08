<?php

namespace App\Models;

use CodeIgniter\Model;

class ComicModel extends Model
{
    protected $table      = 'comic';        # nama tabel
    protected $primaryKey = 'id';           # nama primary key dari tabel
    protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];      # kolom-kolom yg bisa diisi

    public function getComic($slug = false) {
        if ( $slug == false ) {
            return $this->findAll();
        } 
        
        return $this->where(['slug' => $slug])->first();
    }
    
}