@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <div
            {{ $attributes->merge(['class' => 'block font-medium text-sm text-red-700 dark:text-red-300', 'style' => 'color:red;']) }}>
            {{ $message }}</div>
    @endforeach
@endif
