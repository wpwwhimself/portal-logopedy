@extends("layouts.admin")

@section("title", "Repozytorium plików")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h icon="file">Repozytorium plików</x-h>

        <p class="ghost">
            Tutaj możesz umieszczać pliki – np. grafiki – które mają pojawić się na podstronach.
            Po wgraniu ich na serwer możesz je umieścić w treściach strony, korzystając z wygenerowanych linków.
        </p>

        <x-tile>
            <x-h lvl="2" icon="file-tree">{{ request("path", "public") }}</x-h>

            <div class="flex right">
                @if (!in_array(request("path"), ["public", null]))
                <x-button :action="route('files-list', ['path' => Str::beforeLast(request('path'), '/')])" icon="arrow-left" class="phantom">..</x-button>
                @endif

                @foreach ($directories as $dir)
                <x-button :action="route('files-list', ['path' => $dir])" icon="folder" class="phantom">{{ Str::afterLast($dir, '/') }}</x-button>
                @endforeach
            </div>
        </x-tile>


        <div class="grid" style="--col-count: 4;">
            @forelse ($files as $file)
            <x-tile :title="Str::afterLast($file, '/')" class="flex down middle">
                @if (isPicture($file))
                <img src="{{ Storage::url($file) }}" alt="{{ Str::afterLast($file, '/') }}" class="thumbnail">
                @endif

                <div class="flex right middle center">
                    <x-button :action="route('files-download', ['file' => $file])" target="_blank" icon="download" class="phantom" />
                    <x-button icon="link" class="phantom" onclick="copyToClipboard('{{ Storage::url($file) }}')" />
                    <x-button :action="route('files-delete', ['file' => $file])" icon="delete" class="danger" />
                </div>
            </x-tile>
            @empty
            <p class="ghost">Brak plików</p>
            @endforelse
        </div>

        <x-slot:side-content>
            <x-tile title="Wgrywanie" title-icon="folder">
                <form action="{{ route('files-upload') }}" method="post" enctype="multipart/form-data" class="flex down">
                    @csrf
                    <input type="hidden" name="path" value="{{ request("path", "public") }}">
                    <input type="file" name="files[]" id="files" multiple>

                    <x-button action="submit" icon="upload">Wgraj</x-button>
                </form>
            </x-tile>

            <x-tile title="Zarządzanie folderem" title-icon="folder">
                <form action="{{ route('folder-create') }}" method="POST" class="flex down">
                    @csrf
                    <input type="hidden" name="path" value="{{ request("path", "public") }}">

                    <x-h lvl="3" icon="folder-plus">Nowy folder</x-h>

                    <p>Utworzony zostanie nowy folder w katalogu <strong>{{ request("path", "public") }}</strong></p>
                    <x-input name="name" label="Nazwa" />

                    <x-button action="submit" icon="folder-plus">Utwórz</x-button>
                </form>

                <x-button :action="route('folder-delete', ['path' => request('path', 'public')])"
                    icon="folder-remove"
                    class="danger phantom"
                >
                    Usuń folder i jego zawartość
                </x-button>
            </x-tile>

            <x-button :action="route('profile')" icon="arrow-left" class="phantom">Wróć</x-button>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
