<?php

namespace A2htray\GDBMozart\Controllers\API;

use A2htray\GDBMozart\Models\Analysis;

use A2htray\GDBMozart\Models\Organism;
use A2htray\GDBMozart\Models\Specie;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class OrganismAddApiController
{
    public function __invoke(Request $request)
    {
        $specie = Specie::firstOrNew([
            'name' => $request->post('specie', null),
        ], [
            'description' => 'Default',
        ]);
        $specie->save();

        $keyMap = [
            'infraspecificName' => 'infraspecific_name',
            'commonName' => 'common_name',
        ];

        $data = $request->post();
        foreach ($keyMap as $key => $realField) {
            if (array_key_exists($key, $data)) {
                $data[$realField] = $data[$key];
                unset($data[$key]);
            }
        }

        $data['specie_id'] = $specie->id;

        // file upload procedure
        $imageFile = $request->file('imageFile');
        $fileName = md5(time()) . '_' . $imageFile->getClientOriginalName();
        $destinationPath =  public_path() . config('mozart.image_dir') . '/' . $fileName;
        move_uploaded_file($imageFile->getRealPath(), $destinationPath);

        $data['image_uri'] = config('mozart.image_dir') . '/' . $fileName;

        $organism = Organism::create($data);

        return [
            'code' => 200,
            'data' => $organism,
        ];

    }
}
