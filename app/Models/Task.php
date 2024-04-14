<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function r_added(){
        return $this->belongsTo(User::class, 'added_by');
    }

    public function getStatus(){
        switch ($this->status) {
            case 1:
                return '<span class="badge bg-primary">New</span>';
                break;
        
            case 2:
                return '<span class="badge bg-info">In Progress</span>';
                break;

            case 3:
                return '<span class="badge bg-success">Done</span>';
                break;

            default:
                return '<span class="badge bg-dark">Error</span>';
                break;
        }
    }
}
