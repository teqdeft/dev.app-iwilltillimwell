<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GroupCounseling;
use DB;
class GroupCounselingTime extends Model
{
    use HasFactory;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "group_counseling_times";
    public function counseling_date_time() {
        return $this->belongsTo(GroupCounseling::class, 'id');
    }

    public function hostLinkRemainder($where){
        return $this->leftJoin('group_counselings','group_counseling_times.group_counseling_id','=','group_counselings.id')
                    ->leftJoin('braintree_transactions as bt','bt.counseling_id','=','group_counselings.id')
                    ->leftJoin('users','bt.user_id','=','users.id')
                    ->where('date',$where['twoDay'])
                    ->orWhere('date',$where['oneDay'])
                    ->orWhere('date',$where['currentDay'])
                    ->select('group_counseling_times.*','users.email','bt.token','group_counselings.id as GPid','group_counselings.title',
                            DB::raw("CONCAT(users.fname,' ',users.lname) AS name"),'users.id as usersId')->get();
   }

   public function getPerviousDateList(){ 
        return $this->leftJoin('group_counselings','group_counseling_times.group_counseling_id','=','group_counselings.id')
                    ->leftJoin('braintree_transactions as bt','bt.counseling_id','=','group_counselings.id')
                    ->leftJoin('users','bt.user_id','=','users.id')
                    ->where('date',date('Y-m-d', strtotime("+1 days")))
                    ->whereNotNull('bt.counseling_id')
                    ->select('group_counseling_times.*','group_counselings.minimum_number_of_users','bt.transaction_id','users.email',
                                'bt.token','group_counselings.id as GPid','group_counselings.title',
                            DB::raw("CONCAT(users.fname,' ',users.lname) AS name"),'users.id as usersId','users.user_role')->get();
           
   }



}
