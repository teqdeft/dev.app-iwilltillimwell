<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationsReward extends Model
{
    use HasFactory;
	protected $fillable = ['min', 'max', 'commission', 'year', 'organization_id'];

	
}
