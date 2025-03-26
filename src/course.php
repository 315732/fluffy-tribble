<?php include 'sections/dependency.php'; ?>

<?php include'sections/header.php'; ?>

<main class="container">

    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
        <div class="row align-items-center">
            <div class="col-md-6 text-md-start text-center mb-5">
                <h2 class="mb-3">Watch Our Latest Video</h2>
                <p class="mb-4">Stay updated with our latest content.</p>
                <a href="https://www.youtube.com/watch?v=wxXE8Q_hvOA" target="_blank" class="btn btn-dark btn-lg rounded-pill">
                    Buy
                </a>
            </div>

            <div class="col-md-6">
                <div style="position: relative; width: 100%; padding-top: 56.25%;">
                    <iframe
                        src="https://www.youtube-nocookie.com/embed/wxXE8Q_hvOA"
                        title="YouTube video player"
                        allowfullscreen
                        frameborder="0"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-5 mb-4">
        <article class="blog-post">
            <h2 class="display-5 link-body-emphasis">Sample blog post</h2>
            <p class="blog-post-meta">January 1, 2021 by <a href="#">Mark</a></p>
        </article>
        <div class="accordion" id="sleekAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Features
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#sleekAccordion">
                    <div class="accordion-body">
                        Discover our product's cutting-edge features designed to enhance your productivity and
                        streamline your workflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Pricing
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#sleekAccordion">
                    <div class="accordion-body">
                        Explore our flexible pricing options tailored to fit your needs, from individual users
                        to enterprise solutions.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Support
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#sleekAccordion">
                    <div class="accordion-body">
                        Get assistance from our dedicated support team, available 24/7 to help you with any
                        questions or issues you may encounter.
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?php include 'sections/footer.php'; ?>