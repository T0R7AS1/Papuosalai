<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Darbuotojai;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class DarbuotojaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $darbuotojai = Darbuotojai::OrderBy('created_at', 'desc')->paginate(10);
        return view('darbuotojai.index')->with('darbuotojai',$darbuotojai);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('darbuotojai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'vardas' => 'required',
            'telefonas' => 'required|between:9, 12',
            'apie' => 'required',
            'image' => 'nullable|max:2040'
        ]);
        
        $image = $request->file('image');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('storage'),$new_name);
        $form_data = array (
            'vardas' => $request->vardas,
            'telefonas' => $request->telefonas,
            'apie' => $request->apie,
            'image' => $new_name
        );
        Darbuotojai::create($form_data);

        return redirect('/darbuotojai')->with('success', 'Darbuotojas pridetas');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $darbuotojai = Darbuotojai::find($id);
        return view('darbuotojai.show')->with('darbuotojai', $darbuotojai);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $darbuotojai = Darbuotojai::find($id);
        return view('darbuotojai.edit')->with('darbuotojai', $darbuotojai);
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
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if ($image != '') {
            $request->validate([
                'vardas' => 'required',
                'telefonas' => 'required|between:9, 12',
                'apie' => 'required',
                'image' => 'nullable|max:2040|image'
            ]);
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image ->move(public_path('storage'), $image_name);
        }else{
            $request->validate([
                'vardas' => 'required',
                'telefonas' => 'required|between:9,12',
                'apie' => 'required'
            ]);
        }
            $form_data = array(
                'vardas' => $request->vardas,
                'telefonas' => $request->telefonas,
                'apie' => $request->apie,
                'image' => $image_name,
            );
            Darbuotojai::whereId($id)->update($form_data);
        return redirect('/darbuotojai')->with('success', 'darbuotojo info pakeista');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $darbuotojai = Darbuotojai::findOrFail($id);
        $darbuotojai->delete();
        return redirect('/darbuotojai')->with('success', 'darbuotojas istrintas');
    }
    public function dirbantys()
    {
        return view ('darbuotojai.dirbantys')->with('darbuotojai', $darbuotojai);
    }
}
