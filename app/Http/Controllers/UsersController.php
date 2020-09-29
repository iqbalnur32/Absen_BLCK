<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use App\Models\Attedances;
use App\Models\Leaves;
use Carbon\Carbon;
use DB;
use Str;

class UsersController extends Controller
{
	// Time Zone
	public function timeZone($location){
		return date_default_timezone_set($location);
	}

	// Home Users
	public function Home()
	{
		$this->timeZone('Asia/Jakarta');
		$user_id = Auth::guard('users')->user()->id;

		$result_absen = Leaves::with('Attedances')->where('user_id', $user_id)->get();
		return view('users.index', compact('result_absen'));
	}

	// Laporan Absensi
	public function LaporanAbsen(Request $req)
	{
		$user_id = Auth::guard('users')->user()->id;

		$start = $req->get('tanggal_start') . ' 00:00:00';
		$end = $req->get('tanggal_end') . ' 00:00:00';

		$data = Leaves::with('Attedances')
				->where('user_id', $user_id)
				->whereBetween('leaves.created_at', [$start, $end])
				->orderBy('leaves.created_at', 'desc')
				->get();

		return view('users.laporan', compact('data'));
	}

	// Process Absen Keluar
	public function AbsenKeluar(Request $request, $id_absen)
	{
		try {
			
			$data = Leaves::findOrFail($id_absen);
			$data->update(['check_out'   => date('Y-m-d H:s:i')]);
			return redirect()->back()->with('sukses', 'Success Absen!');  

		} catch (Exception $e) {
			return redirect()->back()->with('gagal', 'Gagal Absen!');	
		}
	}

	// Process Absen Masuk
	public function ProcessAbsen(Request $request)
	{
		$this->timeZone('Asia/Jakarta');
		$user_id = Auth::guard('users')->user()->id;

        // absen masuk dan keluar
		if ($request->check_in === 'check_in'){

			$cek_double = Leaves::where(['user_id' => $user_id, 'created_at' => date('Y-m-d H:s:i')])->count();

			if ($cek_double > 0 ){
				return redirect()->back()->with('gagal', 'Gagal Absen!');	
			}

			Leaves::create([
				'user_id'   => $user_id,
				'check_in'   => date('Y-m-d H:s:i'),
			]);

			if ($request->file('attachment')) {

				$attachment = Str::random(12);
				$request->file('attachment')->move(storage_path('image'), $attachment);

				$save_attadances = array(
					'user_id' => $user_id,
					'absend_from' => date('Y-m-d H:s:i'),
					'absend_to' => date('Y-m-d H:s:i'),
					'attachment' => $attachment, 
					'cutoff' => $request->cutoff, 
					'created_at' => date('Y-m-d H:s:i'),
					'updated_at' => date('Y-m-d H:s:i'),
				);

				Attedances::insert($save_attadances);
				return redirect()->back()->with('sukses', 'Success Absen!');	

			}else{
				
				$save_attadances1 = array(
					'user_id' => $user_id,
					'absend_from' => date('Y-m-d H:s:i'),
					'absend_to' => date('Y-m-d H:s:i'),
					'attachment' => null, 
					'cutoff' => $request->cutoff 
				);

				Attedances::insert($save_attadances1);
				return redirect()->back()->with('sukses', 'Success Absen!');	
			}
		}else{

			return redirect()->back()->with('gagal', 'Gagal Absen!');	
		}
	}

	// Get File Image
	public function GetFile($file)
	{
		$avatar_path = storage_path('image') . '/' . $file;

		if (file_exists($avatar_path)) {
			$file = file_get_contents($avatar_path);
			return response($file, 200)->header('Content-Type', 'image/jpeg');
		}

		return response()->json([
			'status' => 500,
			'msg' => 'File Not Found !'
		], 500);
	}

}
