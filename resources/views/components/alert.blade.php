@php
$styles = [
'info' => 'text-fg-brand-strong bg-brand-softer focus:ring-brand-medium',
'danger' => 'text-fg-danger-strong bg-danger-soft focus:ring-danger-medium',
'success' => 'text-fg-success-strong bg-success-soft focus:ring-success-medium',
'warning' => 'text-fg-warning bg-warning-soft focus:ring-warning-medium',
'dark' => 'text-heading bg-neutral-secondary-medium focus:ring-neutral-tertiary',
];

$alertId = 'alert-' . uniqid();
@endphp

<div id="{{ $alertId }}"
    class="flex sm:items-center p-4 mb-4 text-sm rounded-base {{ $styles[$type] ?? $styles['info'] }}" role="alert">
    <svg class="w-4 h-4 shrink-0 mt-0.5 md:mt-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>

    <div class="ms-2">
        {!! $message !!}
    </div>

    <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 rounded p-1.5 inline-flex h-8 w-8 items-center justify-center focus:ring-2"
        onclick="document.getElementById('{{ $alertId }}').remove()" aria-label="Close">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>