@extends(PACKAGE_NAME . '::layouts.app')

@section('title', 'Dashboard')

<?php
    $items = array_keys(config(PACKAGE_NAME .'.obo.defaults'));
    $md = [
        'items' => $items,
        'origin' => config(PACKAGE_NAME .'.obo.defaults'),
    ];

    $headers = [
        [
            'text' => 'ID',
            'value' => 'id',
        ],
        [
            'text' => 'Vocabulary Name',
            'value' => 'vocabulary_name',
        ],
        [
            'text' => 'Remote Url',
            'value' => 'remote_uri',
        ],
        [
            'text' => 'Local Url',
            'value' => 'local_uri',
        ],
        [
            'text' => 'Created Time',
            'value' => 'created_at',
        ],
        [
            'text' => 'Completed',
            'value' => 'is_completed',
        ]
    ];
?>

@section('content')
    <v-layout>
        <v-flex>
            <v-card flat>
                <v-card-text>
                    <h3>INSTRUCTIONS</h3>
                    <p class="text-lg-left">This page allows you to load vocabularies and ontologies that are in OBO format. Once loaded, the terms from these vocabularies can be used to categorize data in the database. You may use the form below to either reload a vocabulary that is already loaded (as when new updates to that vocabulary are available) or load a new vocabulary.</p>
                </v-card-text>
                <v-card-text>
                    <h3>USE A SAVED ONTOLOGY OBO REFERENCE</h3>
                    <p class="text-lg-left">
                        The vocabularies listed in the select box below have bene pre-populated upon installation of Tripal or have been previously loaded. Select one to edit its settings or submit for loading. You may reload any vocabulary that has already been loaded to retrieve any new updates.
                    </p>
                </v-card-text>
                <v-card-text>
                    <h3>Ontology OBO File Reference</h3>
                    <m-obo-panel :md="{{ json_encode($md) }}"></m-obo-panel>
                </v-card-text>
            </v-card>
            <v-card flat>
                <v-card-text><h3>RECORDS</h3></v-card-text>
                <v-data-table
                    :headers="{{ json_encode($headers) }}"
                    :items="{{ json_encode($records) }}"
                    disable-initial-sort
                    class="elevation-1"
                >
                    <template v-slot:items="props">
                        <td>@{{ props.item.id }}</td>
                        <td>@{{ props.item.vocabulary_name }}</td>
                        <td>@{{ props.item.remote_uri }}</td>
                        <td>@{{ props.item.local_uri }}</td>
                        <td>@{{ props.item.created_at }}</td>
                        <td>@{{ props.item.is_completed }}</td>
                    </template>
                </v-data-table>

            </v-card>

        </v-flex>
    </v-layout>
@endsection
