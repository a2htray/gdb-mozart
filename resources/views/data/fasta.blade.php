@extends(PACKAGE_NAME . '::layouts.app')

@section('title', 'Dashboard')

<?php
    use A2htray\GDBMozart\Models\Analysis;
    use A2htray\GDBMozart\Models\Organism;
    $user = Auth::user();
?>

@section('content')
    <v-layout justify-center align-center>
        <m-upload-fasta></m-upload-fasta>
    </v-layout>
@endsection
