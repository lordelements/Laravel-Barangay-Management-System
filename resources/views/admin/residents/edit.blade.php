@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div
            class="bg-white dark:bg-gray-800 relative shadow-sm border border-gray-200 dark:border-gray-700 sm:rounded-xl overflow-hidden">

            <form action="{{ route('admin.residents-update', $resident) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.residents.partials.form', ['resident' => $resident, 'buttonText' => 'Update Resident'])
            </form>
        </div>

</section>
@endsection