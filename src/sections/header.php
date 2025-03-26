<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Elster">
	<meta name="generator" content="Elster">

	<title>Home</title>


	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

	<link rel="stylesheet" href="sections/styles/style.css">


</head>

<body>

	<div class="container">
		<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">

			<div class="col-md-2 mb-2 mb-md-0">
				<a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
					<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACyElEQVR4nO2ZO2gUURSGP5foIiq44ouAFlspCpJSAjaC4gvU2gciWCWt0RS+mkQ7CzsbLcVCo50oml0LX61CNE0irEbyWlRWIY5c+Acuy+zs7OxsJjfMD4e999xzH//MPfecuQsZMmRYLjgKvAV+6vcIjpLwAuR40hOtBfqBMUm/dEnhnRZ+GVgDDKr+JqkJtgE3gdmApzWrNmPTLv5ozFWq51WvtTtwD3Af+NvglduyADwB9rYxnydppouEHHAMeBZh8Y3kPXAG6IpJxAuQyDB7/QLwqQ0C9TIODADrF4PIVuAaMJ0ggXqZB24D2ztBpKeF/Z+UNPMjLyoRs/9PAKMhHSrAQ2AIOAf0AjuAIrAJKAArJAXpirLpVZ8hjVEJmWdUa8nFIVIOMfwMHKobuF2YsQ4DX0LmLcUh8jrEcKds1mnyq8A94IUOgAlgBpiz+sxJNyGb5+pzRQ/FD5a7QuYtxyGyOoJhNUGfqIYs8h9wR2tqmYhtPNXAMGkHDxp3SrGq0dpaIrIZeJoCERNou4MWFpcIOnlMEPy9CERqCo5hh0lsIj72WOVvCZKoNJijY0RsdClg9ckZR4APSjemdUr5Y8xINy6bEfXp0xgdzbW8JkTShBeVyH6rwZRtnAQeAV+Bl8At4DxwENit6L1F0TwnKUhXlM0B9RkGXgG/Imy/chwidoQ1ZfQR86ADTh5VSnGIjFkNpmxwPUUSF+NurUtWgymj9CItIt1xiZgP+kmJKaPUOi0iK+MSQVcr9vWKk28kCGn6yECSRMyp9ThFMuWkiPg51ynFj3kXjt+lDi8jYm2ts7oQqLrqI3ld0aTl7KWkiNxwMUUJwuRyCYgLrqYo9ViKKUq+7v8R51KUj9Kby0H060nvVIqyTxd3Nd171VQ3eqdSFIO70vu+a+pOYgPwXSR+ABtxGKdFxOwS5zGY9gIyZMBB/Aeq/3Gem8dBKAAAAABJRU5ErkJggg=="
						alt="teaching">
				</a>
			</div>

			<ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
				<li><a href="home.php" class="nav-link text-dark">Негізгі бет</a></li>
				<li><a href="about.php" class="nav-link text-dark">Мен туралы</a></li>
			</ul>

			<?php if (isset($_SESSION['user_session']) && !empty($_SESSION['user_session'])) { ?>
				<div class="col-md-3 text-end">
					<a href="signout.php" type="button" class="btn btn-outline-dark me-2 rounded-pill">Шығу</a>
				</div>
			<?php } else { ?>
				<div class="col-md-3 text-end">
					<a href="signin.php" type="button" class="btn btn-outline-dark me-2 rounded-pill">Кіру</a>
					<a href="signup.php" type="button" class="btn btn-dark rounded-pill">Тіркелу</a>
				</div>
			<?php } ?>

		</header>
	</div>

	<p class="border-bottom"></p>