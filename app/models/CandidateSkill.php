<?php

class CandidateSkill extends Eloquent 
{
	protected $table = 'can_skills';
	
	public static function getSkills($cv_id)
	{
		$tbl_this = with(new static)->getTable();
		$tbl_level = (new \Level)->getTable();
		
		return CandidateSkill::select(DB::raw(
								"id,
								name,
								level_id,
								(SELECT description FROM {$tbl_level} WHERE id = {$tbl_this}.level_id LIMIT 1) level,
								year_experience"
							))
							->where('cv_id', '=', $cv_id)
							->get();
	}
}