@props([
    'message' => 'Hei',
    'color' => 'white',
    'colors' => [
        'blue' => 'bg-blue-50 border-blue-900',
        'light' => 'bg-zinc-50 border-zinc-900',
    ],
])

@if(strlen($message) > 0)
  <article
      {{ $attributes->merge(['class' => "
          w-full mb-6 border-2 rounded-lg shadow-sm p-6
          {$colors[$color]}
      "]) }}>
      {{ $message }}
  </article>
@endif