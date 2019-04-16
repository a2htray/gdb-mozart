@extends(PACKAGE_NAME . '::layouts.app')

@section('title', 'Dashboard')

@section('content')
    <v-layout justify-center align-center>
        <m-upload-fasta></m-upload-fasta>
    </v-layout>
@endsection
