<?php include 'sections/header.php'; ?>
error_log('Request URI: ' . $_SERVER['REQUEST_URI']);
<div class="container">
    <!-- Display success message -->
    <?php if (!empty($successMessage)): ?>
        <div class="alert alert-success" role="alert">
            <?= htmlspecialchars($successMessage); ?>
        </div>
    <?php endif; ?>

    <!-- Display error message -->
    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($errorMessage); ?>
        </div>
    <?php endif; ?>
</div>

<header class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3">Досымова Замзагул</h1>
                <p class="lead mb-4">
                    <strong>Білім</strong> – болашақтың кілті. 27 жылдық тәжірибеммен жас мұғалімдерге жол көрсетемін.
                </p>
                <a href="https://wa.me/77079678488" class="btn btn-light btn-lg me-2">
                    <img src="data:image/png;base64,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" alt="whatsapp--v1">
                </a>
                <a href="https://www.instagram.com/zamza_metodika1" class="btn btn-light btn-lg me-2">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAKPElEQVR4nO2YC1RVZRbHD6iQiq8alHvJB4iJGmCKTjq1fCuSAooPkGcSWE1WppMz2QypZS/NFDW1fDVOOipWSkvzURo+Uis1RPGBIPkEfAAXuDzu/c0633fuueJjxovOmjVrsdfaa13ud87e/9+397fP4SpKndVZndXZ/40F+eAa1LF41OAupq8H+ZWWB3U2WYf6mrhXH+RfRp8nzfTqV0n3YAtdQ60EhFjKuoZYcgJCLWv8QxnbeTQu/xXxQzuVhgX5lmTfKmqYTwmhbYoZ4VlEuOEGo1rdINzjuvisfhfatkhccyeggU+U8Yc+FXQbJmE0oNyAUMIemPBkBeehviUfqAmDO0qxYx65TkzDQuKd8xmv3Js/65xPdKNCca8aI7jjTTCdTPTrYSZwSLUO0jXUMkdRcLpvgGBf0+yw1kWMa3KV8U4FtwlLcL5MQqM8EpqfIeGRkyS0PMFz7lnyc7NsEhrmMd75yu1A9fKJbHaNsDbFNarSL7CcHkESJCDEMvu+xI9ucX1mfP2aolVBz7XKZPrwDL5b+xuXckowl1XjqJlNVi5kVrN9XhnTul8n3OMGQ7WqBHUy0efJCp4YbuGJEEJqJ16hXrxzwTUhusFFEo0ZJHXdxUt9vyX96zysFisPyqwW2LW4nAS3q4w03NCrMdivlJ4DKi/X6mA/q+QPS3joN5J8DjKh11Ym9N4ixJ8+ck0krTJXc2Dlaf4xcgcpfhv5yGfdXX12h/W83SmVNwO+4rXAzTzfewsv99/Gu8/tY8eaXCrNFhHz5O5KklwLiG5YyHAve2s93bvC8VZK9D50zCZcTTi5exo/r88RiYrOl7Jq6FZd4Mc+a1nkvYylXkv4rN1C4Uu8l7LQe4VYuxXow8fW8dbjG3m1R5qIPz06nauXy0XsXUtK5RlxKmBUS1mNgQFlPzsMkPTk1nOq8CndNvOu7wb+PmybaBt159cO2cjqtu+x6dEpbDck8oNH1L/xaLYZk/iq9VRWt32fBe1X1YB513cDU7pvZkZ0OpUVFpEj+alz+pmLcrtKcAdTpsMArwamlc3qlKonOrIqS+xQ7tKddxS6xyOKvR5R7POIFr7XI5r0u0Bt8XyJ/J/Oc+FQvh5/lm8qu9ecFTl2/jOXxA4HGO98WUDEuhZYHQaYowVO8f6cda3/RumpCyL4L0PeFMIOGGI4bIglwxjHCc94su7i6lqGZyy/GGP40WCHKjqQxfUfT7KmzUzmtf9C5Ppi1A6R4+LZEtFaSQG7SXA9LyAcBpjbfi2r27zH94Y4kbDaJHv0V5/EOwo+aYznlCGe3C4TuTb3a8zHzmEpNQtXPxd+vInT/hM57hkvYPYaovWK7DSM5/N2c0jxTxU5KkqreOn33wiICYE7xHPGYYCtxhf1BPsNMfrIswnObhnLxaZRFDaMpKheBKXKWMyjPsJaXHbXcWkpLuNC4gI9xlFjXA2QTY9O1q+d/dh6JgXKQz6h53bHAWx9fdQYK5LZ7EKzaIrqS8E3u3n0XLDKZ0P1pkOY+06ntHGscHO/GVRv+kkb+lYKYueLimWpIMZ4fjHE6q1lMzl+1zEpcLOAcBhA7fHjnnGyPTzj9MC6aKexmF1HUNVkGJbHIqBE2/l3lkGrgcKt7oOxtAii0m04ZpcRVE5bIxmKyijxSCKvRYxejUxjnDj8NlvmlSIhfNYzqUea4wC2wGfdY7nRIFIPXF5/FFVNh2F1H6QL5aPVcnHrPvAYAAbt+1tcBbJuOSgurZyRKjbiukskZ1rJjVLPls12ecTwmdcCvRK1ArjYNFrfcd1uFtX+aegRCNkn5VpyFIz1lh7uA8M7Ql9/6NYT2vaV94RPkVU4mk2Z0xgRu8QpgryHZTVsprbTLkMsS7wWCwiHAfIbRdn7+6ERdgCPgdC1JzzTyS62vFSuxT1u/+5WH9MeBneBngPltaYyURGzy0g9z6Um9jNw0BAjIL4zPMtC7+WOA9iCqu0ids5m6q7qwrwgrpX6ainXpjSDl52kT6wHLzwEic0g1gARXvKeeH95bYlJr2Rl45DbKq22035tQqkTsVYA1c2DZRK1r22miohsC4lN4WVneEWB80fkWkpf+fedXAVKaAFvj5PXns2U7adBqMPgZgC1ndRnxh6DnE4OA1Q108R79oegznYAVYS6wzZhryvww0xN1CZYoECKAh8r8KECyQpMuQnk2Dfy2tQUuRl9A+QGqZVwC9HT5LjL8f2rMbZ2AEK8cQAEa71uM5uQvygwR4FPFFjVEiqL5fqBN2CxUtM/0WC+naaNsiKY7GVvq/7+OoTNbtSP5JRRTqcDHtG1BBjwuL1lbDZJgfc1Uaq4pQp84QyH1PJr/+QUfAMHB0Nac1jbFDb3h3NpWgArrAiXm/BCQztEr241ANR2uuw2Tn9GOA7QvacMHNEO/uhiB5ivCV+iwIZ68J0r7NY8MwKqi7irVRTBtnCYq8BrWiUnNLYPhc69awCYnMaS3Uq2kuMAo9vLoEluMpG5REZe5gYrnGC7i134nkfgUBc40gsyw+DyKijNAkspVJug5DCcewd2GOFTJ7kBKsQkDSLhYZlrXDeZo7iU8gbhAiK/cVQtAdSAsR4ywasKXD0ug2/uCd/bhDeHw6ro0Lv7sRD4ORDS3eQ921zsEB9oAOpQiGoN00ZqIyhHTEBbFU4aatNCY7zLReuoCWYokDFPBs+bL4XsM8CxYE1oGGRFwenn4cwr0k89Dyci7CAZQ2Dv7+S937rIFlyswLSbWmnLSplj6QZxHsrqjRIQv7WIKnccINbjkgis9uoiBdb7y58PLOVw+Gk49owUporMngq5M+7sZybD8dFaNYbKqqkQqfUlQIpW4ff8oLICLNUwIkoAVDSSD7hC10iT4wATGp0RAG9rO/W5M1z8VO5Q5RU4MxGyoiE3WQpVe/zCQri4HC4th/MpkDtTruX8FU6MlRBH+0iAXa7wmdZK8/3g2jkZe9tq6O8nAGxtVOgScc5xgES3DwTAPA0grQGkN4XiQ9o0rISi/XBpGVxYBAVfQeHmml6wAfI+lBBn34DjYRJifxt58Hf2lq1ZbZYxT+2GaF8I76C9vQ6SB7nRuPmOAyQr9Zmi5Oqz3nZwM4Lh2lb7zH8QZrXAnkUw2RUi28mJpL29mhqMLrniPtrNYQABMV15XQCsdNKmTlP7ob24CIoPQNUNsDr+0yLVJWDKhIy5sM7P/roR5SkBOvUWAOZGIX+qlXgdYo6yXTxpbZPHdnBF38+6vW3u5Gp7iUM93d5G6U1kzOXaOfizBhBjkAB+vcB9wNz7Ei8AUJxY5/ylSKb2rpo8K0YKypt9bwCq2w708XAZY8/DEmClBvCGBqC+nqsA3Xuk3rf4GiAb6yeTbqisWYF37rECX9orkGmrgPZgW3FLBcYZy3iqa/IDFa9DfN/ZjUMBszjyVA7ZUy3kJMOVNf8Z4NIK+yQSD7Vg+2vIUqWK+UoVU5U0khpO50X32h3YOquzOqsz5X9h/wKr0arvUEq8rwAAAABJRU5ErkJggg==" alt="instagram-new--v1">
                </a>
            </div>
            <div class="col-lg-6 py-4">
                <div class="card product-card border-0 rounded-4 shadow-sm">
                    <div class="position-relative">
                        <div class="overflow-hidden">
                            <img src="views/Public/images/image1.jpg" alt="App Screenshot" class=" card-img-top product-image-main"">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class=" container">
                            <div class="text-center mb-5">
                                <h1 class="section-heading display-4 mb-3">Қызметтерім</h1>
                            </div>
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="card feature-card h-100 p-4">
                                        <div class="icon-wrapper bg-soft-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                            </svg>
                                        </div>
                                        <h3 class="card-title">Оқу әдістемесі</h3>
                                        <p class="card-text text-muted">Жас мұғалімдерге оқыту стратегияларын үйретемін.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card feature-card h-100 p-4">
                                        <div class="icon-wrapper bg-soft-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                            </svg>
                                        </div>
                                        <h3 class="card-title">Семинарлар</h3>
                                        <p class="card-text text-muted">Білім беру тренингтері мен семинарлар өткіземін.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card feature-card h-100 p-4">
                                        <div class="icon-wrapper bg-soft-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                                            </svg>
                                        </div>
                                        <h3 class="card-title">Кеңес беру</h3>
                                        <p class="card-text text-muted">Білім саласындағы сұрақтарға кәсіби жауап беремін.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container py-5">
                            <div class="row justify-content-center">
                                <div class="text-center mb-5">
                                    <h1 class="section-heading display-4 mb-3">Танымал өнімдер</h1>
                                </div>
                                <div class="col-md-4">
                                    <div class="card product-card border-0 rounded-4 shadow-sm">
                                        <div class="position-relative">
                                            <div class="overflow-hidden">
                                                <img src="https://web.courstore.com/wp-content/uploads/2023/11/1-1.jpg" class="card-img-top product-image" alt="Product Image">
                                            </div>
                                        </div>
                                        <div class="card-body p-4">
                                            <h5 class="card-title mb-3 fw-bold">ҚМЖ: интерактивті құралдар, белсенді әдістер №1</h5>
                                            <p class="card-text text-muted mb-4">ҚМЖ жазуда заманауи интерактивті құралдар мен белсенді әдістерді қолдану (БАЗАЛЫҚ БІЛІМ)</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="price">40 000 ₸</span>
                                                <a href="https://app.courstore.com/kk/courses/mzh-zhazuda-zamanaui-interaktivti-raldar-men-bels" class="btn btn-dark text-white px-4 py-2 rounded-pill">
                                                    Сатып алу
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card product-card border-0 rounded-4 shadow-sm">
                                        <div class="position-relative">
                                            <div class="overflow-hidden">
                                                <img src="https://web.courstore.com/wp-content/uploads/2023/11/1-1.jpg" class="card-img-top product-image" alt="Product Image">
                                            </div>
                                        </div>
                                        <div class="card-body p-4">
                                            <h5 class="card-title mb-3 fw-bold">ҚМЖ: интерактивті құралдар, белсенді әдістер №2</h5>
                                            <p class="card-text text-muted mb-4">ҚМЖ жазуда заманауи интерактивті құралдар мен белсенді әдістерді қолдану (БАЗАЛЫҚ БІЛІМ)</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="price">70 000 ₸</span>
                                                <a href="https://app.courstore.com/kk/courses/copy-mzh-zhazuda-zamanaui-interaktivti-raldar-men-bels" class="btn btn-dark text-white px-4 py-2 rounded-pill">
                                                    Сатып алу
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card product-card border-0 rounded-4 shadow-sm">
                                        <div class="position-relative">
                                            <div class="overflow-hidden">
                                                <img src="https://web.courstore.com/wp-content/uploads/2023/11/1-1.jpg" class="card-img-top product-image" alt="Product Image">
                                            </div>
                                        </div>
                                        <div class="card-body p-4">
                                            <h5 class="card-title mb-3 fw-bold">ҚМЖ: интерактивті құралдар, белсенді әдістер №3</h5>
                                            <p class="card-text text-muted mb-4">ҚМЖ жазуда заманауи интерактивті құралдар мен белсенді әдістерді қолдану (БАЗАЛЫҚ БІЛІМ)</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="price">90 000 ₸</span>
                                                <a href="https://app.courstore.com/kk/courses/copy-copy-mzh-zhazuda-zamanaui-interaktivti-raldar-men-bels" class="btn btn-dark text-white px-4 py-2 rounded-pill">
                                                    Сатып алу
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container py-5">
                            <div class="text-center mb-5">
                                <h1 class="section-heading display-4 mb-3">Пікірлер</h1>
                            </div>
                            <div class="row">
                                <div class="card feature-card h-100 p-4">
                                    <h3 class="card-title">Айжан С.</h3>
                                    <p class="card-text text-muted">Кәсіби кеңестері мұғалімдік жолымда үлкен көмек болды.</p>
                                </div>
                                <div class="card feature-card h-100 p-4">
                                    <h3 class="card-title">Асхат Қ.</h3>
                                    <p class="card-text text-muted">Замзагүл ұстаздың семинарлары өте пайдалы болды!</p>
                                </div>
                            </div>
                        </div>

                        <section class="py-5">
                            <div class="container">
                                <div class="text-center mb-5">
                                    <h1 class="section-heading display-4 mb-3">Менімен байланысыңыз</h1>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="contact-form p-5 card feature-card">
                                            <form method="POST">
                                                <input name="contact" type="hidden" value="1">
                                                <div class="form-floating mb-3">
                                                    <input name="firstname" type="text" class="form-control rounded-3" id="floatingInput" placeholder="Атыңыз">
                                                    <label for="floatingInput">Аты</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input name="lastname" type="text" class="form-control rounded-3" id="floatingInput" placeholder="Тегіңіз">
                                                    <label for="floatingInput">Тегі</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input name="email" type="email" class="form-control rounded-3" id="floatingInput" placeholder="Электрондық пошта">
                                                    <label for="floatingInput">Электрондық пошта</label>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <textarea name="message" class="form-control custom-input" rows="5" placeholder="Хабарламаңыз"></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-dark rounded-pill w-100 py-3" type="submit">Хабарлама жіберу</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <p class="md-4"></p>

                        <?php include('sections/footer.php'); ?>