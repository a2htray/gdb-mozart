@extends(PACKAGE_NAME . '::layouts.app')

@section('title', 'Dashboard')

@section('content')
    <v-tooltip right>
        <v-btn
            icon
            large
            target="_blank"
            slot="activator"
        >
            <v-icon large>code</v-icon>
        </v-btn>
        <span>Source</span>
    </v-tooltip>
@endsection
