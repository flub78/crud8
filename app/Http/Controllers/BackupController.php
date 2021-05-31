<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
	
	/**
	 * Find the backup filename from the id
	 * @param unknown $id
	 * @return string
	 */
	private function filename_from_index($id, $fullpath = false) {
		
		$dirpath = storage_path() . "/app/backup/";
		$backup_list = scandir($dirpath);

		// Look for the file specified by the user
		$filename = "";
		for ($i = 2; $i < count($backup_list); $i++) {
			$num_id = $i - 1;
			if (($num_id == $id) || ($backup_list[$i] == $id)) {
				if ($fullpath) {
					$filename = storage_path() . "/app/backup/" . $backup_list[$i];
				} else {
					$filename = $backup_list[$i];
				}
				break;
			}
		}
		
		return $filename;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  	
        $backups = array();
        $dirpath = storage_path() . "/app/backup/";
        $backup_list = scandir($dirpath);
        for ($i = 2; $i < count($backup_list); $i++) {
        	$elt = array('id' => ($i - 1), 'filename' => $backup_list[$i]);
        	array_push($backups, $elt);
        }
                
        return view("backup.index", compact('backups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Artisan::call('backup:create', []);
        return $this->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filename = $this->filename_from_index($id);
        
        if ($filename) {
        	echo "restoring $filename";
        	Artisan::call('backup:restore', ['backup_id' => $filename, '--force' => true]);
        }
        
        return $this->index();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$filename = $this->filename_from_index($id);
    	
    	if ($filename) {
    		unlink($filename);
    	}
    	
    	return $this->index();
    }
}
