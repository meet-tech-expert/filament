@if ($record->set_primary)
    <input type="checkbox" name="set_primary" data-record-id="{{ $record->getKey() }}" checked disabled>
@else
    <input type="checkbox" name="set_primary" data-record-id="{{ $record->getKey() }}" class="set-primary-checkbox">
@endif


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.set-primary-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const recordId = checkbox.getAttribute('data-record-id');
                    
                    checkboxes.forEach(cb => {
                        if (cb !== checkbox) {
                            cb.checked = false;
                            // Optionally, update backend here if needed
                        }
                    });
                    
                    // Optionally, update backend here based on the checkbox state
                });
            });
        });
    </script>
@endpush
