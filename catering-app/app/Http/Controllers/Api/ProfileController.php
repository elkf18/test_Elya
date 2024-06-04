<?php

namespace App\Http\Controllers\Api;
use App\Models\Profile;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $add = Profile::create([
            'nama'      => $request->nama,
            'alamat'     => $request->alamat,
            'kontak'     => $request->kontak,
            'deskripsi'     => $request->deskripsi,
        ]);
        return response()->json(['message' => 'Profile created successfully', 'profile' => $add], 201);

        //return response
        // return new PostResource(true, 'Data Post Berhasil Ditambahkan!', $add);
    }
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $edit = Profile::find($id);
        $edit->update([
                'nama'      => $request->nama,
                'alamat'     => $request->alamat,
                'kontak'     => $request->kontak,
                'deskripsi'     => $request->deskripsi,
        ]);
        return response()->json(['message' => 'Profile created successfully', 'profile' => $edit], 201);

        }

    }