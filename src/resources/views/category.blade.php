@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/category.css') }}?v={{ time() }}" />
@endsection

@section('content')
<div class="category__alert">
    @if (session('message'))
    <div class="category__alert--success">
        {{ session('message') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="category__alert--error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<div class="category-form">
    <form class="create-form" action="/categories" method="post">
        @csrf
        <div class="create-form__input-area">
            <input class="create-form__input" type="text" name="name" value="{{ old('name') }}">
        </div>
        <div class="create-form__button-area">
            <button class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>
    <div class="category-table">
        <table class="category-table__inner">
            <tr class="category-table__row">
                <th class="category-table__heading">Category</th>
            </tr>
            @foreach ($categories as $category)
            <tr class="category-table__row">
                <td class="category-table__item">
                    <form class="update-form" action="/categories/{category_id}" method="post">
                        @method ('PATCH')
                        @csrf
                        <div class="update-form__input-area">
                            <input class="update-form__input" type="text" name="name" value="{{ $category->name }}">
                            <input type="hidden" name="id" value="{{ $category->id }}">
                        </div>
                        <div class="update-form__button-area">
                            <button class="update-form__button-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="category-table__item">
                    <form class="delete-form" action="/categories/{category_id}" method="post">
                        @method ('DELETE')
                        @csrf
                        <div class="delete-form__button-area">
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection