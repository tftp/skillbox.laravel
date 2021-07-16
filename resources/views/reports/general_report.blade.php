@extends('layout.master')

@section('title', 'Итоговый отчет')

@section('content')

    <div class="col-md-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title mb-4">Итоговый отчет</h2>

            @include('layout.success')

            <form method="post" action="{{ route('reports.general.post') }}">
                @csrf
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" id="newsCheck" name="newsCheck">
                    <label class="form-check-label" for="newsCheck">
                        Новости
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" id="articlesCheck" name="articlesCheck">
                    <label class="form-check-label" for="articlesCheck">
                        Статьи
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" id="commentsCheck" name="commentsCheck">
                    <label class="form-check-label" for="commentsCheck">
                        Комментарии
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" id="tagsCheck" name="tagsCheck">
                    <label class="form-check-label" for="tagsCheck">
                        Тэги
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" id="usersCheck" name="usersCheck">
                    <label class="form-check-label" for="usersCheck">
                        Пользователи
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Сформировать</button>
            </form>

        </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

@endsection
