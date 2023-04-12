<x-layout title="Home Page">
    <x-header.navigation />
    <main>
        <div class="position-relative overflow-hidden p-3 p-md-5 my-2 text-left product-header">
            <div class="col-md-5 p-lg-5 my-5">
                <h1 class="display-4 fw-normal">Punny headline</h1>
                <p class="lead fw-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts
                    with this example based on Apple’s marketing pages.</p>
                <a class="btn btn-outline-secondary" href="/store">Go to Store</a>
            </div>
        </div>


        <div class="px-4 pt-5 my-5 text-center border-bottom">
            <h1 class="display-4 fw-bold">Your Favorite Beverages</h1>
            <div class="col-lg-12 mx-auto">
                <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the
                    world’s most popular front-end open source toolkit, featuring Sass variables and mixins,
                    responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                    <button type="button" class="btn btn-primary btn-lg px-4 me-sm-3">Buy Now</button>
                    <button type="button" class="btn btn-outline-danger btn-lg px-4">Go to Favorites</button>
                </div>
            </div>
            <div class="overflow-hidden" style="max-height: 30vh;">
                <div class="container px-5">
                    <img src="/storage/images/beverages.jpg" class="img-fluid border rounded-3 shadow-lg mb-4"
                        alt="Example image" width="700" height="500" loading="lazy">
                </div>
            </div>
        </div>

        <div class="col-xxl-12 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5 border-bottom rounded-4">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="/storage/images/meat.jpeg" class="d-block mx-lg-auto img-fluid rounded-2" alt="Bootstrap Themes"
                        width="700" height="500" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3">Fresh Meats</h1>
                    <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the
                        world’s most popular front-end open source toolkit, featuring Sass variables and mixins,
                        responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Search Now</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xxl-12 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">

                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3">Top Brands Availabe</h1>
                    <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the
                        world’s most popular front-end open source toolkit, featuring Sass variables and mixins,
                        responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Shop Now</button>
                    </div>
                </div>
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="/storage/images/clothes.jpeg" class="d-block mx-lg-auto img-fluid rounded-2"
                        alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                </div>
            </div>
        </div>
    </main>


</x-layout>
