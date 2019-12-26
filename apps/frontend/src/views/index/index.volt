<div class="full-screen">
    <form class="shortener-form text-center" method="post">
        <h1 class="text-uppercase">Url Shortener</h1>
        <p class="text-muted small text-uppercase">Сокращай ссылки без регистрации и смс!</p>

        <input type="url" class="form-control mt-5 url" placeholder="Ссылку сюда" required>

        <button type="submit" class="btn btn-success mt-5">Получить результат</button>

        <div class="mt-3 status-block-error">
            <div class="text-muted small text-uppercase status-block-text text-danger"></div>
        </div>

        <div class="mt-5 status-block">
            <div class="text-muted small text-uppercase status-block-text">Ваша ссылка готова!</div>
            <div class="status-block-url"></div>
        </div>
    </form>

</div>