@extends(PACKAGE_NAME . '::layouts.app')

@section('title', 'Dashboard')

<?php
    use A2htray\GDBMozart\Models\Analysis;
    use A2htray\GDBMozart\Models\Organism;
    $user = Auth::user();
//    $analysis = array_map(function ($analysis) {
//        return [
//            'value' => $analysis->id,
//            'text' => $analysis->id . '-' . $analysis->name,
//        ];
//    }, Analysis::all());
//    dd($analysis);
//    $organisms = array_map(function ($organism) {
//        return [
//            'value' => $organism->id,
//            'text' => $organism->id . '-' . $organism->name,
//        ];
//    }, Organism::all());
?>

@section('content')
    <v-layout justify-center align-center>
        <m-upload-fasta></m-upload-fasta>
    </v-layout>
@endsection
