<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Validator;

use App\Models\TCity;
 
class CityController extends Controller
{
	public function actionInsert(Request $request, SessionManager $sessionManager)
	{
		if($request->isMethod('post'))
		{
			$listMessage = [];

			$validator = Validator::make(
			[
				'name' => trim($request->input('txtName'))
			],
			[
				'name' => 'required'
			],
			[
				'name.required' => 'El campo "nombre" es requerido.'
			]);
	
			if($validator->fails())
			{
				$errors = $validator->errors()->all();
	
				foreach($errors as $value)
				{
					$listMessage[] = $value;
				}
			}

			if(TCity::whereRaw("replace(name, ' ', '') = replace(?, ' ', '')", $request->input('txtName'))->first() != null) {
				$listMessage[] = 'La ciudad ya fue registrada con anterioridad.';
			}

			if(count($listMessage) > 0) {
				$sessionManager->flash('listMessage', $listMessage);
				$sessionManager->flash('typeMessage', 'error');

				return redirect('city/insert');
			}

			$tCity = new TCity();

			$tCity->idCity = uniqid();
			$tCity->name = $request->input('txtName');

			$tCity->save();

			$sessionManager->flash('listMessage', ['Registro realizado correctamente.']);
			$sessionManager->flash('typeMessage', 'success');

			return redirect('city/insert');
		}

		return view('city/insert');
	}

	public function actionGetAll()
	{
		$listTCity = TCity::all();

		return view('city/getall',
		[
			'listTCity' => $listTCity
		]);
	}



	public function actionDelete($idCity, SessionManager $sessionManager)
	{
		$tCity = TCity::find($idCity);
		
		if($tCity != null)
		{
			$tCity->delete();
		}

		$sessionManager->flash('listMessage', ['Registro eliminado correctamente.']);
		$sessionManager->flash('typeMessage', 'success');

		return redirect('city/getall');
	}

	public function actionUpdate($idCity, Request $request, SessionManager $sessionManager)
	{
		if ($request->isMethod('post'))
		{
			$listMessage = [];

			$validator = Validator::make(
				[
					'name' => trim($request->input('txtName'))
				],
				[
					'name' => 'required'
				],
				[
					'name.required' => 'El campo "nombre" es requerido.'
				]);

			if ($validator->fails())
			{
				$errors = $validator->errors()->all();

				foreach ($errors as $value)
				{
					$listMessage[] = $value;
				}
			}

			// Se busca la ciudad que se está editando por su ID
			$cityToUpdate = TCity::find($idCity);

			if (!$cityToUpdate)
			{
				$listMessage[] = 'La ciudad que se intenta editar no existe.';
			}
			else
			{
				// Se comprueba si el nombre de la ciudad ya está registrado para otra ciudad
				$existingCity = TCity::where('idCity', '!=', $idCity)
									->whereRaw("replace(name, ' ', '') = replace(?, ' ', '')", $request->input('txtName'))
									->first();

				if ($existingCity)
				{
					$listMessage[] = 'El nombre de la ciudad ya está registrado para otra ciudad.';
				}
			}

			if (count($listMessage) > 0)
			{
				$sessionManager->flash('listMessage', $listMessage);
				$sessionManager->flash('typeMessage', 'error');

				return redirect('city/edit/'.$idCity); // Redirigir a la página de edición con el ID de la ciudad
			}

			// Actualizar los datos de la ciudad
			$cityToUpdate->name = $request->input('txtName');
			$cityToUpdate->save();

			$sessionManager->flash('listMessage', ['Actualización realizada correctamente.']);
			$sessionManager->flash('typeMessage', 'success');

			return redirect('city/getall');
		}

		// Si no es una solicitud POST, redirigir a la página de edición con el ID de la ciudad
		return redirect('city/edit/'.$idCity );
	}
}