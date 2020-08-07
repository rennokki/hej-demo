@extends('layouts.app')

@section('content')
<div class="flex items-center">
  <div class="md:w-1/2 md:mx-auto space-y-6">
    @if (session('status'))
      <div
        class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
        role="alert"
      >
        {{ session('status') }}
      </div>
    @endif

    @if (session('social'))
      <div
        class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
        role="alert"
      >
        {{ session('social') }}
      </div>
    @endif

    <div class="flex flex-col break-words bg-white border rounded shadow-md">
      <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
        Dashboard
      </div>

      <div class="w-full p-6">
        <p class="text-gray-700">
          You are logged in!
        </p>
      </div>
    </div>

    <div class="flex flex-col break-words bg-white border rounded shadow-md">
      <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
        Social accounts
      </div>

      <div class="w-full p-6">
        <div class="flex justify-between">
          <div>Github</div>

          <div>
            @if ($github)
              {{ $github->provider_name }}

              <a
                href="{{ route('social.unlink', ['provider' => 'github']) }}"
                class="text-blue-400 hover:text-blue-600"
              >
                (Unlink)
              </a>
            @else
              <a
                href="{{ route('social.link', ['provider' => 'github']) }}"
                class="text-blue-400 hover:text-blue-600"
              >
                Link
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
