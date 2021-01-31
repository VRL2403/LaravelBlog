<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-2xl">
                        <div class="flex justify-between">
                            Posts
                            <a href="{{url('/post/create')}}" type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                                Create Post
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid">
                    @if(!isset($posts))
                    <div class="p-6 border-t border-gray-200 md:border-l">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">No post found!!!</div>
                        </div>
                    </div>
                    @else
                    @foreach($posts as $post)
                    @php $id = $post['id'] @endphp
                    <div class="p-6 border-t border-gray-200 md:border-l">
                        <input type="hidden" value="{{$post['id']}}" id="post_id" />
                        <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">{{$post['title']}}</div>
                        <div class="flex items-center">
                            <img src="{{url('storage/'.$post['image'])}}" class="w-20 h-20">
                            @php
                            $post['description']=(strlen(trim($post['description'])) > 500) ? substr($post['description'], 0, 500) . "..." : $post['description']
                            @endphp
                            <div class="ml-4 text-sm text-gray-600 leading-7">
                                {{$post['description']}}
                            </div>
                        </div>
                        <a href="{{url('/post/edit/{$id}')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                            Edit</a>
                        <a href="{{url('/post/delete/{$id}')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                            Delete</a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>