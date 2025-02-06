@extends("layouts.main")

@section("title", $page->name)

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h icon="script-text">{{ $page->name }}</x-h>

        {!! $page->content !!}

        <x-slot:side-content>
            <x-hint title="Zobacz też:">
                @foreach (App\Models\StandardPage::visible()->get() as $other_page)
                @unless ($other_page->id == $page->id)
                <x-button :action="route('standard-page', ['slug' => $other_page->slug])" class="phantom">{{ $other_page->name }}</x-button>
                @endunless
                @endforeach
            </x-hint>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
