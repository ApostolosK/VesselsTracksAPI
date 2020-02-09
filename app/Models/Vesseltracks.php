<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Vesseltracks extends Model {

    protected
        $table = "vesseltracks",
        $primaryKey = 'id_track';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    const DELETED_AT = 'deleted';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created'
    ];

    protected $dates = [
        'created'
    ];

    protected $dateFormat = 'Y-m-d H:i:sP';

    /**
     * Extract the data from the DB
     * @param array $data
     * 
     * @return array
     */
    final public static function getdata($data)
    {
        $mmsi = [];
        if (is_array($data['mmsi'])) {
            $mmsi = implode(",", $data['mmsi']);
        } else {
            $mmsi = [$data['mmsi'])];
        }

        $sql = "SELECT * 
                FROM vesseltracks
                WHERE mmsi IN ?";
               
        
        Log::debug($sql);
        
        //Get the results
        $db_results = DB::select($sql, $mmsi);
        
        $results = [];
        $results['results'] = $db_results;
        $results['results_num'] = count($db_results);

        return $results; 
    }
}