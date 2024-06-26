<x-filament::page>
     <div class="flex justify-between items-center">
        <x-filament::button tag="a" href="{{ url('admin/activity-logs')}}">
            Back 
        </x-filament::button>
    </div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        <x-filament::card>
            <div class="p-4">
                <h2 class="text-lg font-medium text-gray-900">User</h2>
                <p>{{ $record->user->name }}</p>
            </div>
        </x-filament::card>

        <x-filament::card>
            <div class="p-4">
                <h2 class="text-lg font-medium text-gray-900">Event</h2>
                <p>{{ ucfirst($record->event) }}
                </div></p>
        </x-filament::card>

        <x-filament::card>
            <div class="p-4">
                <h2 class="text-lg font-medium text-gray-900">Type</h2>
                <p>{{ $record->type }}
                </div></p>
        </x-filament::card>

        <x-filament::card>
            <div class="p-4">
                <h2 class="text-lg font-medium text-gray-900">Description</h2>
                <p>{{ $record->description }}</p>
            </div>
        </x-filament::card>

        <x-filament::card>
            <div class="p-4">
                <h2 class="text-lg font-medium text-gray-900">Subject</h2>
                <p>{{ $record->model_with_id }}</p>
                </div>
        </x-filament::card>
        <x-filament::card>
            <div class="p-4">
                <h2 class="text-lg font-medium text-gray-900">Logged At</h2>
                <p>{{ $record->created_at }}</p>
            </div>
        </x-filament::card>
        @if ($record->event === 'updated')
            <x-filament::card>
                <div class="p-4">
                    <h2 class="text-lg font-medium text-gray-900">Name</h2>
                    @php
                        $logData = json_decode($record->new_values, true);
                    @endphp
                    <p>{{ $logData['sub_name'] }}</p>
                </div>
            </x-filament::card>
             <x-filament::card>
                <div class="p-4">
                    <h2 class="text-lg font-medium text-gray-900">Updated At</h2>
                    <p>{{ $record->updated_at }}</p>
                </div>
            </x-filament::card>
        @endif

        <x-filament::card>
            <div class="p-4">
                <h2 class="text-lg font-medium text-gray-900">IP Address</h2>
                <p>{{ $record->ip_address }}</p>
            </div>
        </x-filament::card>

        <x-filament::card>
            <div class="p-4">
                <h2 class="text-lg font-medium text-gray-900">User Agent</h2>
                <p>{{ $record->user_agent }}</p>
            </div>
        </x-filament::card>
    </div>
</x-filament::page>
