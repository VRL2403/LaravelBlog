@extends('layouts.app')
@section('content')
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post</h2>
    </div>
</header>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="text-2xl">
                    <div class="flex justify-between">
                        Create Post
                    </div>
                </div>
            </div>

            <div class="bg-gray-200 bg-opacity-25">
                <div class="p-6 border-t border-gray-200 md:border-l">
                    <div class="items-center">
                        <form id="post-form" method="post" action="javascript:void(0)">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="grid gap-6">
                                    <div class="col-span-6 sm:col-span-12">
                                        <label class="block font-medium text-sm text-gray-700" for="title">
                                            Title
                                        </label>
                                        <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="title" type="text" name="title">
                                        <span class="text-danger p-1">{{ $errors->first('title') }}</span>
                                    </div>
                                    <div class="col-span-6 sm:col-span-12">
                                        <label class="block font-medium text-sm text-gray-700" for="description">
                                            Description
                                        </label>
                                        <textarea class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full h-60" id="description" name="description"></textarea>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    </div>
                                    <div class="col-span-6 sm:col-span-12">
                                        <label class="block font-medium text-sm text-gray-700" for="image">
                                            Image
                                        </label>
                                        <input type="file" name="image" id="image">
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    </div>
                                    <div class="col-span-6 sm:col-span-12">
                                        <button type="submit" id="send_form" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Submit</button>
                                    </div>
                                    <div class="col-span-6 sm:col-span-12">
                                        <div class="alert alert-success d-none" id="msg_div">
                                            <span id="res_message"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    if ($("#post-form").length > 0) {
        $("#post-form").validate({

            rules: {
                title: {
                    required: true,
                    maxlength: 50
                },
                description: {
                    required: true,
                },
                image: {
                    required: true,
                }
            },
            messages: {
                title: {
                    required: "Please Enter Title",
                    maxlength: "Title maxlength should be 50 characters long."
                },
                description: {
                    required: "Please Enter Description",
                },
                image: {
                    required: "Please Select an Image",
                }
            },
            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#send_form').html('Saving...');
                $.ajax({
                    url: '/post/save',
                    type: "POST",
                    data: $('#post-form').serialize(),
                    success: function(response) {
                        $('#send_form').html('Submit');
                        $('#res_message').show();
                        $('#res_message').html(response.msg);
                        $('#msg_div').removeClass('d-none');

                        document.getElementById("post-form").reset();
                        setTimeout(function() {
                            $('#res_message').hide();
                            $('#msg_div').hide();
                        }, 10000);
                    }
                });
            }
        })
    }
</script>
@endsection