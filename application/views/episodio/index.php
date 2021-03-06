<main class="d-none">
    <!-- Spacer -->
    <div class="title-spacer"></div>

    <div class="container-fluid">
        <!-- Header -->
        <div class="row">
            <div class="col-md-3">
                <a class="btn btn-red waves-effect waves-light back-button" href="/serie/episodi/<?php echo $episode->getCategoryId(); ?>">
                    <i class="fas fa-arrow-left"></i> Torna alla lista
                </a>
            </div>
        </div>

        <!-- Header -->
        <?php if (count($banners) > 0): ?>
            <div class="container-fluid mb-3 mt-5 overflow-hidden">
                <div class="swiper-banner-container">
                    <div class="swiper-wrapper image-slider-wrapper">
                        <?php foreach($banners as $banner): ?>
                            <div class="swiper-slide image-slide">
                                <!--Zoom effect-->
                                <div class="view overlay">
                                    <?php if(strlen($banner->getLink()) > 0): ?>
                                        <a href="<?php echo $banner->getLink();?>" target="_blank">
                                            <img class="banner w-100" src="<?php echo BANNERS_IMG_LINK . $banner->getImgName()?>"
                                                 class="img-fluid"
                                                 alt="Sponsor banner">
                                        </a>
                                    <?php else: ?>
                                        <img class="banner w-100" src="<?php echo BANNERS_IMG_LINK . $banner->getImgName()?>"
                                             class="img-fluid"
                                             alt="Sponsor banner">
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- Sponsor -->
            <div id="banner-spacer" class="mb-5"></div>
            <br>
        <?php endif; ?>

        <div id="video-container" class="wow fadeIn">
            <div id="video-container" class="container mb-2">
                <h1 class="card-title h1-responsive pt-3 font-bold text-center">
                    <strong><?php echo $episode->getTitle();?></strong>
                </h1>
                <!-- Divider + Space bottom -->
                <hr>

                <div class="row justify-content-center p-3">
                    <div class="embed-responsive embed-responsive-16by9" style="max-width: 120vh;">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $episode->getLink();?>?autoplay=1"
                                title="<?php echo $episode->getTitle(); ?>"
                                aria-hidden="true"
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            <!-- Sponsors -->
            <?php if (count($banners) > 0): ?>
                <div class="container-fluid overflow-hidden">
                    <div class="swiper-banner-container">
                        <div class="swiper-wrapper image-slider-wrapper">
                            <?php foreach($banners as $banner): ?>
                                <div class="swiper-slide image-slide">
                                    <!--Zoom effect-->
                                    <div class="view overlay">
                                        <?php if(strlen($banner->getLink()) > 0): ?>
                                            <a href="<?php echo $banner->getLink();?>" target="_blank">
                                                <img class="banner w-100" src="<?php echo BANNERS_IMG_LINK . $banner->getImgName()?>"
                                                     class="img-fluid"
                                                     alt="Sponsor banner">
                                            </a>
                                        <?php else: ?>
                                            <img class="banner w-100" src="<?php echo BANNERS_IMG_LINK . $banner->getImgName()?>"
                                                 class="img-fluid"
                                                 alt="Sponsor banner">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- Sponsor -->
                <div id="banner-spacer" class="mb-2"></div>
                <br>
            <?php endif; ?>

            <div class="container mb-5" id="actionButtons">
                <div class="row" role="group" aria-label="Action buttons">
                    <div class="col">
                        <button class="btn btn-outline-primary waves-effect w-100" data-toggle="collapse" data-target="#collapseDescription" aria-expanded="false"
                                aria-controls="collapseDescription" id="collapseButtonDesc">
                            Leggi descrizione
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-danger waves-effect w-100" type="button" data-toggle="collapse" data-target="#collapseVideoInfos"
                                aria-expanded="false" aria-controls="collapseVideoInfos" id="collapseButtonInfos">
                            Mostra informazioni
                        </button>
                    </div>
                </div>

                <!-- Collapsible element -->
                <div class="collapse d-none" id="collapseDescription">
                    <div class="mt-3">
                        <p class="text-break">
                            <?php if(empty($episode->getDescription())): ?>
                                Descrizione non disponibile
                            <?php else:?>
                                <?php echo $episode->getDescription(); ?>
                            <?php endif;?>
                        </p>
                    </div>
                </div>

                <!-- Collapsible element -->
                <div class="collapse d-none" id="collapseVideoInfos">
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="h4-responsive font-weight-bold">Data caricamento:</h4>
                            </div>
                            <div class="col-md-3">
                                <h4 class="h4-responsive"><?php echo $episode->getCreationDateTime()->format("d.m.Y H:i");?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="h4-responsive font-weight-bold">Serie:</h4>
                            </div>
                            <div class="col-md-3">
                                <h4 class="h4-responsive"><?php echo $episode->getCategory()->getCategoryName();?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Collapsible element -->



            </div>
        </div>
    </div>
</main>

<!-- Swiper js -->
<script src="/application/assets/js/addons/swiper.min.js"></script>

<script>
    $(document).ready(function () {
        // Init slider
        let swiper_banner = new Swiper('.swiper-banner-container', {
            slidesPerView: 'auto',
            centeredSlides: true,
            spaceBetween: 40,
            loop: true,
            speed: 1000,
            automaticResize: true,
            autoplay: {
                delay: <?php echo BANNER_SWIPER_DELAY; ?>,
                disableOnInteraction: false,
                waitForTransition: true,
            },
            observer: true,
            observeParents: true,
            preloadImages: false,
            lazy: true,
        });
        swiper_banner.init();
    })
</script>

<script>
    let descObj = $("#collapseDescription");
    let infoObj = $("#collapseVideoInfos");

    /* Description show & hide handler */
    $(descObj).on('show.bs.collapse', function () {
        // Show desc
        $(this).removeClass("d-none");

        // Hide info
        $(infoObj).collapse('hide');

        // Update text
        $('#collapseButtonDesc').text("Nascondi descrizione");

        console.log("[!] Show event on description");
    });

    $(descObj).on('hide.bs.collapse', function () {
        $('#collapseButtonDesc').text("Leggi descrizione");
    });

    /* Video info show & hide handler */
    $(infoObj).on('show.bs.collapse', function () {
        // Hide desc
        $(descObj).addClass("d-none");
        $(descObj).collapse('hide');

        // Show infos
        $(this).removeClass("d-none");

        // Update text
        $('#collapseButtonInfos').text("Nascondi informazioni");

        console.log("[!] Show event on infos");
    });

    $(infoObj).on('hide.bs.collapse', function () {
        $('#collapseButtonInfos').text("Mostra informazioni")
    });
</script>
