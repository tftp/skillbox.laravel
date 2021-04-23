                @csrf
                <div class="form-group">
                    <label for="codeArticle">Код статьи</label>
                    <input
                        type="text"
                        class="form-control"
                        id="codeArticle"
                        placeholder="Введите код статьи"
                        name="code"
                        value="{{old('code', $article->code ?? '')}}"
                    >
                </div>
                <div class="form-group">
                    <label for="titleArticle">Заголовок</label>
                    <input
                        type="text"
                        class="form-control"
                        id="titleArticle"
                        placeholder="Заголовок статьи"
                        name="title"
                        value="{{old('title', $article->title ?? '')}}"
                    >
                </div>
                <div class="form-group">
                    <label for="annotationArticle">Краткое содержание</label>
                    <input
                        type="text"
                        class="form-control"
                        id="annotationArticle"
                        placeholder="Краткое содержание статьи"
                        name="annotation"
                        value="{{old('annotation', $article->annotation ?? '')}}"
                    >
                </div>
                <div class="form-group">
                    <label for="bodyArticle">Содержание статьи</label>
                    <textarea class="form-control" id="bodyArticle" rows="5" name="body">{{old('body', $article->body ?? '')}}</textarea>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="publishedArticle" name="published" {{$checked ?? ''}}>
                    <label class="form-check-label" for="publishedArticle">Опубликовано</label>
                </div>

