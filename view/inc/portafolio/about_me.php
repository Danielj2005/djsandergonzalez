
<?php

$about = mysqli_fetch_array(modeloPrincipal::consultar("SELECT * FROM about where id = 1"));

$subtitulo = $about['subtitulo'];
$src = $about['src'];
$titulo = $about['titulo'];
$slogan = $about['slogan'];
$incluye = $about['incluye'];
$incluye = explode(",",$incluye);

?>


<section id="about" class="about section dark:bg-gray-900 bg-gray-400/20 ">

    <!-- Section Title -->
    <div class="container section-title dark:text-white" style="text-wrap: balance !important;" data-aos="fade-up">
        <h2 class="dark:text-white">Sobre Mí</h2>
        <p><?= $subtitulo ?></p>
    </div><!-- End Section Title -->

    <div class="container dark:text-white" data-aos="fade-up" data-aos-delay="200">

        <div class="row gy-4 justify-content-center">
            <div class="align-items-center col-lg-4 d-flex justify-content-center justify-content-md-end">
                <img src="<?= $src ?>" class="img-fluid rounded-circle w-[15rem]" alt="image of Dj Sander Gonzalez">
            </div>
            <div class="col-lg-8 content">
                <h2 class=" dark:text-white"><?= $titulo ?></h2>
                <p class="fst-italic py-3" style="text-wrap: balance !important;"><?= $slogan ?></p>
                <h2 class="font-bold dark:text-white text-slate-600 mb-3"> Lo que puedes esperar:</h2>

                <div class="row text-sm">
                    <div class="col-12">
                        <ul class="flex flex-wrap justify-between items-center">
                            <?php foreach ($incluye as $data): ?>
                                <li><i class="bi bi-chevron-right"></i> <strong><?= $data ?></strong> </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>