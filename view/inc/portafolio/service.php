
<?php $query = modeloPrincipal::consultar("SELECT * FROM servicio"); ?>


<section id="services" class="services section  dark:bg-gray-900  bg-gray-400/20 ">

    <div class="container section-title" data-aos="fade-up">
        <h2 class=" dark:text-white">Services</h2>
        <p class=" dark:text-white">Elige la experiencia que más se adapta a tu evento y recibe una propuesta personalizada.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-3 md:ms-[10rem] items-start">
        <?php while ($input = mysqli_fetch_array($query)) : ?>
            <div class="group card shadow-2xl hover:-translate-y-2 hover:shadow-xl shadow-cyan-500/20 mb-3 bg-gray-800 rounded-3xl border-[2px] hover:border-cyan-500 transition delay-150 ease-in-out " data-aos="fade-up" data-aos-delay="100">
                <div class="p-4 text-white-50">
                    
                    <div class="pricing-hader text-white-50">
                        <h3 class="font-bold text-gray-200 rounded-full p-2 group-hover:bg-cyan-500 transition delay-150 ease-in-out "><?= $input['nombre'] ?></h3>
                        <p class="text-white text-balance my-3"><?= $input['subtitulo'] ?></p>
                    </div>

                    <ul class="mb-3 text-gray-400 list-unstyled text-start">
                        <?php 
                            $input['incluye'] = explode(",",$input['incluye']);
                        
                        foreach ($input['incluye'] as $incluye): ?>
                            <li class="text-slate-300 dark:text-slate-400 "><i class="bi bi-check-circle text-success"></i>&nbsp; <?= $incluye ?></li>
                        <?php endforeach; ?>
                    </ul>

                    
                    <div class=" items-center justify-center flex w-full">
                        <a href="#contact" class="w-[15rem] text-white btn rounded-full shadow-xl shadow-cyan-500/20 bg-cyan-500/80 hover:border-cyan-800 p-2 hover:bg-cyan-800 transition delay-150 ease-in-out ">Cotizar servicio</a>
                    </div>

                </div>
            </div>
        <?php endwhile; ?>
        
    </div>

</section>
