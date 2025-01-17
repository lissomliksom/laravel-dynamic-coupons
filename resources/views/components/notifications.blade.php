@props([
    'message' => 'Hei',
    'color' => 'white',
    'colors' => [
        'white' => 'bg-white focus:ring-gray-900 active:ring-gray-900',
        'light' => 'bg-gray-50 focus:ring-gray-900 active:ring-gray-900',
        'dark' => 'bg-gray-900 focus:ring-emerald-700 active:ring-emerald-700',
        'darker' => 'bg-gray-1000 focus:ring-emerald-700 active:ring-emerald-700',
    ],
])

@if(strlen($message) > 0)
  <article
      {{ $attributes->merge(['class' => "
          w-full mb-6 border rounded-lg shadow-sm p-6
          {$colors[$color]}
      "]) }}>
  </article>
@endif